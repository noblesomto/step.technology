{{-- Param (optional): $active — 'dashboard' | 'exam' | 'profile' --}}
@php
    $active = $active ?? 'dashboard';
    $navActiveBatch = \App\Models\ExamBatch::active();
    $navExamDone = $navActiveBatch
        ? \App\Models\ExamScore::where('user_id', session('user_id'))->where('exam_batch_id', $navActiveBatch->id)->exists()
        : false;
@endphp

{{-- Top bar --}}
<header class="fixed top-0 inset-x-0 h-16 bg-white border-b border-gray-200 z-30 flex items-center justify-between px-4 lg:pl-72">
    <div class="flex items-center gap-3">
        <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden p-2 text-gray-500">
            <i class="fa fa-bars text-lg"></i>
        </button>
        <a href="/user/index" class="flex items-center gap-2 lg:hidden">
            <img src="{{ asset('frontend/img/new-logo.png') }}" alt="STEP" class="h-8 w-auto">
        </a>
    </div>
    <a href="https://step.technology" class="hidden sm:inline-flex items-center gap-2 text-sm text-gray-500 hover:text-step-primary">
        <i class="fa fa-external-link"></i> STEP Website
    </a>
</header>

{{-- Sidebar --}}
<aside
    class="fixed top-0 left-0 h-full w-64 bg-step-primary text-white z-40 transform transition-transform lg:translate-x-0"
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
>
    <a href="/user/index" class="flex items-center gap-2 h-16 px-6 border-b border-white/10">
        <img src="{{ asset('frontend/img/new-logo.png') }}" alt="STEP" class="h-9 w-auto bg-white rounded p-1">
        <span class="font-step-heading font-semibold text-sm">Exam Portal</span>
    </a>

    <div class="flex flex-col items-center text-center py-6 border-b border-white/10">
        @if (!empty($user->profile_picture))
            <img class="w-16 h-16 rounded-full object-cover border-2 border-white/30" src="{{ asset('uploads/profile/'.$user->profile_picture) }}" alt="{{ $user->first_name }}">
        @else
            <div class="w-16 h-16 rounded-full bg-white/10 flex items-center justify-center text-2xl font-step-heading font-semibold">
                {{ strtoupper(substr($user->first_name ?? 'U', 0, 1)) }}
            </div>
        @endif
        <h2 class="mt-3 font-step-heading font-semibold text-sm">{{ $user->first_name }} {{ $user->last_name }}</h2>
        <p class="text-xs text-white/70">{{ $user->email }}</p>
    </div>

    <nav class="p-4 space-y-1 font-step-heading text-sm">
        <a href="/user/index" class="flex items-center gap-3 px-4 py-2.5 rounded-md {{ $active === 'dashboard' ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
            <i class="fa fa-th-large w-4"></i> Dashboard
        </a>

        @if (!$navActiveBatch)
            <span class="flex items-center gap-3 px-4 py-2.5 rounded-md text-white/40 cursor-not-allowed">
                <i class="fa fa-pencil-square-o w-4"></i> No Sitting Open
            </span>
        @elseif ($navExamDone)
            <span class="flex items-center gap-3 px-4 py-2.5 rounded-md text-white/40 cursor-not-allowed">
                <i class="fa fa-check-circle w-4"></i> Exam Submitted
            </span>
        @else
            <a href="/user/start-exam" class="flex items-center gap-3 px-4 py-2.5 rounded-md {{ $active === 'exam' ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                <i class="fa fa-pencil-square-o w-4"></i> Start Exam
            </a>
        @endif

        <a href="/user/profile" class="flex items-center gap-3 px-4 py-2.5 rounded-md {{ $active === 'profile' ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
            <i class="fa fa-user w-4"></i> Profile
        </a>
        <a href="/user/logout" class="flex items-center gap-3 px-4 py-2.5 rounded-md text-white/70 hover:bg-white/10 hover:text-white">
            <i class="fa fa-sign-out w-4"></i> Logout
        </a>
    </nav>
</aside>

{{-- Mobile overlay --}}
<div x-show="sidebarOpen" x-cloak @click="sidebarOpen = false" class="fixed inset-0 bg-black/40 z-30 lg:hidden"></div>

<main class="pt-16 lg:pl-64 min-h-screen">
    <div class="p-6 max-w-6xl mx-auto">
