@extends('auth.master')
@section('title', $dm->tieu_de)
@section('head-link')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap5-toggle@5.0.4/css/bootstrap5-toggle.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap5-toggle@5.0.4/js/bootstrap5-toggle.jquery.min.js"></script>
@endsection
@section('body')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        Quản lý thông tin danh mục
                    </div>
                    <h2 class="page-title">
                        Cập nhật danh mục
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title text-body">{{ $dm->tieu_de }}</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">

                                <div class="col-12">
                                    <label class="form-label">Tiêu đề</label>
                                    <input type="text" class="form-control tieuDe" placeholder="Tiêu đề ...."
                                           value="{{$dm->tieu_de}}">
                                </div>

                                <div class="col-12">
                                    <label class="form-label">
                                        URL
                                    </label>
                                    <input type="text" class="form-control URL" placeholder="URL ...." value="{{$dm->url}}">

                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Hình ảnh</label>
                                    <img src="{{asset($dm->thumbnail)}}"
                                         onerror="this.src='{{asset('dist/images/image.png')}}'"
                                         class="border choose-thumbnail" alt="">
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

                                <div class="col-12">
                                    <label class="form-label">Search title</label>
                                    <input type="text" class="form-control searchTitle" placeholder="Search title ...."
                                           value="{{$dm->search_title}}">
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Search description</label>
                                    <input type="text" class="form-control searchDescription"
                                           placeholder="Search description ...." value="{{$dm->search_description}}">
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Nội dung</label>
                                    <textarea class="post-content noiDung" name="noiDung">{{$dm->noi_dung}}</textarea>
                                </div>

                                <div class="col-12">
                                    <hr>
                                    <button type="submit" class="btn btn-primary btnLuu">Lưu thông tin danh mục</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            intTinyMCE('.post-content', 400);

            $('.URL').on('keypress', function (event) {
                if (event.which === 32)
                    $(this).val(toSlug($(this).val()))
            });

            $('.URL').change(function () {
                $(this).val(toSlug($(this).val()))
            });

            $('.btnLuu').click(function (event, back = true) {
                tinymce.get('noiDung').save();
                $.ajax({
                    url: '{{ action('App\Http\Controllers\DanhMucController@postDanhMuc') }}',
                    type: "POST",
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'id_danh_muc': {{$dm->id_danh_muc}},
                        'tieuDe': $('.tieuDe').val(),
                        'URL': $('.URL').val(),
                        'thumbnail': $('.choose-thumbnail').attr('src'),
                        'searchTitle': $('.searchTitle').val(),
                        'searchDescription': $('.searchDescription').val(),
                        'noiDung': tinymce.get('noiDung').getContent()
                    },
                    success: function (result) {
                        result = JSON.parse(result);
                        if (result.status === 200) {
                            if(back){
                                toastr.success(result.message, "Thao tác thành công");
                                setTimeout(function () {
                                    tinymce.get('noiDung').isNotDirty  = 1;
                                    location.replace('{{action('App\Http\Controllers\DanhMucController@getViewDanhSach')}}');
                                }, 100);
                            }
                        } else if (result.status === 400) {
                            toastr.error(result.message, "Dữ liệu nhập không hợp lệ");
                        } else {
                            toastr.error(result.message, "Thao tác thất bại");
                        }
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>
@endsection
