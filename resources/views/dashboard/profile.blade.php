@include('dashboard.layouts.header')
@include('dashboard.layouts.nav')

<script src="{{ asset('backend/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('backend/js/jquery.min.js') }}"></script>
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<main id="main" class="main">

    <div class="pagetitle">
    <h1>USER PROFILE</h1>
  
    </div><!-- End Page Title -->
    
    <section class="section">
    <div class="row">
    <div class="col-lg-12">
    
        <div class="card">
        <div class="card-body">
            <h5 class="card-title">Edit Profile</h5>
            @if(session('status'))
                <div class="alert alert-{{session('status')['type']}}">
                    {{session('status')['text']}}
                </div>
            @endif
            <!-- General Form Elements -->
            <form action="/user/profile" method="POST" role="form" class="" enctype="multipart/form-data">
             @csrf

             @if($user->user_type=="Young Professional" || $user->user_type=="Corporate Professional")
            <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Title</label>
                <div class="col-sm-10">
                    @if ($errors->has('first_name'))
                        <span class="text-danger">{{ $errors->first('first_name') }}</span>
                    @endif
                <select class="form-control" name="title">
                    <option value="">Select Title</option>
                    <option value="Mr" {{ ($user->title =='Mr') ? "selected" : ""; }}>Mr</option>
                    <option value="Miss" {{ ($user->title =='Miss') ? "selected" : ""; }}>Miss</option>
                    <option value="Mrs" {{ ($user->title =='Mrs') ? "selected" : ""; }}>Mrs</option>
                    <option value="Engr" {{ ($user->title =='Engr') ? "selected" : ""; }}>Engr</option>
                    <option value="Dr" {{ ($user->title =='Dr') ? "selected" : ""; }}>Dr</option>
                    <option value="Prof" {{ ($user->title =='Prof') ? "selected" : ""; }}>Prof</option>
                </select>
                </div>
            </div>
    
            <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">First Name</label>
                <div class="col-sm-10">
                    @if ($errors->has('first_name'))
                        <span class="text-danger">{{ $errors->first('first_name') }}</span>
                    @endif
                <input type="text" name="first_name" class="form-control" placeholder="First Name" value="{{ $user->first_name }}" required>
                </div>
            </div>

            <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Last Name</label>
                <div class="col-sm-10">
                    @if ($errors->has('last_name'))
                        <span class="text-danger">{{ $errors->first('last_name') }}</span>
                    @endif
                <input type="text" name="last_name" class="form-control" placeholder="Last Name" value="{{ $user->last_name }}" required>
                </div>
            </div>


            <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Phone </label>
                <div class="col-sm-10">
                    @if ($errors->has('phone'))
                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                    @endif
                <input type="text" name="phone" class="form-control" placeholder="Phone" value="{{ $user->phone }}"  required>
                </div>
            </div>

            <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Profession</label>
                <div class="col-sm-10">
                    @if ($errors->has('profession'))
                        <span class="text-danger">{{ $errors->first('profession') }}</span>
                    @endif
                <input type="text" name="profession" class="form-control" placeholder="Profession" value="{{ $user->profession }}" required>
                </div>
            </div>

            <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                <input type="text" name="email" class="form-control" placeholder="Email" value="{{ $user->email }}" readonly >
                </div>
            </div>

            <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Address </label>
                <div class="col-sm-10">
                    @if ($errors->has('address'))
                        <span class="text-danger">{{ $errors->first('address') }}</span>
                    @endif
                <input type="text" name="address" class="form-control" placeholder="Address" value="{{ $user->address }}" >
                </div>
            </div> 


            <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">City </label>
                <div class="col-sm-10">
                    @if ($errors->has('city'))
                        <span class="text-danger">{{ $errors->first('city') }}</span>
                    @endif
                <input type="text" name="city" class="form-control" placeholder="City" value="{{ $user->city }}" >
                </div>
            </div>  


            <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">State </label>
                <div class="col-sm-10">
                    @if ($errors->has('state'))
                        <span class="text-danger">{{ $errors->first('state') }}</span>
                    @endif
                <input type="text" name="state" class="form-control" placeholder="State" value="{{ $user->state }}" >
                </div>
            </div>  
            <hr>

            <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Company Name </label>
                <div class="col-sm-10">
                    @if ($errors->has('company_name'))
                        <span class="text-danger">{{ $errors->first('company_name') }}</span>
                    @endif
                <input type="text" name="company_name" class="form-control" placeholder="Company Name" value="{{ $user->company_name }}" >
                </div>
            </div>

            <hr>      

            <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Referee Name </label>
                <div class="col-sm-10">
                    @if ($errors->has('referee_name'))
                        <span class="text-danger">{{ $errors->first('referee_name') }}</span>
                    @endif
                <input type="text" name="referee_name" class="form-control" placeholder="Full Name" value="{{ $user->referee_name }}" required>
                </div>
            </div>

            <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Referee Email </label>
                <div class="col-sm-10">
                    @if ($errors->has('referee_email'))
                        <span class="text-danger">{{ $errors->first('referee_email') }}</span>
                    @endif
                <input type="email" name="referee_email" class="form-control" placeholder="Referee Email" value="{{ $user->referee_email }}" required>
                </div>
            </div>

            <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Referee Phone </label>
                <div class="col-sm-10">
                    @if ($errors->has('referee_phone'))
                        <span class="text-danger">{{ $errors->first('referee_phone') }}</span>
                    @endif
                <input type="text" name="referee_phone" class="form-control" placeholder="Referee Phone" value="{{ $user->referee_phone }}" required>
                </div>
            </div>

            <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Referee Address </label>
                <div class="col-sm-10">
                    @if ($errors->has('referee_address'))
                        <span class="text-danger">{{ $errors->first('referee_address') }}</span>
                    @endif
                <input type="text" name="referee_address" class="form-control" placeholder="Referee Address" value="{{ $user->referee_address }}" required>
                </div>
            </div>
            <hr>  


            @elseif($user->user_type=="Undergraduate")

            <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Title</label>
                <div class="col-sm-10">
                    @if ($errors->has('title'))
                        <span class="text-danger">{{ $errors->first('title') }}</span>
                    @endif
                <select class="form-control" name="title">
                    <option value="">Select Title</option>
                    <option value="Mr" {{ ($user->title =='Mr') ? "selected" : ""; }}>Mr</option>
                    <option value="Miss" {{ ($user->title =='Miss') ? "selected" : ""; }}>Miss</option>
                    <option value="Mrs" {{ ($user->title =='Mrs') ? "selected" : ""; }}>Mrs</option>

                </select>
                </div>
            </div>
    
            <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">First Name</label>
                <div class="col-sm-10">
                    @if ($errors->has('first_name'))
                        <span class="text-danger">{{ $errors->first('first_name') }}</span>
                    @endif
                <input type="text" name="first_name" class="form-control" placeholder="First Name" value="{{ $user->first_name }}" required>
                </div>
            </div>

            <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Last Name</label>
                <div class="col-sm-10">
                    @if ($errors->has('last_name'))
                        <span class="text-danger">{{ $errors->first('last_name') }}</span>
                    @endif
                <input type="text" name="last_name" class="form-control" placeholder="Last Name" value="{{ $user->last_name }}" required>
                </div>
            </div>


            <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Phone </label>
                <div class="col-sm-10">
                    @if ($errors->has('phone'))
                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                    @endif
                <input type="text" name="phone" class="form-control" placeholder="Phone" value="{{ $user->phone }}"  required>
                </div>
            </div>


            <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                <input type="text" name="email" class="form-control" placeholder="Email" value="{{ $user->email }}" readonly >
                </div>
            </div>

            <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Address </label>
                <div class="col-sm-10">
                    @if ($errors->has('address'))
                        <span class="text-danger">{{ $errors->first('address') }}</span>
                    @endif
                <input type="text" name="address" class="form-control" placeholder="Address" value="{{ $user->address }}" >
                </div>
            </div> 


            <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">City </label>
                <div class="col-sm-10">
                    @if ($errors->has('city'))
                        <span class="text-danger">{{ $errors->first('city') }}</span>
                    @endif
                <input type="text" name="city" class="form-control" placeholder="City" value="{{ $user->city }}" >
                </div>
            </div>  


            <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">State </label>
                <div class="col-sm-10">
                    @if ($errors->has('state'))
                        <span class="text-danger">{{ $errors->first('state') }}</span>
                    @endif
                <input type="text" name="state" class="form-control" placeholder="State" value="{{ $user->state }}" >
                </div>
            </div>  
            <hr>


            <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">School Name </label>
                <div class="col-sm-10">
                    @if ($errors->has('school_name'))
                        <span class="text-danger">{{ $errors->first('school_name') }}</span>
                    @endif
                <input type="text" name="school_name" class="form-control" placeholder="School Name" value="{{ $user->school_name }}" >
                </div>
            </div>

            <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Faculty </label>
                <div class="col-sm-10">
                    @if ($errors->has('school_faculty'))
                        <span class="text-danger">{{ $errors->first('school_faculty') }}</span>
                    @endif
                <input type="text" name="school_faculty" class="form-control" placeholder="Faculty" value="{{ $user->school_faculty }}" >
                </div>
            </div>

            <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Department</label>
                <div class="col-sm-10">
                    @if ($errors->has('school_dept'))
                        <span class="text-danger">{{ $errors->first('school_dept') }}</span>
                    @endif
                <input type="text" name="school_dept" class="form-control" placeholder="Department" value="{{ $user->school_dept }}" >
                </div>
            </div>
            <hr>  
            @elseif($user->user_type=="Corporate Organisation")
            <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Company Name </label>
                <div class="col-sm-10">
                    @if ($errors->has('company_name'))
                        <span class="text-danger">{{ $errors->first('company_name') }}</span>
                    @endif
                <input type="text" name="company_name" class="form-control" placeholder="Company Name" value="{{ $user->company_name }}" >
                </div>
            </div>

            <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Phone </label>
                <div class="col-sm-10">
                    @if ($errors->has('phone'))
                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                    @endif
                <input type="text" name="phone" class="form-control" placeholder="Phone" value="{{ $user->phone }}"  required>
                </div>
            </div>


            <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                <input type="text" name="email" class="form-control" placeholder="Email" value="{{ $user->email }}" readonly >
                </div>
            </div>

            <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Address </label>
                <div class="col-sm-10">
                    @if ($errors->has('address'))
                        <span class="text-danger">{{ $errors->first('address') }}</span>
                    @endif
                <input type="text" name="address" class="form-control" placeholder="Address" value="{{ $user->address }}" >
                </div>
            </div> 


            <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">City </label>
                <div class="col-sm-10">
                    @if ($errors->has('city'))
                        <span class="text-danger">{{ $errors->first('city') }}</span>
                    @endif
                <input type="text" name="city" class="form-control" placeholder="City" value="{{ $user->city }}" >
                </div>
            </div>  


            <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">State </label>
                <div class="col-sm-10">
                    @if ($errors->has('state'))
                        <span class="text-danger">{{ $errors->first('state') }}</span>
                    @endif
                <input type="text" name="state" class="form-control" placeholder="State" value="{{ $user->state }}" >
                </div>
            </div>  

            @endif
     
            
    
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label"></label>
                <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Update Profile</button>
                </div>
            </div>
    
            </form><!-- End General Form Elements -->
    
        </div>
        </div>
    
    </div>
    
    </div>
    </section>
    
    </main><!-- End #main -->

    @include('dashboard.layouts.footer')