<?php

namespace App\Http\Controllers;

use App\Models\DanhMucModel;
use App\Models\HookModel;
use App\Models\TagsModel;
use App\Models\TinTucModel;
use App\Models\TTucDMucModel;
use App\Models\TTucTagsModel;
use Illuminate\Http\Request;

class TinTucController extends Controller
{
    public function getViewDanhSach()
    {
        $perPage = intval(env('ITEM_PER_PAGE'));
        $data = TinTucModel::orderBy('ngay_tao', 'desc')->paginate($perPage);
        return view('auth.bai-viet.danh-sach', ['tt' => $data]);
    }

    public function getViewThem()
    {
        $dm = new DanhMucModel();
        $tags = new TagsModel();
        $hooks = new HookModel();
        return view('auth.bai-viet.them', ['dm' => $dm->danhSach(), 'tags' => $tags->danhSach(), 'hooks' => $hooks->danhSach()]);
    }

    public function putTinTuc(Request $request)
    {
        $tt = new TinTucModel();

        $tt->tieu_de_ = $request->tieuDe;
        if (strlen($tt->tieu_de_) == 0)
            return status("Tiêu đề không được bỏ trống", 400);

        $tt->url_ = $request->URL;
        if ($tt->kiemTraURLThem())
            return status("URL đã tồn tại", 400);

        $tt->search_title_ = $request->searchTitle;
        $tt->search_description_ = $request->searchDescription;
        $tt->noi_dung_ = $request->noiDung;
        $tt->thumbnail_ = $request->thumbnail;
        $tt->xuat_ban_ = $request->xuatBan;
        $tt->id_tai_khoan_ = getIDTK();
        $tt->id_hook_ = $request->id_hook;


        if ($tt->id_tin_tuc_ = $tt->them()) {
            $ttucdmuc = new TTucDMucModel();
            $ttucdmuc->id_tin_tuc_ = $tt->id_tin_tuc_;
            if ($request->id_danh_muc_arr) {
                foreach ($request->id_danh_muc_arr as $id_danh_muc) {
                    $ttucdmuc->id_danh_muc_ = $id_danh_muc;
                    $ttucdmuc->them();
                }
            }
            $ttuctags = new TTucTagsModel();
            $ttuctags->id_tin_tuc_ = $tt->id_tin_tuc_;
            if ($request->id_tag_arr) {
                foreach ($request->id_tag_arr as $id_tag) {
                    $ttuctags->id_tag_ = $id_tag;
                    $ttuctags->them();
                }
            }
            return status("Thêm thông tin thành công", 200);
        }
        return status("Thêm thông tin thất bại", 500);
    }

    public function getViewCapNhat($id_tin_tuc)
    {
        $tintucModel = new TinTucModel();
        $tintucModel->id_tin_tuc_ = $id_tin_tuc;
        $tt = $tintucModel->chiTiet();

        $dmModel = new DanhMucModel();
        $tagsModel = new TagsModel();

        $ttucdmucModel = new TTucDMucModel();
        $ttucdmucModel->id_tin_tuc_ = $id_tin_tuc;
        $dm = [];
        if ($ttucdmucModel->chiTietTTucDMuc()) {
            foreach ($ttucdmucModel->chiTietTTucDMuc() as $item_dm) {
                array_push($dm, $item_dm->id_danh_muc);
            }
        }
        $tt->dm = $dm;

        $ttuctagsModel = new TTucTagsModel();
        $ttuctagsModel->id_tin_tuc_ = $id_tin_tuc;
        $tag = [];
        if ($ttuctagsModel->chiTietTTucTags()) {
            foreach ($ttuctagsModel->chiTietTTucTags() as $item_tag) {
                array_push($tag, $item_tag->id_tag);
            }
        }
        $tt->tag = $tag;

        $hookModel = new HookModel();
        return view('auth.bai-viet.cap-nhat', [
            'tt' => $tt,
            'danhMucs' => $dmModel->danhSach(),
            'tags' => $tagsModel->danhSach(),
            'hooks' => $hookModel->danhSach()
        ]);
    }

    public function postTinTuc(Request $request)
    {
        $tt = new TinTucModel();
        $tt->id_tin_tuc_ = $request->id_tin_tuc;

        $tt->tieu_de_ = $request->tieuDe;
        if (strlen($tt->tieu_de_) == 0)
            return status("Tiêu đề không được bỏ trống", 400);

        $tt->url_ = $request->URL;
        if ($tt->kiemTraURLCapNhat())
            return status("URL đã tồn tại", 400);

        $tt->search_title_ = $request->searchTitle;
        $tt->search_description_ = $request->searchDescription;
        $tt->xuat_ban_ = $request->xuatBan;
        $tt->noi_dung_ = $request->noiDung;
        $tt->thumbnail_ = $request->thumbnail;
        $tt->id_tai_khoan_ = getIDTK();
        $tt->id_hook_ = $request->id_hook;

        if ($tt->capNhat()) {
            if ($request->id_danh_muc_arr) {
                $ttucdmuc = new TTucDMucModel();
                $ttucdmuc->id_tin_tuc_ = $tt->id_tin_tuc_;
                $ttucdmuc->xoa();
                foreach ($request->id_danh_muc_arr as $id_danh_muc) {
                    $ttucdmuc->id_danh_muc_ = $id_danh_muc;
                    $ttucdmuc->them();
                }
            }
            if ($request->id_tag_arr) {
                $ttuctags = new TTucTagsModel();
                $ttuctags->id_tin_tuc_ = $tt->id_tin_tuc_;
                $ttuctags->xoa();
                foreach ($request->id_tag_arr as $id_tag) {
                    $ttuctags->id_tag_ = $id_tag;
                    $ttuctags->them();
                }
            }
            return status("Cập nhật tin tức thành công", 200);
        }
        return status("Cập nhật tin tức thất bại", 500);
    }

    public function deleteTinTuc(Request $request)
    {
        $tt = new TinTucModel();
        $tt->id_tin_tuc_ = $request->id_tin_tuc;

        $ttucdmuc = new TTucDMucModel();
        $ttucdmuc->id_tin_tuc_ = $request->id_tin_tuc;

        $ttuctag = new TTucTagsModel();
        $ttuctag->id_tin_tuc_ = $request->id_tin_tuc;

        if ($tt->xoa()) {
            $ttuctag->xoa();
            $ttucdmuc->xoa();
            return status('Xóa tin tức thành công', 200);
        }
        return status('Xóa tin tức thất bại', 500);
    }

    #
    # Thống kê
    #
    public function getViewThongKe()
    {
        return view('auth.bai-viet.thongke');
    }
}
