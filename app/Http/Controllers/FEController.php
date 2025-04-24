<?php

namespace App\Http\Controllers;

use App\Models\FEModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class FEController extends Controller
{
    public function changeLocation(Request $request)
    {
        if($request->exists('lang')){
            App::setLocale($request->lang);
            Session::put('locale', $request->lang);
        }
        return redirect('/');
    }


    // Trang chủ
    public function getViewHome(Request $request)
    {
        return view('themes.trang-chu');
    }

    # Bài viết chi tiết
    public function getViewBaiViet($slug)
    {
        $fe = new FEModel();

        # Bài viết chi tiết
        $ct = $fe->tinTucCT($slug);
        if($ct){
            $topNews = $fe->tinLienQuan($ct->tieu_de);
            $dm = $fe->danhMucCuaTinTuc($ct->id_tin_tuc);
            return view('themes.bai-viet-ct', [
                'data' => $ct,
                'topNews' => $topNews,
                'dm' => $dm
            ]);
        }

        $dmct  = $fe->page($slug);
        if($dmct){
            $dm = $fe->pageLienQuan($dmct->tieu_de);
            return view('themes.page', [
                'page' => $dmct,
                'page_lq' => $dm
            ]);
        }

        return redirect()->to('/');
    }

    # Danh mục chi tiết
    public function danhMucCT($url)
    {
        $fe = new FEModel();
        $dmct  = $fe->dmChiTiet($url);
        $ds = $fe->tinTucTheoDM($dmct->id_danh_muc);

        return view('themes.danh-muc', [
            'dm' => $dmct,
            'tintuc' => $ds,
        ]);
    }
}
