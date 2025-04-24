@extends('auth.master')

@section('body')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Quản lý thông tin tin tức
                    </div>
                    <h2 class="page-title">
                        Danh sách tin tức
                    </h2>
                </div>

                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <a href="{{action('App\Http\Controllers\TinTucController@getViewThem')}}" class="btn btn-primary text-bold">
                        @component('auth.icons.plus')@endcomponent
                        Tin tức mới
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
                            <div>
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th class="text-center">Nội dung</th>
                                        <th class="text-center">Danh mục</th>
                                        <th class="text-center">Vị trí</th>
                                        <th class="text-center">Trạng thái</th>
                                        <th class="text-center">Cập nhật lần cuối</th>
                                        <th>Thao tác</th>
                                    </tr>
                                    </thead>
                                    <tbody class="table-tbody">
                                    @foreach($tt as $item)
                                        <tr>
                                            <td class="td-truncate w-33">
                                                <a target="_blank" href="/{{ $item->url }}" class="fw-bold" id="tieu-de">{{$item->tieu_de}}</a>
                                                <br>
                                                <div style="margin-top: 6px;">{!! Str::limit(strip_tags($item->noi_dung), 90) !!}</div>
                                            </td>
                                            <td class="text-center">
                                                <?php
                                                    $danhmucModel = new \App\Models\TTucDMucModel();
                                                    $danhmucModel->id_tin_tuc_ = $item->id_tin_tuc;
                                                    $danhmucs = $danhmucModel->chiTietTTucDMuc();
                                                ?>
                                                @foreach($danhmucs as $item_dm)
                                                    <span class="badge badge-secondary mb-1">{{$item_dm->tieu_de}}</span>
                                                    <br>
                                                @endforeach
                                            </td>
                                                <?php
                                                    $hookModel = new \App\Models\HookModel();
                                                    $hookModel->id_hook_ = $item->id_hook;
                                                    if($rsHook = $hookModel->chiTietHook()){
                                                        $vi_tri = $rsHook->vi_tri;
                                                    }else{
                                                        $vi_tri = "";
                                                    };
                                                ?>
                                            <td class="text-center">
                                                {{$vi_tri}}
                                            </td>
                                            <td class="text-center text-success">
                                                @if($item->xuat_ban==1)
                                                    @component('auth.icons.check')@endcomponent
                                                @endif
                                            </td>
                                            <td class="text-center ">
                                                {{ diffForHumans($item->ngay_cap_nhat) }}
                                            </td>
                                            <td class="w-0">
                                                <span class="text-nowrap">
                                                    <a href="{{action('App\Http\Controllers\TinTucController@getViewCapNhat', ['id_tin_tuc'=>$item->id_tin_tuc])}}" class=" text-decoration-none itemCapNhat">
                                                        @component('auth.icons.edit')@endcomponent
                                                    </a>
                                                    <span class="link-primary">|</span>
                                                    <a href="#" data="{{$item->id_tin_tuc}}" class="itemXoa">
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
                            {{$tt->links('pagination::bootstrap-5')}}
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
                if (!confirm("Chọn vào 'YES' để xác nhận xóa thông tin?\nSau khi xóa dữ liệu sẽ không thể phục hồi lại được.")) {
                    return;
                }

                var id = $(this).attr('data');
                $.ajax({
                    url: '{{action('App\Http\Controllers\TinTucController@deleteTinTuc')}}',
                    type: "DELETE",
                    data: {
                        'id_tin_tuc': id,
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
