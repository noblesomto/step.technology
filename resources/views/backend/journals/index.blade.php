@include('backend.layouts.tailwind.header')
@include('backend.layouts.tailwind.nav', ['active' => 'journals'])

<div class="mb-6">
    <h1 class="font-step-heading font-bold text-2xl text-gray-900">Journal Submissions</h1>
    <nav class="text-sm text-gray-500 mt-1">
        <a href="/admin/index" class="hover:text-step-primary">Home</a>
        <span class="mx-1">/</span>
        <span class="text-step-primary">Journals</span>
    </nav>
</div>

@if (session('status'))
    <div class="mb-6 rounded-md px-4 py-3 text-sm {{ session('status')['type'] === 'success' ? 'bg-green-50 text-green-700 border border-green-200' : 'bg-red-50 text-red-700 border border-red-200' }}">
        {{ session('status')['text'] }}
    </div>
@endif

{{-- Status tabs --}}
<div class="mb-6 flex flex-wrap gap-2">
    <a href="/admin/journals?status=pending" class="text-sm font-step-heading font-semibold px-4 py-2 rounded-full {{ $status === 'pending' ? 'bg-step-primary text-white' : 'bg-white border border-gray-200 text-gray-600 hover:border-step-primary' }}">
        Pending <span class="opacity-70">({{ $counts['pending'] }})</span>
    </a>
    <a href="/admin/journals?status=approved" class="text-sm font-step-heading font-semibold px-4 py-2 rounded-full {{ $status === 'approved' ? 'bg-step-primary text-white' : 'bg-white border border-gray-200 text-gray-600 hover:border-step-primary' }}">
        Approved <span class="opacity-70">({{ $counts['approved'] }})</span>
    </a>
    <a href="/admin/journals?status=rejected" class="text-sm font-step-heading font-semibold px-4 py-2 rounded-full {{ $status === 'rejected' ? 'bg-step-primary text-white' : 'bg-white border border-gray-200 text-gray-600 hover:border-step-primary' }}">
        Rejected <span class="opacity-70">({{ $counts['rejected'] }})</span>
    </a>
    <a href="/admin/journals?status=" class="text-sm font-step-heading font-semibold px-4 py-2 rounded-full {{ $status === '' ? 'bg-step-primary text-white' : 'bg-white border border-gray-200 text-gray-600 hover:border-step-primary' }}">
        All
    </a>
</div>

<form method="GET" class="mb-6 flex gap-3">
    <input type="hidden" name="status" value="{{ $status }}">
    <div class="relative flex-1 max-w-sm">
        <input type="text" name="search" value="{{ $search }}" placeholder="Search title or author" class="w-full h-11 rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm pl-10 pr-3">
        <i class="fa fa-search absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
    </div>
    <button type="submit" class="bg-step-primary text-white font-step-heading font-semibold text-sm px-6 py-2.5 rounded-full hover:bg-step-accent transition-colors">Search</button>
</form>

<div x-data="{ selected: [] }">
    <form action="/admin/journals/bulk-status" method="POST" id="bulk-form">
        @csrf

        <div x-show="selected.length > 0" x-transition x-cloak class="mb-4 flex items-center justify-between bg-step-primary/5 border border-step-primary/20 rounded-lg px-4 py-3">
            <p class="text-sm font-step-heading font-semibold text-step-primary"><span x-text="selected.length"></span> selected</p>
            <div class="flex gap-2">
                <button type="submit" name="bulk_status" value="approved" class="bg-green-600 text-white text-xs font-step-heading font-semibold px-4 py-2 rounded-full hover:bg-green-700">Approve Selected</button>
                <button type="submit" name="bulk_status" value="rejected" class="bg-red-600 text-white text-xs font-step-heading font-semibold px-4 py-2 rounded-full hover:bg-red-700">Reject Selected</button>
                <button type="submit" name="bulk_status" value="pending" class="bg-yellow-600 text-white text-xs font-step-heading font-semibold px-4 py-2 rounded-full hover:bg-yellow-700">Set Pending</button>
            </div>
        </div>

        <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 text-gray-500 uppercase text-xs">
                        <tr>
                            <th class="px-4 py-3 w-10">
                                <input type="checkbox" @change="selected = $event.target.checked ? [{{ $journals->pluck('id')->implode(',') }}] : []" class="rounded border-gray-300 text-step-primary focus:ring-step-primary">
                            </th>
                            <th class="px-4 py-3">Title</th>
                            <th class="px-4 py-3">Author</th>
                            <th class="px-4 py-3">Category</th>
                            <th class="px-4 py-3">Submitted</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($journals as $journal)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3">
                                    <input type="checkbox" name="journal_ids[]" value="{{ $journal->id }}" x-model="selected" class="rounded border-gray-300 text-step-primary focus:ring-step-primary">
                                </td>
                                <td class="px-4 py-3">
                                    <a href="/admin/journals/{{ $journal->id }}" class="font-medium text-gray-900 hover:text-step-primary">{{ Str::limit($journal->title, 50) }}</a>
                                </td>
                                <td class="px-4 py-3 text-gray-600">{{ $journal->author?->first_name }} {{ $journal->author?->last_name }}</td>
                                <td class="px-4 py-3 text-gray-500">{{ $journal->category ?: '—' }}</td>
                                <td class="px-4 py-3 text-gray-500">{{ $journal->created_at->format('j M Y') }}</td>
                                <td class="px-4 py-3">
                                    @if ($journal->status === 'approved')
                                        <span class="inline-block bg-green-50 text-green-700 text-xs font-semibold px-2.5 py-1 rounded-full">Approved</span>
                                    @elseif ($journal->status === 'rejected')
                                        <span class="inline-block bg-red-50 text-red-700 text-xs font-semibold px-2.5 py-1 rounded-full">Rejected</span>
                                    @else
                                        <span class="inline-block bg-yellow-50 text-yellow-700 text-xs font-semibold px-2.5 py-1 rounded-full">Pending</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center justify-end gap-3">
                                        <a href="/admin/journals/{{ $journal->id }}" class="text-gray-400 hover:text-step-primary" title="Review"><i class="fa fa-eye"></i></a>
                                        <form action="/admin/journals/{{ $journal->id }}" method="POST" onsubmit="return confirm('Delete this journal?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-gray-400 hover:text-red-600" title="Delete"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-4 py-10 text-center text-gray-400">No journals found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </form>
</div>

<div class="mt-6">
    {{ $journals->links('pagination::tailwind') }}
</div>

@include('backend.layouts.tailwind.footer')
