<?php
/**
 * Created by PhpStorm.
 * User: deepita
 * Date: 5/29/18
 * Time: 3:06 PM
 */

namespace Modules\Industry\Controllers;

use App\Domain\Repo\IndustryRepo;
use App\Http\Controllers\BaseController;
use App\Models\Performance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Rules\In;
use Modules\Industry\Models\DataModel\Industry;
use App\Models\ErrorR;

use Illuminate\Support\Facades\Validator;
use Modules\Industry\Models\IndustryModel;

class IndustryController extends BaseController
{
    private $industryRepo;

    public function __construct(IndustryRepo $industryRepo)
    {

        $this->middleware('auth');
        parent::__construct();
        $this->industryRepo = $industryRepo;
    }

    public function index()
    {
//        dd($this->industryRepo->totalIndustry());
        return view('Industry::list');
    }

    public function jsonDataTable(Request $request)
    {
        $responseData = [];
        $responseData['title'] = 'Industry';
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
                "industries" => [
                    0 => 'name'
                ]

            ];

            $glob_main_table = "industries";
            $totalData = $this->industryRepo->totalCountDT();
            $totalFilteredSync = false;
            $totalFiltered = $totalData;


            $model = $this->industryRepo->filterDT();
            $model_count = $this->industryRepo->filterSingleDT();

            $get_datatable_data = get_datatable_data($request, $model, $columns, $foreign_col, $foreign_table, $glob_searchable_col, $columns_condition, $glob_main_table, $model_count, $totalFilteredSync, $totalFiltered);

            $dataCast = [];
            foreach ($get_datatable_data['data'] as $value) {
                $industry = new Industry();
                $industry->castMe($value);
                $dataCast[] = $industry;
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
       try {
           $inputs = array(
               'industry' => $request->industry,
           );

           $rules = array(
               'industry' => "required|max:128",

           );
           $validate = Validator::make($inputs, $rules);

           if ($validate->fails()) {
               $errors = $validate->errors();
               $errors = json_decode($errors);
               $s=FALSE;
               $m=$errors;
               $status=422;
//               return response()->json(['success' => FALSE, 'message' => $errors,], 422);
           } else {
               $industry = $this->industryRepo->create($request);
               $s=TRUE;
               $m='Successful';
               $status=200;
//               return response()->json(['success' => TRUE], 200);
           }
       }
    catch (\Exception $e) {
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
        try {
            $inputs = array(
                'industry' => $request->e_industry,
            );
            $rules = array(
                'industry' => "required|max:128",
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
                $ind = $this->industryRepo->update($request);
                $s=TRUE;
                $m='Successful';
                $status=200;
//                return response()->json(['success' => TRUE], 200);
            }
        }
    catch (\Exception $e) {
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
     try {
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
//             return response()->json(['success' => FALSE, 'message' => $errors,], 422);
         } else {
             $ind = $this->industryRepo->destroy($request);
             $s=TRUE;
             $m='Successful';
             $status=200;
//             return response()->json(['success' => TRUE, 'industry' => $ind], 200);
         }
     }
    catch (\Exception $e) {
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
        try {
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

                $ind = $this->industryRepo->show($request);
                $s=TRUE;
                $m='Successful';
                $status=200;
//                return response()->json(['success' => TRUE, 'industry' => $ind], 200);
            }
        }
    catch (\Exception $e) {
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
