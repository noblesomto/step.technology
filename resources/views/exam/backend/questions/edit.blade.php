@include('exam.backend.layouts.head-section')
<script src="{{ asset('backend/js/jquery.min.js') }}"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<main class="bg-grey-100 px-6 pb-20 flex-grow">
    <div class="container mx-auto p-1">

        @include('exam.backend.layouts.flash-message')

       <div class="container">
        <h1 class="text-2xl font-bold mb-4">{{ $title }}</h1>

        <form action="{{ route('questions.update', $question->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block font-medium">Question</label>
                <textarea name="question" rows="3" class="w-full border rounded px-3 py-2">{{ old('question', $question->question) }}</textarea>
                @error('question') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block font-medium">Answer 1</label>
                <input type="text" name="answer1" value="{{ old('answer1', $question->answer1) }}" class="w-full border rounded px-3 py-2">
                @error('answer1') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block font-medium">Answer 2</label>
                <input type="text" name="answer2" value="{{ old('answer2', $question->answer2) }}" class="w-full border rounded px-3 py-2">
                @error('answer2') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block font-medium">Answer 3</label>
                <input type="text" name="answer3" value="{{ old('answer3', $question->answer3) }}" class="w-full border rounded px-3 py-2">
                @error('answer3') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block font-medium">Correct Answer</label>
                <input type="text" name="correct_answer" value="{{ old('correct_answer', $question->correct_answer) }}" class="w-full border rounded px-3 py-2">
                @error('correct_answer') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-2 rounded">
                Update Question
            </button>
        </form>
    </div>
  
    </div>
</main>


		@include('exam.backend.layouts.footer')
    </div>
</div>
