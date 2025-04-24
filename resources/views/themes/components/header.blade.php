<!-- PC & Laptop -->
<div class="menu-rise d-none d-lg-block">
    <nav class="navbar navbar-expand-lg navbar-light bg-header">
        <div class="container">
            <a href="/" class="navbar-brand d-flex align-items-center">
                <img style="height: 36px" class="lazyload" data-src="{{asset('themes/images/logo.png')}}" alt="">
                <span class="ten-truong ms-2 text-nowrap fs-6 text-white fw-semibold">
                    <b>{{ __('header.name__1') }}</b>
                </span>
            </a>

            <div class="collapse navbar-collapse flex-sm-row flex-column">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item" style="line-height: 27px;">
                        <a class="nav-link text-white fw-semibold fs-7 text-bold text-uppercase" href="{{ __('header.name__2') }}">
                            {{ __('header.name__3') }}
                        </a>
                    </li>
                    <li class="nav-item" style="line-height: 27px;">
                        <a class="nav-link text-white fw-semibold fs-7 text-bold text-uppercase" href="{{ __('header.name__4') }}">
                            {{ __('header.name__5') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white fw-semibold fs-7 text-bold text-danger"
                            href=" {{ __('header.name__7') }}">
                            <img style="border: 2px solid #FFFFFF; border-radius: 2px;" src="{{asset('themes/images/' .__('header.name__8'))}}" >
                        </a>

                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>

<div class="container-fluid bg-white menu-mobile shadow">
    <div class="bg-menu"></div>
    <div class="container">
        <nav id="menu">
            <label for="tm" id="toggle-menu" style="text-align: center">
                <img src="{{asset('themes/images/VLUTE.png')}}" alt="">
                <img class="icon-menu" src="{{asset('themes/images/menu.png')}}" alt="">
            </label>
            <input type="checkbox" id="tm">
            <ul class="main-menu clearfix">
                <?php
                $tmp = new \App\Models\FEModel();
                $tmp = $tmp->getMenu();
                if($tmp)
                    $menu = json_decode($tmp->gia_tri);
                else
                    $menu = [];
                ?>
                @foreach ($menu as $item)
                    <li>
                        @if (isset($item->children))
                            <a href="{{ $item->url }}">{{ mb_strtoupper($item->name) }}
                                <span class="drop-icon">▾</span>
                                <label title="Toggle Drop-down" class="drop-icon" for="sm{{ $loop->index }}">▾</label>
                            </a>
                            <input type="checkbox" id="sm{{ $loop->index }}">
                            <ul class="sub-menu">
                                @foreach ($item->children as $child)
                                    <li>
                                        @if (isset($child->children))
                                            <a href="{{ $child->url }}">{{ mb_strtoupper($child->name) }}
                                            <span class="drop-icon">▾</span>
                                            <label title="Toggle Drop-down" class="drop-icon" for="sub-sm{{ $loop->parent->index }}-{{ $loop->index }}">▾</label>
                                            </a>
                                            <input type="checkbox" id="sub-sm{{ $loop->parent->index }}-{{ $loop->index }}">
                                            <ul class="sub-menu">
                                                @foreach ($child->children as $grandChild)
                                                    <li><a href="{{ $grandChild->url }}">{{ mb_strtoupper($grandChild->name) }}</a></li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <a href="{{ $child->url }}">{{ mb_strtoupper($child->name) }}</a>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <a href="{{ $item->url }}">{{ mb_strtoupper($item->name) }}</a>
                        @endif
                    </li>
                @endforeach
            </ul>
        </nav>
    </div>
</div>
