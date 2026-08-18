@include('dashboard.layouts.tailwind.header')
@include('dashboard.layouts.tailwind.nav', ['active' => 'profile'])

<div class="mb-6">
    <h1 class="font-step-heading font-bold text-2xl text-gray-900">User Profile</h1>
</div>

<div class="bg-white rounded-lg border border-gray-200 p-6 sm:p-8">
    <h5 class="font-step-heading font-semibold text-lg text-step-primary mb-4">Edit Profile</h5>

    @if (session('status'))
        <div class="mb-6 rounded-md px-4 py-3 text-sm {{ session('status')['type'] === 'success' ? 'bg-green-50 text-green-700 border border-green-200' : 'bg-red-50 text-red-700 border border-red-200' }}">
            {{ session('status')['text'] }}
        </div>
    @endif

    <form action="/user/profile" method="POST" enctype="multipart/form-data">
        @csrf

        @if ($user->user_type == "Young Professional" || $user->user_type == "Corporate Professional")
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Title</label>
                @if ($errors->has('title'))
                    <span class="block text-red-600 text-sm mb-1">{{ $errors->first('title') }}</span>
                @endif
                <select name="title" class="w-full max-w-md h-11 rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm px-3">
                    <option value="">Select Title</option>
                    @foreach (['Mr', 'Miss', 'Mrs', 'Engr', 'Dr', 'Prof'] as $t)
                        <option value="{{ $t }}" @selected($user->title === $t)>{{ $t }}</option>
                    @endforeach
                </select>
            </div>

            @include('dashboard.layouts.tailwind.field', ['name' => 'first_name', 'label' => 'First Name', 'value' => $user->first_name, 'required' => true])
            @include('dashboard.layouts.tailwind.field', ['name' => 'last_name', 'label' => 'Last Name', 'value' => $user->last_name, 'required' => true])
            @include('dashboard.layouts.tailwind.field', ['name' => 'phone', 'label' => 'Phone', 'value' => $user->phone, 'required' => true])
            @include('dashboard.layouts.tailwind.field', ['name' => 'profession', 'label' => 'Profession', 'value' => $user->profession, 'required' => true])
            @include('dashboard.layouts.tailwind.field', ['name' => 'email', 'label' => 'Email', 'value' => $user->email, 'readonly' => true])
            @include('dashboard.layouts.tailwind.field', ['name' => 'address', 'label' => 'Address', 'value' => $user->address])
            @include('dashboard.layouts.tailwind.field', ['name' => 'city', 'label' => 'City', 'value' => $user->city])
            @include('dashboard.layouts.tailwind.field', ['name' => 'state', 'label' => 'State', 'value' => $user->state])

            <hr class="border-gray-100 my-6">

            @include('dashboard.layouts.tailwind.field', ['name' => 'company_name', 'label' => 'Company Name', 'value' => $user->company_name])

            <hr class="border-gray-100 my-6">

            @include('dashboard.layouts.tailwind.field', ['name' => 'referee_name', 'label' => 'Referee Name', 'value' => $user->referee_name, 'required' => true])
            @include('dashboard.layouts.tailwind.field', ['name' => 'referee_email', 'label' => 'Referee Email', 'value' => $user->referee_email, 'type' => 'email', 'required' => true])
            @include('dashboard.layouts.tailwind.field', ['name' => 'referee_phone', 'label' => 'Referee Phone', 'value' => $user->referee_phone, 'required' => true])
            @include('dashboard.layouts.tailwind.field', ['name' => 'referee_address', 'label' => 'Referee Address', 'value' => $user->referee_address, 'required' => true])

            <hr class="border-gray-100 my-6">

        @elseif ($user->user_type == "Undergraduate")
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Title</label>
                @if ($errors->has('title'))
                    <span class="block text-red-600 text-sm mb-1">{{ $errors->first('title') }}</span>
                @endif
                <select name="title" class="w-full max-w-md h-11 rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm px-3">
                    <option value="">Select Title</option>
                    @foreach (['Mr', 'Miss', 'Mrs'] as $t)
                        <option value="{{ $t }}" @selected($user->title === $t)>{{ $t }}</option>
                    @endforeach
                </select>
            </div>

            @include('dashboard.layouts.tailwind.field', ['name' => 'first_name', 'label' => 'First Name', 'value' => $user->first_name, 'required' => true])
            @include('dashboard.layouts.tailwind.field', ['name' => 'last_name', 'label' => 'Last Name', 'value' => $user->last_name, 'required' => true])
            @include('dashboard.layouts.tailwind.field', ['name' => 'phone', 'label' => 'Phone', 'value' => $user->phone, 'required' => true])
            @include('dashboard.layouts.tailwind.field', ['name' => 'email', 'label' => 'Email', 'value' => $user->email, 'readonly' => true])
            @include('dashboard.layouts.tailwind.field', ['name' => 'address', 'label' => 'Address', 'value' => $user->address])
            @include('dashboard.layouts.tailwind.field', ['name' => 'city', 'label' => 'City', 'value' => $user->city])
            @include('dashboard.layouts.tailwind.field', ['name' => 'state', 'label' => 'State', 'value' => $user->state])

            <hr class="border-gray-100 my-6">

            @include('dashboard.layouts.tailwind.field', ['name' => 'school_name', 'label' => 'School Name', 'value' => $user->school_name])
            @include('dashboard.layouts.tailwind.field', ['name' => 'school_faculty', 'label' => 'Faculty', 'value' => $user->school_faculty])
            @include('dashboard.layouts.tailwind.field', ['name' => 'school_dept', 'label' => 'Department', 'value' => $user->school_dept])

            <hr class="border-gray-100 my-6">

        @elseif ($user->user_type == "Corporate Organisation")
            @include('dashboard.layouts.tailwind.field', ['name' => 'company_name', 'label' => 'Company Name', 'value' => $user->company_name])
            @include('dashboard.layouts.tailwind.field', ['name' => 'phone', 'label' => 'Phone', 'value' => $user->phone, 'required' => true])
            @include('dashboard.layouts.tailwind.field', ['name' => 'email', 'label' => 'Email', 'value' => $user->email, 'readonly' => true])
            @include('dashboard.layouts.tailwind.field', ['name' => 'address', 'label' => 'Address', 'value' => $user->address])
            @include('dashboard.layouts.tailwind.field', ['name' => 'city', 'label' => 'City', 'value' => $user->city])
            @include('dashboard.layouts.tailwind.field', ['name' => 'state', 'label' => 'State', 'value' => $user->state])
        @endif

        <button type="submit" class="mt-4 bg-step-primary text-white font-step-heading font-semibold px-6 py-2.5 rounded-full hover:bg-step-accent transition-colors">Update Profile</button>
    </form>
</div>

@include('dashboard.layouts.tailwind.footer')
