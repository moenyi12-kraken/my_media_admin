<?php
namespace App\Http\Controllers;

use App\Models\Action_log;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    //Direct to Post Page
    public function post()
    {
        $posts = Post::select('id', 'title', 'image')
            ->when(request('searchKey'), function ($query) {
                $query->whereAny(['title', 'id'], 'like', '%' . request('searchKey') . '%');
            })
            ->get();
        $categories = Category::select('id', 'title')->get();
        return view('admin.post', compact('categories', 'posts'));
    }

    //Create Post Process
    public function createPost(Request $request)
    {
        $this->checkPostValidation($request);
        $data = [
            'title'       => $request->title,
            'description' => $request->description,
            'category_id' => $request->category,
        ];

        if (File::exists($request->image)) {
            $data['image'] = $this->saveImageProcess($request);
        }

        Post::create($data);
        return back();
    }

    //Delete Post Process
    public function deletePost($id)
    {
        $imageName = Post::select('image')->where('id', $id)->first();
        if (File::exists(public_path('postImage/' . $imageName->image))) {
            File::delete(public_path('postImage/' . $imageName->image));
        }
        Post::where('id', $id)->delete();
        Action_log::where('post_id', $id)->delete();
        return back();
    }

    //Direct to Post Edit Page
    public function editPost($id)
    {
        $posts = Post::select('id', 'title', 'image')
            ->when(request('searchKey'), function ($query) {
                $query->whereAny(['title', 'id'], 'like', '%' . request('searchKey') . '%');
            })
            ->get();
        $categories = Category::select('id', 'title')->get();
        $post       = Post::where('id', $id)->first();

        return view('admin.postEdit', compact('posts', 'categories', 'post'));
    }

    //Update Post Process
    public function updatePost(Request $request, $id)
    {
        $this->checkPostValidation($request);

        $data = [
            'title'       => $request->title,
            'description' => $request->description,
            'category_id' => $request->category,
        ];

        if ($request->hasFile('image')) {

            $oldImage     = Post::select('image')->where('id', $id)->first();
            $oldImageName = $oldImage->image;
            // if (public_path('postImage/' . $oldImageName)) {
            //     unlink(public_path('postImage/' . $oldImageName));
            // }
            if (File::exists(public_path('postImage/' . $oldImageName))) {
                File::delete(public_path('postImage/' . $oldImageName));
            }

            $data['image'] = $this->saveImageProcess($request);
        }

        Post::where('id', $id)->update($data);
        return to_route('admin#Post');
    }

    //Save Image Process
    private function saveImageProcess($request)
    {
        $fileName = uniqid() . '_' . $request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path() . '/postImage/', $fileName);
        return $fileName;
    }

    //Validation for Post
    private function checkPostValidation($request)
    {
        $request->validate([
            'title'       => 'required',
            'description' => 'required',
            'category'    => 'required',
        ]);
    }
}
