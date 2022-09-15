<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiCheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $checkAdmin = Auth::check() && Auth::user()->role_id == config('custom.user_roles.admin') ||
                Auth::user()->role_id == config('custom.user_roles.writer');
            if ($checkAdmin) {
                return $next($request);
            }

            return response()->json([
                'messasge' => __('messages.you-dont-permission-access'),
            ], 403);
        } catch (\Throwable $th) {
            return response()->json([
                'messasge' => __('messages.you-dont-permission-access'),
            ], 403);
        }
    }
}
