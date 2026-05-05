<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    //Direct to Profile Page
    public function profile()
    {
        $userInfo = User::select("name", 'email', 'address', 'phone', 'gender')
            ->where('id', Auth::user()->id)
            ->first();

        return view('admin.profile', compact('userInfo'));
    }

    //Update Profile Process
    public function updateProfile(Request $request)
    {
        $this->updateProfileValidation($request);

        User::where('id', Auth::user()->id)->update([
            'name'    => $request->name,
            'email'   => $request->email,
            'phone'   => $request->phone,
            'address' => $request->address,
            'gender'  => $request->gender,
        ]);

        return back()->with('success', 'Profile Updated Successfully.');
    }

    //Direct to Password Page
    public function password()
    {
        return view('admin.changePassword');
    }

    //Change Password Process
    public function changePassword(Request $request)
    {
        $oldPassword = Auth::user()->password;
        if (Hash::check($request->oldPassword, $oldPassword)) {
            $validator = $this->changePasswordValidation($request);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
            User::where('id', Auth::user()->id)->update([
                'password' => Hash::make($request->newPassword),
            ]);
            return back()->with('success', 'Password Changed Successfully');
        } else {
            return back()->with('fail', "Your Old Password does not Match");
        }
    }

    //Validation for Profile Update
    private function updateProfileValidation($request)
    {
        $request->validate([
            'name'    => 'required',
            'email'   => 'required|unique:users,email,' . Auth::user()->id,
            'phone'   => 'required|max:14',
            'address' => 'required|max:50',
            'gender'  => 'required',
        ]);
    }

    //Validation for Password Change
    private function changePasswordValidation($request)
    {
        return Validator::make($request->all(), [
            'newPassword'     => 'required|min:8|max:14',
            'confirmPassword' => 'required|same:newPassword|min:8|max:14',
        ]);
    }
}
