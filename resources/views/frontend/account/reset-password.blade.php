@include('frontend.layouts.tailwind.header')
@include('frontend.layouts.tailwind.nav')
@include('frontend.layouts.tailwind.page-header', ['pageTitle' => 'Account Section', 'breadcrumb' => 'Login'])

<section class="py-16">
    <div class="max-w-lg mx-auto px-4">
        <div class="text-center mb-8">
            <h1 class="font-step-heading font-bold text-2xl sm:text-3xl text-step-primary">Reset Password</h1>
            <span class="block w-16 h-1 bg-step-accent mx-auto mt-4"></span>
        </div>

        @if (session('status'))
            <div class="mb-6 rounded-md px-4 py-3 text-sm {{ session('status')['type'] === 'success' ? 'bg-green-50 text-green-700 border border-green-200' : 'bg-red-50 text-red-700 border border-red-200' }}">
                {{ session('status')['text'] }}
            </div>
        @endif

        <form action="/reset-password/{{ $post['user_id'] }}/{{ $post['token'] }}" method="POST" class="bg-white rounded-lg border border-gray-200 p-6 sm:p-8 space-y-4">
            @csrf
            <div>
                @if ($errors->has('password'))
                    <span class="block text-red-600 text-sm mb-1">{{ $errors->first('password') }}</span>
                @endif
                <div class="relative">
                    <input type="password" name="password" placeholder="Enter Password" required class="w-full rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm pl-11 pr-4 py-2.5">
                    <i class="fa fa-unlock-alt absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                </div>
            </div>
            <div>
                @if ($errors->has('password_confirmation'))
                    <span class="block text-red-600 text-sm mb-1">{{ $errors->first('password_confirmation') }}</span>
                @endif
                <div class="relative">
                    <input type="password" name="password_confirmation" placeholder="Confirm Password" required class="w-full rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm pl-11 pr-4 py-2.5">
                    <i class="fa fa-unlock-alt absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                </div>
            </div>

            <button type="submit" class="bg-step-primary text-white font-step-heading font-semibold px-6 py-2.5 rounded-full hover:bg-step-accent transition-colors">Submit</button>
        </form>
    </div>
</section>

@include('frontend.layouts.tailwind.footer')
