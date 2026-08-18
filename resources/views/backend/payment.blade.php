@include('backend.layouts.tailwind.header')
@include('backend.layouts.tailwind.nav', ['active' => 'payments'])

<div class="mb-6">
    <h1 class="font-step-heading font-bold text-2xl text-gray-900">Payment History</h1>
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
                    <th class="px-4 py-3">Full Name</th>
                    <th class="px-4 py-3">Phone</th>
                    <th class="px-4 py-3">User Type</th>
                    <th class="px-4 py-3">Payment Proof</th>
                    <th class="px-4 py-3">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach ($user as $row)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 font-medium text-gray-900">{{ $row->first_name }} {{ $row->last_name }}</td>
                        <td class="px-4 py-3 text-gray-600">{{ $row->phone }}</td>
                        <td class="px-4 py-3 text-gray-600">{{ $row->user_type }}</td>
                        <td class="px-4 py-3">
                            <a target="_blank" href="{{ asset('uploads/payment/'.$row->payment_picture) }}">
                                <img src="{{ asset('uploads/payment/'.$row->payment_picture) }}" loading="lazy" class="w-20 rounded border border-gray-200">
                            </a>
                        </td>
                        <td class="px-4 py-3">
                            <a href="/admin/confirm-payment/{{ $row->user_id }}" class="text-step-primary font-medium hover:text-step-accent">Confirm Payment</a>
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
