<?php
/**
 * Created by PhpStorm.
 * User: akash
 * Date: 4/28/18
 * Time: 1:55 PM
 */


if (!function_exists('getRandomTokenString')) {
    function getRandomTokenString($length, $characters = null)
    {
        if ($characters == null) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        }
        $string = '';

        for ($i = 0; $i < $length; $i++) {
            $string .= $characters[mt_rand(0, strlen($characters) - 1)];
        }

        return $string;
    }
}


function isJson($string)
{
    return is_object(json_decode($string));
}

//if (!function_exists('userResponse')) {
//    function userResponse($usr,$usrAuth)
//    {
//        return [
//            'hash_id' => $usr->hash_id,
//            'first_name' => $usr->first_name,
//            'last_name' => $usr->last_name,
//            'email' => $usrAuth->email,
//            'created_at' => $usr->created_at,
//            'updated_at' => $usr->updated_at,
//        ];
//    }
//}
if (!function_exists('makeRespone')) {
    function makeRespone($data, $statusCode)
    {
        $response = [];
        $response['data'] = $data;
        $response['status'] = true;
//        if ($this->page){
//            $response['page']=$this->page;
//        }
        $response["statusCode"] = $statusCode;
        return response()->json($response, $statusCode);
    }
}

if (!function_exists('makeErrorResponse')) {
    function makeErrorResponse($errorMessage, $errorCode)
    {
        $response = [];
        if (isJson($errorMessage)) {
            $errorMessage = json_decode($errorMessage);
        }
        $response['errors'] = $errorMessage;
        $response['status'] = false;
        $response["statusCode"] = $errorCode;

        return response()->json($response, $errorCode);
    }
}

function get_menu($array, $perm_uri, $child = FALSE)
{

    $str = '';
    if (count($array)) {
        $str .= $child == FALSE ? '' . PHP_EOL : '' . PHP_EOL;
        foreach ($array as $r) {
            if (isset($r['uri_name']) && $r['uri_name'] != "" && isset($perm_uri[$r['uri_name']]) && !$perm_uri[$r['uri_name']]) {
                continue;
            }
            if (isset($r['expanded']) && $r['expanded']) {
                $active = TRUE;
            } else {
                $active = false;
            }
            if (isset($r['children']) && count($r['children'])) {

                $str .= $active ? '<li class="treeview active menu-open"><a> '
//                    . $r['ap_fa_icon']
                    . '<i class="fa fa-folder"></i><span>'
                    . e($r["label"])
                    . '</span><i class="fa fa-angle-left pull-right"></i></a><ul class="treeview-menu">' : '<li class="treeview"><a> '
//                    . $r['ap_fa_icon']
                    . '<i class="fa fa-folder"></i> <span>'
                    . e($r["label"])
                    . '</span><i class="fa fa-angle-left pull-right"></i></a><ul class="treeview-menu">';

                $str .= get_menu($r['children'], $perm_uri, TRUE);
            } else {
                $str .= $active ? '<li class="active menu-open">'
                    . '<a href="' . url(e($r['url'])) . '"> '
                    . ($child ? '' : $r['ap_fa_icon'])
                    . '<i class="fa fa-folder"></i><span>'
                    . e($r['label'])
                    . '</span></a>' : ''
                    . '<li class="">'
                    . '<a href="' . url(e($r['url'])) . '"> ' . ($child ? '' : $r['ap_fa_icon'])
                    . '<i class="fa fa-folder"></i><span>'
                    . e($r['label'])
                    . '</span></a>
                    ';
            }
            $str .= '</li>' . PHP_EOL;

        }
        $str .= '</ul>' . PHP_EOL;
    }
    return $str;
}

function get_ol_cat($array, $child = FALSE)
{
    $str = '';

    if (count($array)) {
        $str .= $child == FALSE ? '<tbody class="nestable-list">' : '<tbody class="nestable-list">';

        foreach ($array as $item) {
            $str .= '<tr data-id="' . $item['id'] . '" class="nestable-item nestable-item-handle">';
            $str .= '<div class="nestable-handle"><i class="md md-menu"></i></div>';
            $str .= '<div class="nestable-content"><a href="' . url('list-category/' . $item['id']) . '">' . $item['title'];
            $str .= '</a>';

            $str .= '<div class="btn-group pull-right">
                  <button type="button" class="btn btn-block btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                          <i class="fa fa-edit"></i>
                          <span class="caret"></span>
                        </button>
                  <ul class="dropdown-menu">';
            $str .= '<li><a href="void(0);" data-btn-status="' . $item['id'] . '" data-status="' . $item['status'] . '" onclick="changeCatStatus(' . $item['id'] . ')" title="Status">';
            if ($item['status'] == 'Active') {
                $str .= '<i class="fa fa-dot-circle-o"></i>' . $item['status'];
            } else {
                $str .= '<i class="fa fa-circle-o"></i>' . $item['status'];
            }
            $str .= '</a></li>';
            $str .= '<li><a data-toggle="modal" href="#"
                                                onclick="geteditcategorydata(' . $item['id'] . ')"
                                                data-target="#modal_edit_category" title="Edit"><i class="fa fa-pencil"></i> Edit</a></li>';
            $str .= '<li><a data-toggle="modal" href="#"
                onclick="setDeleteName(' . $item['id'] . ', \'' . $item['title'] . '\')"
                        data-target="#modal_delete_category" title="Delete"><i class="fa fa-times"></i> Delete</a></li>';
            $str .= '</ul>';
            $str .= '</div>';
            $str .= '</div>';
            if (isset($item['children']) && count($item['children'])) {
                $str .= get_ol_cat($item['children'], TRUE);
            }

            $str .= '</tr>' . PHP_EOL;
        }

        $str .= '</tbody>' . PHP_EOL;
    }

    return $str;
}

function get_sort_cat($array, $child = FALSE)
{
    $q = '';
    $qid = '';

    if (count($array)) {
        foreach ($array as $index => $item) {
            $q .= "WHEN '" . $item . "' THEN " . ($index + 1) . " ";
            $qid .= "'" . $item . "', ";
            if (isset($item->children) && count($item->children)) {
                list($_q, $_qid) = get_sort_cat($item->children, TRUE);
                $q .= $_q;
                $qid .= $_qid;
            }
        }
    }
    return [$q, $qid];
}

function get_datatable_data($request, $model, $columns, $foreign_col, $foreign_table, $glob_searchable_col, $columns_condition, $glob_main_table, $model_count, $totalFilteredSync, $totalFiltered)
{
    try {


        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->has('order.0.dir') ? $request->input('order.0.dir') : "desc";
        $column_filter = $request->input('columns');
        foreach ($column_filter as $col_key => $col_filter) {
            if ($col_filter["search"]["value"] != "") {
                $totalFilteredSync = true;
                break;
            }
        }
        /* Packed No need of modification from*/
        if (empty($request->input('search.value'))) {

            $dataList = $model->where(function ($query) use ($column_filter, $columns, $foreign_col, $foreign_table, $glob_searchable_col, $columns_condition) {
                $query = column_filter($query, $column_filter, $columns, $foreign_col, $foreign_table, $glob_searchable_col, $columns_condition);
            });
//        dump($dataList->toSql());
//        dump($dataList->getBindings());
            $dataList = $dataList->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            if ($totalFilteredSync) {
                $totalFiltered = $model_count->where(function ($query) use ($column_filter, $columns, $foreign_col, $foreign_table, $glob_searchable_col, $columns_condition) {
                    $query = column_filter($query, $column_filter, $columns, $foreign_col, $foreign_table, $glob_searchable_col, $columns_condition);
                })->count();
            }


        } else {

            $search = $request->input('search.value');
            $totalFilteredSync = true;
            $dataList = $model->where(function ($query) use ($column_filter, $columns, $foreign_col, $foreign_table, $glob_searchable_col, $columns_condition) {
                $query = column_filter($query, $column_filter, $columns, $foreign_col, $foreign_table, $glob_searchable_col, $columns_condition);
            })->where(function ($query) use ($search, $glob_searchable_col, $glob_main_table, $columns_condition) {
                foreach ($glob_searchable_col as $glob_filter_table_name => $glob_table_filter) {

                    if ($glob_filter_table_name == $glob_main_table) {
                        foreach ($glob_table_filter as $glob_col_key => $glob_col_filter) {
                            if ($glob_col_filter == reset($glob_table_filter)) {
                                $query->where($glob_col_filter, $columns_condition[$glob_col_filter], "%{$search}%");
                            } else {
                                $query->orWhere($glob_col_filter, $columns_condition[$glob_col_filter], "%{$search}%");
                            }
                        }
                    } else {
                        if ($glob_table_filter == reset($glob_searchable_col)) {
                            $query->whereIn($glob_table_filter["foreign"], function ($query) use ($glob_table_filter, $glob_filter_table_name, $search, $columns_condition) {
                                foreach ($glob_table_filter["col"] as $glob_col_key => $glob_col_filter) {
                                    if ($glob_col_filter == reset($glob_table_filter["col"])) {
                                        $query->from($glob_filter_table_name)
                                            ->select($glob_filter_table_name . ".id")
                                            ->where($glob_filter_table_name . "." . $glob_col_filter, $columns_condition[$glob_col_filter], "%{$search}%");
                                    } else {
                                        $query->orWhere($glob_col_filter, $columns_condition[$glob_col_filter], "%{$search}%");
                                    }
                                }
                            });
                        } else {
                            $query->orWhereIn($glob_table_filter["foreign"], function ($query) use ($glob_table_filter, $glob_filter_table_name, $search, $columns_condition) {
                                foreach ($glob_table_filter["col"] as $glob_col_key => $glob_col_filter) {
                                    if ($glob_col_filter == reset($glob_table_filter["col"])) {
                                        $query->from($glob_filter_table_name)
                                            ->select($glob_filter_table_name . ".id")
                                            ->where($glob_filter_table_name . "." . $glob_col_filter, $columns_condition[$glob_col_filter], "%{$search}%");
                                    } else {
                                        $query->orWhere($glob_col_filter, $columns_condition[$glob_col_filter], "%{$search}%");
                                    }
                                }
                            });
                        }


                    }

                }

            })
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir);
//        dump($dataList->toSql());
//        dump($dataList->getBindings());
            $totalFiltered = $dataList->count();
            $dataList = $dataList->get();
        }
    } catch (\Exception $e) {
        \App\Models\ErrorR::efail($e);
    }
    return ['data' => $dataList, 'recordsFiltered' => $totalFiltered];
    /*No need of modification here*/
}

function foreign_where_operator($query, $columns_condition, $glob_col_filter, $col_filter)
{
    try {
        $gcfArray = readCStt($glob_col_filter);
        foreach ($gcfArray as $gcf) {
            if ($columns_condition[$gcf] == reset($gcfArray)) {
                if ($columns_condition[$gcf] == "match") {
                    $query->whereRaw(gquery($col_filter["search"]["value"], $gcf)[0], gquery($col_filter["search"]["value"], $gcf)[1]);
                } elseif ($columns_condition[$gcf] == "anylike") {
                    $query->whereRaw(gQAny($col_filter["search"]["value"], $gcf)[0], gQAny($col_filter["search"]["value"], $gcf)[1]);
                } elseif ($columns_condition[$gcf] == "like") {
                    $query->where($gcf, $columns_condition[$gcf], "%{$col_filter["search"]["value"]}%");
                } else {
                    $query->where($gcf, $columns_condition[$gcf], $col_filter["search"]["value"]);
                }
            } else {
                if ($columns_condition[$gcf] == "match") {
                    $query->orWhereRaw(gquery($col_filter["search"]["value"], $gcf)[0], gquery($col_filter["search"]["value"], $gcf)[1]);
                } elseif ($columns_condition[$gcf] == "anylike") {
                    $query->orWhereRaw(gQAny($col_filter["search"]["value"], $gcf)[0], gQAny($col_filter["search"]["value"], $gcf)[1]);
                } elseif ($columns_condition[$gcf] == "like") {
                    $query->orWhere($gcf, $columns_condition[$gcf], "%{$col_filter["search"]["value"]}%");
                } else {
                    $query->orWhere($gcf, $columns_condition[$gcf], $col_filter["search"]["value"]);
                }
            }
        }

    } catch (\Exception $e) {
        \App\Models\ErrorR::efail($e);
    }
    return $query;
}

function foreign_orwhere_operator($query, $columns_condition, $glob_col_filter, $col_filter)
{
    try {
        $gcfArray = readCStt($glob_col_filter);
        foreach ($gcfArray as $gcf) {
            if ($columns_condition[$gcf] == "match") {
                $query->orWhereRaw(gquery($col_filter["search"]["value"], $gcf)[0], gquery($col_filter["search"]["value"], $gcf)[1]);
            } elseif ($columns_condition[$gcf] == "anylike") {
                $query->orWhereRaw(gQAny($col_filter["search"]["value"], $gcf)[0], gQAny($col_filter["search"]["value"], $gcf)[1]);
            } elseif ($columns_condition[$gcf] == "like") {
                $query->orWhere($gcf, $columns_condition[$gcf], "%{$col_filter["search"]["value"]}%");
            } else {
                $query->orWhere($gcf, $columns_condition[$gcf], $col_filter["search"]["value"]);
            }
        }
    } catch (\Exception $e) {
        \App\Models\ErrorR::efail($e);
    }
    return $query;
}

function foreign_column($query, $columns, $col_filter, $glob_searchable_col, $col_key, $foreign_col, $columns_condition)
{
    try {
        foreach ($glob_searchable_col[$foreign_col[$columns[$col_key]]]["col"] as $glob_col_key => $glob_col_filter) {
            if ($glob_col_filter == reset($glob_searchable_col[$foreign_col[$columns[$col_key]]]["col"])) {
                $query->from($foreign_col[$columns[$col_key]])
                    ->select($foreign_col[$columns[$col_key]] . ".id");
                $query = foreign_where_operator($query, $columns_condition, $glob_col_filter, $col_filter);
            } else {
                $query = foreign_orwhere_operator($query, $columns_condition, $glob_col_filter, $col_filter);
            }
        }
    } catch (\Exception $e) {
        \App\Models\ErrorR::efail($e);
    }
    return $query;
}

function foreign_table($query, $columns, $col_filter, $glob_searchable_col, $col_key, $foreign_table, $columns_condition)
{
    try {

        $temp_foreign_table = $foreign_table[$columns[$col_key]];

        if (isset($glob_searchable_col[$foreign_table[$columns[$col_key]]]["pivot"])) {
            foreach ($glob_searchable_col[$foreign_table[$columns[$col_key]]]["pivot"] as $glob_pivot_col_key => $glob_pivot_searchable_col) {

                $foreign_table[$columns[$col_key]] = key($glob_searchable_col[$foreign_table[$columns[$col_key]]]["pivot"]);
                $query = foreign_table_regid($query, $columns, $col_filter, $glob_searchable_col, $temp_foreign_table, $glob_searchable_col[$temp_foreign_table]["pivot"], $col_key, $foreign_table[$columns[$col_key]], $columns_condition);
            }
        } else {

            $query->from($temp_foreign_table);
            $query->select($temp_foreign_table . "." . $glob_searchable_col[$temp_foreign_table]["foreign"]);
            foreach ($glob_searchable_col[$temp_foreign_table]["col"] as $glob_col_key => $glob_col_filter) {
                if (in_array($glob_col_filter, $col_filter)) {
                    if ($glob_col_filter == reset($glob_searchable_col[$temp_foreign_table]["col"])) {
                        $query = foreign_where_operator($query, $columns_condition, $glob_col_filter, $col_filter);
                    } else {
                        $query = foreign_orwhere_operator($query, $columns_condition, $glob_col_filter, $col_filter);
                    }
                }
            }
        }
    } catch (\Exception $e) {
        \App\Models\ErrorR::efail($e);
    }
    return $query;
}

function foreign_table_regid($query, $columns, $col_filter, $glob_searchable_col_prev, $foreign_table_prev, $glob_searchable_col, $col_key, $foreign_table_name, $columns_condition)
{
    try {
        if (isset($glob_searchable_col[$foreign_table_name]["pivot"])) {
            foreach ($glob_searchable_col[$foreign_table_name]["pivot"] as $glob_pivot_col_key => $glob_pivot_searchable_col) {
                $temp_foreign_table = $foreign_table_name;
                $foreign_table_name = key($glob_searchable_col[$foreign_table_name]["pivot"]);

                $query = foreign_table_regid($query, $columns, $col_filter, $glob_searchable_col, $temp_foreign_table, $glob_searchable_col[$temp_foreign_table]["pivot"], $col_key, $temp_foreign_table, $columns_condition);
            }
        } else {
            $query->from(key($glob_searchable_col));
            $query->select(key($glob_searchable_col) . "." . $glob_searchable_col[$foreign_table_name]["foreign"]);
//        dd($glob_searchable_col[$foreign_table_name]["col"]);
            foreach ($glob_searchable_col[$foreign_table_name]["col"] as $glob_col_key_prev => $glob_col_filter_prev) {
                $glob_filter_table_name = $foreign_table_prev;
                $glob_table_filter = $glob_searchable_col_prev[$foreign_table_prev];
                foreach ($glob_table_filter["col"] as $glob_col_key => $glob_col_filter) {
                    $query->whereIn($glob_col_filter_prev, function ($query) use ($glob_table_filter, $glob_filter_table_name, $col_filter, $glob_col_filter, $foreign_table_prev) {
                        if ($glob_col_filter == reset($glob_table_filter["col"])) {
                            $query->from($foreign_table_prev)
                                ->select($foreign_table_prev . ".id")
                                ->where($foreign_table_prev . "." . $glob_col_filter, 'LIKE', "%{$col_filter["search"]["value"]}%");
                        } else {
                            $query->orWhere($glob_col_filter, 'LIKE', "%{$col_filter["search"]["value"]}%");
                        }
                    });
                }

            }
        }
    } catch (\Exception $e) {
        \App\Models\ErrorR::efail($e);
    }

    return $query;
}

function column_filter($query, $column_filter, $columns, $foreign_col, $foreign_table, $glob_searchable_col, $columns_condition)
{
    try {
        foreach ($column_filter as $col_key => $col_filter) {
            if ($col_filter["search"]["value"] != "") {
                if (array_key_exists($columns[$col_key], $foreign_col)) {
                    if ($col_filter == reset($column_filter)) {
                        $query->whereIn($columns[$col_key], function ($query) use ($columns, $col_filter, $glob_searchable_col, $col_key, $foreign_col, $columns_condition) {
                            $query = foreign_column($query, $columns, $col_filter, $glob_searchable_col, $col_key, $foreign_col, $columns_condition);
                        });
                    } else {
                        $query->orWhereIn($columns[$col_key], function ($query) use ($columns, $col_filter, $glob_searchable_col, $col_key, $foreign_col, $columns_condition) {
                            $query = foreign_column($query, $columns, $col_filter, $glob_searchable_col, $col_key, $foreign_col, $columns_condition);
                        });
                    }

                } else if (array_key_exists($columns[$col_key], $foreign_table)) {
                    if ($col_filter == reset($column_filter)) {
                        $query->whereIn("id", function ($query) use ($columns, $col_filter, $glob_searchable_col, $col_key, $foreign_table, $columns_condition) {
                            $query = foreign_table($query, $columns, $col_filter, $glob_searchable_col, $col_key, $foreign_table, $columns_condition);
                        });
                    } else {
                        $query->orWhereIn("id", function ($query) use ($columns, $col_filter, $glob_searchable_col, $col_key, $foreign_table, $columns_condition) {
                            $query = foreign_table($query, $columns, $col_filter, $glob_searchable_col, $col_key, $foreign_table, $columns_condition);
                        });
                    }

                } else {
                    $query = foreign_where_operator($query, $columns_condition, $columns[$col_key], $col_filter);
                }

            }
        }
    } catch (\Exception $e) {
        \App\Models\ErrorR::efail($e);
    }
    return $query;
}

/**
 * @param $responseData
 * @return \Illuminate\Http\JsonResponse
 */
function respJOk($responseData)
{
    return response()->json($responseData, 200);
}

/**
 * @param $responseData
 * @return \Illuminate\Http\JsonResponse
 */
function respJCreated($responseData)
{
    return response()->json($responseData, 201);
}

/**
 * @param $responseData
 * @return \Illuminate\Http\JsonResponse
 */
function respJAccepted($responseData)
{
    return response()->json($responseData, 202);
}

function respJELogin($responseData)
{
    return response()->json($responseData, 401);
}


/**
 * @param $responseData
 * Authentication Error
 * @return \Illuminate\Http\JsonResponse
 */
function respJEAuth($responseData)
{
    return response()->json($responseData, 403);
}

/**
 * @param $responseData
 * User Error
 * @return \Illuminate\Http\JsonResponse
 */
function respJEUser($responseData)
{
    return response()->json($responseData, 422);
}

function respJErroR($responseData, $e)
{
    return response()->json($responseData, 500);
}

//status helper End

//Image helper Start


/**
 * @param $path ["path" => "resources/images/product_discount/"]
 * @param $ext ["jpg","png","zip"]
 * @param array [["folder"=>"thumb","width"=>300,"height"=>300][].....]
 * @return mixed
 */
function uploadFile($path = "resources/images/", $ext, $sizesImg = [], $name = "file")
{
    ini_set('memory_limit', '256M');
    require_once 'resources/assets/globals/plugins/filemanager/include/mime_type_lib.php';
    $storeFolder = $path['path'];
    $storeFolderThumb = $path['path'] . "";

    $source_base = "resources/images/";
    $thumb_base = $source_base;
    $path_pos = strpos($storeFolder, $source_base);
    $thumb_pos = strpos($storeFolderThumb, $thumb_base);


    if ((!empty($_FILES) && isset($_FILES[$name])) || isset($_POST['url'])) {
        if (isset($_POST['url'])) {
            $temp = tempnam('/tmp', 'RF');
            $handle = fopen($temp, "w");
            fwrite($handle, file_get_contents($_POST['url']));
            fclose($handle);
            $_FILES[$name] = array(
                'name' => basename($_POST['url']),
                'tmp_name' => $temp,
                'size' => filesize($temp),
                'type' => explode(".", strtolower($temp))
            );
        }


        $info = pathinfo($_FILES[$name]['name']);
        $mime_type = $_FILES[$name]['type'];
//        echo $mime_type;
        if (function_exists('mime_content_type')) {
//            print_r("loj".PHP_EOL);
            $mime_type = mime_content_type($_FILES[$name]['tmp_name']);
        } elseif (function_exists('finfo_open')) {
//            print_r("lop".PHP_EOL);
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime_type = finfo_file($finfo, $_FILES[$name]['tmp_name']);
        } else {
//            include '../../public/resources/assets/globals/plugins/filemanager/include/mime_type_lib.php';
//            include 'include/mime_type_lib.php';
//            print_r("lol".PHP_EOL);
            $mime_type = get_file_mime_type($_FILES[$name]['tmp_name']);
        }
//        print_r($info['extension'].PHP_EOL);
//        print_r($mime_type.PHP_EOL);
        $extension = get_extension_from_mime($mime_type);
//        print($extension);
//        print_r($extension . PHP_EOL);
        if ($extension == 'so') {
            $extension = $info['extension'];
        }
        if ($info['extension'] == "docx") {
            $extension = $info['extension'];
        }
//        print_r($extension.PHP_EOL);
        if (in_array(fix_strtolower($extension), $ext)) {
            $tempFile = $_FILES[$name]['tmp_name'];
            $targetPath = $storeFolder;
            $targetPathThumb = $storeFolderThumb;
            $is_folder = false;//TODO NEED TO TEST TRUE
            $_FILES[$name]['name'] = fix_filename($path["module"] . "_" . time() . "." . $extension, $is_folder);

            $_FILES[$name]['name'] = fix_strtolower($_FILES[$name]['name']);

            // Gen. new file name if exists
            if (file_exists($targetPath . $_FILES[$name]['name'])) {
                $i = 1;
                $info = pathinfo($_FILES[$name]['name']);

                // append number
                while (file_exists($targetPath . $info['filename'] . "_" . $i . "." . $extension)) {
                    $i++;
                }
                $_FILES[$name]['name'] = $info['filename'] . "_" . $i . "." . $extension;
            }

            $targetFile = $targetPath . $_FILES[$name]['name'];
            $targetFileThumb = $targetPathThumb . $_FILES[$name]['name'];

            // check if image (and supported)
            $ext_img = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'tiff', 'svg');
            if (in_array(fix_strtolower($extension), $ext_img)) $is_img = TRUE;
            else $is_img = FALSE;

            if (!checkresultingsize($_FILES[$name]['size'])) {
                $MaxSizeTotal = false;
                response(sprintf(trans('max_size_reached'), $MaxSizeTotal), 406)->send();
            }


            if (is_uploaded_file($tempFile)) {
                move_uploaded_file($tempFile, $targetFile);
            } else {
                copy($tempFile, $targetFile);
                unlink($tempFile);
            }
            chmod($targetFile, 0755);

            if ($is_img) {
                if ($path_pos !== 0
                    || $thumb_pos !== 0
                    || strpos($storeFolderThumb, '../', strlen($thumb_base)) !== FALSE
                    || strpos($storeFolderThumb, './', strlen($thumb_base)) !== FALSE
                    || strpos($storeFolder, '../', strlen($source_base)) !== FALSE
                    || strpos($storeFolder, './', strlen($source_base)) !== FALSE
                    || strpos($storeFolderThumb, '..\\', strlen($thumb_base)) !== FALSE
                    || strpos($storeFolderThumb, '.\\', strlen($thumb_base)) !== FALSE
                    || strpos($storeFolder, '..\\', strlen($source_base)) !== FALSE
                    || strpos($storeFolder, '.\\', strlen($source_base)) !== FALSE
                ) {
//                    response(trans('wrong path'))->send();
                }
                if (isset($image_watermark) && $image_watermark) {
                    require_once('include/php_image_magician.php');

                    $magicianObj = new imageLib($targetFile);
                    /**
                     * Could be a pre-determined position such as:
                     * tl = top left,
                     * t  = top (middle),
                     * tr = top right,
                     * l  = left,
                     * m  = middle,
                     * r  = right,
                     * bl = bottom left,
                     * b  = bottom (middle),
                     * br = bottom right
                     * Or, it could be a co-ordinate position such as: 50x100
                     */
                    $image_watermark_position = "br";
                    $image_watermark_padding = 0;
                    $magicianObj->addWatermark($image_watermark, $image_watermark_position, $image_watermark_padding);

                    $magicianObj->saveImage($targetFile);
                }

                $memory_error = FALSE;
                if ($extension != 'svg' && !create_img($targetFile, $targetFileThumb, 122, 91)) {
                    $memory_error = TRUE;
                } else {
                    $imginfo = getimagesize($targetFile);
                    foreach ($sizesImg as $sizeImg) {
                        resizeImage($imginfo, $targetFile, $targetPath . "" . $sizeImg["folder"] . "/" . $_FILES[$name]['name'], $sizeImg["width"], $sizeImg["height"]);
                    }

                }
                // not enough memory
                if ($memory_error) {
                    unlink($targetFile);
                    return ["message" => "Not enought Memory", "success" => false, "response" => 406];
                }
            }
            return ["file_name" => $_FILES[$name]['name'], "success" => true, "extension" => $extension, "response" => 201];
        } else // file ext. is not in the allowed list
        {
            return ["message" => "Error_extension", "extension" => $extension, "success" => false, "response" => 406];
        }
    } else // no files to upload
    {
        return ["message" => "No file selected", "success" => false, "response" => 405];
    }
}

function resizeImage($imginfo, $targetFile, $targetFileN, $image_resizing_width, $image_resizing_height)
{

    $srcWidth = $imginfo[0];
    $srcHeight = $imginfo[1];

    // resize images if set
    $image_resizing = true;
//    $image_resizing_width = 0;
//    $image_resizing_height = 0;
    $image_resizing_mode = 'auto'; // same as $image_max_mode
    $image_resizing_override = false;
    if ($image_resizing) {
        if ($image_resizing_width == 0) // if width not set
        {
            if ($image_resizing_height == 0) {
                $image_resizing_width = $srcWidth;
                $image_resizing_height = $srcHeight;
            } else {
                $image_resizing_width = $image_resizing_height * $srcWidth / $srcHeight;
            }
        } elseif ($image_resizing_height == 0) // if height not set
        {
            $image_resizing_height = $image_resizing_width * $srcHeight / $srcWidth;
        }

        // new dims and create
        $srcWidth = $image_resizing_width;
        $srcHeight = $image_resizing_height;
        create_img($targetFile, $targetFileN, $image_resizing_width, $image_resizing_height, $image_resizing_mode);
    }

    //max resizing limit control
    $resize = FALSE;
    $image_max_width = 0;
    $image_max_height = 0;
    $image_max_mode = 'auto';


    if ($image_max_width != 0 && $srcWidth > $image_max_width && $image_resizing_override === FALSE) {
        $resize = TRUE;
        $srcWidth = $image_max_width;

        if ($image_max_height == 0) $srcHeight = $image_max_width * $srcHeight / $srcWidth;
    }

    if ($image_max_height != 0 && $srcHeight > $image_max_height && $image_resizing_override === FALSE) {
        $resize = TRUE;
        $srcHeight = $image_max_height;

        if ($image_max_width == 0) $srcWidth = $image_max_height * $srcWidth / $srcHeight;
    }

    if ($resize) {
        create_img($targetFile, $targetFile, $srcWidth, $srcHeight, $image_max_mode);
    }
}

//Image helper End


if (!function_exists('anchor')) {
    /**
     * Anchor Link
     *
     * Creates an anchor based on the local URL.
     *
     * @param    string    the URL
     * @param    string    the link title
     * @param    mixed    any attributes
     * @return    string
     */
    function anchor($uri = '', $title = '', $attributes = '')
    {
        $title = (string)$title;

        $site_url = is_array($uri)
            ? site_url($uri)
            : (preg_match('#^(\w+:)?//#i', $uri) ? $uri : site_url($uri));

        if ($title === '') {
            $title = $site_url;
        }

        if ($attributes !== '') {
            $attributes = _stringify_attributes($attributes);
        }

        return '<a href="' . $site_url . '"' . $attributes . '>' . $title . '</a>';
    }
}

if (!function_exists('_stringify_attributes')) {
    /**
     * Stringify attributes for use in HTML tags.
     *
     * Helper function used to convert a string, array, or object
     * of attributes to a string.
     *
     * @param    mixed    string, array, object
     * @param    bool
     * @return    string
     */
    function _stringify_attributes($attributes, $js = FALSE)
    {
        $atts = NULL;

        if (empty($attributes)) {
            return $atts;
        }

        if (is_string($attributes)) {
            return ' ' . $attributes;
        }

        $attributes = (array)$attributes;

        foreach ($attributes as $key => $val) {
            $atts .= ($js) ? $key . '=' . $val . ',' : ' ' . $key . '="' . $val . '"';
        }

        return rtrim($atts, ',');
    }
}


if (!function_exists('dump')) {

    function dump($var, $label = 'Dump', $echo = TRUE)
    {

        // Store dump in variable

        ob_start();

        var_dump($var);

        $output = ob_get_clean();


        // Add formatting

        $output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);

        $output = '<pre style="background: #FFFEEF; color: #000; border: 1px dotted #000; padding: 10px; margin: 10px 0; text-align: left;">' . $label . ' => ' . $output . '</pre>';


        // Output

        if ($echo == TRUE) {

            echo $output;
        } else {

            return $output;
        }
    }

}


if (!function_exists('dump_exit')) {

    function dump_exit($var, $label = 'Dump', $echo = TRUE)
    {

        dump($var, $label, $echo);

        exit;
    }

}

/**
 * Correct strtolower handling
 *
 * @param  string $str
 *
 * @return  string
 */
function fix_strtolower($str)
{
    if (function_exists('mb_strtoupper')) {
        return mb_strtolower($str);
    } else {
        return strtolower($str);
    }
}

/**
 * Cleanup filename
 *
 * @param  string $str
 * @param  bool $transliteration
 * @param  bool $convert_spaces
 * @param  string $replace_with
 * @param  bool $is_folder
 *
 * @return string
 */
function fix_filename($str, $config, $is_folder = false)
{
    if ($config['convert_spaces']) {
        $str = str_replace(' ', $config['replace_with'], $str);
    }

    if ($config['transliteration']) {
        if (!mb_detect_encoding($str, 'UTF-8', true)) {
            $str = utf8_encode($str);
        }
        if (function_exists('transliterator_transliterate')) {
            $str = transliterator_transliterate('Any-Latin; Latin-ASCII', $str);
        } else {
            $str = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $str);
        }

        $str = preg_replace("/[^a-zA-Z0-9\.\[\]_| -]/", '', $str);
    }

    $str = str_replace(array('"', "'", "/", "\\"), "", $str);
    $str = strip_tags($str);

    // Empty or incorrectly transliterated filename.
    // Here is a point: a good file UNKNOWN_LANGUAGE.jpg could become .jpg in previous code.
    // So we add that default 'file' name to fix that issue.
    if (strpos($str, '.') === 0 && $is_folder === false) {
        $str = 'file' . $str;
    }

    return trim($str);
}

/**
 * check if the current folder size plus the added size is over the overall size limite
 *
 * @param  int $sizeAdded
 *
 * @return  bool
 */
function checkresultingsize($sizeAdded)
{
    global $MaxSizeTotal, $current_path;
    if ($MaxSizeTotal !== false && is_int($MaxSizeTotal)) {
        list($sizeCurrentFolder, $fileCurrentNum, $foldersCurrentCount) = folder_info($current_path, false);
        // overall size over limit
        if (($MaxSizeTotal * 1024 * 1024) < ($sizeCurrentFolder + $sizeAdded)) {
            return false;
        }
    }
    return true;
}

/**
 * Create new image from existing file
 *
 * @param  string $imgfile Source image file name
 * @param  string $imgthumb Thumbnail file name
 * @param  int $newwidth Thumbnail width
 * @param  int $newheight Optional thumbnail height
 * @param  string $option Type of resize
 *
 * @return bool
 * @throws \Exception
 */
function create_img($imgfile, $imgthumb, $newwidth, $newheight = null, $option = "crop", $ftp = false, $config = array())
{
    $result = false;
    if (file_exists($imgfile) || strpos($imgfile, 'http') === 0) {
        if (strpos($imgfile, 'http') === 0 || image_check_memory_usage($imgfile, $newwidth, $newheight)) {
            require_once('resources/assets/globals/plugins/filemanager/include/php_image_magician.php');
            try {
                $magicianObj = new imageLib($imgfile);
                $magicianObj->resizeImage($newwidth, $newheight, $option);
                $magicianObj->saveImage($imgthumb, 80);
            } catch (Exception $e) {
                return false;
            }
            $result = true;
        }
    }

    return $result;
}

/**
 * Check if memory is enough to process image
 *
 * @param  string $img
 * @param  int $max_breedte
 * @param  int $max_hoogte
 *
 * @return bool
 */
function image_check_memory_usage($img, $max_breedte, $max_hoogte)
{
    if (file_exists($img)) {
        $K64 = 65536; // number of bytes in 64K
        $memory_usage = memory_get_usage();

        $memory_limit = abs(intval(str_replace('M', '', ini_get('memory_limit')) * 1024 * 1024));
        $image_properties = getimagesize($img);
        $image_width = $image_properties[0];
        $image_height = $image_properties[1];
        if (isset($image_properties['bits']))
            $image_bits = $image_properties['bits'];
        else
            $image_bits = 0;
        $image_memory_usage = $K64 + ($image_width * $image_height * ($image_bits) * 2);
        $thumb_memory_usage = $K64 + ($max_breedte * $max_hoogte * ($image_bits) * 2);
        $memory_needed = abs(intval($memory_usage + $image_memory_usage + $thumb_memory_usage));
        if ($memory_needed > $memory_limit) {
            return false;
        } else {
            return true;
        }
    } else {
        return false;
    }
}

function getFirstSplit($valueToCompare, $targetString, $splitOperator)
{
    if ($valueToCompare != "") {
        $splits = explode($splitOperator, $targetString, 2);
        $first = $splits[0];
        if ($first == $valueToCompare)
            return true;
        else
            return false;
    }
    return false;
}

if (!function_exists('getRandomPasswordString')) {
    function getRandomPasswordString($length = 8)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $string = '';

        for ($i = 0; $i < $length; $i++) {
            $string .= $characters[mt_rand(0, strlen($characters) - 1)];
        }

        return $string;
    }
}
if (!function_exists('titleShorten')) {
    function titleShorten($title = "")
    {
        return ((strlen($title) > 20) ? substr($title, 0, 20) . " ..." : $title);
    }
}
if (!function_exists('generateSeoURL')) {
    function generateSeoURL($string, $wordLimit = 0)
    {
        $separator = '-';

        if ($wordLimit != 0) {
            $wordArr = explode(' ', $string);
            $string = implode(' ', array_slice($wordArr, 0, $wordLimit));
        }

        $quoteSeparator = preg_quote($separator, '#');

        $trans = array(
            '&.+?;' => '',
            '[^\w\d _-]' => '',
            '\s+' => $separator,
            '(' . $quoteSeparator . ')+' => $separator
        );

        $string = strip_tags($string);
        foreach ($trans as $key => $val) {
            $string = preg_replace('#' . $key . '#i' . (true ? 'u' : ''), $val, $string);
        }

        $string = strtolower($string);

        return trim(trim($string, $separator));
    }
}
if (!function_exists('generateCategoryUrl')) {
    function generateCategoryUrl($prefix, $title, $id)
    {
        if ($prefix == 1) {
            return route(env('STORE_ONE_PREFIX', 'mallbd') . ".front_category", ['title' => generateSeoURL($title), 'id' => $id]);
        } else {
            return route(env('STORE_TWO_PREFIX', 'makeupstore') . ".front_category", ['title' => generateSeoURL($title), 'id' => $id]);
        }
    }
}
if (!function_exists('ip_info')) {
    function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE)
    {
        $output = NULL;
        if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
            $ip = $_SERVER["REMOTE_ADDR"];
            if ($deep_detect) {
                if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                    $ip = $_SERVER['HTTP_CLIENT_IP'];
            }
        }
        $purpose = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
        $support = array("country", "countrycode", "state", "region", "city", "location", "address");
        $continents = array(
            "AF" => "Africa",
            "AN" => "Antarctica",
            "AS" => "Asia",
            "EU" => "Europe",
            "OC" => "Australia (Oceania)",
            "NA" => "North America",
            "SA" => "South America"
        );
        if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
            $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
            if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
                switch ($purpose) {
                    case "location":
                        $output = array(
                            "city" => @$ipdat->geoplugin_city,
                            "state" => @$ipdat->geoplugin_regionName,
                            "country" => @$ipdat->geoplugin_countryName,
                            "country_code" => @$ipdat->geoplugin_countryCode,
                            "continent" => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
                            "continent_code" => @$ipdat->geoplugin_continentCode
                        );
                        break;
                    case "address":
                        $address = array($ipdat->geoplugin_countryName);
                        if (@strlen($ipdat->geoplugin_regionName) >= 1)
                            $address[] = $ipdat->geoplugin_regionName;
                        if (@strlen($ipdat->geoplugin_city) >= 1)
                            $address[] = $ipdat->geoplugin_city;
                        $output = implode(", ", array_reverse($address));
                        break;
                    case "city":
                        $output = @$ipdat->geoplugin_city;
                        break;
                    case "state":
                        $output = @$ipdat->geoplugin_regionName;
                        break;
                    case "region":
                        $output = @$ipdat->geoplugin_regionName;
                        break;
                    case "country":
                        $output = @$ipdat->geoplugin_countryName;
                        break;
                    case "countrycode":
                        $output = @$ipdat->geoplugin_countryCode;
                        break;
                }
            }
        }
        return $output;
    }
}
if (!function_exists('get_client_ip')) {
    function get_client_ip()
    {

        $ipaddress = '';

        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');

        else if (getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');

        else if (getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');

        else if (getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');

        else if (getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');

        else if (getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';

        return $ipaddress;
    }
}
if (!function_exists('get_user_geo_info')) {
    function get_user_geo_info()
    {
        $ip = get_client_ip();
        if ($ip != "UNKNOWN") {
//        echo ip_info(get_client_ip(), "Country"); // India
//        echo ip_info(get_client_ip(), "Country Code"); // IN
//        echo ip_info(get_client_ip(), "State"); // Andhra Pradesh
//        echo ip_info(get_client_ip(), "City"); // Proddatur
//        echo ip_info(get_client_ip(), "Address"); // Proddatur, Andhra Pradesh, India
//
//        print_r(ip_info("Visitor", "Location")); // Array ( [city] => Proddatur [state] => Andhra Pradesh [country] => India [country_code] => IN [continent] => Asia [continent_code] => AS )

            return ip_info(get_client_ip(), "Country Code");
        } else {
            return "BD";
        }

    }
}
if (!function_exists('closetags')) {
    function closetags($html)
    {
        $html = trim($html);
        preg_match_all('#<([a-z]+)(?: .*)?(?<![/|/ ])>#iU', $html, $result);
        $openedtags = $result[1];
        preg_match_all('#</([a-z]+)>#iU', $html, $result);
        $closedtags = $result[1];
        $len_opened = count($openedtags);
        if (count($closedtags) == $len_opened) {
            return $html;
        }
        $openedtags = array_reverse($openedtags);
        for ($i = 0; $i < $len_opened; $i++) {
            if (!in_array($openedtags[$i], $closedtags)) {
                $html .= '</' . $openedtags[$i] . '>';
            } else {
                unset($closedtags[array_search($openedtags[$i], $closedtags)]);
            }
        }
        return $html;
    }
}
if (!function_exists('gquery')) {
    function gquery($search, $field)
    {
        $search = trim($search);
        $sI = array();
        if ($search == "" or $search == null or $search == false) {
            $query = "MATCH ($field) AGAINST (?) ";
            $sI[] = $search;
        } else {
            $query = "MATCH ($field) AGAINST (?) ";
            $sI[] = $search;
        }
        return [$query, $sI];
    }
}
if (!function_exists('gQStartWith')) {
    function gQStartWith($search, $field)
    {
        $search = trim($search);
        $sI = array();
        if ($search == "" or $search == null or $search == false) {
            $query = "$field like ?";
            $sI[] = $search . "%";
        } else {
            $searchSplit = explode(' ', $search);

            $searchQueryItems = array();

            foreach ($searchSplit as $searchTerm) {
                $searchQueryItems[] = " $field like ?";
                $sI[] = $searchTerm . "%";
            }
            $query = (!empty($searchQueryItems) ? "" . implode(" OR ", $searchQueryItems) : "");
        }
        return [$query, $sI];
    }
}
if (!function_exists('gQAny')) {
    function gQAny($search, $field)
    {
        $search = trim($search);
//        dump($search);
        $sI = array();
        if ($search == "" or $search == null or $search == false) {
            $query = "$field like ?";
            $sI[] = "%" . $search . "%";
        } else {
            $searchSplit = explode(' ', $search);

            $searchQueryItems = array();

            foreach ($searchSplit as $searchTerm) {
                $searchQueryItems[] = " $field like ?";
                $sI[] = "%" . $searchTerm . "%";
            }
//            dump($searchQueryItems);
            $query = (!empty($searchQueryItems) ? "" . implode(" OR ", $searchQueryItems) : "");
        }
        return [$query, $sI];
    }
}

if (!function_exists(/** @lang read Compound Statement */
    'readCStt')) {
    /**
     * @param {String=}$statement
     *
     * @return array
     */
    function readCStt($statement)
    {

        if (!empty($statement)) {
            return explode(',', $statement);
        }
        return [$statement];

    }
}
if (!function_exists(/** @lang first Compound Statement */
    'firstCStt')) {
    /**
     * @param {String=}$statement
     *
     * @return string
     */
    function firstCStt($statement)
    {
        if (!empty($statement)) {
            if (!empty(implode(',', $statement)[0])) {
                return implode(',', $statement)[0];
            }
        }
        return $statement;

    }
}


//if (!function_exists('makeSpell')) {
//    function makeSpell($keyword)
//    {
//        if ($keyword != "") {
//            $pspell = \pspell_new("en");
//            $words = explode(" ", $keyword);
//            $newkeyword = "";
//            foreach ($words as $word) {
//                if (pspell_check($pspell, $word)) {
//                    $newkeyword .= $word . " ";
//                } else {
//                    $suggestions = pspell_suggest($pspell, $word);
//
//                    if (count($suggestions)) {
//                        $newkeyword .= $suggestions[0] . " ";
//                    } else {
//                        $newkeyword .= $word . " ";
//                    }
//                }
//            }
//            return $newkeyword;
//        }
//        return $keyword;
//    }
//}
//if (!function_exists('missSpell')) {
//    function missSpell($keyword)
//    {
//        if ($keyword != "") {
//            $pspell = \pspell_new("en");
//            $words = explode(" ", $keyword);
//            $newkeyword = false;
//            foreach ($words as $word) {
//                if (pspell_check($pspell, $word)) {
//                } else {
//                    $suggestions = pspell_suggest($pspell, $word);
//
//                    if (count($suggestions)) {
//                        $newkeyword = true;
//                    } else {
//
//                    }
//                }
//            }
//            return $newkeyword;
//        }
//        return false;
//    }
//}