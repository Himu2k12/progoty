@extends('Backend.master')

@section('title')
    Manage Additional Expenses
@endsection

@section('style')
    <link href="{{asset('/Assets/')}}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 style="text-align: center" class="m-0 font-weight-bold text-primary">Add New Expenses</h4>
              @if( $message= Session::get('message'))
                <h6 style="text-align: center" class="text-success">{{ $message }}</h6>
                  @endif
            </div>
            <div class="offset-md-2 col-md-8 card mb-4 py-3 border-left-success">
                <div class="card-body">
                    <form method="POST" action="{{ route('create-additional-cost') }}" name="room_add">
                        @csrf
                        <div class="form-group row">
                            <label for="cost_amount" class="col-md-4 col-form-label text-md-right">{{ __('Costing Category') }}<span style="color:red;">*</span></label>
                            <div class="col-md-6">
                               <select class="form-control" name="costing_category">
                                   <option value="">Select One</option>
                                       @foreach($costings as $costing)
                                        <option value="{{$costing->id}}">{{$costing->category}}</option>
                                       @endforeach
                               </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="cost_amount" class="col-md-4 col-form-label text-md-right">{{ __('Cost Amount') }}<span style="color:red;">*</span></label>
                            <div class="col-md-6">
                                <input id="cost_amount" max="10000000" min="1" type="number" class="form-control" name="cost_amount" value="{{ old('cost_amount') }}" required  autofocus>
                                <span  style="color: red;">{{ $errors->has('cost_amount') ? $errors->first('cost_amount') : ' ' }}</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="cost_amount" class="col-md-4 col-form-label text-md-right">{{ __('Voucher No') }}<span style="color:red;">*</span></label>
                            <div class="col-md-6">
                                <input id="cost_amount" max="10000000" min="1" type="number" class="form-control" name="voucher_no" value="{{ old('voucher_no') }}" required  autofocus>
                                <span  style="color: red;">{{ $errors->has('voucher_no') ? $errors->first('voucher_no') : ' ' }}</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="date" class="col-md-4 col-form-label text-md-right">{{ __('Date') }}<span style="color:red;">*</span></label>
                            <div class="col-md-6">
                                <input id="date" type="date" class="form-control" name="date" value="{{ old('date') }}" required  autofocus>
                                <span  style="color: red;">{{ $errors->has('date') ? $errors->first('date') : ' ' }}</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}<span style="color:red;">*</span></label>
                            <div class="col-md-8">
                                <textarea id="summernote"  name="description" >{{ old('description') }}</textarea>

                            </div>
                            <span  style="color: red;">{{ $errors->has('description') ? $errors->first('description') : ' ' }}</span>

                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-4 offset-md-5">
                                <button type="submit"  class="col-md-5 btn btn-success">
                                    <i class="fas fa-plus"></i>
                                    {{ __('Add') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h5 style="text-align: center" class="m-0 font-weight-bold text-primary">All Additional Expenses</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Voucher No</th>
                            <th>Cost Amount</th>
                            <th>Costing Category</th>
                            <th>Date of Costing</th>
                            <th>Details</th>
                            <th>Created By (#ID)</th>
                            <th>Created at</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($allCosts as $costs)
                            <tr>
                                <td>{{$costs->id}}</td>
                                <td>{{$costs->voucher_no}}</td>
                                <td>{{$costs->additional_cost}}</td>
                                <td>{{$CategoryName->categoryName($costs->additional_cost_category)->category}}</td>
                                <td>{{$costs->date_of_cost}}</td>
                                <td>{!! $costs->description !!}</td>
                                <td>{{$costs->name}}({{$costs->created_by}})</td>
                                <td>{{$costs->created_at}}</td>
                                <td><a href="{{ url('/edit-additional-cost/'.$costs->id) }}" class="btn btn-primary btn-xl" title="Edit">
                                        <span><i class="fas fa-edit"></i></span>
                                    </a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
    <script>
        $('#summernote').summernote({
            placeholder: 'Enter comment here',
            tabsize: 3,
            height: 150,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    </script>
@endsection
@section('additionalScript')
    <!-- Page level plugins -->

@endsection
