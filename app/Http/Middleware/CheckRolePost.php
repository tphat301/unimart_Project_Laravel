<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRolePost
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
        if($check_role == "manager_post" || $check_role == "manager_all") {
            redirect("admin/post/list");
            redirect("admin/post/add");
            redirect("admin/post/cat");
        } else {
            return redirect('dashboard');
        }
        return $next($request);
    }
}
