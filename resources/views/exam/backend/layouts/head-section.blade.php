@include('exam.backend.layouts.header')

<div class="min-h-screen flex">
    <!-- Sidebar -->
    @include('exam.backend.layouts.nav')

    <!-- Overlay for mobile -->
    <div id="overlay" class="fixed inset-0 bg-black opacity-50 z-20 hidden md:hidden"></div>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
        <header class="p-4 bg-white shadow flex">
            <button id="menu-button" class="md:hidden bg-text_red text-white p-2 rounded mr-5">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
            </button>
            <div class="flex-grow lg:flex-grow-0  text-center ">
                <a href="/admin/index" class="text-xl flex items-center justify-center font-semibold text-gray-800">
                    Dashboard
                </a>
            </div>
        </header>
