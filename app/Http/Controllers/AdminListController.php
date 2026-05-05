<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminListController extends Controller
{
    //Direct to Admin List
    public function adminList()
    {
        $adminList = User::select('name', 'id', 'email', 'address', 'phone', 'gender')->get();
        return view('admin.adminList', compact('adminList'));
    }

    //Delete Admin Account Process
    public function DeleteAdminList($id)
    {
        User::where('id', $id)->delete();
        return back()->with('deleteSuccess', 'Admin Accout Deleted Successfully');
    }

    //Searching Admin Accounts
    public function searchAdminList(Request $request)
    {
        $adminList = User::whereAny(['name', 'id', 'email', 'address', 'phone', 'gender'], 'like', '%' . $request->searchKey . '%')
            ->get();
        return view('admin.adminList', compact('adminList'));
    }
}
