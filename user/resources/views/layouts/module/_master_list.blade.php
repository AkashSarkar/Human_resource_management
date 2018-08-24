@extends('layouts.master')
@section('content')
    <div class="content-wrapper">
        @yield('table-header')
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">@yield('table-title')</h3>
                        </div>
                      @yield('data-list')
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection