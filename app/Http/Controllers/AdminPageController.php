<?php

namespace App\Http\Controllers;
use App\Page;
use Illuminate\Http\Request;

class AdminPageController extends Controller
{
    function __construct()
    {
        $this->middleware(function($request, $next) {
            session(['module_active' => 'page']);
            return $next($request);
        });
    }

    function add() 
    {
        return view("admin.pages.add");
    }

    function store(Request $request) {
        $request->validate(
            [
                "title" => "required|string",
                "author" => "required|string",
                "content" => "required|string",
            ],
            [
                "required" => ":attribute không được để trống",
                "string" => ":attribute phải ở dạng chuỗi",
            ],
            [
                "title" => "Tiêu đề trang",
                "author" => "Người đăng",
                "content" => "Nội dung trang",
            ]
        );

        Page::create(
            [
                "title" => $request->input('title'),
                "author" => $request->input('author'),
                "content" => $request->input('content'),
                "status" => $request->input('status'),
            ]
        );
        return redirect('admin/page/add')->with('status', 'Thêm trang mới thành công!');
    }

    function list(Request $request) {
        $keyword = "";
        $state = $request->input('state');
        if($state == 'trash') {
            $pages = Page::onlyTrashed()->where("title", "LIKE", "%{$keyword}%")->paginate(20);
        } else {
            if($request -> input('keyword')) {
                $keyword = $request->input('keyword');
            }
            $pages = Page::where("title", "LIKE", "%{$keyword}%")->paginate(20);
        }
        $count_active = Page::count();
        $count_trash = Page::onlyTrashed()->count();
        $count_state = [$count_active, $count_trash];
        return view("admin.pages.list", compact('pages', 'count_state'));
    }

    function delete($id) {
        $page = Page::find($id);
        $page->delete();
        $page->update(['status'=>'wait']);
        return redirect('admin/page/list')->with('status', 'Xóa trang thành công!');
    }

    function action(Request $request) {
        $list_check = $request->input('list_check');
        if($list_check) {
            if(!empty($list_check)) {
                $act = $request->input('act');
                if($act == 'restore') {
                    Page::withTrashed()->whereIn("id", $list_check)->restore();
                    Page::whereIn("id", $list_check)->update(['status'=>'active']);
                    return redirect('admin/page/list')->with('status', 'Khôi phục trang thành công!');
                }
                if($act == 'delete') {
                    Page::whereIn("id", $list_check)->update(['status'=>'wait']);
                    Page::destroy($list_check);
                    return redirect('admin/page/list')->with('status', 'Khôi phục trang thành công!');
                }
                return redirect('admin/page/list')->with('error', 'Vui lòng chọn thao tác để thực thi thao tác!');
            }
        } else {
            return redirect('admin/page/list')->with('error', 'Vui lòng tích chọn bản ghi để thực thi thao tác!');
        }
    }

    function update($id) {
        $page = Page::find($id);
        return view("admin.pages.update", compact('page'));
    }

    function update_store(Request $request, $id) {
        $request->validate(
            [
                "title" => "required|string",
                "author" => "required|string",
                "desc" => "required|string",
                "content" => "required|string",
            ], 
            [
                "required" => ":attribute không được để trống",
                "string" => ":attribute phải ở dạng chuỗi",
            ],
            [
                "title" => "Tên trang",
                "author" => "Người tạo",
                "content" => "Nội dung trang",
            ]
        );
        Page::where('id', $id)->update(
            [
                "title" => $request->input('title'),
                "author" => $request->input('author'),
                "content" => $request->input('content'),
                "status" => $request->input('status'),
            ]
        );
        return redirect('admin/page/list')->with('status', 'Cập nhật trang thành công!');
    }
}
