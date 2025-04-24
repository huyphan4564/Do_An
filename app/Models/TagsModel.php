<?php

namespace App\Models;

use App\Traits\Tags;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TagsModel extends Model
{
    use HasFactory, Tags;
    protected $table = "tags";
    public function kiemTraTieuDe(){
        $sql = "SELECT tieu_de FROM tags WHERE tieu_de = :tieu_de and id_tag != :id_tag";
        $par = [
            'tieu_de'=>$this->tieu_de_,
            'id_tag'=> $this->id_tag_
        ];
        return DB::selectOne($sql, $par);
    }

    public function kiemTraURL(){
        $sql = "SELECT url FROM tags WHERE url = :url and id_tag != :id_tag";
        $par = [
            'url'=>$this->url_,
            'id_tag'=> $this->id_tag_
        ];
        return DB::selectOne($sql, $par);
    }

    public function them(){
        $sql = "INSERT INTO tags(tieu_de, noi_dung, search_title, search_description, thumbnail, url, id_tai_khoan)
    VALUE (:tieu_de, :noi_dung, :search_title, :search_description, :thumbnail, :url, :id_tai_khoan);";
        $par = [
            'tieu_de' =>$this->tieu_de_,
            'noi_dung' =>$this->noi_dung_,
            'search_title' =>$this->search_title_,
            'search_description' =>$this->search_description_,
            'thumbnail' =>$this->thumbnail_,
            'url' =>$this->url_,
            'id_tai_khoan' =>getIDTK()
        ];
        return DB::insert($sql, $par);
    }

    public function danhSach(){
        $sql = "SELECT * FROM tags";
        return DB::select($sql);
    }

    public function chiTiet(){
        $sql = "SELECT * FROM tags WHERE id_tag=:id_tag";
        $par = [
            'id_tag' => $this->id_tag_,
        ];
        return DB::selectOne($sql, $par);
    }

    public function capNhat(){
        $sql = "UPDATE tags SET
                                tieu_de = :tieu_de,
                                noi_dung = :noi_dung,
                                search_title = :search_title,
                                search_description = :search_description,
                                thumbnail = :thumbnail,
                                ngay_cap_nhat = now(),
                                url = :url
                                WHERE id_tag = :id_tag";
        $par = [
            'tieu_de' => $this->tieu_de_,
            'noi_dung' => $this->noi_dung_,
            'search_title' => $this->search_title_,
            'search_description' => $this->search_description_,
            'thumbnail' => $this->thumbnail_,
            'url' => $this->url_,
            'id_tag' => $this->id_tag_,
        ];

        return DB::update($sql, $par);
    }

    public function  xoa(){
        $sql = "DELETE FROM tags WHERE id_tag=:id_tag";
        $par = [
            'id_tag' => $this->id_tag_,
        ];
        return DB::delete($sql, $par);
    }
}
