<?php

namespace App\Models;

use App\Traits\Page;
use App\Traits\TinTuc;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PageModel extends Model
{
    use HasFactory, Page;
    protected $table = 'pages';

    public function kiemTraURL(){
        $sql = "SELECT url FROM pages WHERE url = :url and id_pages != :id_pages";
        $par = [
            'url'=>$this->url_,
            'id_pages'=> $this->id_pages_
        ];
        return DB::selectOne($sql, $par);
    }

    public function kiemTraTieuDe(){
        $sql = "SELECT tieu_de FROM pages WHERE tieu_de = :tieu_de and id_pages != :id_pages";
        $par = [
            'tieu_de'=>$this->tieu_de_,
            'id_pages'=> $this->id_pages_
        ];
        return DB::selectOne($sql, $par);
    }

    public function them(){
        $sql = "INSERT INTO pages(tieu_de, noi_dung, search_title, search_description, thumbnail, xuat_ban, nhap, url, id_tai_khoan, id_hook)
            VALUE (:tieu_de, :noi_dung, :search_title, :search_description, :thumbnail, :xuat_ban, :nhap, :url, :id_tai_khoan, :id_hook)";
        $par = [
            'tieu_de' => $this->tieu_de_,
            'noi_dung' => $this->noi_dung_,
            'search_title' => $this->search_title_,
            'search_description' => $this->search_description_,
            'thumbnail' => $this->thumbnail_,
            'xuat_ban' => $this->xuat_ban_,
            'nhap' => $this->nhap_,
            'url' => $this->url_,
            'id_tai_khoan' => $this->id_tai_khoan_,
            'id_hook'=> $this->id_hook_,
        ];
        return DB::insert($sql, $par);
    }

    public function chiTiet(){
        $id_pages = $this->id_pages_;
        $sql = "SELECT * FROM pages WHERE id_pages=:id_pages";
        $par = [
            'id_pages' => $id_pages,
        ];
        return DB::selectOne($sql, $par);
    }

    public function capNhat(){
        $sql = "UPDATE pages SET
                                tieu_de = :tieu_de,
                                noi_dung = :noi_dung,
                                search_title = :search_title,
                                search_description = :search_description,
                                thumbnail = :thumbnail,
                                xuat_ban = :xuat_ban,
                                nhap = :nhap,
                                ngay_cap_nhat = now(),
                                url = :url,
                                id_hook = :id_hook
                                WHERE id_pages = :id_pages";
        $par = [
            'tieu_de' => $this->tieu_de_,
            'noi_dung' => $this->noi_dung_,
            'search_title' => $this->search_title_,
            'search_description' => $this->search_description_,
            'thumbnail' => $this->thumbnail_,
            'xuat_ban' => $this->xuat_ban_,
            'nhap' => $this->nhap_,
            'url' => $this->url_,
            'id_hook' => $this->id_hook_,
            'id_pages' => $this->id_pages_,
        ];

        return DB::update($sql, $par);
    }

    public function xoa(){
        $sql = "DELETE FROM pages WHERE id_pages = :id_pages";
        $par = [
            'id_pages' => $this->id_pages_
        ];
        return DB::delete($sql, $par);
    }
}
