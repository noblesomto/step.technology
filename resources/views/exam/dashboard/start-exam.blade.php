@include('exam.dashboard.layouts.header')
@include('exam.dashboard.layouts.nav', ['active' => 'exam'])

<style>
    .custom-radio {
        appearance: none; -webkit-appearance: none; -moz-appearance: none;
        width: 1.125rem; height: 1.125rem;
        border: 2px solid #e2e8f0; border-radius: 50%;
        background: white; cursor: pointer; transition: all 0.2s ease;
        position: relative; flex-shrink: 0;
    }
    .custom-radio:hover { border-color: #001f66; }
    .custom-radio:checked { background-color: #001f66; border-color: #001f66; box-shadow: 0 0 0 3px rgba(0,31,102,0.12); }
    .custom-radio:checked::after {
        content: ''; position: absolute; top: 50%; left: 50%;
        transform: translate(-50%, -50%);
        width: 0.5rem; height: 0.5rem; background: white; border-radius: 50%;
    }
    .answer-option { transition: all 0.15s ease; border: 2px solid transparent; }
    .answer-option:hover { background-color: #f8fafc; border-color: #e2e8f0; }
    .answer-option.selected { background-color: rgba(0,31,102,0.05); border-color: #001f66; }
    .timer-display { font-family: 'Courier New', monospace; font-weight: bold; transition: color 0.3s ease; }
    .timer-warning { color: #d97706; }
    .timer-critical { color: #dc2626; animation: pulse 0.6s infinite; }
    @keyframes pulse { 0%, 100% { opacity: 1; } 50% { opacity: 0.6; } }
    .save-indicator {
        position: fixed; top: 76px; right: 20px; padding: 8px 16px; border-radius: 8px;
        font-size: 0.8rem; font-weight: 500; z-index: 1000; transition: all 0.3s ease;
    }
    .save-indicator.saving { background: #fef3c7; color: #92400e; }
    .save-indicator.saved { background: #d1fae5; color: #065f46; }
    .save-indicator.error { background: #fee2e2; color: #991b1b; }
</style>

<div id="save-indicator" class="save-indicator hidden"></div>

<div class="mb-6">
    <h1 class="font-step-heading font-bold text-2xl text-gray-900">Take Exam</h1>
    <p class="text-gray-500 text-sm mt-1">Answer every question — your progress is saved automatically.</p>
</div>

<div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden max-w-3xl">
    {{-- Progress & Timer --}}
    <div class="bg-step-primary/5 p-6 border-b border-gray-100">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h2 class="font-step-heading font-semibold text-sm text-gray-500 mb-1">Progress</h2>
                <span id="question-counter" class="text-sm font-medium text-step-primary bg-white px-3 py-1 rounded-full border border-step-primary/20"></span>
            </div>
            <div class="text-right">
                <h2 class="font-step-heading font-semibold text-sm text-gray-500 mb-1">Time Remaining</h2>
                <div id="timer-display" class="timer-display text-xl text-gray-800">--:--</div>
            </div>
        </div>
        <div class="w-full bg-gray-200 rounded-full h-2.5 overflow-hidden">
            <div id="progress-bar" class="bg-step-primary h-full rounded-full transition-all duration-500" style="width: 0%"></div>
        </div>
    </div>

    {{-- Questions --}}
    <div id="exam-section" class="p-6 sm:p-8">
        <div id="question-container"></div>

        <div class="flex justify-between items-center mt-8 pt-6 border-t border-gray-100">
            <button id="prev-button" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-step-heading font-semibold px-5 py-2.5 rounded-full hidden">
                ← Previous
            </button>
            <div class="flex-1"></div>
            <button id="next-button" class="bg-step-primary hover:bg-step-accent text-white font-step-heading font-semibold px-6 py-2.5 rounded-full transition-colors">
                Next →
            </button>
        </div>
    </div>

    {{-- Ready to submit --}}
    <div id="result-container" class="hidden p-8 text-center bg-step-primary/5">
        <div class="max-w-md mx-auto">
            <i class="fa fa-check-circle text-step-primary text-5xl mb-4"></i>
            <h2 class="font-step-heading font-bold text-xl text-gray-900 mb-2">All Questions Answered</h2>
            <p class="text-gray-600 mb-6">Once submitted, you won't be able to change your answers. An admin will review your result.</p>
            <button id="submit-score" class="bg-step-primary hover:bg-step-accent text-white font-step-heading font-semibold px-8 py-3 rounded-full w-full transition-colors">
                Submit Exam
            </button>
            <div id="submission-message" class="hidden mt-4 p-4 bg-green-50 border border-green-200 rounded-lg">
                <div class="flex items-center justify-center gap-2 text-green-800 font-medium">
                    <i class="fa fa-check"></i> Your exam has been submitted!
                </div>
            </div>
        </div>
    </div>
</div>

<script>
class ExamDashboard {
    constructor() {
        this.examId = '{{ $session->exam_session_id }}';
        this.questions = @json($questions);
        this.currentQuestionIndex = {{ $session->current_question ?? 0 }};
        this.totalQuestions = this.questions.length;

        const savedAnswers = @json($session->answers ?? []);
        this.selectedAnswers = savedAnswers.length === this.totalQuestions
            ? savedAnswers
            : new Array(this.totalQuestions).fill(null);

        this.timeRemaining = {{ $remainingSeconds }};
        this.durationSeconds = {{ $durationMinutes * 60 }};
        this.timerInterval = null;
        this.isSubmitting = false;
        this.autoSaveInterval = null;

        this.initElements();
        this.bindEvents();
        this.renderQuestion();
        this.startTimer();
        this.startAutoSave();
    }

    initElements() {
        this.container = document.getElementById('question-container');
        this.progressBar = document.getElementById('progress-bar');
        this.counter = document.getElementById('question-counter');
        this.prevBtn = document.getElementById('prev-button');
        this.nextBtn = document.getElementById('next-button');
        this.examSection = document.getElementById('exam-section');
        this.resultSection = document.getElementById('result-container');
        this.submitBtn = document.getElementById('submit-score');
        this.messageBox = document.getElementById('submission-message');
        this.timerDisplay = document.getElementById('timer-display');
        this.saveIndicator = document.getElementById('save-indicator');
    }

    bindEvents() {
        this.prevBtn.addEventListener('click', () => this.prev());
        this.nextBtn.addEventListener('click', () => this.next());
        this.submitBtn.addEventListener('click', () => this.submit());

        window.addEventListener('beforeunload', (e) => {
            if (!this.isSubmitting && this.timeRemaining > 0) {
                e.preventDefault();
                e.returnValue = '';
            }
        });

        window.addEventListener('beforeunload', () => this.saveSynchronously());
    }

    startTimer() {
        this.updateTimerDisplay();
        this.timerInterval = setInterval(() => {
            this.timeRemaining--;
            this.updateTimerDisplay();

            if (this.timeRemaining <= 0) {
                clearInterval(this.timerInterval);
                this.notify('Time is up! Auto-submitting exam...', 'warning');
                setTimeout(() => this.autoSubmit(), 1000);
            }
        }, 1000);
    }

    updateTimerDisplay() {
        const minutes = Math.floor(this.timeRemaining / 60);
        const seconds = this.timeRemaining % 60;
        this.timerDisplay.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;

        this.timerDisplay.classList.remove('timer-warning', 'timer-critical');
        if (this.timeRemaining <= 60) {
            this.timerDisplay.classList.add('timer-critical');
        } else if (this.timeRemaining <= 300) {
            this.timerDisplay.classList.add('timer-warning');
        }
    }

    updateProgress() {
        const progress = ((this.currentQuestionIndex + 1) / this.totalQuestions) * 100;
        this.progressBar.style.width = `${progress}%`;
        this.counter.textContent = `Question ${this.currentQuestionIndex + 1} of ${this.totalQuestions}`;
    }

    renderQuestion() {
        const q = this.questions[this.currentQuestionIndex];

        this.container.innerHTML = `
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-6">${q.question}</h3>
                <div class="space-y-3">
                    ${q.options.map(ans => `
                        <label class="answer-option flex items-start p-4 rounded-lg cursor-pointer border-gray-200 border ${this.selectedAnswers[this.currentQuestionIndex] === ans ? 'selected' : ''}">
                            <input type="radio" name="answer" value="${ans}" class="custom-radio mt-0.5 mr-4"
                                ${this.selectedAnswers[this.currentQuestionIndex] === ans ? 'checked' : ''}>
                            <span class="text-gray-700 flex-1">${ans}</span>
                        </label>
                    `).join('')}
                </div>
            </div>
        `;

        this.updateProgress();
        this.updateNav();
        this.bindAnswerSelect();
    }

    bindAnswerSelect() {
        this.container.querySelectorAll('.answer-option').forEach(option => {
            option.addEventListener('click', () => {
                this.container.querySelectorAll('.answer-option').forEach(o => o.classList.remove('selected'));
                option.classList.add('selected');
                option.querySelector('input').checked = true;
                this.selectedAnswers[this.currentQuestionIndex] = option.querySelector('input').value;
                this.saveProgress();
            });
        });
    }

    updateNav() {
        this.prevBtn.classList.toggle('hidden', this.currentQuestionIndex === 0);
        this.nextBtn.textContent = this.currentQuestionIndex === this.totalQuestions - 1 ? 'Finish →' : 'Next →';
    }

    prev() {
        if (this.currentQuestionIndex > 0) {
            this.currentQuestionIndex--;
            this.renderQuestion();
        }
    }

    next() {
        if (!this.selectedAnswers[this.currentQuestionIndex]) {
            return this.notify('Please select an answer before continuing.', 'warning');
        }
        if (this.currentQuestionIndex < this.totalQuestions - 1) {
            this.currentQuestionIndex++;
            this.renderQuestion();
        } else {
            this.showResult();
        }
    }

    showResult() {
        this.examSection.classList.add('hidden');
        this.resultSection.classList.remove('hidden');
    }

    startAutoSave() {
        this.autoSaveInterval = setInterval(() => this.saveProgress(), 15000);
    }

    showSaveIndicator(status, message) {
        this.saveIndicator.className = `save-indicator ${status}`;
        this.saveIndicator.textContent = message;
        this.saveIndicator.classList.remove('hidden');

        if (status === 'saved') {
            setTimeout(() => this.saveIndicator.classList.add('hidden'), 2000);
        }
    }

    async saveProgress() {
        this.showSaveIndicator('saving', '💾 Saving...');
        try {
            const response = await fetch('/user/save-exam-progress', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    exam_session_id: this.examId,
                    answers: this.selectedAnswers,
                    current_question: this.currentQuestionIndex,
                    time_remaining: this.timeRemaining,
                    is_complete: false
                })
            });

            if (!response.ok) throw new Error('Save failed');
            this.showSaveIndicator('saved', '✓ Saved');
        } catch (error) {
            console.error('Auto-save error:', error);
            this.showSaveIndicator('error', '⚠ Save failed');
        }
    }

    saveSynchronously() {
        const data = JSON.stringify({
            exam_session_id: this.examId,
            answers: this.selectedAnswers,
            current_question: this.currentQuestionIndex,
            time_remaining: this.timeRemaining,
            is_complete: false
        });

        navigator.sendBeacon('/user/save-exam-progress', new Blob([data], { type: 'application/json' }));
    }

    async autoSubmit() {
        this.isSubmitting = true;
        await this.submitExam();
    }

    async submit() {
        this.isSubmitting = true;
        clearInterval(this.timerInterval);
        clearInterval(this.autoSaveInterval);
        await this.submitExam();
    }

    async submitExam() {
        try {
            const response = await this.postSubmit();
            if (!response.ok) throw new Error('Submission failed');
            window.location.href = '/user/exam-done';
        } catch (error) {
            console.error('Submission error:', error);
            await this.retrySubmission();
        }
    }

    postSubmit() {
        return fetch('/user/submit-exam', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                exam_session_id: this.examId,
                answers: this.selectedAnswers,
                time_taken: this.durationSeconds - this.timeRemaining,
                is_complete: true
            })
        });
    }

    async retrySubmission(attempts = 3) {
        for (let i = 0; i < attempts; i++) {
            try {
                const response = await this.postSubmit();
                if (response.ok) {
                    window.location.href = '/user/exam-done';
                    return;
                }
            } catch (error) {
                if (i === attempts - 1) {
                    this.notify('Submission failed. Your progress is saved. Redirecting...', 'error');
                    setTimeout(() => { window.location.href = '/user/exam-done'; }, 2000);
                }
            }
            await new Promise(r => setTimeout(r, 2000));
        }
    }

    notify(msg, type) {
        const colors = {
            error: 'bg-red-50 border-red-200 text-red-800',
            warning: 'bg-yellow-50 border-yellow-200 text-yellow-800',
            info: 'bg-step-primary/5 border-step-primary/20 text-step-primary'
        };
        const div = document.createElement('div');
        div.className = `fixed top-20 right-4 p-4 rounded-lg border shadow-sm ${colors[type] || colors.info} z-50`;
        div.textContent = msg;
        document.body.appendChild(div);
        setTimeout(() => div.remove(), 3000);
    }
}

document.addEventListener('DOMContentLoaded', () => new ExamDashboard());
</script>

@include('exam.dashboard.layouts.footer')
