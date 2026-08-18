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
		        <h1 class="text-2xl font-bold mb-5">Review Section</h1>
		        	@include('exam.dashboard.layouts.flash-message')
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
			            			<h2 class="text-lg font-semibold py-5">Drop a Review for <span class="text-green-700">{{ $list->list_title }}</span> </h2>
			            		</div>

			            		@if($review && $review->rating !== null)
			            			<div class="flex bg-gray-100 gap-5 p-4 mb-5">
				            			<div>
				            				@if($user->profile_picture=="")
									            <img class="w-20 h-20 rounded-full object-cover" src="{{ asset('frontend/images/user.png') }}" alt="{{ $user->first_name }}">
									        @else
									            <img class="w-20 h-20 rounded-full object-cover" src="{{ asset('uploads/profile/'. $user->profile_picture) }}" alt="{{ $user->first_name }}">
									        @endif
				            			</div>
				            			<div class="flex-col justify-between w-full">
				            				<div class="text-lg">{{ $review->comment }}</div>
				            				<div class="flex justify-between mt-6">
				            					<div id="star-rating" class="flex space-x-1 text-3xl text-yellow-500"></div>
				            					<div>
				            						@if($review->review_status==0)
				            							<a href="/edit-review/{{ $book_id }}" class="btn btn-green py-2">Edit Review</a>
				            						@endif
				            					</div>
				            				</div>
				            			</div>
				            		</div>
			            		@endif
			            		<form id="ratingForm" method="POST" action="/update-review/{{ $book_id }}" >
			            			@csrf
			            			<div class="flex space-x-2">
								      <!-- Star 1 -->
								      <label>
								        <input type="radio" name="rating" value="1" class="hidden peer">
								        <span class="text-3xl cursor-pointer peer-checked:text-yellow-400 text-gray-300">★</span>
								      </label>
								      <!-- Star 2 -->
								      <label>
								        <input type="radio" name="rating" value="2" class="hidden peer">
								        <span class="text-3xl cursor-pointer peer-checked:text-yellow-400 text-gray-300">★</span>
								      </label>
								      <!-- Star 3 -->
								      <label>
								        <input type="radio" name="rating" value="3" class="hidden peer">
								        <span class="text-3xl cursor-pointer peer-checked:text-yellow-400 text-gray-300">★</span>
								      </label>
								      <!-- Star 4 -->
								      <label>
								        <input type="radio" name="rating" value="4" class="hidden peer">
								        <span class="text-3xl cursor-pointer peer-checked:text-yellow-400 text-gray-300">★</span>
								      </label>
								      <!-- Star 5 -->
								      <label>
								        <input type="radio" name="rating" value="5" class="hidden peer">
								        <span class="text-3xl cursor-pointer peer-checked:text-yellow-400 text-gray-300">★</span>
								      </label>
								    </div>

			            			<div class="mb-4 mt-4">
							            <label class="text-sm font-semibold">Comment *</label>
							            @if ($errors->has('comment'))
							                <span class="text-red-700 py-1">{{ $errors->first('comment') }}</span>
							            @endif
							            <textarea name="comment" rows="5" class="w-full px-3 py-2 border border-gray-300 rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>{{ $review->comment }}</textarea>
							            
							        </div>
							        <p id="errorMessage" class="text-red-500 text-sm mt-2 hidden">Please select a rating before submitting.</p>
							        <div class="mt-5 flex">
							        	<button type="submit" class="btn2 btn-red py-2 px-7 mr-5">Update Review</button>
							        </div>
			            		</form>
		            		</div>
		            	</div>
		        </div>
		    </div>
        </main>

<script>
	document.querySelectorAll('input[name="rating"]').forEach((radio) => {
    radio.addEventListener('change', (e) => {
      const selectedValue = e.target.value;
      document.querySelectorAll('input[name="rating"]').forEach((r, index) => {
        if (index < selectedValue) {
          r.nextElementSibling.classList.add('text-yellow-400');
        } else {
          r.nextElementSibling.classList.remove('text-yellow-400');
        }
      });
    });
  });

    document.getElementById('ratingForm').addEventListener('submit', (e) => {
      const ratingSelected = document.querySelector('input[name="rating"]:checked');
      const errorMessage = document.getElementById('errorMessage');

      if (!ratingSelected) {
        e.preventDefault(); // Prevent form submission
        errorMessage.classList.remove('hidden'); // Show error message
      } else {
        errorMessage.classList.add('hidden'); // Hide error message if rating is selected
      }
    });
  </script>

<script>
    function renderStars(rating) {
        const starContainer = document.getElementById("star-rating");
        starContainer.innerHTML = ""; // Clear previous stars

        for (let i = 1; i <= 5; i++) {
            const star = document.createElement("span");
            star.innerHTML = i <= rating ? "★" : "☆"; // Filled or empty star
            star.classList.add(i <= rating ? "text-yellow-500" : "text-gray-300");
            starContainer.appendChild(star);
        }
    }

    @if($review && $review->rating !== null)
	    renderStars({{ $review->rating }}); // Render stars based on the rating
	@else
	    renderStars(0); // Render empty stars if review is null or rating is null
	@endif
</script>

        @include('exam.dashboard.layouts.footer')
    </div>
</div>




