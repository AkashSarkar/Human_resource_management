<?php
/**
 * Created by PhpStorm.
 * User: deepita
 * Date: 5/29/18
 * Time: 3:06 PM
 */

namespace Modules\Company\Controllers;

use App\Domain\Repo\CompanyRepo;
use App\Http\Controllers\BaseController;
use App\Models\Performance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Rules\In;
use Modules\Company\Models\DataModel\Company;
use App\Models\ErrorR;

use Illuminate\Support\Facades\Validator;
use Modules\Company\Models\CompanyModel;

class CompanyController extends BaseController
{
    private $companyRepo;

    public function __construct(CompanyRepo $companyRepo)
    {

        $this->middleware('auth');
        parent::__construct();
        $this->companyRepo = $companyRepo;
    }

    public function index()
    {
        return view('Company::list');
    }

    public function jsonDataTable(Request $request)
    {
        $responseData = [];
        $responseData['title'] = 'Company';
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
                "companies" => [
                    0 => 'name'
                ]

            ];

            $glob_main_table = "companies";
            $totalData = $this->companyRepo->totalCountDT();
            $totalFilteredSync = false;
            $totalFiltered = $totalData;


            $model = $this->companyRepo->filterDT();
            $model_count = $this->companyRepo->filterSingleDT();

            $get_datatable_data = get_datatable_data($request, $model, $columns, $foreign_col, $foreign_table, $glob_searchable_col, $columns_condition, $glob_main_table, $model_count, $totalFilteredSync, $totalFiltered);

            $dataCast = [];
            foreach ($get_datatable_data['data'] as $value) {
                $company = new Company();
                $company->castMe($value);
                $dataCast[] = $company;
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
                'company' => $request->company,
            );

            $rules = array(
                'company' => "required|max:128",

            );
            $validate = Validator::make($inputs, $rules);

            if ($validate->fails()) {
                $errors = $validate->errors();
                $errors = json_decode($errors);
                $s = FALSE;
                $m = $errors;
                $status = 422;
//                return response()->json(['success' => FALSE, 'message' => $errors,], 422);
            } else {
                $company = $this->companyRepo->create($request);
                $s = TRUE;
                $m = 'Successful';
                $status = 200;

//                return response()->json(['success' => TRUE], 200);
            }
        } catch (\Exception $e) {
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
                'company' => $request->e_company,
            );
            $rules = array(
                'company' => "required|max:128",
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
                $ind = $this->companyRepo->update($request);
                $s = TRUE;
                $m = 'Successful';
                $status = 200;

//                return response()->json(['success' => TRUE], 200);
            }
        } catch (\Exception $e) {
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
                $s = FALSE;
                $m = $errors;
                $status = 422;

//                return response()->json(['success' => FALSE, 'message' => $errors,], 422);
            } else {
                $ind = $this->companyRepo->destroy($request);
                $s = TRUE;
                $m = 'Successful';
                $status = 200;

//                return response()->json(['success' => TRUE, 'company' => $ind], 200);
            }
        } catch (\Exception $e) {
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
                $s = False;
                $m = $errors;
                $status = 422;

//                return response()->json(['success' => FALSE, 'message' => $errors,], 422);
            } else {

                $ind = $this->companyRepo->show($request);
                $s = TRUE;
                $m = 'Successful';
                $status = 200;

//                return response()->json(['success' => TRUE, 'company' => $ind], 200);
            }
        } catch (\Exception $e) {
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
