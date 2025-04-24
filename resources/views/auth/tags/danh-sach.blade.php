@extends('auth.master')

@section('body')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Quản lý thông tin tags
                    </div>
                    <h2 class="page-title">
                        Danh sách tags
                    </h2>
                </div>

                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <a href="{{action('App\Http\Controllers\TagsController@getViewThem')}}" class="btn btn-primary">
                        @component('auth.icons.plus')@endcomponent
                        Tag Mới
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
                                        <th class="text-center">Tiêu đề</th>
                                        <th class="text-center">Người tạo</th>
                                        <th class="text-center">Cập nhật lần cuối</th>
                                        <th>Thao tác</th>
                                    </tr>
                                    </thead>
                                    <tbody class="table-tbody">
                                    @foreach($tags as $item)
                                        <tr id="{{$item->id_danh_muc}}">
                                            <td class="td-truncate w-50">
                                                <div class="text-truncate-multiline-1">
                                                    <a href="#" class="fw-bold" id="tieu-de">{{$item->tieu_de}}</a>
                                                </div>
                                                <div class="text-truncate-multiline-3">
                                                    {!! Str::limit(strip_tags($item->noi_dung), 90) !!}
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
                                            <td class="text-center ">
                                                <span class="text-nowrap">
                                                    {{date("d-m-Y",strtotime($item->ngay_cap_nhat))}}<br>
                                                    lúc {{date("G:m",strtotime($item->ngay_cap_nhat))}}
                                                </span>
                                            </td>
                                            <td class="w-0">
                                                <span class="text-nowrap">
                                                    <a href="{{action('App\Http\Controllers\TagsController@getViewCapNhat',['id_tag'=>$item->id_tag])}}" class="text-decoration-none itemCapNhat">
                                                        @component('auth.icons.edit')@endcomponent
                                                    </a>
                                                    <span class="link-primary">|</span>
                                                    <a href="#" data="{{$item->id_tag}}" class="itemXoa">
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
                            {{$tags->links('pagination::bootstrap-5')}}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.itemXoa').click(function () {
                if (!confirm("Tag bị xóa đồng thời các dữ liệu liên quan sẽ bị xóa.\nSau khi xóa dữ liệu sẽ không thể phục hồi lại được.\nXác nhận xóa?\n")) {
                    return;
                }
                var id = $(this).attr('data');
                $.ajax({
                    url: '{{action('App\Http\Controllers\TagsController@deleteTag')}}',
                    type: "DELETE",
                    data: {
                        'id_tag': id,
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
