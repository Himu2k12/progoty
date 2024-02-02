@extends('Backend.master')

@section('title')
    Cash Panel
@endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 style="text-align: center" class="m-0 font-weight-bold text-primary">Welcome To Progaty!</h4>
                <h6 style="text-align: center" class="text-success">{{\Illuminate\Support\Facades\Auth::user()->name}}({{$role->role}})</h6>
                <h6 style="text-align: center" class="text-success">{{\Illuminate\Support\Facades\Auth::user()->id}}</h6>
            </div>
        </div>
        <!-- DataTales Example -->

    </div>
    <!-- /.container-fluid -->



@endsection

