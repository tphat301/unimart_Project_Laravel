<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
class AdminPostController extends Controller
{
    function __construct()
    {
        $this->middleware(function($request, $next) {
            session(['module_active'=>'post']);
            return $next($request);
        });
    }
    
    function add() {
        return view("admin.posts.add");
    }
    
    function store(Request $request) {
        $request->validate(
            [
                "title" => "required|string",
                "author" => "required|string",
                "slug" => "required|regex:/^[A-Za-z0-9_-]+$/",
                "thumb" => "required|unique:posts",
                "content" => "required|string",
                "desc" => "required|string",
            ],
            [
                "regex" => ":attribute chưa đúng định dạng",
                "unique" => ":attribute đã tồn tại trên hệ thống",
                "required" => ":attribute không được để trống",
                "string" => ":attribute phải ở dạng chuỗi",
            ],
            [
                "title" => "Tiêu đề bài viết",
                "author" => "Người đăng",
                "slug" => "Đường dẫn bài viết",
                "thumb" => "Ảnh bài viết",
                "content" => "Nội dung bài viết",
                "desc" => "Mô tả bài viết",
            ]
        );
        
        if($request->hasFile('thumb')) {
            $file = $request->thumb;
            $file_name = $file->getClientOriginalName();
            $file->move("public/uploads", $file_name);
            $upload_file_post = "public/uploads/".$file_name;
        } 
        
        Post::create(
            [
                "title" => $request->input('title'),
                "author" => $request->input('author'),
                "slug" => $request->input('slug'),
                "thumb" => $upload_file_post,
                "content" => $request->input('content'),
                "desc" => $request->input('desc'),
                "status" => $request->input('status'),
                "post_cat" => $request->input('post_cat'),
            ]
        );
        
        return redirect('admin/post/add')->with('status', 'Thêm bài viết thành công!');
    }

    function list(Request $request) {
        $keyword = "";
        $state = $request->input('state');
        $option = ['delete'=>'Xóa tạm thời'];
        if($state == 'trash') {
            $option = ['restore'=>'Khôi phục', 'forceDelete'=>'Xóa vĩnh viễn'];
            $posts = Post::onlyTrashed()->paginate(20);
        } else {
            if($request->input('keyword')) {
                $keyword = $request->input('keyword');
            }
            $posts = Post::where("title", "LIKE", "%{$keyword}%")->paginate(20);
        }
        $count_state_active = Post::count();
        $count_state_trash = Post::onlyTrashed()->count();
        $count = [$count_state_active, $count_state_trash];
        return view("admin.posts.list", compact("posts", "count", "option"));
    }

    function delete($id) {
        $post = Post::find($id);
        $post->delete();
        $post->update(['status' => 'wait']);
        return redirect('admin/post/list')->with('status', 'Xóa bài viết thành công!');
    }

    function action(Request $request) {
        $list_check = $request->input('list_check');
        if($list_check) {
            if(!empty($list_check)) {
                $act = $request->input('act');
                if($act == 'delete') {
                    Post::whereIn("id", $list_check)->update(['status'=>'wait']);
                    Post::destroy($list_check);
                    return redirect('admin/post/list')->with('status', 'Xóa bài viết thành công!');
                }
                if($act == 'restore') {
                    Post::withTrashed()->whereIn('id', $list_check)->restore();
                    Post::whereIn("id", $list_check)->update(['status'=>'active']);
                    return redirect('admin/post/list')->with('status', 'Khôi phục bài viết thành công!');
                }
                if($act == 'forceDelete') {
                    Post::withTrashed()->whereIn('id', $list_check)->forceDelete();
                    return redirect('admin/post/list')->with('status', 'Xóa vĩnh viễn bài viết thành công!');
                }
                return redirect('admin/post/list')->with('error', 'Thực hiện thao tác không thành công! Vui lòng chọn thao tác và thực hiện lại thao tác!');
            }
        } else {
            return redirect('admin/post/list')->with('error', 'Thực hiện thao tác không thành công!');
        }
    }

    function update($id) {
        $post = Post::find($id);
        return view("admin.posts.update", compact('post'));
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
                "title" => "Tên bài viết",
                "author" => "Người tạo",
                "desc" => "Mô tả bài viết",
                "content" => "Nội dung bài viết",
            ]
        );

        Post::where('id', $id)->update(
            [
                "title" => $request->input('title'),
                "author" => $request->input('author'),
                "desc" => $request->input('desc'),
                "content" => $request->input('content'),
                "status" => $request->input('status'),
            ]
        );
        return redirect('admin/post/list')->with('status', 'Cập nhật bài viết thành công!');
    }
}
