@extends('Backend.master')

@section('title')
    Edit Considered Loans
@endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 style="text-align: center" class="m-0 font-weight-bold text-primary">Edit Final Check ( Loan Information ) (যাচাই কৃত তথ্য সংশোধন)</h6>
            </div>
            <div class="card-body">
                <form  enctype="multipart/form-data" name="documents" action="{{url('/loan-final-update')}}" method="post">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-sm-10 offset-1" style="margin-bottom: 20px">
                                <legend class="legend_border" style="text-align: center;"></legend>
                                <div class="col-sm-6 offset-3" style=" margin-bottom: 20px">
                                    <label class="required">Loan Application</label>
                                    <input type="number" readonly class="form-control" name="loan_suggest" value="{{$loanAmount->loan_amount}}" min="1" required>
                                    <span style="color: red;">{{ $errors->has('loan_suggest') ? $errors->first('loan_suggest') : ' ' }}</span>
                                   
                                    <input type="hidden" name="id" value="{{$supervisorAmount->id}}">
                                    <input type="hidden" name="id" value="{{$adminInfos->id}}">
                                </div>
                                <div class="col-sm-6 offset-3" style=" margin-bottom: 20px">
                                    <label class="required">Supervisor considered (বিবেচিত অর্থ)</label>
                                    <input type="number" readonly class="form-control" name="final_amount" value="{{$supervisorAmount->loan_suggest}}" min="1" required>
                                    <span style="color: red;">{{ $errors->has('loan_suggest') ? $errors->first('loan_suggest') : ' ' }}</span>
                                </div>
                                <div class="col-sm-6 offset-3" style=" margin-bottom: 20px">
                                    <label class="required">New ED considered Amount (নির্বাহী পরিচালক বিবেচিত অর্থ)</label>
                                    <input type="number" class="form-control" name="final_amount" value="{{$adminInfos->final_amount}}" min="1" required>
                                    <span style="color: red;">{{ $errors->has('loan_suggest') ? $errors->first('loan_suggest') : ' ' }}</span>
                                </div>
                                <div class="col-sm-6 offset-3" style=" margin-bottom: 20px">
                                    <label class="required">Note<span style="color: red">*</span> (বিঃদ্রঃ)</label>
                                    <textarea type="text" class="form-control"  name="note">{{$adminInfos->note}}</textarea>
                                    <span  id="error_applicant_father_name" style="color: red;">{{ $errors->has('note') ? $errors->first('note') : ' ' }}</span>
                                </div>
                                <div class="col-sm-12" style="text-align: center">
                                    <button type="submit" class="btn btn-success">Update</button>
                                </div>
                        </div>

                    </div>

                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->



@endsection
@section('additionalScript')
    <!-- Page level plugins -->

@endsection
