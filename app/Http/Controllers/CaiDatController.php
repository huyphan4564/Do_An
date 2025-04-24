<?php

namespace App\Http\Controllers;

use App\Models\CaiDatModel;
use App\Models\RedirectModel;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use function Symfony\Component\Translation\t;

class CaiDatController extends Controller
{

    public function getViewCaiDat()
    {
        $cd = new CaiDatModel();
        return view('auth.cai-dat.cai-dat', [
            'data' => $cd->danhSach(),
        ]);
    }

    public function putCaiDat(Request $request)
    {
        $cd = new CaiDatModel();
        $cd->cau_hinh = $request->cau_hinh;
        $cd->gia_tri = $request->gia_tri;
        if ($cd->themCaiDat())
            return status('Thêm thông tin thành công', 200);
        return status('Thêm thông tin thất bại', 500);
    }
    public function postCaiDat(Request $request)
    {
        $cd = new CaiDatModel();
        $cd->cau_hinh = $request->cau_hinh;
        $cd->gia_tri = $request->gia_tri;
        $cd->id_cai_dat = $request->id_cai_dat;
        if ($cd->capNhatCaiDat())
            return status('Cập nhật thông tin thành công', 200);
        return status('Cập nhật thông tin thất bại', 500);
    }

    public function deleteCaiDat(Request $request)
    {
        $cd = new CaiDatModel();
        $cd->id_cai_dat = $request->id_cai_dat;
        if ($cd->xoaCaiDat())
            return status('Xóa thông tin thành công', 200);
        return status('Xóa thông tin thất bại', 500);
    }

    public function getViewCaiDatWebsite()
    {
        return view('auth.cai-dat.website');
    }

    public function postCaiDatWebsite(Request $request)
    {
        $cd = new CaiDatModel();
        $cd->cau_hinh = CaiDatModel::HOMEPAGE_TITLE;
        $cd->gia_tri = $request->title;
        $cd->luuCaiDat();

        $cd->cau_hinh = CaiDatModel::HOMEPAGE_SEARCH_TITLE;
        $cd->gia_tri = $request->search_title;
        $cd->luuCaiDat();

        $cd->cau_hinh = CaiDatModel::HOMEPAGE_SEARCH_DESCRIPTION;
        $cd->gia_tri = $request->search_description;
        $cd->luuCaiDat();

        $cd->cau_hinh = CaiDatModel::HOMEPAGE_ICON;
        $cd->gia_tri = $request->icon_td;
        $cd->luuCaiDat();

        $cd->cau_hinh = CaiDatModel::HOMEPAGE_THUMBNAIL;
        $cd->gia_tri = $request->thumbnail;

        if( $cd->luuCaiDat()){
            return status('Cập nhật thông tin thành công', 200);
        }
        return status('Cập nhật thông tin thất bại', 500);
    }

    public function getViewCaiDatGiaoDien()
    {
        return view('auth.cai-dat.giao-dien');
    }

    public function postCaiDatGiaoDien(Request $request)
    {
        $cd = new CaiDatModel();
        $cd->cau_hinh = CaiDatModel::CUSTOM_JS;
        $cd->gia_tri = $request->js;
        $cd->luuCaiDat();

        $cd->cau_hinh = CaiDatModel::CUSTOM_CSS;
        $cd->gia_tri = $request->css;

        if( $cd->luuCaiDat()){
            return status('Cập nhật thông tin thành công', 200);
        }
        return status('Cập nhật thông tin thất bại', 500);
    }

    public function getViewCaiDatMenu()
    {
        $cd = new CaiDatModel();
        $cd->cau_hinh = CaiDatModel::MENU;
        return view('auth.cai-dat.menu',[
            'menus' => $cd->chiTiet(),
        ]);
    }

    public function postCaiDatMenu(Request $request)
    {
        $cd = new CaiDatModel();
        $cd->cau_hinh = CaiDatModel::MENU;
        $cd->gia_tri = $request->menu;
        if( $cd->luuCaiDat()){
            return status('Cập nhật thông tin thành công', 200);
        }
        return status('Cập nhật thông tin thất bại', 500);
    }

    public function getViewBackup()
    {
        $cd = new CaiDatModel();
        $cd->cau_hinh = CaiDatModel::TIME_BACKUP_DB;
        $cd = $cd->chiTiet();
        $timeBackup = $cd->gia_tri;
        $timeBackup = explode(' ', $timeBackup);

        return view('auth.cai-dat.backup',[
            'timeBackup' => $timeBackup,
        ]);
    }

    public function postBackup(Request $request)
    {
        $cd = new CaiDatModel();
        $cd->cau_hinh = CaiDatModel::FILE_NAME_DB;
        $cd->gia_tri = $request->FILE_NAME_DB;
        $cd->luuCaiDat();

        $cd->cau_hinh = CaiDatModel::FILE_PASS_DB;
        $cd->gia_tri = $request->FILE_PASS_DB;
        $cd->luuCaiDat();
        
        $cd->cau_hinh = CaiDatModel::TIME_BACKUP_DB;
        $cd->gia_tri = $request->TIME_BACKUP_DB;
        $cd->luuCaiDat();

        $cd->cau_hinh = CaiDatModel::FILE_TIMESTORAGE_DB;
        $cd->gia_tri = $request->FILE_TIMESTORAGE_DB;
        $cd->luuCaiDat();

        $cd->cau_hinh = CaiDatModel::STORAGE_CAPACITY;
        $cd->gia_tri = $request->STORAGE_CAPACITY;
        if($cd->luuCaiDat()){
            return status('Cập nhật thông tin thành công', 200);
        }
        return status('Cập nhật thông tin thất bại', 500);
    }

    public function runBackup(Request $request){

        if (Artisan::call('backup:run --only-db') === 0){
            return status('Backup đã được thực hiện thành công!', 200);
        }
        return status('Đã xảy ra lỗi khi thực hiện backup!', 500);

    }

}
