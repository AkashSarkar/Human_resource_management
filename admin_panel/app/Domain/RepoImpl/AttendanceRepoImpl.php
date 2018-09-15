<?php
/**
 * Created by PhpStorm.
 * User: deepiuiu
 * Date: 26/08/18
 * Time: 22:57
 */

namespace App\Domain\RepoImpl;


use App\Domain\Repo\AttendanceRepo as repo;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Modules\Attendance\Models\AttendanceModel as model;
use Modules\User\Models\EmployeeModel as employee;
use phpDocumentor\Reflection\Types\Null_;

class AttendanceRepoImpl implements repo
{

    public function filterDT()
    {
        return employee::select('id', 'name');
    }


    public function totalCountDT()
    {
        return employee::count();
    }

    public function filterSingleDT()
    {
        return employee::select('id');
    }

    public function create($obj)
    {
        return model::create([
            'user_id' => $obj['id'],
            'status' => 1,
            'date' => $obj['date']
        ]);
    }

    public function destroy($obj)
    {
        $del = model::where([
            ['user_id', $obj["id"]],
            ['date',$obj["date"]]
            ])
            ->count();
        if ($del) {
            $del = model::where([
                ['user_id', $obj["id"]],
                ['date',$obj["date"]]
                ])
                ->delete();
        }
        return $del;
    }

    public function update($request)
    {
        $s = model::find($request->id);
        if ($s) {
            $s->user_id = $request['e_employee_id'];
            $s->ac_name = $request['e_account_name'];
            $s->ac_number = $request['e_account_number'];
            $s->bank = $request['e_bank_name'];
            $s->ifsc = $request['e_ifsc'];
            $s->pan = $request['e_pan_number'];
            $s->branch = $request['e_branch'];

            $s->save();
        }
        return $s;
    }

    public function show($obj)
    {
        //TODO::
    }
}