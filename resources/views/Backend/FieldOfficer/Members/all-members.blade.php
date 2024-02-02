@extends('Backend.master')

@section('title')
    Manage Loans
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
                <h1 class="text-info" style="text-align: center">Members</h1>
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
                            <th>Account No.</th>
                            <th>Account Name</th>
                            <th>National ID</th>
                            <th>Create Date</th>
{{--                            <th>Applicant Image</th>--}}
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1; ?>
                        @foreach($members as $member)
                            <tr class="odd gradeX">
                                <td>{{ $i++ }}</td>
                                <td>{{ $member->id }}</td>
                                <td>{{ $member->applicant_name }}</td>
                                <td>{{ $member->national_id }}</td>
                                <td>{{ $member->created_at }}</td>
{{--                                <td><img src="{{url($member->applicant_photo)}}" width="60px" height="50px"></td>--}}
                                <td style="width: 100px">
                                    <a href="{{ url('/member-details-info/'.$member->slug) }}" class="btn btn-info btn-xl" title="View Member Details">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @if($member->verify==0)
                                        <a href="{{ url('/edit-member-details/'.$member->slug) }}" class="btn btn-success btn-xl" title="Edit Member">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    @endif
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
