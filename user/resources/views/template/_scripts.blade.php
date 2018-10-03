<!-- JS Global Compulsory -->
<script src="https://hrm.froid.works/front_assets/plugins/jquery/jquery.min.js"></script>
<script src="https://hrm.froid.works/front_assets/plugins/jquery/jquery-migrate.min.js"></script>
<script src="https://hrm.froid.works/front_assets/plugins/bootstrap/js/bootstrap.min.js"></script>

<!-- JS Implementing Plugins -->
<script src="https://hrm.froid.works/front_assets/plugins/back-to-top.js"></script>

<!-- Scrollbar -->
<script src="https://hrm.froid.works/front_assets/plugins/scrollbar/src/jquery.mousewheel.js"></script>
<script src="https://hrm.froid.works/front_assets/plugins/scrollbar/src/perfect-scrollbar.js"></script>
<!-- JS Customization -->
<script src="https://hrm.froid.works/front_assets//plugins/sky-forms/version-2.0.1/js/jquery-ui.min.js"></script>
<script src="https://hrm.froid.works/front_assets/plugins/sky-forms/version-2.0.1/js/jquery.form.min.js"></script>
<!-- JS Page Level -->
<script src="https://hrm.froid.works/front_assets/plugins/lib/moment.min.js"></script>
<script src="https://hrm.froid.works/front_assets/plugins/fullcalendar/fullcalendar.min.js"></script>
<script src="https://hrm.froid.works/assets/global/plugins/froiden-helper/helper.js"></script>

<script>
    jQuery(document).ready(function ($) {
        "use strict";
        $('.contentHolder').perfectScrollbar();



    });
</script>

<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>

<!--[if lt IE 9]>
<script src="https://hrm.froid.works/front_assets/plugins/respond.js"></script>
<script src="https://hrm.froid.works/front_assets/plugins/html5shiv.js"></script>

<![endif]-->
<script>

    $('#leave').datepicker({minDate: 0});
    $('.halfLeaveType').hide();
    var $insertBefore = $('#insertBefore');
    var $i = 0;

    $('#plusButton').click(function(){

        $i = $i+1;

        $(' <div class="row" id="row'+$i+'"> ' +
            '<div class="col-md-3"><label class="input"><i class="icon-append fa fa-calendar"></i><input type="text" name="date['+$i+']" id="leave'+$i+'" placeholder="Leave Date"></label></div>' +
            '<div class="col-md-2"><select class="form-control leaveType" id="leaveType" onchange="halfDayToggle(0,this.value)" name="leaveType[]"><option value="1">1</option><option value="Call Out">Call Out</option><option value="Late Start">Late Start</option><option value="Leave Early">Leave Early</option><option value="ghf">ghf</option></select></div>'+
            '<div class="col-md-2"><select class="form-control halfLeaveType" id="halfLeaveType" name="halfleaveType[]"><option value="1">1</option><option value="Call Out">Call Out</option><option value="Late Start">Late Start</option><option value="Leave Early">Leave Early</option><option value="ghf">ghf</option></select></div>'+
            '<div class="col-md-5"><input class="form-control form-control-inline" name="reason['+$i+']" type="text" value="" placeholder="Reason"/></div></div>').insertBefore($insertBefore);

        $("#row"+$i+" .leaveType").attr('id','leaveType'+$i);
        $("#row"+$i+" .halfLeaveType").hide();
        $("#row"+$i+" .halfLeaveType").attr('id','halfLeaveType'+$i);
        $("#row"+$i+" .leaveType").attr('onchange','halfDayToggle('+$i+',this.value)');

        $('#leave'+$i).datepicker({
            minDate: 0,
        });
    });

    function halfDayToggle(id,value)
    {
        if(value	==	'half day')
        {
            $('#halfLeaveType'+id).show(100);
        }else{
            $('#halfLeaveType'+id).hide(100);
        }
    }

    // Show change password modal body
    $('#change_password_link').click(function(){

        $('#change_password_modal_body').css("padding", "100px");
        $('#change_password_modal_body').html('<img src="https://hrm.froid.works/front_assets/img/loading-spinner-blue.gif">');
        $('#change_password_modal_body').attr('class','text-center');

        $.ajax({
            type: 'GET',
            url: "https://hrm.froid.works/change_password_modal",

            data: {

            },
            success: function(response) {

                $('#change_password_modal_body').css("padding", "0px");
                $('#change_password_modal_body').removeClass('text-center');
                $('#change_password_modal_body').html(response);
            },

            error: function(xhr, textStatus, thrownError) {
                $('#change_password_modal_body').html('<div class="alert alert-danger">Error Fetching data</div>');
            }
        });

    });


    function change_password() {
        $.easyAjax({
            type: 'POST',
            url: "https://hrm.froid.works/change_password",
            data: $('#change_password_form').serialize(),
            container: "#change_password_form",
            messagePosition: 'inline',
            success: function (response) {
                if (response.status == "success") {
                    $('#change_password_form')[0].reset();
                }
            }
        });
        return false;
    }
    function submitLeave() {

        $.easyAjax({
            type: 'POST',
            url: "https://hrm.froid.works/leave_store",
            data: $('#leave-form').serialize(),
            container: "#leave-form",
            messagePosition: 'inline',
        });
        return false;
    }
    //COMMENT VIEW ON QUESTION
    function showNotice(noticeID) {
        $('#showModal .modal-dialog').removeClass("modal-md").addClass("modal-lg");
        var url = "https://hrm.froid.works/admin/notice/:id";
        url = url.replace(':id', noticeID);
        $.ajaxModal('#showModal', url);
        $('#user_'+noticeID).removeClass('info');
        $('#contact_manager_'+noticeID).parent('li').removeClass('notification');
    }

</script>