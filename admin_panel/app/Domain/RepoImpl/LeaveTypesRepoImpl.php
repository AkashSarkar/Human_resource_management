<?php
/**
 * Created by PhpStorm.
 * User: deepiuiu
 * Date: 26/08/18
 * Time: 22:57
 */

namespace App\Domain\RepoImpl;


use App\Domain\Repo\LeaveTypesRepo as repo;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Modules\Attendance\Models\LeaveTypesModel as model;
use phpDocumentor\Reflection\Types\Null_;

class LeaveTypesRepoImpl implements repo
{

    public function filterDT()
    {
        return model::select('id','name');
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
            'name'=>$obj['leave'],

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
            $s->name=$request['e_leave'];
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