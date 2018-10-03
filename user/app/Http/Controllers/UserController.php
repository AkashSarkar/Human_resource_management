<?php
/**
 * Created by PhpStorm.
 * User: akash
 * Date: 10/3/18
 * Time: 4:37 PM
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $employee = DB::table('companies')->join('departments', 'companies.department_id', '=', 'departments.id')
            ->select('companies.user_id', 'departments.department', 'companies.designation', 'companies.doj', 'companies.salary')
            ->where('companies.user_id', auth::user()->id)->first();

        $bank = DB::table('bank_acs')->where('user_id', auth::user()->id)->first();
        $notices = DB::connection('pgsql_admin')->table('notice')->limit(5)->get();
        $holidays = DB::table('holidays')->limit(5)->get();
        $awards = DB::table("awards")->where('user_id', auth::user()->id)->limit(5)->get();
        $leave_types = DB::table('leave_types')->get();

        $month = date('m');
        $attendence = DB::table('attendances')->where([
            ['user_id', auth::user()->id],
            ["status", '=', 1]
        ])->whereRaw('extract(month from created_at) =?', [$month])->count();

        $numOfAwards = DB::table('awards')->where('user_id', auth::user()->id)->count();

        $last_leave = Db::table('leaves')->select('date')
            ->where([
                ['user_id', auth::user()->id],
                ['status', '=', "Approved"],
            ])->orderBy('date','asc')->first();
//        dd($last_leave);
        return view('layouts.master', ['employee' => $employee, 'bank' => $bank, 'notices' => $notices, 'holidays' => $holidays,
            'awards' => $awards, 'leave_types' => $leave_types, 'attendance' => $attendence, 'numOfAwards' => $numOfAwards,
            'last_leave'=>$last_leave]);
    }

    public function post(Request $request)
    {
//        dd($request->leaveType);
        $leave = DB::table('leaves')->insert(
            [
                'l_type_id' => $request->leaveType,
                'user_id' => auth::user()->id,
                'date' => $request->date,
                'reason' => $request->reason,
                'status' => "pending"
            ]
        );
        if ($leave) {
            return redirect('/home');
        }

    }
}