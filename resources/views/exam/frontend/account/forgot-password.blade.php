@include('exam.frontend.layouts.header')
@include('exam.frontend.layouts.nav')


<section class="bg-body p-2 md:pt-10">
    <div class="max-w-5xl mx-auto">
        <div class="flex flex-col justify-center items-center">
            <h3 class="text-xl md:text-[30px] font-semibold">Forgot Password </h3>
            
        </div>
    </div>

    <div class="max-w-2xl mx-auto bg-white p-3 md:p-10 mt-4 md:mt-10 mb-20 rounded-lg">
        @include('exam.frontend.components.flash-message')
        <form method="POST" action="/forgot-password">
            @csrf
        
        <div class="mb-6 mt-4">
            @if ($errors->has('email'))
                <span class="text-red-900 my-1">{{ $errors->first('email') }}</span>
            @endif
            <label class="text-sm font-semibold">Email *</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" class="w-full px-3 py-2 border border-gray-300 rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" value="{{ old('email') }}" required>
          </div>

        

          <div class="mt-4">
            <button type="submit" class="btn btn-red w-full py-2 text-xl flex justify-center items-center">
                <span>Submit</span>
                <span class="ml-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                      <path fill-rule="evenodd" d="M16.72 7.72a.75.75 0 0 1 1.06 0l3.75 3.75a.75.75 0 0 1 0 1.06l-3.75 3.75a.75.75 0 1 1-1.06-1.06l2.47-2.47H3a.75.75 0 0 1 0-1.5h16.19l-2.47-2.47a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                    </svg>
                </span>
            </button>
          </div>

          <div class="mt-8 flex justify-center text-sm">
           Not registered yet? <a class="mx-2 font-black underline" href="https://step.technology/register">Create an account</a>
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


