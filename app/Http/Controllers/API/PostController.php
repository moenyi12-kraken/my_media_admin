<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Action_log;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //For Post with Api
    public function allPosts()
    {
        $posts = Post::get();
        return response()->json([
            'posts' => $posts,
        ]);
    }

    //Searching Post Data
    public function postSearch(Request $request)
    {
        $posts = Post::where('title', 'like', '%' . $request->searching . '%')->get();
        return response()->json([
            'searchingData' => $posts,
        ]);
    }

    //Get Post Detail
    public function postDetail(Request $request)
    {
        $post = Post::where('id', $request->postId)->first();
        return response()->json([
            'post' => $post,
        ]);
    }

    //Action Log for View Count
    public function postActionLog(Request $request)
    {
        $data = [
            'user_id' => $request->userId,
            'post_id' => $request->postId,
        ];
        Action_log::create($data);
        $viewCount = Action_log::where('post_id', $request->postId)->get();
        return response()->json([
            'viewCount' => $viewCount,
        ]);
    }
}
