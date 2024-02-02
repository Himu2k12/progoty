@extends('Backend.master')

@section('title')
    Loan Withdraws

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
                    <h4 style="text-align: center">Final Check on Loan Despatch</h4>
                    @if( $message = Session::get('message') )
                        <h1 class="page-header">{{ $message }}</h1>
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">

                <div class="card-body">
                        <div class="card-body table-responsive">
                            <form enctype="multipart/form-data" name="documents" action="{{url('/save-loan-dispatch')}}" method="post">
                                {{csrf_field()}}
                                <div class="row">
                                    <div class="col-sm-10 offset-1" style="margin-bottom: 20px">
                                        <div class="card shadow mb-12" >
                                            <div class="card-header py-12">
                                                <div>
                                                    <h6 class="m-0 text-md-center font-weight-bold text-md-center text-primary">Dispatch Information(তথ্য প্রেরণ)</h6>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-sm-4 offset-1"> <label class="required">Dispatch date(অনুমোদনের তারিখ)<span style="color: red">*</span> </label>
                                                    </div>
                                                    <div class="col-sm-6" style=" margin-bottom: 20px">
                                                        <input type="date" class="form-control" id="dispatch" name="dispatch_date" value="{{old('dispatch_date')}}" required minlength="4">
                                                        <span  id="error_dispatch_date" style="color: red;">{{ $errors->has('dispatch_date') ? $errors->first('dispatch_date') : ' ' }}</span>
                                                        <input type="hidden" value="{{$slug}}" name="slug">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-4 offset-1"> <label class="required">Loan Amount(ঋণের পরিমাণ)</label></div>
                                                    <div class="col-sm-6" style=" margin-bottom: 20px">
                                                        <input type="text" readonly class="form-control" value="{{$loanAmount->final_amount}}">
                                                        <span  id="error_dispatch_date" style="color: red;">{{ $errors->has('dispatch_date') ? $errors->first('dispatch_date') : ' ' }}</span>
                                                        <input type="hidden" value="{{$loanAmount->final_amount}}" name="loan_amount">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-4 offset-1">  <label class="required">Service Charge(সেবা খরচ)<span style="color: red">*</span> </label></div>
                                                    <div class="col-sm-6" style=" margin-bottom: 20px">
                                                        <select name="service_charge" class="form-control" required>
                                                            <option value="">select</option>
                                                            <option value="20">20%</option>
                                                        </select>
                                                        <span  id="error_dispatch_date" style="color: red;">{{ $errors->has('service_charge') ? $errors->first('service_charge') : ' ' }}</span>
                                                       <input type="hidden" value="{{$slug}}" name="slug">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-4 offset-1"> <label class="required">Note<span style="color: red">*</span> (বিঃদ্রঃ)</label></div>
                                                    <div class="col-sm-6" style=" margin-bottom: 20px">
                                                        <textarea type="text" class="form-control" required maxlength="2000" name="note">{{old('note')}}</textarea>
                                                        <span  id="error_applicant_father_name" style="color: red;">{{ $errors->has('note') ? $errors->first('note') : ' ' }}</span>
                                                    </div>
                                                </div>
                                            <div class="col-sm-12" style=" margin-bottom: 20px; text-align: center">
                                                <button type="submit" class="btn btn-success">Submit</button>
                                            </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </form>
                        </div>
                </div>

            </div>
        </div>
        <!-- /.container-fluid -->
@endsection

        @section('script')

            <script>
                $("#loanDoc").on("change", function() {
                    if ($("#loanDoc")[0].files.length > 5) {
                        alert("You can select only 5 Files");
                        $("#loanDoc").val("");
                    } else {
                        $("#documents").submit();
                    }
                });

            </script>
@endsection
