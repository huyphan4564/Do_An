<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>vlute.edu.vn</title>
    <link rel="shortcut icon" href="{{asset('themes/images/vlute_icon96.ico')}}" type="image/x-icon">
    {{--   CSS   --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{asset('themes/css/app.css')}}">
    <link rel="stylesheet" href="{{asset('themes/css/base.css')}}">
    <link rel="stylesheet" href="{{asset('themes/css/header.css')}}">
    <link rel="stylesheet" href="{{asset('themes/css/cooperateSlider.css')}}">
    <link rel="stylesheet" href="{{asset('themes/css/newsDetail.css')}}">
    <link rel="stylesheet" href="{{asset('themes/css/relatedNewsCard.css')}}">
    <link rel="stylesheet" href="{{asset('themes/css/page.css')}}">
    <link rel="stylesheet" href="{{asset('themes/css/footer.css')}}">

    {{--   JS   --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.6.2/modernizr.min.js"></script>
</head>

<body>

{{--HEADER--}}
<div class="">
    @include('themes.layouts.header')
    <div class="container-fluid px-0">
        <img data-src="{{$resultPage[0]->thumbnail}}" alt="" class="lazyload w-100 h-top-img object-fit-cover">
    </div>
    <div class="container page-container  my-5 lh-lg text-justify">
        {!!html_entity_decode($resultPage[0]->noi_dung)!!}
    </div>
</div>

{{--FOOTER--}}
@include('themes.layouts.footer')

{{--BUTTON BACK TO TOP--}}
<button type="button" class="btn btn-danger btn-floating" id="btn-back-to-top">
    <i class="fas fa-arrow-up"></i>
</button>

</body>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="{{asset('themes/js/backToTop.js')}}"></script>
<script src="{{asset('themes/js/cooperateSlider.js')}}"></script>
<script src="{{asset('themes/js/multiSlider.js')}}"></script>
<script src="{{asset('themes/js/jquery.slicknav.min.js')}}"></script>
<script src="{{asset('themes/js/dropdownMenu.js')}}"></script>
<script src="{{asset('themes/js/newsDetail.js')}}"></script>
<script src="{{asset('themes/js/lazysizes.min.js')}}"></script>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v19.0&appId=1790801774573948" nonce="hnS8zGOl"></script>
</html>
