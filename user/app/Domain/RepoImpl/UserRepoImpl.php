<?php
/**
 * Created by PhpStorm.
 * User: deepita
 * Date: 5/23/18
 * Time: 2:00 PM
 */
namespace App\Domain\RepoImpl;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Domain\Repo\UserRepo;
use Modules\User\Models\User;
class UserRepoImpl implements UserRepo {

    public function allUser(){
        $user = User::all();
        return $user;

    }

    public function save($params)
    {

        $hash_id = $this->generateHashId();
        return User::create([
            'hash_id' => $hash_id,
            'first_name' => $params['first_name'],
            'last_name' => $params['last_name'],
            'gender' => $params['gender'],
            'dob' => $params['dob'],
            'status' => $params['status'],
            "role_id" => $params['role_id'],
        ]);

    }
    public function update($obj)
    {
        $user=User::find($obj->id);
        if($user)
        {
            $user->first_name=$obj->e_first_name;
            $user->last_name =$obj->e_last_name;
            $user->gender =$obj->e_gender;
            $user->dob =$obj->e_dob;
            $user->role_id =$obj->e_role_id;
            $user->status =$obj->e_status;
            $user->save();
        }
        return $user;


    }
    public function generateHashId()
    {
        $hashId = getRandomTokenString('6', env('HASHID_CHAR'));
        $exists = User::where('hash_id', '=', $hashId)
            ->count();
        if ($exists > 0) {
            $this->generateHashId();
        } else {
            return $hashId;
        }
    }

    public function delete($params){

        //TODO: Raw query
        $del_user = User::where('id', $params->id)
            ->count();
        if($del_user)
        {
            $del_user = User::where('id', $params->id)
                ->delete();
        }
        return $del_user;
    }
    public function getOneUser($params){
        //TODO: Raw query
        $user = User::where('id', $params->id)
            ->get();
        return $user;
    }


}