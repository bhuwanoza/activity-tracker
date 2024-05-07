<?php

namespace Nrm\ActivityTracker\Middleware;

use Closure;
use Nrm\ActivityTracker\Jobs\LogActivity;
use Illuminate\Support\Facades\Auth;

class ActivityTracker
{
    public function handle($request, Closure $next)
    {
        // Collect activity data
        $user = Auth::user();
        $activityData = [
            'user_id' => $user ? $user->id : null,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'url' => $request->fullUrl(),
            'method' => $request->method(),
            'created_at' => now(),
            'updated_at' => now(),
        ];

        // Dispatch the LogActivity job
        LogActivity::dispatch($activityData);

        return $next($request);
    }
}
