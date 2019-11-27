@extends('front.master')

@section('title')
    New Loan
@endsection


@section('content')

    <div class="welcome-wrap">
        <div class="container">
            <div class="row">

                <div class=" col-sm-12">

                    <div class="alert alert-success"><h4 style="text-align: center">Loan Application Form (ঋণ আবেদন ফর্ম)</h4></div>
                    <div class="" style="border: 1px solid #CDCCCC; padding: 30px">
                        <div class="alert alert-primary" style="padding: 10px"><p style="text-align: center; color: black;font-size: 12px">All information should be filled up in English (সকল তথ্য অবশ্যই ইংরেজীতে পূরন করতে হবে)</div>
                        <div class="alert alert-danger" style="padding: 10px; text-align: center"><p style="color: black;font-size: 13px">Fields marked with <span style="color: red">*</span> are mandatory. (লাল <span style="color: red">*</span> তারকা চিহ্নিত ঘরের তথ্যগুলো পূরন করা আবশ্যক)<br>Fields marked with  <span style="color: green">*</span> are required any of them.  (সবুজ <span style="color: green">*</span> তারকা চিহ্নিত ঘরের তথ্যগুলো যে কোন একটি পূরণ করা আবশ্যক, আপনি চাইলে উভয় ঘরের তথ্য দিতে পারেন)</p></div>
                       @if((Session::get('mass')!==null))
                        <div class="alert alert-success" style="padding: 10px; text-align: center">{{Session::get('mass')}}</div>
                        @endif
                            <form enctype="multipart/form-data" name="newMember" action="{{url('/create-loan')}}" method="post">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col-sm-12" style="margin-bottom: 20px">
                                    <fieldset class="field_border" >
                                        <legend class="legend_border">Account information (হিসাবের তথ্য)</legend>
                                        <div class="col-sm-6" style=" margin-bottom: 20px">
                                            <label class="required">Account No<span style="color: red">*</span> ( হিসাব নং)</label>
                                            <select class="form-control" name="account_no" style="height:34px;">
                                                <option value="">select one</option>
                                                @foreach($accountNumber as $item)
                                                <option value="{{$item->id}}">{{$item->applicant_name}}({{$item->id}})</option>
                                                    @endforeach
                                            </select>
                                            <span  id="account_no" style="color: red;">{{ $errors->has('account_no') ? $errors->first('account_no') : ' ' }}</span>
                                        </div>
                                        <div class="col-sm-6" style=" margin-bottom: 20px">
                                            <label class="required">Amount of Savings<span style="color: red">*</span> (সঞ্চয়ের পরিমান)</label>
                                            <input type="number" class="form-control" name="loan_amount" value="{{old('amount_of_money')}}" step="1">
                                            <span  id="loan_amount" style="color: red;">{{ $errors->has('loan_amount') ? $errors->first('loan_amount') : ' ' }}</span>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="col-sm-12" style="margin-bottom: 20px">
                                    <fieldset class="field_border" >
                                        <legend class="legend_border">Loan information (হিসাবের তথ্য)</legend>
                                        <div class="col-sm-6" style=" margin-bottom: 20px">
                                            <label class="required">Loan Application Amount<span style="color: red">*</span> (ঋণ আবেদনের পরিমান)</label>
                                            <input type="number" class="form-control" name="form_fee" value="{{old('form_fee')}}">
                                            <span  id="error_form_fee" style="color: red;">{{ $errors->has('form_fee') ? $errors->first('form_fee') : ' ' }}</span>
                                        </div>
                                        <div class="col-sm-6" style=" margin-bottom: 20px">
                                            <label class="required">Application Date<span style="color: red">*</span> (ঋণ আবেদনের তারিখ)</label>
                                            <input type="date" id="datefield" class="form-control" name="application_date" value="{{old('form_fee')}}" >
                                            <span  id="error_form_fee" style="color: red;">{{ $errors->has('form_fee') ? $errors->first('form_fee') : ' ' }}</span>
                                        </div>
                                        <div class="col-sm-12" style=" margin-bottom: 20px">
                                            <input type='checkbox' required /> Therefore, for the benefit of my business,
                                            I would be obliged to pay the loan as per the rules of the association. Otherwise,
                                            the authorities of the society will be able to take legal action on us.
                                            I made this promise and signed the following.<br> (অতঃএব, আমার ব্যাবসায়ের সুবিধার্তে আমাকে উত্তরোক্ত ঋণ
                                            প্রদান করলে সমিতির নিয়মানুযায়ী পরিশোধ করতে বাদ্ধ থাকবো। অন্যথায় সমিতি কতৃপক্ষ
                                            আমাদের উপর আইনানুগ ব্যাবস্থা গ্রহণ করতে পারবেন। আমি এই অঙ্গীকার করে নিম্নে স্বাক্ষর করিলাম।)
                                        </div>
                                    </fieldset>
                                </div>

                                <div class="col-sm-12" style="margin-bottom: 20px">
                                    <fieldset class="field_border">
                                        <legend class="legend_border">Present Address (বর্তমান ঠিকানা)</legend>
                                        <div class="col-sm-6" style=" margin-bottom: 20px">
                                            <label class="required">District<span style="color: red">*</span> (জেলা)</label>
                                            <input class="form-control" id="present_dist" name="present_district" value="{{old('present_district')}}" style="height:34px;"/>

                                            <span  id="error_present_dist" style="color: red;">{{ $errors->has('present_district') ? $errors->first('present_district') : ' ' }}</span>

                                        </div>
                                        <div class="col-sm-6" style=" margin-bottom: 20px">
                                            <label class="required">Thana/Upazila<span style="color: red">*</span> (থানা/উপজেলা)</label>
                                            <input class="form-control" id="present_upazila" name="present_thana" value="{{old('present_thana')}}" style="height:34px;"/>
                                            <span  id="present_thana" style="color: red;">{{ $errors->has('present_thana') ? $errors->first('present_thana') : ' ' }}</span>

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
                                        <div class="col-sm-6" style=" margin-bottom: 20px">
                                            <label class="required">Mobile No<span style="color: red">*</span> (ফোন নাম্বার )</label>
                                            <input type="text" id="mobile" class="form-control" name="mobile_one" value="{{old('mobile_one')}}">
                                            <span  id="mobile" style="color: red;">{{ $errors->has('mobile_one') ? $errors->first('mobile_one') : ' ' }}</span>

                                        </div>
                                        <div class="col-sm-6" style=" margin-bottom: 20px">
                                            <label class="required">Mobile No 2 (ফোন নাম্বার 2)</label>
                                            <input type="text" id="mobile2" class="form-control" name="mobile_two" value="{{old('mobile2')}}">
                                            <span  id="mobile2" style="color: red;">{{ $errors->has('mobile') ? $errors->first('mobile2') : ' ' }}</span>

                                        </div>
                                    </fieldset>
                                </div>
                                <div class="col-sm-6" style="margin-bottom: 20px">
                                    <fieldset class="field_border">
                                        <legend class="legend_border">Nominee Info 1 (মনোনীত ব্যক্তির তথ্য)</legend>
                                        <div class="col-sm-6" style=" margin-bottom: 20px">
                                            <label class="required">Account No<span style="color: red">*</span>(সম্পর্ক)</label>
                                            <input  type="number" onchange="getNomineeInfo()" id="accountID" class="form-control" name="nominee_account_1" value="{{old('account_no')}}">
                                            <span  id="error_account_no" style="color: red;">{{ $errors->has('account_no') ? $errors->first('account_no') : ' ' }}</span>
                                        </div>
                                        <div class="col-sm-6" style=" margin-bottom: 20px">
                                            <label class="required">Amount of Savings<span style="color: red">*</span> (সঞ্চয়ের পরিমান)</label>
                                            <input readonly type="text" id="amountOfSavings" class="form-control" name="amount_of_money" value="{{old('amount_of_money')}}" step="1">
                                            <span  id="error_amount_of_money" style="color: red;">{{ $errors->has('amount_of_money') ? $errors->first('amount_of_money') : ' ' }}</span>
                                        </div>
                                        <div class="col-sm-6" style=" margin-bottom: 20px">
                                            <label class="required">Mobile Number<span style="color: red">*</span> (মনোনীত ব্যক্তির নাম)</label>
                                            <input type="text" id="mobileNum1" class="form-control" name="nominee_name2" value="{{old('nominee_name')}}">
                                            <span  id="error_nominee_name" style="color: red;">{{ $errors->has('nominee_name') ? $errors->first('nominee_name') : ' ' }}</span>
                                        </div>
                                        <div class="col-sm-6" style=" margin-bottom: 20px">
                                            <label class="required">Nominee Name<span style="color: red">*</span> (মনোনীত ব্যক্তির নাম)</label>
                                            <input readonly type="text" id="nomineeName" class="form-control" name="nominee_name" value="{{old('nominee_name')}}">
                                            <span  id="error_nominee_name" style="color: red;">{{ $errors->has('nominee_name') ? $errors->first('nominee_name') : ' ' }}</span>
                                        </div>

                                    </fieldset>
                                </div>
                                <div class="col-sm-6" style="margin-bottom: 20px">
                                    <fieldset class="field_border">
                                        <legend class="legend_border">Nominee Info 2 (মনোনীত ব্যক্তির তথ্য)</legend>
                                        <div class="col-sm-6" style=" margin-bottom: 20px">
                                            <label class="required">Account No<span style="color: red">*</span>(সম্পর্ক)</label>
                                            <input  type="number" onchange="getNomineeInfo2()" id="accountID2" class="form-control" name="nominee_account_2" value="{{old('account_no')}}">
                                            <span  id="error_account_no" style="color: red;">{{ $errors->has('account_no') ? $errors->first('account_no') : ' ' }}</span>

                                        </div>
                                        <div class="col-sm-6" style=" margin-bottom: 20px">
                                            <label class="required">Amount of Savings<span style="color: red">*</span> (সঞ্চয়ের পরিমান)</label>
                                            <input readonly type="text" id="amountOfSavings2" class="form-control" name="amount_of_money" value="{{old('amount_of_money')}}" step="1">
                                            <span  id="error_amount_of_money" style="color: red;">{{ $errors->has('amount_of_money') ? $errors->first('amount_of_money') : ' ' }}</span>
                                        </div>
                                        <div class="col-sm-6" style=" margin-bottom: 20px">
                                            <label class="required">Mobile Number<span style="color: red">*</span> (মনোনীত ব্যক্তির নাম)</label>
                                            <input type="text" id="mobileNum2" class="form-control" name="nominee_name2" value="{{old('nominee_name')}}">
                                            <span  id="error_nominee_name" style="color: red;">{{ $errors->has('nominee_name') ? $errors->first('nominee_name') : ' ' }}</span>
                                        </div>
                                        <div class="col-sm-6" style=" margin-bottom: 20px">
                                            <label class="required">Nominee Name<span style="color: red">*</span> (মনোনীত ব্যক্তির নাম)</label>
                                            <input readonly type="text" id="nomineeName2" class="form-control" name="nominee_name2" value="{{old('nominee_name')}}">
                                            <span  id="error_nominee_name" style="color: red;">{{ $errors->has('nominee_name') ? $errors->first('nominee_name') : ' ' }}</span>
                                        </div>

                                    </fieldset>
                                </div>
                                <div class="col-sm-12" style="margin-bottom: 20px">
                                    <div class="col-sm-12" style=" margin-bottom: 20px">
                                        <input type='checkbox' required /> If the above member / member fails to repay the
                                        loan, we will be obliged to repay the loan amount or repay the loan with our accumulated money.
                                        Otherwise, the authorities of the society will be able to take legal action on us.
                                        I made this promise and signed the following. (উপরোক্ত সদস্য/ সদস্যা ঋণ পরিশোধে ব্যর্থ হলে আমরা ঋণের সমূদয়
                                        পাওনা টাকা পরিশোধ করতে বাধ্য থাকব বা আমাদের সঞ্চিত অর্থ দ্বারা ঋণ পরিশোধ করতে বাধ্য থাকবো। অন্যথায় সমিতি কতৃপক্ষ
                                        আমাদের উপর আইনানুগ ব্যাবস্থা গ্রহণ করতে পারবেন। আমি এই অঙ্গীকার করে নিম্নে স্বাক্ষর করিলাম।)
                                    </div>
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
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth()+1; //January is 0!
        var yyyy = today.getFullYear();
        if(dd<10){
            dd='0'+dd
        }
        if(mm<10){
            mm='0'+mm
        }
        today = yyyy+'-'+mm+'-'+dd;
        document.getElementById("datefield").setAttribute("max", today);
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