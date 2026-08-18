@include('exam.backend.layouts.head-section')
<script src="{{ asset('backend/js/jquery.min.js') }}"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<main class="bg-grey-100 px-6 pb-20 flex-grow">
    <div class="container mx-auto p-1">

        @include('exam.backend.layouts.flash-message')

   <div class="container">
    <h1 class="text-2xl font-bold mb-4">{{ $title }}</h1>

        @if(session('success'))
            <div class="bg-green-100 border border-green-200 text-green-700 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <table class="table-auto w-full border border-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border">#</th>
                    <th class="px-4 py-2 border">Question</th>
                    <th class="px-4 py-2 border">Correct Answer</th>
                    <th class="px-4 py-2 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($questions as $q)
                    <tr>
                        <td class="px-4 py-2 border">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2 border">{{ Str::limit($q->question, 50) }}</td>
                        <td class="px-4 py-2 border">{{ $q->correct_answer }}</td>
                        <td class="px-4 py-2 border">
                            <a href="{{ route('questions.edit', $q->id) }}" class="text-blue-600 hover:underline">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $questions->links() }}
        </div>
    </div>
  
    </div>
</main>


		@include('exam.backend.layouts.footer')
    </div>
</div>
