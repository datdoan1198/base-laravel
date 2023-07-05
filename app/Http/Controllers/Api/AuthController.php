<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Exception;

class AuthController extends Controller
{
    use ResponseTrait;

    /**
     * @return JsonResponse
     */
    public function login(): JsonResponse
    {
        try {
            $credentials = request(["email", "password"]);

            if (!$token = auth()->attempt($credentials)) {
                return response()->json(["error" => "Unauthorized"], 401);
            }

            return $this->respondWithToken($token);
        } catch (Exception $e) {
            Log::error("Error login", [
                "method" => __METHOD__,
                "line" => __LINE__,
                "message" => $e->getMessage(),
                "data" => request(["email", "password"]),
            ]);
            return response()->json(["error" => "Unauthorized"], 401);
        }
    }


    /**
     * @param $token
     * @return JsonResponse
     */
    protected function respondWithToken($token): JsonResponse
    {
        return response()->json([
            "access_token" => $token,
//            "encrypt_token" => Crypt::encryptString($token),
            "token_type" => "bearer",
            "expires_in" => auth()->factory()->getTTL() * 60
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function me(): JsonResponse
    {
        $admin = Admin::query()->where("id", Auth::id())->first();
        return response()->json($admin);
    }

    public function register (RegisterRequest $request): JsonResponse
    {
        try {
            $admin = new Admin();
            $admin->name = $request->input('name');
            $admin->email = $request->input('email');
            $admin->status = Admin::STATUS['ACTIVATE'];
            $admin->password = Hash::make($request->input('password'));
            $admin->save();

            return $this->responseSuccess();
        } catch (Exception $e) {
            Log::error('Error store admin', [
                'method' => __METHOD__,
                'line' => __LINE__,
                'message' => $e->getMessage(),
                'data' => $request->all()
            ]);

            return $this->responseError();
        }
    }



    /**
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        auth()->logout();

        return response()->json(["message" => "Đăng xuất thành công"]);
    }
}
