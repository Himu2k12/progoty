@extends('Backend.master')

@section('title')
    Daily Collections
@endsection

@section('style')
    <link href="{{asset('/Assets/')}}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="text-primary" style="text-align: center">Overview Officer's Daily Collections</h4>
                @if( $message = Session::get('message') )
                    <h4 class="page-header text-success" style="text-align: center">{{ $message }}</h4>
                @endif
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTable">
                        <thead>
                        <tr>
                            <th>SL NO</th>
                            <th>Field Officer Name</th>
                            <th>Sheet No</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1; ?>
                        @foreach($dailyCollectionOfAllFeildman as $item)
                            <tr class="odd gradeX">
                                <td>{{ $i++ }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->sheet_no }}</td>
                                <td>
                                    <a href="{{ url('/cashier-view-of-today-collection/'.$item->field_man_id.'/'.$item->sheet_no) }}" class="btn btn-info btn-xl" title="View Member Details">
                                        <span class="fas fa-eye"></span>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->



@endsection
@section('additionalScript')
    <!-- Page level plugins -->

@endsection
