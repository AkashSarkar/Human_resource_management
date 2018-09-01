<?php
/**
 * Created by PhpStorm.
 * User: deepita
 * Date: 5/29/18
 * Time: 3:06 PM
 */

namespace Modules\User\Controllers;

use App\Domain\Repo\EmployeeRepo;
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

class EmployeeController extends BaseController
{
    private $employeeRepo;
    protected $connection;

    public function __construct(EmployeeRepo $employeeRepo)
    {

        $this->middleware('auth');
        parent::__construct();
        $this->employeeRepo = $employeeRepo;

    }

    public function index()
    {
//        dd("hi");

//        $model = $this->employeeRepo->filterDT();
//        dd($model);
        return view('User::employee');
    }

    public function jsonDataTable(Request $request)
    {
        $responseData = [];
        $responseData['title'] = 'Employee';
        $responseData['status_code'] = 200;

        try {

            $columns = array(
                0 => 'id',
                1 => 'name',
                2 => 'f_name',
                3 => 'email',
                4 => 'phone',
                5 => 'dob',
                6 => 'p_address',
                7 => 'l_address',
            );
            $columns_condition = array(
                'name' => "like",
                'email' => "like",
            );
            $foreign_col = [

            ];

            $foreign_table = [

            ];

            $glob_searchable_col = [
                "users" => [
                    0 => 'name',
                    1 => 'email'
                ]

            ];

            $glob_main_table = "users";
            $totalData = $this->employeeRepo->totalCountDT();
            $totalFilteredSync = false;
            $totalFiltered = $totalData;


            $model = $this->employeeRepo->filterDT();
            $model_count = $this->employeeRepo->filterSingleDT();

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

                'name'=>$request['name'],
                'email'=>$request['email'],
                'password'=>$request['password'],
                'f_name'=>$request['f_name'],
                'phone'=>$request['phone'],
                'dob'=>$request['dob'],
                'p_address'=>$request['p_address'],
                'l_address'=>$request['l_address'],
            );
            $connection = 'pgsql_user';
            $rules = array(

                'name'=>"required|min:4|max:30",
                'email'=>"required|string|email|max:255|unique:$connection.users,email",
                'password'=>"required|min:6|max:20",
                'f_name'=>"required|min:4|max:30",
                'phone'=>"required|max:11",
                'p_address'=>"required|min:12|max:200",
                'l_address'=>"required|min:6|max:200",


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
                $interest = $this->employeeRepo->create($request);
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
                'e_name'=>$request['e_name'],
                'e_email'=>$request['e_email'],
                'e_password'=>$request['e_password'],
                'e_f_name'=>$request['e_f_name'],
                'e_phone'=>$request['e_phone'],
                'e_dob'=>$request['e_dob'],
                'e_p_address'=>$request['e_p_address'],
                'e_l_address'=>$request['e_l_address'],

            );
            $connection = 'pgsql_user';
            $id=$request->id;
            $rules = array(

                'e_name'=>"required|min:4|max:30",
                'e_email'=>"required|string|email|max:255unique:$connection.users,email,$id",
                'e_f_name'=>"required|min:4|max:30",
                'e_phone'=>"required|max:11",
                'e_p_address'=>"required|min:12|max:200",
                'e_l_address'=>"required|min:6|max:200",


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
                $ind = $this->employeeRepo->update($request);
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
                $interest = $this->employeeRepo->destroy($request);
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
