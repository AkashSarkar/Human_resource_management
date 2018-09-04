<?php
/**
 * Created by PhpStorm.
 * User: deepita
 * Date: 5/29/18
 * Time: 3:06 PM
 */

namespace Modules\User\Controllers;

use App\Domain\Repo\PositionRepo;
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

class PositionController extends BaseController
{
    private $positionRepo;

    public function __construct(PositionRepo $positionRepo)
    {

        $this->middleware('auth');
        parent::__construct();
        $this->positionRepo = $positionRepo;

    }

    public function index()
    {
//        dd("hi");

//        $model = $this->employeeRepo->filterDT();
//        dd($model);
        return view('User::position');
    }

    public function jsonDataTable(Request $request)
    {
        $responseData = [];
        $responseData['title'] = 'Employee Position';
        $responseData['status_code'] = 200;

        try {

            $columns = array(
                0 => 'user_id',
                1 => 'ac_name',
                2 => 'ac_number',
                3 => 'bank',
                4 => 'ifsc',
                5 => 'pan',
                6 => 'branch',

            );
            $columns_condition = array(
                'ac_name' => "like",
                'ac_number' => "like",
            );
            $foreign_col = [

            ];

            $foreign_table = [

            ];

            $glob_searchable_col = [
                "companies" => [
                    0 => 'ac_name',
                    1 => 'ac_number',
                ]

            ];

            $glob_main_table = "companies";
            $totalData = $this->positionRepo->totalCountDT();
            $totalFilteredSync = false;
            $totalFiltered = $totalData;


            $model = $this->positionRepo->filterDT();
            $model_count = $this->positionRepo->filterSingleDT();

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

                'employee_id'=>$request['employee_id'],
                'account_name'=>$request['account_name'],
                'account_number'=>$request['account_number'],
                'bank_name'=>$request['bank_name'],
                'ifsc'=>$request['ifsc'],
                'pan_number'=>$request['pan_number'],
                'branch'=>$request['branch'],
            );
            $connection = 'pgsql_user';
            $rules = array(

                'employee_id'=>"required|unique:$connection.bank_acs,user_id",
                'account_name'=>"required",
                'account_number'=>"required|min:10|max:20|unique:$connection.bank_acs,ac_number",
                'bank_name'=>"required|min:4|max:50",
                'ifsc'=>"required|max:20",
                'pan_number'=>"required|min:10|max:20",
                'branch'=>"required|min:6|max:200",


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
                $interest = $this->positionRepo->create($request);
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

                'e_employee_id'=>$request['e_employee_id'],
                'e_account_name'=>$request['e_account_name'],
                'e_account_number'=>$request['e_account_number'],
                'e_bank_name'=>$request['e_bank_name'],
                'e_ifsc'=>$request['e_ifsc'],
                'e_pan_number'=>$request['e_pan_number'],
                'e_branch'=>$request['e_branch'],
            );
            $connection = 'pgsql_user';
            $id=$request->id;
            $rules = array(

                'e_employee_id'=>"required|unique:$connection.bank_acs,user_id,$id",
                'e_account_name'=>"required",
                'e_account_number'=>"required|min:10|max:20|unique:$connection.bank_acs,ac_number,$id",
                'e_bank_name'=>"required|min:4|max:50",
                'e_ifsc'=>"required|max:20",
                'e_pan_number'=>"required|min:10|max:20",
                'e_branch'=>"required|min:6|max:200",


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
                $ind = $this->positionRepo->update($request);
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
                $interest = $this->positionRepo->destroy($request);
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
