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
                [50, 100, 200],
                [50, 100, 200]
            ],
            "searching": true,
            "processing": true,
            "serverSide": true,
            "destroy": true,
            "orderCellsTop": true, "order": [[0, 'desc']],
            // "initComplete": customInitCompelte,
            // "drawCallback": customInitCompelete,
            "ajax": {
                'type': 'GET',
                'url': $("#user_datatable").val(),
                'data': data,
            },
            "columns": [
                {"data": "id", "sortable": false, "orderable": false, "searchable": false},
                {"data": "hid", "sortable": false, "orderable": false},
                {"data": "fName"},
                {"data": "lName"},
                {"data": "gender"},
                {"data": "dob"},
                {"data": "status"},
                {"data": "role"},
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

                }, {
                    "targets": 5,

                }, {
                    "targets": 6,

                }, {
                    "targets": 7,
                }, {
                    "orderable": false,
                    "searchable": false,
                    "className": "",
                    "targets": 8,
                    "width": "10%",
                    'render': function (data, type, row, meta) {
                        var html = '';
                        html += '<div class="btn-group" role="group" >';
                        html += '<button type="button" class="btn btn-sm btn-warning edit" data-toggle="modal" data-target="#modal_edit_'+module_udash+'" value="'+row.id+'"><i class="fa fa-edit"></i></button>'
                        html += '<button type="button" class="btn btn-sm btn-danger del" value="'+row.id+'"> <i class="fa fa-trash"></i></button>'
                        html +='<div>';

                        return html;


                    }
                }
            ]
        });
        let id='';
        /*get value from datatable*/
        var oTable =  $('#listDataTable').dataTable();
        $('#listDataTable').on('click', 'tr', function(){
            var oData = oTable.fnGetData(this);
             id=oData.id;
             $("#e_first_name").val(oData.fName);
             $("#e_last_name").val(oData.lName);
             $("#e_gender").val(oData.gender);
             $("#e_dob").val(oData.dob);
             if(oData.status) {
                 $("#e_status option[value=1]").attr('selected','selected');
             }
             else
             {
                 $("#e_status option[value=0]").attr('selected','selected');
             }
             $("#e_role_id").val(oData.role);

        });
        /*delete*/
        $("#listDataTable tbody").on("click","button.del",function () {
            var b=$(this);
            let user_id =$(this).val();
            if(confirm("Are you want to delete this data?")){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'DELETE',
                    url: $('#user_delete').val(),
                    data:{
                        id:user_id
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

            /*Add data*/

        $('#add-' + module_dash + '-btn').on('click', function () {
            $('#' + add_form_id + ' .error').html("");
            $('#' + add_form_id + ' .form-group').removeClass("has-error");
            var custom_form = $("#" + add_form_id);
            var custom_params = custom_form.serializeArray();
            //var custom_files = $('#' + add_form_id + ' .file')[0].files;
            var custom_formData = new FormData();
            // console.log( $('#user_data').val());
            // for (var i = 0; i < custom_files.length; i++) {
            //     custom_formData.append("file", custom_files[i]);
            // }

            // $(custom_params).each(function (custom_index, custom_element) {
            //     custom_formData.append(custom_element.id, custom_element.value);
            // });
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
                url: $('#user_create').val(),
                data: obj,
                statusCode: customStatusCodeRes,
                success: function (data) {
                    console.log(data);
                    $('#' + module_dash).click();
                    $('#listDataTable').DataTable().ajax.reload();
                },
                error: function (data) {
                    errorForm(data, add_form_id);
                }
            });
        });
           /*edit data*/
        $('#edit-' + module_dash + '-btn').on('click', function () {
            $('#' + edit_form_id + ' .error').html("");
            $('#' + edit_form_id + ' .form-group').removeClass("has-error");
            var custom_form = $("#" + edit_form_id);
            var custom_params = custom_form.serializeArray();
            //var custom_files = $('#' + add_form_id + ' .file')[0].files;
            var custom_formData = new FormData();
            // console.log( $('#user_data').val());
            // for (var i = 0; i < custom_files.length; i++) {
            //     custom_formData.append("file", custom_files[i]);
            // }

            // $(custom_params).each(function (custom_index, custom_element) {
            //     custom_formData.append(custom_element.id, custom_element.value);
            // });

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
                url: $('#user_edit').val(),
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

        /*Role user*/

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'GET',
                url: $('#role_user').val(),
                success: function (data) {
                    //console.log(data);
                    $.each(data,function(key, value)
                    {
                        $("#e_role_id").append('<option value=' + key + '>' + value + '</option>');

                        $("#role_id").append('<option value=' + key + '>' + value + '</option>');
                    });
                },
                error: function (data) {
                    errorForm(data, edit_form_id);
                }
            });



    });

});




