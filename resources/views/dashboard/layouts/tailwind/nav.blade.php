{{-- Param (optional): $active — 'dashboard' | 'profile' | 'membership' --}}
@php($active = $active ?? 'dashboard')

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

    <form action="/user/search" method="POST" class="hidden sm:flex items-center bg-gray-100 rounded-full px-4 py-2 w-full max-w-xs">
        @csrf
        <input type="text" name="search" placeholder="Search" class="bg-transparent border-0 focus:ring-0 text-sm w-full p-0">
        <button type="submit" class="text-gray-400"><i class="fa fa-search"></i></button>
    </form>
</header>

{{-- Sidebar --}}
<aside
    class="fixed top-0 left-0 h-full w-64 bg-step-primary text-white z-40 transform transition-transform lg:translate-x-0"
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
>
    <a href="/user/index" class="flex items-center gap-2 h-16 px-6 border-b border-white/10">
        <img src="{{ asset('frontend/img/new-logo.png') }}" alt="STEP" class="h-9 w-auto bg-white rounded p-1">
    </a>

    <nav class="p-4 space-y-1 font-step-heading text-sm">
        <a href="/user/index" class="flex items-center gap-3 px-4 py-2.5 rounded-md {{ $active === 'dashboard' ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
            <i class="fa fa-th-large w-4"></i> Dashboard
        </a>
        <a href="/user/profile" class="flex items-center gap-3 px-4 py-2.5 rounded-md {{ $active === 'profile' ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
            <i class="fa fa-user w-4"></i> Profile
        </a>
        <a href="/user/membership" class="flex items-center gap-3 px-4 py-2.5 rounded-md {{ $active === 'membership' ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
            <i class="fa fa-id-card w-4"></i> Membership
        </a>
        <a href="/user/logout" class="flex items-center gap-3 px-4 py-2.5 rounded-md text-white/70 hover:bg-white/10 hover:text-white">
            <i class="fa fa-sign-in w-4"></i> Logout
        </a>
    </nav>
</aside>

{{-- Mobile overlay --}}
<div x-show="sidebarOpen" x-cloak @click="sidebarOpen = false" class="fixed inset-0 bg-black/40 z-30 lg:hidden"></div>

<main class="pt-16 lg:pl-64 min-h-screen">
    <div class="p-6 max-w-6xl mx-auto">
