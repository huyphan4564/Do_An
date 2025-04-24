<?php

namespace App\Models;

use App\Traits\TTucDMuc;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TTucDMucModel extends Model
{
    use HasFactory, TTucDMuc;
    public function them(){
        $sql = "INSERT INTO ttuc_dmuc(id_tin_tuc, id_danh_muc) VALUE(:id_tin_tuc, :id_danh_muc)";
        $par = [
            'id_tin_tuc'=>$this->id_tin_tuc_,
            'id_danh_muc'=>$this->id_danh_muc_
        ];
        return DB::insert($sql, $par);
    }
    public function capNhat(){

    }

    public function  xoa(){
        $sql = "DELETE FROM ttuc_dmuc WHERE id_tin_tuc = :id_tin_tuc";
        $par = [
            'id_tin_tuc' => $this->id_tin_tuc_
        ];
        return DB::delete($sql, $par);
    }

    public function chiTietTTucDMuc(){
        $sql = "SELECT * FROM ttuc_dmuc a, tin_tuc b, danh_muc c WHERE a.id_tin_tuc = b.id_tin_tuc and a.id_danh_muc = c.id_danh_muc and a.id_tin_tuc = :id_tin_tuc";
        $par = [
            'id_tin_tuc' => $this->id_tin_tuc_
        ];
        return DB::select($sql, $par);
    }
}






























