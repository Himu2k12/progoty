@extends('back.master')
@section('title')
   Daily Savings Collection
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-offset-3 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1 class="text-info" style="text-align: center">Overview New Member</h1>
                    @if( $message = Session::get('message') )
                        <h4 class="page-header text-success" style="text-align: center">{{ $message }}</h4>
                    @endif
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr>
                            <th>SL NO</th>
                            <th>Field Man ID</th>
                            <th>Field Man Name</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1; ?>
                        @foreach($dailyCollectionOfAllFeildman as $item)
                            <tr class="odd gradeX">
                                <td>{{ $i++ }}</td>
                                <td>{{ $item->field_man_id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->sum}}</td>
                                <td>
                                    <a href="{{ url('/'.$item->field_man_id) }}" class="btn btn-info btn-xl" title="View Member Details">
                                        <span class="glyphicon glyphicon-zoom-in"></span>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <!-- /.table-responsive -->

                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
@endsection