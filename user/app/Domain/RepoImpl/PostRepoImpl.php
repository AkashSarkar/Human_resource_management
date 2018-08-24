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
use App\Domain\Repo\PostRepo;
use Modules\Post\Models\Post;

class PostRepoImpl implements PostRepo
{

    public function allPost()
    {
        //$p= Post::where('id','=',173)->get();
        $p = Post::all();
        return $p;

    }

    public function totalPosts()
    {
        $p = Post::count();
        return $p;
    }

    public function totalArticles()
    {
        $p = Post::where('post_type_id',5)->count();
        return $p;
    }

    public function totalAwards()
    {
        $p = Post::where('post_type_id',2)->count();
        return $p;
    }

    public function totalConferences()
    {
        $p = Post::where('post_type_id',6)->count();
        return $p;
    }

    public function totalEvents()
    {
        $p = Post::where('post_type_id',4)->count();
        return $p;
    }

    public function totalProjects()
    {
        $p = Post::where('post_type_id',7)->count();
        return $p;
    }

    public function totalPromotions()
    {
        $p = Post::all()->where('post_type_id',3)->count();
        return $p;
    }

    public function totalStatus()
    {
        $p = Post::all()->where('post_type_id',1)->count();
        return $p;
    }
    public function update($params)
    {
        $post=Post::find($params['id']);
        if($post)
        {
            $post->post_type_id=$params['post_type_id'];
            $post->user_id=$params['user_id'];
            $post->save();
        }
        return $post;
    }
}