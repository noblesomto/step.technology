@include('frontend.layouts.tailwind.header')
@include('frontend.layouts.tailwind.nav')
@include('frontend.layouts.tailwind.hero')

{{-- ================= ABOUT STEP ================= --}}
<section class="py-20">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-12">
            <h1 class="font-step-heading font-bold text-3xl sm:text-4xl text-step-primary">Welcome to STEP</h1>
            <span class="block w-16 h-1 bg-step-accent mx-auto mt-4"></span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
            <img src="{{ asset('frontend/img/about.jpg') }}" alt="About STEP" class="w-full h-80 object-cover rounded-lg">
            <div>
                <h3 class="font-step-heading font-semibold text-xl text-step-primary mb-4">Society of Technology and Energy Professionals (STEP) is the fastest growing Professional body in Nigeria.</h3>
                <p class="text-gray-600 leading-relaxed">The body is committed to effective registration and licensing of professionals in technology and energy through the Council for Registration of Technology and Energy Professionals&mdash;CORETEP. STEP also fosters innovation, research and capacity development.</p>
                <a href="/about" class="inline-block mt-6 bg-step-primary text-white font-step-heading font-semibold px-6 py-3 rounded-full hover:bg-step-accent transition-colors">Read More</a>
            </div>
        </div>

        {{-- Feature boxes --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-16">
            <div class="p-6 border border-gray-200 rounded-lg hover:shadow-lg transition-shadow">
                <div class="w-12 h-12 rounded-full bg-step-primary/10 flex items-center justify-center mb-4">
                    <i class="fa fa-lightbulb-o text-step-primary text-xl"></i>
                </div>
                <h3 class="font-step-heading font-semibold text-lg mb-2">Innovative Works</h3>
                <p class="text-gray-600 text-sm leading-relaxed">Innovation Works is focused on growing and connecting the local startup ecosystem. Every year, we help hundreds of entrepreneurs, researchers and small manufacturers create new markets and change the world with their innovations.</p>
            </div>
            <div class="p-6 border border-gray-200 rounded-lg hover:shadow-lg transition-shadow">
                <div class="w-12 h-12 rounded-full bg-step-primary/10 flex items-center justify-center mb-4">
                    <i class="fa fa-certificate text-step-primary text-xl"></i>
                </div>
                <h3 class="font-step-heading font-semibold text-lg mb-2">Certifications</h3>
                <p class="text-gray-600 text-sm leading-relaxed">Professional certifications can help individuals advance faster in their careers, especially in highly-specialized industries such as human resources, accounting or information technology.</p>
            </div>
            <div class="p-6 border border-gray-200 rounded-lg hover:shadow-lg transition-shadow">
                <div class="w-12 h-12 rounded-full bg-step-primary/10 flex items-center justify-center mb-4">
                    <i class="fa fa-briefcase text-step-primary text-xl"></i>
                </div>
                <h3 class="font-step-heading font-semibold text-lg mb-2">Trainings</h3>
                <p class="text-gray-600 text-sm leading-relaxed">The training seminars listed here, from carefully selected management training firms/providers and consultants in Nigeria and around the world, cover the requirements of lower, middle, and top management executives in public and private sectors.</p>
            </div>
        </div>

        {{-- CORETEP --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center mt-16">
            <div class="order-2 lg:order-1">
                <h3 class="font-step-heading font-semibold text-xl text-step-primary mb-4">The Council for Registration of Technology and Energy Professionals &mdash; CORETEP</h3>
                <p class="text-gray-600 leading-relaxed">In order to assess, register, certify and license registrable technology and energy professionals in Nigeria and beyond, the Council for Registration of Technology and Energy Professionals (CORETEP) under the Society of Technology and Energy Professionals (STEP) was inaugurated during her first council meeting to carry out the aforementioned functions pending when their bill is assented to by the President of the Federal Republic of Nigeria. The need to enhance effective technology and energy professional practice in Nigeria, review and adopt a technology and energy council examination, encourage local manufacturing, facilitate digital transformation in our workplace, and foster capacity building so as to meet global standards for Nigeria's economic growth and sustainability were the reasons for this Technology and Energy Council Examination.</p>
                <a href="/about-coretep" class="inline-block mt-6 bg-step-primary text-white font-step-heading font-semibold px-6 py-3 rounded-full hover:bg-step-accent transition-colors">More About CORETEP</a>
            </div>
            <img src="{{ asset('frontend/img/4620.jpg') }}" alt="About CORETEP" class="order-1 lg:order-2 w-full h-80 object-cover rounded-lg">
        </div>
    </div>
</section>

{{-- ================= JOIN CTA ================= --}}
<div class="bg-step-primary">
    <div class="max-w-7xl mx-auto px-4 py-10 flex flex-col sm:flex-row items-center justify-between gap-4">
        <h3 class="font-step-heading font-semibold text-xl text-white text-center sm:text-left">Join the fast-growing global network of energy and technology Professionals</h3>
        <a href="/join" class="shrink-0 inline-block bg-step-accent text-step-primary font-step-heading font-semibold px-8 py-3 rounded-full hover:bg-white transition-colors">Join Now</a>
    </div>
</div>

{{-- ================= LATEST BLOG ================= --}}
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-12">
            <h1 class="font-step-heading font-bold text-3xl sm:text-4xl text-step-primary">Latest From Blog</h1>
            <span class="block w-16 h-1 bg-step-accent mx-auto mt-4"></span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach ($blogpost as $row)
                <a href="/blog/{{ $row->blog_id }}/{{ $row->blog_slug }}" class="group block bg-white rounded-lg overflow-hidden border border-gray-200 hover:shadow-lg transition-shadow">
                    <div class="relative h-48 overflow-hidden">
                        <img src="{{ asset('uploads/thumbnails/'.$row->blog_picture) }}" alt="{{ $row->blog_title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        <span class="absolute top-3 left-3 bg-step-primary text-white text-xs font-step-heading font-semibold px-3 py-1 rounded-full">{{ $row->created_at->format('j F') }}</span>
                    </div>
                    <div class="p-5">
                        <h3 class="font-step-heading font-semibold text-lg text-gray-900 group-hover:text-step-primary transition-colors">{{ Str::words($row->blog_title, 10) }}</h3>
                        <div class="mt-2 text-sm text-gray-600">{!! Str::words(strip_tags($row->blog_body), 15) !!}</div>
                        <div class="mt-4 flex items-center justify-between text-sm">
                            <span class="text-step-primary font-step-heading font-semibold">Read More</span>
                            <span class="text-gray-400 flex items-center gap-1"><i class="fa fa-eye"></i> {{ $row->blog_views }}</span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

{{-- ================= CERTIFICATIONS ================= --}}
<section class="py-20">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h1 class="font-step-heading font-bold text-3xl sm:text-4xl text-step-primary mb-12">Become STEP Certified</h1>

        <div class="flex flex-wrap items-center justify-center gap-10">
            @foreach (['cert-1','cert-6','cert-3','cert-4','cert-5'] as $cert)
                <a href="/certifications" title="STEP Certifications" class="opacity-70 hover:opacity-100 transition-opacity">
                    <img src="{{ asset('frontend/img/cert/'.$cert.'.png') }}" alt="STEP Certifications" class="h-16 w-auto">
                </a>
            @endforeach
        </div>

        <h4 class="font-step-heading font-semibold text-xl text-gray-700 mt-14">Rise to the Top of the Energy Management Profession</h4>
    </div>
</section>

@include('frontend.layouts.tailwind.footer')
