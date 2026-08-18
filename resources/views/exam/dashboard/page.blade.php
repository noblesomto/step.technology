<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam Dashboard</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <style>
        /* Custom Radio Button Styles */
        .custom-radio {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            width: 1.125rem;
            height: 1.125rem;
            border: 2px solid #e2e8f0;
            border-radius: 50%;
            outline: none;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            background: white;
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
            background-color: white;
            border-radius: 50%;
        }

        .custom-radio:focus {
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
        }

        /* Answer Option Styles */
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

        /* Button Animations */
        .btn-primary {
            transition: all 0.2s ease;
            transform: translateY(0);
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
        }

        .btn-secondary {
            transition: all 0.2s ease;
            transform: translateY(0);
        }

        .btn-secondary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(107, 114, 128, 0.4);
        }

        /* Progress Bar Animation */
        .progress-bar {
            transition: width 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Fade Transition */
        .fade-transition {
            transition: opacity 0.3s ease;
        }

        /* Card Shadow */
        .exam-card {
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        /* Success Message Animation */
        .success-message {
            animation: fadeInUp 0.5s ease;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <main class="px-6 py-8">
        <div class="container mx-auto max-w-4xl">
            <!-- Header -->
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold text-gray-800 mb-2">Exam Dashboard</h1>
                <p class="text-gray-600">Complete all questions to submit your exam</p>
            </div>

            <!-- Main Exam Card -->
            <div class="bg-white rounded-xl shadow-xl exam-card overflow-hidden">
                <!-- Progress Section -->
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-6 border-b border-gray-100">
                    <div class="flex items-center justify-between mb-3">
                        <h2 class="text-lg font-semibold text-gray-700">Progress</h2>
                        <span id="question-counter" class="text-sm font-medium text-gray-600 bg-white px-3 py-1 rounded-full">
                            Question 1 of 6
                        </span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
                        <div id="progress-bar" class="bg-gradient-to-r from-blue-500 to-indigo-500 h-full rounded-full progress-bar" style="width: 16.67%;"></div>
                    </div>
                </div>

                <!-- Question Content -->
                <div class="p-8">
                    <div id="question-container" class="fade-transition">
                        <!-- Questions will be dynamically inserted here -->
                    </div>

                    <!-- Navigation -->
                    <div class="flex justify-between items-center mt-8 pt-6 border-t border-gray-100">
                        <button id="prev-button" class="btn-secondary bg-gray-500 hover:bg-gray-600 text-white font-medium px-6 py-3 rounded-lg disabled:opacity-50 disabled:cursor-not-allowed hidden">
                            ← Previous
                        </button>
                        <div class="flex-1"></div>
                        <button id="next-button" class="btn-primary bg-blue-600 hover:bg-blue-700 text-white font-medium px-8 py-3 rounded-lg">
                            Next →
                        </button>
                    </div>
                </div>

                <!-- Results Section -->
                <div id="result-container" class="hidden p-8 text-center bg-gradient-to-r from-green-50 to-emerald-50">
                    <div class="max-w-md mx-auto">
                        <div class="mb-6">
                            <div class="text-6xl text-green-500 mb-4">🎉</div>
                            <h2 class="text-2xl font-bold text-gray-800 mb-2">Exam Complete!</h2>
                            <p class="text-gray-600">You have successfully completed the exam</p>
                        </div>

                        <div class="bg-white rounded-xl p-6 mb-6 shadow-sm">
                            <h3 class="text-lg font-semibold text-gray-700 mb-2">Your Score</h3>
                            <div class="text-4xl font-bold text-blue-600">
                                <span id="score">0</span><span class="text-2xl text-gray-400">/6</span>
                            </div>
                            <div class="text-sm text-gray-500 mt-2">
                                <span id="percentage">0%</span> correct
                            </div>
                        </div>

                        <button id="submit-score" class="btn-primary bg-green-600 hover:bg-green-700 text-white font-medium px-8 py-3 rounded-lg w-full">
                            Submit Score
                        </button>

                        <div id="submission-message" class="hidden success-message mt-4 p-4 bg-green-100 border border-green-200 rounded-lg">
                            <div class="flex items-center justify-center">
                                <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-green-800 font-medium">Score submitted successfully!</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Enhanced Exam Dashboard Class
        class ExamDashboard {
            constructor() {
                // Sample questions data - replace with your Laravel data
                this.questions = [
                    {
                        question: "What is the capital of France?",
                        answer1: "London",
                        answer2: "Berlin",
                        answer3: "Madrid",
                        correct_answer: "Paris"
                    },
                    {
                        question: "Which programming language is known as the 'language of the web'?",
                        answer1: "Python",
                        answer2: "Java",
                        answer3: "C++",
                        correct_answer: "JavaScript"
                    },
                    {
                        question: "What does HTML stand for?",
                        answer1: "High Tech Markup Language",
                        answer2: "Home Tool Markup Language",
                        answer3: "Hyperlinks and Text Markup Language",
                        correct_answer: "HyperText Markup Language"
                    },
                    {
                        question: "Which company developed the React framework?",
                        answer1: "Google",
                        answer2: "Microsoft",
                        answer3: "Apple",
                        correct_answer: "Facebook"
                    },
                    {
                        question: "What is the time complexity of binary search?",
                        answer1: "O(n)",
                        answer2: "O(n²)",
                        answer3: "O(n log n)",
                        correct_answer: "O(log n)"
                    },
                    {
                        question: "Which CSS property is used to change the text color?",
                        answer1: "font-color",
                        answer2: "text-style",
                        answer3: "background-color",
                        correct_answer: "color"
                    }
                ];

                this.currentQuestionIndex = 0;
                this.totalQuestions = this.questions.length;
                this.selectedAnswers = new Array(this.totalQuestions).fill(null);

                this.initializeElements();
                this.attachEventListeners();
                this.displayQuestion();
            }

            initializeElements() {
                this.questionContainer = document.getElementById('question-container');
                this.progressBar = document.getElementById('progress-bar');
                this.questionCounter = document.getElementById('question-counter');
                this.prevButton = document.getElementById('prev-button');
                this.nextButton = document.getElementById('next-button');
                this.resultContainer = document.getElementById('result-container');
                this.scoreElement = document.getElementById('score');
                this.percentageElement = document.getElementById('percentage');
                this.submitButton = document.getElementById('submit-score');
                this.submissionMessage = document.getElementById('submission-message');
            }

            attachEventListeners() {
                this.prevButton.addEventListener('click', () => this.navigatePrevious());
                this.nextButton.addEventListener('click', () => this.navigateNext());
                this.submitButton.addEventListener('click', () => this.submitScore());
            }

            updateProgress() {
                const progress = ((this.currentQuestionIndex + 1) / this.totalQuestions) * 100;
                this.progressBar.style.width = `${progress}%`;
                this.questionCounter.textContent = `Question ${this.currentQuestionIndex + 1} of ${this.totalQuestions}`;
            }

            displayQuestion() {
                const question = this.questions[this.currentQuestionIndex];
                const answers = this.shuffleAnswers([
                    question.answer1,
                    question.answer2,
                    question.answer3,
                    question.correct_answer
                ]);

                this.questionContainer.innerHTML = `
                    <div class="mb-8">
                        <h3 class="text-xl font-semibold text-gray-800 leading-relaxed mb-6">
                            ${question.question}
                        </h3>
                        <div class="space-y-3">
                            ${answers.map((answer, index) => `
                                <label class="answer-option flex items-start p-4 rounded-lg cursor-pointer ${this.selectedAnswers[this.currentQuestionIndex] === answer ? 'selected' : ''}">
                                    <input type="radio"
                                           name="answer"
                                           value="${answer}"
                                           class="custom-radio mt-0.5 mr-4"
                                           ${this.selectedAnswers[this.currentQuestionIndex] === answer ? 'checked' : ''}>
                                    <span class="text-gray-700 font-medium flex-1">${answer}</span>
                                </label>
                            `).join('')}
                        </div>
                    </div>
                `;

                this.updateProgress();
                this.updateNavigation();
                this.attachAnswerListeners();
            }

            attachAnswerListeners() {
                const answerOptions = this.questionContainer.querySelectorAll('.answer-option');
                const radioButtons = this.questionContainer.querySelectorAll('input[name="answer"]');

                answerOptions.forEach((option, index) => {
                    option.addEventListener('click', () => {
                        answerOptions.forEach(opt => opt.classList.remove('selected'));
                        option.classList.add('selected');
                    });
                });

                radioButtons.forEach(radio => {
                    radio.addEventListener('change', (e) => {
                        this.selectedAnswers[this.currentQuestionIndex] = e.target.value;
                    });
                });
            }

            shuffleAnswers(answers) {
                const shuffled = [...answers];
                for (let i = shuffled.length - 1; i > 0; i--) {
                    const j = Math.floor(Math.random() * (i + 1));
                    [shuffled[i], shuffled[j]] = [shuffled[j], shuffled[i]];
                }
                return shuffled;
            }

            updateNavigation() {
                // Previous button visibility
                if (this.currentQuestionIndex === 0) {
                    this.prevButton.classList.add('hidden');
                } else {
                    this.prevButton.classList.remove('hidden');
                }

                // Next button text
                if (this.currentQuestionIndex === this.totalQuestions - 1) {
                    this.nextButton.innerHTML = 'Submit Exam →';
                    this.nextButton.classList.remove('bg-blue-600', 'hover:bg-blue-700');
                    this.nextButton.classList.add('bg-green-600', 'hover:bg-green-700');
                } else {
                    this.nextButton.innerHTML = 'Next →';
                    this.nextButton.classList.remove('bg-green-600', 'hover:bg-green-700');
                    this.nextButton.classList.add('bg-blue-600', 'hover:bg-blue-700');
                }
            }

            navigatePrevious() {
                if (this.currentQuestionIndex > 0) {
                    this.currentQuestionIndex--;
                    this.displayQuestion();
                }
            }

            navigateNext() {
                const selectedAnswer = document.querySelector('input[name="answer"]:checked');

                if (!selectedAnswer) {
                    this.showAlert('Please select an answer before continuing!', 'warning');
                    return;
                }

                this.selectedAnswers[this.currentQuestionIndex] = selectedAnswer.value;

                if (this.currentQuestionIndex < this.totalQuestions - 1) {
                    this.currentQuestionIndex++;
                    this.displayQuestion();
                } else {
                    this.showResults();
                }
            }

            calculateScore() {
                return this.selectedAnswers.reduce((score, answer, index) => {
                    return score + (answer === this.questions[index].correct_answer ? 1 : 0);
                }, 0);
            }

            showResults() {
                const score = this.calculateScore();
                const percentage = Math.round((score / this.totalQuestions) * 100);

                // Hide question container and navigation
                this.questionContainer.parentElement.classList.add('hidden');

                // Show results
                this.resultContainer.classList.remove('hidden');
                this.scoreElement.textContent = score;
                this.percentageElement.textContent = `${percentage}%`;
            }

            async submitScore() {
                try {
                    const score = this.calculateScore();

                    // Simulate API call - replace with actual Laravel endpoint
                    const response = await fetch('/user/store-score', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                        },
                        body: JSON.stringify({ score })
                    });

                    // For demo purposes, simulate success
                    setTimeout(() => {
                        this.submitButton.classList.add('hidden');
                        this.submissionMessage.classList.remove('hidden');
                    }, 1000);

                } catch (error) {
                    console.error('Submission error:', error);
                    this.showAlert('Failed to submit score. Please try again.', 'error');
                }
            }

            showAlert(message, type = 'info') {
                // Simple alert for demo - you can enhance this with better notifications
                const alertClass = type === 'error' ? 'bg-red-100 border-red-200 text-red-800' :
                                  type === 'warning' ? 'bg-yellow-100 border-yellow-200 text-yellow-800' :
                                  'bg-blue-100 border-blue-200 text-blue-800';

                const alertDiv = document.createElement('div');
                alertDiv.className = `fixed top-4 right-4 p-4 rounded-lg border ${alertClass} z-50`;
                alertDiv.textContent = message;

                document.body.appendChild(alertDiv);

                setTimeout(() => {
                    alertDiv.remove();
                }, 3000);
            }
        }

        // Initialize the exam dashboard when the page loads
        document.addEventListener('DOMContentLoaded', () => {
            new ExamDashboard();
        });
    </script>
</body>
</html>
