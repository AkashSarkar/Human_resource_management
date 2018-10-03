<!--=== Profile ===-->
<div class="profile container content">
    <div class="row">
        <!--Left Sidebar-->
        <div class="col-md-3 md-margin-bottom-40">

            <img class="img-responsive profile-img margin-bottom-20" src="https://www.gravatar.com/avatar/0500b2ab42f89e6307060d3f45458c97?d=mm&amp;s=250" alt="">
            <p>
            <h3 style="text-align: center"> {{ Auth::user()->name }}</h3>
            {{--<h6 style="text-align: center">Senior PHP Developer</h6>--}}
            <h6 style="text-align: center;background: rgb(235, 235, 235);padding: 10px;"><strong>Member since</strong> {{ Auth::user()->created_at }}</h6>
            </p>
            <hr>
            <div class="service-block-v3 service-block-u">
                <!-- STAT -->
                <div class="row profile-stat">
                    <div class="col-md-4 col-sm-4 col-xs-6" data-toggle="tooltip" data-placement="bottom" title="October">
                        <div class="uppercase profile-stat-title">
                            0
                        </div>
                        <div class="uppercase profile-stat-text">
                            Attendance
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-6" data-toggle="tooltip" data-placement="bottom" title="Leaves">
                        <div class="uppercase profile-stat-title">
                            2/22
                        </div>
                        <div class="uppercase profile-stat-text">
                            Leave
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-6" data-toggle="tooltip" data-placement="bottom" title="Total Award Won">
                        <div class="uppercase profile-stat-title">
                            1
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
                                <h2 class="panel-title heading-sm pull-left"><i class="fa fa-briefcase"></i>Company Details</h2>
                            </div>
                            <div class="panel-body panelHolder">
                                <table class="table table-light margin-bottom-0">
                                    <tbody>
                                    <tr>
                                        <td>
                                            <span class="primary-link">Employee ID</span>
                                        </td>
                                        <td>
                                            585676564
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="primary-link">Department</span>
                                        </td>
                                        <td>
                                            PHP
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="primary-link">Designation</span>
                                        </td>
                                        <td>
                                            Senior PHP Developer
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="primary-link">Date of Joining</span>
                                        </td>
                                        <td>
                                            25-Apr-2018
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="primary-link">Salary ( <i class="fa fa-inr"></i> )</span>
                                        </td>
                                        <td>

                                            <p>hy : 12000000 <i class="fa fa-inr"></i> </p>


                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="panel panel-profile no-bg margin-top-20">
                            <div class="panel-heading overflow-h">
                                <h2 class="panel-title heading-sm pull-left"><i class="fa fa-pencil"></i>Bank Details</h2>
                            </div>
                            <div class="panel-body panelHolder">
                                <table class="table table-light margin-bottom-0">
                                    <tbody>
                                    <tr>
                                        <td>
                                            <span class="primary-link">Account Holder Name</span>
                                        </td>
                                        <td>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="primary-link">Account Number</span>
                                        </td>
                                        <td>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="primary-link">Bank Name</span>
                                        </td>
                                        <td>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="primary-link">PAN Number</span>
                                        </td>
                                        <td>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="primary-link">IFSC Code</span>
                                        </td>
                                        <td>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="primary-link">Branch</span>
                                        </td>
                                        <td>

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
                                <h2 class="panel-title heading-sm pull-left"><i class="fa fa-bullhorn"></i>Notice Board</h2>
                            </div>
                            <div id="scrollbar2" class="panel-body contentHolder">
                                <div class="profile-event">
                                    <div class="date-formats">
                                        <span>21</span>
                                        <small>09, 2018</small>
                                    </div>
                                    <div class="overflow-h">
                                        <h3 class="heading-xs" onclick="showNotice(9);return false;"><a  href="javascript:;" >Knave, &#039;I didn&#039;t know it to.</a></h3>
                                        <p>Alice thought this must ever be A secret, kept from all the things I used to it as far down the middle, wondering how she was saying, and the White Rabbit, with a large pigeon had flown into her.</p>
                                    </div>
                                </div>
                                <div class="profile-event">
                                    <div class="date-formats">
                                        <span>21</span>
                                        <small>09, 2018</small>
                                    </div>
                                    <div class="overflow-h">
                                        <h3 class="heading-xs" onclick="showNotice(10);return false;"><a  href="javascript:;" >Mouse, sharply and very soon.</a></h3>
                                        <p><p>Alice. 'And where HAVE my shoulders got to? And oh, I wish you wouldn't squeeze so.' said the Gryphon. 'They can't have anything to say, she simply bowed, and took the watch and looked at it, and.</p></p>
                                    </div>
                                </div>
                                <div class="profile-event">
                                    <div class="date-formats">
                                        <span>21</span>
                                        <small>09, 2018</small>
                                    </div>
                                    <div class="overflow-h">
                                        <h3 class="heading-xs" onclick="showNotice(1);return false;"><a  href="javascript:;" >Queen was silent. The King.</a></h3>
                                        <p>Hatter. He had been looking at Alice for protection. 'You shan't be able! I shall remember it in her life, and had come to the waving of the Lizard's slate-pencil, and the fan, and skurried away.</p>
                                    </div>
                                </div>
                                <div class="profile-event">
                                    <div class="date-formats">
                                        <span>21</span>
                                        <small>09, 2018</small>
                                    </div>
                                    <div class="overflow-h">
                                        <h3 class="heading-xs" onclick="showNotice(2);return false;"><a  href="javascript:;" >There ought to be trampled.</a></h3>
                                        <p>Alice. 'And ever since that,' the Hatter hurriedly left the court, arm-in-arm with the next moment a shower of saucepans, plates, and dishes. The Duchess took her choice, and was coming back to the.</p>
                                    </div>
                                </div>
                                <div class="profile-event">
                                    <div class="date-formats">
                                        <span>21</span>
                                        <small>09, 2018</small>
                                    </div>
                                    <div class="overflow-h">
                                        <h3 class="heading-xs" onclick="showNotice(3);return false;"><a  href="javascript:;" >She stretched herself up.</a></h3>
                                        <p>March Hare,) '--it was at the mouth with strings: into this they slipped the guinea-pig, head first, and then keep tight hold of anything, but she did not seem to see what would happen next. First.</p>
                                    </div>
                                </div>
                                <div class="profile-event">
                                    <div class="date-formats">
                                        <span>21</span>
                                        <small>09, 2018</small>
                                    </div>
                                    <div class="overflow-h">
                                        <h3 class="heading-xs" onclick="showNotice(4);return false;"><a  href="javascript:;" >In a little hot tea upon its.</a></h3>
                                        <p>Bill! the master says you're to go nearer till she heard the Rabbit actually TOOK A WATCH OUT OF ITS WAISTCOAT-POCKET, and looked at Alice, and she jumped up in a very deep well. Either the well was.</p>
                                    </div>
                                </div>
                                <div class="profile-event">
                                    <div class="date-formats">
                                        <span>21</span>
                                        <small>09, 2018</small>
                                    </div>
                                    <div class="overflow-h">
                                        <h3 class="heading-xs" onclick="showNotice(5);return false;"><a  href="javascript:;" >Alice, &#039;to pretend to be two.</a></h3>
                                        <p>Caterpillar. Alice folded her hands, wondering if anything would EVER happen in a great crash, as if it makes rather a complaining tone, 'and they drew all manner of things--everything that begins.</p>
                                    </div>
                                </div>
                                <div class="profile-event">
                                    <div class="date-formats">
                                        <span>21</span>
                                        <small>09, 2018</small>
                                    </div>
                                    <div class="overflow-h">
                                        <h3 class="heading-xs" onclick="showNotice(6);return false;"><a  href="javascript:;" >I wonder what they said. The.</a></h3>
                                        <p>Dinah, if I would talk on such a curious dream, dear, certainly: but now run in to your tea; it's getting late.' So Alice got up very carefully, with one finger for the pool was getting so far off)..</p>
                                    </div>
                                </div>
                                <div class="profile-event">
                                    <div class="date-formats">
                                        <span>21</span>
                                        <small>09, 2018</small>
                                    </div>
                                    <div class="overflow-h">
                                        <h3 class="heading-xs" onclick="showNotice(7);return false;"><a  href="javascript:;" >Poor Alice! It was all.</a></h3>
                                        <p>Pigeon; 'but if you've seen them at dinn--' she checked herself hastily, and said 'What else had you to learn?' 'Well, there was a little recovered from the sky! Ugh, Serpent!' 'But I'm not myself.</p>
                                    </div>
                                </div>
                                <div class="profile-event">
                                    <div class="date-formats">
                                        <span>21</span>
                                        <small>09, 2018</small>
                                    </div>
                                    <div class="overflow-h">
                                        <h3 class="heading-xs" onclick="showNotice(8);return false;"><a  href="javascript:;" >Here the other paw, &#039;lives a.</a></h3>
                                        <p>She waited for some way, and nothing seems to like her, down here, that I should say what you mean,' said Alice. 'That's very curious.' 'It's all his fancy, that: they never executes nobody, you.</p>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="panel panel-profile margin-top-20">
                            <div class="panel-heading overflow-h">
                                <h2 class="panel-title heading-sm pull-left"><i class="fa fa-send"></i> Upcoming Holidays</h2>
                            </div>
                            <div id="scrollbar3" class="panel-body contentHolder">

                            </div>
                        </div>

                        <div class="panel panel-profile margin-top-20">
                            <div class="panel-heading overflow-h">
                                <h2 class="panel-title heading-sm pull-left"><i class="fa fa-trophy"></i> Awards</h2>
                            </div>
                            <div id="scrollbar3" class="panel-body contentHolder">

                                <div class="alert-blocks">
                                    <div class="overflow-h">
                                        <strong class="color-dark"><small class="pull-right"><em>June 2014</em></small></strong>
                                        <small class="award-name">Employee of the Month</small>
                                    </div>
                                </div>
                                <div class="alert-blocks">
                                    <div class="overflow-h">
                                        <strong class="color-dark"><small class="pull-right"><em>August 2014</em></small></strong>
                                        <small class="award-name">Employee of the Month</small>
                                    </div>
                                </div>
                                <div class="alert-blocks">
                                    <div class="overflow-h">
                                        <strong class="color-dark"><small class="pull-right"><em>June 2014</em></small></strong>
                                        <small class="award-name">Employee of the Month</small>
                                    </div>
                                </div>
                                <div class="alert-blocks">
                                    <div class="overflow-h">
                                        <strong class="color-dark"><small class="pull-right"><em>December 2014</em></small></strong>
                                        <small class="award-name">Employee of the Month</small>
                                    </div>
                                </div>
                                <div class="alert-blocks">
                                    <div class="overflow-h">
                                        <strong class="color-dark"><small class="pull-right"><em>January 2014</em></small></strong>
                                        <small class="award-name">Employee of the Month</small>
                                    </div>
                                </div>
                                <div class="alert-blocks">
                                    <div class="overflow-h">
                                        <strong class="color-dark"><small class="pull-right"><em>September 2014</em></small></strong>
                                        <small class="award-name">Employee of the Month</small>
                                    </div>
                                </div>
                                <div class="alert-blocks">
                                    <div class="overflow-h">
                                        <strong class="color-dark"><small class="pull-right"><em>December 2014</em></small></strong>
                                        <small class="award-name">Employee of the Month</small>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                    <!--End Profile Event-->

                </div><!--/end row-->

                <hr>

                <!--Profile Blog-->
                <div class="panel panel-profile">
                    <div class="panel-heading overflow-h">
                        <h2 class="panel-title heading-sm pull-left"><i class="fa fa-tasks"></i>Attendance</h2>
                    </div>
                    <div class="panel-body panelHolder">

                        <div class="alert-blocks alert-blocks-info">
                            <div class="overflow-h">
                                <strong class="color-dark">Last absent <small class="pull-right"><em>22-Oct-2018</em></small></strong>
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







        <div class="modal fade show_notice in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                        <h4 id="myLargeModalLabel" class="modal-title show-notice-title" >

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