@include('backend.layouts.tailwind.header')
@include('backend.layouts.tailwind.nav', ['active' => 'users'])

<div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
        <h1 class="font-step-heading font-bold text-2xl text-gray-900">Users</h1>
        <nav class="text-sm text-gray-500 mt-1">
            <a href="/admin/index" class="hover:text-step-primary">Home</a>
            <span class="mx-1">/</span>
            <span class="text-step-primary">Users</span>
        </nav>
    </div>
    <div class="flex items-center gap-2">
        <a href="/admin/export-users" class="inline-flex items-center gap-2 bg-white border border-gray-200 text-gray-700 text-sm font-step-heading font-semibold px-4 py-2.5 rounded-full hover:border-step-primary hover:text-step-primary transition-colors">
            <i class="fa fa-download"></i> Export
        </a>
        <a href="/admin/users/create" class="inline-flex items-center gap-2 bg-step-primary text-white text-sm font-step-heading font-semibold px-4 py-2.5 rounded-full hover:bg-step-accent transition-colors">
            <i class="fa fa-plus"></i> New User
        </a>
    </div>
</div>

@if (session('status'))
    <div class="mb-6 rounded-md px-4 py-3 text-sm {{ session('status')['type'] === 'success' ? 'bg-green-50 text-green-700 border border-green-200' : 'bg-red-50 text-red-700 border border-red-200' }}">
        {{ session('status')['text'] }}
    </div>
@endif

<form method="GET" action="/admin/users" class="mb-6 flex gap-3">
    <div class="relative flex-1 max-w-sm">
        <input type="text" name="search" value="{{ $search }}" placeholder="Search name, email or phone" class="w-full h-11 rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm pl-10 pr-3">
        <i class="fa fa-search absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
    </div>
    <button type="submit" class="bg-step-primary text-white font-step-heading font-semibold text-sm px-6 py-2.5 rounded-full hover:bg-step-accent transition-colors">Search</button>
    @if ($search)
        <a href="/admin/users" class="text-sm font-step-heading font-semibold text-gray-500 hover:text-step-primary self-center">Clear</a>
    @endif
</form>

<div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="bg-gray-50 text-gray-500 uppercase text-xs">
                <tr>
                    <th class="px-4 py-3">Name</th>
                    <th class="px-4 py-3">Reg/License No</th>
                    <th class="px-4 py-3">Email</th>
                    <th class="px-4 py-3">Phone</th>
                    <th class="px-4 py-3">Type</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($user as $row)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3">
                            <a href="/admin/users/{{ $row->user_id }}" class="font-medium text-gray-900 hover:text-step-primary">{{ $row->first_name }} {{ $row->last_name }}</a>
                        </td>
                        <td class="px-4 py-3 text-gray-600">{{ $row->reg_no ?: '—' }}</td>
                        <td class="px-4 py-3 text-gray-600">{{ $row->email }}</td>
                        <td class="px-4 py-3 text-gray-600">{{ $row->phone }}</td>
                        <td class="px-4 py-3 text-gray-600">{{ $row->user_type }}</td>
                        <td class="px-4 py-3">
                            @if ($row->acc_status == 1)
                                <span class="inline-block bg-green-50 text-green-700 text-xs font-semibold px-2.5 py-1 rounded-full">Verified</span>
                            @else
                                <span class="inline-block bg-yellow-50 text-yellow-700 text-xs font-semibold px-2.5 py-1 rounded-full">Pending</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center justify-end gap-3">
                                <a href="/admin/users/{{ $row->user_id }}" class="text-gray-400 hover:text-step-primary" title="View"><i class="fa fa-eye"></i></a>
                                <a href="/admin/users/{{ $row->user_id }}/edit" class="text-gray-400 hover:text-step-primary" title="Edit"><i class="fa fa-pencil"></i></a>
                                <form action="/admin/users/{{ $row->user_id }}" method="POST" onsubmit="return confirm('Delete {{ $row->first_name }} {{ $row->last_name }}? This cannot be undone.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-gray-400 hover:text-red-600" title="Delete"><i class="fa fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-10 text-center text-gray-400">No users found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-6">
    {{ $user->links('pagination::tailwind') }}
</div>

@include('backend.layouts.tailwind.footer')
