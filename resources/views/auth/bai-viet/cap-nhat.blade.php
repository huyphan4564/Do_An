@extends('auth.master')
@section('title', $tt->tieu_de)
@section('head-link')
    <link href="{{ asset('dist/css/select2.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('dist/css/select2.css') }}" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection

@section('body')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        Quản lý thông tin tin tức
                    </div>
                    <h2 class="page-title">
                        Cập nhật tin tức
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
                            <h3 class="card-title text-body">{{ $tt->tieu_de }}</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">

                                <div class="col-12">
                                    <label class="form-label">Tiêu đề</label>
                                    <input type="text" class="form-control tieuDe" placeholder="Tiêu đề ...."
                                           value="{{$tt->tieu_de}}">
                                </div>

                                <div class="col-12">
                                    <label class="form-label">URL</label>
                                    <input type="text" class="form-control URL" placeholder="URL ...."
                                           value="{{$tt->url}}">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Hình ảnh</label>
                                    <img src="{{asset($tt->thumbnail)}}"
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
                                           value="{{$tt->search_title}}">
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Search description</label>
                                    <input type="text" class="form-control searchDescription"
                                           placeholder="Search description ...." value="{{$tt->search_description}}">
                                </div>

                                <div class="col-6">
                                    <label class="form-label">Danh mục tin tức</label>
                                    <select class="form-control danh-muc" name="states[]" multiple="multiple"
                                            data-placeholder="Chọn danh mục">
                                        @foreach($danhMucs as $item_dm)
                                            <option value="{{$item_dm->id_danh_muc}}">{{$item_dm->tieu_de}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-6">
                                    <label class="form-label">Tags</label>
                                    <select class="form-control tags" name="states[]" multiple="multiple"
                                            data-placeholder="Chọn tag">
                                        @foreach($tags as $item_tag)
                                            <option value="{{$item_tag->id_tag}}">{{$item_tag->tieu_de}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-6">
                                    <label class="form-label">Vị trí</label>
                                    <select class="form-control form-select hooks" data-placeholder="Chọn vị trí">
                                        <option value="-1">-- Chọn vị trí ---</option>
                                        @foreach($hooks as $item_hook)
                                            <option value="{{$item_hook->id_hook}}">{{$item_hook->vi_tri}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Nội dung</label>
                                    <textarea class="post-content noiDung" name="noiDung">{{$tt->noi_dung}}</textarea>
                                </div>

                                <div class="col-6">
                                    <label class="form-label"></label>
                                    <label class="form-check">
                                        <input class="form-check-input xuatBan" type="checkbox"
                                               @if($tt->xuat_ban==1) checked="" @endif>
                                        <span class="form-check-label">Xuất bản bài viết</span>
                                    </label>
                                </div>

                                <div class="col-12">
                                    <button type="button" class="btn btn-primary btnLuu">
                                        @component('auth.icons.save')@endcomponent
                                        Cập nhật
                                    </button>
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

            $('.danh-muc, .tags, .hooks').select2({
                theme: 'bootstrap-5',
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                placeholder: $(this).data('placeholder'),
                closeOnSelect: false,
                allowClear: true,
                dropdownCssClass: "select2--small",
            })

            $('.danh-muc').each(function () {
                $(this).val(@json($tt->dm));
                $(this).trigger('change');
            });

            $('.tags').each(function () {
                $(this).val(@json($tt->tag));
                $(this).trigger('change');
            });

            $('.hooks').each(function () {
                $(this).val(`{{$tt->id_hook}}`);
                $(this).trigger('change');
            })

            $('.btnLuu').click(function (event, back = true) {
                tinymce.get('noiDung').save();
                $.ajax({
                    url: '{{ action('App\Http\Controllers\TinTucController@postTinTuc') }}',
                    type: "POST",
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'id_tin_tuc': {{$tt->id_tin_tuc}},
                        'tieuDe': $('.tieuDe').val(),
                        'URL': $('.URL').val(),
                        'thumbnail': $('.choose-thumbnail').attr('src'),
                        'searchTitle': $('.searchTitle').val(),
                        'searchDescription': $('.searchDescription').val(),
                        'id_danh_muc_arr': $('.danh-muc').val(),
                        'id_tag_arr': $('.tags').val(),
                        'id_hook':$('.hooks').val(),
                        'noiDung': tinymce.get('noiDung').getContent(),//.replace(/\n/g, '').replace(/\r/g, ''),
                        'xuatBan': $(".xuatBan").is(':checked') ? 1 : 0
                    },
                    success: function (result) {
                        result = JSON.parse(result);
                        if (result.status === 200) {
                            if (back) {
                                toastr.success(result.message, "Thao tác thành công");
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
