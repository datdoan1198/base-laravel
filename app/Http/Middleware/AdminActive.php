<?php

namespace App\Http\Middleware;

use App\Models\Admin;
use Closure;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AdminActive
{
    use ResponseTrait;

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $admin = Admin::query()->where("id", Auth::id())->first();
            if (empty($admin)) {
                return $this->responseError(
                    'error',
                    'Unauthorized',
                    Response::HTTP_UNAUTHORIZED,
                    401
                );
            }

            if ($admin->status === Admin::STATUS["DEACTIVATE"]) {
                return $this->responseError(
                    'error',
                    [
                        'error_status' => ['Tài khoản của bạn đã bị khóa']
                    ],
                    Response::HTTP_UNAUTHORIZED,
                    401
                );
            }
            return $next($request);
        } else{
            return $this->responseError(
                'error',
                'Unauthorized',
                Response::HTTP_UNAUTHORIZED,
                401
            );
        }
    }
}
