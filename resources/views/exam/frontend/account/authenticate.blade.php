@include('exam.frontend.components.layouts.header')


<div class="bg-white h-screen">
	

<section class="w-full flex justify-center items-center h-24 border-b-2 border-b-gray-400 shadow-lg shadow-b-2.5 shadow-gray-300">
	<a href="/"><img src="{{ asset('frontend/images/logo.svg') }}" class="h-9"></a>
</section>

<section class="w-full md:w-2/6 mx-auto bg-white p-10 mt-10 rounded-[20px] shadow-lg">
	
	<div class="w-full  mx-auto ">

		@include('exam.frontend.components.layouts.flash-message')
		<form method="POST" action="/authenticate">
			@csrf
		<div class="mb-5">
			<h2 class="font-bold text-3xl mt-5 w-full">Enter 6 Digits OTP</h2>
			<p class="text-base mt-3"></p>
		</div>

	
		<div class="mb-6 mt-10">
			@if ($errors->has('email'))
                <span class="text-red-900 my-1">{{ $errors->first('email') }}</span>
            @endif
            <label>Enter OTP *</label>
		    <input type="number" id="email" name="otp" placeholder="Enter 6 digits OTP" class="w-full px-3 py-2 border border-gray-300 rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" value="{{ old('email') }}" required>
		  </div>

	
		  <div class="mt-8">
		  	<button type="submit" class="w-full bg-secondary-200 hover:bg-secondary-100 text-lg text-dark_green font-black py-3 px-2 rounded-full flex justify-center items-center">
		  		<span>Login</span>
		  		<span class="ml-2.l.,.,">
		  			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
					  <path fill-rule="evenodd" d="M16.72 7.72a.75.75 0 0 1 1.06 0l3.75 3.75a.75.75 0 0 1 0 1.06l-3.75 3.75a.75.75 0 1 1-1.06-1.06l2.47-2.47H3a.75.75 0 0 1 0-1.5h16.19l-2.47-2.47a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
					</svg>
		  		</span>
		  	</button>
		  </div>

		  <div class="mt-8 flex justify-center text-lg">
		  	OTP not received? <a class="mx-2 font-black underline" href="/resend-otp">Resend OTP</a>
		  </div>

		 
		
		</form>
	</div>

	
</section>

</div>
<script>
  function togglePassword() {
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');

    // Toggle the input type between 'password' and 'text'
    if (passwordInput.type === 'password') {
      passwordInput.type = 'text';
      eyeIcon.innerHTML = '<path fill-rule="evenodd" d="M10 3C5.4 3 1.73 6.11.4 10c1.33 3.89 5 7 9.6 7s8.27-3.11 9.6-7C18.27 6.11 14.6 3 10 3zM10 15a5 5 0 110-10 5 5 0 010 10zm-7.5-5a8.24 8.24 0 017.5-5 8.24 8.24 0 017.5 5 8.24 8.24 0 01-7.5 5 8.24 8.24 0 01-7.5-5z" clip-rule="evenodd"/>';
    } else {
      passwordInput.type = 'password';
      eyeIcon.innerHTML = '<path d="M10 3C5.4 3 1.73 6.11.4 10c1.33 3.89 5 7 9.6 7s8.27-3.11 9.6-7C18.27 6.11 14.6 3 10 3zM10 15a5 5 0 110-10 5 5 0 010 10zm0-8a3 3 0 100 6 3 3 0 000-6z"/>';
    }
  }
</script>



@include('exam.frontend.components.layouts.footer')


