@include('frontend.layouts.tailwind.header')
@include('frontend.layouts.tailwind.nav')
@include('frontend.layouts.tailwind.page-header', ['pageTitle' => 'About Us'])

{{-- ================= INTRO ================= --}}
<section class="py-16">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
            <img src="{{ asset('frontend/img/about-step.png') }}" alt="About STEP" class="w-full h-80 object-cover rounded-lg">
            <div>
                <h3 class="font-step-heading font-semibold text-xl text-step-primary mb-6">Founded in Africa, the body is committed to innovation, research, and capacity developments geared towards advancements in energy and technology and in the intellectual development of its members.</h3>
                <p class="uppercase tracking-widest text-xs text-step-accent font-step-heading font-semibold mb-2">Who We Are</p>
                <p class="text-gray-600 leading-relaxed mb-4">As a professional organization, STEP fosters knowledge sharing, cooperation, career and skills development across science, energy, technology, and engineering disciplines to proffer solutions to benefit mankind.</p>
                <p class="text-gray-600 leading-relaxed">Its members comprise engineers, scientists/academics, professional researchers, policymakers, doctors, investors, and many others. All members enjoy enormous benefits such as training/certifications in their areas of specialization, monthly energy/technology newsletters, monthly technical sessions, conferences/exhibitions, online webinars, career advisory systems/contacts, an annually subsidized international intellectual development tour, and partnership/mentorship platforms.</p>
            </div>
        </div>

        {{-- Mission / Vision / Values --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-16">
            <div>
                <h3 class="font-step-heading font-semibold text-lg text-step-primary mb-2">Our Mission</h3>
                <p class="text-gray-600 text-sm leading-relaxed">To build a network of professionals in the energy and technology industry that will pilot the next generation of social innovations.</p>
            </div>
            <div>
                <h3 class="font-step-heading font-semibold text-lg text-step-primary mb-2">Our Vision</h3>
                <p class="text-gray-600 text-sm leading-relaxed">To be at the forefront in leading technical and social innovations that promote sustainable living.</p>
            </div>
            <div>
                <h3 class="font-step-heading font-semibold text-lg text-step-primary mb-2">Values</h3>
                <p class="text-gray-600 text-sm leading-relaxed">The society was founded by engineers, academics, and scientists who were eager to work together to create better working conditions and make significant contributions to the world.</p>
            </div>
        </div>
    </div>
</section>

{{-- ================= CORE VALUES ================= --}}
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
        <h2 class="font-step-heading font-bold text-2xl sm:text-3xl text-step-primary text-center mb-12">Our Core Values</h2>

        @php
            $coreValues = [
                ['icon' => 'fa-user', 'title' => 'Leadership', 'text' => "Leadership is the proactive guidance of individuals and resources towards a shared vision, fostering innovation, resilience, and sustainability within an energy and technology company's operations and impact."],
                ['icon' => 'fa-check-square-o', 'title' => 'Commitment', 'text' => 'Dedication to delivering reliable, sustainable energy solutions, prioritizing long-term environmental stewardship and technological advancement, ensuring consistent service and innovation for a better future.'],
                ['icon' => 'fa-thumbs-o-up', 'title' => 'Accountability', 'text' => 'Accountability is the commitment to take responsibility for actions, decisions, and their outcomes within an energy and technology company, fostering trust, reliability, and integrity throughout operations.'],
                ['icon' => 'fa-heartbeat', 'title' => 'Integrity', 'text' => 'Integrity, as a core value for STEP, entails upholding honesty, ethics, and accountability in all actions, fostering trust with stakeholders, and ensuring transparency in operations.'],
                ['icon' => 'fa-shield', 'title' => 'Respect', 'text' => 'Respect, as a core value for an energy and technology company, entails honoring diverse perspectives, fostering inclusive environments, valuing stakeholders, and prioritizing safety, ethics, and sustainability in all endeavors.'],
                ['icon' => 'fa-bullseye', 'title' => 'Purpose', 'text' => "Guiding principle driving our energy and technology company's endeavors, reflecting our commitment to meaningful impact, sustainability, and innovation in shaping a better future for all."],
                ['icon' => 'fa-certificate', 'title' => 'Trust', 'text' => 'The foundation of integrity and reliability in an energy and technology company, encompassing transparency, accountability, and consistent delivery of promises to stakeholders and customers.'],
                ['icon' => 'fa-heart', 'title' => 'Love', 'text' => 'Love, as one of our strong core values, entails fostering genuine care, compassion, and respect in all interactions, prioritizing empathy, sustainability, and social responsibility.'],
            ];
        @endphp

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($coreValues as $value)
                <div class="bg-white p-6 border border-gray-200 rounded-lg hover:shadow-lg transition-shadow">
                    <i class="fa {{ $value['icon'] }} text-step-primary text-2xl mb-4"></i>
                    <h3 class="font-step-heading font-semibold text-lg mb-2">{{ $value['title'] }}</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">{{ $value['text'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

@include('frontend.layouts.tailwind.cta-banner')
@include('frontend.layouts.tailwind.footer')
