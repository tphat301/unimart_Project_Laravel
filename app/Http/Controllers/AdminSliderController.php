<?php

namespace App\Http\Controllers;

use App\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminSliderController extends Controller
{
    public function __construct()
    {
        $this->middleware(function($request, $next) {
            session(["module_active" => "Slider"]);
            return $next($request);
        });
    }

    function list() {
        $sliders = Slider::withTrashed()->paginate(20);
        return view("admin.sliders.list", compact('sliders'));
    }

    function store(Request $request) {
        $request->validate(
            [
                "slider" => "required|unique:sliders",
            ],
            [
                "required" => ":attribute không được để trống",
                "unique" => ":attribute đã tồn tại trên hệ thống",
            ],
            [
                "slider" => "Ảnh",
            ]
        );

        if($request->hasFile('slider')) {
            $file = $request->slider;
            $file_name = $file->getClientOriginalName();
            $file->move('public/uploads', $file_name);
            $upload_file = "public/uploads/".$file_name;
        } 
        
        Slider::create(
            [
                "slider" => $upload_file,
                "author" => Auth::user()->name,
                "status" => $request->input('status')
            ]
        );
        return redirect('admin/slider/list')->with('status', 'Thêm slider thành công!');
    }

    function delete($id) {
        $slider = Slider::find($id);
        $slider->delete();
        $slider->update(['status'=>'wait']);
        return redirect('admin/slider/list')->with('status', 'Xóa slider thành công!');
    }

    function convert_status($id) {
        $slider = Slider::withTrashed()->find($id);
        if($slider->status == 'active') {
            $slider->update(['status'=>'wait']);
            $slider->destroy($id);
        } else {
            $slider->restore();
            $slider->update(['status'=>'active']);
        }
        return redirect('admin/slider/list')->with('status', 'Chuyển đổi trạng thái slider thành công!');
    }
}
