<div class="col-xl-3 col-md-6 col-sm-12 card-hover">
    <div class="card shadow border-0">
        <img class="lazyload w-100 border rounded img-card" data-src="{{ $new->thumbnail }}" alt="" />
        <div class="card-body">
            <a href="{{ action('App\Http\Controllers\FEController@getViewBaiViet', $new->url) }}"
               class="card-title fs-6 fw-bold text-danger text-truncate stretched-link">
                {{ $new->tieu_de }}
            </a>
            <p class="card-text block-ellipsis-3 h-content-3">{{ shortContent($new->noi_dung) }}</p>
        </div>
    </div>
</div>
