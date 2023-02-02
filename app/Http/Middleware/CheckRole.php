<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
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
        if($check_role == "manager_all") {
            redirect("admin/user/add");
        } else {
            return redirect('dashboard');
        }

        

        // if($check_role == "manager_product" || $check_role == "manager_all") {
        //     redirect("admin/product/list");
        // } else {
        //     return redirect('dashboard');
        // }

        // if($check_role == "manager_page" || $check_role == "manager_all") {
        //     redirect("admin/page/list");
        // } else {
        //     return redirect('dashboard');
        // }
        
        return $next($request);
    }
}
