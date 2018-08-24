<!DOCTYPE html>
<html>
<head>
    <link rel="shortcut icon" type="image/x-icon"
          href="{{asset("resources/images/errorr.png")}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="dt-example dt-example-bootstrap">
<div class="container">
    <section>
        <h1>Error List <span>BackEnd/FrontEnd</span></h1>
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        <a href="{{route('errorr/delete')}}" class="btn btn-danger">Delete All Log</a>

        <table id="errorr" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th><input type="checkbox" class="flowcheckall" name="flowcheckall"></th>
                <th>ID</th>
                <th></th>
                <th>File</th>
                <th>Function</th>
                <th>Line</th>
                <th>Mem</th>
                <th>Sec</th>
                <th>Source</th>
                <th>Created</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th><input type="checkbox" class="flowcheckall" name="flowcheckall"></th>
                <th>ID</th>
                <th></th>
                <th>File</th>
                <th>Function</th>
                <th>Line</th>
                <th>Mem</th>
                <th>Sec</th>
                <th>Source</th>
                <th>Created</th>
            </tr>
            </tfoot>
        </table>
    </section>
    <input type="hidden" id="errorR_baseurl" value="{{url("/")}}">
</div>
</body>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>

<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.1/js/responsive.bootstrap.min.js"></script>

<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" type="text/css"
      href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.bootstrap.min.css">
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
        var errorTable = $('#errorr').DataTable({
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
                'url': $("#errorR_baseurl").val() + '/errorr/datatable',
                'data': data
            },
            "order": [1],
            "columns": [
                {},
                {"data": "id"},
                {},
                {"data": "file_name"},
                {"data": "function_name"},
                {"data": "line_number"},
                {"data": "memory"},
                {"data": "seconds"},
                {"data": "source"},
                {"data": "created_at"},
            ],
            "sDom": '<"dt_top" <"dt_left"f><"dt_right"l><"clear">>rt<"dt_bottom" <"dt_left"i><"dt_right"p><"clear">>',
            "columnDefs": [
                {
                    "orderable": false,
                    "searchable": false,
                    "className": "",
                    "targets": 0,
                    "data": null,
                    'render': function (data, type, row, meta) {
                        return '<input type="checkbox">';
                    }
                },
                {
                    "targets": 2,
                    "className": 'details-control',
                    "orderable": false,
                    "data": null,
                    "defaultContent": ''
                },
            ],
        });
        // Add event listener for opening and closing details
        $('#errorr tbody').on('click', 'td.details-control', function () {
            var tr = $(this).closest('tr');
            var row = errorTable.row(tr);

            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            }
            else {
                // Open this row
                row.child(format(row.data())).show();
                tr.addClass('shown');
            }
        });
    });

    /* Formatting function for row details - modify as you need */
    function format(d) {
        // `d` is the original data object for the row
        return '<table cellpadding="9" cellspacing="0" border="0" style="padding-left:50px;">' +
            '<tr>' +
            '<td>Message:</td>' +
            '<td>' + d.message + '</td>' +
            '</tr>' +

            '<tr>' +
            '<td>Source File:</td>' +
            '<td>' + d.caller_file_name + '</td>' +
            '</tr>' +

            '<tr>' +
            '<td>Source Line:</td>' +
            '<td>' + d.caller_line_number + '</td>' +
            '</tr>' +
            '</table>';
    }
</script>
</html>
