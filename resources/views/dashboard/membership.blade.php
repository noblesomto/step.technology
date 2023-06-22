@include('dashboard.layouts.header')
@include('dashboard.layouts.nav')

<script src="{{ asset('backend/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('backend/js/jquery.min.js') }}"></script>
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<main id="main" class="main">

    <div class="pagetitle">
    <h1>Membership Payment</h1>
  
    </div><!-- End Page Title -->
    
    <section class="section">
    <div class="row">
    <div class="col-lg-12">
    
        <div class="card">
        <div class="card-body">
            <h5 class="card-title">Make Payment and Upload Proof of Payment</h5>
            @if(session('status'))
                <div class="alert alert-{{session('status')['type']}}">
                    {{session('status')['text']}}
                </div>
            @endif
            <!-- General Form Elements -->
            <form action="/user/membership" method="POST" role="form" class="" enctype="multipart/form-data">
             @csrf

             <div class="row mb-3">
                <div class="col-lg-12">
                    @if($user->user_type=="Young Professional" || $user->user_type=="Corporate Professional")
                    <h4>Amount: N10,000</h4>
                    @elseif($user->user_type=="Undergradute")
                    <h4>Amount: N2,500</h4>
                    @elseif($user->user_type=="Corporate Organisation")
                    <h4>Amount: N25,000</h4>
                    @endif
                    <h6>Account Name: Society for Technology & Energy Professionals</h6>
                    <h6>Account Number: 1017242328</h6>
                    <h6>Bank: Zenith</h6>
                </div>
             </div>
             <hr>


            <div class="row mb-3">
                <label for="inputText" class="col-sm-3 col-form-label">Upload Payment Proof </label>
                <div class="col-sm-9">
                    @if ($errors->has('payment_picture'))
                        <span class="text-danger">{{ $errors->first('payment_picture') }}</span>
                    @endif
                <input type="file" name="payment_picture" class="form-control" placeholder="" value="" >
                </div>
            </div>  
            

            
            
    
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label"></label>
                <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Upload Proof</button>
                </div>
            </div>
    
            </form><!-- End General Form Elements -->
            <hr>
            <div class="row mb-3">
               
                <div class="col-sm-9">
                    <div class="card-body">
                  <h5 class="card-title">Payment Proof </h5>

                 
                  <div class="d-flex align-items-center">
                   
                    <div class="ps-3">
                      @if(empty($proof->payment_amount))
                         <tr>
                           <td>Nothing yet...</td>
                         </tr>
                        @else
                         <tr>
                           <td><img width="80%" src="{{ asset('uploads/payment/'.$proof->payment_picture) }}"></td>
                         </tr>
                        @endif
                
                    </div>
                  </div>
                 

                </div>
                </div>
            </div> 
    
        </div>
        </div>
    
    </div>
    
    </div>
    </section>
    
    </main><!-- End #main -->

    @include('dashboard.layouts.footer')