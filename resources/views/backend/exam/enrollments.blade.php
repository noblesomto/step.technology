@include('backend.layouts.tailwind.header')
@include('backend.layouts.tailwind.nav', ['active' => 'enrollments'])

<div class="mb-6">
    <h1 class="font-step-heading font-bold text-2xl text-gray-900">Exam Enrollments</h1>
</div>

@if (session('status'))
    <div class="mb-6 rounded-md px-4 py-3 text-sm {{ session('status')['type'] === 'success' ? 'bg-green-50 text-green-700 border border-green-200' : 'bg-red-50 text-red-700 border border-red-200' }}">
        {{ session('status')['text'] }}
    </div>
@endif

<form method="GET" class="mb-6 flex flex-col sm:flex-row gap-3">
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name or email" class="w-full sm:max-w-xs h-11 rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm px-3">
    <select name="status" class="h-11 rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm px-3">
        <option value="">All Statuses</option>
        <option value="pending" @selected(request('status') === 'pending')>Pending</option>
        <option value="approved" @selected(request('status') === 'approved')>Approved</option>
    </select>
    <button type="submit" class="bg-step-primary text-white font-step-heading font-semibold text-sm px-6 py-2.5 rounded-full hover:bg-step-accent transition-colors">Filter</button>
</form>

<div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="bg-gray-50 text-gray-500 uppercase text-xs">
                <tr>
                    <th class="px-4 py-3">Name</th>
                    <th class="px-4 py-3">Email</th>
                    <th class="px-4 py-3">Score</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Updated</th>
                    <th class="px-4 py-3">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach ($usersWithScores as $row)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 font-medium text-gray-900">{{ $row->first_name }} {{ $row->last_name }}</td>
                        <td class="px-4 py-3 text-gray-600">{{ $row->email }}</td>
                        <td class="px-4 py-3 text-gray-600">{{ $row->score }}</td>
                        <td class="px-4 py-3">
                            @if ($row->status === 'approved')
                                <span class="inline-block bg-green-50 text-green-700 text-xs font-semibold px-2.5 py-1 rounded-full">Approved</span>
                            @else
                                <span class="inline-block bg-yellow-50 text-yellow-700 text-xs font-semibold px-2.5 py-1 rounded-full">Pending</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-gray-500">{{ \Illuminate\Support\Carbon::parse($row->exam_updated_at)->format('j M Y') }}</td>
                        <td class="px-4 py-3">
                            @if ($row->status === 'approved')
                                <a href="/admin/exam-status/{{ $row->user_id }}/pending" class="text-yellow-600 hover:text-yellow-700">Set Pending</a>
                            @else
                                <a href="/admin/exam-status/{{ $row->user_id }}/approved" class="text-green-600 hover:text-green-700">Approve</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="mt-6">
    {{ $usersWithScores->links('pagination::tailwind') }}
</div>

@include('backend.layouts.tailwind.footer')
