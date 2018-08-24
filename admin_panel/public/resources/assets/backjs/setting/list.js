$(function () {
    'use strict'
    var pr=[];
    $(document).ready(function () {
        //initial pill active
        $('.ac').trigger('click');
        //edited row number get
        $(document).on('click', '.row_data', function(event)
        {
            $(this).addClass('bg-warning').css('padding','5px');
            $(this).focus();
            var tbl_row = $(this).closest('tr');
            var row_id = tbl_row.attr('id');
            var t=$(this).closest('td');
            row_id=Number(row_id);
            pr.push(row_id);
            pr=jQuery.unique(pr);
             // console.log(r);


            //    $('.row_data').keypress(function () {
            //        tbl_row.find('.'+row_id).each(function(index, val)
            //        {
            //            var col_name = $(this).attr('name');
            //            var col_val  =  $(this).html();
            //            arr[col_name] = col_val;
            //        });
            //
            //
            //    });
            // post_data.push(arr);


            // $('.row_data').keypress(function(event){
            //     //do something here
            //     alert(this.id);
            // }).focus();

            //console.log(arr);
        });

        $(document).on('click','.save', function(event){
            var post_data=[];
            $.each(pr, function( index, value ) {
                var arr = {};
                var edit_row = $('#'+value).closest('tr');

                edit_row.find('.'+value).each(function(index, val)
                {
                    // var col_name = '"'+$(this).attr('name')+'"';
                    var col_name = $(this).attr('name');
                    var col_val  =  $(this).html();
                    arr[col_name] = col_val;
                    // $(this).removeClass('bg-warning').css('padding','5px');
                    // $(this).addClass('bg-success').css('padding','5px');
                });
                post_data.push(arr);
            });
            var edit_list={};
            edit_list['posts']=post_data;
            console.log(edit_list);
            console.log("dd");
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'PATCH',
                url: $('#setting').val(),
                data: edit_list,
                statusCode: customStatusCodeRes,
                success: function (res) {
                    console.log(res);
                },
                error: function (res) {
                   // console.log('error');
                }
            });

        });

    });

});


