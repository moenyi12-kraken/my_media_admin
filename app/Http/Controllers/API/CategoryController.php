<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Get Category with API
    public function category()
    {
        $categories = Category::select('id', 'title', 'description')->get();
        return response()->json([
            'categories' => $categories,
        ]);
    }

    //Searching Category
    public function categorySearch(Request $request)
    {
        $data = Post::select('*')->where('category_id', $request->categoryId)->get();

        return response()->json([
            'posts' => $data,
        ]);
    }
}
