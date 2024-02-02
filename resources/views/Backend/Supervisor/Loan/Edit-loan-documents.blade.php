@extends('Backend.master')

@section('title')
    Edit Loan Details
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
        th{
            text-align: center;
            width: 50%;
        }
        td{
            text-align: center;
        }
    </style>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="col-lg-12">
            <div class="card mb-4 py-3 border-bottom-info">
                <div class="card-body">
                    <h4 style="text-align: center">Edit Gurantee Documents</h4>
                    @if( $message = Session::get('message') )
                        <h1 class="page-header">{{ $message }}</h1>
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">

                <div class="card-body">
                    <div class="col-md-12">
                        <nav class="divstyle border-bottom-success">
                            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Basic Info</a>
                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-account" role="tab" aria-controls="nav-profile" aria-selected="false">Document List</a>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                <div class="card shadow mb-12">
                                    <div class="card-header py-12">
                                        <div>
                                            <h5 class="m-0 font-weight-bold text-primary">Verified Informations</h5>
                                            @if( $mass = Session::get('mass') )
                                                <h6 class="page-header text-success" style="text-align: center">{{ $mass }}</h6>
                                            @endif
                                            @if( $massdanger = Session::get('danger_mass') )
                                                <h4 class="page-header text-danger" style="text-align: center">{{ $massdanger }}</h4>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="card-body row table-responsive">
                                        <form style="border: 1px solid #bbbbbb; padding: 20px" enctype="multipart/form-data" name="documents" action="{{url('/update-loan-document')}}" method="post">
                                            {{csrf_field()}}
                                            <div class="row">
                                                <div class="col-sm-10 offset-3">
                                                        <div class="col-sm-6" style=" margin-bottom: 20px">
                                                            <label class="required">Gurantee's Check No. (গ্যারান্টির চেক নং)</label>
                                                            <input type="text" class="form-control" id="check_no" name="check_no" value="{{$loanInfo->check_no}}" required minlength="4">
                                                            <input type="hidden" name="id" value="{{$loanInfo->id}}">
                                                            <span  id="error_applicant_name" style="color: red;">{{ $errors->has('check_no') ? $errors->first('check_no') : ' ' }}</span>

                                                        </div>
                                                        <div class="col-sm-6" style=" margin-bottom: 20px">
                                                            <label class="required">Bank Name (ব্যাংকের নাম)</label>
                                                            <input type="text" id="bank_name" class="form-control" name="bank_name" value="{{$loanInfo->bank_name}}" required minlength="4">
                                                            <span  id="error_bank_name" style="color: red;">{{ $errors->has('bank_name') ? $errors->first('bank_name') : ' ' }}</span>
                                                        </div>
                                                        <div class="col-sm-6" style=" margin-bottom: 20px">
                                                            <label class="required">Loan considered (বিবেচিত অর্থ)</label>
                                                            <input type="number" class="form-control" name="loan_suggest" value="{{$loanInfo->loan_suggest}}" min="1" required>
                                                            <span style="color: red;">{{ $errors->has('loan_suggest') ? $errors->first('loan_suggest') : ' ' }}</span>
                                                        </div>
                                                        <div class="col-sm-6" style=" margin-bottom: 20px">
                                                            <label class="required">Note<span style="color: red">*</span> (বিঃদ্রঃ)</label>
                                                            <textarea type="text" class="form-control" name="note">{{$loanInfo->note}}</textarea>
                                                            <span  id="error_applicant_father_name" style="color: red;">{{ $errors->has('note') ? $errors->first('note') : ' ' }}</span>
                                                        </div>
                                                        <div class="col-sm-6" style=" margin-bottom: 20px">
                                                            <label class="required">New Document<span style="color: red">*</span> (অন্যান্য নথি)</label>
                                                            <input id="loanDoc" type="file" multiple="multiple" accept=".jpg, .png, .doc" name="other_document[]" class="form-control" value="">
                                                            <span  id="error_nationality" style="color: red;">{{ $errors->has('other_document') ? $errors->first('other_document') : ' ' }}</span>
                                                        </div>

                                                </div>
                                                <div class="col-sm-3 offset-5 ">
                                                <button type="submit" class="btn btn-success">Update</button>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-account" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <div class="card shadow mb-12">
                                    <div class="card-header py-12">
                                        <div>
                                            <h5 class="m-0 font-weight-bold text-primary">Document List</h5>
                                        </div>
                                    </div>
                                    <div class="card-body row table-responsive">
                                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTable">
                                            <tbody>
                                            <tr>
                                                <th>Document List</th>
                                                <th>Action</th>
                                            </tr>
                                            @foreach($docList as $item)
                                            <tr>
                                                <td>
                                                   <a target="_blank" href="{{asset('/Loan_Documents/'.$item->other_document)}}">     {{$item->other_document}}</a>
                                                </td>
                                                    <td>
                                                        <a onclick="return Confirm('Are you sure to Permanently Delete the Document?')" class="btn btn-danger" href="{{url('del-document/'.$item->id)}}"><i class="fas fa-trash"> Delete</i></a>
                                                    </td>
                                            </tr>
                                            @endforeach
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- /.container-fluid -->
@endsection

