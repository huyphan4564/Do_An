<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{asset('dist/images/logo.png')}}" sizes="16x16" type="image/png">
    <link rel="icon" href="{{asset('dist/images/logo.png')}}" sizes="32x32" type="image/png">
    <link rel="icon" href="{{asset('dist/images/logo.png')}}" sizes="48x48" type="image/png">
    <link rel="icon" href="{{asset('dist/images/logo.png')}}" sizes="62x62" type="image/png">
    <link rel="icon" href="{{asset('dist/images/logo.png')}}" sizes="192x192" type="image/png">
    <title>@yield('title', 'Dashboard - VLUTE CMS')</title>
    <link href="{{ asset('dist/css/tabler.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('dist/css/style.css') }}?token={{ sha1(uniqid(time(), true)) }}" rel="stylesheet"/>
    <link href="{{ asset('dist/css/nestable.css') }}" rel="stylesheet"/>
    <link href="{{ asset('dist/css/toastr.css') }}" rel="stylesheet"/>
    <script src="{{ asset('dist/js/tabler.min.js') }}"></script>
    <script src="{{ asset('dist/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('cdn/plugin.js') }}"></script>
    <script src="{{ asset('dist/js/function.js') }}?token={{ sha1(uniqid(time(), true)) }}"></script>
    <script src="{{ asset('dist/js/toastr.min.js') }}"></script>
    @yield('head-link')
</head>
<body>

@if(isLogin())
    <div class="container-fluid" id="admin-quiz-edit" style="background: red;">
        <div class="container">
            <div class="row" style="height: 40px;">
                <div class="col-12">
                    <p style="width: 100%; text-align: center; line-height: 40px; color: white;">
                        <b>Bạn đang tương tác với CSDL phiên
                            bản {{ Session::get('locale') == 'en' ? "Tiếng anh" : "Tiếng việt" }}</b>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endif

<div class="page">
    <header class="navbar navbar-expand-md d-print-none">
        <div class="container-xl">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu"
                    aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
                <a href=".">
                    <img src="{{ asset('dist/images/logo.svg') }}" width="110" height="32" alt="VLUTE CMS"
                         class="navbar-brand-image">
                </a>
            </h1>
            <div class="navbar-nav flex-row order-md-last">
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                       aria-label="Open user menu">
                        <span class="avatar avatar-sm"
                              style="background-image: url('{{ getSSKey(\App\StaticString::SESSION_GAVATAR) }}')"></span>
                        <div class="d-none d-xl-block ps-2">
                            <div>{{ getSSKey(StaticString::SESSION_QUYEN) }}</div>
                            <div
                                class="mt-1 small text-secondary">{{ getSSKey(\App\StaticString::SESSION_GNAME) }}</div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <a href="#" class="dropdown-item">Cài đặt</a>
                        <a href="{{ action('App\Http\Controllers\TaiKhoanController@dangXuat') }}"
                           class="dropdown-item">Đăng xuất</a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <header class="navbar-expand-md">
        <div class="collapse navbar-collapse" id="navbar-menu">
            <div class="navbar">
                <div class="container-xl">
                    <ul class="navbar-nav">
                        <li class="nav-item trang-chu">
                            <a class="nav-link" href="/auth">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                           viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                           stroke-linecap="round" stroke-linejoin="round"><path stroke="none"
                                                                                                d="M0 0h24v24H0z"
                                                                                                fill="none"></path><path
                                              d="M5 12l-2 0l9 -9l9 9l-2 0"></path><path
                                              d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path><path
                                              d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"></path></svg>
                                    </span>
                                <span class="nav-link-title">
                                      Trang chủ
                                    </span>
                            </a>
                        </li>
                        <li class="nav-item dropdown tin-tuc-nav-item">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"
                               data-bs-auto-close="outside" role="button" aria-expanded="false">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                             viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                             stroke-linecap="round" stroke-linejoin="round"><path stroke="none"
                                                                                                  d="M0 0h24v24H0z"
                                                                                                  fill="none"/><path
                                                d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"/><path
                                                d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"/><path
                                                d="M15 15l3.35 3.35"/><path d="M9 15l-3.35 3.35"/><path
                                                d="M5.65 5.65l3.35 3.35"/><path d="M18.35 5.65l-3.35 3.35"/></svg>
                                    </span>
                                <span class="nav-link-title">
                                        Quản lý tin tức
                                        </span>
                            </a>
                            <div class="dropdown-menu">

                                <a class="dropdown-item"
                                   href="{{action('App\Http\Controllers\TinTucController@getViewDanhSach')}}"
                                   rel="noopener">
                                    Danh sách tin tức
                                </a>
                                <a class="dropdown-item"
                                   href="{{action('App\Http\Controllers\TinTucController@getViewThongKe')}}"
                                   rel="noopener">
                                    Thống kê tin tức
                                </a>
                            </div>
                        </li>
                        <li class="nav-item dropdown danh-muc-nav-item">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"
                               data-bs-auto-close="outside" role="button" aria-expanded="false">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="icon icon-tabler icon-tabler-info-square-rounded" width="24"
                                             height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                             fill="none" stroke-linecap="round" stroke-linejoin="round"><path
                                                stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 9h.01"/><path
                                                d="M11 12h1v4h1"/><path
                                                d="M12 3c7.2 0 9 1.8 9 9s-1.8 9 -9 9s-9 -1.8 -9 -9s1.8 -9 9 -9z"/></svg>
                                    </span>
                                <span class="nav-link-title">
                                        Quản lý thông tin
                                    </span>
                            </a>
                            <div class="dropdown-menu">

                                <a class="dropdown-item"
                                   href="{{action('App\Http\Controllers\DanhMucController@getViewDanhSach')}}"
                                   rel="noopener">
                                    Danh mục tin tức
                                </a>
                                <a class="dropdown-item"
                                   href="{{action('App\Http\Controllers\TagsController@getViewDanhSach')}}"
                                   rel="noopener">
                                    Tags
                                </a>
                                <a class="dropdown-item"
                                   href="{{action('App\Http\Controllers\PageController@getViewDanhSach')}}"
                                   rel="noopener">
                                    Pages
                                </a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"
                               data-bs-auto-close="outside" role="button" aria-expanded="false">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="icon icon-tabler icon-tabler-settings" width="24" height="24"
                                             viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                             stroke-linecap="round" stroke-linejoin="round"><path stroke="none"
                                                                                                  d="M0 0h24v24H0z"
                                                                                                  fill="none"/><path
                                                d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z"/><path
                                                d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"/></svg>
                                    </span>
                                <span class="nav-link-title">
                                        Cài đặt
                                    </span>
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item"
                                   href="{{ action('App\Http\Controllers\SildersController@getViewSliders') }}"
                                   rel="noopener">
                                    Sliders
                                </a>

                                <a class="dropdown-item"
                                   href="{{ action('App\Http\Controllers\CaiDatController@getViewCaiDatWebsite') }}"
                                   rel="noopener">
                                    Websites
                                </a>

                                <a class="dropdown-item"
                                   href="{{ action('App\Http\Controllers\CaiDatController@getViewCaiDatGiaoDien') }}"
                                   rel="noopener">
                                    Tuỳ chỉnh CSS/JS
                                </a>

                                <a class="dropdown-item"
                                   href="{{ action('App\Http\Controllers\CaiDatController@getViewCaiDatMenu') }}"
                                   rel="noopener">
                                    Cấu hình menu
                                </a>

                                <a class="dropdown-item"
                                   href="{{ action('App\Http\Controllers\HookController@getViewDanhSach') }}"
                                   rel="noopener">
                                    Hooks
                                </a>

                                <a class="dropdown-item"
                                   href="{{ action('App\Http\Controllers\RedirectController@getRedirect') }}"
                                   rel="noopener">
                                    Redirects
                                </a>

                                <a class="dropdown-item"
                                   href="{{ action('App\Http\Controllers\CaiDatController@getViewCaiDat') }}"
                                   rel="noopener">
                                    Biến môi trường
                                </a>

                                <a class="dropdown-item"
                                   href="{{ action('App\Http\Controllers\CaiDatController@getViewBackup') }}"
                                   rel="noopener">
                                    Sao lưu CSDL
                                </a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                               href="{{action('App\Http\Controllers\TaiKhoanController@getViewDSTaiKhoan')}}">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="icon icon-tabler icon-tabler-user-check" width="24" height="24"
                                             viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                             stroke-linecap="round" stroke-linejoin="round"><path stroke="none"
                                                                                                  d="M0 0h24v24H0z"
                                                                                                  fill="none"/><path
                                                d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"/><path
                                                d="M6 21v-2a4 4 0 0 1 4 -4h4"/><path d="M15 19l2 2l4 -4"/></svg>                                </span>
                                <span class="nav-link-title">
                                      Quản lý tài khoản
                                    </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>

    <div class="page-wrapper">

        @yield('body')

        <footer class="footer footer-transparent d-print-none">
            <div class="container-xl">
                <div class="row text-center align-items-center flex-row-reverse">
                    <div class="col-lg-auto ms-lg-auto">
                    </div>
                    <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                        <ul class="list-inline list-inline-dots mb-0">
                            <li class="list-inline-item">
                                Khoa Công nghệ thông tin - Trường ĐH Sư phạm Kỹ thuật Vĩnh Long
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
@yield('bottom-body')
</body>
<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
</script>
@yield('script')
</html>
