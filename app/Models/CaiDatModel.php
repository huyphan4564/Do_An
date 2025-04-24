<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\CaiDat;
use Illuminate\Support\Facades\DB;

class CaiDatModel extends Model
{
    use HasFactory;
    use CaiDat;

    const MENU = 'MENU';
    const HOMEPAGE_TITLE = 'HOMEPAGE_TITLE';
    const HOMEPAGE_SEARCH_TITLE = 'HOMEPAGE_SEARCH_TITLE';
    const HOMEPAGE_SEARCH_DESCRIPTION = 'HOMEPAGE_SEARCH_DESCRIPTION';
    const HOMEPAGE_ICON = 'HOMEPAGE_ICON';
    const HOMEPAGE_THUMBNAIL = 'HOMEPAGE_THUMBNAIL';

    const CUSTOM_CSS = 'CUSTOM_CSS';
    const CUSTOM_JS = 'CUSTOM_JS';

    const FILE_NAME_DB = 'FILE_NAME_DB';
    const FILE_PASS_DB = 'FILE_PASS_DB';
    const TIME_BACKUP_DB = 'TIME_BACKUP_DB';
    const FILE_TIMESTORAGE_DB = 'FILE_TIMESTORAGE_DB';
    const STORAGE_CAPACITY = 'STORAGE_CAPACITY';

    public function danhSach()
    {
        $sql = "SELECT * FROM cai_dat WHERE co_dinh=0";
        return DB::select($sql);
    }

    public function chiTiet()
    {
        $sql = "SELECT * FROM cai_dat WHERE cau_hinh=:cau_hinh";
        $par = [
            'cau_hinh' => $this->cau_hinh,
        ];
        $data = DB::selectOne($sql, $par);
        if($data)
            return $data;

        $this->them();
        return $this->chiTiet();
    }

    private function them()
    {

        $sql = "INSERT INTO cai_dat(cau_hinh, gia_tri, co_dinh) VALUES (:cau_hinh, :gia_tri, 0)";
        $par = [
            'cau_hinh' => $this->cau_hinh,
            'gia_tri' => $this->gia_tri,
        ];
        return DB::insert($sql,$par);
    }

    private function capNhat()
    {
        $sql = "UPDATE cai_dat SET gia_tri = :gia_tri, ngay_tao=NOW() WHERE cau_hinh = :cau_hinh";
        $par = [
            'gia_tri' => $this->gia_tri,
            'cau_hinh' => $this->cau_hinh,
        ];
        return DB::update($sql,$par);
    }

    public function luuCaiDat(){
        $tmp = $this->chiTiet();
        if($tmp)
            return $this->capNhat();
        else
            return $this->them();
    }

    public function themCaiDat()
    {
        $sql = "INSERT INTO cai_dat(cau_hinh, gia_tri, co_dinh) VALUES (:cau_hinh, :gia_tri, 0)";
        $par = [
            'cau_hinh' => $this->cau_hinh,
            'gia_tri' => $this->gia_tri,
        ];
        return DB::insert($sql, $par);
    }

    public function capNhatCaiDat()
    {
        $sql = "UPDATE cai_dat SET cau_hinh = :cau_hinh, gia_tri = :gia_tri, ngay_tao=NOW() WHERE id_cai_dat = :id_cai_dat";
        $par = [
            'cau_hinh' => $this->cau_hinh,
            'gia_tri' => $this->gia_tri,
            'id_cai_dat' => $this->id_cai_dat,
        ];
        return DB::update($sql,$par);
    }


    public function xoaCaiDat()
    {
        $sql = "DELETE FROM cai_dat WHERE id_cai_dat = :id_cai_dat AND co_dinh = 0";
        $par = [
            'id_cai_dat' => $this->id_cai_dat,
        ];
        return DB::delete($sql, $par);
    }

}
