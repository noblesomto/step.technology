@include('frontend.layouts.header')
@include('frontend.layouts.nav')
@include('frontend.layouts.slider')


<!--Start about area-->  
<section class="about-area sec-padding">
    <div class="container">
        <div class="sec-title pdb-50 text-center">
            <h1>Welcome to STEP</h1>
            <span class="border-center"></span>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="img-holder">
                    <img src="{{ asset('frontend/img/about.jpg') }}" alt="About STEP">
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="text-holder">
                    <div class="top-text sec-padding">
                        <h3>Society of Technology and Energy Professionals (STEP) is the fastest growing Professional body in Nigeria.</h3>  
                        <p>Is all about human, innovations, research and capacity developments. its primary objective is geared towards energy and technology advancements, intellectual and financial development of her members especially in energy and Technology sectors of Nigeria.</p> 
                    </div>
               
                    <div class="bottom">
                        <a class="readmore thm-btn bgclr-1" href="/about">Read More</a>
                       
                    </div>
                </div>
            </div>
        </div>
        <div class="promotion-box mt-20">
            <div class="row">
                <!--Start single box-->
                <div class="col-md-4">
                    <div class="singel-box hvr-float">
                        <div class="top">
                            <div class="icon-holder">
                                <span class="flaticon-innovation"></span>    
                            </div>
                            <div class="title-holder">
                                <h3>Innovative Works</h3>
                            </div>
                        </div>
                        <div class="text-holder">
                            <p>
                                Innovation Works is focused on growing and connecting the local startup ecosystem. Every year, we help hundreds of entrepreneurs, researchers and small manufacturers to create new markets and change the world with their innovations. 
                            </p>
                        </div>
                    </div>
                </div>
                <!--End single box-->
                <!--Start single box-->
                <div class="col-md-4">
                    <div class="singel-box hvr-float">
                        <div class="top">
                            <div class="icon-holder">
                                <span class="flaticon-shapes"></span>    
                            </div>
                            <div class="title-holder">
                                <h3>Certifications</h3>
                            </div>
                        </div>
                        <div class="text-holder">
                            <p>
                                Professional certifications can help individuals advance faster in their careers, especially in highly-specialized industries such as human resources, accounting or information technology.
                            </p>
                        </div>
                    </div>
                </div>
                <!--End single box-->
                <!--Start single box-->
                <div class="col-md-4">
                    <div class="singel-box hvr-float">
                        <div class="top">
                            <div class="icon-holder">
                                <span class="flaticon-suitcase"></span>    
                            </div>
                            <div class="title-holder">
                                <h3>Trainings</h3>
                            </div>
                        </div>
                        <div class="text-holder">
                            <p>
                                The training seminars listed here, from carefully selected management training firms/providers and consultants in Nigeria and around the world, covers all the basic and advanced requirements of lower, middle, and top management executives in public and private sectors.
                            </p>
                        </div>
                    </div>
                </div>
                <!--End single box-->
            </div>
        </div>
    </div>
</section>           
<!--End about area-->  

<div class="footer-top-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="title pull-left">
                    <h3>Join the fast-growing global network of energy and technology Professionals</h3>    
                </div>
                <div class="button pull-right">
                    <a class="thm-btn bgclr-1" href="/join">Join Now</a>
                </div>  
            </div>
        </div>
    </div>
</div> 


<!--Start latest blog area-->  
<section class="latest-blog-area sec-padding">
    <div class="container">
        <div class="sec-title pdb-50 text-center">
            <h1>Latest From Blog</h1>
            <span class="border-center"></span>
        </div>
        <div class="row">
            @foreach ($blogpost as $row)
            <!--Start single blog item-->
            <div class="col-md-4">
                <div class="single-blog-item">
                    <div class="img-holder">
                        <img src="{{ asset('uploads/thumbnails/'.$row->blog_picture) }}" alt="{{ $row->blog_title }}">
                        <div class="overlay-style-one">
                            <div class="box">
                                <div class="content">
                                    <a href="/blog/{{ $row->blog_id }}/{{ $row->blog_slug }}"><i class="fa fa-link" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="post-date">
                            <h5>{{ $row->created_at->format('j F');  }}</h5>    
                        </div>
                    </div>
                    <div class="text-holder">
                        
                        <a href="/blog/{{ $row->blog_id }}/{{ $row->blog_slug }}">
                            <h3 class="blog-title">{!! Str::words($row->blog_title, 10) !!}</h3>
                        </a>
                        <div class="text">
                            {!! Str::words($row->blog_body, 15) !!}
                        </div>
                        <div class="bottom">
                            <div class="left pull-left">
                                <a href="/blog/{{ $row->blog_id }}/{{ $row->blog_slug }}">Read More</a>
                            </div>
                            <div class="right pull-right">
                                <h5><span class="flaticon-interface"></span>{{ $row->blog_views }}</h5>
                            </div>    
                        </div>
                    </div>    
                </div>    
            </div>
            <!--End single blog item-->
            @endforeach
           
        </div>
    </div>
</section>
<!--End latest blog area--> 


 
<!--Start Brand area-->  
<section class="brand-area">
    <div class="container">
        <div class="sec-title  pdb-50">
            <h1>Become STEP Certified</h1>
            <span class="border"></span>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="brand">
                    <!--Start single item-->
                    <a class="tool_tip" title="STEP CERTIFICATIONS" href="/certifications">
                        <div class="single-item">
                            <img src="{{ asset('frontend/img/cert/cert-1.png') }}" alt="STEP Certifications">
                        </div>
                    </a>
                    <!--End single item-->
                    <!--Start single item-->
                    <a class="tool_tip" title="STEP CERTIFICATIONS" href="/certifications">
                        <div class="single-item">
                           <img src="{{ asset('frontend/img/cert/cert-6.png') }}" alt="STEP Certifications">
                        </div>
                    </a>
                    <!--End single item-->
                    <!--Start single item-->
                    <a class="tool_tip" title="STEP CERTIFICATIONS" href="/certifications">
                        <div class="single-item">
                            <img src="{{ asset('frontend/img/cert/cert-3.png') }}" alt="STEP Certifications">
                        </div>
                    </a>
                    <!--End single item-->
                    <!--Start single item-->
                    <a class="tool_tip" title="STEP CERTIFICATIONS" href="/certifications">
                        <div class="single-item" title="STEP CERTIFICATIONS">
                           <img src="{{ asset('frontend/img/cert/cert-4.png') }}" alt="STEP Certifications">
                        </div>
                    </a>
                    <!--End single item-->
                    <!--Start single item-->
                    <a class="tool_tip" title="STEP CERTIFICATIONS" href="/certifications">
                        <div class="single-item">
                            <img src="{{ asset('frontend/img/cert/cert-5.png') }}" alt="STEP Certifications">
                        </div>
                    </a>
                    <!--End single item-->
                </div>
            </div>
        </div>
        <div class="row pdb-50 sec-padding">
            <div class="col-md-12">
                <div class="text-center">
                    <h4>Rise to the Top of the Energy Management Profession</h4>
                </div>
            </div>
        </div>
    </div>
</section>
<!--End Brand area-->    




@include('frontend.layouts.footer')