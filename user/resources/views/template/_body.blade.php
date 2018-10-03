<!--=== Profile ===-->
<div class="profile container content">
    <div class="row">
        <!--Left Sidebar-->
        <div class="col-md-3 md-margin-bottom-40">

            <img class="img-responsive profile-img margin-bottom-20"
                 src="https://www.gravatar.com/avatar/0500b2ab42f89e6307060d3f45458c97?d=mm&amp;s=250" alt="">
            <p>
            <h3 style="text-align: center"> {{ Auth::user()->name }}</h3>
            {{--<h6 style="text-align: center">Senior PHP Developer</h6>--}}
            <h6 style="text-align: center;background: rgb(235, 235, 235);padding: 10px;"><strong>Member
                    since</strong> {{ Auth::user()->created_at }}</h6>
            </p>
            <hr>
            <div class="service-block-v3 service-block-u">
                <!-- STAT -->
                <div class="row profile-stat">
                    <div class="col-md-4 col-sm-4 col-xs-6" data-toggle="tooltip" data-placement="bottom"
                         title="October">
                        <div class="uppercase profile-stat-title">
                            {{$attendance}}
                        </div>
                        <div class="uppercase profile-stat-text">
                            Attendance
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-6" data-toggle="tooltip" data-placement="bottom"
                         title="Leaves">
                        <div class="uppercase profile-stat-title">
                            <?php
                            $str = strtotime($last_leave->date);
                            $day = date('d', $str);
                            $month = date('m', $str);
                            $year = date('Y', $str);
                            $leave = $day . "/" . $month;
                            ?>
                            {{$last_leave? $leave:"None"}}
                        </div>
                        <div class="uppercase profile-stat-text">
                            Leave
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-6" data-toggle="tooltip" data-placement="bottom"
                         title="Total Award Won">
                        <div class="uppercase profile-stat-title">
                            {{$numOfAwards}}
                        </div>
                        <div class="uppercase profile-stat-text">
                            Awards
                        </div>
                    </div>
                </div>
                <!-- END STAT -->
            </div>


            <!--Notification-->
            <!--End Notification-->


            <div class="margin-bottom-50"></div>
        </div>
        <!--End Left Sidebar-->


        <div class="col-md-9">
            <!--Profile Body-->
            <div class="profile-body">
                <div class="row margin-bottom-20">
                    <!--Profile Post-->
                    <div class="col-sm-6">
                        @include('layouts.personal_details.personal')

                        <div class="panel panel-profile no-bg margin-top-20">
                            <div class="panel-heading overflow-h">
                                <h2 class="panel-title heading-sm pull-left"><i class="fa fa-briefcase"></i>Company
                                    Details</h2>
                            </div>
                            <div class="panel-body panelHolder">
                                <table class="table table-light margin-bottom-0">
                                    <tbody>
                                    <tr>
                                        <td>
                                            <span class="primary-link">Employee ID</span>
                                        </td>
                                        <td>
                                            {{Auth::user()->id}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="primary-link">Department</span>
                                        </td>
                                        <td>
                                            {{$employee? $employee->department:" "}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="primary-link">Designation</span>
                                        </td>
                                        <td>
                                            {{$employee? $employee->designation:" "}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="primary-link">Date of Joining</span>
                                        </td>
                                        <td>
                                            {{$employee? $employee->doj:""}}

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="primary-link">Salary ( <i class="fa fa-inr"></i> )</span>
                                        </td>
                                        <td>

                                            <p> {{$employee? $employee->salary:''}}
                                                <i class="fa fa-inr"></i></p>


                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="panel panel-profile no-bg margin-top-20">
                            <div class="panel-heading overflow-h">
                                <h2 class="panel-title heading-sm pull-left"><i class="fa fa-pencil"></i>Bank Details
                                </h2>
                            </div>
                            <div class="panel-body panelHolder">
                                <table class="table table-light margin-bottom-0">
                                    <tbody>
                                    <tr>
                                        <td>
                                            <span class="primary-link">Account Holder Name</span>
                                        </td>
                                        <td>
                                            {{$bank?$bank->ac_name:" "}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="primary-link">Account Number</span>
                                        </td>
                                        <td>
                                            {{$bank? $bank->ac_number:" "}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="primary-link">Bank Name</span>
                                        </td>
                                        <td>
                                            {{$bank? $bank->bank:" "}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="primary-link">PAN Number</span>
                                        </td>
                                        <td>
                                            {{$bank?$bank->pan:" "}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="primary-link">IFSC Code</span>
                                        </td>
                                        <td>
                                            {{$bank?$bank->ifsc:" "}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="primary-link">Branch</span>
                                        </td>
                                        <td>
                                            {{$bank?$bank->branch:" "}}
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!--End Profile Post-->

                    <!--Notice Board -->
                    <div class="col-sm-6 md-margin-bottom-20">
                        <div class="panel panel-profile no-bg">
                            <div class="panel-heading overflow-h">
                                <h2 class="panel-title heading-sm pull-left"><i class="fa fa-bullhorn"></i>Notice Board
                                </h2>
                            </div>
                            <div id="scrollbar2" class="panel-body contentHolder">
                                @if($notices)
                                    @foreach($notices as $notice)
                                        <div class="profile-event">
                                            <div class="date-formats">
                                                <?php
                                                $str = strtotime($notice->created_at);
                                                $day = date('d', $str);
                                                $month = date('m', $str);
                                                $year = date('Y', $str);
                                                ?>
                                                <span>{{$day}}</span>
                                                <small>{{$month}},{{$year}}</small>
                                            </div>
                                            <div class="overflow-h">
                                                <h3 class="heading-xs"><a href="javascript:;">{{$notice->title}}.</a>
                                                </h3>
                                                <p>{{$notice->description}}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif

                            </div>
                        </div>

                        <div class="panel panel-profile margin-top-20">
                            <div class="panel-heading overflow-h">
                                <h2 class="panel-title heading-sm pull-left"><i class="fa fa-send"></i> Upcoming
                                    Holidays</h2>
                            </div>
                            <div id="scrollbar3" class="panel-body contentHolder">
                                @if($holidays)
                                    @foreach($holidays as $holiday)
                                        <div class="profile-event">
                                            <div class="date-formats">
                                                <?php
                                                $str = strtotime($holiday->day);
                                                $day = date('d', $str);
                                                $month = date('m', $str);
                                                $year = date('Y', $str);
                                                ?>
                                                <span>{{$day}}</span>
                                                <small>{{$month}},{{$year}}</small>
                                            </div>
                                            <div class="overflow-h">
                                                <h3 class="heading-xs"><a href="javascript:;">{{$holiday->event}}.</a>
                                                </h3>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        <div class="panel panel-profile margin-top-20">
                            <div class="panel-heading overflow-h">
                                <h2 class="panel-title heading-sm pull-left"><i class="fa fa-trophy"></i> Awards</h2>
                            </div>
                            <div id="scrollbar3" class="panel-body contentHolder">
                                @if($awards)
                                    @foreach($awards as $award)
                                        <div class="profile-event">
                                            <div class="date-formats">
                                                <?php
                                                $str = strtotime($holiday->day);
                                                $month = date('M', $str);
                                                $year = date('Y', $str);
                                                ?>
                                                <span>{{$month}}</span>
                                                <small>{{$year}}</small>
                                            </div>
                                            <div class="overflow-h">
                                                <h3 class="heading-xs"><a href="javascript:;">{{$award->award}}</a></h3>
                                                <p>Gift: {{$award->gift}}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif

                            </div>
                        </div>
                    </div>
                    <!--End Profile Event-->

                </div><!--/end row-->

                <hr>

                <!--Profile Blog-->
                <div class="panel panel-profile">
                    <div class="panel-heading overflow-h">
                        <h2 class="panel-title heading-sm pull-left"><i class="fa fa-tasks"></i>My leaves</h2>
                    </div>
                    <div class="panel-body panelHolder">

                        <div class="alert-blocks alert-blocks-info">
                            <div class="overflow-h">
                                <strong class="color-dark">Last absent
                                    <small class="pull-right"><em>22-Oct-2018</em></small>
                                </strong>
                                <small class="award-name">-19 day ago</small>
                            </div>
                        </div>

                        <div id='calendar'></div>

                    </div>
                </div><!--/end row-->
                <!--End Profile Blog-->

            </div>
            <!--End Profile Body-->
        </div>


        <div class="modal fade show_notice in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                        <h4 id="myLargeModalLabel" class="modal-title show-notice-title">

                        </h4>
                    </div>
                    <div class="modal-body" id="show-notice-body">

                    </div>
                </div>
            </div>
        </div>


    </div><!--/end row-->


</div>
<!--=== End Profile ===-->

<div class="modal fade apply_modal in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 id="myLargeModalLabel" class="modal-title">
                    Apply Leave
                </h4>
            </div>
            <div class="modal-body">
                <div class="portlet-body form">

                    <!------------------------------ BEGIN FORM ----------------------------------------->
                    <form method="POST" action="{{url('leave')}}" accept-charset="UTF-8" class="sky-form"
                          id="leave-form">

                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label class="input">
                                    <i class="icon-append fa fa-calendar"></i>
                                    <input type="text" name="date" id="leave" placeholder="Leave date">
                                </label>
                            </div>
                            <div class="col-md-2 form-group">
                                <select class="form-control leaveType" id="leaveType0"
                                        onchange="halfDayToggle(0,this.value)" name="leaveType">
                                    @if($leave_types)
                                        @foreach($leave_types as  $leave_type)
                                            <option value="{{$leave_type->id}}">{{$leave_type->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-5 form-group">
                                <input class="form-control form-control-inline" type="text" name="reason"
                                       placeholder="Reason"/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-offset-4 col-md-8">
                                <button type="submit" class="btn-u btn-u-sea"><i class="fa fa-check"></i> Submit
                                </button>
                            </div>

                        </div>
                    </form>
                    <!------------------------ END FORM ------------------------------------------>
                </div>
            </div>
        </div>
    </div>
</div>

