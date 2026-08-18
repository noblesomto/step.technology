@include('backend.layouts.tailwind.header')
@include('backend.layouts.tailwind.nav', ['active' => 'dashboard'])

<div class="mb-6">
    <h1 class="font-step-heading font-bold text-2xl text-gray-900">Dashboard</h1>
    <nav class="text-sm text-gray-500 mt-1">
        <a href="/admin/index" class="hover:text-step-primary">Home</a>
        <span class="mx-1">/</span>
        <span class="text-step-primary">Dashboard</span>
    </nav>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="bg-white rounded-lg border border-gray-200 p-6">
        <h5 class="font-step-heading font-semibold text-sm text-gray-500 mb-3">Blog Posts</h5>
        <div class="flex items-center gap-3">
            <div class="w-11 h-11 rounded-full bg-step-primary/10 flex items-center justify-center">
                <i class="fa fa-book text-step-primary"></i>
            </div>
            <h6 class="font-step-heading font-bold text-xl text-gray-900">{{ $count_blog }}</h6>
        </div>
    </div>

    <div class="bg-white rounded-lg border border-gray-200 p-6">
        <h5 class="font-step-heading font-semibold text-sm text-gray-500 mb-3">Users</h5>
        <div class="flex items-center gap-3">
            <div class="w-11 h-11 rounded-full bg-step-primary/10 flex items-center justify-center">
                <i class="fa fa-users text-step-primary"></i>
            </div>
            <h6 class="font-step-heading font-bold text-xl text-gray-900">{{ $count_users }}</h6>
        </div>
    </div>

    <div class="bg-white rounded-lg border border-gray-200 p-6">
        <h5 class="font-step-heading font-semibold text-sm text-gray-500 mb-3">Events</h5>
        <div class="flex items-center gap-3">
            <div class="w-11 h-11 rounded-full bg-step-primary/10 flex items-center justify-center">
                <i class="fa fa-calendar text-step-primary"></i>
            </div>
            <h6 class="font-step-heading font-bold text-xl text-gray-900">{{ $count_events }}</h6>
        </div>
    </div>
</div>

<div class="mt-8">
    <p class="text-xs uppercase tracking-wider text-gray-400 font-step-heading font-semibold mb-4">Exam Portal</p>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <h5 class="font-step-heading font-semibold text-sm text-gray-500 mb-3">Total Exam Submissions</h5>
            <h6 class="font-step-heading font-bold text-xl text-gray-900">{{ $examCounts->total ?? 0 }}</h6>
        </div>
        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <h5 class="font-step-heading font-semibold text-sm text-gray-500 mb-3">Approved</h5>
            <h6 class="font-step-heading font-bold text-xl text-green-600">{{ $examCounts->approved ?? 0 }}</h6>
        </div>
        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <h5 class="font-step-heading font-semibold text-sm text-gray-500 mb-3">Pending Review</h5>
            <h6 class="font-step-heading font-bold text-xl text-yellow-600">{{ $examCounts->pending ?? 0 }}</h6>
        </div>
    </div>
</div>

@include('backend.layouts.tailwind.footer')
