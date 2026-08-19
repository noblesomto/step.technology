
    <!-- Header -->
    <header class="bg-blue-100 shadow-md sticky top-0 z-50" x-data="{ mobileOpen: false, userMenuOpen: false }">
        <nav class="mx-auto bg-white h-16 px-6 flex items-center justify-between">

            <!-- Hamburger Menu Icon (Hidden on Desktop) -->
            <button @click="mobileOpen = !mobileOpen; userMenuOpen = false" class="block lg:hidden text-gray-400 text-2xl w-6 focus:outline-none" aria-label="Toggle menu">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>

            <!-- Logo (Centered on Mobile) -->
            <div class="flex-grow lg:flex-grow-0  text-center ">
                <a href="/" class="text-xl flex items-center justify-center font-semibold text-gray-800">
                    <img class="w-40 md:w-52" src="{{ asset('frontend/img/new-logo.png') }}">
                </a>
            </div>

            <!-- Navigation Menu (Hidden on Mobile) -->
            <div id="nav-links" class="hidden lg:flex items-center space-x-8 text-gray-600 h-16">

                <a href="https://step.technology/about" class="nav">About STEP</a>
                <a href="https://step.technology/trainings" class="nav">Services</a>
                <a href="https://step.technology/contact" class="nav">Contact Us</a>
                <a href="https://step.technology/blog" class="nav">Blog</a>
                @if(session()->get('user_id') =='')
                <a href="/login" class="btn btn-red">Login</a>
                @else
                <a href="/user/index" class="btn btn-red">My Account</a>
                @endif

            </div>

            <!-- User Icon (Always visible) -->
            <div class="block lg:hidden text-gray-400 text-2xl">
                <button type="button" @click="userMenuOpen = !userMenuOpen; mobileOpen = false" class="hover:text-gray-600" aria-label="Toggle account menu">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                </button>
            </div>
        </nav>

        <!-- Mobile Menu -->
        <div x-show="mobileOpen" x-cloak class="lg:hidden bg-white shadow-md">
            <ul class="flex flex-col space-y-4 p-4">
                <li><a href="/" class="text-gray-600 hover:text-blue-500">Home</a></li>
                <li><a href="https://step.technology/about" class="text-gray-600 hover:text-blue-500">About STEP</a></li>
                <li><a href="https://step.technology/trainings" class="text-gray-600 hover:text-blue-500">Services</a></li>
                <li><a href="https://step.technology/blog" class="text-gray-600 hover:text-blue-500">Blog</a></li>
                <li><a href="https://step.technology/contact" class="text-gray-600 hover:text-blue-500">Contact Us</a></li>
            </ul>
        </div>

        <!-- Account Menu -->
        <div x-show="userMenuOpen" x-cloak class="lg:hidden bg-white shadow-md">
            <ul class="flex flex-col space-y-4 p-4">
                @if(session()->get('user_id') =='')
                <li><a href="/login" class="text-gray-600 hover:text-blue-500">Login</a></li>
                <li><a href="https://step.technology/register" class="text-gray-600 hover:text-blue-500">Register</a></li>
                @else
                <li><a href="/user/index" class="text-gray-600 hover:text-blue-500">My Account</a></li>
                <li><a href="/user/logout" class="text-gray-600 hover:text-blue-500">Logout</a></li>
                @endif
            </ul>
        </div>
    </header>
