@extends('Backend.master')

@section('title')
     New Member
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
                <h4 class="text-primary" style="text-align: center">New Members</h4>
                @if( $message = Session::get('message') )
                    <h4 class="page-header text-success" style="text-align: center">{{ $message }}</h4>
                @endif
                @if( $mess = Session::get('mess') )
                    <h4 class="page-header text-warning" style="text-align: center">{{ $mess }}</h4>
                @endif
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTable">
                        <thead>
                        <tr>
                            <th>Member ID</th>
                            <th>Member Name</th>
                            <th>National ID</th>
                            <th>Date</th>
                            <th>Field Officer Name</th>
{{--                            <th>Applicant Image</th>--}}
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1; ?>
                        @foreach($newMembers as $member)
                            <tr class="odd gradeX">
                                <td>{{ $member->id }}</td>
                                <td>{{ $member->applicant_name }}</td>
                                <td>{{ $member->national_id }}</td>
                                <td>{{ $member->created_at }}</td>
                                <td>{{ $member->name }}</td>
{{--                                <td><img src="{{url($member->applicant_photo)}}" width="60px" height="50px"></td>--}}
                                <td>
                                    <a href="{{ url('/details-member-view/'.$member->slug) }}" class="btn btn-info btn-xl" title="View Member Details">
                                        <i class="fas fa-eye"></i>
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
