@include('exam.dashboard.layouts.header')
@include('exam.dashboard.layouts.nav', ['active' => 'profile'])

<div class="mb-6">
    <h1 class="font-step-heading font-bold text-2xl text-gray-900">Profile Settings</h1>
</div>

@include('exam.dashboard.layouts.flash-message')

<div class="bg-white rounded-lg border border-gray-200 p-6 sm:p-8 max-w-2xl">
    <h5 class="font-step-heading font-semibold text-lg text-step-primary mb-4">Personal Details</h5>

    <form method="POST" action="/user/profile" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">First Name</label>
            @if ($errors->has('first_name'))
                <span class="block text-red-600 text-sm mb-1">{{ $errors->first('first_name') }}</span>
            @endif
            <input type="text" name="first_name" value="{{ old('first_name', $user->first_name) }}" required class="w-full h-11 rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm px-3">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Last Name</label>
            @if ($errors->has('last_name'))
                <span class="block text-red-600 text-sm mb-1">{{ $errors->first('last_name') }}</span>
            @endif
            <input type="text" name="last_name" value="{{ old('last_name', $user->last_name) }}" required class="w-full h-11 rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm px-3">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Phone</label>
            @if ($errors->has('phone'))
                <span class="block text-red-600 text-sm mb-1">{{ $errors->first('phone') }}</span>
            @endif
            <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" required class="w-full h-11 rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm px-3">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Email</label>
            <input type="email" value="{{ $user->email }}" readonly class="w-full h-11 rounded-md border-gray-200 bg-gray-50 text-gray-500 text-sm px-3">
        </div>

        <div class="mb-6">
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Profile Image</label>
            @if ($errors->has('profile_image'))
                <span class="block text-red-600 text-sm mb-1">{{ $errors->first('profile_image') }}</span>
            @endif
            <input type="file" name="profile_image" class="text-sm text-gray-600 file:mr-4 file:py-2.5 file:px-4 file:rounded-md file:border-0 file:bg-step-primary/10 file:text-step-primary file:font-semibold hover:file:bg-step-primary/20">
        </div>

        <button type="submit" class="bg-step-primary text-white font-step-heading font-semibold px-6 py-2.5 rounded-full hover:bg-step-accent transition-colors">Update Profile</button>
    </form>
</div>

@include('exam.dashboard.layouts.footer')
