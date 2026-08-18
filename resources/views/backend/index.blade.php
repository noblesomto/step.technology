@include('backend.layouts.tailwind.header')
@include('backend.layouts.tailwind.nav', ['active' => 'dashboard'])

<div class="mb-6 flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">
    <div>
        <h1 class="font-step-heading font-bold text-2xl text-gray-900">Dashboard</h1>
        <nav class="text-sm text-gray-500 mt-1">
            <a href="/admin/index" class="hover:text-step-primary">Home</a>
            <span class="mx-1">/</span>
            <span class="text-step-primary">Dashboard</span>
        </nav>
    </div>

    {{-- Quick actions --}}
    <div class="flex flex-wrap gap-2">
        <a href="/blogpost/new-post" class="inline-flex items-center gap-2 bg-white border border-gray-200 text-gray-700 text-sm font-step-heading font-semibold px-4 py-2 rounded-full hover:border-step-primary hover:text-step-primary transition-colors">
            <i class="fa fa-plus text-xs"></i> Blog Post
        </a>
        <a href="/event/new-post" class="inline-flex items-center gap-2 bg-white border border-gray-200 text-gray-700 text-sm font-step-heading font-semibold px-4 py-2 rounded-full hover:border-step-primary hover:text-step-primary transition-colors">
            <i class="fa fa-plus text-xs"></i> Event
        </a>
        <a href="/admin/questions/new" class="inline-flex items-center gap-2 bg-step-primary text-white text-sm font-step-heading font-semibold px-4 py-2 rounded-full hover:bg-step-accent transition-colors">
            <i class="fa fa-plus text-xs"></i> Question
        </a>
    </div>
</div>

{{-- ================= OVERVIEW ================= --}}
<p class="text-xs uppercase tracking-wider text-gray-400 font-step-heading font-semibold mb-3">Overview</p>
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
    <a href="/admin/users" class="block bg-white rounded-lg border border-gray-200 border-l-4 border-l-step-primary p-5 hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between mb-3">
            <div class="w-10 h-10 rounded-full bg-step-primary/10 flex items-center justify-center">
                <i class="fa fa-users text-step-primary"></i>
            </div>
            <span class="text-2xl font-step-heading font-bold text-gray-900">{{ $count_users }}</span>
        </div>
        <p class="text-sm font-step-heading font-semibold text-gray-700">Total Users</p>
        <p class="text-xs text-gray-400 mt-1">{{ $count_verified_users }} verified &middot; {{ $count_pending_verification }} pending</p>
    </a>

    <a href="/admin/payment" class="block bg-white rounded-lg border border-gray-200 border-l-4 border-l-step-accent p-5 hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between mb-3">
            <div class="w-10 h-10 rounded-full bg-step-accent/10 flex items-center justify-center">
                <i class="fa fa-credit-card text-step-accent"></i>
            </div>
            <span class="text-2xl font-step-heading font-bold text-gray-900">{{ $paymentCounts->total ?? 0 }}</span>
        </div>
        <p class="text-sm font-step-heading font-semibold text-gray-700">Payments</p>
        <p class="text-xs text-gray-400 mt-1">{{ $paymentCounts->confirmed ?? 0 }} confirmed &middot; {{ $paymentCounts->pending ?? 0 }} pending</p>
    </a>

    <a href="/blogpost/all-post" class="block bg-white rounded-lg border border-gray-200 border-l-4 border-l-gray-400 p-5 hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between mb-3">
            <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center">
                <i class="fa fa-book text-gray-500"></i>
            </div>
            <span class="text-2xl font-step-heading font-bold text-gray-900">{{ $count_blog }}</span>
        </div>
        <p class="text-sm font-step-heading font-semibold text-gray-700">Blog Posts</p>
        <p class="text-xs text-gray-400 mt-1">Published articles</p>
    </a>

    <a href="/event/all-events" class="block bg-white rounded-lg border border-gray-200 border-l-4 border-l-gray-400 p-5 hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between mb-3">
            <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center">
                <i class="fa fa-calendar text-gray-500"></i>
            </div>
            <span class="text-2xl font-step-heading font-bold text-gray-900">{{ $count_events }}</span>
        </div>
        <p class="text-sm font-step-heading font-semibold text-gray-700">Events</p>
        <p class="text-xs text-gray-400 mt-1">Upcoming &amp; past</p>
    </a>
</div>

{{-- ================= EXAM PORTAL ================= --}}
<div class="mt-10">
    <div class="flex items-center justify-between mb-3">
        <p class="text-xs uppercase tracking-wider text-gray-400 font-step-heading font-semibold">Exam Portal</p>
        <a href="/admin/enrollments" class="text-xs font-step-heading font-semibold text-step-primary hover:text-step-accent">View All Enrollments &rarr;</a>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
        <div class="bg-white rounded-lg border border-gray-200 p-5">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-step-primary/10 flex items-center justify-center">
                    <i class="fa fa-file-text text-step-primary"></i>
                </div>
                <div>
                    <p class="text-2xl font-step-heading font-bold text-gray-900">{{ $examCounts->total ?? 0 }}</p>
                    <p class="text-xs text-gray-500">Total Submissions</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg border border-gray-200 p-5">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-green-50 flex items-center justify-center">
                    <i class="fa fa-check-circle text-green-600"></i>
                </div>
                <div>
                    <p class="text-2xl font-step-heading font-bold text-green-600">{{ $examCounts->approved ?? 0 }}</p>
                    <p class="text-xs text-gray-500">Approved</p>
                </div>
            </div>
        </div>
        <a href="/admin/enrollments?status=pending" class="bg-white rounded-lg border border-gray-200 p-5 hover:shadow-md transition-shadow">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-yellow-50 flex items-center justify-center">
                    <i class="fa fa-clock-o text-yellow-600"></i>
                </div>
                <div>
                    <p class="text-2xl font-step-heading font-bold text-yellow-600">{{ $examCounts->pending ?? 0 }}</p>
                    <p class="text-xs text-gray-500">Pending Review</p>
                </div>
            </div>
        </a>
    </div>
</div>

{{-- ================= RECENT ACTIVITY ================= --}}
<div class="mt-10 grid grid-cols-1 lg:grid-cols-2 gap-6">
    {{-- Recent Registrations --}}
    <div class="bg-white rounded-lg border border-gray-200">
        <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
            <h3 class="font-step-heading font-semibold text-gray-900">Recent Registrations</h3>
            <a href="/admin/users" class="text-xs font-step-heading font-semibold text-step-primary hover:text-step-accent">View All &rarr;</a>
        </div>
        <div class="divide-y divide-gray-100">
            @forelse ($recentUsers as $user)
                <a href="/admin/users/{{ $user->user_id }}" class="flex items-center justify-between px-5 py-3 hover:bg-gray-50">
                    <div>
                        <p class="text-sm font-medium text-gray-900">{{ $user->first_name }} {{ $user->last_name }}</p>
                        <p class="text-xs text-gray-500">{{ $user->email }}</p>
                    </div>
                    <div class="text-right">
                        @if ($user->acc_status == 1)
                            <span class="inline-block bg-green-50 text-green-700 text-xs font-semibold px-2.5 py-1 rounded-full">Verified</span>
                        @else
                            <span class="inline-block bg-yellow-50 text-yellow-700 text-xs font-semibold px-2.5 py-1 rounded-full">Pending</span>
                        @endif
                        <p class="text-xs text-gray-400 mt-1">{{ $user->created_at->diffForHumans() }}</p>
                    </div>
                </a>
            @empty
                <p class="px-5 py-6 text-sm text-gray-400 text-center">No registrations yet.</p>
            @endforelse
        </div>
    </div>

    {{-- Pending Payments --}}
    <div class="bg-white rounded-lg border border-gray-200">
        <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
            <h3 class="font-step-heading font-semibold text-gray-900">Payments Awaiting Confirmation</h3>
            <a href="/admin/payment" class="text-xs font-step-heading font-semibold text-step-primary hover:text-step-accent">View All &rarr;</a>
        </div>
        <div class="divide-y divide-gray-100">
            @forelse ($recentPendingPayments as $payment)
                <div class="flex items-center justify-between px-5 py-3">
                    <div>
                        <p class="text-sm font-medium text-gray-900">{{ $payment->first_name }} {{ $payment->last_name }}</p>
                        <p class="text-xs text-gray-500">&#8358;{{ number_format((float) $payment->payment_amount) }}</p>
                    </div>
                    <a href="/admin/confirm-payment/{{ $payment->user_id }}" class="text-xs font-step-heading font-semibold text-step-primary hover:text-step-accent bg-step-primary/5 px-3 py-1.5 rounded-full">Confirm</a>
                </div>
            @empty
                <p class="px-5 py-6 text-sm text-gray-400 text-center">Nothing awaiting confirmation.</p>
            @endforelse
        </div>
    </div>
</div>

{{-- Recent Blog Posts --}}
<div class="mt-6 bg-white rounded-lg border border-gray-200">
    <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
        <h3 class="font-step-heading font-semibold text-gray-900">Recent Blog Posts</h3>
        <a href="/blogpost/all-post" class="text-xs font-step-heading font-semibold text-step-primary hover:text-step-accent">View All &rarr;</a>
    </div>
    <div class="divide-y divide-gray-100">
        @forelse ($recentBlogPosts as $post)
            <div class="flex items-center justify-between px-5 py-3">
                <div>
                    <p class="text-sm font-medium text-gray-900">{{ Str::limit($post->blog_title, 60) }}</p>
                    <p class="text-xs text-gray-400">{{ $post->created_at->format('j M Y') }}</p>
                </div>
                <div class="flex items-center gap-3">
                    @if ($post->blog_status == 1)
                        <span class="inline-block bg-green-50 text-green-700 text-xs font-semibold px-2.5 py-1 rounded-full">Published</span>
                    @else
                        <span class="inline-block bg-gray-100 text-gray-600 text-xs font-semibold px-2.5 py-1 rounded-full">Draft</span>
                    @endif
                    <a href="/blogpost/edit-post/{{ $post->blog_id }}" class="text-xs font-step-heading font-semibold text-step-primary hover:text-step-accent">Edit</a>
                </div>
            </div>
        @empty
            <p class="px-5 py-6 text-sm text-gray-400 text-center">No blog posts yet.</p>
        @endforelse
    </div>
</div>

@include('backend.layouts.tailwind.footer')
