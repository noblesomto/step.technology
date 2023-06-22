@include('frontend.layouts.header')
@include('frontend.layouts.nav')




<!--Start breadcrumb area-->     
<section class="breadcrumb-area" style="background-image: url({{ asset('frontend/img/banner.jpg') }});">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumbs">
                    <h1>STEP Support</h1>
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
                        <li class="active">STEP Support</li>
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
                    <h1>STEP Professional Support (PS)</h1>
                    <span class="border"></span>
                </div>
                    <div class="text-holder">
                        <h5>Aim: To improve people or organizational performance by offering world class complete solutions.<br>
                        Our PS includes:</h5> <br>
                        <ul>
                            <li><i class="fa fa-angle-right" aria-hidden="true"></i> Research</li>
                            <li><i class="fa fa-angle-right" aria-hidden="true"></i> Trainings</li>
                            <li><i class="fa fa-angle-right" aria-hidden="true"></i> New technology and energy knowledge sharing</li>
                            <li><i class="fa fa-angle-right" aria-hidden="true"></i> Process</li>
                            <li><i class="fa fa-angle-right" aria-hidden="true"></i> Content development</li>
                            <li><i class="fa fa-angle-right" aria-hidden="true"></i> Data</li>
                            <li><i class="fa fa-angle-right" aria-hidden="true"></i> Professional Task delivery</li>
                            <li><i class="fa fa-angle-right" aria-hidden="true"></i> CSR</li>
                        </ul>
                    </div>

                    <div class="text-holder mt-30">
                        <h5>These can be achieved through our P2P (Person2Person) or TECHSERV (Online services)</h5><br>
                        <h3>THREE STRATEGIES: </h3><br>
                        <ul>
                            <li><i class="fa fa-angle-right" aria-hidden="true"></i> Deliver integrated solutions directly or indirectly.</li>
                            <li><i class="fa fa-angle-right" aria-hidden="true"></i> Real time dimension to services</li>
                            <li><i class="fa fa-angle-right" aria-hidden="true"></i> Innovation management</li>
                            <li><i class="fa fa-angle-right" aria-hidden="true"></i> Best practices</li>
                           
                        </ul>
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