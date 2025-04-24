<?php

namespace App\Http\Controllers;

use App\Models\DanhMucModel;
use App\Models\TagsModel;
use App\Models\TinTucModel;
use App\Models\TTucDMucModel;
use App\Models\TTucTagsModel;
use Illuminate\Http\Request;

class DanhMucController extends Controller
{
    public function getViewDanhSach(){
        $perPage = intval(env('ITEM_PER_PAGE'));
        $dm = DanhMucModel::orderBy('ngay_tao', 'desc')->paginate($perPage);
        return view('auth.danh-muc.danh-sach',['dm'=>$dm]);
    }

    public function getViewThem(){
        return view('auth.danh-muc.them');
    }

    public function putDanhMuc(Request $request){
        $dm = new DanhMucModel();

        $dm->id_danh_muc_ = "";
        $dm->tieu_de_ = $request->tieuDe;
        if(strlen($dm->tieu_de_) == 0)
            return status("Tiêu đề không được bỏ trống", 400);

        if($dm->kiemTraTieuDe())
            return status("Tiêu đề đã tồn tại", 400);

        $dm->url_ = $request->URL;
        if($dm->kiemTraURL())
            return status("URL đã tồn tại", 400);

        $dm->search_title_ = $request->searchTitle;
        $dm->search_description_ = $request->searchDescription;
        $dm->noi_dung_ = $request->noiDung;
        $dm->thumbnail_  = $request->thumbnail;
        $dm->id_tai_khoan_ = getIDTK();


        if($dm->them()){
            return status("Thêm danh mục thành công", 200);
        }
        return status("Thêm danh mục thất bại", 500);
    }

    public function getViewCapNhat($id_danh_muc){
        $dm = new DanhMucModel();
        $dm->id_danh_muc_ = $id_danh_muc;

        return view('auth.danh-muc.cap-nhat', ['dm' => $dm->chiTiet()]);
    }

    public function postDanhMuc(Request $request){
        $dm = new DanhMucModel();
        $dm->id_danh_muc_ = $request->id_danh_muc;

        $dm->tieu_de_ = $request->tieuDe;
        if(strlen($dm->tieu_de_) == 0)
            return status("Tiêu đề không được bỏ trống", 400);

        if($dm->kiemTraTieuDe())
            return status("Tiêu đề đã tồn tại", 400);

        $dm->url_ = $request->URL;
        if($dm->kiemTraURL())
            return status("URL đã tồn tại", 400);

        $dm->search_title_ = $request->searchTitle;
        $dm->search_description_ = $request->searchDescription;
        $dm->noi_dung_ = $request->noiDung;
        $dm->thumbnail_  = $request->thumbnail;

        if($dm->capNhat()){
            return status("Cập nhật tin tức thành công", 200);
        }
        return status("Cập nhật tin tức thất bại", 500);
    }
    public function deleteDanhMuc(Request $request){
        $dm = new DanhMucModel();
        $dm->id_danh_muc_ = $request->id_danh_muc;

        if($dm->xoa()){
            return status('Xóa tin tức thành công', 200);
        }
        return status('Xóa tin tức thất bại', 500);
    }
}
