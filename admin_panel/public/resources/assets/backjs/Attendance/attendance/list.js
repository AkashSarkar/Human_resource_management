$(function () {
    'use strict'
    $(document).ready(function () {

        // console.log(module_dash);
        // console.log(add_form_id);
        // console.log(module_prefix);
        var dataTable;
        var data = {
            _token: $('meta[name="csrf-token"]').attr('content')
        };

        var tableJselctor = $('#listDataTable');
        dataTable = $('#listDataTable').DataTable({
            "stateSave": true,
            "stateDuration": 60,
            "bAutoWidth": true,
            "lengthMenu": [
                [10, 100, 200],
                [10, 100, 200]
            ],
            "searching": true,
            "processing": true,
            "serverSide": true,
            "destroy": true,
            "orderCellsTop": true, "order": [[0, 'desc']],
            // "initComplete": customInitCompelte,
            // "drawCallback": customInitCompelete,
            "ajax": {
                'type': 'POST',
                'url': $("#" + module_prefix + "_datatable").val(),
                'data': data,
            },
            "columns": [
                {"data": "id", "sortable": false, "orderable": false, "searchable": false},
                {"data": "name"},
                {"data": "id", "sortable": false, "orderable": false, "searchable": false},
            ],
            "columnDefs": [
                {
                    "targets": 0,

                },
                {
                    "targets": 1,

                },
                {
                    "orderable": false,
                    "searchable": false,
                    "className": "",
                    "targets": 2,
                    "width": "10%",
                    'render': function (data, type, row, meta) {
                        var html = '';
                        html+='<input class="attendence" type="checkbox" value="'+row.id+'"/>'
                        // html+='<input type="hidden" />'
                        return html;


                    }
                }

            ]
        });
        //add
        $("#listDataTable tbody").on("click", ".attendence", function () {
            var b = $(this);
            let id=$(this).val();
            let check = $(this).is(':checked');
            if(check){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    url: $('#' + module_prefix + '_create').val(),
                    data: {
                        id: id
                    },
                    statusCode: customStatusCodeRes,
                    success: function (data) {
                    },
                    error: function (data) {

                    }
                });
            }else{
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'DELETE',
                    url: $('#' + module_prefix + '_delete').val()+'/'+id,
                    data: {
                        id: id
                    },
                    statusCode: customStatusCodeRes,
                    success: function (data) {
                    },
                    error: function (data) {

                    }
                });
            }


        });


    });

});




