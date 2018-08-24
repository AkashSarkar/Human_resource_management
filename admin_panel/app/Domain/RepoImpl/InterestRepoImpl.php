<?php
/**
 * Created by PhpStorm.
 * User: deepita
 * Date: 5/29/18
 * Time: 3:08 PM
 */

namespace App\Domain\RepoImpl;

use App\Domain\Repo\InterestRepo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Modules\Interest\Models\InterestModel;

class InterestRepoImpl implements InterestRepo
{

    public function filterDT()
    {
        return InterestModel::select('id', 'name');
    }

    public function totalCountDT()
    {
        return InterestModel::count();
    }

    public function filterSingleDT()
    {
        return InterestModel::select('id');
    }

    public function create($obj)
    {
        return InterestModel::create([
            'name' => $obj['interest'],
        ]);
    }
    public function destroy($obj)
    {
        $del = InterestModel::where('id', $obj->id)
            ->count();
        if($del)
        {
            $del = InterestModel::where('id', $obj->id)
                ->delete();
        }
        return $del;
    }
    public function update($obj)
    {
        $edu=InterestModel::find($obj->id);
        if($edu)
        {
            $edu->name=$obj->e_interest;
            $edu->save();
        }
        return $edu;
    }
    public function show($obj)
    {

        $edu = InterestModel::select('name')->where('id', $obj->id);
        return $edu;
    }
}