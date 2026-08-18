@include('backend.layouts.tailwind.header')
@include('backend.layouts.tailwind.nav', ['active' => 'users'])

<div class="mb-6 flex items-center justify-between">
    <h1 class="font-step-heading font-bold text-2xl text-gray-900">All Users</h1>
    <a href="/admin/export-users" class="text-step-primary font-step-heading font-semibold text-sm hover:text-step-accent flex items-center gap-1">
        <i class="fa fa-download"></i> Export Users
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
                    <th class="px-4 py-3">Email</th>
                    <th class="px-4 py-3">Phone</th>
                    <th class="px-4 py-3">City</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Delete</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach ($user as $row)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 font-medium text-gray-900">{{ $row->first_name }} {{ $row->last_name }}</td>
                        <td class="px-4 py-3 text-gray-600">{{ $row->email }}</td>
                        <td class="px-4 py-3 text-gray-600">{{ $row->phone }}</td>
                        <td class="px-4 py-3 text-gray-600">{{ $row->city }}</td>
                        <td class="px-4 py-3">
                            @if ($row->acc_status == "0")
                                <a href="/admin/user-status/{{ $row->user_id }}/1" class="text-step-primary hover:text-step-accent">Verify</a>
                            @else
                                <span class="text-green-600 font-medium">Verified</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <a href="/admin/delete-user/{{ $row->user_id }}" onclick="return confirm('Are you sure you want to delete?');" class="text-red-600 hover:text-red-700">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="mt-6">
    {{ $user->links('pagination::tailwind') }}
</div>

@include('backend.layouts.tailwind.footer')
