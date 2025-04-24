<?php

namespace App\Http\Controllers;

use App\Models\SlidersModel;
use App\Models\SlidersCTModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SildersController extends Controller
{
    public function getViewSliders()
    {
        $sli = new SlidersModel();

        $data = $sli->danhSach();
        return view('auth.sliders.danh-sach',[
            'data' => $data,
        ]);
    }

    public function putSliders(Request $request)
    {
        $sli = new SlidersModel();
        $sli->tieu_de = $request->tieu_de;
        $sli->mo_ta = $request->mo_ta;
        if($sli->them())
            return status("Thêm thông tin thành công", 200);
        return status("Thêm thông tin thất bại", 500);
    }

    public function deleteSliders(Request $request)
    {
        $sli = new SlidersModel();
        $sli->id_slide = $request->id_slide;
        if($sli->xoa())
            return status('Xóa thông tin thành công', 200);
        return status('Xóa thông tin thất bại', 500);
    }

    public function postSliders(Request $request)
    {
        $sli = new SlidersModel();
        $sli->tieu_de = $request->tieu_de;
        $sli->mo_ta = $request->mo_ta;
        $sli->id_slide = $request->id_slide;
        if($sli->capNhat())
            return status('Cập nhật thông tin thành công', 200);
        return status('Cập nhật thông tin thất bại', 500);
    }

    public function getViewSlidersCT(Request $request)
    {
        $sli_ct = new SlidersCTModel();
        $sli_ct->id_slide = $request->id_slide;
        $id_slide = $request->id_slide;

        $sli = new SlidersModel();
        $sli->id_slide = $request->id_slide;
        $tieuDeSliders = $sli->getTieuDe();

        $data = $sli_ct->danhSach();
        if ($tieuDeSliders){
            return view('auth.sliders.danh-sach-ct',[
                'data' => $data,
                'id_slide' => $id_slide,
                'tieu_de_slide' => $tieuDeSliders[0]->tieu_de,
            ]);
        }
        else {
            abort(404, "Không tồn tại Sliders");
        }
    }

    public function putSlidersCT(Request $request)
    {
        $sli_ct = new SlidersCTModel();
        $sli_ct->tieu_de = $request->tieu_de;
        $sli_ct->noi_dung = $request->noi_dung;
        $sli_ct->thumbnail = $request->thumbnail;
        $sli_ct->thu_tu = $request->thu_tu;
        $sli_ct->id_slide = $request->id_slide;

        if ($sli_ct->them())
            return status("Thêm thông tin thành công", 200);
        return status("Thêm thông tin thất bại", 500);
    }

    public function deleteSlidersCT(Request $request)
    {
        $sli_ct = new SlidersCTModel();
        $sli_ct->id_slides_ct = $request->id_slides_ct;

        if ($sli_ct->xoa())
            return status('Xóa thông tin thành công', 200);
        return status('Xóa thông tin thất bại', 500);
    }

    public function postSlidersCT(Request $request)
    {
        $sli_ct = new SlidersCTModel();
        $sli_ct->id_slides_ct = $request->id_slides_ct;
        $sli_ct->tieu_de = $request->tieu_de;
        $sli_ct->noi_dung = $request->noi_dung;
        $sli_ct->thumbnail = $request->thumbnail;
        $sli_ct->thu_tu = $request->thu_tu;

        if ($sli_ct->capNhat())
            return status('Cập nhật thông tin thành công', 200);
        return status('Cập nhật thông tin thất bại', 500);


    }









}
