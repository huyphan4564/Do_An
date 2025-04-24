<?php

namespace App\Http\Controllers;

use App\Models\DanhMucModel;
use App\Models\HookModel;
use App\Models\PageModel;
use App\Models\TTucDMucModel;
use App\Models\TTucTagsModel;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function getViewDanhSach(){
        $perPage = intval(env('ITEM_PER_PAGE'));
        $data = PageModel::orderBy('ngay_tao', 'desc')->paginate($perPage);
        return view('auth.page.danh-sach',['page'=>$data]);
    }

    public function getViewThem(){
        $hookModel = new HookModel();
        return view('auth.page.them', ['hooks' => $hookModel->danhSach()]);
    }

    public function putPage(Request $request){
        $page = new PageModel();

        $page->id_pages_ = "";
        $page->tieu_de_ = $request->tieuDe;
        if(strlen($page->tieu_de_) == 0)
            return status("Tiêu đề không được bỏ trống", 400);

        if($page->kiemTraTieuDe())
            return status("Tiêu đề đã tồn tại", 400);

        $page->url_ = $request->URL;
        if($page->kiemTraURL())
            return status("URL đã tồn tại", 400);

        $page->search_title_ = $request->searchTitle;
        $page->search_description_ = $request->searchDescription;
        $page->noi_dung_ = $request->noiDung;
        $page->thumbnail_  = $request->thumbnail;
        $page->xuat_ban_ = $request->xuatBan;
        $page->id_tai_khoan_ = getIDTK();
        $page->id_hook_ = $request->id_hook;


        if($page->them()){
            return status("Thêm page thành công", 200);
        }
        return status("Thêm page thất bại", 500);
    }

    public function getViewCapNhat($id_pages){
        $PageModel = new PageModel();
        $PageModel->id_pages_ = $id_pages;
        $page = $PageModel->chiTiet();
        $hookModel = new HookModel();
        return view('auth.page.cap-nhat', ['page' => $page, 'hooks'=>$hookModel->danhSach()]);
    }

    public function postPage(Request $request){
        $page = new PageModel();
        $page->id_pages_ = $request->id_pages;

        $page->tieu_de_ = $request->tieuDe;
        if(strlen($page->tieu_de_) == 0)
            return status("Tiêu đề không được bỏ trống", 400);

        if($page->kiemTraTieuDe())
            return status("Tiêu đề đã tồn tại", 400);

        $page->url_ = $request->URL;
        if($page->kiemTraURL())
            return status("URL đã tồn tại", 400);

        $page->search_title_ = $request->searchTitle;
        $page->search_description_ = $request->searchDescription;
        $page->xuat_ban_ = $request->xuatBan;
        $page->noi_dung_ = $request->noiDung;
        $page->thumbnail_  = $request->thumbnail;
        $page->id_tai_khoan_ = getIDTK();
        $page->id_hook_ = $request->id_hook;

        if($page->capNhat()){
            return status("Cập nhật page thành công", 200);
        }
        return status("Cập nhật page thất bại", 500);
    }

    public function deletePage(Request $request){
        $page = new PageModel();
        $page->id_pages_ = $request->id_pages;

        if($page->xoa()){
            return status('Xóa page thành công', 200);
        }
        return status('Xóa page thất bại', 500);
    }
}
