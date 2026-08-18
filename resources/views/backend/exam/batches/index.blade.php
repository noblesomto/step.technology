@include('backend.layouts.tailwind.header')
@include('backend.layouts.tailwind.nav', ['active' => 'enrollments'])

<div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
        <h1 class="font-step-heading font-bold text-2xl text-gray-900">Exam Sittings</h1>
        <nav class="text-sm text-gray-500 mt-1">
            <a href="/admin/index" class="hover:text-step-primary">Home</a>
            <span class="mx-1">/</span>
            <a href="/admin/enrollments" class="hover:text-step-primary">Exam Enrollments</a>
            <span class="mx-1">/</span>
            <span class="text-step-primary">Sittings</span>
        </nav>
    </div>
    <a href="/admin/exam-batches/create" class="inline-flex items-center gap-2 bg-step-primary text-white text-sm font-step-heading font-semibold px-4 py-2.5 rounded-full hover:bg-step-accent transition-colors">
        <i class="fa fa-plus"></i> New Sitting
    </a>
</div>

@if (session('status'))
    <div class="mb-6 rounded-md px-4 py-3 text-sm {{ session('status')['type'] === 'success' ? 'bg-green-50 text-green-700 border border-green-200' : 'bg-red-50 text-red-700 border border-red-200' }}">
        {{ session('status')['text'] }}
    </div>
@endif

<div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="bg-gray-50 text-gray-500 uppercase text-xs">
                <tr>
                    <th class="px-4 py-3">Name</th>
                    <th class="px-4 py-3">Window</th>
                    <th class="px-4 py-3">Submissions</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($batches as $batch)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 font-medium text-gray-900">{{ $batch->name }}</td>
                        <td class="px-4 py-3 text-gray-600">
                            {{ $batch->starts_at?->format('j M Y') ?? '—' }} &ndash; {{ $batch->ends_at?->format('j M Y') ?? '—' }}
                        </td>
                        <td class="px-4 py-3 text-gray-600">
                            <a href="/admin/enrollments?batch={{ $batch->id }}" class="hover:text-step-primary">{{ $batch->scores_count }}</a>
                        </td>
                        <td class="px-4 py-3">
                            @if ($batch->is_active)
                                <span class="inline-block bg-green-50 text-green-700 text-xs font-semibold px-2.5 py-1 rounded-full">Open</span>
                            @else
                                <span class="inline-block bg-gray-100 text-gray-600 text-xs font-semibold px-2.5 py-1 rounded-full">Closed</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center justify-end gap-3">
                                @if ($batch->is_active)
                                    <form action="/admin/exam-batches/{{ $batch->id }}/deactivate" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="text-yellow-600 hover:text-yellow-700 text-xs font-semibold">Close</button>
                                    </form>
                                @else
                                    <form action="/admin/exam-batches/{{ $batch->id }}/activate" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="text-green-600 hover:text-green-700 text-xs font-semibold">Open</button>
                                    </form>
                                @endif
                                <a href="/admin/exam-batches/{{ $batch->id }}/edit" class="text-gray-400 hover:text-step-primary" title="Edit"><i class="fa fa-pencil"></i></a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-10 text-center text-gray-400">No exam sittings yet — create the first one to open registration.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-6">
    {{ $batches->links('pagination::tailwind') }}
</div>

@include('backend.layouts.tailwind.footer')
