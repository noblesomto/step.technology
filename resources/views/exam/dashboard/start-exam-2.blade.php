@include('exam.dashboard.layouts.header-section')

<style>
    /* =======================
       Custom Radio Styles
    ======================= */
    .custom-radio {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        width: 1.125rem;
        height: 1.125rem;
        border: 2px solid #e2e8f0;
        border-radius: 50%;
        background: white;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        flex-shrink: 0;
    }
    .custom-radio:hover {
        border-color: #3b82f6;
        transform: scale(1.05);
    }
    .custom-radio:checked {
        background-color: #3b82f6;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }
    .custom-radio:checked::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 0.5rem;
        height: 0.5rem;
        background: white;
        border-radius: 50%;
    }

    /* =======================
       Answer Option Styles
    ======================= */
    .answer-option {
        transition: all 0.2s ease;
        border: 2px solid transparent;
    }
    .answer-option:hover {
        background-color: #f8fafc;
        border-color: #e2e8f0;
    }
    .answer-option.selected {
        background-color: #eff6ff;
        border-color: #3b82f6;
    }

    /* =======================
       Buttons
    ======================= */
    .btn {
        transition: all 0.2s ease;
        transform: translateY(0);
    }
    .btn:hover {
        transform: translateY(-1px);
    }
    .btn-primary:hover {
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
    }
    .btn-secondary:hover {
        box-shadow: 0 4px 12px rgba(107, 114, 128, 0.4);
    }

    /* =======================
       Progress Bar
    ======================= */
    .progress-bar {
        transition: width 0.5s ease;
    }

    /* =======================
       Fade + Card + Message
    ======================= */
    .fade-transition { transition: opacity 0.3s ease; }
    .exam-card { box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04); }
    .success-message { animation: fadeInUp 0.5s ease; }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<body class="bg-gray-50 min-h-screen">
<main class="px-6 py-8">
    <div class="container mx-auto max-w-4xl">

        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-gray-800 mb-2">Exam Dashboard</h1>
            <p class="text-gray-600">Answer all questions to complete your exam</p>
        </div>

        <!-- Exam Card -->
        <div class="bg-white rounded-xl shadow-xl exam-card overflow-hidden">

            <!-- Progress -->
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-6 border-b border-gray-100">
                <div class="flex items-center justify-between mb-3">
                    <h2 class="text-lg font-semibold text-gray-700">Progress</h2>
                    <span id="question-counter" class="text-sm font-medium text-gray-600 bg-white px-3 py-1 rounded-full"></span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
                    <div id="progress-bar" class="bg-gradient-to-r from-blue-500 to-indigo-500 h-full rounded-full progress-bar"></div>
                </div>
            </div>

            <!-- Questions -->
            <div id="exam-section" class="p-8">
                <div id="question-container" class="fade-transition"></div>

                <!-- Navigation -->
                <div class="flex justify-between items-center mt-8 pt-6 border-t border-gray-100">
                    <button id="prev-button" class="bg-gray-500 hover:bg-gray-600 text-white font-medium px-6 py-3 rounded-lg hidden">
                        ← Previous
                    </button>
                    <div class="flex-1"></div>
                    <button id="next-button" class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-8 py-3 rounded-lg">
                        Next →
                    </button>
                </div>
            </div>

            <!-- Results -->
            <div id="result-container" class="hidden p-8 text-center bg-gradient-to-r from-green-50 to-emerald-50">
                <div class="max-w-md mx-auto">
                    <div class="mb-6">
                        <div class="text-6xl text-green-500 mb-4">🎉</div>
                        <h2 class="text-2xl font-bold text-gray-800 mb-2">Exam Complete!</h2>
                        <p class="text-gray-600">Your have successfully answered the questions</p>
                    </div>
                    <button id="submit-score" class="btn btn-primary bg-green-600 hover:bg-green-700 text-white font-medium px-8 py-3 rounded-lg w-full">
                        Submit Exam
                    </button>
                    <div id="submission-message" class="hidden success-message mt-4 p-4 bg-green-100 border border-green-200 rounded-lg">
                        <div class="flex items-center justify-center">
                            <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-green-800 font-medium">Your exam has been submitted!</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>

<script>
class ExamDashboard {
    constructor() {
        this.questions = @json($questions);
        this.currentQuestionIndex = 0;
        this.totalQuestions = this.questions.length;
        this.selectedAnswers = new Array(this.totalQuestions).fill(null);

        this.initElements();
        this.bindEvents();
        this.renderQuestion();
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
    }

    bindEvents() {
        this.prevBtn.addEventListener('click', () => this.prev());
        this.nextBtn.addEventListener('click', () => this.next());
        this.submitBtn.addEventListener('click', () => this.submit());
    }

    updateProgress() {
        const progress = ((this.currentQuestionIndex + 1) / this.totalQuestions) * 100;
        this.progressBar.style.width = `${progress}%`;
        this.counter.textContent = `Question ${this.currentQuestionIndex + 1} of ${this.totalQuestions}`;
    }

    renderQuestion() {
        const q = this.questions[this.currentQuestionIndex];
        const answers = this.shuffle([q.answer1, q.answer2, q.answer3, q.correct_answer]);

        this.container.innerHTML = `
            <div>
                <h3 class="text-xl font-semibold text-gray-800 mb-6">${q.question}</h3>
                <div class="space-y-3">
                    ${answers.map(ans => `
                        <label class="answer-option flex items-start p-4 rounded-lg cursor-pointer ${this.selectedAnswers[this.currentQuestionIndex] === ans ? 'selected' : ''}">
                            <input type="radio" name="answer" value="${ans}" class="custom-radio mt-0.5 mr-4"
                                ${this.selectedAnswers[this.currentQuestionIndex] === ans ? 'checked' : ''}>
                            <span class="text-gray-700 font-medium flex-1">${ans}</span>
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
        const options = this.container.querySelectorAll('.answer-option');
        options.forEach(option => {
            option.addEventListener('click', () => {
                options.forEach(o => o.classList.remove('selected'));
                option.classList.add('selected');
                option.querySelector('input').checked = true;
                this.selectedAnswers[this.currentQuestionIndex] = option.querySelector('input').value;
            });
        });
    }

    shuffle(arr) {
        return [...arr].sort(() => Math.random() - 0.5);
    }

    updateNav() {
        this.prevBtn.classList.toggle('hidden', this.currentQuestionIndex === 0);
        if (this.currentQuestionIndex === this.totalQuestions - 1) {
            this.nextBtn.textContent = 'Finish →';
            this.nextBtn.classList.replace('bg-blue-600', 'bg-green-600');
        } else {
            this.nextBtn.textContent = 'Next →';
            this.nextBtn.classList.replace('bg-green-600', 'bg-blue-600');
        }
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

    async submit() {
        try {
            const score = this.selectedAnswers.reduce((acc, answer, i) => {
                return acc + (answer === this.questions[i].correct_answer ? 1 : 0);
            }, 0);

            const response = await fetch('/user/store-score', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ score }) // ✅ only submit score
            });

            if (!response.ok) throw new Error();

            // ✅ redirect to results page with score
            window.location.href = `/user/exam-done`;

        } catch {
            this.notify('Failed to submit exam. Please try again.', 'error');
        }
    }

    notify(msg, type) {
        const colors = {
            error: 'bg-red-100 border-red-200 text-red-800',
            warning: 'bg-yellow-100 border-yellow-200 text-yellow-800',
            info: 'bg-blue-100 border-blue-200 text-blue-800'
        };
        const div = document.createElement('div');
        div.className = `fixed top-4 right-4 p-4 rounded-lg border ${colors[type] || colors.info} z-50`;
        div.textContent = msg;
        document.body.appendChild(div);
        setTimeout(() => div.remove(), 3000);
    }
}

document.addEventListener('DOMContentLoaded', () => new ExamDashboard());
</script>

@include('exam.dashboard.layouts.footer')
