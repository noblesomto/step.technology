@include('frontend.layouts.tailwind.header')
@include('frontend.layouts.tailwind.nav')
@include('frontend.layouts.tailwind.page-header', ['pageTitle' => 'Journals & Publications'])

<section class="py-16">
    <div class="max-w-4xl mx-auto px-4">
        <h1 class="font-step-heading font-bold text-2xl sm:text-3xl text-step-primary mb-2">STEP Journals & Publications</h1>
        <span class="block w-16 h-1 bg-step-accent mb-8"></span>
        <p class="italic text-gray-500">Check back soon, as new journals & publications are coming to STEP.</p>
    </div>
</section>

@include('frontend.layouts.tailwind.cta-banner')
@include('frontend.layouts.tailwind.footer')
