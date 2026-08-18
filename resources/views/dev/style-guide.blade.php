<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-step-sans text-gray-800 bg-white">

    {{-- ================= HEADER ================= --}}
    <header x-data="{ mobileOpen: false }">
        {{-- Top bar --}}
        <div class="bg-step-primary text-white text-sm">
            <div class="max-w-7xl mx-auto px-4 flex flex-col sm:flex-row items-center justify-between gap-1 py-2">
                <ul class="flex flex-wrap items-center gap-4">
                    <li>Phone: +234{{ config('global.site_phone') }}</li>
                    <li>{{ config('global.site_email') }}</li>
                </ul>
                <ul class="flex items-center gap-3">
                    <li><a href="#" class="hover:text-step-accent" aria-label="Facebook"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#" class="hover:text-step-accent" aria-label="Twitter"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#" class="hover:text-step-accent" aria-label="LinkedIn"><i class="fa fa-linkedin"></i></a></li>
                </ul>
            </div>
        </div>

        {{-- Main menu --}}
        <div class="border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 flex items-center justify-between h-20">
                <a href="/" class="shrink-0">
                    <img src="{{ asset('frontend/img/new-logo.png') }}" alt="STEP Logo" class="h-12 w-auto">
                </a>

                {{-- Desktop nav --}}
                <nav class="hidden lg:flex items-center gap-8 font-step-heading font-medium text-sm">
                    <a href="/" class="text-step-primary">Home</a>

                    <div class="relative" x-data="{ open: false }" @mouseleave="open = false">
                        <button @mouseenter="open = true" @click="open = !open" class="flex items-center gap-1 hover:text-step-accent">
                            About
                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div x-show="open" x-transition x-cloak class="absolute left-0 mt-2 w-56 bg-white shadow-lg rounded-md py-2 z-20">
                            <a href="/about" class="block px-4 py-2 hover:bg-step-primary/5 hover:text-step-accent">About STEP</a>
                            <a href="/about-coretep" class="block px-4 py-2 hover:bg-step-primary/5 hover:text-step-accent">About CORETEP</a>
                            <a href="/step-support" class="block px-4 py-2 hover:bg-step-primary/5 hover:text-step-accent">STEP Support</a>
                        </div>
                    </div>

                    <div class="relative" x-data="{ open: false }" @mouseleave="open = false">
                        <button @mouseenter="open = true" @click="open = !open" class="flex items-center gap-1 hover:text-step-accent">
                            Services
                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div x-show="open" x-transition x-cloak class="absolute left-0 mt-2 w-56 bg-white shadow-lg rounded-md py-2 z-20">
                            <a href="/trainings" class="block px-4 py-2 hover:bg-step-primary/5 hover:text-step-accent">Trainings</a>
                            <a href="/certifications" class="block px-4 py-2 hover:bg-step-primary/5 hover:text-step-accent">Certifications</a>
                        </div>
                    </div>

                    <div class="relative" x-data="{ open: false }" @mouseleave="open = false">
                        <button @mouseenter="open = true" @click="open = !open" class="flex items-center gap-1 hover:text-step-accent">
                            Resources
                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div x-show="open" x-transition x-cloak class="absolute left-0 mt-2 w-56 bg-white shadow-lg rounded-md py-2 z-20">
                            <a href="/journal-publication" class="block px-4 py-2 hover:bg-step-primary/5 hover:text-step-accent">Journals/Publications</a>
                            <a href="/blog" class="block px-4 py-2 hover:bg-step-primary/5 hover:text-step-accent">Blog</a>
                        </div>
                    </div>

                    <a href="/events" class="hover:text-step-accent">Events</a>
                    <a href="/memberships" class="hover:text-step-accent">Membership</a>
                    <a href="/contact" class="hover:text-step-accent">Contact Us</a>
                </nav>

                <div class="hidden lg:block">
                    <a href="/login" class="inline-block bg-step-primary text-white font-step-heading font-semibold text-sm px-6 py-2.5 rounded-full hover:bg-step-accent transition-colors">Login</a>
                </div>

                {{-- Mobile toggle --}}
                <button @click="mobileOpen = !mobileOpen" class="lg:hidden p-2" aria-label="Toggle menu">
                    <svg class="w-6 h-6 text-step-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path x-show="!mobileOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        <path x-show="mobileOpen" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            {{-- Mobile nav --}}
            <nav x-show="mobileOpen" x-transition x-cloak class="lg:hidden border-t border-gray-100 px-4 py-4 space-y-3 font-step-heading text-sm">
                <a href="/" class="block text-step-primary">Home</a>
                <a href="/about" class="block">About STEP</a>
                <a href="/about-coretep" class="block">About CORETEP</a>
                <a href="/step-support" class="block">STEP Support</a>
                <a href="/trainings" class="block">Trainings</a>
                <a href="/certifications" class="block">Certifications</a>
                <a href="/journal-publication" class="block">Journals/Publications</a>
                <a href="/blog" class="block">Blog</a>
                <a href="/events" class="block">Events</a>
                <a href="/memberships" class="block">Membership</a>
                <a href="/contact" class="block">Contact Us</a>
                <a href="/login" class="block bg-step-primary text-white text-center font-semibold px-6 py-2.5 rounded-full">Login</a>
            </nav>
        </div>
    </header>

    {{-- ================= MAIN: TOKEN SHOWCASE ================= --}}
    <main class="max-w-5xl mx-auto px-4 py-16 space-y-16">

        <div>
            <p class="uppercase tracking-widest text-xs text-step-accent font-step-heading font-semibold mb-2">Foundation preview</p>
            <h1 class="font-step-heading font-bold text-4xl text-step-primary">STEP Design System</h1>
            <p class="mt-3 text-gray-500 max-w-2xl">Unlinked internal preview — colors, type, and the converted header/nav/footer, built ahead of converting real pages.</p>
        </div>

        {{-- Colors --}}
        <section>
            <h2 class="font-step-heading font-semibold text-xl mb-4">Colors</h2>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="rounded-lg overflow-hidden border border-gray-200">
                    <div class="h-24 bg-step-primary"></div>
                    <div class="p-3 text-sm">
                        <p class="font-semibold">Primary</p>
                        <p class="text-gray-500">step-primary &middot; #001f66</p>
                    </div>
                </div>
                <div class="rounded-lg overflow-hidden border border-gray-200">
                    <div class="h-24 bg-step-accent"></div>
                    <div class="p-3 text-sm">
                        <p class="font-semibold">Accent</p>
                        <p class="text-gray-500">step-accent &middot; #48c7ec</p>
                    </div>
                </div>
                <div class="rounded-lg overflow-hidden border border-gray-200">
                    <div class="h-24 bg-step-alert"></div>
                    <div class="p-3 text-sm">
                        <p class="font-semibold">Alert</p>
                        <p class="text-gray-500">step-alert &middot; #ff2b58</p>
                    </div>
                </div>
            </div>
        </section>

        {{-- Type scale --}}
        <section>
            <h2 class="font-step-heading font-semibold text-xl mb-4">Type scale</h2>
            <div class="space-y-3 border border-gray-200 rounded-lg p-6">
                <h1 class="font-step-heading font-bold text-4xl">Heading 1 &mdash; Poppins</h1>
                <h2 class="font-step-heading font-bold text-3xl">Heading 2 &mdash; Poppins</h2>
                <h3 class="font-step-heading font-semibold text-2xl">Heading 3 &mdash; Poppins</h3>
                <h4 class="font-step-heading font-semibold text-xl">Heading 4 &mdash; Poppins</h4>
                <h5 class="font-step-heading font-medium text-lg">Heading 5 &mdash; Poppins</h5>
                <h6 class="font-step-heading font-medium text-base">Heading 6 &mdash; Poppins</h6>
                <p class="font-step-sans text-base text-gray-700">Body copy in Hind &mdash; the Society of Technology and Energy Professionals (STEP) is the fastest growing professional body in Nigeria, dedicated to the registration and development of technology and energy professionals across the country.</p>
            </div>
        </section>

        {{-- Alpine sanity check --}}
        <section>
            <h2 class="font-step-heading font-semibold text-xl mb-4">Interactivity (Alpine.js)</h2>
            <div x-data="{ open: false }" class="border border-gray-200 rounded-lg p-6">
                <button @click="open = !open" class="bg-step-primary text-white font-step-heading font-semibold text-sm px-6 py-2.5 rounded-full hover:bg-step-accent transition-colors">
                    <span x-text="open ? 'Hide details' : 'Show details'"></span>
                </button>
                <p x-show="open" x-transition x-cloak class="mt-4 text-gray-600">If this toggles, Alpine is wired up correctly &mdash; same directive pattern used by the header's dropdowns and mobile menu above.</p>
            </div>
        </section>
    </main>

    {{-- ================= FOOTER ================= --}}
    <footer class="bg-gray-900 text-gray-300">
        <div class="max-w-7xl mx-auto px-4 py-14 grid grid-cols-1 md:grid-cols-3 gap-10">
            <div>
                <img src="{{ asset('frontend/img/footer-logo.png') }}" alt="STEP Logo" class="h-12 w-auto mb-4">
                <p class="flex items-start gap-2 mb-2"><i class="fa fa-map mt-1"></i> National Energy and Technology Center (NET CENTER) No. 15 Abua Street, Rumuibekwe, Port Harcourt</p>
                <p class="flex items-center gap-2 mb-2"><i class="fa fa-phone"></i> +234-{{ config('global.site_phone') }}</p>
                <p class="flex items-center gap-2"><i class="fa fa-envelope"></i> {{ config('global.site_email') }}</p>
            </div>
            <div>
                <h3 class="font-step-heading font-semibold text-white mb-4">Useful Links</h3>
                <ul class="space-y-2">
                    <li><a href="/about" class="hover:text-step-accent">About Us</a></li>
                    <li><a href="/certifications" class="hover:text-step-accent">Certifications</a></li>
                    <li><a href="/trainings" class="hover:text-step-accent">Trainings</a></li>
                    <li><a href="/journal-publication" class="hover:text-step-accent">Publications &amp; Journals</a></li>
                    <li><a href="/join" class="hover:text-step-accent">Join STEP</a></li>
                    <li><a href="/contact" class="hover:text-step-accent">Contact</a></li>
                </ul>
            </div>
            <div>
                <h3 class="font-step-heading font-semibold text-white mb-4">Newsletter</h3>
                <p class="mb-3 text-sm">Sign up today for hints, tips and the latest STEP news</p>
                <form action="#" class="flex">
                    <input type="text" placeholder="Email Address" class="flex-1 rounded-l-md px-3 py-2 text-gray-900 text-sm focus:outline-none">
                    <button type="submit" class="bg-step-accent px-4 rounded-r-md"><i class="fa fa-paper-plane"></i></button>
                </form>
                <div class="flex gap-3 mt-6">
                    <a href="#" class="hover:text-step-accent" aria-label="Facebook"><i class="fa fa-facebook"></i></a>
                    <a href="#" class="hover:text-step-accent" aria-label="Twitter"><i class="fa fa-twitter"></i></a>
                    <a href="#" class="hover:text-step-accent" aria-label="LinkedIn"><i class="fa fa-linkedin"></i></a>
                </div>
            </div>
        </div>
        <div class="border-t border-gray-800">
            <div class="max-w-7xl mx-auto px-4 py-4 flex flex-col sm:flex-row items-center justify-between gap-2 text-xs text-gray-500">
                <p>Copyrights &copy; {{ date('Y') }} All Rights Reserved. Powered by <a class="text-gray-300 hover:text-step-accent" href="https://www.noblecontracts.com">Noble IT Services</a></p>
                <ul class="flex gap-4">
                    <li><a href="#" class="hover:text-step-accent">Legal</a></li>
                    <li><a href="#" class="hover:text-step-accent">Sitemap</a></li>
                    <li><a href="#" class="hover:text-step-accent">Privacy Policy</a></li>
                </ul>
            </div>
        </div>
    </footer>

</body>
</html>
