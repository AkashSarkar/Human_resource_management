<?php
/**
 * Created by PhpStorm.
 * User: deepiuiu
 * Date: 26/08/18
 * Time: 22:57
 */

namespace App\Domain\RepoImpl;


use App\Domain\Repo\NoticeRepo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Modules\Notice\Models\NoticeModel;

class NoticeRepoImpl implements NoticeRepo
{

    public function filterDT()
    {
        return NoticeModel::select('id', 'title','description','created_at');
    }

    public function totalCountDT()
    {
        return NoticeModel::count();
    }

    public function filterSingleDT()
    {
        return NoticeModel::select('id');
    }

    public function create($obj)
    {
        return NoticeModel::create([
                'title' => $obj['title'],
                'description' => $obj['description'],
        ]);
    }
    public function destroy($obj)
    {
        $del = NoticeModel::where('id', $obj->id)
            ->count();
        if($del)
        {
            $del = NoticeModel::where('id', $obj->id)
                ->delete();
        }
        return $del;
    }
    public function update($obj)
    {
        $edu=NoticeModel::find($obj->id);
        if($edu)
        {
            $edu->title=$obj->e_title;
            $edu->description=$obj->e_description;
            $edu->save();
        }
        return $edu;
    }
}