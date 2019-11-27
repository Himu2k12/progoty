@extends('front.master')

@section('title')
     Add Member
@endsection


@section('content')

    <div class="welcome-wrap">
        <div class="container">
            <div class="row">

                <div class=" col-sm-12">
                    {{ Session::get('mass') }}

                    <div class="alert alert-success"><h4 style="text-align: center">Application Form (সদস্য ভর্তির ফর্ম)</h4></div>
                    <div class="" style="border: 1px solid #CDCCCC; padding: 30px">
                        <div class="alert alert-primary" style="padding: 10px"><p style="text-align: center; color: black;font-size: 12px">All information should be filled up in English (সকল তথ্য অবশ্যই ইংরেজীতে পূরন করতে হবে)</div>
                        <div class="alert alert-danger" style="padding: 10px; text-align: center"><p style="color: black;font-size: 13px">Fields marked with <span style="color: red">*</span> are mandatory. (লাল <span style="color: red">*</span> তারকা চিহ্নিত ঘরের তথ্যগুলো পূরন করা আবশ্যক)<br>Fields marked with  <span style="color: green">*</span> are required any of them.  (সবুজ <span style="color: green">*</span> তারকা চিহ্নিত ঘরের তথ্যগুলো যে কোন একটি পূরণ করা আবশ্যক, আপনি চাইলে উভয় ঘরের তথ্য দিতে পারেন)</p></div>
                       <form enctype="multipart/form-data" name="newMember" action="{{url('/add-member')}}" method="post">
                        {{csrf_field()}}
                           <div class="row">
                            <div class="col-sm-6" style=" margin-bottom: 20px">
                                <label class="required">Applicant's Full Name<span style="color: red">*</span> (আবেদনকারীর পূর্ণ নাম)</label>
                                <input type="text" onkeyup="validate()" class="form-control" id="applicant_name" name="applicant_name" value="{{old('applicant_name')}}" required minlength="4">
                                <span  id="error_applicant_name" style="color: red;">{{ $errors->has('applicant_name') ? $errors->first('applicant_name') : ' ' }}</span>

                            </div>
                            <div class="col-sm-6" style=" margin-bottom: 20px">
                                <label class="required">Father's Name<span style="color: red">*</span> (পিতার নাম)</label>
                                <input type="text" onkeyup="validate2()" id="applicants_father_name" class="form-control" name="applicants_father_name" value="{{old('applicants_father_name')}}" required minlength="4">
                                <span  id="error_applicant_father_name" style="color: red;">{{ $errors->has('applicants_father_name') ? $errors->first('applicants_father_name') : ' ' }}</span>
                            </div>
                            <div class="col-sm-6" style=" margin-bottom: 20px">
                                <label class="required">National ID<span style="color: green">*</span> (জাতীয় পরিচয়পত্র)</label>
                                <input type="text"  onkeyup="validate3()" id="national_id" class="form-control" name="national_id" value="{{old('national_id')}}" pattern="\d*[1-9]{1}[0-9]{9,19}" required>
                                <span  id="error_national_id" style="color: red;">{{ $errors->has('national_id') ? $errors->first('national_id') : ' ' }}</span>
                            </div>
                           <div class="col-sm-6" style=" margin-bottom: 20px">
                                <label class="required">Gender <span style="color: red">*</span>(লিঙ্গ)</label>
                               <select class="form-control" name="gender" style="height:34px;">
                                   <option value="">Select one</option>
                                   <option value="Male">Male</option>
                                   <option value="Female">Female</option>
                                   <option value="Other">Other</option>
                               </select>
                               <span  id="error_gender" style="color: red;">{{ $errors->has('gender') ? $errors->first('gender') : ' ' }}</span>
                           </div>
                           <div class="col-sm-6" style=" margin-bottom: 20px">
                                <label class="required">Nationality<span style="color: red">*</span> (জাতীয়তা)</label>
                               <input type="text" disabled class="form-control" value="Bangladeshi">
                               <span  id="error_nationality" style="color: red;">{{ $errors->has('nationality') ? $errors->first('nationality') : ' ' }}</span>
                           </div>
                           <div class="col-sm-6 " style=" margin-bottom: 20px">
                                <label class="required">Marital Status<span style="color: red">*</span> (বৈবাহিক অবস্থা)</label>
                               <select class="form-control" onchange="validate4()" id="marital_status" name="marital_status" style="height:34px;">
                                   <option value="">select one</option>
                                   <option value="Married">Married</option>
                                   <option value="Unmarried">Unmarried</option>
                                   <option value="divorced">Divorced</option>
                                   <option value="widow">Widow</option>
                               </select>
                               <span  id="error_marital_status" style="color: red;">{{ $errors->has('marital_status') ? $errors->first('marital_status') : ' ' }}</span>
                           </div>
                           <div class="col-sm-6" style=" margin-bottom: 20px">
                               <label class="required">Religion (ধর্ম)<span style="color: red">*</span></label>
                               <select class="form-control" name="religion" style="height:34px;">
                                   <option value="">select one</option>
                                   <option value="Islam">Islam</option>
                                   <option value="Hindu">Hinduisam</option>
                                   <option value="Buddhist">Buddhist</option>
                                   <option value="Cristian">Cristian</option>
                                   <option value="Other">Other</option>
                               </select>
                               <span  id="error_religion" style="color: red;">{{ $errors->has('religion') ? $errors->first('religion') : ' ' }}</span>
                           </div>
                               <div class="col-sm-6" style=" margin-bottom: 20px">
                                   <label class="required">Spouse's Name (স্বামী/স্ত্রীর নাম)</label>
                                   <input type="text" class="form-control" id="husband_name" value="{{old('husband_name')}}" name="husband_name">
                                   <span  id="error_husband_name" style="color: red;">{{ $errors->has('husband_name') ? $errors->first('husband_name') : ' ' }}</span>
                               </div>
                           <div class="col-sm-12" style="margin-bottom: 20px">
                               <fieldset class="field_border" >
                                   <legend class="legend_border">Account information (হিসাবের তথ্য)</legend>
                                   <div class="col-sm-6" style=" margin-bottom: 20px">
                                       <label class="required">Yearly Scheme<span style="color: red">*</span> (বার্ষিক প্রকল্প)</label>
                                       <select class="form-control" name="yearly_scheme" style="height:34px;">
                                           <option value="">select one</option>
                                           <option value="2">2 year</option>
                                           <option value="3">3 year</option>
                                           <option value="4">4 year</option>
                                           <option value="5">5 year</option>
                                           <option>Other</option>
                                       </select>
                                       <span  id="error_yearly_scheme" style="color: red;">{{ $errors->has('yearly_scheme') ? $errors->first('yearly_scheme') : ' ' }}</span>
                                   </div>
                                   <div class="col-sm-6" style=" margin-bottom: 20px">
                                       <label class="required">Deposite Type<span style="color: red">*</span> (আমানত ধরণ)</label>
                                       <select class="form-control" name="deposite_type" style="height:34px;">
                                           <option value="">select one</option>
                                           <option value="Daily">Daily(দৈনিক)</option>
                                           <option value="Weekly">Weekly(সাপ্তাহিক)</option>
                                           <option value="Monthly">monthly(মাসিক)</option>
                                       </select>
                                       <span  id="error_deposite_type" style="color: red;">{{ $errors->has('deposite_type') ? $errors->first('deposite_type') : ' ' }}</span>

                                   </div>
                                   <div class="col-sm-6" style=" margin-bottom: 20px">
                                       <label class="required">Amount of Money<span style="color: red">*</span> (টাকার পরিমাণ)</label>
                                       <input type="number" class="form-control" name="amount_of_money" value="{{old('amount_of_money')}}" step="1">
                                       <span  id="error_amount_of_money" style="color: red;">{{ $errors->has('amount_of_money') ? $errors->first('amount_of_money') : ' ' }}</span>

                                   </div>
                                   <div class="col-sm-6" style=" margin-bottom: 20px">
                                       <label class="required">Form Fee<span style="color: red">*</span> (আবেদন খরচ)</label>
                                       <input type="number" class="form-control" name="form_fee" value="{{old('form_fee')}}">
                                       <span  id="error_form_fee" style="color: red;">{{ $errors->has('form_fee') ? $errors->first('form_fee') : ' ' }}</span>

                                   </div>
                               </fieldset>
                           </div>
                           <div class="col-sm-12" style="margin-bottom: 20px">
                               <fieldset class="field_border">
                                   <legend class="legend_border">Present Address (বর্তমান ঠিকানা)</legend>
                                   <div class="col-sm-6" style=" margin-bottom: 20px">
                                       <label class="required">District<span style="color: red">*</span> (জেলা)</label>
                                       <input class="form-control" id="present_dist" name="present_dist" value="{{old('present_dist')}}" style="height:34px;"/>

                                       <span  id="error_present_dist" style="color: red;">{{ $errors->has('present_dist') ? $errors->first('present_dist') : ' ' }}</span>

                                   </div>
                                   <div class="col-sm-6" style=" margin-bottom: 20px">
                                       <label class="required">Thana/Upazila<span style="color: red">*</span> (থানা/উপজেলা)</label>
                                       <input class="form-control" id="present_upazila" name="present_upa" value="{{old('present_upa')}}" style="height:34px;"/>
                                       <span  id="error_present_upa" style="color: red;">{{ $errors->has('present_upa') ? $errors->first('present_upa') : ' ' }}</span>

                                   </div>
                                   <div class="col-sm-6" style=" margin-bottom: 20px">
                                       <label class="required">Post Code <span style="color: red">*</span>(পোস্ট কোড)</label>
                                       <input type="number" id="present_post_code" class="form-control" name="present_post_code" value="{{old('present_post_code')}}">
                                       <span  id="error_present_post_code" style="color: red;">{{ $errors->has('present_post_code') ? $errors->first('present_post_code') : ' ' }}</span>

                                   </div>
                                   <div class="col-sm-6" style=" margin-bottom: 20px">
                                       <label class="required">Village/Road No/House No/Address<span style="color: red">*</span> (গ্রাম/রোড নং/বাড়ি নং/ঠিকানা)</label>
                                       <input type="text" id="present_village" class="form-control" name="present_village" value="{{old('present_village')}}">
                                       <span  id="error_present_village" style="color: red;">{{ $errors->has('present_village') ? $errors->first('present_village') : ' ' }}</span>

                                   </div>
                               </fieldset>
                           </div>
                           <div class="col-sm-12" style="margin-bottom: 20px">
                               <fieldset class="field_border">
                                   <legend class="legend_border">Permanent Address (স্থায়ী ঠিকানা)</legend>
                                   {{--<div class="col-sm-12" style=" margin-bottom: 20px">--}}
                                       {{--<input type="checkbox" value="1" name="check" id="check_address" onchange="myFunction()"> Same as Present Address (বর্তমান ঠিকানা ও স্থায়ী ঠিকানা একই হলে)--}}
                                   {{--</div>--}}

                                   <div class="col-sm-6" style=" margin-bottom: 20px">
                                       <label class="required">District<span style="color: red">*</span> (জেলা)</label>
                                       <select class="form-control" id="permanent_dist" name="permanent_dist" style="height:34px;">
                                           <option value="">select one</option>
                                           <option value="1">Kurigram</option>
                                           <option value="2">Lalmonirhat</option>
                                       </select>
                                       <span  id="error_permanent_dist" style="color: red;">{{ $errors->has('permanent_dist') ? $errors->first('permanent_dist') : ' ' }}</span>

                                   </div>
                                   <div class="col-sm-6" style=" margin-bottom: 20px">
                                       <label class="required">Thana/Upazila<span style="color: red">*</span> (থানা/উপজেলা)</label>
                                       <select class="form-control" id="permanent_upa" name="permanent_upa" style="height:34px;">
                                       </select>
                                       <span  id="error_permanent_upa" style="color: red;">{{ $errors->has('permanent_upa') ? $errors->first('permanent_upa') : ' ' }}</span>

                                   </div>
                                   <div class="col-sm-6" style=" margin-bottom: 20px">
                                       <label class="required">Post Code<span style="color: red">*</span> (পোস্ট কোড)</label>
                                       <input type="number" id="permanent_post_code" class="form-control" name="permanent_post_code" value="{{old('permanent_post_code')}}">
                                       <span  id="error_permanent_post_code" style="color: red;">{{ $errors->has('permanent_post_code') ? $errors->first('permanent_post_code') : ' ' }}</span>

                                   </div>
                                   <div class="col-sm-6" style=" margin-bottom: 20px">
                                       <label class="required">Village/Road No/House No/Address<span style="color: red">*</span> (গ্রাম/রোড নং/বাড়ি নং/ঠিকানা)</label>
                                       <input type="text" id="permanent_village" class="form-control" name="permanent_village" value="{{old('permanent_village')}}">
                                       <span  id="error_permanent_village" style="color: red;">{{ $errors->has('permanent_village') ? $errors->first('permanent_village') : ' ' }}</span>

                                   </div>
                               </fieldset>
                           </div>
                           <div class="col-sm-12" style="margin-bottom: 20px">
                               <fieldset class="field_border">
                                    <legend class="legend_border">Nominee Info (মনোনীত ব্যক্তির তথ্য)</legend>
                                    <div class="col-sm-6" style=" margin-bottom: 20px">
                                        <label class="required">Nominee Name<span style="color: red">*</span> (মনোনীত ব্যক্তির নাম)</label>
                                        <input type="text" class="form-control" name="nominee_name" value="{{old('nominee_name')}}">
                                        <span  id="error_nominee_name" style="color: red;">{{ $errors->has('nominee_name') ? $errors->first('nominee_name') : ' ' }}</span>

                                    </div>
                                    <div class="col-sm-6" style=" margin-bottom: 20px">
                                        <label class="required">Relation <span style="color: red">*</span>(সম্পর্ক)</label>
                                        <input type="text" class="form-control" name="relation" value="{{old('relation')}}">
                                        <span  id="error_relation" style="color: red;">{{ $errors->has('relation') ? $errors->first('relation') : ' ' }}</span>

                                    </div>
                                    <div class="col-sm-6" style=" margin-bottom: 20px">
                                        <label class="required">District<span style="color: red">*</span> (জেলা)</label>
                                        <select class="form-control" id="nominee_dist" name="nominee_dist" style="height:34px;">
                                            <option value="">select one</option>
                                            <option value="1">Kurigram</option>
                                            <option value="2">Lalmonirhat</option>
                                        </select>
                                        <span  id="error_nominee_dist" style="color: red;">{{ $errors->has('nominee_dist') ? $errors->first('nominee_dist') : ' ' }}</span>
                                    </div>
                                    <div class="col-sm-6" style=" margin-bottom: 20px">
                                        <label class="required">Thana/Upazila<span style="color: red">*</span> (থানা/উপজেলা)</label>
                                        <select class="form-control" name="nominee_upazila" id="nominee_upazila" style="height:34px;">
                                        </select>
                                        <span  id="error_nominee_upazila" style="color: red;">{{ $errors->has('nominee_upazila') ? $errors->first('nominee_upazila') : ' ' }}</span>

                                    </div>
                                    <div class="col-sm-6" style=" margin-bottom: 20px">
                                        <label class="required">Post Code<span style="color: red">*</span> (পোস্ট কোড)</label>
                                        <input type="number" class="form-control" name="nominee_post_code"  value="{{old('nominee_post_code')}}">
                                        <span  id="error_nominee_post_code" style="color: red;">{{ $errors->has('nominee_post_code') ? $errors->first('nominee_post_code') : ' ' }}</span>

                                    </div>
                                    <div class="col-sm-6" style=" margin-bottom: 20px">
                                        <label class="required">Village/Road No/House No/Address <span style="color: red">*</span>(গ্রাম/রোড নং/বাড়ি নং/ঠিকানা)</label>
                                        <input type="text" class="form-control" name="nominee_address"  value="{{old('nominee_address')}}">
                                        <span  id="error_nominee_address" style="color: red;">{{ $errors->has('nominee_address') ? $errors->first('nominee_address') : ' ' }}</span>

                                    </div>
                                   <div class="col-sm-6" style=" margin-bottom: 20px">
                                       <label class="required">Nominee NID<span style="color: green">*</span> (মনোনীত ব্যক্তির জাতীয় পরিচয়পত্র)</label>
                                       <input type='file' name="nomine_nid"  />
                                       <span  id="error_nominee_nid" style="color: red;">{{ $errors->has('nomine_nid') ? $errors->first('nomine_nid') : ' ' }}</span>
                                   </div>
                                </fieldset>
                               <fieldset class="field_border">
                                       <legend class="legend_border">Member Identity (সদস্য পরিচয়)</legend>
                                       <div class="col-sm-6" style=" margin-bottom: 20px">
                                           <label class="required">Photo<span style="color: green">*</span> (ছবি)</label>
                                           <input type='file' name="applicant_photo" onchange="readURL(this);" />
                                           <img id="blah" src="#" alt="your image" />
                                       </div>
                                       <div class="col-sm-6" style=" margin-bottom: 20px">
                                           <label class="required">NID<span style="color: green">*</span> (জাতীয় পরিচয়পত্র)</label>
                                           <input type='file' name="applicant_nid"  />
                                       </div>
                                   <div class="col-sm-6" style=" margin-bottom: 20px">
                                           <label class="required">Signature<span style="color: green">*</span> (স্বাক্ষর)</label>
                                           <input type='file' name="applicant_signature"  />
                                            <img id="signature" src="#" alt="your image" onchange="readURL2(this);"/>
                                   </div>
                               </fieldset>
                           </div>
                           <div class="col-sm-12" style="margin-bottom: 20px">
                                   <div class="col-sm-2 col-sm-offset-3" style=" margin-bottom: 20px">
                                       <input type='button' value="Cancel" class="form-control btn btn-danger" name="" />
                                   </div>
                                   <div class="col-sm-2 col-sm-offset-2" style=" margin-bottom: 20px">
                                       <input type='submit' class="form-control btn btn-success" value="Submit(দাখিল)" name="" />
                                   </div>
                               </div>
                       </div>
                       </form>
                    </div>


                </div>


            </div><!-- .row -->

        </div><!-- .container -->
    </div><!-- .home-page-icon-boxes -->


@endsection
@section('additional_script')
    <script>
        document.forms['newMember'].elements['gender'].value = "{{old('gender')}}";
        document.forms['newMember'].elements['religion'].value = "{{old('religion')}}";
        document.forms['newMember'].elements['yearly_scheme'].value = "{{old('yearly_scheme')}}";
        document.forms['newMember'].elements['deposite_type'].value = "{{old('deposite_type')}}";
        document.forms['newMember'].elements['present_post_code'].value = "{{old('present_post_code')}}";
        document.forms['newMember'].elements['present_village'].value = "{{old('present_village')}}";
        document.forms['newMember'].elements['permanent_post_code'].value = "{{old('permanent_post_code')}}";
        document.forms['newMember'].elements['permanent_village'].value = "{{old('permanent_village')}}";
        document.forms['newMember'].elements['relation'].value = "{{old('relation')}}";
        document.forms['newMember'].elements['nominee_post_code'].value = "{{old('nominee_post_code')}}";
        document.forms['newMember'].elements['nominee_address'].value = "{{old('nominee_address')}}";
    </script>
    @endsection