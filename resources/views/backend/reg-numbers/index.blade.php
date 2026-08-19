@include('backend.layouts.tailwind.header')
@include('backend.layouts.tailwind.nav', ['active' => 'reg-numbers'])

<div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
        <h1 class="font-step-heading font-bold text-2xl text-gray-900">Reg/License Numbers</h1>
        <nav class="text-sm text-gray-500 mt-1">
            <a href="/admin/index" class="hover:text-step-primary">Home</a>
            <span class="mx-1">/</span>
            <span class="text-step-primary">Reg Numbers</span>
        </nav>
    </div>
    <a href="/admin/users" class="inline-flex items-center gap-2 bg-white border border-gray-200 text-gray-700 text-sm font-step-heading font-semibold px-4 py-2.5 rounded-full hover:border-step-primary hover:text-step-primary transition-colors">
        <i class="fa fa-users"></i> All Users
    </a>
</div>

@if (session('status'))
    <div class="mb-6 rounded-md px-4 py-3 text-sm {{ session('status')['type'] === 'success' ? 'bg-green-50 text-green-700 border border-green-200' : 'bg-red-50 text-red-700 border border-red-200' }}">
        {{ session('status')['text'] }}
    </div>
@endif

<div class="mb-6 bg-step-primary/5 border border-step-primary/20 rounded-lg px-4 py-3 text-sm text-gray-700">
    <i class="fa fa-info-circle text-step-primary"></i>
    A Reg/License No is only issued once a user has <strong>confirmed payment</strong> and an <strong>approved exam result</strong>. {{ $assignedCount }} user{{ $assignedCount === 1 ? '' : 's' }} already {{ $assignedCount === 1 ? 'has' : 'have' }} one issued.
</div>

<form method="GET" action="/admin/reg-numbers" class="mb-6 flex gap-3">
    <div class="relative flex-1 max-w-sm">
        <input type="text" name="search" value="{{ $search }}" placeholder="Search name or email" class="w-full h-11 rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm pl-10 pr-3">
        <i class="fa fa-search absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
    </div>
    <button type="submit" class="bg-step-primary text-white font-step-heading font-semibold text-sm px-6 py-2.5 rounded-full hover:bg-step-accent transition-colors">Search</button>
    @if ($search)
        <a href="/admin/reg-numbers" class="text-sm font-step-heading font-semibold text-gray-500 hover:text-step-primary self-center">Clear</a>
    @endif
</form>

<div x-data="{ selected: [] }">
    <form action="/admin/reg-numbers/generate" method="POST" id="generate-form">
        @csrf

        {{-- Bulk action bar --}}
        <div x-show="selected.length > 0" x-transition x-cloak class="mb-4 flex items-center justify-between bg-step-primary/5 border border-step-primary/20 rounded-lg px-4 py-3">
            <p class="text-sm font-step-heading font-semibold text-step-primary"><span x-text="selected.length"></span> selected</p>
            <button type="submit" class="bg-step-primary text-white text-xs font-step-heading font-semibold px-4 py-2 rounded-full hover:bg-step-accent">Generate Selected</button>
        </div>

        <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 text-gray-500 uppercase text-xs">
                        <tr>
                            <th class="px-4 py-3 w-10">
                                <input type="checkbox" @change="selected = $event.target.checked ? [{{ $eligible->pluck('user_id')->map(fn ($id) => "'".$id."'")->implode(',') }}] : []" class="rounded border-gray-300 text-step-primary focus:ring-step-primary">
                            </th>
                            <th class="px-4 py-3">Name</th>
                            <th class="px-4 py-3">Email</th>
                            <th class="px-4 py-3">Type</th>
                            <th class="px-4 py-3 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($eligible as $row)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3">
                                    <input type="checkbox" name="user_ids[]" value="{{ $row->user_id }}" x-model="selected" class="rounded border-gray-300 text-step-primary focus:ring-step-primary">
                                </td>
                                <td class="px-4 py-3 font-medium text-gray-900">
                                    <a href="/admin/users/{{ $row->user_id }}" class="hover:text-step-primary">{{ $row->first_name }} {{ $row->last_name }}</a>
                                </td>
                                <td class="px-4 py-3 text-gray-600">{{ $row->email }}</td>
                                <td class="px-4 py-3 text-gray-600">{{ $row->user_type }}</td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center justify-end gap-3">
                                        <button type="submit" form="generate-form-{{ $row->user_id }}" class="text-xs font-step-heading font-semibold text-step-primary hover:text-step-accent">Generate</button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-10 text-center text-gray-400">No users are currently eligible for a Reg/License No.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </form>

    {{-- Per-row generate forms, kept outside the bulk <form> since forms can't nest --}}
    @foreach ($eligible as $row)
        <form id="generate-form-{{ $row->user_id }}" action="/admin/reg-numbers/generate" method="POST" class="hidden">
            @csrf
            <input type="hidden" name="user_ids[]" value="{{ $row->user_id }}">
        </form>
    @endforeach
</div>

<div class="mt-6">
    {{ $eligible->links('pagination::tailwind') }}
</div>

@include('backend.layouts.tailwind.footer')
