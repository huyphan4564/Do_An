<?php

namespace App\Models;

use App\Traits\TaiKhoan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TaiKhoanModel extends Model
{
    use TaiKhoan;

    public function dangNhap(){
        $sql = "SELECT * FROM tai_khoan WHERE email=:email;";
        return DB::selectOne($sql, [
            'email' => $this->email
        ]);
    }

    public function dsTaiKhoan(){
        $sql = "SELECT * FROM tai_khoan";
        return DB::select($sql);
    }

    public function them(){
        $sql = "INSERT INTO tai_khoan(ho_ten, email, quyen, trang_thai) VALUE (:ho_ten, :email, :quyen, :trang_thai);";
        $par = [
            'ho_ten' => $this->ho_ten,
            'email' => $this->email,
            'quyen' => $this->quyen,
            'trang_thai' => $this->trang_thai,
        ];
        return DB::insert($sql, $par);
    }

    public function xoa(){
        $sql =  "DELETE FROM tai_khoan WHERE id_tai_khoan = :id_tai_khoan";
        $par = [
            'id_tai_khoan' => $this->id_tai_khoan
        ];
        return DB::delete($sql,$par);
    }

    public function capNhat(){
        $sql = "UPDATE tai_khoan
                SET ho_ten = :ho_ten,
                    email = :email,
                    quyen = :quyen,
                    trang_thai = :trang_thai
                WHERE id_tai_khoan = :id_tai_khoan;";
        $par = [
            'ho_ten' => $this->ho_ten,
            'email' => $this->email,
            'quyen' => $this->quyen,
            'trang_thai' => $this->trang_thai,
            'id_tai_khoan' => $this->id_tai_khoan,
        ];
        return DB::update($sql, $par);
    }

    public function chiTietTaiKhoan()
    {
        $sql = "SELECT ho_ten FROM tai_khoan WHERE id_tai_khoan = :id_tai_khoan";
        $par = [
            'id_tai_khoan' => $this->id_tai_khoan,
        ];
        return DB::selectOne($sql, $par);
    }
}
