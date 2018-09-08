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
//        $m=$this->positionRepo->filterDT();
//        dd($m);rr
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
                1 => 'd_name',
                2 => 'designation',
                3 => 'doj',
                4 => 'salary',
                5 => 'status',

            );
            $columns_condition = array(
            );
            $foreign_col = [

            ];

            $foreign_table = [

            ];

            $glob_searchable_col = [
                "companies" => [

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
                'department'=>$request['department'],
                'designation'=>$request['designation'],
                'date_of_joining'=>$request['date_of_joining'],
                'date_of_exit'=>$request['date_of_exit'],
                'salary'=>$request['salary'],
                'status'=>$request['status']
            );
            $connection = 'pgsql_user';
            $rules = array(

                'employee_id'=>"required|unique:$connection.companies,user_id",
                'department'=>"required",
                'designation'=>"required",
                'date_of_joining'=>"required",
                'salary'=>"required|max:8",
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
                'e_department'=>$request['e_department'],
                'e_designation'=>$request['e_designation'],
                'e_date_of_joining'=>$request['e_date_of_joining'],
                'e_date_of_exit'=>$request['e_date_of_exit'],
                'e_salary'=>$request['e_salary'],
                'e_status'=>$request['e_status']
            );
            $connection = 'pgsql_user';
            $id=$request->id;
            $rules = array(

                'e_employee_id'=>"required|unique:$connection.companies,user_id,$id",
                'e_department'=>"required",
                'e_designation'=>"required",
                'e_date_of_joining'=>"required",
                'e_salary'=>"required|max:8",
                'e_status'=>"required",


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
