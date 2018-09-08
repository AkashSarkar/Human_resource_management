<?php
/**
 * Created by PhpStorm.
 * User: deepiuiu
 * Date: 26/08/18
 * Time: 22:57
 */

namespace App\Domain\RepoImpl;


use App\Domain\Repo\DepartmentRepo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Modules\Department\Models\DepartmentModel as model;

class DepartmentRepoImpl implements DepartmentRepo
{

    public function filterDT()
    {
        return model::select('id', 'department','designation');
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
            'department' => $obj['department'],
            'designation' => $obj['designation'],

        ]);
    }
    public function destroy($obj)
    {
        $del = model::where('id', $obj->id)
            ->count();
        if($del)
        {
            $del = model::where('id', $obj->id)
                ->delete();
        }
        return $del;
    }
    public function update($obj)
    {
        $edu=model::find($obj->id);
        if($edu)
        {
            $edu->designation=$obj->e_designation;
            $edu->department=$obj->e_department;

            $edu->save();
        }
        return $edu;
    }
    public function show($obj)
    {

        $edu = model::select('name')->where('id', $obj->id);
        return $edu;
    }
    public function details()
    {
        return model::all();
    }
}