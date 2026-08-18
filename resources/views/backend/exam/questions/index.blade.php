@include('backend.layouts.tailwind.header')
@include('backend.layouts.tailwind.nav', ['active' => 'questions'])

<div class="mb-6 flex items-center justify-between">
    <h1 class="font-step-heading font-bold text-2xl text-gray-900">All Questions</h1>
    <a href="/admin/questions/new" class="bg-step-primary text-white font-step-heading font-semibold text-sm px-5 py-2.5 rounded-full hover:bg-step-accent transition-colors">
        <i class="fa fa-plus"></i> New Question
    </a>
</div>

@if (session('success'))
    <div class="mb-6 rounded-md px-4 py-3 text-sm bg-green-50 text-green-700 border border-green-200">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="bg-gray-50 text-gray-500 uppercase text-xs">
                <tr>
                    <th class="px-4 py-3">Question</th>
                    <th class="px-4 py-3">Correct Answer</th>
                    <th class="px-4 py-3">Edit</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach ($questions as $q)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 text-gray-900">{{ Str::limit($q->question, 80) }}</td>
                        <td class="px-4 py-3 text-green-600 font-medium">{{ $q->correct_answer }}</td>
                        <td class="px-4 py-3"><a href="/admin/questions/{{ $q->id }}/edit" class="text-step-primary hover:text-step-accent">Edit</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="mt-6">
    {{ $questions->links('pagination::tailwind') }}
</div>

@include('backend.layouts.tailwind.footer')
