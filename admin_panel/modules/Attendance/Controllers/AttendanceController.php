<?php
/**
 * Created by PhpStorm.
 * User: deepita
 * Date: 5/29/18
 * Time: 3:06 PM
 */

namespace Modules\Attendance\Controllers;

use App\Domain\Repo\AttendanceRepo;
use App\Http\Controllers\BaseController;
use App\Models\Performance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Rules\In;
use App\Models\ErrorR;
use Carbon\Carbon as carbon;
use Illuminate\Support\Facades\Validator;

class AttendanceController extends BaseController
{
    private $attendancesRepo;

    public function __construct(AttendanceRepo $attendancesRepo)
    {

        $this->middleware('auth');
        parent::__construct();
        $this->attendancesRepo = $attendancesRepo;
    }

    public function index()
    {
        return view('Attendance::attendance');
    }

    public function jsonDataTable(Request $request)
    {
        $responseData = [];
        $responseData['title'] = 'Attendance';
        $responseData['status_code'] = 200;

        try {

            $columns = array(
                0 => 'id',
                1 => 'name'
            );
            $columns_condition = array(
                'name' => "like",
            );
            $foreign_col = [

            ];

            $foreign_table = [

            ];

            $glob_searchable_col = [
                "attendances" => [
                    0 => 'name'
                ]

            ];

            $glob_main_table = "attendances";
            $totalData = $this->attendancesRepo->totalCountDT();
            $totalFilteredSync = false;
            $totalFiltered = $totalData;


            $model = $this->attendancesRepo->filterDT();
            $model_count = $this->attendancesRepo->filterSingleDT();

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
        $status = 200;
        $payload = [];
        try {
            $payload["id"] = $request->id;
            $payload["date"] = carbon::now()->format('Y-m-d');
            $interest = $this->attendancesRepo->create($payload);
            $s = TRUE;
            $m = 'Successful';
            $status = 200;
//            return response()->json(['success' => TRUE], 200);

        } catch (\Exception $e) {
            ErrorR::efail($e);
            $s = False;
            $m = "Technical Error";
            $status = $e->getCode();
        } finally {
            Performance::log();
        }

        return response()->json(['success' => $s, 'message' => $m], 200);
    }

    public function update(Request $request)
    {
        /*  try{
              $inputs = array(
                  'e_leave' => $request->e_leave,
              );
              $rules = array(
                  'e_leave' => "required|max:128",
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
                  $ind = $this->attendancesRepo->update($request);
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

          return response()->json(['success' => $s, 'message' => $m,], $status);*/
    }

    public function destroy(Request $request)
    {
        $payload = [];
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
//            return response()->json(['success' => FALSE, 'message' => $errors,], 422);
            } else {
                $payload["id"] = $request->id;
                $payload["date"] = carbon::now()->format('Y-m-d');
                $interest = $this->attendancesRepo->destroy($payload);
                $s = TRUE;
                $m = 'Successful';
                $status = 200;
//            return response()->json(['success' => TRUE, 'interest' => $interest], 200);
            }
        } catch (\Exception $e) {
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
