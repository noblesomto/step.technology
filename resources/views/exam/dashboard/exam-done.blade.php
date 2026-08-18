@include('exam.dashboard.layouts.header')
@inject('carbon', 'Carbon\Carbon')
<div class="min-h-screen flex">
    <!-- Sidebar -->
    @include('exam.dashboard.layouts.nav')

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
                <a href="/" class="text-xl flex items-center justify-center font-semibold text-gray-800">
                    <img class="w-48 md:w-64" src="{{ asset('frontend/images/logo.png') }}">
                </a>
            </div>
        </header>

       <main class="bg-gray-100 px-6 py-12 min-h-screen flex justify-center items-center">
            <div class="bg-white shadow-lg rounded-xl p-10 text-center w-full max-w-md">
                <h1 class="text-2xl font-bold text-gray-800">🎉 Exam Completed!</h1>

                <p class="mt-4 text-gray-600">
                    Thank you for completing the exam.
                </p>
                <p class="mt-2 text-gray-600">
                    Your results are being reviewed. Please check back later or look out for an email notification with your score.
                </p>

                <a href="/user/index"
                   class="mt-6 inline-block bg-blue-600 text-white px-6 py-3 rounded-lg shadow hover:bg-blue-700 transition">
                    Go to Dashboard
                </a>
            </div>
        </main>

        @include('exam.dashboard.layouts.footer')
    </div>
</div>




