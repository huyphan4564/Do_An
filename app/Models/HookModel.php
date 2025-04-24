<?php

namespace App\Models;

use App\Traits\Hooks;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class HookModel extends Model
{
    use HasFactory, Hooks;
    protected $table = "hooks";

    public function danhSach(){
        $sql = "SELECT * FROM hooks";
        return DB::select($sql);
    }

    public function them(){
        $sql = "INSERT INTO hooks(vi_tri, mo_ta, id_tai_khoan)
            VALUE (:vi_tri, :mo_ta, :id_tai_khoan)";
        $par = [
            'vi_tri' => $this->vi_tri_,
            'mo_ta' => $this->mo_ta_,
            'id_tai_khoan' => $this->id_tai_khoan_,
        ];
        return DB::insert($sql, $par);
    }

    public function capNhat(){
        $sql = "UPDATE hooks SET
                                vi_tri = :vi_tri,
                                mo_ta = :mo_ta
                                WHERE id_hook = :id_hook";
        $par = [
            'vi_tri' => $this->vi_tri_,
            'mo_ta' => $this->mo_ta_,
            'id_hook' => $this->id_hook_,
        ];
        return DB::update($sql, $par);
    }

    public function chiTietHook()
    {
        $sql = "SELECT * FROM hooks WHERE id_hook = :id_hook";
        $par = [
            'id_hook' => $this->id_hook_,
        ];
        return DB::selectOne($sql, $par);
    }

    public function  xoa(){
        $sql = "DELETE FROM hooks WHERE id_hook=:id_hook";
        $par = [
            'id_hook' => $this->id_hook_,
        ];
        return DB::delete($sql, $par);
    }

    public function kiemTraViTri(){
        $sql = "SELECT vi_tri FROM hooks WHERE vi_tri = :vi_tri and id_hook != :id_hook";
        $par = [
            'vi_tri'=>$this->vi_tri_,
            'id_hook'=> $this->id_hook_
        ];
        return DB::selectOne($sql, $par);
    }
}
