@extends('auth.master')

@section('body')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Cài đặt
                    </div>
                    <h2 class="page-title">
                        Cấu hình Hook
                    </h2>
                </div>

                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <a href="#" class="btn btn-primary btnThem"
                       data-bs-toggle="modal"
                       data-bs-target="#modal-report">
                        @component('auth.icons.plus')@endcomponent
                        Thêm Hook mới
                    </a>
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
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th class="text-center">Vị trí</th>
                                        <th class="text-center">Người tạo</th>
                                        <th class="text-center">Ngày tạo</th>
                                        <th>Thao tác</th>
                                    </tr>
                                    </thead>
                                    <tbody class="table-tbody">
                                    @foreach($hook as $item)
                                        <tr id="{{$item->id_tin_tuc}}">
                                            <td class="td-truncate w-50">
                                                <div class="text-truncate-multiline-1">
                                                    <a target="_blank" href="#" class="fw-bold" id="tieu-de">{{ $item->vi_tri }}</a>
                                                </div>
                                                <div class="text-truncate-multiline-3">
                                                    {{@strip_tags($item->mo_ta)}}
                                                </div>
                                            </td>
                                                <?php
                                                    $taikhoanModel = new \App\Models\TaiKhoanModel();
                                                    $taikhoanModel->id_tai_khoan = $item->id_tai_khoan;
                                                    if($rs = $taikhoanModel->chiTietTaiKhoan()){
                                                        $ho_ten = $rs->ho_ten;
                                                    }else{
                                                        $ho_ten = "";
                                                    };
                                                ?>
                                            <td class="text-center text-nowrap">{{$ho_ten}}</td>

                                            <td class="text-center">
                                                <div class="ms-6 me-6 text-center">
                                                    <span class="text-nowrap">
                                                        {{date("d-m-Y",strtotime($item->ngay_tao))}}<br>
                                                        lúc {{date("G:m",strtotime($item->ngay_tao))}}
                                                    </span>
                                                </div>
                                            </td>

                                            <td class="w-0">
                                                <span class="text-nowrap">
                                                    <a href="#" data="{{toAttrJson($item)}}" class="itemCapNhat text-decoration-none">
                                                        @component('auth.icons.edit')@endcomponent
                                                    </a>
                                                    <span class="link-primary">|</span>
                                                    <a href="#" data="{{$item->id_hook}}" class="itemXoa text-decoration-none">
                                                        @component('auth.icons.trash')@endcomponent
                                                    </a>
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            {{$hook->links('pagination::bootstrap-5')}}
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
                            <label class="form-label">Vị trí</label>
                            <input type="text" class="form-control vitri" placeholder="Vị trí ....">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Mô tả</label>
                            <input type="text" class="form-control mota" placeholder="Mô tả ....">
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

        var _thongTin = {id_hook: '', type: ''};
        $(document).ready(function () {

            $('.btnThem').click(function () {
                $('#modal-report .modal-title').text('Thêm Hook');
                _thongTin.type = 'i';
                $('.vitri').val('');
                $('.mota').val('');
                $('#modal-report').modal('show');
            });

            $(document).on('click', '.itemCapNhat', function(){
                var data = JSON.parse($(this).attr('data'));
                $('.vitri').val(data.vi_tri);
                $('.mota').val(data.mo_ta);
                $('#modal-report .modal-title').text('Chỉnh sửa thông tin Hook');
                $('#modal-report').modal('show');
                _thongTin.id_hook = data.id_hook;
                _thongTin.type = 'u';
            });

            $('.btnLuu').click(function () {
                switch (_thongTin.type) {
                    case 'i':
                        $.ajax({
                            url: `{{action('App\Http\Controllers\HookController@putHook')}}`,
                            type: "PUT",
                            data: {
                                '_token': "{{ csrf_token() }}",
                                'vi_tri': $('.vitri').val(),
                                'mo_ta': $('.mota').val(),
                            },
                            success: function (result) {
                                result = JSON.parse(result);
                                if (result.status === 200) {
                                    toastr.success(result.message, "Thao tác thành công");
                                    setTimeout(function () {
                                        window.location.reload();
                                    }, 500);
                                } else if (result.status === 400) {
                                    toastr.error(result.message, "Dữ liệu nhập không hợp lệ");
                                } else {
                                    toastr.error(result.message, "Thao tác thất bại");
                                }
                            }
                        });
                        break;

                    case 'u':
                        $.ajax({
                            url: `{{action('App\Http\Controllers\HookController@postHook')}}`,
                            type: "POST",
                            data: {
                                '_token': "{{ csrf_token() }}",
                                'id_hook': _thongTin.id_hook,
                                'vi_tri': $('.vitri').val(),
                                'mo_ta': $('.mota').val(),
                            },
                            success: function (result) {
                                result = JSON.parse(result);
                                if (result.status === 200) {
                                    toastr.success(result.message, "Thao tác thành công");
                                    setTimeout(function () {
                                        window.location.reload();
                                    }, 500);
                                } else if (result.status === 400) {
                                    toastr.error(result.message, "Dữ liệu nhập không hợp lệ");
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
                    url: '{{action('App\Http\Controllers\HookController@deleteHook')}}',
                    type: "DELETE",
                    data: {
                        'id_hook': id,
                    },
                    success: function (result) {
                        result = JSON.parse(result);
                        if (result.status === 200) {
                            toastr.success(result.message, "Thao tác thành công");
                            setTimeout(function () {
                                window.location.reload();
                            }, 100);
                        } else {
                            toastr.error(result.message, "Thao tác thất bại");
                        }
                    }
                });
            });
        });
    </script>
@endsection
