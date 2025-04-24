@extends('auth.master')

@section('body')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Danh sách
                    </div>
                    <h2 class="page-title">
                        Tài khoản người dùng
                    </h2>
                </div>

                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <button class="btn btn-primary d-none d-sm-inline-block btnThem"
                           data-bs-toggle="modal"
                           data-bs-target="#modal-report">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M12 5l0 14"></path>
                                <path d="M5 12l14 0"></path>
                            </svg>
                            Thêm mới
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div id="table-default" class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Họ và tên</th>
                                        <th>Email</th>
                                        <th>Quyền</th>
                                        <th >Trạng thái tài khoản</th>
                                        <th >Lần đăng nhập sau cùng</th>
                                        <th >Ngày tạo</th>
                                        <th>Thao tác</th>
                                    </tr>
                                    </thead>
                                    <tbody class="table-tbody">
                                    @foreach($data as $item)
                                        <tr>
                                            <td>{{ $item->ho_ten }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->quyen }}</td>
                                            <td>
                                                @if($item->trang_thai == 1)
                                                    <span class="text-success">Đang hoạt động</span>
                                                @elseif($item->trang_thai == 0)
                                                    <span class="text-danger">Khóa</span>
                                                @endif
                                            </td>
                                            <td>{{ formatDateTime($item->dnhap_gan_nhat) }}</td>
                                            <td>{{ diffForHumans($item->ngay_tao) }}</td>
                                            <td>
                                                <a href="#" data="{{toAttrJson($item)}}" class="itemCapNhat"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                        <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                        <path d="M16 5l3 3" />
                                                    </svg></a> |
                                                <a href="#" data="{{$item->id_tai_khoan}}" class="itemXoa"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M4 7l16 0" />
                                                        <path d="M10 11l0 6" />
                                                        <path d="M14 11l0 6" />
                                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                    </svg></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal modal-blur fade" id="modal-report" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-danger "></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label">Họ và tên</label>
                            <input type="text" class="form-control hoten" placeholder="Họ và tên ....">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control email" placeholder="hoten@vlute.edu.vn ....">
                        </div>
                        <div class="col-6">
                            <label class="form-label">Quyền hạn</label>
                            <select type="text" class="form-control quyen">
                                <option value="Admin">Quản trị (Toàn quyền)</option>
                                <option value="Editor">Editor (Đăng bài)</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="form-label">Trạng thái</label>
                            <select type="text" class="form-control trangthai">
                                <option value=1>Hoạt động bình thường</option>
                                <option value=0>Khoá</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btnLuu">Lưu thông tin</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">

        var _thongTin = {id_tai_khoan: '', type: ''};
        var PUT_TAI_KHOAN = "{{ action('App\Http\Controllers\TaiKhoanController@putTaiKhoan') }}";
        var DELETE_TAI_KHOAN = "{{ action('App\Http\Controllers\TaiKhoanController@deleteTaiKhoan') }}";
        var POST_TAI_KHOAN = "{{ action('App\Http\Controllers\TaiKhoanController@postTaiKhoan') }}";

        $(document).ready(function () {
            $('.btnThem').click(function () {
            $('#modal-report .modal-title').text('Thêm thông tin tài khoản');
            _thongTin.type = 'i';
            $('#modal-report').modal('show');
        });

        $(document).on('click', '.itemCapNhat', function(){
            var data = JSON.parse($(this).attr('data'));
            $('.hoten').val(data.ho_ten);
            $('.email').val(data.email);
            $('.quyen').val(data.quyen);
            $('.trangthai').val(data.trang_thai);
            $('#modal-report .modal-title').text('Cập nhật thông tin tài khoản');
            $('#modal-report').modal('show');
            _thongTin.id_tai_khoan = data.id_tai_khoan;
            _thongTin.type = 'u';
        });

        $('.btnLuu').click(function () {
            switch (_thongTin.type) {
                case 'i':
                    $.ajax({
                        url: PUT_TAI_KHOAN,
                        type: "PUT",
                        data: {
                            'ho_ten': $('.hoten').val(),
                            'email': $('.email').val(),
                            'quyen': $('.quyen').val(),
                            'trang_thai': $('.trangthai').val(),
                        },
                        success: function (result) {
                            result = JSON.parse(result);
                            if (result.status === 200) {
                                toastr.success(result.message, "Thao tác thành công");
                                setTimeout(function () {
                                    window.location.reload();
                                }, 500);
                            } else {
                                toastr.error(result.message, "Thao tác thất bại");
                            }
                        }
                    });
                    break;

                case 'u':
                    $.ajax({
                        url: POST_TAI_KHOAN,
                        type: "POST",
                        data: {
                            'id_tai_khoan': _thongTin.id_tai_khoan,
                            'ho_ten': $('.hoten').val(),
                            'email': $('.email').val(),
                            'quyen': $('.quyen').val(),
                            'trang_thai': $('.trangthai').val(),
                        },
                        success: function (result) {
                            result = JSON.parse(result);
                            if (result.status === 200) {
                                toastr.success(result.message, "Thao tác thành công");
                                setTimeout(function () {
                                    window.location.reload();
                                }, 500);
                            } else {
                                toastr.error(result.message, "Thao tác thất bại");
                            }
                        }
                    });
                    break;
            }
        });

        $('.itemXoa').click(function () {

            if (!confirm("Chọn vào 'YES' để xác nhận xóa thông tin?\nSau khi xóa dữ liệu sẽ không thể phục hồi lại được.")) {
                return;
            }

            var id = $(this).attr('data');
            $.ajax({
                url: DELETE_TAI_KHOAN,
                type: "DELETE",
                data: {
                    'id_tai_khoan': id,
                },
                success: function (result) {
                    result = JSON.parse(result);
                    if (result.status === 200) {
                        toastr.success(result.message, "Thao tác thành công");
                        setTimeout(function () {
                            window.location.reload();
                        }, 500);
                    } else {
                        toastr.error(result.message, "Thao tác thất bại");
                    }
                }
            });
        });
        });
    </script>
@endsection
