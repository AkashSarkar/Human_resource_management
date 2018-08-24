<?php
/**
 * Created by PhpStorm.
 * User: deepita
 * Date: 7/1/18
 * Time: 10:35 AM
 */
function ap_datatable($type)
{
    if ($type == "css") {
        echo "<link rel=\"stylesheet\"
          href=\"" . asset('resources/assets/globals/plugins/datatables.net-bs/css/dataTables.bootstrap.min.css') . "\">";
    }
    if ($type == "js") {
        echo "<script src=\"" . asset('resources/assets/globals/plugins/datatables.net/js/jquery.dataTables.min.js') . "\"></script>";
        echo "<script src=\"" . asset('resources/assets/globals/plugins/datatables.net-bs/js/dataTables.bootstrap.min.js') . "\"></script>";
    }

}
function ap_datepicker($type)
{
    if ($type == "css") {
        echo "<link rel=\"stylesheet\" href=\"" . asset('resources/assets/globals/plugins/bootstrap-date/css/bootstrap-datepicker.min.css') . "\">";
    }
    if ($type == "js") {
        echo "<script src=\"" . asset('resources/assets/globals/plugins/bootstrap-date/js/bootstrap-datepicker.min.js') . "\"></script>";
    }
}