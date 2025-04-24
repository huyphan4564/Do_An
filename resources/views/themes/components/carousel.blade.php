<?php
    $fe = new \App\Models\FEModel();
    $tmp = $fe->getSlider($tieude);
    $id = "vlu" . substr(md5(mt_rand()), 0, 2);
?>

<div id="{{ $id }}" class="carousel slide lazyload" data-bs-ride="carousel" data-bs-touch="true">
    <div class="carousel-inner">
        @foreach($tmp as $key => $img)
            <div class="carousel-item height-carousel-item {{$key == 0 ? 'active' : ''}}">
                <img data-src="{{ $img->thumbnail }}" class="d-block lazyload" alt="{{ $img->tieu_de }}">
            </div>
        @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#{{ $id }}" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#{{ $id }}" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
