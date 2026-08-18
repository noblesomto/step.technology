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

        <main class="bg-grey-100 px-6 pb-20 flex-grow">
            <div class="container mx-auto p-1">
		        <h1 class="text-xl md:text-3xl font-bold my-3">Benefits Level</h1>
		        @include('exam.dashboard.layouts.flash-message')

		        <!-- Cards Container -->
		        <div class="">
		            @php $totalAmount = calculateTotalAmount($user->user_id); @endphp
		        	<div class="max-w-2xl mx-auto  mt-4 md:mt-10 mb-20 rounded-lg">
				        
				        @if($totalAmount < 2000)
				        	<!-- Tier 1: Basic Tier -->
						    <div class="bg-white p-2 rounded-lg shadow-md">
						      <h2 class="text-2xl font-bold text-gray-800 mb-4">Explorer Level</h2>
						      <p class="text-gray-600 mb-4">Unlock your first step toward elevated stays. Simple perks to enhance your London experience.</p>
						      <h3 class="text-xl font-semibold text-gray-700 mb-2">Benefits</h3>
						      <ul class="list-disc list-inside text-gray-600 space-y-2">
						        <li>🔓 Welcome Discount: 5% off your first booking.</li>
						        <li>🔓 11 AM Checkout: Enjoy an extra hour to unwind (standard checkout at 10 AM).</li>
						        <li>🔓 Birthday Treat: £50 credit toward your next stay.</li>
						      </ul>
						    </div>
				        @elseif($totalAmount >= 2000 && $totalAmount < 5000)
				        	<!-- Tier 2: Silver Key -->
						    <div class="bg-white p-2 rounded-lg shadow-md">
						      <h2 class="text-2xl font-bold text-gray-800 mb-4">Silver Level</h2>
						      <p class="text-gray-600 mb-4">(Unlocks after £2,000 spent annually)</p>
						      <h3 class="text-xl font-semibold text-gray-700 mb-2">Benefits</h3>
						      <ul class="list-disc list-inside text-gray-600 space-y-2">
						        <li>✅ 12 PM Late Checkout: Extend your morning relaxation.</li>
						        <li>✅ Welcome Drink: Redeem for prosecco or wine.</li>
						        <li>✅ 5% Off Future Bookings: Applied automatically at checkout.</li>
						        <li>✅ Priority Support: Skip the queue for urgent requests.</li>
						      </ul>
						    </div>
						@elseif($totalAmount >= 5000 && $totalAmount < 10000)
							<!-- Tier 3: Gold Key -->
						    <div class="bg-white p-2 rounded-lg shadow-md">
						      <h2 class="text-2xl font-bold text-gray-800 mb-4">Gold Level</h2>
						      <p class="text-gray-600 mb-4">(Unlocks after £5,000 spent annually)</p>
						      <h3 class="text-xl font-semibold text-gray-700 mb-2">All Silver benefits, plus:</h3>
						      <ul class="list-disc list-inside text-gray-600 space-y-2">
						        <li>✨ 2 PM Late Checkout: Maximize your London day.</li>
						        <li>✨ Complimentary Mid-Stay Cleaning: For bookings of 7+ nights.</li>
						        <li>✨ Free Grocery Pre-Stocking: £50 budget for essentials (milk, snacks, wine).</li>
						        <li>✨ 10% Off Future Bookings: Applied automatically at checkout.</li>
						      </ul>
						    </div>

						@elseif($totalAmount >= 10000)
						    <!-- Tier 4: Platinum Key -->
						    <div class="bg-white p-2 rounded-lg shadow-md">
						      <h2 class="text-2xl font-bold text-gray-800 mb-4">Tier 4: Platinum Key</h2>
						      <p class="text-gray-600 mb-4">(Unlocks after £10,000 spent annually)</p>
						      <h3 class="text-xl font-semibold text-gray-700 mb-2">All Gold benefits, plus:</h3>
						      <ul class="list-disc list-inside text-gray-600 space-y-2">
						        <li>💎 4 PM Late Checkout: Treat your stay like a 5-star hotel.</li>
						        <li>💎 Luxury Airport Transfer: Mercedes sedan to/from Heathrow/Gatwick.</li>
						        <li>💎 Personalized Concierge: Restaurant reservations, event tickets, private tours.</li>
						        <li>💎 Annual Free Night: 1-night stay in any JJ Home apartment.</li>
						        <li>💎 15% Off Future Bookings: Applied automatically at checkout.</li>
						      </ul>
						    </div>
				        @endif
		
				        
				    </div>
		            
		        </div>
		  
		    </div>
        </main>


		@include('exam.dashboard.layouts.footer')
    </div>
</div>

