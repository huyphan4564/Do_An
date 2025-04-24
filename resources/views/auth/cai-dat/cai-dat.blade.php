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
                        Quản lý cài đặt
                    </h2>
                </div>

                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <button class="btn btn-primary d-none d-sm-inline-block btnThem"
                                data-bs-toggle="modal"
                                data-bs-target="#modal-report">
                            @component('auth.icons.plus')@endcomponent
                            Thêm cài đặt mới
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
                                <table class="table table-vcenter card-table">
                                    <thead>
                                    <tr>
                                        <th style="">Cấu hình</th>
                                        <th class="">Giá trị</th>
                                        <th class="text-center" style="width: 15%">Ngày tạo</th>
                                        <th class="text-end">Thao tác</th>
                                    </tr>
                                    </thead>
                                    <tbody class="table-tbody">
                                    @foreach($data as $item)
                                        <tr>
                                            <td>{{ $item->cau_hinh }}</td>
                                            <td>{{ $item->gia_tri }}</td>
                                            <td class="text-center">{{ formatDateTime($item->ngay_tao) }}</td>
                                            <td class="text-end">
                                                <a href="#" data="{{toAttrJson($item)}}" class="itemCapNhat">
                                                    @component('auth.icons.edit')@endcomponent
                                                </a> |
                                                <a href="#" data="{{$item->id_cai_dat}}" class="itemXoa">
                                                    @component('auth.icons.trash')@endcomponent
                                                </a>
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
                            <label class="form-label">Cấu hình</label>
                            <input type="text" class="form-control cau_hinh" placeholder="Cấu hình...">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Giá trị</label>
                            <input type="text" class="form-control gia_tri" placeholder="Giá trị...">
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

        var _thongTin = {id_cai_dat: '', type: ''};
        var PUT_CAIDAT = "{{ action('App\Http\Controllers\CaiDatController@putCaiDat') }}";
        var DELETE_CAIDAT = "{{ action('App\Http\Controllers\CaiDatController@deleteCaiDat') }}";
        var POST_CAIDAT = "{{ action('App\Http\Controllers\CaiDatController@postCaiDat') }}";

        $(document).ready(function () {

            document.title = "Cấu hình Redirects - VLUTE CMS";

            $('.btnThem').click(function () {
                $('#modal-report .modal-title').text('Thêm thông tin Cài đặt');
                _thongTin.type = 'PUT';
                $('.cau_hinh').val('');
                $('.gia_tri').val('');
                $('#modal-report').modal('show');
            });

            $(document).on('click', '.itemCapNhat', function(){
                var data = JSON.parse($(this).attr('data'));
                $('.cau_hinh').val(data.cau_hinh);
                $('.gia_tri').val(data.gia_tri);
                $('#modal-report .modal-title').text('Cập nhật thông tin Cài đặt');
                $('#modal-report').modal('show');
                _thongTin.id_cai_dat = data.id_cai_dat;
                _thongTin.type = 'POST';
            });

            $('.btnLuu').click(function () {
                switch (_thongTin.type) {
                    case 'PUT':
                        $.ajax({
                            url: PUT_CAIDAT,
                            type: _thongTin.type,
                            data: {
                                '_token': "{{ csrf_token() }}",
                                'cau_hinh': $('.cau_hinh').val(),
                                'gia_tri': $('.gia_tri').val(),
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

                    case 'POST':
                        $.ajax({
                            url: POST_CAIDAT,
                            type: _thongTin.type,
                            data: {
                                '_token': "{{ csrf_token() }}",
                                'id_cai_dat': _thongTin.id_cai_dat,
                                'cau_hinh': $('.cau_hinh').val(),
                                'gia_tri': $('.gia_tri').val(),
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
                    url: DELETE_CAIDAT,
                    type: "DELETE",
                    data: {
                        'id_cai_dat': id,
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
