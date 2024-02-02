@extends('Backend.master')

@section('title')
    Savings Withdraws

@endsection
@section('content')
    <style>
        .m-0{
            text-align: center;
        }
        .divstyle{
            background-color: white;
            border-radius: 10px;
        }
    </style>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="col-lg-12">
            <div class="card mb-4 py-3 border-bottom-info">
                <div class="card-body">
                    <h4 style="text-align: center">Upload Gurantee Documents</h4>
                    @if( $message = Session::get('message') )
                        <h1 class="page-header">{{ $message }}</h1>
                    @endif
                </div>
            </div>
        </div>
            <div class="card shadow mb-12">
                <div class="card-header py-3">
                    <h4 class="text-primary" style="text-align: center">Verified Informations (যাচাই করা তথ্য)</h4>
                    @if( $message = Session::get('message') )
                        <h4 class="page-header text-success" style="text-align: center">{{ $message }}</h4>
                    @endif
                </div>
                <div class="card-body">
                    <form style="border: 1px solid #bbbbbb; padding: 20px" enctype="multipart/form-data" name="documents" action="{{url('/additional-loan-document')}}" method="post">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-sm-9 offset-3">
                                <fieldset class="field_border" >
                                     <div class="col-sm-6" style=" margin-bottom: 20px">
                                        <label class="required">Gurantee's Check No. (গ্যারান্টির চেক নং)</label>
                                        <input type="text" class="form-control" id="check_no" name="check_no" value="{{old('check_no')}}" required minlength="4">
                                        <span  id="error_applicant_name" style="color: red;">{{ $errors->has('check_no') ? $errors->first('check_no') : ' ' }}</span>
                                        <input type="hidden" value="{{$slug}}" name="slug">
                                    </div>
                                    <div class="col-sm-6" style=" margin-bottom: 20px">
                                        <label class="required">Bank Name (ব্যাংকের নাম)</label>
                                        <input type="text" id="bank_name" class="form-control" name="bank_name" value="{{old('bank_name')}}" required minlength="4">
                                        <span  id="error_bank_name" style="color: red;">{{ $errors->has('bank_name') ? $errors->first('bank_name') : ' ' }}</span>
                                    </div>
                                    <div class="col-sm-6" style=" margin-bottom: 20px">
                                        <label class="required">Loan considered (বিবেচিত অর্থ)</label>
                                        <input type="number" class="form-control" name="loan_suggest" value="{{$loanAmount->loan_amount}}" min="1" max="{{$loanAmount->loan_amount}}" required>
                                        <span style="color: red;">{{ $errors->has('loan_suggest') ? $errors->first('loan_suggest') : ' ' }}</span>
                                    </div>
                                    <div class="col-sm-6" style=" margin-bottom: 20px">
                                        <label class="required">Note<span style="color: red">*</span> (বিঃদ্রঃ)</label>
                                        <textarea type="text" class="form-control" name="note">{{old('note')}}</textarea>
                                        <span  id="error_applicant_father_name" style="color: red;">{{ $errors->has('note') ? $errors->first('note') : ' ' }}</span>
                                    </div>
                                    <div class="col-sm-6" style=" margin-bottom: 20px">
                                        <label class="required">Other Document<span style="color: red">*</span> (অন্যান্য নথি)</label>
                                        <input id="loanDoc" type="file" multiple="multiple" accept="JPG,PNG,docx,pdf" name="other_document[]" class="form-control" value="">
                                        <span  id="error_nationality" style="color: red;">{{ $errors->has('other_document') ? $errors->first('other_document') : ' ' }}</span>
                                    </div>
                                    <div class="col-sm-6" style="text-align: center">
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </fieldset>
                            </div>

                        </div>

                    </form>
                </div>

            </div>
        <!-- /.container-fluid -->
@endsection

