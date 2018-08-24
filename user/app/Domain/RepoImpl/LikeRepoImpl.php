<?php
namespace App\Domain\RepoImpl;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Domain\Repo\LikeRepo;
use Modules\UserResponse\Models\Like;
use Modules\Authentication\Models\User;
use Illuminate\Support\Facades\DB;

class LikeRepositoryImpl implements LikeRepo {

    
    public function deleteLike($id){
       
        //TODO: Raw query
         $del_like = Like::where('id', $id)
                          ->delete();
     
         
         return $del_like;
     }

   

    public function allLikeCount(){
        return Like::count();
    }

   
}