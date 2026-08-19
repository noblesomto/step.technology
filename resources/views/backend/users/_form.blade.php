{{-- Params: $user (null on create), $passwordRequired (bool) --}}
@php
    $user = $user ?? null;
    $val = fn ($field, $default = '') => old($field, $user->{$field} ?? $default);
    $titles = ['Mr', 'Miss', 'Mrs', 'Engr', 'Dr', 'Prof'];
    $userTypes = ['Young Professional', 'Undergraduate', 'Corporate Professional', 'Corporate Organisation'];
@endphp

<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Title</label>
        <select name="title" class="w-full h-11 rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm px-3">
            <option value="">Select Title</option>
            @foreach ($titles as $t)
                <option value="{{ $t }}" @selected($val('title') === $t)>{{ $t }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Gender</label>
        <select name="gender" class="w-full h-11 rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm px-3">
            <option value="">Select Gender</option>
            <option value="Male" @selected($val('gender') === 'Male')>Male</option>
            <option value="Female" @selected($val('gender') === 'Female')>Female</option>
        </select>
    </div>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1.5">First Name</label>
        @if ($errors->has('first_name')) <span class="block text-red-600 text-sm mb-1">{{ $errors->first('first_name') }}</span> @endif
        <input type="text" name="first_name" value="{{ $val('first_name') }}" required class="w-full h-11 rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm px-3">
    </div>
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Last Name</label>
        @if ($errors->has('last_name')) <span class="block text-red-600 text-sm mb-1">{{ $errors->first('last_name') }}</span> @endif
        <input type="text" name="last_name" value="{{ $val('last_name') }}" required class="w-full h-11 rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm px-3">
    </div>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Phone</label>
        @if ($errors->has('phone')) <span class="block text-red-600 text-sm mb-1">{{ $errors->first('phone') }}</span> @endif
        <input type="text" name="phone" value="{{ $val('phone') }}" required class="w-full h-11 rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm px-3">
    </div>
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Email</label>
        @if ($errors->has('email')) <span class="block text-red-600 text-sm mb-1">{{ $errors->first('email') }}</span> @endif
        <input type="email" name="email" value="{{ $val('email') }}" required class="w-full h-11 rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm px-3">
    </div>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Password {{ $passwordRequired ? '' : '(leave blank to keep current)' }}</label>
        @if ($errors->has('password')) <span class="block text-red-600 text-sm mb-1">{{ $errors->first('password') }}</span> @endif
        <input type="password" name="password" @if ($passwordRequired) required @endif minlength="6" class="w-full h-11 rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm px-3">
    </div>
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Profession</label>
        <input type="text" name="profession" value="{{ $val('profession') }}" class="w-full h-11 rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm px-3">
    </div>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1.5">User Type</label>
        @if ($errors->has('user_type')) <span class="block text-red-600 text-sm mb-1">{{ $errors->first('user_type') }}</span> @endif
        <select name="user_type" required class="w-full h-11 rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm px-3">
            <option value="">Select Type</option>
            @foreach ($userTypes as $t)
                <option value="{{ $t }}" @selected($val('user_type') === $t)>{{ $t }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Verification Status</label>
        <select name="acc_status" required class="w-full h-11 rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm px-3">
            <option value="1" @selected((string) $val('acc_status', '0') === '1')>Verified</option>
            <option value="0" @selected((string) $val('acc_status', '0') === '0')>Pending</option>
        </select>
    </div>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Membership Status</label>
        <select name="member_status" class="w-full h-11 rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm px-3">
            <option value="">Select Status</option>
            <option value="Pending" @selected($val('member_status') === 'Pending')>Pending</option>
            <option value="Confirmed" @selected($val('member_status') === 'Confirmed')>Confirmed</option>
        </select>
    </div>
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Reg/License No</label>
        <input type="text" value="{{ $user->reg_no ?? 'Not yet issued — generate from Reg Numbers once payment is confirmed and the exam is approved' }}" disabled class="w-full h-11 rounded-md border-gray-200 bg-gray-50 text-sm px-3 text-gray-500">
    </div>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Company Name</label>
        <input type="text" name="company_name" value="{{ $val('company_name') }}" class="w-full h-11 rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm px-3">
    </div>
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1.5">School Name</label>
        <input type="text" name="school_name" value="{{ $val('school_name') }}" class="w-full h-11 rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm px-3">
    </div>
</div>

<div>
    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Address</label>
    <input type="text" name="address" value="{{ $val('address') }}" class="w-full h-11 rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm px-3">
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1.5">City</label>
        <input type="text" name="city" value="{{ $val('city') }}" class="w-full h-11 rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm px-3">
    </div>
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1.5">State</label>
        <input type="text" name="state" value="{{ $val('state') }}" class="w-full h-11 rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm px-3">
    </div>
</div>
