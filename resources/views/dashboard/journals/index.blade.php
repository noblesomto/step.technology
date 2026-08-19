@include('dashboard.layouts.tailwind.header')
@include('dashboard.layouts.tailwind.nav', ['active' => 'journals'])

<div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <h1 class="font-step-heading font-bold text-2xl text-gray-900">My Journals</h1>
    <a href="/user/journals/create" class="inline-flex items-center gap-2 bg-step-primary text-white text-sm font-step-heading font-semibold px-5 py-2.5 rounded-full hover:bg-step-accent transition-colors">
        <i class="fa fa-plus"></i> Submit Journal
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
                    <th class="px-4 py-3">Title</th>
                    <th class="px-4 py-3">Category</th>
                    <th class="px-4 py-3">Submitted</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($journals as $journal)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-3">
                                <img src="{{ asset('uploads/thumbnails/'.$journal->feature_image) }}" alt="" class="w-12 h-12 rounded object-cover shrink-0">
                                <span class="font-medium text-gray-900">{{ $journal->title }}</span>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-gray-600">{{ $journal->category ?: '—' }}</td>
                        <td class="px-4 py-3 text-gray-500">{{ $journal->created_at->format('j M Y') }}</td>
                        <td class="px-4 py-3">
                            @if ($journal->status === 'approved')
                                <span class="inline-block bg-green-50 text-green-700 text-xs font-semibold px-2.5 py-1 rounded-full">Approved</span>
                            @elseif ($journal->status === 'rejected')
                                <span class="inline-block bg-red-50 text-red-700 text-xs font-semibold px-2.5 py-1 rounded-full">Rejected</span>
                            @else
                                <span class="inline-block bg-yellow-50 text-yellow-700 text-xs font-semibold px-2.5 py-1 rounded-full">Pending Review</span>
                            @endif
                            @if ($journal->status === 'rejected' && $journal->admin_notes)
                                <p class="text-xs text-gray-500 mt-1 max-w-xs">{{ $journal->admin_notes }}</p>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center justify-end gap-3">
                                @if ($journal->status === 'approved')
                                    <a href="/journal-publication/{{ $journal->id }}/{{ $journal->slug }}" target="_blank" class="text-gray-400 hover:text-step-primary" title="View live"><i class="fa fa-external-link"></i></a>
                                @else
                                    <a href="/user/journals/{{ $journal->id }}/edit" class="text-gray-400 hover:text-step-primary" title="Edit"><i class="fa fa-pencil"></i></a>
                                @endif
                                <form action="/user/journals/{{ $journal->id }}" method="POST" onsubmit="return confirm('Delete this journal submission?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-gray-400 hover:text-red-600" title="Delete"><i class="fa fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-10 text-center text-gray-400">You haven't submitted any journals yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-6">
    {{ $journals->links('pagination::tailwind') }}
</div>

@include('dashboard.layouts.tailwind.footer')
