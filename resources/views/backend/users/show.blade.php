@include('backend.layouts.tailwind.header')
@include('backend.layouts.tailwind.nav', ['active' => 'users'])

<div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
        <h1 class="font-step-heading font-bold text-2xl text-gray-900">{{ $user->first_name }} {{ $user->last_name }}</h1>
        <nav class="text-sm text-gray-500 mt-1">
            <a href="/admin/index" class="hover:text-step-primary">Home</a>
            <span class="mx-1">/</span>
            <a href="/admin/users" class="hover:text-step-primary">Users</a>
            <span class="mx-1">/</span>
            <span class="text-step-primary">{{ $user->first_name }} {{ $user->last_name }}</span>
        </nav>
    </div>
    <div class="flex items-center gap-2">
        <a href="/admin/users/{{ $user->user_id }}/edit" class="inline-flex items-center gap-2 bg-white border border-gray-200 text-gray-700 text-sm font-step-heading font-semibold px-4 py-2.5 rounded-full hover:border-step-primary hover:text-step-primary transition-colors">
            <i class="fa fa-pencil"></i> Edit
        </a>
        <form action="/admin/users/{{ $user->user_id }}" method="POST" onsubmit="return confirm('Delete {{ $user->first_name }} {{ $user->last_name }}? This cannot be undone.');">
            @csrf
            @method('DELETE')
            <button type="submit" class="inline-flex items-center gap-2 bg-white border border-gray-200 text-red-600 text-sm font-step-heading font-semibold px-4 py-2.5 rounded-full hover:border-red-300 hover:bg-red-50 transition-colors">
                <i class="fa fa-trash"></i> Delete
            </button>
        </form>
    </div>
</div>

@if (session('status'))
    <div class="mb-6 rounded-md px-4 py-3 text-sm {{ session('status')['type'] === 'success' ? 'bg-green-50 text-green-700 border border-green-200' : 'bg-red-50 text-red-700 border border-red-200' }}">
        {{ session('status')['text'] }}
    </div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    {{-- Profile --}}
    <div class="lg:col-span-2 bg-white rounded-lg border border-gray-200 p-6 sm:p-8">
        <h2 class="font-step-heading font-semibold text-lg text-step-primary mb-4">Profile</h2>
        <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4 text-sm">
            <div><dt class="text-gray-500">Full Name</dt><dd class="font-medium text-gray-900 mt-0.5">{{ $user->title }} {{ $user->first_name }} {{ $user->last_name }}</dd></div>
            <div><dt class="text-gray-500">Gender</dt><dd class="font-medium text-gray-900 mt-0.5">{{ $user->gender ?: '—' }}</dd></div>
            <div><dt class="text-gray-500">Email</dt><dd class="font-medium text-gray-900 mt-0.5">{{ $user->email }}</dd></div>
            <div><dt class="text-gray-500">Phone</dt><dd class="font-medium text-gray-900 mt-0.5">{{ $user->phone }}</dd></div>
            <div><dt class="text-gray-500">User Type</dt><dd class="font-medium text-gray-900 mt-0.5">{{ $user->user_type }}</dd></div>
            <div><dt class="text-gray-500">Profession</dt><dd class="font-medium text-gray-900 mt-0.5">{{ $user->profession ?: '—' }}</dd></div>
            <div><dt class="text-gray-500">Company</dt><dd class="font-medium text-gray-900 mt-0.5">{{ $user->company_name ?: '—' }}</dd></div>
            <div><dt class="text-gray-500">School</dt><dd class="font-medium text-gray-900 mt-0.5">{{ $user->school_name ?: '—' }}</dd></div>
            <div><dt class="text-gray-500">Address</dt><dd class="font-medium text-gray-900 mt-0.5">{{ $user->address ?: '—' }}</dd></div>
            <div><dt class="text-gray-500">City / State</dt><dd class="font-medium text-gray-900 mt-0.5">{{ $user->city ?: '—' }}{{ $user->state ? ', '.$user->state : '' }}</dd></div>
            <div><dt class="text-gray-500">Reg/License No</dt><dd class="font-medium text-gray-900 mt-0.5">{{ $user->reg_no ?: '—' }}</dd></div>
            <div><dt class="text-gray-500">STEP ID</dt><dd class="font-medium text-gray-900 mt-0.5">{{ $user->step_id ?: '—' }}</dd></div>
            <div><dt class="text-gray-500">Registered</dt><dd class="font-medium text-gray-900 mt-0.5">{{ $user->created_at->format('j M Y') }}</dd></div>
        </dl>
    </div>

    {{-- Status panel --}}
    <div class="space-y-6">
        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <h3 class="font-step-heading font-semibold text-gray-900 mb-4">Account Status</h3>

            <div class="flex items-center justify-between mb-4">
                <span class="text-sm text-gray-500">Verification</span>
                @if ($user->acc_status == 1)
                    <span class="inline-block bg-green-50 text-green-700 text-xs font-semibold px-2.5 py-1 rounded-full">Verified</span>
                @else
                    <span class="inline-block bg-yellow-50 text-yellow-700 text-xs font-semibold px-2.5 py-1 rounded-full">Pending</span>
                @endif
            </div>

            <form action="/admin/users/{{ $user->user_id }}/status/{{ $user->acc_status == 1 ? 0 : 1 }}" method="POST">
                @csrf
                @method('PUT')
                <button type="submit" class="w-full text-sm font-step-heading font-semibold px-4 py-2.5 rounded-full border transition-colors {{ $user->acc_status == 1 ? 'border-yellow-200 text-yellow-700 hover:bg-yellow-50' : 'border-green-200 text-green-700 hover:bg-green-50' }}">
                    {{ $user->acc_status == 1 ? 'Mark as Unverified' : 'Verify User' }}
                </button>
            </form>

            <div class="flex items-center justify-between mt-4 pt-4 border-t border-gray-100">
                <span class="text-sm text-gray-500">Membership</span>
                <span class="font-medium text-gray-900 text-sm">{{ $user->member_status ?: 'Pending' }}</span>
            </div>
        </div>

        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <h3 class="font-step-heading font-semibold text-gray-900 mb-4">Payment</h3>
            @if ($payment)
                <p class="text-sm text-gray-500">Amount</p>
                <p class="font-medium text-gray-900 mb-3">&#8358;{{ number_format((float) $payment->payment_amount) }}</p>
                <p class="text-sm text-gray-500">Status</p>
                @if ($payment->payment_status == 1)
                    <span class="inline-block bg-green-50 text-green-700 text-xs font-semibold px-2.5 py-1 rounded-full mt-1">Confirmed</span>
                @else
                    <a href="/admin/confirm-payment/{{ $user->user_id }}" class="inline-block bg-step-primary/5 text-step-primary text-xs font-semibold px-2.5 py-1 rounded-full mt-1 hover:bg-step-primary/10">Pending — Confirm</a>
                @endif
            @else
                <p class="text-sm text-gray-400">No payment on record.</p>
            @endif
        </div>

        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <h3 class="font-step-heading font-semibold text-gray-900 mb-4">Exam</h3>
            @if ($examScore)
                <p class="text-sm text-gray-500">Score</p>
                <p class="font-medium text-gray-900 mb-3">{{ $examScore->score }}</p>
                <p class="text-sm text-gray-500">Status</p>
                @if ($examScore->status === 'approved')
                    <span class="inline-block bg-green-50 text-green-700 text-xs font-semibold px-2.5 py-1 rounded-full mt-1">Approved</span>
                @else
                    <span class="inline-block bg-yellow-50 text-yellow-700 text-xs font-semibold px-2.5 py-1 rounded-full mt-1">Pending</span>
                @endif
            @else
                <p class="text-sm text-gray-400">No exam submission yet.</p>
            @endif
        </div>
    </div>
</div>

@include('backend.layouts.tailwind.footer')
