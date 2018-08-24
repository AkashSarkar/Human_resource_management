<?php
/**
 * Created by PhpStorm.
 * User: deepita
 * Date: 5/29/18
 * Time: 3:08 PM
 */

namespace App\Domain\RepoImpl;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Domain\Repo\IndustryRepo;
use Modules\Industry\Models\IndustryModel;

class IndustryRepoImpl implements IndustryRepo
{

    public function filterDT()
    {
        return IndustryModel::select('id', 'name');
    }

    public function totalCountDT()
    {
        return IndustryModel::count();
    }

    public function filterSingleDT()
    {
        return IndustryModel::select('id');
    }

    public function create($obj)
    {
        return IndustryModel::create([
            'name' => $obj['industry'],
            'connection_type_id'=>3,

        ]);
    }
    public function destroy($obj)
    {
        $del_industry = IndustryModel::where('id', $obj->id)
            ->count();
        if($del_industry)
        {
            $del_industry = IndustryModel::where('id', $obj->id)
                ->delete();
        }
        return $del_industry;
    }
    public function update($obj)
    {
        $ind=IndustryModel::find($obj->id);
        if($ind)
        {
            $ind->name=$obj->e_industry;
            $ind->save();
        }
        return $ind;
    }
    public function show($obj)
    {

        $industry = IndustryModel::select('name')->where('id', $obj->id);
        return $industry;
    }
}