<?php

namespace App\Http\Controllers;

use App\Models\RedirectModel;
use Illuminate\Http\Request;

class RedirectController extends Controller
{
    public function getRedirect()
    {
        $red = new RedirectModel();
        return view('auth.cai-dat.redirect',[
            'data' => $red->danhSach(),
        ]);
    }

    public function putRedirect(Request $request)
    {
        $red = new RedirectModel();
        $red->source = $request->source;
        $red->target = $request->target;
        $red->id_tai_khoan = getIDTK();
        if ($red->them())
            return status('Thêm thông tin thành công', 200);
        return status('Thêm thông tin thất bại', 500);
    }

    public function postRedirect(Request $request)
    {
        $red = new RedirectModel();
        $red->source = $request->source;
        $red->target = $request->target;
        $red->id_redirect = $request->id_redirect;
        if ($red->capNhat())
            return status('Cập nhật thông tin thành công', 200);
        return status('Cập nhật thông tin thất bại', 500);
    }

    public function deleteRedirect(Request $request)
    {
        $red = new RedirectModel();
        $red->id_redirect = $request->id_redirect;
        if ($red->xoa())
            return status('Xóa thông tin thành công', 200);
        return status('Xóa thông tin thất bại', 500);


    }


}
