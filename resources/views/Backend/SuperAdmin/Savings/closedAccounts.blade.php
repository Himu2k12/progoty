@extends('Backend.master')

@section('title')
  Closed Members
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
                <h4 class="text-primary" style="text-align: center">Closed Members</h4>
                @if( $message = Session::get('message') )
                    <h6 class="page-header text-success" style="text-align: center">{{ $message }}</h6>
                @endif
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTable">
                        <thead>
                        <tr>
                            <th>Account No</th>
                            <th>Applicant Name</th>
                            <th>National ID</th>
                            <th>Join Date</th>
                            <th>Field Officer Name</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1; ?>
                        @if(!$newMembers->isEmpty())
                        @foreach($newMembers as $member)
                            <tr class="odd gradeX">
                                <td>{{ $member->id}}</td>
                                <td>{{ $member->applicant_name }}</td>
                                <td>{{ $member->national_id }}</td>
                                <td>{{ $member->created_at }}</td>
                                <td>{{ $member->name }}</td>
                             <td>

                                    @can('isSuper')
                                         @if($member->verify ==1)
                                        <a href="{{ url('/inactive-members-for-cause/'.$member->slug) }}" class="btn btn-danger btn-xl" title="Inactive">
                                             <i class="fas fa-arrow-down"></i>
                                        </a>
                                        @else
                                        <a href="{{ url('/active-members-for-cause/'.$member->slug) }}" class="btn btn-success btn-xl" title="Active">
                                            <i class="fas fa-arrow-up"></i>
                                        </a>
                                    @endif
                                     @endcan
                                     

                                </td>
                            </tr>
                        @endforeach
                            @endif
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
