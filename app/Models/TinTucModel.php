<?php

namespace App\Models;

use App\Traits\TinTuc;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TinTucModel extends Model
{
    use HasFactory, TinTuc;
    protected $table = 'tin_tuc';

    public function them(){
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
            'id_hook' =>$this->id_hook_,
        ];
        return DB::table('tin_tuc')->insertGetId($par);
    }

    public function chiTiet(){
        $id_tin_tuc = $this->id_tin_tuc_;
        $sql = "SELECT * FROM tin_tuc WHERE id_tin_tuc=:id_tin_tuc";
        $par = [
            'id_tin_tuc' => $id_tin_tuc,
        ];
        return DB::selectOne($sql, $par);
    }

    public function capNhat(){
        $sql = "UPDATE tin_tuc SET
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
                                WHERE id_tin_tuc = :id_tin_tuc";
        $par = [
            'tieu_de' => $this->tieu_de_,
            'noi_dung' => $this->noi_dung_,
            'search_title' => $this->search_title_,
            'search_description' => $this->search_description_,
            'thumbnail' => $this->thumbnail_,
            'xuat_ban' => $this->xuat_ban_,
            'nhap' => $this->nhap_,
            'url' => $this->url_,
            'id_hook' =>$this->id_hook_,
            'id_tin_tuc' => $this->id_tin_tuc_,
        ];

        return DB::update($sql, $par);
    }

    public function xoa(){
        $sql = "DELETE FROM tin_tuc WHERE id_tin_tuc = :id_tin_tuc";
        $par = [
            'id_tin_tuc' => $this->id_tin_tuc_
        ];
        return DB::delete($sql, $par);
    }

    public function kiemTraURLThem(){
        $sql = "SELECT url FROM tin_tuc WHERE url = :url";
        $par = [
            'url'=>$this->url_,
        ];
        return DB::selectOne($sql, $par);
    }

    public function kiemTraURLCapNhat(){
        $sql = "SELECT url as sl FROM tin_tuc WHERE url = :url and id_tin_tuc != :id_tin_tuc";
        $par = [
            'url'=>$this->url_,
            'id_tin_tuc'=> $this->id_tin_tuc_
        ];
        return DB::selectOne($sql, $par);
    }

    public function thongKeTinTuc(){
        $sql = "SELECT xuat_ban, count(*) FROM tin_tuc GROUP BY xuat_ban";
        return DB::select($sql);
    }
}
