@include('frontend.layouts.tailwind.header')
@include('frontend.layouts.tailwind.nav')

<section class="bg-step-primary py-16 text-center">
    <div class="max-w-4xl mx-auto px-4">
        <h1 class="font-step-heading font-bold text-2xl sm:text-4xl text-white">1st International Conference on Technology, Energy &amp; Sustainability</h1>
        <h3 class="mt-3 font-step-heading font-light text-lg text-white/90">ICTES 2025 | November 27&ndash;29, 2025</h3>
    </div>
</section>

<div class="border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between text-sm">
        <ul class="flex items-center gap-2 text-gray-500">
            <li><a href="/" class="hover:text-step-primary">Home</a></li>
            <li><i class="fa fa-angle-right text-xs"></i></li>
            <li class="text-step-primary font-medium">ICTES 2025 Conference</li>
        </ul>
        <a href="#" class="text-gray-500 hover:text-step-primary flex items-center gap-1"><i class="fa fa-share-alt"></i> Share</a>
    </div>
</div>

{{-- ================= CONFERENCE DETAILS ================= --}}
<section class="py-16">
    <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 lg:grid-cols-12 gap-10">
        <div class="lg:col-span-7">
            <h1 class="font-step-heading font-bold text-2xl sm:text-3xl text-step-primary mb-2">About ICTES 2025</h1>
            <span class="block w-16 h-1 bg-step-accent mb-6"></span>

            <p class="text-gray-700 leading-relaxed mb-4">The 1st International Conference on Technology, Energy and Sustainability (ICTES 2025) is a premier conference and induction ceremony for technology and energy professionals worldwide. Organized by the Council for Registration of Technology and Energy Professionals (CORETEP) under the Society of Technology and Energy Professionals (STEP), this event aims to bring together leading academic scientists, researchers, renewable and non-renewable energy professionals, government bodies, agencies, private sector representatives, and research scholars.</p>
            <p class="text-gray-600 leading-relaxed">The conference provides an interdisciplinary forum for researchers, practitioners, and educators to present and discuss the most recent innovations, trends, concerns, practical challenges, and solutions in the fields of technology, energy, and innovation for sustainability.</p>

            <div class="bg-blue-50 rounded-lg p-6 mt-8">
                <h3 class="font-step-heading font-semibold text-lg text-step-primary mb-4">Conference Highlights</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-2">
                    @foreach ([
                        'Keynote presentations by industry leaders',
                        'Technical paper sessions',
                        'Panel discussions on emerging trends',
                        'Networking opportunities',
                        'Exhibition of innovative technologies',
                        'Professional induction ceremony',
                    ] as $highlight)
                        <p class="flex items-start gap-2 text-sm text-gray-700"><i class="fa fa-check-circle text-step-primary mt-0.5"></i> {{ $highlight }}</p>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="lg:col-span-5 space-y-6">
            <div class="bg-gray-50 rounded-lg p-6 shadow-sm">
                <h3 class="font-step-heading font-semibold text-lg text-step-primary border-b border-gray-200 pb-3 mb-4">Conference Details</h3>
                <dl class="space-y-3 text-sm">
                    <div class="flex justify-between gap-2"><dt class="font-semibold text-gray-600">Status:</dt><dd class="text-green-600 font-semibold">ACTIVE</dd></div>
                    <div class="flex justify-between gap-2"><dt class="font-semibold text-gray-600">Organizer:</dt><dd class="text-gray-800">CORETEP/STEP</dd></div>
                    <div class="flex justify-between gap-2"><dt class="font-semibold text-gray-600">Submission Deadline:</dt><dd class="text-gray-800">October 25, 2025</dd></div>
                    <div class="flex justify-between gap-2"><dt class="font-semibold text-gray-600">Conference Dates:</dt><dd class="text-gray-800">November 27&ndash;29, 2025</dd></div>
                    <div class="flex justify-between gap-2"><dt class="font-semibold text-gray-600">Venue:</dt><dd class="text-gray-800">To be announced</dd></div>
                    <div class="flex justify-between gap-2"><dt class="font-semibold text-gray-600">Registration Fee:</dt><dd class="text-gray-800">&#8358;50,000</dd></div>
                </dl>
            </div>

            <div class="bg-gray-50 rounded-lg p-6 shadow-sm">
                <h3 class="font-step-heading font-semibold text-lg text-step-primary border-b border-gray-200 pb-3 mb-4">Contact Information</h3>
                <dl class="space-y-3 text-sm">
                    <div class="flex justify-between gap-2 flex-wrap"><dt class="font-semibold text-gray-600">Organizing Chairman:</dt><dd><a href="mailto:ICTESChairman@step.technology" class="text-green-600 hover:underline">ICTESChairman@step.technology</a></dd></div>
                    <div class="flex justify-between gap-2 flex-wrap"><dt class="font-semibold text-gray-600">Organizing Secretary:</dt><dd><a href="mailto:ICTESSecretary@step.technology" class="text-green-600 hover:underline">ICTESSecretary@step.technology</a></dd></div>
                    <div class="flex justify-between gap-2 flex-wrap"><dt class="font-semibold text-gray-600">Email:</dt><dd><a href="mailto:ICTES@step.technology" class="text-green-600 hover:underline">ICTES@step.technology</a></dd></div>
                </dl>
            </div>
        </div>
    </div>
</section>

{{-- ================= REGISTRATION FORM ================= --}}
<section class="py-16 bg-gray-50">
    <div class="max-w-3xl mx-auto px-4">
        <div class="text-center mb-8">
            <h1 class="font-step-heading font-bold text-2xl sm:text-3xl text-step-primary">Register for ICTES 2025</h1>
            <span class="block w-16 h-1 bg-step-accent mx-auto mt-4"></span>
            <p class="mt-4 text-gray-500">Complete the form below to register for the conference</p>
        </div>

        @if (session('status'))
            <div class="mb-6 rounded-md px-4 py-3 text-sm {{ session('status')['type'] === 'success' ? 'bg-green-50 text-green-700 border border-green-200' : 'bg-red-50 text-red-700 border border-red-200' }}">
                {{ session('status')['text'] }}
            </div>
        @endif

        <form action="/ICTES2025" method="post" enctype="multipart/form-data" class="bg-white rounded-lg shadow-sm p-6 sm:p-8" x-data="{ preview: null, previewType: null }">
            @csrf

            <div class="mb-8 pb-6 border-b border-gray-100">
                <h3 class="font-step-heading font-semibold text-lg text-step-primary border-b-2 border-step-primary inline-block pb-2 mb-6">Personal Information</h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="title" class="block text-sm font-semibold text-gray-700 mb-1.5">Title *</label>
                        <select id="title" name="title" required class="w-full h-11 rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm px-3">
                            <option value="">Select Title</option>
                            <option value="Mr.">Mr.</option>
                            <option value="Ms.">Ms.</option>
                            <option value="Mrs.">Mrs.</option>
                            <option value="Engr.">Engr.</option>
                            <option value="Dr.">Dr.</option>
                            <option value="Prof.">Prof.</option>
                        </select>
                    </div>
                    <div>
                        <label for="category" class="block text-sm font-semibold text-gray-700 mb-1.5">Registration Category *</label>
                        <select id="category" name="category" required class="w-full h-11 rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm px-3">
                            <option value="">Select Category</option>
                            <option value="Delegate">Delegate</option>
                            <option value="Visitor">Visitor</option>
                            <option value="Volunteer">Volunteer</option>
                            <option value="Govt Official">Government Official</option>
                            <option value="Speaker">Speaker</option>
                            <option value="Student">Student</option>
                            <option value="Exhibitor">Exhibitor</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="first_name" class="block text-sm font-semibold text-gray-700 mb-1.5">First Name *</label>
                        <input type="text" id="first_name" name="first_name" placeholder="Your First Name" value="{{ old('first_name') }}" required class="w-full h-11 rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm px-3">
                    </div>
                    <div>
                        <label for="last_name" class="block text-sm font-semibold text-gray-700 mb-1.5">Last Name *</label>
                        <input type="text" id="last_name" name="last_name" placeholder="Your Last Name" value="{{ old('last_name') }}" required class="w-full h-11 rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm px-3">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="phone" class="block text-sm font-semibold text-gray-700 mb-1.5">Phone Number *</label>
                        <input type="tel" id="phone" name="phone" placeholder="Your Phone Number" value="{{ old('phone') }}" required class="w-full h-11 rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm px-3">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-1.5">Email Address *</label>
                        <input type="email" id="email" name="email" placeholder="Your Email Address" value="{{ old('email') }}" required class="w-full h-11 rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm px-3">
                    </div>
                </div>
            </div>

            <div class="mb-8 pb-6 border-b border-gray-100">
                <h3 class="font-step-heading font-semibold text-lg text-step-primary border-b-2 border-step-primary inline-block pb-2 mb-6">Professional Information</h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="organization" class="block text-sm font-semibold text-gray-700 mb-1.5">Organization *</label>
                        <input type="text" id="organization" name="organization" placeholder="Your Organization" value="{{ old('organization') }}" required class="w-full h-11 rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm px-3">
                    </div>
                    <div>
                        <label for="country" class="block text-sm font-semibold text-gray-700 mb-1.5">Country *</label>
                        <select id="country" name="country" required class="w-full h-11 rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm px-3">
                            <option value="">Select Country</option>
                            <option value="United States">United States</option>
                            <option value="United Kingdom">United Kingdom</option>
                            <option value="Canada">Canada</option>
                            <option value="Australia">Australia</option>
                            <option value="Germany">Germany</option>
                            <option value="France">France</option>
                            <option value="Nigeria">Nigeria</option>
                            <option value="South Africa">South Africa</option>
                            <option value="India">India</option>
                            <option value="China">China</option>
                        </select>
                    </div>
                </div>

                <div class="mb-4">
                    @if ($errors->has('payment'))
                        <span class="block text-red-600 text-sm mb-1">{{ $errors->first('payment') }}</span>
                    @endif
                    <label for="payment" class="block text-sm font-semibold text-gray-700 mb-1.5">Upload Proof of Payment</label>
                    <input
                        type="file" id="payment" name="payment" required accept="image/*,.pdf"
                        @change="
                            const file = $event.target.files[0];
                            preview = file ? URL.createObjectURL(file) : null;
                            previewType = file ? (file.type.startsWith('image/') ? 'image' : (file.type === 'application/pdf' ? 'pdf' : 'unsupported')) : null;
                        "
                        class="w-full text-sm text-gray-600 file:mr-4 file:py-2.5 file:px-4 file:rounded-md file:border-0 file:bg-step-primary/10 file:text-step-primary file:font-semibold hover:file:bg-step-primary/20"
                    >
                    <div class="mt-3">
                        <img x-show="previewType === 'image'" :src="preview" class="max-h-64 rounded-md shadow-sm">
                        <embed x-show="previewType === 'pdf'" :src="preview" type="application/pdf" class="w-full h-96 rounded-md border border-gray-200">
                        <p x-show="previewType === 'unsupported'" class="text-red-600 text-sm">Unsupported file type. Please upload an image or PDF.</p>
                    </div>
                </div>

                <div>
                    <label for="message" class="block text-sm font-semibold text-gray-700 mb-1.5">Additional Information</label>
                    <textarea id="message" name="message" rows="4" placeholder="Any special requirements or comments..." class="w-full rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm px-3 py-2.5">{{ old('message') }}</textarea>
                </div>
            </div>

            <div>
                <strong class="block text-sm text-gray-700 mb-2">ReCaptcha Verification *</strong>
                <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}"></div>
                @if ($errors->has('g-recaptcha-response'))
                    <span class="block text-red-600 text-sm mt-1">{{ $errors->first('g-recaptcha-response') }}</span>
                @endif
            </div>

            <input type="hidden" name="form_botcheck" value="">
            <button type="submit" class="w-full mt-6 bg-step-primary text-white font-step-heading font-semibold px-6 py-3 rounded-full hover:bg-step-accent transition-colors">Submit Registration</button>
        </form>
    </div>
</section>

@include('frontend.layouts.tailwind.footer')
