<?php
/**
 * Created by PhpStorm.
 * User: deepita
 * Date: 5/29/18
 * Time: 3:06 PM
 */

namespace Modules\User\Controllers;

use App\Domain\Repo\ApplicationRepo;
use App\Http\Controllers\BaseController;
use App\Models\Performance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Rules\In;
use Modules\User\Models\EmployeeModel as employees;
use App\Models\ErrorR;

use Illuminate\Support\Facades\Validator;
use Modules\User\Models\EmployeeModel;

class ApplicationController extends BaseController
{
    private $applicationRepo;

    public function __construct(ApplicationRepo $applicationRepo)
    {

        $this->middleware('auth');
        parent::__construct();
        $this->applicationRepo = $applicationRepo;

    }

    public function index()
    {
//        dd("hi");

//        $model = $this->employeeRepo->filterDT();
//        dd($model);
        return view('User::application');
    }

    public function jsonDataTable(Request $request)
    {
        $responseData = [];
        $responseData['title'] = 'Application';
        $responseData['status_code'] = 200;

        try {

            $columns = array(
                0 => 'user_id',
                1 => 'leave',
                2 => 'date',
                3 => 'reason',
                4 => 'status'

            );
            $columns_condition = array(
                'status' => "like",
            );
            $foreign_col = [

            ];

            $foreign_table = [

            ];

            $glob_searchable_col = [
                "leaves" => [
                    0 => 'status',
                ]

            ];

            $glob_main_table = "leaves";
            $totalData = $this->applicationRepo->totalCountDT();
            $totalFilteredSync = false;
            $totalFiltered = $totalData;


            $model = $this->applicationRepo->filterDT();
            $model_count = $this->applicationRepo->filterSingleDT();

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
        //TODO::
    }

    public function update(Request $request)
    {
        try{
            $inputs = array(

                'status'=>$request['status'],

            );
            $connection = 'pgsql_user';
            $id=$request->id;
            $rules = array(
                'status'=>"required",
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
                $ind = $this->applicationRepo->update($request);
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
                $interest = $this->applicationRepo->destroy($request);
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
