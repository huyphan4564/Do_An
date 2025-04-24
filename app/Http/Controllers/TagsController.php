<?php

namespace App\Http\Controllers;

use App\Models\DanhMucModel;
use App\Models\TagsModel;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function getViewDanhSach(){
        $perPage = intval(env('ITEM_PER_PAGE'));
        $tag = TagsModel::orderBy('ngay_tao', 'desc')->paginate($perPage);
        return view('auth.tags.danh-sach',['tags'=>$tag]);
    }

    public function getViewThem(){
        return view('auth.tags.them');
    }

    public function putTag(Request $request){
        $tag = new TagsModel();

        $tag->id_tag_ = "";
        $tag->tieu_de_ = $request->tieuDe;
        if(strlen($tag->tieu_de_) == 0)
            return status("Tiêu đề không được bỏ trống", 400);

        if($tag->kiemTraTieuDe())
            return status("Tiêu đề đã tồn tại", 400);


        $tag->url_ = $request->URL;
        if($tag->kiemTraURL())
            return status("URL đã tồn tại", 400);
        $tag->search_title_ = $request->searchTitle;
        $tag->search_description_ = $request->searchDescription;
        $tag->noi_dung_ = $request->noiDung;
        $tag->thumbnail_  = $request->thumbnail;
        $tag->id_tai_khoan_ = getIDTK();


        if($tag->them()){
            return status("Thêm tag thành công", 200);
        }
        return status("Thêm tag thất bại", 500);
    }

    public function getViewCapNhat($id_tag){
        $tag = new TagsModel();
        $tag->id_tag_ = $id_tag;

        return view('auth.tags.cap-nhat', ['tag' => $tag->chiTiet()]);
    }

    public function postTag(Request $request){
        $tag = new TagsModel();
        $tag->id_tag_ = $request->id_tag;

        $tag->tieu_de_ = $request->tieuDe;
        if(strlen($tag->tieu_de_) == 0)
            return status("Tiêu đề không được bỏ trống", 400);

        if($tag->kiemTraTieuDe())
            return status("Tiêu đề đã tồn tại", 400);

        $tag->url_ = $request->URL;
        if($tag->kiemTraURL())
            return status("URL đã tồn tại", 400);

        $tag->search_title_ = $request->searchTitle;
        $tag->search_description_ = $request->searchDescription;
        $tag->noi_dung_ = $request->noiDung;
        $tag->thumbnail_  = $request->thumbnail;

        if($tag->capNhat()){
            return status("Cập nhật tin tức thành công", 200);
        }
        return status("Cập nhật tin tức thất bại", 500);
    }

    public function deleteTag(Request $request){
        $tag = new TagsModel();
        $tag->id_tag_ = $request->id_tag;

        if($tag->xoa()){
            return status('Xóa tag thành công', 200);
        }
        return status('Xóa tag thất bại', 500);
    }
}
