@extends('auth.master')

@section('head-link')
    <style>
        .editor-container {
            width: 100%;
            height: 300px;
            margin: 20px auto;
            position: relative;
            overflow: auto;
        }
        .editor {
            position: absolute;
            left: 0;
            right: 0;
            top: 0;
            bottom: 0;
            height: 100%;
            width: 100%;
            font-size: 14px;
        }
    </style>
@endsection

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
                        Cấu hình tùy chỉnh giao diện
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
                                    $web->cau_hinh = \App\Models\CaiDatModel::CUSTOM_CSS;
                                    $data = $web->chiTiet();
                                    ?>
                                    <label class="form-label">Cấu hình CSS</label>
                                    <div class="editor-container">
                                        <div class="css editor">{{ $data->gia_tri }}</div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <?php
                                    $web = new \App\Models\CaiDatModel();
                                    $web->cau_hinh = \App\Models\CaiDatModel::CUSTOM_JS;
                                    $data = $web->chiTiet();
                                    ?>
                                    <label class="form-label">Cấu hình JS</label>
                                    <div class="editor-container">
                                        <div class="js editor">{{ $data->gia_tri }}</div>
                                    </div>
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
    </div>
@endsection

@section('script')
    <script src="{{ asset('cdn/js/moxman.loader.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.32.6/ace.js"></script>

    <script>
        var JS = ace.edit(document.querySelector('.js'));
        JS.setTheme("ace/theme/tomorrow_night_eighties");
        JS.session.setMode("ace/mode/javascript");
        var CSS = ace.edit(document.querySelector('.css'));
        CSS.setTheme("ace/theme/tomorrow_night_eighties");
        CSS.session.setMode("ace/mode/css");

        $('.btnLuu').click(function (){
            $.ajax({
                url: "{{ action('App\Http\Controllers\CaiDatController@postCaiDatGiaoDien') }}",
                type: "POST",
                data: {
                    'css': CSS.getValue(),
                    'js': JS.getValue(),
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
