<?php

namespace App\Models;

use App\Traits\TTucTags;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TTucTagsModel extends Model
{
    use HasFactory, TTucTags;
    public function them(){
        $sql = "INSERT INTO ttuc_tags(id_tin_tuc, id_tag) VALUE(:id_tin_tuc, :id_tag)";
        $par = [
            'id_tin_tuc'=>$this->id_tin_tuc_,
            'id_tag'=>$this->id_tag_
        ];
        return DB::insert($sql, $par);
    }

    public function  xoa(){
        $sql = "DELETE FROM ttuc_tags WHERE id_tin_tuc = :id_tin_tuc";
        $par = [
            'id_tin_tuc' => $this->id_tin_tuc_
        ];
        return DB::delete($sql, $par);
    }
    public function chiTietTTucTags(){
        $sql = "SELECT * FROM ttuc_tags a, tin_tuc b, tags c WHERE a.id_tin_tuc = b.id_tin_tuc and a.id_tag = c.id_tag and a.id_tin_tuc = :id_tin_tuc";
        $par = [
            'id_tin_tuc' => $this->id_tin_tuc_
        ];
        return DB::select($sql, $par);
    }

}
