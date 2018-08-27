<?php
/**
 * Created by PhpStorm.
 * User: deepita
 * Date: 5/29/18
 * Time: 3:06 PM
 */

namespace Modules\Notice\Controllers;

use App\Domain\Repo\NoticeRepo;
use App\Http\Controllers\BaseController;
use App\Models\Performance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Rules\In;
use App\Models\ErrorR;

use Illuminate\Support\Facades\Validator;


class NoticeController extends BaseController
{
    private $noticeRepo;

    public function __construct(NoticeRepo $noticeRepo)
    {

        $this->middleware('auth');
        parent::__construct();
        $this->noticeRepo = $noticeRepo;
    }

    public function index()
    {
        return view('Notice::list');
    }

    public function jsonDataTable(Request $request)
    {
        $responseData = [];
        $responseData['title'] = 'Notice';
        $responseData['status_code'] = 200;

        try {

            $columns = array(
                0 => 'id',
                1 => 'title',
                2 => 'description',
                3 => 'created_at',

            );
            $columns_condition = array(
                'title' => "like",
            );
            $foreign_col = [

            ];

            $foreign_table = [

            ];

            $glob_searchable_col = [
                "notice" => [
                    0 => 'title'
                ]

            ];

            $glob_main_table = "notice";
            $totalData = $this->noticeRepo->totalCountDT();
            $totalFilteredSync = false;
            $totalFiltered = $totalData;


            $model = $this->noticeRepo->filterDT();
            $model_count = $this->noticeRepo->filterSingleDT();

            $get_datatable_data = get_datatable_data($request, $model, $columns, $foreign_col, $foreign_table, $glob_searchable_col, $columns_condition, $glob_main_table, $model_count, $totalFilteredSync, $totalFiltered);

            $dataCast = [];
            foreach ($get_datatable_data['data'] as $value) {
                $dataCast[] = $value;
            }
            $responseData['draw'] = intval($request->input('draw'));
            $responseData['recordsTotal'] = $totalData;
            $responseData['recordsFiltered'] = $get_datatable_data['recordsFiltered'];;
            $responseData['data'] = $dataCast;


        } catch (\Exception $e) {
            ErrorR::efail($e);
            $responseData["success"] = False;
            $responseData["message"] = "Technical Error";
            $responseData['status_code'] = $e->getCode();
        } finally {
            Performance::log();
        }
//        $responseData['dataQuery'] = [DB::getQueryLog(), DB::connection('pgsql_front')->getQueryLog()];
//        return $this->resp($responseData, $responseData['status_code']);
        return response()->json($responseData);
    }
    public function store(Request $request)
    {
        try{
            $inputs = array(
                'title' => $request->title,
                'description' => $request->description,
            );

            $rules = array(
                'title' => "required|max:100",
                'description' => "required|max:300",

            );
            $validate = Validator::make($inputs, $rules);

            if ($validate->fails()) {
                $errors = $validate->errors();
                $errors = json_decode($errors);
                $s=FALSE;
                $m=$errors;
                $status=422;
//            return response()->json(['success' => FALSE, 'message' => $errors,], 422);
            } else {
                $interest = $this->noticeRepo->create($request);
                $s=TRUE;
                $m='Successful';
                $status=200;
//            return response()->json(['success' => TRUE], 200);
            }
        }catch (\Exception $e) {
            ErrorR::efail($e);
            $s = False;
            $m = "Technical Error";
            $status = $e->getCode();
        } finally {
            Performance::log();
        }

        return response()->json(['success' => $s, 'message' => $m,], $status);
    }

    public function update(Request $request)
    {
        try{
            $inputs = array(
                'e_title' => $request->e_title,
                'e_description' => $request->e_description,
            );

            $rules = array(
                'e_title' => "required|max:100",
                'e_description' => "required|max:300",

            );
            $validate = Validator::make($inputs, $rules);
            if ($validate->fails()) {
                $errors = $validate->errors();
                $errors = json_decode($errors);
                $s=FALSE;
                $m=$errors;
                $status=422;
//            return response()->json(['success' => FALSE, 'message' => $errors,], 422);
            } else {
                $ind = $this->noticeRepo->update($request);
                $s=TRUE;
                $m='Successful';
                $status=200;
//            return response()->json(['success' => TRUE], 200);
            }
        }catch (\Exception $e) {
            ErrorR::efail($e);
            $s = False;
            $m = "Technical Error";
            $status = $e->getCode();
        } finally {
            Performance::log();
        }

        return response()->json(['success' => $s, 'message' => $m,], $status);
    }
    public function destroy(Request $request)
    {
        try{
            $inputs = array(
                'id' => $request->id,
            );

            $rules = array(
                'id' => "required"
            );
            $validate = Validator::make($inputs, $rules);

            if ($validate->fails()) {
                $errors = $validate->errors();
                $errors = json_decode($errors);
                $s=FALSE;
                $m=$errors;
                $status=422;
//            return response()->json(['success' => FALSE, 'message' => $errors,], 422);
            } else {
                $interest = $this->noticeRepo->destroy($request);
                $s=TRUE;
                $m='Successful';
                $status=200;
//            return response()->json(['success' => TRUE, 'interest' => $interest], 200);
            }
        }catch (\Exception $e) {
            ErrorR::efail($e);
            $responseData["success"] = False;
            $responseData["message"] = "Technical Error";
            $responseData['status_code'] = $e->getCode();
        } finally {
            Performance::log();
        }
        $responseData["success"] = $s;
        $responseData["message"] = $m;
        $responseData['status_code'] = $status;
        return respJOk($responseData);
    }

    }
