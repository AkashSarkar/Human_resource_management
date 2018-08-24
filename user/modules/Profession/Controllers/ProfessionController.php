<?php
/**
 * Created by PhpStorm.
 * User: deepita
 * Date: 5/29/18
 * Time: 3:06 PM
 */

namespace Modules\Profession\Controllers;

use App\Domain\Repo\ProfessionRepo;
use App\Http\Controllers\BaseController;
use App\Models\Performance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Rules\In;
use Modules\Profession\Models\DataModel\Profession;
use Modules\Industry\Models\DataModel\Industry;
use App\Models\ErrorR;

use Illuminate\Support\Facades\Validator;
use Modules\Industry\Models\IndustryModel;

class ProfessionController extends BaseController
{
    private $professionRepo;

    public function __construct(ProfessionRepo $professionRepo)
    {

        $this->middleware('auth');
        parent::__construct();
        $this->professionRepo = $professionRepo;
    }

    public function index()
    {
        return view('Profession::list');
    }

    public function jsonDataTable(Request $request)
    {
        $responseData = [];
        $responseData['title'] = 'Profession';
        $responseData['status_code'] = 200;

        try {

            $columns = array(
                0 => 'id',
                1 => 'name'
            );
            $columns_condition = array(
                'id' => "=",
                'name' => "like",
            );
            $foreign_col = [

            ];

            $foreign_table = [

            ];

            $glob_searchable_col = [
                "professions" => [
                    0 => 'name'
                ]

            ];

            $glob_main_table = "professions";
            $totalData = $this->professionRepo->totalCountDT();
            $totalFilteredSync = false;
            $totalFiltered = $totalData;


            $model = $this->professionRepo->filterDT();
            $model_count = $this->professionRepo->filterSingleDT();

            $get_datatable_data = get_datatable_data($request, $model, $columns, $foreign_col, $foreign_table, $glob_searchable_col, $columns_condition, $glob_main_table, $model_count, $totalFilteredSync, $totalFiltered);

            $dataCast = [];
            foreach ($get_datatable_data['data'] as $value) {
                $profession = new Profession();
                $profession->castMe($value);
                $dataCast[] = $profession;
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
        $responseData['dataQuery'] = [DB::getQueryLog(), DB::connection('pgsql_front')->getQueryLog()];
//        return $this->resp($responseData, $responseData['status_code']);
        return response()->json($responseData);
    }


    public function store(Request $request)
    {
       try{
           $inputs = array(
               'profession' => $request->profession,
           );

           $rules = array(
               'profession' => "required|max:128",

           );
           $validate = Validator::make($inputs, $rules);

           if ($validate->fails()) {
               $errors = $validate->errors();
               $errors = json_decode($errors);
               $s=False;
               $m=$errors;
               $status=422;
//               return response()->json(['success' => FALSE, 'message' => $errors,], 422);
           } else {
               $profession = $this->professionRepo->create($request);
               $s=TRUE;
               $m='Successful';
               $status=200;
//               return response()->json(['success' => TRUE], 200);
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

    public function update(Request $request)
    {
        try{
            $inputs = array(
                'profession' => $request->e_profession,
            );
            $rules = array(
                'profession' => "required|max:128",
            );
            $validate = Validator::make($inputs, $rules);
            if ($validate->fails()) {
                $errors = $validate->errors();
                $errors = json_decode($errors);
                $s=FALSE;
                $m=$errors;
                $status=422;
//                return response()->json(['success' => FALSE, 'message' => $errors,], 422);
            } else {
                $ind = $this->professionRepo->update($request);
                $s=TRUE;
                $m['message']='Successsful';
                $status=200;
//                return response()->json(['success' => TRUE], 200);
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
//                return response()->json(['success' => FALSE, 'message' => $errors,], 422);
            } else {
                $profession = $this->professionRepo->destroy($request);
                $s=TRUE;
                $m='Successsful';
                $status=200;
//                return response()->json(['success' => TRUE, 'profession' => $profession], 200);
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
    public function show(Request $request)
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
//                return response()->json(['success' => FALSE, 'message' => $errors,], 422);
            } else {

                $ind = $this->professionRepo->show($request);
                $s=TRUE;
                $m='Successsful';
                $status=200;
//                return response()->json(['success' => TRUE, 'profession' => $ind], 200);
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
