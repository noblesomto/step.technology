@include('frontend.layouts.header')
@include('frontend.layouts.nav')




<!--Start breadcrumb area-->     
<section class="breadcrumb-area" style="background-image: url({{ asset('frontend/img/banner.jpg') }});">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumbs">
                    <h1>Our Blog</h1>
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

<!--Start blog area-->
<section id="blog-area" class="blog-default-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="blog-post">
                    <div class="row">
                        @foreach ( $blog as $row )
                        <!--Start single blog post-->
                        <div class="col-md-4 blog-single-post">
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
                        <!--End single blog post-->
                        @endforeach
                        
     
                      
                    </div>
                    <!--Start post pagination-->
                    <div class="row">
                        <div class="col-md-12 text-center"> 
                            {!! $blog->links() !!}
                        </div> 
                    </div>
                    <!--End post pagination-->
                </div>
            </div>
        </div>
    </div>
</section>
 





@include('frontend.layouts.footer')