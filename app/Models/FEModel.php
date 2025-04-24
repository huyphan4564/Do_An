<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class FEModel extends Model
{
    use HasFactory;

    # Lấy giá trị theo hook
    public function getHook($vi_tri){
        $sql = "SELECT * FROM hooks WHERE vi_tri = :vi_tri;";
        $data = DB::selectOne($sql, ['vi_tri' => $vi_tri]);
        if($data)
            return $data->id_hook;
        return 0;
    }

    # Tin mới nhất
    public function tinMoi($limit=6)
    {
        $query = "SELECT * FROM tin_tuc ORDER BY ngay_tao LIMIT $limit";
        return DB::select($query);
    }

    # Trang chủ tin mới nhất
    public function tinTheoTenDM($id_danh_muc=1, $limit=6)
    {
        $query = "SELECT * FROM tin_tuc, ttuc_dmuc
         WHERE tin_tuc.id_tin_tuc = ttuc_dmuc.id_tin_tuc AND ttuc_dmuc.id_danh_muc=:id_danh_muc
         ORDER BY tin_tuc.ngay_tao LIMIT $limit";
        $par = [
            'id_danh_muc' => $id_danh_muc,
        ];
        return DB::select($query, $par);
    }

    # Page theo Hook
    public function pageTheoHook($id_hook="", $limit=6)
    {
        $query = "SELECT * FROM pages, hooks WHERE pages.id_hook = hooks.id_hook AND hooks.id_hook = :id_hook LIMIT $limit";
        $par = [
            'id_hook' => $id_hook,
        ];
        return DB::select($query, $par);
    }
    #
    # Kết thúc Trang chủ
    #


    #
    # Bài viết chi tiết
    #
    public function tinTucCT($url)
    {
        $query = 'SELECT * FROM tin_tuc WHERE url=:url';
        return DB::selectOne($query, [
            'url' => $url
        ]);
    }

    public function danhMucCuaTinTuc($id_tin_tuc)
    {
        $query = 'SELECT tieu_de, url FROM ttuc_dmuc, danh_muc WHERE ttuc_dmuc.id_danh_muc = danh_muc.id_danh_muc AND id_tin_tuc=:id_tin_tuc';
        return DB::selectOne($query, [
            'id_tin_tuc' => $id_tin_tuc
        ]);
    }

    public function tinLienQuan($title)
    {
        $query = 'SELECT * FROM tin_tuc ORDER BY RAND() LIMIT 5';
        return DB::select($query);
    }
    #
    # Kết thúc bài viết chi tiết
    #


    #
    # Danh mục chi tiết
    #
    public function dmChiTiet($url)
    {
        $query = "SELECT * FROM danh_muc WHERE url=:url";
        return DB::selectOne($query, [
            'url' => $url
        ]);
    }

    public function tinTucTheoDM($id_danh_muc)
    {
        $query = "SELECT * FROM tin_tuc, ttuc_dmuc WHERE tin_tuc.id_tin_tuc = ttuc_dmuc.id_tin_tuc AND id_danh_muc=:id_danh_muc;";
        return DB::select($query, [
            'id_danh_muc' => $id_danh_muc
        ]);
    }


    # Page liên quan
    public function page($url)
    {
        $query = "SELECT * FROM pages WHERE url = :url";
        return DB::selectOne($query, [
            'url' => $url
        ]);
    }

    public function pageLienQuan($tk)
    {
        $query = 'SELECT * FROM pages ORDER BY RAND() LIMIT 5';
        return DB::select($query);
    }

    public function getSlider($tieude)
    {
        $query = "SELECT * FROM slides_ct, slides WHERE slides.id_slide = slides_ct.id_slide AND slides.tieu_de = :tieu_de";
        return DB::select($query, [
            'tieu_de' => $tieude
        ]);
    }

    public function getMenu(){
        $sql = "SELECT * FROM cai_dat WHERE cau_hinh=:cau_hinh";
        return DB::selectOne($sql, [
            'cau_hinh' => "MENU"
        ]);
    }

    public function getCustomJS(){
        $sql = "SELECT * FROM cai_dat WHERE cau_hinh=:cau_hinh";
        return DB::selectOne($sql, [
            'cau_hinh' => "CUSTOM_JS"
        ]);
    }

    public function getCustomCSS(){
        $sql = "SELECT * FROM cai_dat WHERE cau_hinh=:cau_hinh";
        return DB::selectOne($sql, [
            'cau_hinh' => "CUSTOM_CSS"
        ]);
    }

    public function getCaiDat($cauHinh){
        $sql = "SELECT * FROM cai_dat WHERE cau_hinh=:cau_hinh";
        return DB::selectOne($sql, [
            'cau_hinh' => $cauHinh
        ]);
    }
}
