<?php
/**
 * Created by PhpStorm.
 * User: deepiuiu
 * Date: 26/08/18
 * Time: 22:57
 */

namespace App\Domain\RepoImpl;


use App\Domain\Repo\ApplicationRepo as repo;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Modules\User\Models\ApplicationModel as model;
use phpDocumentor\Reflection\Types\Null_;
use Illuminate\Support\Facades\DB;

class ApplicationRepoImpl implements repo
{

    public function filterDT()
    {
        $m=DB::connection('pgsql_user')->table('leaves')
            ->join('leave_types','l_type_id','=','leave_types.id')
            ->select('leaves.*','leave_types.name as leave');
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
        //TODO::
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
            $s->status=$request['status'];

            $s->save();
        }
        return $s;
    }

    public function show($obj)
    {
      //Todo::
    }
}