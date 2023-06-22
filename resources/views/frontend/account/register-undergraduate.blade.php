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
                        <li class="active">Register</li>
                    </ul>
                </div>
                <div class="right pull-right">
                    
                </div>    
            </div>
        </div>
    </div>
</section>
<!--End breadcrumb bottom area-->

<!--Start Business planning area-->
<section id="single-service-area">
    <div class="container">
        <div class="row login-register-area">
            <div class="col-lg-8 col-md-7 col-sm-12 col-xs-12 pull-right">
                <div class="content-box ">
                    <!--Start top content-->
                    <div class="form register">
                    <div class="sec-title">
                        <h1>Register as Undergraduate</h1>
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
                        <form action="/register-undergraduate" method="POST">
                        @csrf
                            <div class="col-md-12">
                                @if ($errors->has('title'))
                                    <span class="text-danger">{{ $errors->first('title') }}</span>
                                @endif
                                <div class="input-field">
                                    <select class="form-control" name="title" required>
                                        <option value="">Select Title</option>
                                        <option value="Mr">Mr</option>
                                        <option value="Miss">Miss</option>
                                        <option value="Mrs">Mrs</option>
                                    </select>
                                </div>    
                            </div> 
                            <div class="col-md-12">
                                @if ($errors->has('first_name'))
                                    <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                @endif
                                <div class="input-field">
                                    <input type="text" name="first_name" placeholder="First Name *" required value="{{ old('first_name') }}">
                                    <div class="icon-holder">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                    </div>
                                </div>    
                            </div>
                            <div class="col-md-12">
                                @if ($errors->has('last_name'))
                                    <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                @endif
                                <div class="input-field">
                                    <input type="text" name="last_name" placeholder="Last Name *" required value="{{ old('last_name') }}">
                                    <div class="icon-holder">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                    </div>
                                </div>    
                            </div> 

                            <div class="col-md-12">
                                @if ($errors->has('phone'))
                                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                                @endif
                                <div class="input-field">
                                    <input type="tel" name="phone" placeholder="Phone Number *" required value="{{ old('phone') }}">
                                    <div class="icon-holder">
                                        <i class="fa fa-phone" aria-hidden="true"></i>
                                    </div>
                                </div>    
                            </div>
                            <div class="col-md-12">
                                @if ($errors->has('school_name'))
                                    <span class="text-danger">{{ $errors->first('school_name') }}</span>
                                @endif
                                <div class="input-field">
                                    <input type="text" name="school_name" placeholder="School Name *" required value="{{ old('school_name') }}">
                                    <div class="icon-holder">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                    </div>
                                </div>    
                            </div>
                            <div class="col-md-12">
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                                <div class="input-field">
                                    <input type="email" name="email" placeholder="Enter Email *" required value="{{ old('email') }}">
                                    <div class="icon-holder">
                                        <i class="fa fa-envelope" aria-hidden="true"></i>
                                    </div>
                                </div>    
                            </div>
                            <div class="col-md-12">
                                @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                                <div class="input-field">
                                    <input type="password" name="password" placeholder="Enter Password *" required value="{{ old('password') }}">
                                    <div class="icon-holder">
                                        <i class="fa fa-unlock-alt" aria-hidden="true"></i>
                                    </div>
                                </div>    
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-lg-5 col-md-3 col-sm-4 col-xs-12">
                                        <button class="thm-btn bgclr-1" type="submit">Register</button>
                                    </div>
                                    <div class="col-lg-7 col-md-9 col-sm-8 col-xs-12">
                                        <h6><span>*</span>You must fill all the fields. </h6>
                                    </div>
                                </div>   
                            </div> 
                        </form>    
                    </div>
                </div>    
            </div>
                
            </div>
            <div class="col-lg-4 col-md-5 col-sm-7 col-xs-12 pull-left">
                <div class="left-sidebar">
                    <!--Start single sidebar-->
                    <div class="single-sidebar">
                        <ul class="page-link">
                            <li><a class="active" href="/register-undergraduate">UnderGraduate</a></li>
                            <li><a  href="/register-young-professional">Young Professional</a></li>
                            <li><a href="/register-corporate-professional">Corporate Professional</a></li>
                            <li><a href="register-corporate-organization">Corporate Organisation</a></li>             
                        </ul>
                    </div>
                    <!--End single sidebar-->
                
           
                </div>
            </div>
        </div>
    </div>
</section>
<!--End Business planning area-->




@include('frontend.layouts.footer')