<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureRegistrarIsInRightDepartment
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
        //CHECK IF THE USER IS IN THE RIGHT DEPARTMENT
        if(auth()->user()->department->slug !== $request->route('department')->slug){
            return redirect()->route('registrar.dashboard', auth()->user()->department);
        }

        return $next($request);
    }
}
