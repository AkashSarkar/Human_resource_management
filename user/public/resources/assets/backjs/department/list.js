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
                'url': $("#department_datatable").val(),
                'data': data,
            },
            "columns": [
                {"data": "id", "sortable": false, "orderable": false, "searchable": false},
                {"data": "department"},
                {"data": "designation"},
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
                    'render': function (data, type, row, meta) {

                        var x = {};
                        x = (JSON.parse(data));
                        var html = '';
                        html += '<div> <ul>';
                        for (var i = 0; i < x.length; i++) {
                            html += '<li>'+x[i]+'</li>';
                        }
                        html += '</ul></div>';
                        return html;


                    }

                },
                {
                    "orderable": false,
                    "searchable": false,
                    "className": "",
                    "targets": 3,
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
        //new Department add

        //variables
        var html='';
        var max_des=5; //maximum designation
        var c=1;

        //Add rows to the from
        $("#add_des").click(function () {
            html='<div><input type="text" class="form-control" id="designation'+c+'" name="designation" placeholder="Designation" autocomplete="off" required="required">\n' +
                '                    <a href="#" class="text-bold btn-sm btn-danger" id="r_des"> - Remove designation </a></div>';
           if(c<max_des)
           {
               $("#n_des").append("<p>"+html+"</p>");
               c++;
           }

        });

        //Remove rows from the from
        $("#n_des").on('click','#r_des',function (e) {
            $(this).parent('div').remove();
            c--;
        });


        //populate values from the  row
        var desig=[];

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
                if(i==0)
                obj[item.id] = item.value;
                else
                    desig[i-1]=item.value;
            }
            obj['designation']= JSON.stringify(desig);
            // console.log(obj);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: $('#department_create').val(),
                data: obj,
                statusCode: customStatusCodeRes,
                success: function (data) {
                    // console.log(data);
                    // $('#' + module_dash).click();
                    $('#listDataTable').DataTable().ajax.reload();
                    $('.close').click();
                    $(".form-control").val(' ');
                    $("[id*='r_des']").each(function(){
                        $(this).parent("div").remove();
                    });

                },
                error: function (data) {
                    errorForm(data, add_form_id);
                }
            });
        });
        //assign in edit from

        let id = '';
        let des_len=0,e_desig=[];
        /*get value from datatable*/
        var oTable = $('#listDataTable').dataTable();
        $('#listDataTable').on('click', 'tr', function () {
            var oData = oTable.fnGetData(this);
            id = oData.id;
            $("#e_department").val(oData.department);
            var designation=[];
            designation=JSON.parse(oData.designation);
            des_len=designation.length;
            for(var i=0;i<designation.length;i++)
            {
                html='<div><input type="text" class="form-control" id="e_designation'+i+'" name="e_designation" value="'+designation[i]+'" placeholder="Designation" autocomplete="off" required="required">\n'
                  if(i>0)
                   html+= '                    <a href="#" class="text-bold btn-sm btn-danger" id="r_e_des" > - Remove designation </a></div>';
                $("#n_e_des").append("<p>"+html+"</p>");

            }



        });

        //update
        //clear the appendes field
        $(".close").click(function () {
            $("[name*='e_designation']").each(function(){
                $(this).parent("div").remove();
            });

        });
        $("#e"+module_dash).click(function () {
            $("[name*='e_designation']").each(function(){
                $(this).parent("div").remove();
            });

        });
        $("#add_e_des").click(function () {
            html='<div><input type="text" class="form-control" id="e_designation'+des_len+'" name="e_designation" placeholder="Designation" autocomplete="off" required="required">\n'
                html+= '                    <a href="#" class="text-bold btn-sm btn-danger" id="r_e_des" > - Remove designation </a></div>';
            if(des_len<max_des)
            {
                $("#n_e_des").append("<p>"+html+"</p>");
                des_len++;
                // console.log(des_len);
            }

        });

        //Remove rows to the from
        $("#n_e_des").on('click','#r_e_des',function (e) {
            $(this).parent('div').remove();
            des_len--;
        });

        $('#edit-' + module_dash + '-btn').on('click', function () {
            $('#' + edit_form_id + ' .error').html("");
            $('#' + edit_form_id + ' .form-group').removeClass("has-error");
            var custom_form = $("#" + edit_form_id);
            var custom_params = custom_form.serializeArray();
            var custom_formData = new FormData();
            var elements = document.getElementById(edit_form_id).elements;
            var obj = {};
            e_desig=[];
            obj['id'] = id;
            for (var i = 0; i < elements.length; i++) {
                var item = elements.item(i);
                if(i===0)
                    obj[item.id] = item.value;
                else
                    e_desig[i-1]=item.value;
            }
            obj['e_designation']= JSON.stringify(e_desig);
            console.log(obj);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'PATCH',
                url: $('#department_edit').val() + '/' + id,
                data: obj,
                statusCode: customStatusCodeRes,
                success: function (data) {
                    console.log('edit');
                    console.log(data);
                    $('#listDataTable').DataTable().ajax.reload();
                    $("[name*='e_designation']").each(function(){
                        $(this).parent("div").remove();
                    });
                    $('#e' + module_dash).click();
                },
                error: function (data) {
                    errorForm(data, edit_form_id);
                }
            });
        });

        //delete
        $("#listDataTable tbody").on("click", "button.del", function () {
            var b = $(this);
            let id = $(this).val();
            if (confirm("Are you want to delete this data?")) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'DELETE',
                    url: $('#department_delete').val() + '/' + id,
                    data: {
                        id: id
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


    });

});




