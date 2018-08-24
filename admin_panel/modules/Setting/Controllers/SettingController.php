<?php
/**
 * Created by PhpStorm.
 * User: deepita
 * Date: 6/12/18
 * Time: 1:11 PM
 */

namespace Modules\Setting\Controllers;
use App\Http\Controllers\BaseController;
use App\Models\ErrorR;
use Illuminate\Http\Request;

//Repo
use App\Domain\Repo\PostRepo;

class SettingController extends BaseController
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
        return view('Setting::setting', ['posts' => $posts]);
    }
    public function update(Request $request)
    {

        $posts= $request->posts;
        $x=0;
        foreach ($posts as $post)
        {
            $x=$this->postRepo->update($post);
        }
        return $x;
        return response()->json($request->all());
    }
}