@extends('auth.master')

@section('body')

    <style>
        .thumbnail-slider {
            object-fit: cover;
            height: 50px;
            width: 100%;
            border-radius: 5px;
        }
    </style>

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
                        Cấu hình Sliders/ {{ $tieu_de_slide }}
                    </h2>
                </div>

                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <button class="btn btn-primary d-none d-sm-inline-block btnThem"
                                data-bs-toggle="modal"
                                data-bs-target="#modal-report">
                            @component('auth.icons.plus')@endcomponent
                            Thêm ảnh
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
                                        <th style="width: 200px;" class="text-center">Ảnh</th>
                                        <th >Nội dung</th>
                                        <th class="text-center">Thứ tự</th>
                                        <th class="text-center" style="width: 15%">Ngày tạo</th>
                                        <th class="text-end w-8">Thao tác</th>
                                    </tr>
                                    </thead>
                                    <tbody class="table-tbody">
                                    @foreach($data as $item)
                                        <tr>
                                            <td >
                                                <a href="{{ $item->thumbnail }}">
                                                    <img src="{{ $item->thumbnail }}" class="thumbnail-slider" alt="">
                                                </a>
                                            </td>
                                            <td>
                                                <div><b>{{ $item->tieu_de }}</b></div>
                                                <div class="text-secondary">{{ $item->noi_dung }}</div>
                                            </td>
                                            <td class="text-center">
                                                {{ $item->thu_tu }}
                                            </td>
                                            <td class="text-center">
                                                {{ formatDateTime($item->ngay_tao) }}
                                            </td>
                                            <td class="text-end">
                                                <a href="#" data="{{toAttrJson($item)}}" class="itemCapNhat">
                                                    @component('auth.icons.edit')@endcomponent
                                                </a> |
                                                <a href="#" data="{{$item->id_slides_ct}}" class="itemXoa">
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
                            <input type="text" class="form-control tieude" placeholder="Tiêu đề ....">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Mô tả</label>
                            <textarea type="email" class="form-control mota" placeholder="Mô tả ...."></textarea>
                        </div>
                        <div class="col-6">
                            <label class="form-label">Thứ tự</label>
                            <input type="number" class="form-control thutu" placeholder="Thứ tự ....">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Hình ảnh</label>
                            <img src="{{asset('images/image.png')}}" onerror="this.src='{{asset('dist/images/image.png')}}'" class="border choose-thumbnail object-fit-contain">
                            <script type="text/javascript">
                                $('.choose-thumbnail').click(function () {
                                    moxman.browse({
                                        no_host: true,
                                        leftpanel: false,
                                        multiple: false,
                                        title: "Duyệt thư viện ảnh",
                                        oninsert: function (args) {
                                            $('.choose-thumbnail').attr('src', args.files[0].url);
                                        }
                                    });
                                });
                            </script>
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
    <script src="{{ asset('cdn/js/moxman.loader.min.js') }}"></script>
    <script type="text/javascript">

        document.title = "Cấu hình Sliders/ {{ $tieu_de_slide }} - VLUTE CMS";

        var _thongTin = {id_slides_ct: '', type: ''};
        var PUT_SLIDERSCT = "{{ action('App\Http\Controllers\SildersController@getViewSlidersCT', ['id_slide' => $id_slide]) }}";
        var DELETE_SLIDERSCT = "{{ action('App\Http\Controllers\SildersController@deleteSlidersCT', ['id_slide' => $id_slide]) }}"
        var POST_SLIDERSCT = "{{ action('App\Http\Controllers\SildersController@postSlidersCT', ['id_slide' => $id_slide]) }}"


        $(document).ready(function () {
            $('.btnThem').click(function () {
                $('#modal-report .modal-title').text('Thêm thông tin Ảnh');
                _thongTin.type = 'i';
                $('#modal-report').modal('show');
            });

            $(document).on('click', '.itemCapNhat', function(){
                var data = JSON.parse($(this).attr('data'));
                $('.tieude').val(data.tieu_de);
                $('.mota').val(data.noi_dung);
                $('.choose-thumbnail').attr('src', data.thumbnail);
                $('.thutu').val(data.thu_tu);
                $('#modal-report .modal-title').text('Cập nhật thông tin Sliders');
                $('#modal-report').modal('show');
                _thongTin.id_slides_ct = data.id_slides_ct;
                _thongTin.type = 'u';
            });

            $('.btnLuu').click(function () {
                switch (_thongTin.type) {
                    case 'i':
                        $.ajax({
                            url: PUT_SLIDERSCT,
                            type: "PUT",
                            data: {
                                'tieu_de': $('.tieude').val(),
                                'noi_dung': $('.mota').val(),
                                'thumbnail' : $('.choose-thumbnail').attr('src'),
                                'thu_tu': $('.thutu').val(),
                                'id_slide': {{ $id_slide }},
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
                            },
                            error: function (error) {
                                console.log(error);
                            }
                        });
                        break;

                    case 'u':
                        $.ajax({
                            url: POST_SLIDERSCT,
                            type: "POST",
                            data: {
                                'tieu_de': $('.tieude').val(),
                                'noi_dung': $('.mota').val(),
                                'thumbnail' : $('.choose-thumbnail').attr('src'),
                                'thu_tu': $('.thutu').val(),
                                'id_slides_ct': _thongTin.id_slides_ct,
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
                    url: DELETE_SLIDERSCT,
                    type: "DELETE",
                    data: {
                        'id_slides_ct': id,
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
