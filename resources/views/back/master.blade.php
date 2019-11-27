@include('back.includes.header')

<div id="wrapper">

@include('back.includes.navbar')

    @yield('content')
     <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- jQuery -->
@include('back.includes.footer-script')

@include('back.includes.footer')
