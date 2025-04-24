@extends('themes.master')

@section('seo')
    @component('themes.meta', [
        'title' => $page->tieu_de ?? '',
        'searchTitle' => $page->search_title  ?? '',
        'description' => $page->search_description ?? '',
        'type' => 'article',
        'image' => $page->thumbnail ?? '',
        ])
    @endcomponent
@endsection

@section('content')
    <link rel="stylesheet" href="{{asset('themes/css/page.css')}}">

    @if(isLogin())
        <div class="container-fluid" id="admin-quiz-edit" style="background: red;">
            <div class="container">
                <div class="row" style="height: 40px;">
                    <div class="col-12">
                        <p style="width: 100%; text-align: center">
                            <a style="line-height: 40px; color: white; display: block; width: 100%"
                               target="_blank"
                               href="{{ action('App\Http\Controllers\PageController@getViewCapNhat', $page->id_pages) }}">
                                Chỉnh sửa trang: {{ $page->tieu_de }}
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <script>
            var divToMove = document.getElementById('admin-quiz-edit');
            var body = document.body;
            body.insertBefore(divToMove, body.firstChild);
        </script>
    @endif

    <div class="bg-white">
        <img style="width: 100%; object-fit: cover; height: 300px;" src="{{ $page->thumbnail ?? '' }}">
    </div>

    <div class="container-fluid bg-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-12 bg-white">
                    <div class="fw-bold fs-4 text-danger my-4">
                        <h1 class="title-page">{{mb_strtoupper($page->tieu_de  ?? '')}}</h1>
                        <hr>
                    </div>
                </div>
            </div>
            <div class="row" >
                <div class="col-lg-12 col-12 bg-white">
                    <div class="noi-dung">
                        {!! $page->noi_dung ?? '' !!}
                        <div style="margin-bottom: 100px;"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
