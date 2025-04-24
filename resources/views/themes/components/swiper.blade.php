<?php
    $fe = new \App\Models\FEModel();
    $tmp = $fe->getSlider($tieude);
    $id = "vlu" . substr(md5(mt_rand()), 0, 2);
?>

<div class="container-fluid bg-white">
    <div class="swiper swiper">
        <div class="swiper-wrapper p-4">
            @foreach($tmp as $key => $img)
                <div class="swiper-slide">
                    <img class="lazyload" data-src="{{ $img->thumbnail }}" alt="">
                </div>
            @endforeach
        </div>
    </div>
</div>

<script>
    var swiper = new Swiper(".swiper", {
        slidesPerView: 1,
        spaceBetween: 10,
        loop: true,
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        breakpoints: {
            320: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            640: {
                slidesPerView: 3,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 4,
                spaceBetween: 40,
            },
            1024: {
                slidesPerView: 6,
                spaceBetween: 50,
            },
        },
    });
</script>
