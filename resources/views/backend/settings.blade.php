@include('backend.layouts.tailwind.header')
@include('backend.layouts.tailwind.nav', ['active' => 'settings'])

<div class="mb-6">
    <h1 class="font-step-heading font-bold text-2xl text-gray-900">Settings</h1>
    <nav class="text-sm text-gray-500 mt-1">
        <a href="/admin/index" class="hover:text-step-primary">Home</a>
        <span class="mx-1">/</span>
        <span class="text-step-primary">Settings</span>
    </nav>
</div>

@if (session('status'))
    <div class="mb-6 rounded-md px-4 py-3 text-sm {{ session('status')['type'] === 'success' ? 'bg-green-50 text-green-700 border border-green-200' : 'bg-red-50 text-red-700 border border-red-200' }}">
        {{ session('status')['text'] }}
    </div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    {{-- Site Settings --}}
    <div class="lg:col-span-2 bg-white rounded-lg border border-gray-200 p-6 sm:p-8">
        <h2 class="font-step-heading font-semibold text-lg text-step-primary mb-1">Site Information</h2>
        <p class="text-sm text-gray-500 mb-6">Shown across the public site — header contact details, footer, page titles.</p>

        <form action="/admin/settings" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Site Name</label>
                    @if ($errors->has('site_name')) <span class="block text-red-600 text-sm mb-1">{{ $errors->first('site_name') }}</span> @endif
                    <input type="text" name="site_name" value="{{ old('site_name', $settings['site_name']) }}" required class="w-full h-11 rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm px-3">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Site Title</label>
                    @if ($errors->has('site_title')) <span class="block text-red-600 text-sm mb-1">{{ $errors->first('site_title') }}</span> @endif
                    <input type="text" name="site_title" value="{{ old('site_title', $settings['site_title']) }}" required class="w-full h-11 rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm px-3">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Contact Email</label>
                    @if ($errors->has('site_email')) <span class="block text-red-600 text-sm mb-1">{{ $errors->first('site_email') }}</span> @endif
                    <input type="email" name="site_email" value="{{ old('site_email', $settings['site_email']) }}" required class="w-full h-11 rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm px-3">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Contact Phone</label>
                    @if ($errors->has('site_phone')) <span class="block text-red-600 text-sm mb-1">{{ $errors->first('site_phone') }}</span> @endif
                    <input type="text" name="site_phone" value="{{ old('site_phone', $settings['site_phone']) }}" required class="w-full h-11 rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm px-3">
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Address</label>
                @if ($errors->has('site_address')) <span class="block text-red-600 text-sm mb-1">{{ $errors->first('site_address') }}</span> @endif
                <textarea name="site_address" rows="2" class="w-full rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm px-3 py-2.5">{{ old('site_address', $settings['site_address']) }}</textarea>
            </div>

            <hr class="border-gray-100">

            <p class="text-sm font-semibold text-gray-700">Social Links</p>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs text-gray-500 mb-1.5">Facebook</label>
                    <input type="url" name="facebook_url" placeholder="https://facebook.com/..." value="{{ old('facebook_url', $settings['facebook_url']) }}" class="w-full h-11 rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm px-3">
                </div>
                <div>
                    <label class="block text-xs text-gray-500 mb-1.5">Twitter / X</label>
                    <input type="url" name="twitter_url" placeholder="https://x.com/..." value="{{ old('twitter_url', $settings['twitter_url']) }}" class="w-full h-11 rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm px-3">
                </div>
                <div>
                    <label class="block text-xs text-gray-500 mb-1.5">LinkedIn</label>
                    <input type="url" name="linkedin_url" placeholder="https://linkedin.com/..." value="{{ old('linkedin_url', $settings['linkedin_url']) }}" class="w-full h-11 rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm px-3">
                </div>
            </div>

            <button type="submit" class="bg-step-primary text-white font-step-heading font-semibold px-6 py-2.5 rounded-full hover:bg-step-accent transition-colors">Save Settings</button>
        </form>
    </div>

    {{-- Change Password --}}
    <div class="bg-white rounded-lg border border-gray-200 p-6 sm:p-8 h-fit">
        <h2 class="font-step-heading font-semibold text-lg text-step-primary mb-1">Change Password</h2>
        <p class="text-sm text-gray-500 mb-6">Logged in as <strong>{{ $admin->username ?? 'admin' }}</strong></p>

        <form action="/admin/settings/password" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Current Password</label>
                @if ($errors->has('current_password')) <span class="block text-red-600 text-sm mb-1">{{ $errors->first('current_password') }}</span> @endif
                <input type="password" name="current_password" required class="w-full h-11 rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm px-3">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">New Password</label>
                @if ($errors->has('password')) <span class="block text-red-600 text-sm mb-1">{{ $errors->first('password') }}</span> @endif
                <input type="password" name="password" required minlength="8" class="w-full h-11 rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm px-3">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Confirm New Password</label>
                <input type="password" name="password_confirmation" required minlength="8" class="w-full h-11 rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm px-3">
            </div>

            <button type="submit" class="w-full bg-gray-900 text-white font-step-heading font-semibold px-6 py-2.5 rounded-full hover:bg-gray-700 transition-colors">Update Password</button>
        </form>
    </div>
</div>

@include('backend.layouts.tailwind.footer')
