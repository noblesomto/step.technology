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

        <main class="bg-grey-100 p-6 flex-grow">
            <div class="container mx-auto p-1">
		        <h1 class="text-2xl font-bold mb-5">Cancel Booking</h1>

		        <!-- Cards Container -->
		            <div class="grid grid-cols-1 md:grid-cols-10 gap-6">
		            	<div class="col-span-10 md:col-span-3">
		            		<div>
		            			<img class="w-full h-full object-cover" src="{{ asset('uploads/featured-images/'.$list->featured_image) }}">
		            		</div>
		            		@include('exam.dashboard.layouts.sidebar')
		            	</div>
		            	<div class="col-span-10 md:col-span-5">
		            		<div class="p-6 bg-white">
		            			<div>
			            			<h2 class="text-lg font-semibold py-5">Cancellation Policy for Booked Apartment ({{ $list->list_title }})</h2>
			            		</div>
			            		<p>
			            			We understand that plans can change unexpectedly, and we aim to provide flexibility where possible. If you need to cancel your apartment booking, please note that cancellations made within 48 hours of the booking confirmation may be eligible for a full refund, provided the check-in date is at least 14 days away. Cancellations made between 7 and 14 days before check-in will receive a 50% refund, while cancellations made less than 7 days before check-in will not be eligible for a refund. In the event of extenuating circumstances, we encourage you to contact our customer support for further assistance.
			            		</p>
			            		<p class="mt-5">
			            			Please be aware that any service fees associated with the booking are non-refundable, and refunds will be processed using the original payment method. Additionally, if the apartment was part of a promotional deal or special offer, cancellation policies specific to that offer may apply. We recommend reviewing your booking details and considering all options before proceeding with the cancellation.
			            		</p>
			            		<div class="mt-10 flex">
			            			<a class="btn2 btn-red py-2 px-7 mr-5" href="/user/cancel-order/{{ $list->book_id }}" onclick="return confirm('Are you sure you want to Cancel?');">Procced to Cancel</a>
			            			
			            		</div>
		            		</div>
		            	</div>
		        </div>
		    </div>
        </main>
        @include('exam.dashboard.layouts.footer')
    </div>
</div>




