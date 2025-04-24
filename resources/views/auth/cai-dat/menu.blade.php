@extends('auth.master')

@section('head-link')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nestable2/1.6.0/jquery.nestable.min.css">
    <style>
        .button-update{
            position: absolute;
            top: 6px;
            right: 70px;
            line-height: 39px;
            cursor: context-menu;
        }
    </style>

@endsection

@section('title') Cài đặt menu @endsection

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
                        Cập nhật Menu chính
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

                                <div class="col-6">
                                    <label class="form-label">Tên menu chính</label>
                                    <input type="text" class="form-control ten-menu" placeholder="Tên menu.....">
                                </div>
                                <div class="col-6">
                                    <label class="form-label">URL menu chính</label>
                                    <input type="text" class="form-control url-menu" placeholder="URL menu.....">
                                </div>
                                <div class="col-12 pt-3">
                                    <button class="btn btn-primary btn-them-menu-tu-dong text-bold">
                                        @component('auth.icons.plus')@endcomponent
                                        Thêm menu
                                    </button>
                                    <br>
                                    <hr>
                                </div>

                            </div>

                            <div class="col-12 col-md-6">
                                <label  class="form-label"><b>Menu</b></label>
                                <div class="dd nestable">
                                    <ol class="dd-list list-menu">

                                    </ol>
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

    <div class="modal modal-blur fade modal-update-menu" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-danger">Thay đổi menu</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <label class="form-label">Tên menu</label>
                            <input type="text" class="form-control ten-men-update" placeholder="Vị trí ....">
                        </div>
                        <div class="col-6">
                            <label class="form-label">URL menu</label>
                            <input type="text" class="form-control url-menu-update" placeholder="Mô tả ....">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-luu-changes">Lưu thông tin</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')

    <style>
        .button-update {
            position: absolute;
            top: 6px;
            right: 70px;
            line-height: 39px;
            cursor: context-menu;
        }
    </style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/nestable2/1.6.0/jquery.nestable.min.js"></script>
    <script type="text/javascript">


        function renderMenu(itemMenu){
            if (itemMenu.children && itemMenu.children.length > 0) {
                var menu = `<ol class='dd-list'>`;
                for (let child of itemMenu.children){
                    menu +=
                        "<li class='dd-item' data-name='" + child.name + "' data-url='" + child.url + "'>" +
                        "<div class='dd-handle'>" + child.name + " - "+ itemMenu.url + "</div>" +
                        "<span class='button-delete'>Delete</span>" +
                        "<span class='button-update'>Update</span>";
                    menu += renderMenu(child);
                    menu += `</li>`;
                }
                menu += `</ol>`;
            }
            else{
                menu = "";
            }
            return menu;
        }

        $(document).ready(function () {
            var Menu = {!! $menus->gia_tri ?? "[]" !!};
            if (Menu && Menu.length > 0){
                for (let itemMenu of Menu){
                    let temp = '';
                    temp += renderMenu(itemMenu);
                    $('.list-menu').append(
                        "<li class='dd-item' data-name='" + itemMenu.name + "' data-url='" + itemMenu.url + "'>" +
                        "<div class='dd-handle'>" + itemMenu.name + " - " + itemMenu.url  + "</div>" +
                        "<span class='button-delete'>Delete</span>" +
                        "<span class='button-update'>Update</span>" + temp +
                        "</li>"
                    );
                }
            }

            $('.dd').nestable({
                maxDepth: 3,
            });

            $('.ten-menu').keyup(function () {
                $('.url-menu').val(toSlug($(this).val()));
            });

            $(document).on('click', '.button-delete', function () {
                if (!confirm('Bạn có chắc muốn xóa menu này?'))
                    return;
                if ($(this).attr('ma-danh-muc')){
                    $('.sel-danh-muc').append("<option value='" + $(this).attr('ma-danh-muc') + "'>" +  $(this).attr('ten-danh-muc') + "</option>")
                    $('.btn-them-tu-danh-muc').prop('disabled', false);
                }
                $(this).closest('li').remove();
            });

            $('.btn-them-menu-tu-dong').click(function () {
                var tenMenu = $('.ten-menu').val();
                var urlMenu = $('.url-menu').val();
                if(tenMenu.length === 0 || urlMenu.length === 0){
                    alert("Bạn chưa điền đủ dữ liệu");
                    return;
                }
                $('.list-menu').append(
                    "<li class='dd-item' data-name='" + tenMenu + "' data-url='" + urlMenu + "'>" +
                    "<div class='dd-handle'>" + tenMenu + "</div>" +
                    "<span class='button-delete'>Delete</span>" +
                    "</li>");

                $('.ten-menu, .url-menu').val('');
            });

            $('.btnLuu').click(function () {
                $.ajax({
                    url: "{{ action('App\Http\Controllers\CaiDatController@postCaiDatMenu') }}",
                    type: "POST",
                    data: {
                        'menu': JSON.stringify($('.dd').nestable('serialize'))
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

            var itemMenu =  null;
            $(document).on('click', '.button-update', function (){
                itemMenu = $(this).closest('li');
                $('.ten-men-update').val(itemMenu.attr('data-name'));
                $('.url-menu-update').val(itemMenu.attr('data-url'));
                $('.modal-update-menu').modal('show');
            });

            $('.btn-luu-changes').click(function () {
                $(itemMenu).attr('data-name', $('.ten-men-update').val());
                $(itemMenu).attr('data-url', $('.url-menu-update').val());
                itemMenu.children('.dd-handle').text($('.ten-men-update').val());
                $('.modal-update-menu').modal('hide');
            });
        });

    </script>
@endsection
