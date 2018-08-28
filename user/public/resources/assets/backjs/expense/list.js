$(function () {
    'use strict'
    $(document).ready(function () {

        console.log(module_dash);
        console.log(add_form_id);
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
                'url': $("#expense_datatable").val(),
                'data': data,
            },
            "columns": [
                {"data": "id", "sortable": false, "orderable": false, "searchable": false},
                {"data": "item"},
                {"data": "purchase_from"},
                {"data": "purchase_date"},
                {"data": "price"},
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
                    "targets": 2,

                },
                {
                    "targets": 3,

                },
                {
                    "targets": 4,

                },
                {
                    "orderable": false,
                    "searchable": false,
                    "className": "",
                    "targets": 5,
                    "width": "10%",
                    'render': function (data, type, row, meta) {
                        var html = '';
                        html += '<div class="btn-group" role="group" >';
                        html += '<button type="button" class="btn btn-sm btn-warning edit" data-toggle="modal" data-target="#modal_edit_' + module_udash + '" value="' + row.id + '"><i class="fa fa-edit"></i></button>'
                        html += '<button type="button" class="btn btn-sm btn-danger del" value="' + row.id + '"> <i class="fa fa-trash"></i></button>'
                        html += '<div>';

                        return html;


                    }
                }

            ]
        });
        //new expense add
        $('#add-' + module_dash + '-btn').on('click', function () {
            $('#' + add_form_id + ' .error').html("");
            $('#' + add_form_id + ' .form-group').removeClass("has-error");
            var custom_form = $("#" + add_form_id);
            var custom_params = custom_form.serializeArray();
            var custom_formData = new FormData();
            var elements = document.getElementById(add_form_id).elements;
            var obj = {};
            for (var i = 0; i < elements.length; i++) {
                var item = elements.item(i);
                obj[item.id] = item.value;
            }
            //console.log(obj);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: $('#expense_create').val(),
                data: obj,
                statusCode: customStatusCodeRes,
                success: function (data) {
                    // console.log(data);
                    $('#' + module_dash).click();
                    $('#listDataTable').DataTable().ajax.reload();
                    $(".form-control").val(' ');

                },
                error: function (data) {
                    errorForm(data, add_form_id);
                }
            });
        });
        //assign in edit from
        let id='';
        /*get value from datatable*/
        var oTable =  $('#listDataTable').dataTable();
        $('#listDataTable').on('click', 'tr', function(){
            var oData = oTable.fnGetData(this);
            id=oData.id;
            $("#e_item").val(oData.item);
            $("#e_purchase").val(oData.purchase_from);
            $("#e_date").val(oData.purchase_date);
            $("#e_price").val(oData.price);
        });
        //delete
        $("#listDataTable tbody").on("click","button.del",function () {
            var b=$(this);
            let id =$(this).val();
            if(confirm("Are you want to delete this data?")){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'DELETE',
                    url: $('#expense_delete').val()+'/'+id,
                    data:{
                        id:id
                    },
                    statusCode: customStatusCodeRes,
                    success: function (data) {
                        //console.log(data);
                        console.log(data);
                        $('#listDataTable').DataTable().ajax.reload();
                        $('#' + module_dash).click();
                    },
                    error: function (data) {
                        errorForm(data, edit_form_id);
                    }
                });
            }
        });
        //update
        $('#edit-' + module_dash + '-btn').on('click', function () {
            $('#' + edit_form_id + ' .error').html("");
            $('#' + edit_form_id + ' .form-group').removeClass("has-error");
            var custom_form = $("#" + edit_form_id);
            var custom_params = custom_form.serializeArray();
            var custom_formData = new FormData();
            var elements = document.getElementById(edit_form_id).elements;
            var obj = {};
            obj['id']=id;
            for (var i = 0; i < elements.length; i++) {
                var item = elements.item(i);
                obj[item.id] = item.value;
            }
            console.log(obj);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'PATCH',
                url: $('#expense_edit').val()+'/'+id,
                data: obj,
                statusCode: customStatusCodeRes,
                success: function (data) {
                    //console.log(data);
                    console.log('edit');
                    console.log(data);
                    $('#listDataTable').DataTable().ajax.reload();
                    $('#e' + module_dash).click();
                },
                error: function (data) {
                    errorForm(data, edit_form_id);
                }
            });
        });



    });

});




