<?php
/**
 * Created by PhpStorm.
 * User: deepita
 * Date: 5/29/18
 * Time: 3:08 PM
 */

namespace App\Domain\RepoImpl;

use App\Domain\Repo\ProfessionRepo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Profession\Models\ProfessionModel;

class ProfessionRepoImpl implements ProfessionRepo
{

    public function filterDT()
    {
        return ProfessionModel::select('id', 'name');
    }

    public function totalCountDT()
    {
        return ProfessionModel::count();
    }

    public function filterSingleDT()
    {
        return ProfessionModel::select('id');
    }

    public function create($obj)
    {
        return ProfessionModel::create([
            'name' => $obj['profession'],
            'connection_type_id'=>2,

        ]);
    }
    public function destroy($obj)
    {
        $del = ProfessionModel::where('id', $obj->id)
            ->count();
        if($del)
        {
            $del = ProfessionModel::where('id', $obj->id)
                ->delete();
        }
        return $del;
    }
    public function update($obj)
    {
        $pro=ProfessionModel::find($obj->id);
        if($pro)
        {
            $pro->name=$obj->e_profession;
            $pro->save();
        }
        return $pro;
    }
    public function show($obj)
    {

        $pro = ProfessionModel::select('name')->where('id', $obj->id);
        return $pro;
    }
}