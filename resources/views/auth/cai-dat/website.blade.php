@extends('auth.master')

@section('body')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        Cài đặt
                    </div>
                    <h2 class="page-title">
                        Cấu hình Website
                    </h2>
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
                            <div class="row">
                                <div class="col-12">
                                    <?php
                                        $web = new \App\Models\CaiDatModel();
                                        $web->cau_hinh = \App\Models\CaiDatModel::HOMEPAGE_TITLE;
                                        $data = $web->chiTiet();
                                    ?>
                                    <label class="form-label">Tiêu đề Website</label>
                                    <input type="text" class="form-control title" placeholder="Tiêu đề Website ...." value="{{ $data->gia_tri }}">
                                </div>

                                <div class="col-12">
                                    <?php
                                        $web->cau_hinh = \App\Models\CaiDatModel::HOMEPAGE_SEARCH_TITLE;
                                        $data = $web->chiTiet();
                                    ?>
                                    <label class="form-label">Search title</label>
                                    <input type="text" class="form-control search_title" value="{{ $data->gia_tri }}" placeholder="Search title ....">
                                </div>

                                <div class="col-12">
                                    <?php
                                        $web->cau_hinh = \App\Models\CaiDatModel::HOMEPAGE_SEARCH_DESCRIPTION;
                                        $data = $web->chiTiet();
                                    ?>
                                    <label class="form-label">Search description</label>
                                    <input type="text" class="form-control search_description" value="{{ $data->gia_tri }}" placeholder="Search description ....">
                                </div>

                                <div class="col-12">
                                    <?php
                                        $web->cau_hinh = \App\Models\CaiDatModel::HOMEPAGE_ICON;
                                        $data = $web->chiTiet();
                                    ?>
                                    <label class="form-label">Icon trình duyệt</label>
                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control icon-td" readonly  value="{{ $data->gia_tri }}">
                                        <button class="btn btn-primary rounded btn-file choose-icon">
                                            @component('auth.icons.attached')@endcomponent
                                            Chọn file
                                        </button>
                                        <script type="text/javascript">
                                            $('.choose-icon').click(function () {
                                                moxman.browse({
                                                    no_host: true,
                                                    leftpanel: false,
                                                    multiple: false,
                                                    title: "Duyệt thư viện ảnh",
                                                    oninsert: function (args) {
                                                        $('.icon-td').val(args.files[0].url);
                                                    }
                                                });
                                            });
                                        </script>
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    <?php
                                        $web->cau_hinh = \App\Models\CaiDatModel::HOMEPAGE_THUMBNAIL;
                                        $data = $web->chiTiet();
                                    ?>
                                    <label class="form-label">Thumbnail</label>
                                    <img src="{{ $data->gia_tri }}"
                                         style="object-fit: cover !important;"
                                         onerror="this.src='{{ asset('dist/images/image.png') }}'"
                                         class="border choose-thumbnail thumbnail object-fit-contain">
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
                            <div class="col-12">
                                <hr>
                                <button type="submit" class="btn btn-primary btnLuu">
                                    @component('auth.icons.save')@endcomponent
                                    Lưu thông tin
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endsection

@section('script')
<script src="{{ asset('cdn/js/moxman.loader.min.js') }}"></script>
<script>
    $('.btnLuu').click(function (){
        $.ajax({
            url: "{{ action('App\Http\Controllers\CaiDatController@postCaiDatWebsite') }}",
            type: "POST",
            data: {
                'title': $('.title').val(),
                'search_title': $('.search_title').val(),
                'search_description': $('.search_description').val(),
                'icon_td': $('.icon-td').val(),
                'thumbnail': $('.thumbnail').attr('src'),
            },
            success: function (result) {
                result = JSON.parse(result);
                if (result.status === 200) {
                    toastr.success(result.message, "Thao tác thành công");
                    setTimeout(function () {
                        location.reload();
                    }, 750);
                } else {
                    toastr.error(result.message, "Thao tác thất bại");
                }
            },
            error: function (error) {
                console.log(error);
            }
        });
    });
</script>
@endsection
