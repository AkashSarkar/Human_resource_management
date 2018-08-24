@extends('layouts.master')
@section('content')
    <div class="content-wrapper">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
    @endif
    <!-- Content Header (Page header) -->
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Dashboard
                <small>Preview page</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Widgets</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- =========================================================== -->

            <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-aqua">
                        <span class="info-box-icon"><i class="fa  fa-newspaper-o"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Share</span>
                            <span class="info-box-number"></span>

                            <div class="progress">
                                {{--<div class="progress-bar" style="width: 70%"></div>--}}
                            </div>
                            <span class="progress-description">
                    {{--70% Increase in 30 Days--}}
                  </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-green">
                        <span class="info-box-icon"><i class="fa fa-thumbs-o-up"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Likes</span>
                            <span class="info-box-number">41,410</span>

                            <div class="progress">
                                {{--<div class="progress-bar" style="width: 70%"></div>--}}
                            </div>
                            <span class="progress-description">
                    {{--70% Increase in 30 Days--}}
                  </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-yellow">
                        <span class="info-box-icon"><i class="fa fa-calendar"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Events</span>
                            <span class="info-box-number">41,410</span>

                            <div class="progress">
                                <div class="progress-bar" style="width: 70%"></div>
                            </div>
                            <span class="progress-description">
                    70% Increase in 30 Days
                  </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-red">
                        <span class="info-box-icon"><i class="fa fa-comments-o"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Comments</span>
                            <span class="info-box-number">41,410</span>

                            <div class="progress">
                                {{--<div class="progress-bar" style="width: 70%"></div>--}}
                            </div>
                            <span class="progress-description">
                    {{--70% Increase in 30 Days--}}
                  </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <!-- =========================================================== -->
            {{--posts--}}
            <h2 class="text-primary">Posts</h2>
            <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-aqua">
                        <span class="info-box-icon"><i class="fa  fa-id-card-o"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Posts</span>
                            <span class="info-box-number" id="total_posts"></span>

                            <div class="progress">
                                <div class="progress-bar" id="total_posts_bar" style="width: 100%"></div>
                            </div>
                            <span class="progress-description">
                    {{--70% Increase in 30 Days--}}
                  </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-green">
                        <span class="info-box-icon"><i class="fa fa-list-alt"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Status</span>
                            <span class="info-box-number" id="total_status"></span>

                            <div class="progress">
                                <div class="progress-bar" id="total_status_bar" style="width: 70%"></div>
                            </div>
                            <span class="progress-description">
                    {{--70% Increase in 30 Days--}}
                  </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-yellow">
                        <span class="info-box-icon"><i class="fa fa-calendar"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Events</span>
                            <span class="info-box-number" id="total_events"></span>

                            <div class="progress">
                                {{--<div class="progress-bar" style="width: 70%"></div>--}}
                            </div>
                            <span class="progress-description">
                    {{--70% Increase in 30 Days--}}
                  </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-red">
                        <span class="info-box-icon"><i class="fa  fa-trophy"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Awards</span>
                            <span class="info-box-number" id="total_awards"></span>

                            <div class="progress">
                                {{--<div class="progress-bar" style="width: 70%"></div>--}}
                            </div>
                            <span class="progress-description">
                    {{--70% Increase in 30 Days--}}
                  </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- =========================================================== -->
            <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-olive">
                        <span class="info-box-icon"><i class="fa  fa-puzzle-piece"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Promotions</span>
                            <span class="info-box-number" id="total_promotions"></span>

                            <div class="progress">
                                {{--<div class="progress-bar" style="width: 70%"></div>--}}
                            </div>
                            <span class="progress-description">
                    {{--70% Increase in 30 Days--}}
                  </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-purple">
                        <span class="info-box-icon"><i class="fa  fa-id-card-o"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Article</span>
                            <span class="info-box-number" id="total_articles"></span>

                            <div class="progress">
                                {{--<div class="progress-bar" style="width: 70%"></div>--}}
                            </div>
                            <span class="progress-description">
                    {{--70% Increase in 30 Days--}}
                  </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-maroon">
                        <span class="info-box-icon"><i class="fa fa-users"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Conference</span>
                            <span class="info-box-number" id="total_conferences"></span>

                            <div class="progress">
                                {{--<div class="progress-bar" style="width: 70%"></div>--}}
                            </div>
                            <span class="progress-description">
                    {{--70% Increase in 30 Days--}}
                  </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-teal">
                        <span class="info-box-icon"><i class="fa  fa-cloud"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Projects</span>
                            <span class="info-box-number" id="total_projects"></span>

                            <div class="progress">
                                {{--<div class="progress-bar" style="width: 70%"></div>--}}
                            </div>
                            <span class="progress-description">
                    {{--70% Increase in 30 Days--}}
                  </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        {{--end posts--}}
        <!-- =========================================================== -->
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>150</h3>

                            <p>New Orders</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-shopping-cart"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            More info <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3>53<sup style="font-size: 20px">%</sup></h3>

                            <p>Bounce Rate</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            More info <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3>44</h3>

                            <p>User Registrations</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            More info <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3>65</h3>

                            <p>Unique Visitors</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            More info <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->

        </section>
        <!-- /.content -->

        <!-- /.content-wrapper -->
        <!-- /.content -->


        <!--script calling from list.js-->
        <input type="hidden" id="posts" value="{{route('total-post')}}">
    </div>
@endsection
@push('scripts')
    {{--ajax script--}}
    <script src="{{asset("resources/assets/backjs/dashboard/list.js")}}"></script>
@endpush