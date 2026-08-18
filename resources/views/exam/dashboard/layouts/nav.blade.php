<div id="sidebar" class="fixed md:sticky top-0 h-screen z-30 inset-y-0 left-0 w-64 bg-dark text-white font-normal transform -translate-x-full md:relative md:translate-x-0 transition-transform duration-300 ease-in-out">
  <!-- User profile section -->
    <div class="flex flex-col items-center space-y-3 mt-10">
        @if($user->profile_picture=="")
            <img class="w-20 h-20 rounded-full object-cover" src="{{ asset('frontend/images/user.png') }}" alt="{{ $user->first_name }}">
        @else
            <img class="w-20 h-20 rounded-full object-cover" src="{{ asset('uploads/profile/'. $user->profile_picture) }}" alt="{{ $user->first_name }}">
        @endif
        <div class="text-center">
            <h2 class="text-lg font-semibold">{{ $user->first_name }} {{ $user->last_name }}</h2>
            <p class="text-sm text-white">{{ $user->email }}</p>
 
        </div>

    </div>
    <div class="p-6">
        
        <nav class="mt-1">
            <a href="/user/index" class="block py-2.5 px-4 rounded hover:bg-text_red">Dashboard</a>
            @if($user->exam_taken =="yes")
            <a href="" class="block py-2.5 px-4 rounded hover:bg-text_red">Exam Taken</a>
            @else
            <a href="/user/start-exam" class="block py-2.5 px-4 rounded hover:bg-text_red" >Start Exam</a>
            @endif

            <a href="/user/logout" class="block py-2.5 px-4 rounded hover:bg-text_red">Logout</a>
        </nav>
    </div>
</div>
