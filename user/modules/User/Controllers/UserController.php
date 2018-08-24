<?php
/**
 * Created by PhpStorm.
 * User: deepita
 * Date: 5/24/18
 * Time: 12:43 PM
 */

namespace Modules\User\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\Performance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Modules\User\DataModel\UserCast;
use App\Models\ErrorR;
use DB;

//Repo
use App\Domain\Repo\UserRepo;
use Modules\User\Models\User;

class UserController extends BaseController
{
    private $userRepo;

    public function __construct(UserRepo $userRepo)
    {
        $this->middleware('auth');
        parent::__construct();
        $this->userRepo = $userRepo;
    }

    public function index()
    {
        //$users = $this->userRepo->allUser();
        //dd($users);
        return view('User::list');
    }

    public function getUserData(Request $request)
    {
        $responseData = [];
        try {

            $columns = array(
                0 => 'id',
                1 => 'hash_id',
                2 => 'first_name',
                3 => 'last_name',
                4 => 'gender',
                5 => 'status',
            );
            $columns_condition = array(
                'hash_id' => "=",
                'first_name' => "like",
                'last_name' => "like",
            );
            $foreign_col = [

            ];

            $foreign_table = [

            ];

            $glob_searchable_col = [
                "users" => [
                    0 => 'hash_id',
                    1 => 'first_name',
                    2 => 'last_name',

                ]

            ];
            $glob_main_table = "users";
            $totalData = User::count();
            $totalFilteredSync = false;
            $totalFiltered = $totalData;


            $model = User::select('id', 'hash_id', 'first_name', 'last_name', 'role_id', 'status', 'gender', 'dob');

            $model_count = User::select('id');

            $get_datatable_data = get_datatable_data($request, $model, $columns, $foreign_col, $foreign_table, $glob_searchable_col, $columns_condition, $glob_main_table, $model_count, $totalFilteredSync, $totalFiltered);
            $dataCast = [];
            foreach ($get_datatable_data['data'] as $user) {
                $cast = new UserCast();
                $cast->castMe($user);
                $dataCast[] = $cast;
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
            $registered_user = $this->userRepo->save($request);
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
            $user = $this->userRepo->update($request);
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
            $user = $this->userRepo->getOneUser($request);
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
            $user = $this->userRepo->delete($request);
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