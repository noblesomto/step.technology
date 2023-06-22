@include('frontend.layouts.header')
@include('frontend.layouts.nav')



<!--Start breadcrumb area-->     
<section class="breadcrumb-area" style="background-image: url({{ asset('frontend/img/banner.jpg') }});">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumbs">
                    <h1>Journals & Publications </h1>
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
                        <li class="active">Journals & Publications </li>
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
                    <h1>STEP Journals & Publications </h1>
                    <span class="border"></span>
                </div>
                    <div class="text-holder">
                        <i><h4>Check back soon, as new Journals & Publications  are comining to STEP</h4></i>
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