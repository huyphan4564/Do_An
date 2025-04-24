<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Traits\SlidersCT;

class SlidersCTModel extends Model
{
    use HasFactory;
    use SlidersCT;

    public function danhSach()
    {
//        $sql = "SELECT * FROM cai_dat ORDER BY CAST(thu_tu AS SIGNED);";
        // lỗi quyền sql
        $sql = "SELECT * FROM slides_ct WHERE id_slide = :id_slide ORDER BY thu_tu ASC;";
        $par = [
            'id_slide' => $this->id_slide,
        ];
        return DB::select($sql, $par);
    }

    public function them()
    {
        $sql = "INSERT INTO slides_ct(tieu_de, noi_dung, thumbnail, thu_tu, id_slide) VALUES (:tieu_de, :noi_dung, :thumbnail, :thu_tu, :id_slide)";
        $par = [
            'tieu_de' => $this->tieu_de,
            'noi_dung' => $this->noi_dung,
            'thumbnail' => $this->thumbnail,
            'thu_tu' => $this->thu_tu,
            'id_slide' => $this->id_slide,
        ];
        return DB::insert($sql, $par);
    }

    public function xoa()
    {
        $sql = "DELETE FROM slides_ct WHERE id_slides_ct = :id_slides_ct";
        $par = [
            'id_slides_ct' => $this->id_slides_ct,
        ];
        return DB::delete($sql, $par);
    }

    public function capNhat()
    {
        $sql = "
                UPDATE slides_ct SET
                      tieu_de = :tieu_de,
                      noi_dung = :noi_dung,
                      thumbnail = :thumbnail,
                      thu_tu = :thu_tu
                WHERE id_slides_ct = :id_slides_ct;";
        $par = [
            'tieu_de' => $this->tieu_de,
            'noi_dung' => $this->noi_dung,
            'thumbnail' => $this->thumbnail,
            'thu_tu' => $this->thu_tu,
            'id_slides_ct' => $this->id_slides_ct,
        ];
        return DB::update($sql, $par);
    }

}
