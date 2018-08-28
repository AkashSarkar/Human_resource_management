<?php
/**
 * Created by PhpStorm.
 * User: deepiuiu
 * Date: 26/08/18
 * Time: 22:57
 */

namespace App\Domain\RepoImpl;


use App\Domain\Repo\ExpenseRepo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Modules\Expense\Models\ExpenseModel;

class ExpenseRepoImpl implements ExpenseRepo
{

    public function filterDT()
    {
        return ExpenseModel::select('id', 'item','purchase_from','purchase_date','price');
    }

    public function totalCountDT()
    {
        return ExpenseModel::count();
    }

    public function filterSingleDT()
    {
        return ExpenseModel::select('id');
    }

    public function create($obj)
    {
        return ExpenseModel::create([
            'item' => $obj['item'],
            'purchase_from' => $obj['purchase'],
            'purchase_date' => $obj['date'],
            'price' => $obj['price'],
        ]);
    }
    public function destroy($obj)
    {
        $del = ExpenseModel::where('id', $obj->id)
            ->count();
        if($del)
        {
            $del = ExpenseModel::where('id', $obj->id)
                ->delete();
        }
        return $del;
    }
    public function update($obj)
    {
        $edu=ExpenseModel::find($obj->id);
        if($edu)
        {
            $edu->item=$obj->e_item;
            $edu->purchase_from=$obj->e_purchase;
            $edu->purchase_date=$obj->e_date;
            $edu->price=$obj->e_price;
            $edu->save();
        }
        return $edu;
    }
    public function show($obj)
    {

        $edu = ExpenseModel::select('name')->where('id', $obj->id);
        return $edu;
    }
}