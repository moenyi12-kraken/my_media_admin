<?php
namespace App\Http\Controllers;

use App\Models\Action_log;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

class TrendPostController extends Controller
{
    //Direct to Trend Post Page
    public function trendPost()
    {
        $posts = Action_log::select('action_logs.id as action_log_id', 'posts.*', DB::raw('COUNT(action_logs.post_id) as view_count'))
            ->leftJoin('posts', 'posts.id', 'action_logs.post_id')
            ->groupBy('action_logs.post_id')
            ->when(request('searchKey'), function ($query) {
                $query->where('posts.title', 'like', '%' . request('searchKey') . '%');
            })
            ->paginate(3);
        return view('admin.trendPost', compact('posts'));
    }

    //Direct to Tren Post Detail
    public function trendPostDetail($id)
    {
        $post = Post::select('title', 'image', 'description')
            ->where('id', $id)
            ->first();
        return view('admin.trendPostDetail', compact('post'));
    }
}
