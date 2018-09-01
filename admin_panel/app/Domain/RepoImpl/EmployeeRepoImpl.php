<?php
/**
 * Created by PhpStorm.
 * User: deepiuiu
 * Date: 26/08/18
 * Time: 22:57
 */

namespace App\Domain\RepoImpl;


use App\Domain\Repo\EmployeeRepo as repo;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Modules\User\Models\EmployeeModel as model;
use phpDocumentor\Reflection\Types\Null_;

class EmployeeRepoImpl implements repo
{

    public function filterDT()
    {
        return model::select('id', 'phone', 'dob', 'name', 'email', 'f_name', 'p_address', 'l_address', 'created_at');
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
            'name' => $obj['name'],
            'email' => $obj['email'],
            'password' => Hash::make($obj['password']),
            'f_name' => $obj['f_name'],
            'phone' => $obj['phone'],
            'dob' => $obj['dob'],
            'p_address' => $obj['p_address'],
            'l_address' => $obj['l_address'],
            'remember_token' => str_random(10)
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
             $s->name=$request['e_name'];
             $s->email=$request['e_email'];

             if($request->e_password!=Null)
             $s->password=Hash::make($request['e_password']);

             $s->f_name=$request['e_f_name'];
             $s->phone=$request['e_phone'];
             $s->dob=$request['e_dob'];
             $s->p_address=$request['e_p_address'];
             $s->l_address=$request['e_l_address'];

            $s->save();
        }
        return $s;
    }

    public function show($obj)
    {

        $edu = model::select('name')->where('id', $obj->id);
        return $edu;
    }
}