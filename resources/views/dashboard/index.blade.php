@include('dashboard.layouts.tailwind.header')
@include('dashboard.layouts.tailwind.nav', ['active' => 'dashboard'])

<div class="mb-6">
    <h1 class="font-step-heading font-bold text-2xl text-gray-900">Dashboard</h1>
    <nav class="text-sm text-gray-500 mt-1">
        <a href="/user/index" class="hover:text-step-primary">Home</a>
        <span class="mx-1">/</span>
        <span class="text-step-primary">Dashboard</span>
    </nav>
</div>

@if ($user->address == "")
    <div class="mb-4 flex items-center justify-between gap-4 bg-yellow-50 border border-yellow-200 text-yellow-800 rounded-md px-4 py-3">
        <h5 class="font-step-heading font-semibold text-sm">Complete your registration</h5>
        <a href="/user/profile" class="shrink-0 bg-step-primary text-white text-sm font-step-heading font-semibold px-4 py-1.5 rounded-full hover:bg-step-accent transition-colors">Proceed</a>
    </div>
@endif

@if (empty($user->member_status) && !empty($user->address))
    <div class="mb-6 flex items-center justify-between gap-4 bg-yellow-50 border border-yellow-200 text-yellow-800 rounded-md px-4 py-3">
        <h5 class="font-step-heading font-semibold text-sm">Pay your Membership Fee</h5>
        <a href="/user/membership" class="shrink-0 bg-step-primary text-white text-sm font-step-heading font-semibold px-4 py-1.5 rounded-full hover:bg-step-accent transition-colors">Proceed</a>
    </div>
@endif

@if ($user->reg_no)
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-3 bg-step-primary text-white rounded-lg px-6 py-5">
        <div>
            <p class="text-white/70 text-xs font-step-heading font-semibold uppercase tracking-wider">Your Reg/License No</p>
            <p class="font-step-heading font-bold text-2xl mt-1">{{ $user->reg_no }}</p>
        </div>
        <i class="fa fa-certificate text-3xl text-step-accent"></i>
    </div>
@else
    <div class="mb-6 bg-gray-50 border border-gray-200 text-gray-600 rounded-md px-4 py-3 text-sm">
        <i class="fa fa-info-circle text-step-primary"></i>
        Your Reg/License No will be issued here once your membership payment is confirmed and your exam result is approved.
    </div>
@endif

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <a href="/user/journals" class="block bg-white rounded-lg border border-gray-200 p-6 hover:border-step-primary transition-colors">
        <h5 class="font-step-heading font-semibold text-sm text-gray-500 mb-3">My Journals</h5>
        <div class="flex items-center gap-3">
            <div class="w-11 h-11 rounded-full bg-step-primary/10 flex items-center justify-center">
                <i class="fa fa-book text-step-primary"></i>
            </div>
            <h6 class="font-step-heading font-bold text-xl text-gray-900">{{ $journalsCount }}</h6>
        </div>
    </a>

    <div class="bg-white rounded-lg border border-gray-200 p-6">
        <h5 class="font-step-heading font-semibold text-sm text-gray-500 mb-3">Certifications Available</h5>
        <div class="flex items-center gap-3">
            <div class="w-11 h-11 rounded-full bg-step-primary/10 flex items-center justify-center">
                <i class="fa fa-users text-step-primary"></i>
            </div>
            <h6 class="font-step-heading font-bold text-xl text-gray-900">0</h6>
        </div>
    </div>

    <div class="bg-white rounded-lg border border-gray-200 p-6">
        <h5 class="font-step-heading font-semibold text-sm text-gray-500 mb-3">Reg/License No</h5>
        <div class="flex items-center gap-3">
            <div class="w-11 h-11 rounded-full bg-step-primary/10 flex items-center justify-center">
                <i class="fa fa-id-badge text-step-primary"></i>
            </div>
            <h6 class="font-step-heading font-bold {{ $user->reg_no ? 'text-xl' : 'text-sm' }} text-gray-900">{{ $user->reg_no ?: 'Pending...' }}</h6>
        </div>
    </div>
</div>

@include('dashboard.layouts.tailwind.footer')
