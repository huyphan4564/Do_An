<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('seo')
    <link rel="stylesheet" href="{{asset('themes/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('themes/css/swiper-bundle.min.css')}}">
    <link rel="stylesheet" href="{{asset('themes/css/app.css')}}?token={{ sha1(uniqid(time(), true)) }}">
    <link rel="stylesheet" href="{{asset('themes/css/base.css')}}?token={{ sha1(uniqid(time(), true)) }}">
    <link rel="stylesheet" href="{{asset('themes/css/header.css')}}?token={{ sha1(uniqid(time(), true)) }}">
    <link rel="stylesheet" href="{{asset('themes/css/carousel.css')}}?token={{ sha1(uniqid(time(), true)) }}">
    <link rel="stylesheet" href="{{asset('themes/css/footer.css')}}?token={{ sha1(uniqid(time(), true)) }}">
    <?php $fe = new \App\Models\FEModel(); ?>
    {!! ($tmp = $fe->getCaiDat('CUSTOM_CSS')) ? $tmp->gia_tri : "" !!}
    <script src="{{asset('themes/js/jquery.min.js')}}"></script>
    <script src="{{asset('themes/js/lazysizes.min.js')}}" async=""></script>
    <script src="{{asset('themes/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('themes/js/modernizr.min.js')}}"></script>
    <script src="{{asset('themes/js/swiper-bundle.min.js')}}"></script>
    {!! ($tmp = $fe->getCaiDat('CUSTOM_JS')) ? $tmp->gia_tri : "" !!}
</head>

<body>
    <div class="margin-mobile">
        @include('themes.components.header')

        @yield('content')

        @include('themes.components.footer')
    </div>
</body>
</html>


<script>
    function replaceBrokenImages(defaultImageUrl) {
        var images = document.getElementsByTagName('img');
        for (var i = 0; i < images.length; i++) {
            images[i].addEventListener('error', function() {
                this.src = defaultImageUrl;
            });
        }
    }
    replaceBrokenImages('{{ asset('themes/images/no-thumbnail.png') }}');
</script>
