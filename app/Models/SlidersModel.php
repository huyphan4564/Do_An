<?php

namespace App\Models;

use http\Env\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Traits\Sliders;

class SlidersModel extends Model
{
    use HasFactory;

    public function danhSach()
    {
        $sql = "SELECT *, (SELECT COUNT(*) FROM slides_ct WHERE slides_ct.id_slide = slides.id_slide) AS so_luong FROM slides;";
        return DB::select($sql);
    }

    public function them()
    {
        $sql = "INSERT INTO slides(tieu_de, mo_ta) VALUE (:tieu_de, :mo_ta);";
        $par = [
            'tieu_de' => $this->tieu_de,
            'mo_ta' => $this->mo_ta,
        ];
        return DB::insert($sql, $par);
    }

    public function xoa()
    {
        $sql = "DELETE FROM slides WHERE id_slide = :id_slide";
        $par = [
            'id_slide' => $this->id_slide,
        ];
        return DB::delete($sql, $par);
    }

    public function capNhat()
    {
        $sql = "UPDATE slides SET
                  tieu_de = :tieu_de,
                  mo_ta = :mo_ta
              WHERE id_slide = :id_slide";
        $par = [
            'id_slide' => $this->id_slide,
            'tieu_de' => $this->tieu_de,
            'mo_ta' => $this->mo_ta,
        ];
        return DB::update($sql,$par);
    }

    public function getTieuDe()
    {
        $sql = "SELECT tieu_de FROM slides WHERE id_slide = :id_slide";
        $par = [
            'id_slide' => $this->id_slide,
        ];
        return DB::select($sql,$par);
    }

}
