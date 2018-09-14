<?php
/**
 * Created by PhpStorm.
 * User: deepiuiu
 * Date: 26/08/18
 * Time: 22:57
 */

namespace App\Domain\RepoImpl;


use App\Domain\Repo\HolidayRepo as repo;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Modules\Holiday\Models\HolidayModel as model;
use phpDocumentor\Reflection\Types\Null_;

class HolidayRepoImpl implements repo
{

    public function filterDT()
    {
        return model::select('id','day','event')->orderby('day');
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
            'day'=>$obj['date'],
            'event'=>$obj['occasion'],
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
            $s->day=$request['e_date'];
            $s->event=$request['e_occasion'];
            $s->save();
        }
        return $s;
    }

    public function show($obj)
    {

        //Todo:implement show
    }
}