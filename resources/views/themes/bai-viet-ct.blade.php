@extends('themes.master')

@section('seo')
    @component('themes.meta', [
        'title' => $data->tieu_de,
        'searchTitle' => $data->search_title,
        'description' => $data->search_description,
        'type' => 'article',
        'image' => $data->thumbnail,
        ])
    @endcomponent
@endsection

@section('content')
    <link rel="stylesheet" href="{{asset('themes/css/tin-tuc.css')}}">

    @if(isLogin())
        <div class="container-fluid" id="admin-quiz-edit" style="background: red;">
            <div class="container">
                <div class="row" style="height: 40px;">
                    <div class="col-12">
                        <p style="width: 100%; text-align: center">
                            <a style="line-height: 40px; color: white; display: block; width: 100%"
                               target="_blank"
                               href="{{ action('App\Http\Controllers\TinTucController@getViewCapNhat', $data->id_tin_tuc) }}">
                                Chỉnh sửa bài viết: {{ $data->tieu_de }}
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

    <div class="container" style="margin-top: 24px; margin-bottom: 24px;">
        <div class="row">
            <div class="col-lg-9 col-sm-12 text-justify lh-lg bg-white pb-5 pt-3 border div-tt">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">{{ __('baiviet.name__1') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="{{ action('App\Http\Controllers\FEController@danhMucCT', $dm->url) }}">
                                {{ $dm->tieu_de }}
                            </a>
                        </li>
                    </ol>
                </nav>

                <div class="news-detail-container">

                    <h2 class="fw-bold text-blue-1">{{ $data->tieu_de }}</h2>

                    <div class="noi-dung">
                        {!! $data->noi_dung !!}
                    </div>

                </div>
            </div>

            <div class="col-lg-3 col-sm-12">
                <div class="last-news">
                    <h5 class="text-bold">{{ __('baiviet.name__2') }}</h5>
                    @foreach($topNews as $news)
                        <div class="d-flex" style="margin-bottom: 16px;">
                            <img data-src="{{$news->thumbnail}}" alt="" class="blog-img lazyload">
                            <a href="{{$news->url}}" class="blog-text fw-semibold block-ellipsis-3">
                                {{$news->tieu_de}}
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>

@endsection
