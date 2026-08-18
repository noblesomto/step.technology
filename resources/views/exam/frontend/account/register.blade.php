@include('exam.frontend.layouts.header')
@include('exam.frontend.layouts.nav')


<section class="bg-body p-2 md:pt-10">
    <div class="max-w-5xl mx-auto">
        <div class="flex flex-col justify-center items-center">
            <h3 class="text-xl md:text-[30px] font-semibold">Create an account</h3>
            <h5 class="text-sm md:text-base">It only takes a few minutes </h5>
        </div>
    </div>

    <div class="max-w-2xl mx-auto bg-white p-3 md:p-10 mt-4 md:mt-10 mb-20 rounded-lg">
        @include('exam.frontend.components.flash-message')
        <form action="/register{{ $ref_id ? '/' . $ref_id : '' }}" method="POST">
            @csrf

        <div class="mb-4 mt-4">
            
            <label class="text-sm font-semibold">First *</label>
            @if ($errors->has('first_name'))
                <span class="text-red-700 py-1">{{ $errors->first('first_name') }}</span>
            @endif
            <input type="text" id="name" name="first_name" placeholder="First Name" class="w-full px-3 py-2 border border-gray-300 rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" >
        </div>

        <div>
            <input type="hidden" name="ref_id" value="{{ $ref_id }}">
        </div>


        <div class="mb-4 mt-4">
            
            <label class="text-sm font-semibold">Last *</label>
            @if ($errors->has('last_name'))
                <span class="text-red-700 py-1">{{ $errors->first('last_name') }}</span>
            @endif
            <input type="text" id="name" name="last_name" placeholder="Last Name" class="w-full px-3 py-2 border border-gray-300 rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" >
        </div>

        <div class="mb-4 mt-4">
            <label class="text-sm font-semibold">Phone *</label>
            @if ($errors->has('phone'))
                <span class="text-red-700 py-1">{{ $errors->first('phone') }}</span>
            @endif
            <input type="text" id="name" name="phone" placeholder="Phone Number" value="{{ old('phone') }}" class="w-full px-3 py-2 border border-gray-300 rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
        </div>

        
        <div class="mb-6 mt-4">
            
            <label class="text-sm font-semibold">Email *</label>
            @if ($errors->has('email'))
                <span class="text-red-900 my-1">{{ $errors->first('email') }}</span>
            @endif
            <input type="email" id="email" name="email" placeholder="Enter your email" class="w-full px-3 py-2 border border-gray-300 rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" value="{{ old('email') }}" required>
          </div>

          <!-- Password Field -->
          <div class="mb-4 relative">
            
            <label class="text-sm font-semibold">Password *</label>
            @if ($errors->has('password'))
                <span class="text-red-900 my-1">{{ $errors->first('password') }}</span>
            @endif
            <input type="password" id="password" name="password" placeholder="Enter your password" class="w-full px-3 py-2 border border-gray-300 rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" value="{{ old('password') }}" required>
            
            <!-- Show/Hide Button -->
            <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-500 mt-6">
              <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path d="M10 3C5.4 3 1.73 6.11.4 10c1.33 3.89 5 7 9.6 7s8.27-3.11 9.6-7C18.27 6.11 14.6 3 10 3zM10 15a5 5 0 110-10 5 5 0 010 10zm0-8a3 3 0 100 6 3 3 0 000-6z" />
              </svg>
            </button>
          </div>

          <div class="mb-4 mt-4">
            <label class="text-sm font-semibold">ReCaptcha *</label>
            @if ($errors->has('g-recaptcha-response'))
               <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
           @endif
            <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}"></div>               
        </div>

    



          <div class="mt-8">
            <button type="submit" class="btn btn-red w-full py-2 text-xl flex justify-center items-center">
                <span>Create an Account</span>
                <span class="ml-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                      <path fill-rule="evenodd" d="M16.72 7.72a.75.75 0 0 1 1.06 0l3.75 3.75a.75.75 0 0 1 0 1.06l-3.75 3.75a.75.75 0 1 1-1.06-1.06l2.47-2.47H3a.75.75 0 0 1 0-1.5h16.19l-2.47-2.47a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                    </svg>
                </span>
            </button>
          </div>

          <div class="mt-8 flex justify-center text-sm">
             Already have an Account? <a class="mx-2 font-black underline" href="/login">Login</a>
            
          </div>

         
        
        </form>
        
    </div>
</section>


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

@include('exam.frontend.layouts.footer')


