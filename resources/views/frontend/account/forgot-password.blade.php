@include('frontend.layouts.header')
@include('frontend.layouts.nav')




<!--Start breadcrumb area-->     
<section class="breadcrumb-area" style="background-image: url({{ asset('frontend/img/banner.jpg') }});">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumbs">
                    <h1>ACCOUNT SECTION</h1>
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
                        <li class="active">Forgot Password</li>
                    </ul>
                </div>
                <div class="right pull-right">
                    
                </div>    
            </div>
        </div>
    </div>
</section>
<!--End breadcrumb bottom area-->

<!--Start login register area-->
<section class="login-register-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-12 col-sm-12 col-xs-12">
                <div class="form">
                    <div class="sec-title">
                        <h1>Forgot Password</h1>
                        <span class="border"></span>
                        <p>
                            @if(session('status'))
                                <div class="alert alert-{{session('status')['type']}}">
                                    {{session('status')['text']}}
                                </div>
                            @endif
                        </p>
                    </div>
                    <div class="row">
                        <form action="/forgot-password" method="POST">
                        @csrf
                           
                            <div class="col-md-12">
                                <div class="input-field">
                                    <input type="email" name="email" class="form-control" placeholder="Enter Email Address *" required>
                                    <div class="icon-holder">
                                        <i class="fa fa-envelope" aria-hidden="true"></i>
                                    </div>
                                </div>    
                            </div>
                          
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <button class="thm-btn bgclr-1" type="submit">Submit</button>
                                     
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                     
                                       
                                    </div>
                                </div>   
                            </div> 
                        </form>    
                    </div>
                </div>    
            </div>
       
            
        </div>
    </div>
</section>      
<!--End login register area-->




@include('frontend.layouts.footer')