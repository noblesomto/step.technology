@include('frontend.layouts.header')
@include('frontend.layouts.nav')




<!--Start breadcrumb area-->     
<section class="breadcrumb-area" style="background-image: url({{ asset('frontend/img/banner.jpg') }});">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumbs">
                    <h1>{{ $blog->blog_title }}</h1>
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
                        <li class="active">Blog</li>
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

<!--Start blog Single area-->
<section id="blog-area" class="blog-large-area blog-single-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-12 col-sm-12 col-xs-12">
                <div class="blog-post">
                    <!--Start single blog post-->
                    <div class="single-blog-item">
                        <div class="img-holder">
                            <img src="{{ asset('uploads/blog/'.$blog->blog_picture) }}" alt="Awesome Image">
                            <div class="post-date">
                                <h5>{{ $blog->created_at->format('j F ');  }}</h5>    
                            </div>
                        </div>
                        <div class="text-holder">
                            
                            <h3 class="blog-title">{{ $blog->blog_title }}</h3>
                            <ul class="meta-info">
                                
                                <li><a href="#">0 Comments</a></li>
                            </ul>
                            <div class="text">
                                {!! $blog->blog_body !!}
                            </div>
                        </div>    
                    </div>
                    <!--End single blog post-->
                
             
                    <!--Start tag and social share box-->
                    <div class="tag-social-share-box">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="tag pull-left">
                                  
                                </div>
                                <div class="social-share pull-right">
                                    <h5>Share<i class="fa fa-share-alt" aria-hidden="true"></i></h5>
                                    <ul class="social-share-links">
                                        <li><a class="" href="http://www.facebook.com/sharer.php?u={{ url()->current(); }}" target="_blank"><i class="fa fa-facebook-f"></i></a></li>
                                        <li><a href="https://twitter.com/share?url={{ url()->current(); }}/&amp;text={{ $blog->blog_title }}&amp;hashtags=Ifynwuke" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{ url()->current(); }}" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                                        <li><a href="https://wa.me/?text={{ url()->current(); }}" target="_blank"><i class="fa fa-whatsapp"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End tag and social share box-->
                  
                    <!--Start comment box-->
                    <!--
                    <div class="comment-box">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="sec-title pdb-30">
                                    <h3>Read Comments</h3>
                                    <span class="border"></span>
                                </div>
                        
                                <div class="single-comment-box">
                                    <div class="img-holder">
                                        <img src="images/blog/comment-1.jpg" alt="Awesome Image">
                                    </div>
                                    <div class="text-holder">
                                        <div class="top">
                                            <div class="date pull-left">
                                                <h5>Steven Rich – Sep 17, 2016:</h5>
                                            </div>
                                            <div class="review-box pull-right">
                                                <ul>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="text">
                                            <p>How all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings.</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="single-comment-box">
                                    <div class="img-holder">
                                        <img src="images/blog/comment-2.jpg" alt="Awesome Image">
                                    </div>
                                    <div class="text-holder">
                                        <div class="top">
                                            <div class="date pull-left">
                                                <h5>William Cobus – Aug 21, 2016:</h5>
                                            </div>
                                            <div class="review-box pull-right">
                                                <ul>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star-half-o"></i></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="text">
                                            <p>there anyone who loves or pursues or desires to obtain pain itself, because it is pain, because occasionally circumstances occur some great pleasure.</p>
                                        </div>
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                -->
                    <!--End comment box-->
                    <!--Start add comment box-->
                    <div class="add-comment-box">
                        <div class="sec-title pdb-30">
                            <h3>Add Your Comments</h3>
                            <span class="border"></span>
                        </div>
                        <div class="add-rating-box">
                            <h4>Your Rating</h4>
                            <ul>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-star"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>   
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <form id="add-comment-form" name="comment-form" action="#" method="post">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="field-label">First Name*</div>
                                            <input type="text" name="fname" placeholder="" required="">
                                        </div>
                                        <div class="col-md-6">
                                            <div class="field-label">Last Name*</div>
                                            <input type="text" name="lname" placeholder="" required="">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="field-label">Email*</div>
                                            <input type="email" name="email" placeholder="" required="">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="field-label">Your Comments</div>
                                            <textarea name="comment"></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button class="thm-btn bgclr-1" type="submit">Submit Now</button>
                                        </div>
                                    </div>
                                   
                                </div>
                            </div>
                        </form>
                    </div>
                    <!--End add comment box-->
                </div>
            </div>
        </div>
    </div>
</section>
 





@include('frontend.layouts.footer')