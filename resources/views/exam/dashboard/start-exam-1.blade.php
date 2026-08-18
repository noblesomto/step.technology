@include('exam.dashboard.layouts.header-section')
<style>
        /* Custom styles for filled radio buttons */
        input[type="radio"] {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            width: 1.25rem;
            height: 1.25rem;
            border: 2px solid #4a5568; /* Gray border */
            border-radius: 50%;
            outline: none;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        input[type="radio"]:checked {
            background-color: #3b82f6; /* Blue fill */
            border-color: #3b82f6; /* Blue border */
        }

        input[type="radio"]:checked::after {
            content: '';
            display: block;
            width: 0.75rem;
            height: 0.75rem;
            background-color: white; /* White dot */
            border-radius: 50%;
            margin: 2px;
        }
    </style>
	<main class="bg-grey-100 px-6 pb-20 flex-grow">
            <div class="container mx-auto p-1">
		        <h1 class="text-3xl font-bold my-3">Exam Dashboard</h1>
		        @include('exam.dashboard.layouts.flash-message')

		      
                <div class="bg-white p-10 rounded-lg shadow-lg max-w-4xl mx-auto ">
                    <!-- Progress Bar -->
                    <div class="mb-4">
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                            <div id="progress-bar" class="bg-blue-600 h-2.5 rounded-full transition-all duration-500 ease-in-out" style="width: 0%;"></div>
                        </div>
                        <p class="text-sm text-gray-600 mt-1">Question <span id="current-question">1</span> of 6</p>
                    </div>

                    <!-- Question Container -->
                    <div id="question-container">
                        <!-- Question and answers will be dynamically inserted here -->
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="flex justify-between mt-4">
                        <button id="prev-button" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-800 hidden">Previous</button>
                        <button id="next-button" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-800">Next</button>
                    </div>

                    <!-- Result Container -->
                    <div id="result-container" class="hidden">
                        <h2 class="text-xl font-bold">Your Score: <span id="score"></span>/6</h2>
                        <button id="submit-score" class="mt-4 bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Submit Score</button>
                        <p id="submission-message" class="text-green-600 mt-2 hidden">Score submitted successfully!</p>
                    </div>
                </div>
		       
		    </div>
        </main>
     
        <script>
        // Pass Laravel data to JavaScript
  // Pass Laravel data to JavaScript
const questions = @json($questions);

let currentQuestionIndex = 0;
const totalQuestions = questions.length;
const selectedAnswers = new Array(totalQuestions).fill(null); // Track selected answers

// Function to update the progress bar and question number
function updateProgress() {
    const progress = ((currentQuestionIndex + 1) / totalQuestions) * 100;
    document.getElementById("progress-bar").style.width = `${progress}%`;
    document.getElementById("current-question").textContent = currentQuestionIndex + 1;
}

// Function to display the current question
function displayQuestion() {
    const questionContainer = document.getElementById("question-container");
    const question = questions[currentQuestionIndex];

    // Shuffle the answers
    const answers = [question.answer1, question.answer2, question.answer3, question.correct_answer];
    const shuffledAnswers = shuffleArray(answers);

    // Display the question and shuffled answers
    questionContainer.innerHTML = `
        <h2 class="text-lg font-semibold mb-4">${question.question}</h2>
        ${shuffledAnswers.map(answer => `
            <label class="flex items-center space-x-2 mb-2"">
                <input type="radio" name="answer" value="${answer}" class="mr-2"
                    ${selectedAnswers[currentQuestionIndex] === answer ? 'checked' : ''}>
                ${answer}
            </label>
        `).join("")}
    `;

    // Update progress
    updateProgress();

    // Show/hide navigation buttons
    document.getElementById("prev-button").style.display = currentQuestionIndex === 0 ? "none" : "block";
    document.getElementById("next-button").textContent = currentQuestionIndex === totalQuestions - 1 ? "Submit" : "Next";
}

// Function to shuffle an array (Fisher-Yates algorithm)
function shuffleArray(array) {
    for (let i = array.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]];
    }
    return array;
}

// Function to navigate to the previous question
function prevQuestion() {
    if (currentQuestionIndex > 0) {
        currentQuestionIndex--;
        displayQuestion();
    }
}

// Function to navigate to the next question
function nextQuestion() {
    const selectedAnswer = document.querySelector('input[name="answer"]:checked');
    if (selectedAnswer) {
        // Store the selected answer
        selectedAnswers[currentQuestionIndex] = selectedAnswer.value;

        currentQuestionIndex++;
        if (currentQuestionIndex < totalQuestions) {
            displayQuestion();
        } else {
            // Calculate the final score
            const score = selectedAnswers.reduce((acc, answer, index) => {
                return acc + (answer === questions[index].correct_answer ? 1 : 0);
            }, 0);

            // Show the final score and hide the previous button
            document.getElementById("question-container").classList.add("hidden");
            document.getElementById("prev-button").classList.add("hidden");
            document.getElementById("next-button").classList.add("hidden");
            document.getElementById("result-container").classList.remove("hidden");
            document.getElementById("score").textContent = score;
        }
    } else {
        alert("Please select an answer!");
    }
}

// Event listeners for navigation buttons
document.getElementById("prev-button").addEventListener("click", prevQuestion);
document.getElementById("next-button").addEventListener("click", nextQuestion);

// Event listener for submitting the score
document.getElementById("submit-score").addEventListener("click", async () => {
    try {
        const score = selectedAnswers.reduce((acc, answer, index) => {
            return acc + (answer === questions[index].correct_answer ? 1 : 0);
        }, 0);

        const response = await fetch('/user/store-score', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ score })
        });
        const result = await response.json();
        if (result.success) {
            // Hide the submit button and show the score
            document.getElementById("submit-score").classList.add("hidden");
            document.getElementById("submission-message").classList.remove("hidden");
            document.getElementById("score").textContent = score;
        } else {
            alert("Failed to submit score.");
        }
    } catch (error) {
        console.error("Error:", error);
        alert("An error occurred while submitting the score.");
    }
});

// Display the first question on page load
displayQuestion();
    </script>

		@include('exam.dashboard.layouts.footer')
    </div>
</div>

