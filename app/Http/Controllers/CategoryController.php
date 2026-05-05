<?php
namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //Direct to Category Page
    public function category()
    {
        $categories = Category::select('title', 'description', 'id')
            ->when(request('searchKey'), function ($query) {
                $query->whereAny(['title', 'description'], 'like', '%' . request('searchKey') . '%');
            })
            ->get();
        return view('admin.category', compact('categories'));
    }

    //Create Category Process
    public function createCategory(Request $request)
    {
        $this->categoryValidation($request);
        Category::create([
            'title'       => $request->title,
            'description' => $request->description,
        ]);
        return back();
    }

    //Delete Category Process
    public function deleteCategory($id)
    {
        Category::where('id', $id)->delete();
        return back()->with('deleteSuccess', 'Category Deleted Successfully');
    }

    //Direct to Edit Category Page
    public function editCategory($id)
    {
        $categories = Category::select('title', 'description', 'id')
            ->when(request('searchKey'), function ($query) {
                $query->whereAny(['title', 'description'], 'like', '%' . request('searchKey') . '%');
            })
            ->get();
        $category = Category::select('title', 'description', 'id')
            ->where('id', $id)
            ->first();

        return view('admin.categoryEdit', compact('categories', 'category'));
    }

    //Update Category List Process
    public function updateCategory(Request $request, $id)
    {
        $this->categoryValidation($request);
        Category::where('id', $id)->update([
            'title'       => $request->title,
            'description' => $request->description,
        ]);
        return to_route('admin#Category');
    }

    //Checking Validation for Category
    private function categoryValidation($request)
    {
        $request->validate([
            'title'       => 'required|max:20',
            'description' => 'required',
        ]);
    }
}
