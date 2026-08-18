@include('frontend.layouts.tailwind.header')
@include('frontend.layouts.tailwind.nav')
@include('frontend.layouts.tailwind.page-header', ['pageTitle' => 'Membership'])

<section class="py-16">
    <div class="max-w-4xl mx-auto px-4">
        <h1 class="font-step-heading font-bold text-2xl sm:text-3xl text-step-primary mb-2">Membership Applications</h1>
        <span class="block w-16 h-1 bg-step-accent mb-8"></span>

        <h5 class="font-step-heading font-semibold text-lg text-gray-800 mb-4">Join STEP and become part of a dedicated group of over 1,000 professionals.<br>Benefits:</h5>
        <ul class="space-y-2 mb-12">
            @foreach ([
                'Trainings/Certifications in their areas of specialization',
                'Monthly energy/technology newsletters',
                'Entrepreneurial start-up grants',
                'Monthly technical sessions',
                'STEP conferences/exhibitions, online webinars',
                'Career advisory systems/contacts',
                'Annual subsidized intellectual development international tour to a foreign country, partnership/mentorship platforms',
            ] as $benefit)
                <li class="flex items-start gap-2 text-gray-600"><i class="fa fa-angle-right text-step-accent mt-1"></i> {{ $benefit }}</li>
            @endforeach
        </ul>

        <h3 class="font-step-heading font-semibold text-xl text-step-primary mb-6">Membership Category</h3>

        @php
            $categories = [
                [
                    'title' => 'Undergraduates',
                    'body' => 'Person must be undergoing a regular course of study in Engineering Science of duration not less than three years in a University or Technical Institution whose curriculum is approved by the Council in respect of Engineering Education.',
                    'href' => '/register-undergraduate',
                ],
                [
                    'title' => 'Young Professionals',
                    'body' => "Person must possess an academic qualification at the level of a University degree in the Sciences allied to engineering science, or other qualifications approved by the Council of the Society. Person must have been engaged on work related to the practice of engineering for a minimum period of five years.",
                    'href' => '/register-young-professional',
                ],
                [
                    'title' => 'Corporate Professionals',
                    'body' => 'A Corporate member is eligible to all privileges of a member as prescribed by Council, is eligible to vote at the AGM and can aspire to any positions in the Society in line with the conditions as prescribed by Council.',
                    'href' => '/register-corporate-professional',
                ],
                [
                    'title' => 'Corporate Organisation',
                    'body' => 'A Corporate Organisation is eligible to all privileges of a member as prescribed by Council, is eligible to vote at the AGM and can aspire to any positions in the Society in line with the conditions as prescribed by Council.',
                    'href' => '/register-corporate-organization',
                ],
            ];
        @endphp

        <div class="border border-gray-200 rounded-lg divide-y divide-gray-200" x-data="{ openIndex: 0 }">
            @foreach ($categories as $i => $category)
                <div>
                    <button @click="openIndex = openIndex === {{ $i }} ? null : {{ $i }}" class="w-full flex items-center justify-between px-6 py-4 text-left">
                        <h4 class="font-step-heading font-semibold text-gray-900">{{ $category['title'] }}</h4>
                        <svg class="w-4 h-4 text-step-primary shrink-0 transition-transform" :class="openIndex === {{ $i }} && 'rotate-180'" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="openIndex === {{ $i }}" x-transition x-cloak class="px-6 pb-6">
                        <p class="text-gray-600 leading-relaxed">{{ $category['body'] }}</p>
                        <a href="{{ $category['href'] }}" class="inline-block mt-4 bg-step-primary text-white font-step-heading font-semibold px-6 py-2.5 rounded-full hover:bg-step-accent transition-colors">Join Now</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

@include('frontend.layouts.tailwind.cta-banner')
@include('frontend.layouts.tailwind.footer')
