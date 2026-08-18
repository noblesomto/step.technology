<header x-data="{ mobileOpen: false }">
    {{-- Top bar --}}
    <div class="bg-step-primary text-white text-sm">
        <div class="max-w-7xl mx-auto px-4 flex flex-col sm:flex-row items-center justify-between gap-1 py-2">
            <ul class="flex flex-wrap items-center gap-4">
                <li><i class="fa fa-phone"></i> Phone: +234{{ config('global.site_phone') }}</li>
                <li><i class="fa fa-envelope"></i> {{ config('global.site_email') }}</li>
            </ul>
            <div class="flex items-center gap-3">
                <span class="hidden sm:inline mr-1">Stay Connected:</span>
                <a href="#" class="hover:text-step-accent" aria-label="Facebook"><i class="fa fa-facebook"></i></a>
                <a href="#" class="hover:text-step-accent" aria-label="Twitter"><i class="fa fa-twitter"></i></a>
                <a href="#" class="hover:text-step-accent" aria-label="Google Plus"><i class="fa fa-google-plus"></i></a>
                <a href="#" class="hover:text-step-accent" aria-label="LinkedIn"><i class="fa fa-linkedin"></i></a>
            </div>
        </div>
    </div>

    {{-- Main menu --}}
    <div class="border-b border-gray-200 sticky top-0 bg-white z-30">
        <div class="max-w-7xl mx-auto px-4 flex items-center justify-between h-20">
            <a href="/" class="shrink-0">
                <img src="{{ asset('frontend/img/new-logo.png') }}" alt="STEP Logo" class="h-12 w-auto">
            </a>

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

            <button @click="mobileOpen = !mobileOpen" class="lg:hidden p-2" aria-label="Toggle menu">
                <svg class="w-6 h-6 text-step-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path x-show="!mobileOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    <path x-show="mobileOpen" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

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
