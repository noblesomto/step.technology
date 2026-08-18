@include('backend.layouts.tailwind.header')
@include('backend.layouts.tailwind.nav', ['active' => 'enrollments'])

<div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
        <h1 class="font-step-heading font-bold text-2xl text-gray-900">Exam Enrollments</h1>
        <nav class="text-sm text-gray-500 mt-1">
            <a href="/admin/index" class="hover:text-step-primary">Home</a>
            <span class="mx-1">/</span>
            <span class="text-step-primary">Exam Enrollments</span>
        </nav>
    </div>
    <div class="flex flex-wrap items-center gap-2">
        <a href="/admin/exam-batches" class="inline-flex items-center gap-2 bg-white border border-gray-200 text-gray-700 text-sm font-step-heading font-semibold px-4 py-2.5 rounded-full hover:border-step-primary hover:text-step-primary transition-colors">
            <i class="fa fa-calendar"></i> Manage Sittings
        </a>
        <a href="/admin/enrollments/export/excel?batch={{ $batchId }}" class="inline-flex items-center gap-2 bg-white border border-gray-200 text-gray-700 text-sm font-step-heading font-semibold px-4 py-2.5 rounded-full hover:border-step-primary hover:text-step-primary transition-colors">
            <i class="fa fa-file-excel-o"></i> Excel
        </a>
        <a href="/admin/enrollments/export/pdf?batch={{ $batchId }}" class="inline-flex items-center gap-2 bg-white border border-gray-200 text-gray-700 text-sm font-step-heading font-semibold px-4 py-2.5 rounded-full hover:border-step-primary hover:text-step-primary transition-colors">
            <i class="fa fa-file-pdf-o"></i> PDF
        </a>
    </div>
</div>

@if (session('status'))
    <div class="mb-6 rounded-md px-4 py-3 text-sm {{ session('status')['type'] === 'success' ? 'bg-green-50 text-green-700 border border-green-200' : 'bg-red-50 text-red-700 border border-red-200' }}">
        {{ session('status')['text'] }}
    </div>
@endif

{{-- Batch (sitting) selector --}}
<div class="mb-6 flex flex-wrap gap-2">
    <a href="/admin/enrollments?batch=" class="text-sm font-step-heading font-semibold px-4 py-2 rounded-full {{ (string) $batchId === '' ? 'bg-step-primary text-white' : 'bg-white border border-gray-200 text-gray-600 hover:border-step-primary' }}">
        All Sittings
    </a>
    @foreach ($batches as $batch)
        <a href="/admin/enrollments?batch={{ $batch->id }}" class="text-sm font-step-heading font-semibold px-4 py-2 rounded-full flex items-center gap-2 {{ (string) $batchId === (string) $batch->id ? 'bg-step-primary text-white' : 'bg-white border border-gray-200 text-gray-600 hover:border-step-primary' }}">
            {{ $batch->name }}
            @if ($batch->is_active)
                <span class="w-1.5 h-1.5 rounded-full {{ (string) $batchId === (string) $batch->id ? 'bg-white' : 'bg-green-500' }}"></span>
            @endif
            <span class="opacity-70">({{ $batch->scores_count }})</span>
        </a>
    @endforeach
</div>

<form method="GET" class="mb-6 flex flex-col sm:flex-row gap-3">
    <input type="hidden" name="batch" value="{{ $batchId }}">
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name or email" class="w-full sm:max-w-xs h-11 rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm px-3">
    <select name="status" class="h-11 rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm px-3">
        <option value="">All Statuses</option>
        <option value="pending" @selected(request('status') === 'pending')>Pending</option>
        <option value="approved" @selected(request('status') === 'approved')>Approved</option>
    </select>
    <button type="submit" class="bg-step-primary text-white font-step-heading font-semibold text-sm px-6 py-2.5 rounded-full hover:bg-step-accent transition-colors">Filter</button>
</form>

<div x-data="{ selected: [] }">
    <form action="/admin/enrollments/bulk-status" method="POST" id="bulk-form">
        @csrf

        {{-- Bulk action bar --}}
        <div x-show="selected.length > 0" x-transition x-cloak class="mb-4 flex items-center justify-between bg-step-primary/5 border border-step-primary/20 rounded-lg px-4 py-3">
            <p class="text-sm font-step-heading font-semibold text-step-primary"><span x-text="selected.length"></span> selected</p>
            <div class="flex gap-2">
                <button type="submit" name="bulk_status" value="approved" class="bg-green-600 text-white text-xs font-step-heading font-semibold px-4 py-2 rounded-full hover:bg-green-700">Approve Selected</button>
                <button type="submit" name="bulk_status" value="pending" class="bg-yellow-600 text-white text-xs font-step-heading font-semibold px-4 py-2 rounded-full hover:bg-yellow-700">Set Pending</button>
            </div>
        </div>

        <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 text-gray-500 uppercase text-xs">
                        <tr>
                            <th class="px-4 py-3 w-10">
                                <input type="checkbox" @change="selected = $event.target.checked ? [{{ $usersWithScores->pluck('score_id')->implode(',') }}] : []" class="rounded border-gray-300 text-step-primary focus:ring-step-primary">
                            </th>
                            <th class="px-4 py-3">Name</th>
                            <th class="px-4 py-3">Email</th>
                            @if ((string) $batchId === '')
                                <th class="px-4 py-3">Sitting</th>
                            @endif
                            <th class="px-4 py-3">Score</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Updated</th>
                            <th class="px-4 py-3 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($usersWithScores as $row)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3">
                                    <input type="checkbox" name="score_ids[]" value="{{ $row->score_id }}" x-model="selected" class="rounded border-gray-300 text-step-primary focus:ring-step-primary">
                                </td>
                                <td class="px-4 py-3 font-medium text-gray-900">{{ $row->first_name }} {{ $row->last_name }}</td>
                                <td class="px-4 py-3 text-gray-600">{{ $row->email }}</td>
                                @if ((string) $batchId === '')
                                    <td class="px-4 py-3 text-gray-500">{{ $row->batch_name ?? '—' }}</td>
                                @endif
                                <td class="px-4 py-3 text-gray-600">{{ $row->score }}{{ $row->total_questions ? '/'.$row->total_questions : '' }}</td>
                                <td class="px-4 py-3">
                                    @if ($row->status === 'approved')
                                        <span class="inline-block bg-green-50 text-green-700 text-xs font-semibold px-2.5 py-1 rounded-full">Approved</span>
                                    @else
                                        <span class="inline-block bg-yellow-50 text-yellow-700 text-xs font-semibold px-2.5 py-1 rounded-full">Pending</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-gray-500">{{ \Illuminate\Support\Carbon::parse($row->exam_updated_at)->format('j M Y') }}</td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center justify-end gap-3">
                                        <a href="/admin/enrollments/{{ $row->score_id }}/edit" class="text-gray-400 hover:text-step-primary" title="Edit"><i class="fa fa-pencil"></i></a>
                                        <button type="submit" form="status-form-{{ $row->score_id }}" class="text-xs font-step-heading font-semibold {{ $row->status === 'approved' ? 'text-yellow-600 hover:text-yellow-700' : 'text-green-600 hover:text-green-700' }}">
                                            {{ $row->status === 'approved' ? 'Set Pending' : 'Approve' }}
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-4 py-10 text-center text-gray-400">No enrollments{{ (string) $batchId !== '' ? ' for this sitting' : '' }} yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </form>

    {{-- Per-row status-toggle forms, kept outside the bulk <form> since forms can't nest --}}
    @foreach ($usersWithScores as $row)
        <form id="status-form-{{ $row->score_id }}" action="/admin/enrollments/{{ $row->score_id }}/status/{{ $row->status === 'approved' ? 'pending' : 'approved' }}" method="POST" class="hidden">
            @csrf
            @method('PUT')
        </form>
    @endforeach
</div>

<div class="mt-6">
    {{ $usersWithScores->links('pagination::tailwind') }}
</div>

@include('backend.layouts.tailwind.footer')
