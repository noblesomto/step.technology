{{-- Param (optional): $active — 'dashboard' | 'blog' | 'events' | 'users' | 'payments' | 'questions' | 'enrollments' --}}
@php($active = $active ?? 'dashboard')

{{-- Top bar --}}
<header class="fixed top-0 inset-x-0 h-16 bg-white border-b border-gray-200 z-30 flex items-center justify-between px-4 lg:pl-72">
    <div class="flex items-center gap-3">
        <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden p-2 text-gray-500">
            <i class="fa fa-bars text-lg"></i>
        </button>
        <a href="/admin/index" class="flex items-center gap-2 lg:hidden">
            <img src="{{ asset('frontend/img/new-logo.png') }}" alt="STEP Admin" class="h-8 w-auto">
        </a>
    </div>

    <form action="/admin/search" method="POST" class="hidden sm:flex items-center bg-gray-100 rounded-full px-4 py-2 w-full max-w-xs">
        @csrf
        <input type="text" name="search" placeholder="Search" class="bg-transparent border-0 focus:ring-0 text-sm w-full p-0">
        <button type="submit" class="text-gray-400"><i class="fa fa-search"></i></button>
    </form>
</header>

{{-- Sidebar --}}
<aside
    class="fixed top-0 left-0 h-full w-64 bg-step-primary text-white z-40 transform transition-transform lg:translate-x-0 overflow-y-auto"
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
>
    <a href="/admin/index" class="flex items-center gap-2 h-16 px-6 border-b border-white/10 sticky top-0 bg-step-primary">
        <img src="{{ asset('frontend/img/new-logo.png') }}" alt="STEP" class="h-9 w-auto bg-white rounded p-1">
        <span class="font-step-heading font-semibold text-sm">Admin</span>
    </a>

    <nav class="p-4 space-y-1 font-step-heading text-sm">
        <a href="/admin/index" class="flex items-center gap-3 px-4 py-2.5 rounded-md {{ $active === 'dashboard' ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
            <i class="fa fa-th-large w-4"></i> Dashboard
        </a>

        {{-- Blog --}}
        <div x-data="{ open: {{ $active === 'blog' ? 'true' : 'false' }} }">
            <button @click="open = !open" class="w-full flex items-center gap-3 px-4 py-2.5 rounded-md {{ $active === 'blog' ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                <i class="fa fa-file-text w-4"></i> Blog
                <svg class="w-3 h-3 ml-auto transition-transform" :class="open && 'rotate-180'" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
            </button>
            <div x-show="open" x-transition x-cloak class="pl-11 space-y-1 mt-1">
                <a href="/blogpost/new-post" class="block py-1.5 text-white/70 hover:text-white">New Post</a>
                <a href="/blogpost/all-post" class="block py-1.5 text-white/70 hover:text-white">All Posts</a>
            </div>
        </div>

        {{-- Events --}}
        <div x-data="{ open: {{ $active === 'events' ? 'true' : 'false' }} }">
            <button @click="open = !open" class="w-full flex items-center gap-3 px-4 py-2.5 rounded-md {{ $active === 'events' ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                <i class="fa fa-calendar w-4"></i> Events
                <svg class="w-3 h-3 ml-auto transition-transform" :class="open && 'rotate-180'" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
            </button>
            <div x-show="open" x-transition x-cloak class="pl-11 space-y-1 mt-1">
                <a href="/event/new-post" class="block py-1.5 text-white/70 hover:text-white">New Event</a>
                <a href="/event/all-events" class="block py-1.5 text-white/70 hover:text-white">All Events</a>
            </div>
        </div>

        <a href="/admin/users" class="flex items-center gap-3 px-4 py-2.5 rounded-md {{ $active === 'users' ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
            <i class="fa fa-users w-4"></i> Users
        </a>
        <a href="/admin/payment" class="flex items-center gap-3 px-4 py-2.5 rounded-md {{ $active === 'payments' ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
            <i class="fa fa-credit-card w-4"></i> Payments
        </a>

        <p class="px-4 pt-4 pb-1 text-xs uppercase tracking-wider text-white/40">Exam Portal</p>

        {{-- Exam Questions --}}
        <div x-data="{ open: {{ $active === 'questions' ? 'true' : 'false' }} }">
            <button @click="open = !open" class="w-full flex items-center gap-3 px-4 py-2.5 rounded-md {{ $active === 'questions' ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                <i class="fa fa-question-circle w-4"></i> Questions
                <svg class="w-3 h-3 ml-auto transition-transform" :class="open && 'rotate-180'" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
            </button>
            <div x-show="open" x-transition x-cloak class="pl-11 space-y-1 mt-1">
                <a href="/admin/questions/new" class="block py-1.5 text-white/70 hover:text-white">New Question</a>
                <a href="/admin/questions" class="block py-1.5 text-white/70 hover:text-white">All Questions</a>
            </div>
        </div>

        <a href="/admin/enrollments" class="flex items-center gap-3 px-4 py-2.5 rounded-md {{ $active === 'enrollments' ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
            <i class="fa fa-graduation-cap w-4"></i> Exam Enrollments
        </a>

        <div class="pt-4 mt-4 border-t border-white/10">
            <a href="/admin/logout" class="flex items-center gap-3 px-4 py-2.5 rounded-md text-white/70 hover:bg-white/10 hover:text-white">
                <i class="fa fa-sign-out w-4"></i> Logout
            </a>
        </div>
    </nav>
</aside>

<div x-show="sidebarOpen" x-cloak @click="sidebarOpen = false" class="fixed inset-0 bg-black/40 z-30 lg:hidden"></div>

<main class="pt-16 lg:pl-64 min-h-screen">
    <div class="p-6 max-w-6xl mx-auto">
