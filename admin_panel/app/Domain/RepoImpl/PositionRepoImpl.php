<?php
/**
 * Created by PhpStorm.
 * User: deepiuiu
 * Date: 26/08/18
 * Time: 22:57
 */

namespace App\Domain\RepoImpl;


use App\Domain\Repo\PositionRepo as repo;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Modules\User\Models\PositionModel as model;
use phpDocumentor\Reflection\Types\Null_;
use Illuminate\Support\Facades\DB;

class PositionRepoImpl implements repo
{

    public function filterDT()
    {
//        return model::select('id','ac_name','ac_number','bank','ifsc','pan','branch','user_id');
        $m=DB::connection('pgsql_user')->table('companies')
            ->join('departments','department_id','=','departments.id')
            ->select('companies.*','departments.department as d_name');
        return $m;
    }


    public function totalCountDT()
    {
        return model::count();
    }

    public function filterSingleDT()
    {
        return model::select('id');
    }

    public function create($obj)
    {
        return model::create([
            'user_id'=>$obj['employee_id'],
            'department_id'=>$obj['department'],
            'designation'=>$obj['designation'],
            'doj'=>$obj['date_of_joining'],
            'doe'=>$obj['date_of_exit'],
            'salary'=>$obj['salary'],
            'status'=>$obj['status']
        ]);
    }

    public function destroy($obj)
    {
        $del = model::where('id', $obj->id)
            ->count();
        if ($del) {
            $del = model::where('id', $obj->id)
                ->delete();
        }
        return $del;
    }

    public function update($request)
    {
        $s = model::find($request->id);
        if ($s) {
            $s->user_id=$request['e_employee_id'];
            $s->department_id=$request['e_department'];
            $s->designation=$request['e_designation'];
            $s->doj=$request['e_date_of_joining'];
            $s->doe=$request['e_date_of_exit'];
            $s->salary=$request['e_salary'];
            $s->status=$request['e_status'];

            $s->save();
        }
        return $s;
    }

    public function show($obj)
    {

        $edu = model::select('name')->where('id', $obj->id);
        return $edu;
    }
}