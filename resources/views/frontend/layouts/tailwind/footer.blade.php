    <footer class="bg-gray-900 text-gray-300">
        <div class="max-w-7xl mx-auto px-4 py-14 grid grid-cols-1 md:grid-cols-3 gap-10">
            <div>
                <img src="{{ asset('frontend/img/footer-logo.png') }}" alt="STEP Logo" class="h-12 w-auto mb-4">
                <p class="flex items-start gap-2 mb-2"><i class="fa fa-map mt-1"></i> National Energy and Technology Center (NET CENTER) No. 15 Abua Street Rumuibekwe, Port Harcourt</p>
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
                    <li><a href="/step-support" class="hover:text-step-accent">STEP Support</a></li>
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
                    <a href="#" class="hover:text-step-accent" aria-label="Google Plus"><i class="fa fa-google-plus"></i></a>
                    <a href="#" class="hover:text-step-accent" aria-label="LinkedIn"><i class="fa fa-linkedin"></i></a>
                    <a href="#" class="hover:text-step-accent" aria-label="Skype"><i class="fa fa-skype"></i></a>
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
