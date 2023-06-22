@include('frontend.layouts.header')
@include('frontend.layouts.nav')

<!--Start breadcrumb area-->     
<section class="breadcrumb-area" style="background-image: url({{ asset('frontend/img/banner.jpg') }});">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumbs">
                    <h1>Contact Us</h1>
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
                        <li class="active">Contact Us</li>
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

<!--Start contact area-->
<section class="get-touch-area">
    <div class="container">
        <div class="sec-title text-center">
            <h1>Get Touch With Us</h1>
            <span class="border-center"></span>
            <p>We want to hear from you!</p>
        </div>
        <div class="row">
            <!--Start single item-->
            <div class="col-md-4">
                <div class="single-item hvr-grow-shadow text-center">
                    <div class="icon-holder">
                        <span class="flaticon-signs"></span>    
                    </div> 
                    <div class="text-holder">
                        <h3>Visit Our Place</h3>
                        <span class="border"></span>
                        <p>National Energy and Technology Center ( NET CENTER) No; 15 Abua Street Rumuibekwe Port Harcourt</p>
                    </div>  
                </div>
            </div>
            <!--End single item-->
            <!--Start single item-->
            <div class="col-md-4">
                <div class="single-item hvr-grow-shadow text-center">
                    <div class="icon-holder">
                        <span class="flaticon-telephone"></span>    
                    </div> 
                    <div class="text-holder">
                        <h3>Phone</h3>
                        <span class="border"></span>
                        <p>+234-{{ config('global.site_phone') }}<br> </p>
                    </div>  
                </div>
            </div>
            <!--End single item-->   
            <!--Start single item-->
            <div class="col-md-4">
                <div class="single-item hvr-grow-shadow text-center">
                    <div class="icon-holder">
                        <span class="flaticon-contact"></span>    
                    </div> 
                    <div class="text-holder">
                        <h3>Email</h3>
                        <span class="border"></span>
                        <p>Email: {{ config('global.site_email') }}</p>
                    </div>  
                </div>
            </div>
            <!--End single item-->        
        </div>
    </div>
</section>
<!--End contact area-->

<!--Start contact form area-->
<section class="contact-form-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-7 col-md-offset-2">
                <div class="contact-form">
                    <div class="sec-title pdb-50">
                        <h1>Send Us Your Mesage</h1>
                        <span class="border"></span>
                         @if(session('status'))
                            <div class="alert alert-{{session('status')['type']}}">
                                {{session('status')['text']}}
                            </div>
                        @endif
                    </div>
                    <form  class="default-form" action="/contact" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" name="name" class="form-control" value="" placeholder="Your Name*" required="">
                            </div>
                            <div class="col-md-6">
                                <input type="email" name="email" class="form-control" value="" placeholder="Your Mail*" required="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" name="phone" class="form-control" value="" placeholder="Phone" required>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="subject" class="form-control" value="" placeholder="Subject" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <textarea name="message" class="form-control" placeholder="Your Message.." required=""></textarea>
                            </div>
                        </div>
                       

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <strong>ReCaptcha:</strong>
                                    <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}"></div>
                                    @if ($errors->has('g-recaptcha-response'))
                                        <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                                    @endif   
                                </div>
                            </div>
                            </div>

                             <div class="row">
                            <div class="col-md-12">
                                <input id="form_botcheck" name="form_botcheck" class="form-control" type="hidden" value="">
                                <button class="thm-btn bgclr-1" type="submit" data-loading-text="Please wait...">send message</button>
                            </div>
                        </div>
                    </form>  
                </div>
            </div>
   
        </div>
    </div>
</section>
<!--End contact form area-->


<script type="text/javascript">

$("#refresh").click(function(){

  $.ajax({
     type:'GET',
     url:'/refresh_captcha',
     success:function(data){
        $(".captcha span").html(data.captcha);
     }
  });
});


</script>

@include('frontend.layouts.footer')