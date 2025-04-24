@extends('themes.master')

@section('seo')
    @component('themes.meta', [
        'title' => $dm->tieu_de,
        'searchTitle' => $dm->search_title,
        'description' => $dm->search_description,
        'type' => 'article',
        'image' => $dm->thumbnail,
        ])
    @endcomponent
@endsection

@section('content')

    <div class="container" style="margin-top: 24px;">
        <div class="row bg-white" style="border-radius: 12px;">
            <div class="col-12">
                <div class="align-items-center my-4">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">{{ __('danhmuc.name__1') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                <a href="{{url('/danh-muc')}}">{{ __('danhmuc.name__2') }}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                {{ $dm->tieu_de }}
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="col-12">
                <div class="fw-bold fs-4 text-danger my-2">
                    <i class="fa-solid fa-newspaper"></i>
                    {{mb_strtoupper($dm->tieu_de)}}
                </div>
            </div>

            <div class="row g-4">
                @foreach($tintuc as $item)
                    @component('themes.components.card-tin-tuc', ['new' => $item])@endcomponent
                @endforeach
            </div>

            <div class="col-12">
                <br><br>
            </div>

        </div>

    </div>
@endsection
