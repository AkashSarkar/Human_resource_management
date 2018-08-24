<?php
/**
 * Created by PhpStorm.
 * User: deepita
 * Date: 5/23/18
 * Time: 2:51 PM
 */

namespace Modules\Post\Controllers;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Modules\Post\DataModel\PostCast;
use App\Models\ErrorR;

//Repo
use App\Domain\Repo\PostRepo;

class PostController extends BaseController
{
    private $postRepo;

    public function __construct(PostRepo $postRepo)
    {
        $this->middleware('auth');
        parent::__construct();
        $this->postRepo = $postRepo;
    }

    public function index()
    {
        $posts = $this->postRepo->allPost();
        return view('Post::post', ['posts' => $posts]);
    }
    public function totalPosts()
    {
        $responseData=[];
        try{
            $posts = $this->postRepo->totalPosts();
            $status = $this->postRepo->totalStatus();
            $event = $this->postRepo->totalEvents();
            $award = $this->postRepo->totalAwards();
            $promotion = $this->postRepo->totalPromotions();
            $conference = $this->postRepo->totalConferences();
            $article = $this->postRepo->totalArticles();
            $project = $this->postRepo->totalProjects();
            $responseData['posts']=$posts;
            $responseData['status']=$status;
            $responseData['event']=$event;
            $responseData['award']=$award;
            $responseData['promotion']=$promotion;
            $responseData['conference']=$conference;
            $responseData['article']=$article;
            $responseData['project']=$project;
        }catch (\Exception $e) {
//            ErrorR::efail($e);
//            $responseData["success"] = False;
//            $responseData["message"] = "Technical Error";
            return $e->getMessage();
        }
        return response()->json($responseData);

        //dd($posts);

    }

    public function getPosts()
    {
        $responseData['post'] = [];
        try {

            $columns = array(
                0 => 'id',
                1 => 'hash_id',
                2 => 'post_data',
                3 => 'post_type_id',
                4 => 'user_id',
                5 => 'is_commentable',
                6 => 'is_shareable',
                7 => 'created_at',
                8 => 'updated_at',
            );
            $columns_condition = array(
                'id' => "=",
                'hash_id' => "like",
                'user_id' => "like",
                'post_type_id' => "=",
            );
            $foreign_col = [

            ];

            $foreign_table = [

            ];

            $glob_searchable_col = [
                "posts" => [
                    0 => 'id',
                    1 => 'created_at',
                    2 => 'hash_id',
                    3 => 'post_type_id',
                    4 => 'is_commentable',
                    5 => 'user_id',
                    6=>'is_shareable',
                ]

            ];
            $posts = $this->postRepo->allPost();
            $i=0;
            foreach($posts as $post){
                $cast = new PostCast();
                $cast->castMe($post);
                $responseData['post'][$i] = $cast;
                $i++;

            }
            return response()->json($responseData);

        } catch (\Exception $e) {
            ErrorR::efail($e);
            $responseData["success"] = False;
            $responseData["message"] = "Technical Error";
            return respJErroR($responseData, $e);
        }
    }
}