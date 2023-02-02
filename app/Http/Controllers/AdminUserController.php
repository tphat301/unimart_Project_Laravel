<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function __construct()
    {
        $this->middleware(function($request, $next) {
            session(["module_active" => "user"]);
            return $next($request);
        });
    }

    function list(Request $request) 
    {
        $list_state = ["delete"=>"Xóa tạm thời"];
        $state = $request->input("state");
        if($state == "trash") {
            $list_state = [
                "restore"=>"Khôi phục",
                "forceDelete"=>"Xóa vĩnh viễn"
            ];
            $users = User::onlyTrashed()->paginate(10);
        } else {
            $keyword = "";
            if($request->input("keyword")) {
                $keyword = $request->input("keyword");
            }
            $users = User::where("name", "LIKE", "%{$keyword}%")->paginate(10);
        }
        $count_user_active = User::count();
        $count_user_trash = User::onlyTrashed()->count();
        $count  = [$count_user_active, $count_user_trash];
        return view("admin.users.list", compact("users", "count", "list_state"));
    }

    function add() 
    {
        return view("admin.users.add");
    }

    function store(Request $request) 
    {
        $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ],
            [
                "required" => ":attribute không được để trống",
                "string" => ":attribute nhập vào phải là dạng ký tự",
                "max" => ":attribute chỉ cho phép nhập vào tối đa :max ký tự",
                "min" => ":attribute phải nhập vào ít nhất là :min ký tự",
                "unique" => ":attribute đã tồn tại trên hệ thống",
                "confirmed" => "Xác nhận mật khẩu không thành công"
            ],
            [
                "name" => "Họ và tên",
                "email" => "Email",
                "password" => "Mật khẩu"
            ]
        );
        User::create(
            [
                "name" => $request->input("name"),
                "email" => $request->input("email"),
                "role" => $request->input("role"),
                "password" => Hash::make($request->input("password"))
            ]
        );
        return redirect("admin/user/list")->with("status", "Thêm người dùng thành công!");
    }

    function delete($id) 
    {
        $user = User::find($id);
        $user->delete();
        return redirect("admin/user/list")->with("status", "Xóa người dùng thành công");
    }
    
    function action(Request $request) {
        $list_check = $request->input('list_check');
        if($list_check) {
            foreach($list_check as $key => $id) {
                if(Auth::id() == $id) {
                    unset($list_check[$key]);
                } 
            }
            if(!empty($list_check)) {
                $act = $request->input('act');
                if($act == "delete") {
                    User::destroy($list_check);
                    return redirect("admin/user/list")->with("status", "Bạn đã thao tác xóa thành công!");
                }
                if($act == "restore") {
                    User::withTrashed()->whereIn("id", $list_check)->restore();
                    return redirect("admin/user/list")->with("status", "Bạn đã thao tác khôi phục thành công!");
                }
                if($act == "forceDelete") {
                    User::withTrashed()->whereIn("id", $list_check)->forceDelete();
                    return redirect("admin/user/list")->with("status", "Bạn đã thao tác xóa vĩnh viễn thành công!");
                }
            }
            return redirect("admin/user/list")->with("error", "Bạn cần phải chọn thao tác để thực hiện thao tác!");
        } else {
            return redirect("admin/user/list")->with("error", "Thao tác không thành công!");
        }
    }

    function edit($id)
    {
        $user = User::find($id);
        return view("admin.users.edit", compact('user'));
    }

    function edit_store(Request $request, $id)
    {
        $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ],
            [
                "required" => ":attribute không được để trống",
                "string" => ":attribute nhập vào phải là dạng ký tự",
                "max" => ":attribute chỉ cho phép nhập vào tối đa :max ký tự",
                "min" => ":attribute phải nhập vào ít nhất là :min ký tự",
                "confirmed" => "Xác nhận mật khẩu không thành công"
            ],
            [
                "name" => "Họ và tên",
                "password" => "Mật khẩu"
            ]
        );
        User::find($id)->update(
            [
                "name" => $request->input("name"),
                "role" => $request->input("role"),
                "password" => Hash::make($request->input("password")) 
            ]
        );
        return redirect("admin/user/edit/{$id}")->with("status", "Bạn đã thao tác chỉnh sửa người dùng thành công!");
    }
}
