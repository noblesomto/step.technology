@include('frontend.layouts.tailwind.header')
@include('frontend.layouts.tailwind.nav')
@include('frontend.layouts.tailwind.page-header', ['pageTitle' => 'Contact Us'])

{{-- ================= CONTACT INFO ================= --}}
<section class="py-16">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-12">
            <h1 class="font-step-heading font-bold text-3xl sm:text-4xl text-step-primary">Get In Touch With Us</h1>
            <span class="block w-16 h-1 bg-step-accent mx-auto mt-4"></span>
            <p class="mt-4 text-gray-500">We want to hear from you!</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="text-center p-8 border border-gray-200 rounded-lg hover:shadow-lg transition-shadow">
                <div class="w-14 h-14 rounded-full bg-step-primary/10 flex items-center justify-center mx-auto mb-4">
                    <i class="fa fa-map-marker text-step-primary text-2xl"></i>
                </div>
                <h3 class="font-step-heading font-semibold text-lg mb-2">Visit Our Place</h3>
                <span class="block w-10 h-0.5 bg-step-accent mx-auto mb-3"></span>
                <p class="text-gray-600 text-sm">National Energy and Technology Center (NET CENTER) No. 15 Abua Street, Rumuibekwe, Port Harcourt</p>
            </div>
            <div class="text-center p-8 border border-gray-200 rounded-lg hover:shadow-lg transition-shadow">
                <div class="w-14 h-14 rounded-full bg-step-primary/10 flex items-center justify-center mx-auto mb-4">
                    <i class="fa fa-phone text-step-primary text-2xl"></i>
                </div>
                <h3 class="font-step-heading font-semibold text-lg mb-2">Phone</h3>
                <span class="block w-10 h-0.5 bg-step-accent mx-auto mb-3"></span>
                <p class="text-gray-600 text-sm">+234-{{ config('global.site_phone') }}</p>
            </div>
            <div class="text-center p-8 border border-gray-200 rounded-lg hover:shadow-lg transition-shadow">
                <div class="w-14 h-14 rounded-full bg-step-primary/10 flex items-center justify-center mx-auto mb-4">
                    <i class="fa fa-envelope text-step-primary text-2xl"></i>
                </div>
                <h3 class="font-step-heading font-semibold text-lg mb-2">Email</h3>
                <span class="block w-10 h-0.5 bg-step-accent mx-auto mb-3"></span>
                <p class="text-gray-600 text-sm">{{ config('global.site_email') }}</p>
            </div>
        </div>
    </div>
</section>

{{-- ================= CONTACT FORM ================= --}}
<section class="py-16 bg-gray-50">
    <div class="max-w-2xl mx-auto px-4">
        <div class="text-center mb-8">
            <h1 class="font-step-heading font-bold text-2xl sm:text-3xl text-step-primary">Send Us Your Message</h1>
            <span class="block w-16 h-1 bg-step-accent mx-auto mt-4"></span>
        </div>

        @if (session('status'))
            <div class="mb-6 rounded-md px-4 py-3 text-sm {{ session('status')['type'] === 'success' ? 'bg-green-50 text-green-700 border border-green-200' : 'bg-red-50 text-red-700 border border-red-200' }}">
                {{ session('status')['text'] }}
            </div>
        @endif

        <form class="bg-white rounded-lg border border-gray-200 p-6 sm:p-8 space-y-4" action="/contact" method="post">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <input type="text" name="name" placeholder="Your Name*" required class="w-full rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm px-4 py-2.5">
                <input type="email" name="email" placeholder="Your Mail*" required class="w-full rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm px-4 py-2.5">
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <input type="text" name="phone" placeholder="Phone" required class="w-full rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm px-4 py-2.5">
                <input type="text" name="subject" placeholder="Subject" required class="w-full rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm px-4 py-2.5">
            </div>
            <textarea name="message" rows="5" placeholder="Your Message.." required class="w-full rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm px-4 py-2.5"></textarea>

            <div>
                <strong class="block text-sm text-gray-700 mb-2">ReCaptcha:</strong>
                <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}"></div>
                @if ($errors->has('g-recaptcha-response'))
                    <span class="text-red-600 text-sm">{{ $errors->first('g-recaptcha-response') }}</span>
                @endif
            </div>

            <input id="form_botcheck" name="form_botcheck" type="hidden" value="">
            <button type="submit" class="w-full bg-step-primary text-white font-step-heading font-semibold px-6 py-3 rounded-full hover:bg-step-accent transition-colors">Send Message</button>
        </form>
    </div>
</section>

@include('frontend.layouts.tailwind.footer')
