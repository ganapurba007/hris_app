<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Employee;
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
        $employeeID = Auth::user()->employee_id;
        $employee = Employee::find($employeeID);

        $request->session()->put('role', $employee->role->title);
        $request->session()->put('employee', $employee->id);

        if (!in_array($employee->role->title, $roles)) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
