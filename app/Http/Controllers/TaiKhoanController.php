<?php

namespace App\Http\Controllers;

use App\Models\LichSuModel;
use App\Models\TaiKhoanModel;
use App\StaticString;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class TaiKhoanController extends Controller
{
    /*
     * Đăng nhập
     */
    public function getViewDangNhap(){
        return view('auth.login');
    }

    public function gotoGoogleLogin(Request $request)
    {
        if ($request->session()->get('IsLogin')) {
            return redirect()->action('App\Http\Controllers\AuthController@getHome');
        }
        return Socialite::driver('google')->redirect();
    }

    public function callbackGoogleLogin(Request $request)
    {
        $user = Socialite::driver('google')->stateless()->user();
        $tk = new TaiKhoanModel();
        $tk->email =  $user->email;

        # Kiểm tra có đăng nhập
        $login = $tk->dangNhap();
        if($login){
            $request->session()->put(StaticString::SESSION_GAVATAR, $user->avatar);
            $request->session()->put(StaticString::SESSION_GEMAIL, $user->email);
            $request->session()->put(StaticString::SESSION_GNAME, $user->name);
            $request->session()->put(StaticString::SESSION_ISLOGIN, true);
            $request->session()->put(StaticString::SESSION_IDTK, $login->id_tai_khoan);
            $request->session()->put(StaticString::SESSION_QUYEN, $login->quyen);

            # SessionAuthenticator MoxieManager
            session_start();
            $_SESSION['isLoggedIn'] = true;

            # Lưu lịch sử
            $ls = new LichSuModel();
            $ls->id_tai_khoan = getSSKey(StaticString::SESSION_IDTK);
            $ls->thao_tac = "Đăng nhập";
            $ls->them();

            return redirect()
                ->action('App\Http\Controllers\AuthController@AuthPage');
        }
        return redirect()
            ->action('App\Http\Controllers\TaiKhoanController@getViewDangNhap')
            ->with(['msg' => 'Tài khoản của bạn không có quyền hoặc chưa đăng ký']);
    }

    public function dangXuat(Request $request)
    {
        # Lưu lịch sử
        $ls = new LichSuModel();
        $ls->id_tai_khoan = getSSKey(StaticString::SESSION_IDTK);
        $ls->thao_tac = "Đăng xuất";
        $ls->them();

        session_start();
        $_SESSION['isLoggedIn'] = false;

        $request->session()->forget(StaticString::SESSION_GAVATAR);
        $request->session()->forget(StaticString::SESSION_GEMAIL);
        $request->session()->forget(StaticString::SESSION_GNAME);
        $request->session()->forget(StaticString::SESSION_ISLOGIN);
        $request->session()->forget(StaticString::SESSION_IDTK);
        $request->session()->forget(StaticString::SESSION_QUYEN);
        return redirect()->action('App\Http\Controllers\TaiKhoanController@getViewDangNhap');
    }

    /*
     * Quản lý tài khoản
     */

    public function getViewDSTaiKhoan(Request $request)
    {
        $tk = new TaiKhoanModel();
        return view('auth.tai-khoan.danh-sach', ['data' => $tk->dsTaiKhoan()]);
    }

    public function putTaiKhoan(Request $request)
    {
        $tk = new TaiKhoanModel();
        $tk->ho_ten = $request->ho_ten;
        $tk->email = $request->email;
        $tk->quyen = $request->quyen;
        $tk->trang_thai = $request->trang_thai;
        if($tk->them())
            return status("Thêm thông tin thành công", 200);
        return status("Thêm thông tin thất bại", 500);
    }

    public function postTaiKhoan(Request $r)
    {
        $tk = new TaiKhoanModel();
        $tk->id_tai_khoan = $r->input('id_tai_khoan');
        $tk->ho_ten = $r->input('ho_ten');
        $tk->email = $r->input('email');
        $tk->quyen = $r->input('quyen');
        $tk->trang_thai = $r->input('trang_thai');
        if($tk->capNhat())
            return status('Cập nhật thông tin thành công', 200);
        return status('Cập nhật thông tin thất bại', 500);
    }

    public function deleteTaiKhoan(Request $r)
    {
        $tk = new TaiKhoanModel();
        $tk->id_tai_khoan = $r->id_tai_khoan;
        if($tk->xoa())
            return status('Xóa thông tin thành công', 200);
        return status('Xóa thông tin thất bại', 500);
    }

}
