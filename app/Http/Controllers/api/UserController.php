<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Laravel\Fortify\Contracts\LogoutResponse;

class UserController extends Controller
{
    //

    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string',
            'phone' => 'string',
            'admin' => 'string',
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'phone' => $fields['phone'],
            'admin' => $fields['admin'],
            'work' => $request['work'],
            'password' => bcrypt($fields['password']),
        ]);

        if ($user)
            $response = [
                'isSuccess' => true,
                'message' => "registration is done",
                'user' => $user,
            ];
        else
            $response = [
                'isSuccess' => false,
                'message' => "registration error",
                'user' => null,
            ];

        return response($response, 201);
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $fields['email'])->first();
        // print_r($data);
        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'isSuccess' => false,
                'message' => 'These credentials do not match our records.',
                'user' => null,
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        $response = [
            'isSuccess' => true,
            'message' => "login successfully",
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function notification(Request $request)
    {
        //dd($request);
        $user = User::find($request['id']);

        $res = $user->update(array('notification_id' => $request['notification_id']));

        echo $res;
    }

    public function logout(Request $request)
    {

        //Auth::logout();
        $request->user()->tokens()->delete();

        /*

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        return [
            'isSuccess' => true,
            'message' => "Done",
        ];*/
    }

    public function index()
    {
        $data = User::all();
        return $this->sendResponse($data, 'users');
    }

    public function delete($id)
    {
        $data = User::find($id);

        if ($data != null) {
            $data->delete();
            return $this->sendResponse("", "تم الحذف بنجاح");
        } else {
            return $this->sendError("لم يتم الحذف");
        }
    }
}
