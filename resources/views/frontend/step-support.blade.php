@include('frontend.layouts.tailwind.header')
@include('frontend.layouts.tailwind.nav')
@include('frontend.layouts.tailwind.page-header', ['pageTitle' => 'STEP Support'])

<section class="py-16">
    <div class="max-w-4xl mx-auto px-4">
        <h1 class="font-step-heading font-bold text-2xl sm:text-3xl text-step-primary mb-2">STEP Professional Support (PS)</h1>
        <span class="block w-16 h-1 bg-step-accent mb-8"></span>

        <h5 class="font-step-heading font-semibold text-lg text-gray-800 mb-4">Aim: To improve people or organizational performance by offering world class complete solutions.<br>Our PS includes:</h5>
        <ul class="space-y-2 mb-10">
            @foreach (['Research', 'Trainings', 'New technology and energy knowledge sharing', 'Process', 'Content development', 'Data', 'Professional Task delivery', 'CSR'] as $item)
                <li class="flex items-start gap-2 text-gray-600"><i class="fa fa-angle-right text-step-accent mt-1"></i> {{ $item }}</li>
            @endforeach
        </ul>

        <h5 class="font-step-heading font-semibold text-lg text-gray-800 mb-2">These can be achieved through our P2P (Person2Person) or TECHSERV (Online services)</h5>
        <h3 class="font-step-heading font-semibold text-xl text-step-primary mt-6 mb-4">Three Strategies</h3>
        <ul class="space-y-2">
            @foreach (['Deliver integrated solutions directly or indirectly.', 'Real time dimension to services', 'Innovation management', 'Best practices'] as $item)
                <li class="flex items-start gap-2 text-gray-600"><i class="fa fa-angle-right text-step-accent mt-1"></i> {{ $item }}</li>
            @endforeach
        </ul>
    </div>
</section>

@include('frontend.layouts.tailwind.cta-banner')
@include('frontend.layouts.tailwind.footer')
