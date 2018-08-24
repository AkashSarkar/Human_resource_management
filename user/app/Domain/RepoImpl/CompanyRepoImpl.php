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
use App\Domain\Repo\CompanyRepo;
use Modules\Company\Models\CompanyModel;

class CompanyRepoImpl implements CompanyRepo
{

    public function filterDT()
    {
        return CompanyModel::select('id', 'name');
    }

    public function totalCountDT()
    {
        return CompanyModel::count();
    }

    public function filterSingleDT()
    {
        return CompanyModel::select('id');
    }

    public function create($obj)
    {
        return CompanyModel::create([
            'name' => $obj['company'],
            'connection_type_id'=>4,

        ]);
    }
    public function destroy($obj)
    {
        $del_industry = CompanyModel::where('id', $obj->id)
            ->count();
        if($del_industry)
        {
            $del_industry = CompanyModel::where('id', $obj->id)
                ->delete();
        }
        return $del_industry;
    }
    public function update($obj)
    {
        $ind=CompanyModel::find($obj->id);
        if($ind)
        {
            $ind->name=$obj->e_company;
            $ind->save();
        }
        return $ind;
    }
    public function show($obj)
    {

        $industry = CompanyModel::select('name')->where('id', $obj->id);
        return $industry;
    }
}