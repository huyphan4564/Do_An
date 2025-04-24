<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Redirect;
use Illuminate\Support\Facades\DB;

class RedirectModel extends Model
{
    use HasFactory, Redirect;

    public function danhSach()
    {
        $sql = "SELECT * FROM redirects ORDER BY ngay_tao DESC";
        return DB::select($sql);

    }

    public function them()
    {
        $sql = "INSERT INTO redirects(source, target, id_tai_khoan) VALUES (:source, :target, :id_tai_khoan)";
        $par = [
            'source' => $this->source,
            'target' => $this->target,
            'id_tai_khoan' => $this->id_tai_khoan,
        ];
        return DB::insert($sql, $par);
    }

    public function capNhat()
    {
        $sql = "UPDATE redirects SET source = :source, target = :target, ngay_tao=NOW() WHERE id_redirect = :id_redirect";
        $par = [
            'source' => $this->source,
            'target' => $this->target,
            'id_redirect' => $this->id_redirect,
        ];
        return DB::update($sql,$par);

    }

    public function xoa()
    {
        $sql = "DELETE FROM redirects WHERE id_redirect=:id_redirect";
        $par = [
            'id_redirect' => $this->id_redirect,
        ];
        return DB::delete($sql,$par);

    }

}
