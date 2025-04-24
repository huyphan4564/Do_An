<?php

namespace App\Models;

use App\StaticString;
use App\Traits\LichSu;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LichSuModel extends Model
{
    use LichSu;

    public function them(){
        $sql = "INSERT INTO lich_su(id_tai_khoan, thao_tac) VALUE (:id_tai_khoan, :thao_tac);";
        $par = [
            'id_tai_khoan' => $this->id_tai_khoan,
            'thao_tac' => $this->thao_tac
        ];
        return DB::insert($sql, $par);
    }
}
