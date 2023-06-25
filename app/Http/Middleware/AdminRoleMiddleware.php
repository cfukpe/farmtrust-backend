<?php

namespace App\Http\Middleware;

use App\Traits\ApiResponses;
use App\Utilities\AppConstants;
use Closure;
use Illuminate\Http\Request;

class AdminRoleMiddleware
{
    use ApiResponses;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->user() && $request->user()->role === AppConstants::$ADMIN) {
            return $next($request);
        }

        return $this->forbiddenRequestAlert("Unauthorized");
    }
}