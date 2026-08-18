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
		        <h1 class="text-xl md:text-3xl font-bold my-3">Profile Settings</h1>
		        @include('exam.dashboard.layouts.flash-message')

		        <!-- Cards Container -->
		        <div class="">
		            
		        	<div class="max-w-2xl mx-auto bg-white p-3 md:p-10 mt-4 md:mt-10 mb-20 rounded-lg">
				        <form method="POST" action="/user/profile" enctype="multipart/form-data">
				            @csrf
				            @method('PUT')
				        <div class="mt-1 font-semibold text-xl">Personal Details:</div>

				        <div class="mb-4 mt-4">
				            
				            <label class="text-sm font-semibold">First *</label>
				            @if ($errors->has('first_name'))
				                <span class="text-red-700 py-1">{{ $errors->first('first_name') }}</span>
				            @endif
				            <input type="text" id="name" name="first_name" placeholder="First Name" value="{{ $user->first_name }}" class="w-full px-3 py-2 border border-gray-300 rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
				        </div>


				        <div class="mb-4 mt-4">
				            
				            <label class="text-sm font-semibold">Last *</label>
				            @if ($errors->has('last_name'))
				                <span class="text-red-700 py-1">{{ $errors->first('last_name') }}</span>
				            @endif
				            <input type="text" id="name" name="last_name" placeholder="Last Name" value="{{ $user->last_name }}" class="w-full px-3 py-2 border border-gray-300 rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
				        </div>

				        <div class="mb-4 mt-4">
				            <label class="text-sm font-semibold">Phone *</label>
				            @if ($errors->has('phone'))
				                <span class="text-red-700 py-1">{{ $errors->first('phone') }}</span>
				            @endif
				            <input type="text" id="name" name="phone" placeholder="Phone Number" value="{{ $user->phone }}" class="w-full px-3 py-2 border border-gray-300 rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
				        </div>

				        
				        <div class="mb-6 mt-4">
				            
				            <label class="text-sm font-semibold">Email *</label>
				            @if ($errors->has('email'))
				                <span class="text-red-900 my-1">{{ $errors->first('email') }}</span>
				            @endif
				            <input type="email" id="email" name="email" placeholder="Enter your email" value="{{ $user->email }}" class="w-full px-3 py-2 border border-gray-300 rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" value="{{ old('email') }}" readonly>
				          </div>


				         <div class="mb-6 mt-4">
				            
				           <label for="profile_image" class="block text-gray-700 text-sm font-bold mb-2">Profile Image</label>
				           @if ($errors->has('profile_image'))
				                <span class="text-red-900 my-1">{{ $errors->first('profile_image') }}</span>
				            @endif
						    <input type="file" name="profile_image" id="profile_image"
						        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
				          </div>

				         				    


				          <div class="mt-8">
				            <button type="submit" class="btn btn-red w-full py-2 text-xl flex justify-center items-center">
				                <span>Update</span>
				                <span class="ml-2">
				                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
				                      <path fill-rule="evenodd" d="M16.72 7.72a.75.75 0 0 1 1.06 0l3.75 3.75a.75.75 0 0 1 0 1.06l-3.75 3.75a.75.75 0 1 1-1.06-1.06l2.47-2.47H3a.75.75 0 0 1 0-1.5h16.19l-2.47-2.47a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
				                    </svg>
				                </span>
				            </button>
				          </div>

						
						 <div class="mb-6 mt-10">
				            
				           <label for="profile_image" class="block text-gray-700 text-sm font-bold mb-2">My Refferal Link</label>
				           <input id="copyInput" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ url('/register/'.$user->user_id) }}" readonly>
                        	<button class="mt-2 btn btn-primary" onclick="copyFromInput()">Copy</button>
						  
				          </div>

				         
				        
				        </form>
				        
				    </div>
		            
		        </div>
		  
		    </div>
        </main>

        <script>
		function copyFromInput() {
		    let copyText = document.getElementById("copyInput");
		    copyText.select();
		    copyText.setSelectionRange(0, 99999); // For mobile
		    navigator.clipboard.writeText(copyText.value);
		    alert("Copied: " + copyText.value);
		}
		</script>
		@include('exam.dashboard.layouts.footer')
    </div>
</div>

