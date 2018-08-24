<!DOCTYPE html>
<html>
<head>
    <link rel="shortcut icon" type="image/x-icon"
          href="http://localhost:8000/resources/images/activity-history.png">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="dt-example dt-example-bootstrap">
<div class="container">
    <section>
        <h1>Activity History <span>BackEnd</span></h1>
        <table id="activityhistory" class="table table-striped table-bordered" cellspacing="0" width="100%">

        </table>
    </section>
</div>
</body>
<script src="//code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
<style>
    td.details-control {
        background: url('../resources/details_open.png') no-repeat center center;
        cursor: pointer;
    }

    tr.shown td.details-control {
        background: url('../resources/details_close.png') no-repeat center center;
    }
</style>
<script>
    $(document).ready(function () {
        var data = {
            _token: $('meta[name="csrf-token"]').attr('content')
        };
        var errorTable = $('#activityhistory').DataTable({
//            "scrollX": true,
            "bAutoWidth": true,
            "lengthMenu": [
                [10, 25, 50, 100],
                [10, 25, 50, 100]
            ],
            "searching": true,
            "processing": true,
            "serverSide": true,
            "destroy": true,
            "ajax": {
                'type': 'POST',
                'url': $("#base_url").val() + '/activity-history/datatable',
                'data': data
            },
            "order": [1],
            "columns": [
                {},
                {"data": "id", "title": "ID"},
                {"data": "description", "title": "Message"},
                {"data": "action", "title": "Action"},
                {"data": "module_name", "title": "Module"},
                {"data": "created_at", "title": "Created"},
            ],
            "sDom": '<"dt_top" <"dt_left"f><"dt_right"l><"clear">>rt<"dt_bottom" <"dt_left"i><"dt_right"p><"clear">>',
            "columnDefs": [{
                "orderable": false,
                "searchable": false,
                "className": "",
                "targets": 0,
                "data": null,
                'render': function (data, type, row, meta) {
                    return '<input type="checkbox">';
                }
            },
            ],
        });

    });


</script>
</html>
