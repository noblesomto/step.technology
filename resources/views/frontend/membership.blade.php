@include('frontend.layouts.header')
@include('frontend.layouts.nav')




<!--Start breadcrumb area-->     
<section class="breadcrumb-area" style="background-image: url({{ asset('frontend/img/banner.jpg') }});">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumbs">
                    <h1>Membership</h1>
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
                        <li class="active">Membership</li>
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
        <div class="row benefits-service-content">
            <div class="col-lg-8 col-md-offset-2">
                <div class="sec-title pdb-50">
                    <h1>Membership Applications</h1>
                    <span class="border"></span>
                </div>
                    <div class="text-holder">
                        <h5>Join STEP and become part of a dedicated group of over 1000 Professionals.<br>
                        Benefits:</h5> <br>
                        <ul>
                            <li><i class="fa fa-angle-right" aria-hidden="true"></i> Trainings/ Certifications in their areas of specialization</li>
                            <li><i class="fa fa-angle-right" aria-hidden="true"></i> Monthly energy/Technology newsletters</li>
                            <li><i class="fa fa-angle-right" aria-hidden="true"></i> Entrepreneurial start up grants</li>
                            <li><i class="fa fa-angle-right" aria-hidden="true"></i> Monthly technical sessions</li>
                            <li><i class="fa fa-angle-right" aria-hidden="true"></i> STEP conferences/ Exhibitions, online webinars</li>
                            <li><i class="fa fa-angle-right" aria-hidden="true"></i> Career advisory systems/ contacts</li>
                            <li><i class="fa fa-angle-right" aria-hidden="true"></i> Annual subsidized intellectual development international tour to a foreign country, partnership/ mentorship platforms</li>
                        
                        </ul>
                    </div>

                    <div class="text-holder mt-30">
                       
                        <h3>Membership Category: </h3><br>
                       <!--Start accordion box-->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="accordion-box">
                                <!--Start single accordion box-->
                                <div class="accordion accordion-block">
                                    <div class="accord-btn">
                                        <h4>Undergraduates</h4>
                                    </div>
                                    <div class="accord-content">
                                        <p>Person must be undergoing a regular course of study in Engineering Science of duration not less than three years in a University or Technical Institution whose curriculum is approved by the Council in respect of Engineering Education. </p>
                                    </div>
                                </div>
                                <!--End single accordion box--> 
                                <!--Start single accordion box-->
                                <div class="accordion accordion-block">
                                    <div class="accord-btn">
                                        <h4>Young Professionals</h4>
                                    </div>
                                    <div class="accord-content">
                                        <p>Person must possess an academic qualification at the level of a University degree in the Sciences allied to engineering science, or other qualifications approved by the Council of the Society.<br>
                                        Person must have been engaged on work related to the practice of engineering for a minimum period of five years.</p>
                                    </div>
                                </div>
                                <!--End single accordion box-->
                                <!--Start single accordion box-->
                                <div class="accordion accordion-block last">
                                    <div class="accord-btn last">
                                        <h4>Corporate Professionals</h4>
                                    </div>
                                    <div class="accord-content last">
                                        <p>A Corporate member is eligible to all privileges of a member as prescribed by Council, is eligible to vote at the AGM and can aspire to any positions in the Society in line with the conditions as prescribed by Council. </p>
                                    </div>
                                </div>
                                <!--End single accordion box-->
                                <!--Start single accordion box-->
                                <div class="accordion accordion-block last">
                                    <div class="accord-btn last">
                                        <h4>Corporate Organisation</h4>
                                    </div>
                                    <div class="accord-content last">
                                        <p>A Corporate Organisation is eligible to all privileges of a member as prescribed by Council, is eligible to vote at the AGM and can aspire to any positions in the Society in line with the conditions as prescribed by Council.</p>
                                    </div>
                                </div>
                                <!--End single accordion box-->       
                            </div>
                        </div>
                    </div>
                    <!--End accordion box-->
                    </div>
        </div>
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