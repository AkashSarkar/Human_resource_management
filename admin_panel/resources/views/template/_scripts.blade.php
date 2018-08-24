<!-- jQuery 3 -->
<script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
<script src="{{asset('resources/assets/plugins/jquery-growl/javascripts/jquery.growl.js')}}"></script>
<!-- Sparkline -->
{{--<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>--}}
<!-- jvectormap  -->
{{--<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>--}}
{{--<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>--}}
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS -->
{{--<script src="bower_components/chart.js/Chart.js"></script>--}}
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
{{--<script src="dist/js/pages/dashboard2.js"></script>--}}
<!-- AdminLTE for demo purposes -->
{{--<script src="dist/js/demo.js"></script>--}}
<script>
    let customStatusCodeRes = {
        200: function (res) {
            console.log(res)
            if (Array.isArray(res.message)) {
                for (let i = 0; i < res.message.length; i++) {
                    $.growl.notice({
                        title: res.title,
                        message: res.message[i]
                    });
                }
            } else {
                $.growl.notice({
                    title: res.title,
                    message: res.message
                });
            }

        },
        201: function (res) {
            console.log(res)
            $.growl.notice({title: res.title, message: res.message});
        },
        400: function (res) {
            console.log(res)
            $.growl.error({title: res.title, message: res.statusText});
        },
        403: function (res) {
            console.log(res)
            $.growl.error({title: res.title, message: res.statusText});
        },
        404: function (res) {
            console.log(res)
            $.growl.error({title: res.title, message: res.statusText});
        },
        422: function (res) {
            console.log(res);
            if (typeof res.responseJSON.message == "string") {
                $.growl.error({title: res.responseJSON.title, message: res.responseJSON.message});
            } else {
                $.growl.error({title: res.title, message: res.statusText});
            }
        },
        500: function (res) {
            console.log(res)
            if (typeof res.responseJSON != "undefined") {
                if (typeof res.responseJSON.message == "string") {
                    $.growl.error({title: res.responseJSON.title, message: res.responseJSON.message});
                } else {
                    $.growl.error({title: res.title, message: res.statusText});
                }
            } else {
                $.growl.error({title: res.title, message: res.statusText});
            }
        }
    }

    function errorForm(data, form_id) {
        let errors = data.responseJSON;
        $.each(errors['message'], function (index, value) {
            $('#' + form_id + ' .eMsg_' + index).html(value[0]);
            $('#' + form_id + ' .eMsg_' + index).closest(".form-group").addClass("has-error");
        });
    }
</script>
<script>
    (function ($) {

        // match anything
        $.expr[":"].containsNoCase = function (el, i, m) {
            var search = m[3];
            if (!search) return false;
            return new RegExp(search, "i").test($(el).text());
        };

        // Search Filter
        function searchFilterCallBack($data, $opt) {
            var search = $data instanceof jQuery ? $data.val() : $(this).val(),
                opt = typeof $opt == 'undefined' ? $data.data.opt : $opt;

            var $target = $(opt.targetSelector);
            $target.show();

            if (search && search.length >= opt.charCount) {
                $target.not(":containsNoCase(" + search + ")").hide();
            }
        }

        // input filter
        $.fn.searchFilter = function (options) {
            var opt = $.extend({
                // target selector
                targetSelector: "",
                // number of characters before search is applied
                charCount: 1
            }, options);

            return this.each(function () {
                var $el = $(this);
                $el.off("keyup", searchFilterCallBack);
                $el.on("keyup", null, {opt: opt}, searchFilterCallBack);
            });

        };

        // Trigger Search Filter
        $(".menu-list-search input").searchFilter({targetSelector: ".menu-list-filter li"});

    })(jQuery);
</script>
<script>
    $(".menu-list-search input").searchFilter({targetSelector: ".menu-list-filter li"});
</script>
