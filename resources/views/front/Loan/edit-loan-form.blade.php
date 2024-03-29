@extends('front.master')

@section('title')
    Edit Loan
@endsection


@section('content')

    <div class="welcome-wrap">
        <div class="container">
            <div class="row">
                <div class=" col-sm-12">
                    <div class="alert alert-success"><h4 style="text-align: center">Edit Loan Application Form (ঋণ আবেদন হালনাগাদ ফর্ম )</h4></div>
                    <div class="" style="border: 1px solid #CDCCCC; padding: 30px">
                        <div class="alert alert-primary" style="padding: 10px"><p style="text-align: center; color: black;font-size: 12px">All information should be filled up in English (সকল তথ্য অবশ্যই ইংরেজীতে পূরন করতে হবে)</div>
                        <div class="alert alert-danger" style="padding: 10px; text-align: center"><p style="color: black;font-size: 13px">Fields marked with <span style="color: red">*</span> are mandatory. (লাল <span style="color: red">*</span> তারকা চিহ্নিত ঘরের তথ্যগুলো পূরন করা আবশ্যক)<br>Fields marked with  <span style="color: green">*</span> are required any of them.  (সবুজ <span style="color: green">*</span> তারকা চিহ্নিত ঘরের তথ্যগুলো যে কোন একটি পূরণ করা আবশ্যক, আপনি চাইলে উভয় ঘরের তথ্য দিতে পারেন)</p></div>

                        @if($errors->any())
                            {{implode($errors->all())}}
                            <div class="alert alert-danger" style="padding: 10px; color:black; text-align: center"><b>Loan Application Not Submitted!Please Check all Fields</b></div>
                        @endif
                        @if((Session::get('mass')!==null))
                            <div class="alert alert-success" style="padding: 10px; text-align: center">{{Session::get('mass')}}</div>
                        @endif
                        @if((Session::get('mess')!==null))
                            <div class="alert alert-danger" style="padding: 10px; text-align: center">{{Session::get('mess')}}</div>
                        @endif
                        <form enctype="multipart/form-data" name="newMember" action="{{url('/update-loan')}}" method="post">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col-sm-12" style="margin-bottom: 20px">
                                    <fieldset class="field_border" >
                                        <legend class="legend_border">Account information (হিসাবের তথ্য)</legend>
                                        <div class="col-sm-6" style=" margin-bottom: 20px">
                                            <label class="required">Account No<span style="color: red">*</span> ( হিসাব নং)</label>
                                           <input type="text" class="form-control" readonly value="{{$editInfo->account_no}}">
                                           <input type="hidden" name="id" value="{{$editInfo->id}}">
                                        </div>
                                        <div class="col-sm-6" style=" margin-bottom: 20px">
                                            <label class="required">Amount of Savings<span style="color: red">*</span> (সঞ্চয়ের পরিমান)</label>
                                            <input readonly id="saving" type="number" class="form-control" name="total_deposite" value="{{$editInfo->total_deposite}}" step="1">
                                            <span  id="" style="color: red;">{{ $errors->has('total_deposite') ? $errors->first('total_deposite') : ' ' }}</span>
                                        </div>
                                        
                                    </fieldset>
                                </div>
                                <div class="col-sm-12" style="margin-bottom: 20px">
                                    <fieldset class="field_border" >
                                        <legend class="legend_border">Loan information (হিসাবের তথ্য)</legend>
                                        <div class="col-sm-6" style=" margin-bottom: 20px">
                                            <label class="required">Loan Application Amount<span style="color: red">*</span> (ঋণ আবেদনের পরিমান)</label>
                                            <input type="number" required class="form-control" name="loan_amount" value="{{$editInfo->loan_amount}}">
                                            <span  id="error_loan_amount" style="color: red;">{{ $errors->has('loan_amount') ? $errors->first('loan_amount') : ' ' }}</span>
                                        </div>
                                        <div class="col-sm-6" style=" margin-bottom: 20px">
                                            <label class="required">Application Date<span style="color: red">*</span> (ঋণ আবেদনের তারিখ)</label>
                                            <input type="date" required  id="datefield" class="form-control" name="application_date" value="{{$editInfo->application_date}}" >
                                            <span  id="error_form_fee" style="color: red;">{{ $errors->has('application_date') ? $errors->first('application_date') : ' ' }}</span>
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
                                            <input required class="form-control" id="present_dist" name="present_district" value="{{$editInfo->present_district}}" style="height:34px;"/>

                                            <span  id="error_present_dist" style="color: red;">{{ $errors->has('present_district') ? $errors->first('present_district') : ' ' }}</span>

                                        </div>
                                        <div class="col-sm-6" style=" margin-bottom: 20px">
                                            <label class="required">Thana/Upazila<span style="color: red">*</span> (থানা/উপজেলা)</label>
                                            <input required class="form-control" id="present_upazila" name="present_thana" value="{{$editInfo->present_thana}}" style="height:34px;"/>
                                            <span  id="present_thana" style="color: red;">{{ $errors->has('present_thana') ? $errors->first('present_thana') : ' ' }}</span>

                                        </div>
                                        <div class="col-sm-6" style=" margin-bottom: 20px">
                                            <label class="required">Post Code <span style="color: red">*</span>(পোস্ট কোড)</label>
                                            <input required type="number" id="present_post_code" class="form-control" name="present_post_code" value="{{$editInfo->present_post_code}}">
                                            <span  id="error_present_post_code" style="color: red;">{{ $errors->has('present_post_code') ? $errors->first('present_post_code') : ' ' }}</span>

                                        </div>
                                        <div class="col-sm-6" style=" margin-bottom: 20px">
                                            <label class="required">Village/Road No/House No/Address<span style="color: red">*</span> (গ্রাম/রোড নং/বাড়ি নং/ঠিকানা)</label>
                                            <input required type="text" id="present_village" class="form-control" name="present_village" value="{{$editInfo->present_village}}">
                                            <span  id="error_present_village" style="color: red;">{{ $errors->has('present_village') ? $errors->first('present_village') : ' ' }}</span>

                                        </div>
                                        <div class="col-sm-6" style=" margin-bottom: 20px">
                                            <label class="required">Mobile No<span style="color: red">*</span> (ফোন নাম্বার )</label>
                                            <input required type="text" id="mobile" class="form-control" name="mobile_one" value="{{$editInfo->mobile_one}}">
                                            <span  id="mobile" style="color: red;">{{ $errors->has('mobile_one') ? $errors->first('mobile_one') : ' ' }}</span>

                                        </div>
                                        <div class="col-sm-6" style=" margin-bottom: 20px">
                                            <label class="required">Mobile No 2 (ফোন নাম্বার 2)</label>
                                            <input type="text" id="mobile2" class="form-control" name="mobile_two" value="{{$editInfo->mobile_two}}">
                                            <span  id="mobile2" style="color: red;">{{ $errors->has('mobile') ? $errors->first('mobile2') : ' ' }}</span>

                                        </div>
                                    </fieldset>
                                </div>
                                <div class="col-sm-6" style="margin-bottom: 20px">
                                    <fieldset class="field_border">
                                        <legend class="legend_border">Nominee Info 1 (মনোনীত ব্যক্তির তথ্য)</legend>
                                        <div class="col-sm-6" style=" margin-bottom: 20px">
                                            <label class="required">Account No<span style="color: red">*</span>(হিসাব নাম্বার)</label>
                                            <input required  type="number" onchange="getNomineeInfo()" id="accountID" class="form-control" name="nominee_account_1" value="{{$editInfo->nominee_account_1}}">
                                            <span  id="error_account_no" style="color: red;">{{ $errors->has('nominee_account_1') ? $errors->first('nominee_account_1') : ' ' }}</span>
                                        </div>
                                        <div class="col-sm-6" style=" margin-bottom: 20px">
                                            <label class="required">Amount of Savings<span style="color: red">*</span> (সঞ্চয়ের পরিমান)</label>
                                            <input readonly type="text" id="amountOfSavings" class="form-control" value="{{$editInfo->savings_amount_1}}" step="1">
                                            <input type="hidden" id="amountOfSavings1" name="savings_amount_1" value="{{$editInfo->savings_amount_1}}">
                                            <span  id="error_amount_of_money" style="color: red;">{{ $errors->has('amount_of_money') ? $errors->first('amount_of_money') : ' ' }}</span>
                                        </div>
                                        <div class="col-sm-6" style=" margin-bottom: 20px">
                                            <label class="required">Mobile Number<span style="color: red">*</span> (মনোনীত ব্যক্তির মোবাইল নাম্বার)</label>
                                            <input required type="text" id="mobileNum1" class="form-control" name="nominee_mob_1" value="{{$editInfo->nominee_mob_1}}">
                                            <span  id="error_nominee_name" style="color: red;">{{ $errors->has('nominee_mob_1') ? $errors->first('nominee_mob_1') : ' ' }}</span>
                                        </div>
                                        <div class="col-sm-6" style=" margin-bottom: 20px">
                                            <label class="required">Nominee Name<span style="color: red">*</span> (মনোনীত ব্যক্তির নাম)</label>
                                            <input readonly type="text" id="nomineeName" class="form-control" name="nominee_name" value="{{$editInfo->nominee_name}}">
                                            <span  id="error_nominee_name" style="color: red;">{{ $errors->has('nominee_name') ? $errors->first('nominee_name') : ' ' }}</span>
                                        </div>

                                    </fieldset>
                                </div>
                                <div class="col-sm-6" style="margin-bottom: 20px">
                                    <fieldset class="field_border">
                                        <legend class="legend_border">Nominee Info 2 (মনোনীত ব্যক্তির তথ্য)</legend>
                                        <div class="col-sm-6" style=" margin-bottom: 20px">
                                            <label class="required">Account No<span style="color: red">*</span>(হিসাব নাম্বার)</label>
                                            <input required  type="number" onchange="getNomineeInfo2()" id="accountID2" class="form-control" name="nominee_account_2" value="{{$editInfo->nominee_account_2}}">
                                            <span  id="error_account_no" style="color: red;">{{ $errors->has('nominee_account_2') ? $errors->first('nominee_account_2') : ' ' }}</span>

                                        </div>
                                        <div class="col-sm-6" style=" margin-bottom: 20px">
                                            <label class="required">Amount of Savings<span style="color: red">*</span> (সঞ্চয়ের পরিমান)</label>
                                            <input readonly type="text" id="amountOfSavings2" class="form-control"  value="{{$editInfo->savings_amount_2}}" step="1">
                                            <input type="hidden" id="amountOfSavings21" name="savings_amount_2" value="{{$editInfo->savings_amount_2}}">
                                            <span  id="error_amount_of_money" style="color: red;">{{ $errors->has('amount_of_money') ? $errors->first('amount_of_money') : ' ' }}</span>
                                        </div>
                                        <div class="col-sm-6" style=" margin-bottom: 20px">
                                            <label class="required">Mobile Number<span style="color: red">*</span> (মনোনীত ব্যক্তির মোবাইল নাম্বার)</label>
                                            <input required type="text" id="mobileNum2" class="form-control" name="nominee_mobile_2" value="{{$editInfo->nominee_mob_2}}">
                                            <span  id="error_nominee_name" style="color: red;">{{ $errors->has('nominee_mobile_2') ? $errors->first('nominee_mobile_2') : ' ' }}</span>
                                        </div>
                                        <div class="col-sm-6" style=" margin-bottom: 20px">
                                            <label class="required">Nominee Name<span style="color: red">*</span> (মনোনীত ব্যক্তির নাম)</label>
                                            <input readonly type="text" id="nomineeName2" class="form-control">
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
                                    <div class="col-sm-2 col-sm-offset-5" style=" margin-bottom: 20px">
                                        <input type='submit' class="form-control btn btn-success" value="Update(হালনাগাদ)" name="" />
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
    </script>
@endsection
