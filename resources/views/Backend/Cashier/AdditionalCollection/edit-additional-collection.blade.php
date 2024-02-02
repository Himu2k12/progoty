@extends('Backend.master')

@section('title')
    Manage Additional Collection
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
                <h4 style="text-align: center" class="m-0 font-weight-bold text-primary">Edit Additional Collection</h4>
            </div>
            <div class="offset-md-2 col-md-8 card mb-4 py-3 border-left-success">
                <div class="card-body">
                    <form method="POST" action="{{ route('update-additional-collection') }}" name="editform" >
                        @csrf
                        <div class="form-group row">
                            <label for="cost_amount" class="col-md-4 col-form-label text-md-right">{{ __('Collection Amount') }}<span style="color: red">*</span></label>
                            <div class="col-md-6">
                                <input id="cost_amount" type="number" min="1" max="10000000" class="form-control" name="cost_amount" value="{{$editInfo->additional_cost}}" required  autofocus>
                                <span  style="color: red;">{{ $errors->has('cost_amount') ? $errors->first('cost_amount') : ' ' }}</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="cost_amount" class="col-md-4 col-form-label text-md-right">{{ __('Collection Category') }}<span style="color:red;">*</span></label>
                            <div class="col-md-6">
                                <select class="form-control" required name="collection_category">
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->category}}</option>
                                    @endforeach
                                </select>
                                <span  style="color: red;">{{ $errors->has('cost_amount') ? $errors->first('cost_amount') : ' ' }}</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="date" class="col-md-4 col-form-label text-md-right">{{ __('Date') }}<span style="color: red">*</span></label>
                            <div class="col-md-6">
                                <input id="date" type="date" class="form-control" name="date" value="{{ $editInfo->date_of_cost }}" required  autofocus>
                                <input type="hidden" value="{{ $editInfo->id }}" name="id">
                                <span  style="color: red;">{{ $errors->has('date') ? $errors->first('date') : ' ' }}</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}<span style="color: red">*</span></label>
                            <div class="col-md-8">
                                <textarea id="summernote"  name="description" required>{!! $editInfo->description !!}</textarea>
                            </div>
                            <span  style="color: red;">{{ $errors->has('description') ? $errors->first('description') : ' ' }}</span>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-4 offset-md-5">
                                <button type="submit"  class="col-md-8 btn btn-success">
                                    <i class="fas fa-tools"></i>
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </form>
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
        document.forms['editform'].elements['collection_category'].value = '{{$editInfo->collection_category}}';
    </script>
@endsection
@section('additionalScript')
    <!-- Page level plugins -->

@endsection
