<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRoleProduct
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
        if($check_role == "manager_product" || $check_role == "manager_all") {
            redirect("admin/product/list");
            redirect("admin/product/add");
            redirect("admin/product/cat");
        } else {
            return redirect('dashboard');
        }
        return $next($request);
    }
}
