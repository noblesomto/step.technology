<!--Start footer area-->  
<footer class="footer-area">
    <div class="container">
        <div class="row">
            <!--Start single footer widget-->
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="single-footer-widget pd-bottom50">
                    <div class="footer-logo">
                        <a href="index.html">
                            <img src="{{ asset('frontend/img/footer-logo.png') }}" alt="STEP Logo">
                        </a>
                    </div>
                    <div class="widget-content">
                        <p class="top">
                            <i class="fa fa-map"></i> National Energy and Technology Center ( NET CENTER) No; 15 Abua Street Rumuibekwe Port Harcourt
                        </p>
                        <p>
                            <i class="fa fa-phone"></i> +234-{{ config('global.site_phone') }}.
                        </p>
                        <p>
                            <i class="fa fa-envelope"></i> {{ config('global.site_email') }}
                        </p>
                    </div>
                </div>
            </div>
            <!--End single footer widget-->
            <!--Start single footer widget-->
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="single-footer-widget margin-lft pd-bottom50">
                    <div class="title">
                        <h3>Usefull Links</h3>
                        <span class="border"></span>
                    </div>
                    <ul class="usefull-links">
                        <li><a href="/about"><i class="fa fa-angle-right" aria-hidden="true"></i>About Us</a></li>
                        <li><a href="/certifications"><i class="fa fa-angle-right" aria-hidden="true"></i>Certifications</a></li>
                        <li><a href="/trainings"><i class="fa fa-angle-right" aria-hidden="true"></i>Trainings</a></li>
                        <li><a href="/journal-publication"><i class="fa fa-angle-right" aria-hidden="true"></i>Publications & Journals</a></li>
                        <li><a href="/join"><i class="fa fa-angle-right" aria-hidden="true"></i>Join Step</a></li>
                        <li><a href="/contact"><i class="fa fa-angle-right" aria-hidden="true"></i>Contact</a></li>
                        <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i>STEP Support</a></li>
                    </ul>
                </div>
            </div>
            <!--End single footer widget-->
         
            <!--Start single footer widget-->
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="single-footer-widget martop50">
                    <div class="title">
                        <h3>Newsletter</h3>
                        <span class="border"></span>
                    </div>
                    <div class="newsletter-box">
                        <p>Sign up today for hints, tips and the latest STEP news</p>
                        <form class="newsletter-form" action="#">
                            <input placeholder="Email Address" type="text">
                            <button type="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                            <div class="envelope">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                            </div>
                        </form>
                    </div>
                </div>
                
                <div class="single-footer-widget">
                    <div class="title">
                        <h3>Follw Us On</h3>
                        <span class="border"></span>
                    </div>
                    <ul class="footer-social-links">
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        <li><a href="#"><i class="fa fa-skype"></i></a></li>
                    </ul>
                </div>
                
            </div>
            <!--End single footer widget-->
        </div>
    </div>
</footer>   
<!--End footer area-->

<!--Start footer bottom area-->
<section class="footer-bottom-area">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="copyright-text">
                    <p>Copyrights © {{ date('Y') }} All Rights Reserved. Powered by <a href="https://www.noblecontracts.com">Noble Contracts</a></p> 
                </div>
            </div>
            <div class="col-md-4">
                <ul class="footer-menu">
                    <li><a href="#">Legal</a></li>
                    <li><a href="#">Sitemap</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!--End footer bottom area-->

</div>

<!--Scroll to top-->
<div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-chevron-circle-up"></span></div>

<!-- main jQuery -->
<script src="{{ asset('frontend/js/jquery-1.12.4.min.js') }}"></script>
<!-- Wow Script -->
<script src="{{ asset('frontend/js/wow.js') }}"></script>
<!-- bootstrap -->
<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
<!-- bx slider -->
<script src="{{ asset('frontend/js/jquery.bxslider.min.js') }}"></script>
<!-- count to -->
<script src="{{ asset('frontend/js/jquery.countTo.js') }}"></script>
<!-- owl carousel -->
<script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
<!-- validate -->
<script src="{{ asset('frontend/js/validation.js') }}"></script>
<!-- mixit up -->
<script src="{{ asset('frontend/js/jquery.mixitup.min.js') }}"></script>
<!-- easing -->
<script src="{{ asset('frontend/js/jquery.easing.min.js') }}"></script>
<!-- gmap helper -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAHzPSV2jshbjI8fqnC_C4L08ffnj5EN3A"></script>
<!--gmap script-->
<script src="{{ asset('frontend/js/gmaps.js') }}"></script>
<script src="{{ asset('frontend/js/map-helper.js') }}"></script>
<!-- fancy box -->
<script src="{{ asset('frontend/js/jquery.fancybox.pack.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.appear.js') }}"></script>
<!-- isotope script-->
<script src="{{ asset('frontend/js/isotope.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.prettyPhoto.js') }}"></script> 
<script src="{{ asset('frontend/js/jquery.bootstrap-touchspin.js') }}"></script>
<!-- jQuery timepicker js -->
<script src="{{ asset('frontend/assets/timepicker/timePicker.js') }}"></script>
<!-- Bootstrap select picker js -->
<script src="{{ asset('frontend/assets/bootstrap-sl-1.12.1/bootstrap-select.js') }}"></script>                               
<!-- Bootstrap bootstrap touchspin js -->
<!-- jQuery ui js -->
<script src="{{ asset('frontend/assets/jquery-ui-1.11.4/jquery-ui.js') }}"></script>
<!-- Language Switche  -->
<script src="{{ asset('frontend/assets/language-switcher/jquery.polyglot.language.switcher.js') }}"></script>
<!-- Html 5 light box script-->
<script src="{{ asset('frontend/assets/html5lightbox/html5lightbox.js') }}"></script>


<!-- revolution slider js -->
<script src="{{ asset('frontend/assets/revolution/js/jquery.themepunch.tools.min.js') }}"></script>
<script src="{{ asset('frontend/assets/revolution/js/jquery.themepunch.revolution.min.js') }}"></script>
<script src="{{ asset('frontend/assets/revolution/js/extensions/revolution.extension.actions.min.js') }}"></script>
<script src="{{ asset('frontend/assets/revolution/js/extensions/revolution.extension.carousel.min.js') }}"></script>
<script src="{{ asset('frontend/assets/revolution/js/extensions/revolution.extension.kenburn.min.js') }}"></script>
<script src="{{ asset('frontend/assets/revolution/js/extensions/revolution.extension.layeranimation.min.js') }}"></script>
<script src="{{ asset('frontend/assets/revolution/js/extensions/revolution.extension.migration.min.js') }}"></script>
<script src="{{ asset('frontend/assets/revolution/js/extensions/revolution.extension.navigation.min.js') }}"></script>
<script src="{{ asset('frontend/assets/revolution/js/extensions/revolution.extension.parallax.min.js') }}"></script>
<script src="{{ asset('frontend/assets/revolution/js/extensions/revolution.extension.slideanims.min.js') }}"></script>
<script src="{{ asset('frontend/assets/revolution/js/extensions/revolution.extension.video.min.js') }}"></script>



<!-- thm custom script -->
<script src="{{ asset('frontend/js/custom.js') }}"></script>





</body>
</html>