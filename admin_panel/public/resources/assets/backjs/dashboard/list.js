$(function () {
    'use strict'
    $(document).ready(function () {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'GET',
            url: $('#posts').val(),
            success: function (data) {
                // console.log(data);
                $("#total_posts").append( data['posts']);
                $("#total_status").append( data['status']);
                $("#total_events").append( data['event']);
                $("#total_awards").append( data['award']);
                $("#total_articles").append( data['article']);
                $("#total_conferences").append( data['conference']);
                $("#total_promotions").append( data['promotion']);
                $("#total_projects").append( data['project']);
                // $("#total_status_bar").css( 'width',(data['status']/data['posts'])*100+'%');
            },
            error: function (data) {
                console.log('error');
            }
        });

    });

});


