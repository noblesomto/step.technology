@include('frontend.layouts.tailwind.header')
@include('frontend.layouts.tailwind.nav')
@include('frontend.layouts.tailwind.page-header', ['pageTitle' => 'Account Section', 'breadcrumb' => 'Register'])

<section class="py-16">
    <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 lg:grid-cols-12 gap-8">
        <div class="lg:col-span-8 lg:order-2">
            <div class="text-center mb-8">
                <h1 class="font-step-heading font-bold text-2xl sm:text-3xl text-step-primary">Register as Corporate Professional</h1>
                <span class="block w-16 h-1 bg-step-accent mx-auto mt-4"></span>
            </div>

            @if (session('status'))
                <div class="mb-6 rounded-md px-4 py-3 text-sm {{ session('status')['type'] === 'success' ? 'bg-green-50 text-green-700 border border-green-200' : 'bg-red-50 text-red-700 border border-red-200' }}">
                    {{ session('status')['text'] }}
                </div>
            @endif

            <form action="/register-corporate-professional" method="POST" class="bg-white rounded-lg border border-gray-200 p-6 sm:p-8 space-y-4">
                @csrf
                <div>
                    @if ($errors->has('title')) <span class="block text-red-600 text-sm mb-1">{{ $errors->first('title') }}</span> @endif
                    <select name="title" required class="w-full h-11 rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm px-3">
                        <option value="">Select Title</option>
                        <option value="Mr">Mr</option>
                        <option value="Miss">Miss</option>
                        <option value="Mrs">Mrs</option>
                        <option value="Engr">Engr</option>
                        <option value="Dr">Dr</option>
                        <option value="Prof">Prof</option>
                    </select>
                </div>
                <div>
                    @if ($errors->has('first_name')) <span class="block text-red-600 text-sm mb-1">{{ $errors->first('first_name') }}</span> @endif
                    <input type="text" name="first_name" placeholder="First Name *" required value="{{ old('first_name') }}" class="w-full h-11 rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm px-3">
                </div>
                <div>
                    @if ($errors->has('last_name')) <span class="block text-red-600 text-sm mb-1">{{ $errors->first('last_name') }}</span> @endif
                    <input type="text" name="last_name" placeholder="Last Name *" required value="{{ old('last_name') }}" class="w-full h-11 rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm px-3">
                </div>
                <div>
                    @if ($errors->has('phone')) <span class="block text-red-600 text-sm mb-1">{{ $errors->first('phone') }}</span> @endif
                    <input type="tel" name="phone" placeholder="Phone Number *" required value="{{ old('phone') }}" class="w-full h-11 rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm px-3">
                </div>
                <div>
                    @if ($errors->has('profession')) <span class="block text-red-600 text-sm mb-1">{{ $errors->first('profession') }}</span> @endif
                    <input type="text" name="profession" placeholder="Professional Discipline *" required value="{{ old('profession') }}" class="w-full h-11 rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm px-3">
                </div>
                <div>
                    @if ($errors->has('email')) <span class="block text-red-600 text-sm mb-1">{{ $errors->first('email') }}</span> @endif
                    <input type="email" name="email" placeholder="Enter Email *" required value="{{ old('email') }}" class="w-full h-11 rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm px-3">
                </div>
                <div>
                    @if ($errors->has('password')) <span class="block text-red-600 text-sm mb-1">{{ $errors->first('password') }}</span> @endif
                    <input type="password" name="password" placeholder="Enter Password *" required class="w-full h-11 rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm px-3">
                </div>

                <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4 pt-2">
                    <button type="submit" class="bg-step-primary text-white font-step-heading font-semibold px-6 py-2.5 rounded-full hover:bg-step-accent transition-colors">Register</button>
                    <p class="text-sm text-gray-500"><span class="text-step-alert">*</span> You must fill all the fields.</p>
                </div>
            </form>
        </div>

        <div class="lg:col-span-4 lg:order-1">
            @include('frontend.layouts.tailwind.register-sidebar', ['active' => 'corporate-professional'])
        </div>
    </div>
</section>

@include('frontend.layouts.tailwind.footer')
