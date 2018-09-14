<?php
/**
 * Created by PhpStorm.
 * User: deepiuiu
 * Date: 26/08/18
 * Time: 22:57
 */

namespace App\Domain\RepoImpl;


use App\Domain\Repo\AwardRepo as repo;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Modules\User\Models\AccountModel as model;
use phpDocumentor\Reflection\Types\Null_;

class AwardRepoImpl implements repo
{

    public function filterDT()
    {
        return model::select('id','user_id','award','month','year','gift');
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
            'award'=>$obj['award'],
            'month'=>$obj['month'],
            'year'=>$obj['year'],
            'gift'=>$obj['gift'],
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
            $s->month=$request['e_month'];
            $s->year=$request['e_year'];
            $s->gift=$request['e_gift'];
            $s->award=$request['e_award'];

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