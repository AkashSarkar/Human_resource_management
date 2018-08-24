<?php
/**
 * Created by PhpStorm.
 * User: deepita
 * Date: 5/29/18
 * Time: 3:08 PM
 */

namespace App\Domain\RepoImpl;

use App\Domain\Repo\EducationRepo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Modules\Education\Models\EducationModel;

class EducationRepoImpl implements EducationRepo
{

    public function filterDT()
    {
        return EducationModel::select('id', 'name');
    }

    public function totalCountDT()
    {
        return EducationModel::count();
    }

    public function filterSingleDT()
    {
        return EducationModel::select('id');
    }

    public function create($obj)
    {
        return EducationModel::create([
            'name' => $obj['education'],
        ]);
    }
    public function destroy($obj)
    {
        $del = EducationModel::where('id', $obj->id)
            ->count();
        if($del)
        {
            $del = EducationModel::where('id', $obj->id)
                ->delete();
        }
        return $del;
    }
    public function update($obj)
    {
        $edu=EducationModel::find($obj->id);
        if($edu)
        {
            $edu->name=$obj->e_education;
            $edu->save();
        }
        return $edu;
    }
    public function show($obj)
    {

        $edu = EducationModel::select('name')->where('id', $obj->id);
        return $edu;
    }
}