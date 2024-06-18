<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Laravel\Sanctum\PersonalAccessToken;

class AccessTokensController extends Controller
{
    //
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|string|max:155',
            'password' => 'required|string|min:6',
            'device_name' => 'string|max:155',
            // 'abilities' => 'unllable|array'
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            $device_name = $request->post('device_name', $request->userAgent());
            $token = $user->createToken($device_name);

            return Response::json([
                'code' => 1,
                'token' => $token->plainTextToken,
                'user' => $user
            ]);
        }

        return Response::json([
            'code' => 0,
            'message' => 'Invalid credentials'
        ]);
    }

    public function destory($token = null)
    {

        //Remove All Token
        //$user->tokens()->delete();

        $user = Auth::guard('sanctum')->user();

        $personalAccessToken = PersonalAccessToken::findToken($token);

        if (null === $token) {
            $user->currentAccessToken()->delete();
            return;
        }

        if (
            $user->id == $personalAccessToken->tokenable_id
            &&
            get_class($user) == $personalAccessToken->tokenable_id
        ) {
            $personalAccessToken->delete();
        }
    }
}