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

class PositionRepoImpl implements repo
{

    public function filterDT()
    {
        return model::select('id','ac_name','ac_number','bank','ifsc','pan','branch','user_id');
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
            'ac_name'=>$obj['account_name'],
            'ac_number'=>$obj['account_number'],
            'bank'=>$obj['bank_name'],
            'ifsc'=>$obj['ifsc'],
            'pan'=>$obj['pan_number'],
            'branch'=>$obj['branch'],
            'user_id'=>$obj['employee_id']
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
            $s->ac_name=$request['e_account_name'];
            $s->ac_number=$request['e_account_number'];
            $s->bank=$request['e_bank_name'];
            $s->ifsc=$request['e_ifsc'];
            $s->pan=$request['e_pan_number'];
            $s->branch=$request['e_branch'];

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