<!DOCTYPE html>
<html>
@include('template._head')
@stack('styles')
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    <!--header-->
@include('template._header')
{{--<!--main content-->--}}
    {{--<div>--}}
        {{--@include('template._errors')--}}
        {{--@include('template._success')--}}
        {{--@yield('content')--}}
        {{--@stack('modals')--}}
    {{--</div>--}}
@include('template._body')
{{--<!--footer-->--}}
@include('template._footer')
<!--./footer-->


    <!-- Content Wrapper. Contains page content -->
</div>
<!-- ./wrapper -->
<!--script-->
@include('template._scripts')
@stack('scripts')

</body>

</html>