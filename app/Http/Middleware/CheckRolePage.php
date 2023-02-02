<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRolePage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $check_role = Auth::user()->role;
        if($check_role == "manager_page" || $check_role == "manager_all") {
            redirect("admin/page/list");
            redirect("admin/page/add");
        } else {
            return redirect('dashboard');
        }
        return $next($request);
    }
}
