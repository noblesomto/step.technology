@include('exam.dashboard.layouts.header')
@inject('carbon', 'Carbon\Carbon')
<div class="min-h-screen flex">
    <!-- Sidebar -->
    @include('exam.dashboard.layouts.nav')
 <style>
        .qr-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
        }
        .qr-code img {
            width: 100%; /* Full width */
            max-width: 300px; /* Max size on larger screens */
            height: auto;
        }
        @media (max-width: 768px) {
            .qr-code img {
                max-width: 200px; /* Smaller size for tablets */
            }
        }
        @media (max-width: 480px) {
            .qr-code img {
                max-width: 150px; /* Even smaller size for phones */
            }
        }
    </style>
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

        <main class="bg-grey-100 px-6 pb-20 flex-grow">
            <div class="container mx-auto p-1">
		        <h1 class="text-xl md:text-3xl font-bold my-3">Booking Code</h1>
		        @include('exam.dashboard.layouts.flash-message')

		        <!-- Cards Container -->
		        <div class="">
		            
		        	<div class="max-w-2xl mx-auto bg-white p-3 md:p-10 mt-4 md:mt-10 mb-20 rounded-lg">
				        <h4 class="font-semibold text-center">Booking QR Code</h4>

                        <div class="flex justify-center qr-container">
                        	<div class="qr-code">
                        		{!! QrCode::size(270)->format('svg')->generate('https://jjhomelondon.co.uk/review-booking/'.$list->book_id) !!}
                        	</div>
                        </div>
                        <div class="mt-4  flex items-center justify-center gap-2">
                        	<span class="">Book Id: </span>
                        	<span class="text-xl text-green-600">{{ $list->book_id }}</span>
                        </div>
				        
				    </div>
		            
		        </div>
		  
		    </div>
        </main>


		@include('exam.dashboard.layouts.footer')
    </div>
</div>

