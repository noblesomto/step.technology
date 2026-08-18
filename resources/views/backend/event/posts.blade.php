@include('backend.layouts.tailwind.header')
@include('backend.layouts.tailwind.nav', ['active' => 'events'])

<div class="mb-6">
    <h1 class="font-step-heading font-bold text-2xl text-gray-900">All Event Posts</h1>
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
                    <th class="px-4 py-3">Event Title</th>
                    <th class="px-4 py-3">Published Date</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Edit</th>
                    <th class="px-4 py-3">Delete</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach ($post as $row)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 font-medium text-gray-900">{{ $row->event_title }}</td>
                        <td class="px-4 py-3 text-gray-600">{{ $row->created_at->format('j F Y') }}</td>
                        <td class="px-4 py-3">
                            @if ($row->event_status == 1)
                                <a href="/event/post-status/{{ $row->event_id }}/0" class="text-yellow-600 hover:text-yellow-700">Unpublish</a>
                            @else
                                <a href="/event/post-status/{{ $row->event_id }}/1" class="text-green-600 hover:text-green-700">Publish</a>
                            @endif
                        </td>
                        <td class="px-4 py-3"><a href="/event/edit-post/{{ $row->event_id }}" class="text-step-primary hover:text-step-accent">Edit</a></td>
                        <td class="px-4 py-3"><a href="/event/delete-post/{{ $row->event_id }}" onclick="return confirm('Are you sure you want to delete?');" class="text-red-600 hover:text-red-700">Delete</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@include('backend.layouts.tailwind.footer')
