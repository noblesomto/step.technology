@include('backend.layouts.tailwind.header')
@include('backend.layouts.tailwind.nav', ['active' => 'questions'])

<div class="mb-6">
    <h1 class="font-step-heading font-bold text-2xl text-gray-900">Edit Question</h1>
</div>

<div class="bg-white rounded-lg border border-gray-200 p-6 sm:p-8 max-w-2xl">
    <form action="/admin/questions/{{ $question->id }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Question</label>
            @if ($errors->has('question')) <span class="block text-red-600 text-sm mb-1">{{ $errors->first('question') }}</span> @endif
            <textarea name="question" rows="3" required class="w-full rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm px-3 py-2.5">{{ $question->question }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Answer 1</label>
            @if ($errors->has('answer1')) <span class="block text-red-600 text-sm mb-1">{{ $errors->first('answer1') }}</span> @endif
            <input type="text" name="answer1" value="{{ $question->answer1 }}" required class="w-full h-11 rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm px-3">
        </div>
        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Answer 2</label>
            @if ($errors->has('answer2')) <span class="block text-red-600 text-sm mb-1">{{ $errors->first('answer2') }}</span> @endif
            <input type="text" name="answer2" value="{{ $question->answer2 }}" required class="w-full h-11 rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm px-3">
        </div>
        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Answer 3</label>
            @if ($errors->has('answer3')) <span class="block text-red-600 text-sm mb-1">{{ $errors->first('answer3') }}</span> @endif
            <input type="text" name="answer3" value="{{ $question->answer3 }}" required class="w-full h-11 rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm px-3">
        </div>
        <div class="mb-6">
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Correct Answer</label>
            @if ($errors->has('correct_answer')) <span class="block text-red-600 text-sm mb-1">{{ $errors->first('correct_answer') }}</span> @endif
            <input type="text" name="correct_answer" value="{{ $question->correct_answer }}" required class="w-full h-11 rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm px-3">
        </div>

        <button type="submit" class="bg-step-primary text-white font-step-heading font-semibold px-6 py-2.5 rounded-full hover:bg-step-accent transition-colors">Update</button>
    </form>
</div>

@include('backend.layouts.tailwind.footer')
