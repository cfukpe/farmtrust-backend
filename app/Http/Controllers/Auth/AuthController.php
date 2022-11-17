<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\Auth\UserRegistrationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Utilities\AppConstants;
use App\Utilities\AppHelpers;
use Mail;
use Symfony\Component\HttpKernel\Exception\HttpException;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');

        $token = Auth::attempt($credentials);
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }

        $user = User::with([
            'farm',
        ])->where('id', auth()->id())->first();

        return response()->json([
            'status' => 'success',
            'user' => $user,
            'token' => $token,
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'other_names' => 'string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required|min:6,',
            'is_farmer' => 'required|boolean'
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'other_names' => $request->other_names,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->is_farmer ? AppConstants::$FARMER : AppConstants::$INVESTOR
        ]);

        Mail::to($request->email)->send(new UserRegistrationMail);

        $token = Auth::login($user);
        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'user' => $user,
            'token' => $token,
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }

    public function refresh()
    {
        return response()->json([
            'status' => 'success',
            'user' => Auth::user(),
            'token' => Auth::refresh(),
        ]);
    }

    public function account()
    {
        return response()->json([
            'status' => 'success',
            'user' => User::with([
                'farm',
            ])->where('id', auth()->id())->first(),
        ]);
    }

    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'currentPassword' => 'required|string',
            'newPassword' => 'required|string',
            'passwordConfirmation' => 'required|string',
        ]);


        $user = User::find(auth()->id());

        if (!\Hash::check($request->currentPassword, $user->password)) {
            throw new HttpException(400, "Current password is not correct");
        }


        $user->update([
            'password' => \Hash::make($request->newPassword),
        ]);

        return AppHelpers::httpResponse($user);
    }
}
