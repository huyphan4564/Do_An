@extends('themes.master')

@section('seo')
    <?php $fe = new \App\Models\FEModel(); ?>
    @component('themes.meta', [
        'title' => ($tmp = $fe->getCaiDat('HOMEPAGE_TITLE')) ? $tmp->gia_tri : "",
        'searchTitle' => ($tmp = $fe->getCaiDat('HOMEPAGE_SEARCH_TITLE')) ? $tmp->gia_tri : "",
        'description' => ($tmp = $fe->getCaiDat('HOMEPAGE_SEARCH_DESCRIPT')) ? $tmp->gia_tri : "",
        'type' => 'article',
        'image' => ($tmp = $fe->getCaiDat('HOMEPAGE_THUMBNAIL')) ? $tmp->gia_tri : "",
        ])
    @endcomponent
@endsection

@section('content')

    @component('themes.components.carousel', ['tieude' => 'Slider - Trang chủ'])@endcomponent

    <div class="container-fluid bg-white">
        <div class="container">
            <div class="py-4">
                <div class="title">
                    {{ __('trangchu.session__11') }}
                </div>
                <div class="subtitle">
                    {{ __('trangchu.session__12') }}
                </div>
                <p class="text-center">
                    <br>
                    <a class="btn-ts" target="_blank" href="http://ttts.vlute.edu.vn/">
                        {{ __('trangchu.session__13') }}
                    </a>
                    <br>
                </p>
            </div>
        </div>
    </div>

    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center my-2">
            <a href="#" class="fw-bold fs-4 text-danger my-2">
                <i class="fa-solid fa-newspaper"></i>
                {{ __('trangchu.session__21') }}
            </a>
        </div>
        <div class="row g-4">
            <?php
                $fe = new \App\Models\FEModel();
                $tinMoi = $fe->tinMoi(8);
            ?>
            @foreach($tinMoi as $item)
                @component('themes.components.card-tin-tuc', ['new' => $item])@endcomponent
            @endforeach
        </div>
    </div>

    <div class="container-fluid bg-white">
        <div class="container">
            <div class="row py-4">
                <div class="title">
                    {{ __('trangchu.session__31') }}
                </div>
                <div class="subtitle">
                    {{ __('trangchu.session__32') }}
                </div>
                <p class="text-center">
                    {{ __('trangchu.session__33') }}
                </p>
            </div>

            <?php
            $fe = new \App\Models\FEModel();
            $tinMoi = $fe->pageTheoHook($fe->getHook("Trang chủ - Ngành đào tạo"), 4);
            $dsNganh = $fe->pageTheoHook($fe->getHook("Trang chủ - Danh sách ngành đào tạo"), 100);
            ?>

            <div class="row py-12" style="display: flex; justify-content: center;">
                <ul class="ds-nghanh-dt">
                    @foreach($dsNganh as $item)
                        <li><a href="{{ $item->url }}">{{ $item->tieu_de }}</a></li>
                    @endforeach
                </ul>
            </div>

            <div class="row py-4">
                @foreach($tinMoi as $item)
                    @component('themes.components.card-tin-tuc', ['new' => $item])@endcomponent
                @endforeach
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="container">
                <div class="py-4">
                    <div class="title">
                        {{ __('trangchu.session__41') }}
                    </div>
                    <div class="subtitle">
                        {{ __('trangchu.session__42') }}
                    </div>
                    <p class="text-center">
                        {{ __('trangchu.session__43') }}
                    </p>
                </div>
        </div>
    </div>

    @component('themes.components.carousel', ['tieude' => 'Slider - Tuyển sinh'])@endcomponent

    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center my-2">
            <a href="#" class="fw-bold fs-4 text-danger my-2">
                <i class="fa-solid fa-newspaper"></i>
                {{ __('trangchu.session__51') }}
            </a>
        </div>
        <div class="row g-4">
            <?php
                $fe = new \App\Models\FEModel();
                $cd = new \App\Models\CaiDatModel();
                $id_dm = ($tmp = $fe->getCaiDat("Trang chủ - Hợp tác + Nghiên cứu khoa học")) ? $tmp->gia_tri : 0;
                $tmp = $fe->tinTheoTenDM($id_dm, 8);
            ?>
            @foreach($tmp as $item)
                @component('themes.components.card-tin-tuc', ['new' => $item])@endcomponent
            @endforeach
        </div>
    </div>

    <div class="container-fluid bg-white">
        <div class="py-4">
            <div class="title">
                {{ __('trangchu.session__61') }}
            </div>
            <div class="subtitle">
                {{ __('trangchu.session__62') }}
            </div>
        </div>

        @include('themes.components.swiper', ['tieude' => 'Slider - Hợp tác'])
    </div>
@endsection
