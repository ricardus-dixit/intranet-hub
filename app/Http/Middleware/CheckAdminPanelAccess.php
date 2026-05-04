<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class CheckAdminPanelAccess
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if (!$user || !$user->hasAnyRole(['super_admin', 'admin'])) {
            throw new AuthorizationException('You do not have permission to access this panel.');
        }

        return $next($request);
    }
}
