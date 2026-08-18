@include('exam.frontend.layouts.header')



<section class="bg-body p-2 md:pt-10">
    <div class="max-w-5xl mx-auto">
        <div class="flex flex-col justify-center items-center">
            <h3 class="text-xl md:text-[30px] font-semibold">Admin Section Login </h3>
            
        </div>
    </div>

    <div class="max-w-2xl mx-auto bg-white p-3 md:p-10 mt-4 md:mt-10 mb-20 rounded-lg">
        @include('exam.frontend.components.flash-message')
        <form method="POST" action="/admin">
            @csrf
        
        <div class="mb-6 mt-4">
            @if ($errors->has('username'))
                <span class="text-red-900 my-1">{{ $errors->first('username') }}</span>
            @endif
            <label class="text-sm font-semibold">Username *</label>
            <input type="text" id="username" name="username" placeholder="Enter username" class="w-full px-3 py-2 border border-gray-300 rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" value="{{ old('username') }}" required>
          </div>

          <!-- Password Field -->
          <div class="mb-4 relative">
            @if ($errors->has('password'))
                <span class="text-red-900 my-1">{{ $errors->first('password') }}</span>
            @endif
            <label class="text-sm font-semibold">Password *</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" class="w-full px-3 py-2 border border-gray-300 rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" value="{{ old('password') }}" required>
            
            <!-- Show/Hide Button -->
            <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-500 mt-6">
              <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path d="M10 3C5.4 3 1.73 6.11.4 10c1.33 3.89 5 7 9.6 7s8.27-3.11 9.6-7C18.27 6.11 14.6 3 10 3zM10 15a5 5 0 110-10 5 5 0 010 10zm0-8a3 3 0 100 6 3 3 0 000-6z" />
              </svg>
            </button>
          </div>

    

          <div class="text-sm text-text_darker">
              <a href="/">Home Page ?</a>
          </div>

          <div class="mt-4">
            <button type="submit" class="btn btn-red w-full py-2 text-xl flex justify-center items-center">
                <span>Login</span>
                <span class="ml-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                      <path fill-rule="evenodd" d="M16.72 7.72a.75.75 0 0 1 1.06 0l3.75 3.75a.75.75 0 0 1 0 1.06l-3.75 3.75a.75.75 0 1 1-1.06-1.06l2.47-2.47H3a.75.75 0 0 1 0-1.5h16.19l-2.47-2.47a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                    </svg>
                </span>
            </button>
          </div>

   
       
        
        </form>
        
    </div>
</section>






