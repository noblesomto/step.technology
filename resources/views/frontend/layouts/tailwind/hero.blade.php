@php
    $heroSlides = [
        [
            'image' => asset('frontend/img/slides/biz4.jpg'),
            'heading' => '1st International Conference on Technology, Energy &amp; Sustainability',
            'text' => 'ICTES 2025 | November 27&ndash;29, 2025',
            'primary' => ['label' => 'More About ICTES', 'href' => '/ICTES2025'],
            'secondary' => ['label' => 'Register', 'href' => '/ICTES2025'],
        ],
        [
            'image' => asset('frontend/img/slides/biz4.jpg'),
            'heading' => 'The Council for Registration of Technology and Energy Professionals &mdash; CORETEP',
            'text' => 'In order to assess, register, certify and license registrable technology and energy professionals in Nigeria and beyond.',
            'primary' => ['label' => 'More About CORETEP', 'href' => '/about-coretep'],
            'secondary' => ['label' => 'Join Us', 'href' => '/join'],
        ],
        [
            'image' => asset('frontend/img/slides/energy-banner.jpg'),
            'heading' => 'We are Diversified Across Industries',
            'text' => "Join today to receive STEP member's benefits and network with your peers",
            'primary' => ['label' => 'About Us', 'href' => '/about'],
            'secondary' => ['label' => 'Join Us', 'href' => '/join'],
        ],
        [
            'image' => asset('frontend/img/slides/black-training.jpeg'),
            'heading' => 'Individual or Corporate Membership',
            'text' => "Join today to receive STEP member's benefits and network with your peers",
            'primary' => ['label' => 'About Us', 'href' => '/about'],
            'secondary' => ['label' => 'Join Us', 'href' => '/join'],
        ],
    ];
@endphp

<section
    x-data="{ slide: 0, total: {{ count($heroSlides) }}, timer: null,
        start() { this.timer = setInterval(() => this.next(), 6000) },
        next() { this.slide = (this.slide + 1) % this.total },
        go(i) { this.slide = i; clearInterval(this.timer); this.start() } }"
    x-init="start()"
    class="relative h-[70vh] min-h-[420px] max-h-[640px] overflow-hidden bg-step-primary"
>
    @foreach ($heroSlides as $i => $slide)
        <div
            x-show="slide === {{ $i }}"
            x-transition:enter="transition ease-out duration-700"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-500"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="absolute inset-0"
            style="background-image: linear-gradient(to right, rgba(0,31,102,0.85), rgba(0,31,102,0.35)), url('{{ $slide['image'] }}'); background-size: cover; background-position: center;"
        >
            <div class="max-w-7xl mx-auto h-full px-4 flex items-center">
                <div class="max-w-xl text-white">
                    <h1 class="font-step-heading font-bold text-3xl sm:text-4xl lg:text-5xl leading-tight">{!! $slide['heading'] !!}</h1>
                    <p class="mt-4 text-base sm:text-lg text-white/90">{!! $slide['text'] !!}</p>
                    <div class="mt-8 flex flex-wrap gap-4">
                        <a href="{{ $slide['primary']['href'] }}" class="inline-block bg-step-accent text-step-primary font-step-heading font-semibold px-6 py-3 rounded-full hover:bg-white transition-colors">{{ $slide['primary']['label'] }}</a>
                        <a href="{{ $slide['secondary']['href'] }}" class="inline-block border-2 border-white text-white font-step-heading font-semibold px-6 py-3 rounded-full hover:bg-white hover:text-step-primary transition-colors">{{ $slide['secondary']['label'] }}</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{-- Dots --}}
    <div class="absolute bottom-6 left-1/2 -translate-x-1/2 flex gap-2">
        @foreach ($heroSlides as $i => $slide)
            <button
                @click="go({{ $i }})"
                :class="slide === {{ $i }} ? 'bg-step-accent w-6' : 'bg-white/50 w-2'"
                class="h-2 rounded-full transition-all"
                aria-label="Go to slide {{ $i + 1 }}"
            ></button>
        @endforeach
    </div>
</section>
