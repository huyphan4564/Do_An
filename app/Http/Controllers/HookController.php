<?php

namespace App\Http\Controllers;

use App\Models\DanhMucModel;
use App\Models\HookModel;
use App\Models\PageModel;
use App\Models\SlidersModel;
use Illuminate\Http\Request;

class HookController extends Controller
{
    public function getViewDanhSach()
    {
        $perPage = intval(env('ITEM_PER_PAGE'));
        $data = HookModel::orderBy('ngay_tao', 'desc')->paginate($perPage);
        return view('auth.hooks.danh-sach',['hook' => $data]);
    }

    public function putHook(Request $request){
        $hook = new HookModel();

        $hook->id_hook_ = "";

        $hook->vi_tri_ = $request->vi_tri;
        if(strlen($hook->vi_tri_) == 0)
            return status("Vị trí không được bỏ trống", 400);
        if($hook->kiemTraViTri())
            return status("Tên vị trí đã tồn tại", 400);

        $hook->mo_ta_ = $request->mo_ta;
        $hook->id_tai_khoan_ = getIDTK();


        if($hook->them()){
            return status("Thêm hook thành công", 200);
        }
        return status("Thêm hook thất bại", 500);
    }

    public function postHook(Request $request){

        $hook = new HookModel();
        $hook->id_hook_ = $request->id_hook;

        $hook->vi_tri_ = $request->vi_tri;
        $hook->mo_ta_ = $request->mo_ta;
        $hook->id_tai_khoan_ = getIDTK();
        if($hook->capNhat()){
            return status("Cập nhật hook thành công", 200);
        }
        return status("Cập nhật hook thất bại", 500);
    }

    public function deleteHook(Request $request){
        $hook = new HookModel();
        $hook->id_hook_ = $request->id_hook;

        if($hook->xoa()){
            return status('Xóa tin tức thành công', 200);
        }
        return status('Xóa tin tức thất bại', 500);
    }
}
