<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\StoreRequest;
use App\Models\Admin;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Exception;

class AdminController extends Controller
{
    use ResponseTrait;

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index (Request $request): JsonResponse
    {
        try {
            $data = [];

            return $this->responseSuccess($data);
        } catch (Exception $e) {
            Log::error("Error get list employee", [
                "method" => __METHOD__,
                "line" => __LINE__,
                "message" => $e->getMessage(),
                "data" => request(["email", "password"]),
            ]);
            return $this->responseError();
        }
    }

    /**
     * @param StoreRequest $request
     * @return JsonResponse
     */
    public function store (StoreRequest $request): JsonResponse
    {
        try {
            $employee = new Admin();

            $employee->name = $request->input('name');
            $employee->email = $request->input('email');
            $employee->status = Admin::STATUS['ACTIVATE'];
            $employee->password = Hash::make($request->input('password'));
            $employee->save();

            return $this->responseSuccess($employee);
        } catch (Exception $e) {
            Log::error("Error store employee", [
                "method" => __METHOD__,
                "line" => __LINE__,
                "message" => $e->getMessage(),
                "data" => $request->all(),
            ]);
            return $this->responseError();
        }
    }
}
