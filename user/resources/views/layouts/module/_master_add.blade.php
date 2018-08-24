@extends('layout.admintamplate')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="box-title">
                        <h4>@yield('header-title')</h4>
                    </div>
                    @yield('header-action')
                </div>
                <div class="box-body">
                    @yield('add-form')
                </div>
                <div class="box-footer">
                    @yield('footer-action')
                </div>
            </div>
        </div>
    </div>
@endsection