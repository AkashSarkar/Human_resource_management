<?php
/**
 * Created by PhpStorm.
 * User: deepita
 * Date: 5/29/18
 * Time: 3:06 PM
 */

namespace Modules\Department\Controllers;

use App\Domain\Repo\DepartmentRepo;
use App\Http\Controllers\BaseController;
use App\Models\Performance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Rules\In;
use App\Models\ErrorR;

use Illuminate\Support\Facades\Validator;

class DepartmentController extends BaseController
{
    private $departmentRepo;

    public function __construct(DepartmentRepo $departmentRepo)
    {

        $this->middleware('auth');
        parent::__construct();
        $this->departmentRepo = $departmentRepo;
    }

    public function index()
    {
//        $model = $this->departmentRepo->filterDT();
//        dd($model);
        return view('Department::list');
    }

    public function jsonDataTable(Request $request)
    {
        $responseData = [];
        $responseData['title'] = 'Department';
        $responseData['status_code'] = 200;

        try {

            $columns = array(
                0 => 'id',
                1 => 'department',
                2 => 'designation',
            );
            $columns_condition = array(
                'department' => "like",
            );
            $foreign_col = [

            ];

            $foreign_table = [

            ];

            $glob_searchable_col = [
                "departments" => [
                    0 => 'department',
                ]

            ];

            $glob_main_table = "departments";
            $totalData = $this->departmentRepo->totalCountDT();
            $totalFilteredSync = false;
            $totalFiltered = $totalData;


            $model = $this->departmentRepo->filterDT();
            $model_count = $this->departmentRepo->filterSingleDT();

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
                'department' => $request->department,
                'designation' => $request->designation,
            );

            $rules = array(
                'department' => "required|max:128",
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
                $interest = $this->departmentRepo->create($request);
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
                'e_department' => $request->e_department,
                'e_designation' => $request->e_designation,
            );

            $rules = array(
                'e_department' => "required|max:128",
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
                $ind = $this->departmentRepo->update($request);
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
                $interest = $this->departmentRepo->destroy($request);
                $s=TRUE;
                $m='Successful';
                $status=200;
//            return response()->json(['success' => TRUE, 'interest' => $interest], 200);
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

    }
