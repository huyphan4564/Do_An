<?php

namespace App\Models;

use App\Traits\DanhMuc;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DanhMucModel extends Model
{
    use HasFactory, DanhMuc;
    protected $table = 'danh_muc';
    public function kiemTraTieuDe(){
        $sql = "SELECT tieu_de FROM danh_muc WHERE tieu_de = :tieu_de and id_danh_muc != :id_danh_muc";
        $par = [
            'tieu_de'=>$this->tieu_de_,
            'id_danh_muc'=> $this->id_danh_muc_
        ];
        return DB::selectOne($sql, $par);
    }

    public function kiemTraURL(){
        $sql = "SELECT url FROM danh_muc WHERE url = :url and id_danh_muc != :id_danh_muc";
        $par = [
            'url'=>$this->url_,
            'id_danh_muc'=> $this->id_danh_muc_
        ];
        return DB::selectOne($sql, $par);
    }
    public function them(){
        $sql = "INSERT INTO danh_muc(tieu_de, noi_dung, search_title, search_description, thumbnail, url, id_tai_khoan)
                VALUE (:tieu_de, :noi_dung, :search_title, :search_description, :thumbnail, :url, :id_tai_khoan);";
        $par = [
            'tieu_de' => $this->tieu_de_,
            'noi_dung' => $this->noi_dung_,
            'search_title' => $this->search_title_,
            'search_description' => $this->search_description_,
            'thumbnail' => $this->thumbnail_,
            'url' => $this->url_,
            'id_tai_khoan' => $this->id_tai_khoan_,
        ];
        return DB::insert($sql, $par);
    }

    public function danhSach(){
        $sql = "SELECT * FROM danh_muc";
        return DB::select($sql);
    }

    public function chiTiet(){
        $sql = "SELECT * FROM danh_muc WHERE id_danh_muc=:id_danh_muc";
        $par = [
            'id_danh_muc' => $this->id_danh_muc_,
        ];
        return DB::selectOne($sql, $par);
    }

    public function capNhat(){
        $sql = "UPDATE danh_muc SET
                                tieu_de = :tieu_de,
                                noi_dung = :noi_dung,
                                search_title = :search_title,
                                search_description = :search_description,
                                thumbnail = :thumbnail,
                                ngay_cap_nhat = now(),
                                url = :url
                                WHERE id_danh_muc = :id_danh_muc";
        $par = [
            'tieu_de' => $this->tieu_de_,
            'noi_dung' => $this->noi_dung_,
            'search_title' => $this->search_title_,
            'search_description' => $this->search_description_,
            'thumbnail' => $this->thumbnail_,
            'url' => $this->url_,
            'id_danh_muc' => $this->id_danh_muc_,
        ];

        return DB::update($sql, $par);
    }

    public function  xoa(){
        $sql = "DELETE FROM danh_muc WHERE id_danh_muc=:id_danh_muc";
        $par = [
            'id_danh_muc' => $this->id_danh_muc_,
        ];
        return DB::delete($sql, $par);
    }
}
