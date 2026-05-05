<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //User Login with API
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (isset($user)) {
            if (Hash::check($request->password, $user->password)) {
                return response()->json([
                    'user'  => $user,
                    'token' => $user->createToken(time())->plainTextToken,
                ]);
            } else {
                return response()->json([
                    'user'  => null,
                    'token' => null,
                ]);
            }
        } else {
            return response()->json([
                'user'  => null,
                'token' => null,
            ]);
        }
    }

    //User Register with API
    public function register(Request $request)
    {
        $validator = $this->validationRegister($request);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }
        $data = [
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ];

        User::create($data);

        $user = User::where('email', $request->email)->first();

        return response()->json([
            'user'  => $user,
            'token' => $user->createToken(time())->plainTextToken,
        ]);
    }

    private function validationRegister($request)
    {
        return Validator::make($request->all(), [
            'name'            => 'required',
            'email'           => 'required|unique:users,email',
            'password'        => 'required|min:8|max:14',
            'confirmPassword' => 'required|min:8|max:14|same:password',
        ]);
    }

}
