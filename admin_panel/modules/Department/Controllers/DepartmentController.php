<?php
/**
 * Created by PhpStorm.
 * User: deepita
 * Date: 5/24/18
 * Time: 12:43 PM
 */

namespace Modules\Department\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\Performance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Models\ErrorR;
use DB;

//Repo
use App\Domain\Repo\DepartmentRepo;
//use Modules\User\Models\User;

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
        return view('Department::list');
    }

    public function getUserData(Request $request)
    {
        $responseData = [];
        try {

            $columns = array(
                0 => 'id',
                1 => 'department',
                2 => 'designation',
            );
            $columns_condition = array(
                'department' => "like",
                'designation'=>"like",
            );
            $foreign_col = [

            ];

            $foreign_table = [

            ];

            $glob_searchable_col = [
                "department" => [
                    0 => 'department',
                    1 => 'designation',

                ]

            ];
            $glob_main_table = "department";
            $totalData = $this->departmentRepo->totalCountDT();
            $totalFilteredSync = false;
            $totalFiltered = $totalData;


            $model = $this->departmentRepo->filterDT();
            $model_count = $this->departmentRepo->filterSingleDT();

            $get_datatable_data = get_datatable_data($request, $model, $columns, $foreign_col, $foreign_table, $glob_searchable_col, $columns_condition, $glob_main_table, $model_count, $totalFilteredSync, $totalFiltered);
            $dataCast = [];
            foreach ($get_datatable_data['data'] as $value  ) {
                $dataCast[] = $value;
            }
            $responseData['draw'] = intval($request->input('draw'));
            $responseData['recordsTotal'] = $totalData;
            $responseData['recordsFiltered'] = $get_datatable_data['recordsFiltered'];;
            $responseData['data'] = $dataCast;


        } catch (\Exception $e) {
//            ErrorR::efail($e);
//            $responseData["success"] = False;
//            $responseData["message"] = "Technical Error";
            return $e->getMessage();
        }
        return response()->json($responseData);

    }

    public function store(Request $request)
    {
        $inputs = array(
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'dob' => $request->dob,
            'status' => $request->status,
            'role_id' => $request->role_id,

        );

        $rules = array(
            'first_name' => "required|max:128",
            'last_name' => "required|max:128",
            'status' => "required",
            'role_id' => "required",
        );
        $validate = Validator::make($inputs, $rules);

        if ($validate->fails()) {
            $errors = $validate->errors();
            $errors = json_decode($errors);
            return response()->json(['success' => FALSE, 'message' => $errors,], 422);
        } else {
            $registered_user = $this->departmentRepo->save($request);
            return response()->json(['success' => TRUE], 200);
        }
    }

    public function edit(Request $request)
    {
        $inputs = array(
            'first_name' => $request->e_first_name,
            'last_name' => $request->e_last_name,
            'gender' => $request->e_gender,
            'dob' => $request->e_dob,
            'status' => $request->e_status,
            'role_id' => $request->e_role_id,

        );

        $rules = array(
            'first_name' => "max:128",
            'last_name' => "max:128"
        );
        $validate = Validator::make($inputs, $rules);

        if ($validate->fails()) {
            $errors = $validate->errors();
            $errors = json_decode($errors);
            return response()->json(['success' => FALSE, 'message' => $errors,], 422);
        } else {
            $user = $this->departmentRepo->update($request);
            return response()->json(['success' => TRUE], 200);
        }
    }

    public function getUser(Request $request)
    {
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
            return response()->json(['success' => FALSE, 'message' => $errors,], 422);
        } else {
            $user = $this->departmentRepo->getOneUser($request);
            return response()->json(['success' => TRUE, 'user' => $user], 200);
        }
    }

    public function delete(Request $request)
    {
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
            return response()->json(['success' => FALSE, 'message' => $errors,], 422);
        } else {
            $user = $this->departmentRepo->delete($request);
            return response()->json(['success' => TRUE, 'user' => $user], 200);
        }
    }

    public function getRole()
    {
        $roles = DB::connection('pgsql_front')->table('roles')->get();
        $response = [];
        foreach ($roles as $role) {
            $response[$role->id] = $role->role;
        }
        return $response;
        //return response()->json(['success' => TRUE,'role'=>$response], 200);
    }
}