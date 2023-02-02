<?php

namespace App\Http\Controllers;
use App\Post;
use Illuminate\Http\Request;

class AdminCatPostController extends Controller
{
    function cat(Request $request) {
        $state = $request->input('state');
        $count_news = Post::where('post_cat', 'news')->count();
        $count_game = Post::where('post_cat', 'game')->count();
        $count_cat = [$count_news, $count_game]; 
        $list_state = ["delete" => "Xóa tạm thời"];
        if($state == 'trash') {
            $list_state = [
                "restore" => "Khôi phục",
                "forceDelete" => "Xóa vĩnh viễn"
            ];
            $cat_posts = Post::onlyTrashed()->paginate(20);
        } else {
            $cat_posts = Post::paginate(20);
        }
        $count_active = Post::count();
        $count_trash = Post::onlyTrashed()->count();
        $count_state = [$count_active, $count_trash];
        return view("admin.posts.cat", compact('cat_posts', 'count_state', 'list_state', 'count_cat'));
    }

    function delete($id) {
        $cat_post = Post::find($id);
        $cat_post -> delete();
        $cat_post->update(['status' => 'wait']);
        return redirect('admin/post/cat')->with('status', 'Xóa danh mục bài viết thành công!');
    }

    function action(Request $request) {
        $list_check = $request->input('list_check');
        if($list_check) {
            if(!empty($list_check)) {
                $act = $request->input('act');
                if($act == 'restore') {
                    Post::withTrashed()->whereIn("id", $list_check)->restore();
                    Post::whereIn("id", $list_check)->update(['status'=>'active']);
                    return redirect('admin/post/cat')->with('status', 'Khôi phục danh mục bài viết thành công!');
                }
                if($act == 'delete') {
                    Post::whereIn("id", $list_check)->update(['status'=>'wait']);
                    Post::destroy($list_check);
                    return redirect('admin/post/cat')->with('status', 'Xóa tạm thời danh mục bài viết thành công!');
                }
                if($act == 'forceDelete') {
                    Post::withTrashed()->whereIn("id", $list_check)->forceDelete();
                    return redirect('admin/post/cat')->with('status', 'Xóa vĩnh viễn danh mục bài viết thành công!');
                }
                return redirect('admin/post/cat')->with('error', 'Vui lòng chọn thao tác để thực thi thao tác!');
            }
        } else {
            return redirect('admin/post/cat')->with('error', 'Vui lòng tích chọn bản ghi để thực thi thao tác!');
        }
    }

    function cat_post_update($id) {
        $post = Post::find($id);
        return view("admin.posts.updateCat", compact('post'));
    }

    function cat_store(Request $request, $id) {
        Post::where('id', $id)->update(
            [
                "title" => $request->input('title'),
                "author" => $request->input("author"),
                "status" => $request->input("status"),
            ]
        );
        return redirect('admin/post/cat')->with('status', 'Cập nhật danh mục bài viết thành công!');
    }
}
