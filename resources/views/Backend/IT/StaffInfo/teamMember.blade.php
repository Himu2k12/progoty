@extends('Backend.master')

@section('title')
    Booking
@endsection

@section('content')
    <div class="container bootstrap snippet">
        @if($ExistingStaffInfo!==null)
            <form class="form" action="{{url('/update-staff-details')}}" method="post" id="UpdateRegistrationForm" enctype="multipart/form-data">
                @else
                    <form class="form" action="{{url('/save-new-staff-details')}}" method="post" id="registrationForm" enctype="multipart/form-data">
                        @endif
                        @csrf
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="text-center">
                                    <img @if($ExistingStaffInfo!==null) src="{{asset($ExistingStaffInfo->staff_photo)}}" @endif src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="avatar img-circle img-thumbnail" alt="avatar">
                                     <h6>Upload Employee photo...(297*297px)</h6>
                                    <input type="file" accept="image/*" name="staff_photo" id="close" class="text-center center-block file-upload">
                                    <span  id="error_staff_photo" style="color: red;">{{ $errors->has('staff_photo') ? $errors->first('staff_photo') : ' ' }}</span>
                                </div>
                                @if($ExistingStaffInfo==null)
                                    <button  type="button" class="btn-danger"  onclick="remove()" >X</button>
                                @endif
                                <br>

                                <ul class="list-group">
                                    <li class="list-group-item text-muted">Basic Info <i class="fa fa-dashboard fa-1x"></i></li>
                                    <li class="list-group-item text-left"><span class="pull-left"><strong>Full Name:</strong></span> {{$StaffInfo->name}}</li>
                                    <li class="list-group-item text-left"><span class="pull-left"><strong>Email:</strong></span> {{$StaffInfo->email}}</li>
                                    <li class="list-group-item text-left"><span class="pull-left"><strong>Designation:</strong></span> {{$StaffRole->role}}</li>
                                </ul>
                            </div><!--/col-3-->
                            <div class="col-sm-9">
                                <nav class="divstyle border-bottom-success">
                                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Detials Info</a>
                                        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-account" role="tab" aria-controls="nav-profile" aria-selected="false">Account Info</a>
                                    </div>
                                </nav>
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                        <div class="card shadow mb-12">
                                            <div class="card-header py-12">
                                                <div>
                                                    <h6 class="m-0 text-md-center font-weight-bold text-md-center text-primary">Add Basic Info</h6>
                                                   <br> <h6 style="text-align: center" class="text-success">{{ Session::get('message') }}</h6>

                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group row">
                                                    @if($ExistingStaffInfo!==null) <input value="{{$ExistingStaffInfo->id}}" name="id" type="hidden"/> @endif
                                                    <div class="col-md-6">
                                                        <label for="first_name"><h5>First name<span style="color: red">*</span></h5></label>
                                                        <input type="text" maxlength="100" minlength="2" class="form-control" name="first_name" id="first_name" placeholder="first name" @if($ExistingStaffInfo!==null) value="{{$ExistingStaffInfo->first_name}}" @else value="{{old('first_name')}}" @endif>
                                                        <span  id="error_first_name" style="color: red;">{{ $errors->has('first_name') ? $errors->first('first_name') : ' ' }}</span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="last_name"><h5>Last name<span style="color: red">*</span></h5></label>
                                                        <input type="text" maxlength="100" minlength="2" class="form-control" name="last_name" id="last_name" placeholder="Last name"  @if($ExistingStaffInfo!==null) value="{{$ExistingStaffInfo->last_name}}" @else value="{{old('last_name')}}" @endif>
                                                        <span  id="error_last_name" style="color: red;">{{ $errors->has('last_name') ? $errors->first('last_name') : ' ' }}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">

                                                    <div class="col-md-6">
                                                        <label for="fathers_name"><h5>Father's name<span style="color: red">*</span></h5></label>
                                                        <input type="text" maxlength="100" minlength="2" class="form-control" name="fathers_name" id="fathers_name" placeholder="Father's name"  @if($ExistingStaffInfo!==null) value="{{$ExistingStaffInfo->fathers_name}}" @else value="{{old('fathers_name')}}" @endif>
                                                        <span  id="error_fathers_name" style="color: red;">{{ $errors->has('fathers_name') ? $errors->first('fathers_name') : ' ' }}</span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="mothers_name"><h5>Mother's name<span style="color: red">*</span></h5></label>
                                                        <input type="text" maxlength="100" minlength="2" class="form-control" name="mothers_name" id="mothers_name" placeholder="Mother's name"  @if($ExistingStaffInfo!==null) value="{{$ExistingStaffInfo->mothers_name}}" @else value="{{old('mothers_name')}}" @endif>
                                                        <span  id="error_mothers_name" style="color: red;">{{ $errors->has('mothers_name') ? $errors->first('mothers_name') : ' ' }}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">

                                                    <div class="col-md-6">
                                                        <label for="present_address"><h5>Present Address<span style="color: red">*</span></h5></label>
                                                        <textarea type="text" maxlength="250" minlength="2" class="form-control" name="present_address" id="present_address" > @if($ExistingStaffInfo!==null) {{$ExistingStaffInfo->present_address}} @else {{old('present_address')}} @endif</textarea>
                                                        <span  id="error_present_address" style="color: red;">{{ $errors->has('present_address') ? $errors->first('present_address') : ' ' }}</span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="permanent_address"><h5>Permanent Address<span style="color: red">*</span></h5></label>
                                                        <textarea type="text" maxlength="250" minlength="2" class="form-control" name="permanent_address" id="permanent_address"> @if($ExistingStaffInfo!==null) {{$ExistingStaffInfo->permanent_address}} @else {{old('permanent_address')}} @endif</textarea>
                                                        <span  id="error_permanent_address" style="color: red;">{{ $errors->has('permanent_address') ? $errors->first('permanent_address') : ' ' }}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">

                                                    <div class="col-md-6">
                                                        <label for="date_of_birth"><h5>Date of Birth<span style="color: red">*</span></h5></label>
                                                        <input type="date"  class="form-control" name="date_of_birth"  @if($ExistingStaffInfo!==null) value="{{$ExistingStaffInfo->date_of_birth}}" @else value="{{old('date_of_birth')}}" @endif>
                                                        <span  id="error_date_of_birth" style="color: red;">{{ $errors->has('date_of_birth') ? $errors->first('date_of_birth') : ' ' }}</span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="joining_date"><h5>Joining Date<span style="color: red">*</span></h5></label>
                                                        <input type="date"  class="form-control" name="joining_date" id="joining_date" @if($ExistingStaffInfo!==null) value="{{$ExistingStaffInfo->joining_date}}" @else value="{{old('joining_date')}}"  @endif>
                                                        <span  id="" style="color: red;">{{ $errors->has('joining_date') ? $errors->first('joining_date') : ' ' }}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">

                                                    <div class="col-md-6">
                                                        <label for="designation"><h5>Designation<span style="color: red">*</span></h5></label>
                                                        <input type="text" readonly maxlength="100" minlength="2" class="form-control" name="designation" id="designation" placeholder="Designation" @if($ExistingStaffInfo!==null) value="{{$ExistingStaffInfo->designation}}" @else value="{{$StaffRole->role}}" @endif>
                                                        <span  id="" style="color: red;">{{ $errors->has('designation') ? $errors->first('designation') : ' ' }}</span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="blood_group"><h5>Blood Group<span style="color: red">*</span></h5></label>
                                                        <input type="text" maxlength="50" minlength="1" class="form-control" name="blood_group" id="blood_group" placeholder="Blood Group" @if($ExistingStaffInfo!==null) value="{{$ExistingStaffInfo->blood_group}}" @else value="{{old('blood_group')}}" @endif>
                                                        <span  id="" style="color: red;">{{ $errors->has('blood_group') ? $errors->first('blood_group') : ' ' }}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">

                                                    <div class="col-md-6">
                                                        <label for="cv_doc"><h5>CV Upload</h5></label>
                                                        <input type="file"  name="cv_doc" id="cv_doc" value="{{old('cv_doc')}}">

                                                        @if(isset($ExistingStaffInfo)&& $ExistingStaffInfo->cv_doc!=null)
                                                            <embed src="{{asset('/Staff_photos/'.$ExistingStaffInfo->cv_doc)}}" type="application/pdf"   height="300px" width="100%">
                                                        @endif

                                                        <span  id="" style="color: red;">{{ $errors->has('cv_doc') ? $errors->first('cv_doc') : ' ' }}</span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="description"><h5>Description</h5></label>
                                                        <textarea type="text" maxlength="250" minlength="2" class="form-control" name="description" id="description">@if($ExistingStaffInfo!==null) {{$ExistingStaffInfo->description}} @else {{old('description')}} @endif</textarea>
                                                        <span  id="" style="color: red;">{{ $errors->has('description') ? $errors->first('description') : ' ' }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="nav-account" role="tabpanel" aria-labelledby="nav-profile-tab">
                                        <div class="card shadow mb-12">
                                            <div class="card-header py-12">
                                                <div>
                                                    <h6 class="m-0 text-md-center font-weight-bold text-md-center text-primary">Add Account Info</h6>
                                                </div>
                                            </div>
                                            <div class="card-body row table-responsive">
                                                <div class="form-group row">
                                                    <div class="col-md-6">
                                                        <label for="bank_account_no"><h5>Bank Account No</h5></label>
                                                        <input type="text" maxlength="50" minlength="4" class="form-control" name="bank_account_no" id="bank_account_no" placeholder="Bank Account No" @if($ExistingStaffInfo!==null) value="{{$ExistingStaffInfo->bank_account_no}}" @else value="{{old('bank_account_no')}}" @endif>
                                                        <input type="hidden" name="user_id" value="{{$StaffInfo->id}}">
                                                        <span  id="" style="color: red;">{{ $errors->has('bank_account_no') ? $errors->first('bank_account_no') : ' ' }}</span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="bank_name"><h5>Bank Name</h5></label>
                                                        <input type="text" maxlength="100" minlength="2" class="form-control" name="bank_name" id="bank_name" placeholder="Bank Name" @if($ExistingStaffInfo!==null) value="{{$ExistingStaffInfo->bank_name}}" @else value="{{old('bank_name')}}" @endif>
                                                        <span  id="" style="color: red;">{{ $errors->has('bank_name') ? $errors->first('bank_name') : ' ' }}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-6">
                                                        <label for="branch_name"><h5>Branch Name</h5></label>
                                                        <input type="text" maxlength="100" minlength="2" class="form-control" name="branch_name" id="branch_name" placeholder="Branch Name" @if($ExistingStaffInfo!==null) value="{{$ExistingStaffInfo->branch_name}}" @else value="{{old('branch_name')}}" @endif>
                                                        <span  id="" style="color: red;">{{ $errors->has('branch_name') ? $errors->first('branch_name') : ' ' }}</span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="account_holder_name"><h5>Account Holder Name</h5></label>
                                                        <input type="text" maxlength="200" minlength="2" class="form-control" name="account_holder_name" id="account_holder_name" placeholder="Account Holder name" @if($ExistingStaffInfo!==null) value="{{$ExistingStaffInfo->account_holder_name}}" @else  value="{{old('account_holder_name')}}" @endif>
                                                        <span  id="" style="color: red;">{{ $errors->has('account_holder_name') ? $errors->first('account_holder_name') : ' ' }}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-6">
                                                        <label for="salary_amount"><h5>Salary Amount<span style="color: red">*</span></h5></label>
                                                        <input type="number" class="form-control" name="salary_amount" id="salary_amount" min="0" placeholder="Salary Amount" @if($ExistingStaffInfo!==null) value="{{$ExistingStaffInfo->salary_amount}}" @else value="{{old('salary_amount')}}" @endif>
                                                        <span  id="" style="color: red;">{{ $errors->has('salary_amount') ? $errors->first('salary_amount') : ' ' }}</span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="salary_amount"><h5>Mobile Number<span style="color: red">*</span></h5></label>
                                                        <input type="text" class="form-control" name="mobile_number" id="mobile_number" min="0" placeholder="Mobile Number" @if($ExistingStaffInfo!==null) value="{{$ExistingStaffInfo->mobile_number}}" @else value="{{old('mobile_number')}}" @endif>
                                                        <span  style="color: red;">{{ $errors->has('mobile_number') ? $errors->first('mobile_number') : ' ' }}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-6">
                                                        @if($ExistingStaffInfo!==null)
                                                            <input type="submit" class="btn btn-success" value="Update">
                                                        @else
                                                            <input type="submit" class="btn btn-success" value="Save">
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!--/tab-content-->

                        </div><!--/col-9-->
                    </form>
    </div><!--/row-->
    <script>



        $(document).ready(function() {


            var readURL = function(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('.avatar').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }


            $(".file-upload").on('change', function(){
                readURL(this);
            });
        });

        function remove(){
            document.getElementById('close').value = '';
            $('.avatar').attr('src', 'http://ssl.gstatic.com/accounts/ui/avatar_2x.png');
        }
    </script>
@endsection
