@include('frontend.layouts.tailwind.header')
@include('frontend.layouts.tailwind.nav')
@include('frontend.layouts.tailwind.page-header', ['pageTitle' => 'Account Section', 'breadcrumb' => 'Login'])

<section class="py-16">
    <div class="max-w-lg mx-auto px-4">
        <div class="text-center mb-8">
            <h1 class="font-step-heading font-bold text-2xl sm:text-3xl text-step-primary">Login Now</h1>
            <span class="block w-16 h-1 bg-step-accent mx-auto mt-4"></span>
        </div>

        @if (session('status'))
            <div class="mb-6 rounded-md px-4 py-3 text-sm {{ session('status')['type'] === 'success' ? 'bg-green-50 text-green-700 border border-green-200' : 'bg-red-50 text-red-700 border border-red-200' }}">
                {{ session('status')['text'] }}
            </div>
        @endif

        <form action="/login" method="POST" class="bg-white rounded-lg border border-gray-200 p-6 sm:p-8 space-y-4">
            @csrf
            <div class="relative">
                <input type="email" name="email" placeholder="Email Address *" required class="w-full rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm pl-11 pr-4 py-2.5">
                <i class="fa fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
            </div>
            <div class="relative">
                <input type="password" name="password" placeholder="Enter Password" required class="w-full rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm pl-11 pr-4 py-2.5">
                <i class="fa fa-unlock-alt absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
            </div>

            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 pt-2">
                <div class="flex items-center gap-4">
                    <button type="submit" class="bg-step-primary text-white font-step-heading font-semibold px-6 py-2.5 rounded-full hover:bg-step-accent transition-colors">Login Now</button>
                    <label class="flex items-center gap-1.5 text-sm text-gray-600">
                        <input type="checkbox" name="remember" class="rounded border-gray-300 text-step-primary focus:ring-step-primary">
                        Remember Me
                    </label>
                </div>
                <div class="flex flex-col text-sm gap-1">
                    <a href="/register" class="text-step-primary hover:text-step-accent">Create Account?</a>
                    <a href="/forgot-password" class="text-step-primary hover:text-step-accent">Forgot Password?</a>
                </div>
            </div>
        </form>
    </div>
</section>

@include('frontend.layouts.tailwind.footer')
