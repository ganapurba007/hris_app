<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = Auth::user();
        if (!$user || !$user->employee || !$user->employee->role) {
            abort(403, 'Unauthorized action.');
        }

        $employee = $user->employee;
        $request->session()->put('role', $employee->role->title);
        $request->session()->put('employee', $employee->id);

        if (!in_array($employee->role->title, $roles)) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
