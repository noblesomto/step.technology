@include('frontend.layouts.header')
@include('frontend.layouts.nav')




<!--Start breadcrumb area-->     
<section class="breadcrumb-area" style="background-image: url({{ asset('frontend/img/banner.jpg') }});">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumbs">
                    <h1>About Us</h1>
                </div>
            </div>
        </div>
    </div>
</section>
<!--End breadcrumb area-->

<!--Start breadcrumb bottom area-->     
<section class="breadcrumb-bottom-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="left pull-left">
                    <ul>
                        <li><a href="/">Home</a></li>
                        <li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
                        <li class="active">About Us</li>
                    </ul>
                </div>
                <div class="right pull-right">
                    <a href="#">
                        <span><i class="fa fa-share-alt" aria-hidden="true"></i>Share</span> 
                    </a>   
                </div>    
            </div>
        </div>
    </div>
</section>
<!--End breadcrumb bottom area-->

<!--Start about area-->
<section class="about-area sec-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="img-holder">
                    <img src="{{ asset('frontend/img/about-step.png') }}" alt="About STEP">
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="text-holder">
                    <div class="top-text">
                        <h3>Founded in Africa, the body is committed to innovation, research, and capacity developments geared towards advancements in energy and technology and in the intellectual development of its members.</h3>  
                    </div>
                    <div class="bottom-text">
                        <span>WHO WE ARE</span>
                        <p>As a professional organization, STEP fosters knowledge sharing, cooperation, career and skills development across science, energy, technology, and engineering disciplines to proffer solutions to benefit mankind.
                        </p>
                        <p>
                            Its members comprise engineers, scientists/academics, professional researchers, policymakers, doctors, investors, and many others. All members enjoy enormous benefits such as training/certifications in their areas of specialization, monthly energy/technology newsletters, monthly technical sessions, conferences/exhibitions, online webinars, career advisory systems/contacts, annually subsidized international intellectual development tour, and partnership/mentorship platforms
                        </p>
                    </div>
         
                </div>
            </div>
        </div>
        <div class="row bottom-content mt-20">
            <!--Start single item-->
            <div class="col-md-4">
                <div class="single-item wow fadeInUp" data-wow-delay="0s" data-wow-duration="1s" data-wow-offset="0">
                    
                    <div class="text-holder">
                        <h3>Our Mission</h3>
                        <p>To build a network of professionals in the energy and technology industry that will pilot the next generation of social innovations.</p>
                    </div>
                </div>
            </div>
            <!--End single item-->
            <!--Start single item-->
            <div class="col-md-4">
                <div class="single-item wow fadeInUp" data-wow-delay="0s" data-wow-duration="1s" data-wow-offset="0">
                  
                    <div class="text-holder">
                        <h3>Our Vision</h3>
                        <p>To be at the forefront in leading technical and social innovations that promote sustainable living.</p>
                    </div>
                </div>
            </div>
            <!--End single item-->
            <!--Start single item-->
            <div class="col-md-4">
                <div class="single-item wow fadeInUp" data-wow-delay="0s" data-wow-duration="1s" data-wow-offset="0">
                 
                    <div class="text-holder">
                        <h3>Values</h3>
                        <p> The society was founded by engineers, academics, and scientists who were eager to work together to create better working conditions and make significant contributions to the world.</p>
                    </div>
                </div>
            </div>
            <!--End single item-->
        </div>
    </div>
</section>
<!--End about area-->

 
 
<!--Start opportunities area--> 
<section class="opportunities-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="inner-content text-center wow zoomIn" data-wow-delay="0.5s" data-wow-duration="1s" data-wow-offset="0">
                    <h1>It is time to create your own world. Take the bold STEP now!.</h1>
                    <p></p>
                    <a href="/join">Join Now</a>
                </div>
            </div>
        </div>
    </div>
</section>      
<!--End opportunities area--> 
 





@include('frontend.layouts.footer')