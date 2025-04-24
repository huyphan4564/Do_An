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
                        Cấu hình Sliders
                    </h2>
                </div>

                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <button class="btn btn-primary d-none d-sm-inline-block btnThem"
                                data-bs-toggle="modal"
                                data-bs-target="#modal-report">
                            @component('auth.icons.plus')@endcomponent
                            Thêm Slider mới
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
                                        <th style="width: 60%">Nội dung</th>
                                        <th class="text-center" style="width: 10%">Số lượng ảnh</th>
                                        <th class="text-center" style="width: 15%">Ngày tạo</th>
                                        <th class="text-end" style="width: 10%">Thao tác</th>
                                    </tr>
                                    </thead>
                                    <tbody class="table-tbody">
                                        @foreach($data as $item)
                                            <tr>
                                                <td>
                                                    <div  class="w-auto">
                                                        <a href="{{ action('App\Http\Controllers\SildersController@getViewSlidersCT', ['id_slide'=>$item->id_slide,]) }}">
                                                            <b>{{ $item->tieu_de }}</b>
                                                        </a>
                                                    </div>
                                                    <div class="" style="text-align: justify;">
                                                        {{ $item->mo_ta }}
                                                    </div>
                                                </td>
                                                <td class="text-center">{{ $item->so_luong }}</td>
                                                <td class="text-center">{{ formatDateTime($item->ngay_tao) }}</td>
                                                <td class="text-end">
                                                    <a href="#" data="{{toAttrJson($item)}}" class="itemCapNhat">
                                                        @component('auth.icons.edit')@endcomponent
                                                    </a> |
                                                    <a href="#" data="{{$item->id_slide}}" class="itemXoa">
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
                            <label class="form-label">Tiêu đề</label>
                            <input type="text" class="form-control tieude" placeholder="Tiều đề ....">
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

        var _thongTin = {id_slide: '', type: ''};
        var PUT_SLIDERS = "{{ action('App\Http\Controllers\SildersController@putSliders') }}";
        var DELETE_SLIDERS = "{{ action('App\Http\Controllers\SildersController@deleteSliders') }}";
        var POST_SLIDERS = "{{ action('App\Http\Controllers\SildersController@postSliders') }}";

        $(document).ready(function () {

            document.title = "Cấu hình Sliders - VLUTE CMS";

            $('.btnThem').click(function () {
                $('#modal-report .modal-title').text('Thêm thông tin Sliders');
                _thongTin.type = 'i';
                $('.tieude').val('');
                $('.mota').val('');
                $('#modal-report').modal('show');
            });

            $(document).on('click', '.itemCapNhat', function(){
                var data = JSON.parse($(this).attr('data'));
                $('.tieude').val(data.tieu_de);
                $('.mota').val(data.mo_ta);
                $('#modal-report .modal-title').text('Cập nhật thông tin Sliders');
                $('#modal-report').modal('show');
                _thongTin.id_slide = data.id_slide;
                _thongTin.type = 'u';
            });

            $('.btnLuu').click(function () {
                switch (_thongTin.type) {
                    case 'i':
                        $.ajax({
                            url: PUT_SLIDERS,
                            type: "PUT",
                            data: {
                                '_token': "{{ csrf_token() }}",
                                'tieu_de': $('.tieude').val(),
                                'mo_ta': $('.mota').val(),
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
                            url: POST_SLIDERS,
                            type: "POST",
                            data: {
                                '_token': "{{ csrf_token() }}",
                                'id_slide': _thongTin.id_slide,
                                'tieu_de': $('.tieude').val(),
                                'mo_ta': $('.mota').val(),
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
                    url: DELETE_SLIDERS,
                    type: "DELETE",
                    data: {
                        'id_slide': id,
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
