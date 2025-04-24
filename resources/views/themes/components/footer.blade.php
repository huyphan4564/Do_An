<style>
    .footer-1 {
        background: #1b4d85;
        color: white;
    }
    .footer a {
        color: white;
    }
</style>

<footer class="footer py-4">
    <div class="container">
        <div class="row">

            <div class="col-lg-4" style="color: white;">
                <h5 class="text-white fw-semibold mb-2">{{ __('footer.name__2') }}</h5>
                <ul class="list-unstyled">
                    <li class="my-2 fs-6 text-white">
                        {{ __('footer.name__3') }}
                    </li>
                    <li class="my-2 fs-6 text-white">
                        Email: <a href="mailto:{{ __('footer.name__4') }}">{{ __('footer.name__4') }}</a>
                    </li>
                    <li class="my-2 fs-6 text-white">
                        Phone: <a href="tel:{{ __('footer.name__5') }}">{{ __('footer.name__5') }}</a>
                    </li>
                    <li class="my-2 fs-6 text-white">
                        Fax: <a href="fax:{{ __('footer.name__6') }}">{{ __('footer.name__6') }}</a>
                    </li>
                </ul>

            </div>

            <div class="col-lg-8">
                <div class="row">
                    <div class="col-lg-4">
                        <h5 class="text-white fw-semibold mb-2">{{ __('footer.col__1') }}</h5>
                        <ul class="list-unstyled">
                            <li class="my-2 fs-6 text-white">
                                <a href="http://my.vlute.edu.vn">{{ __('footer.col__11') }}</a>
                            </li>
                            <li class="my-2 fs-6 text-white">
                                <a href="http://ttts.vlute.edu.vn">{{ __('footer.col__12') }}</a>
                            </li>
                            <li class="my-2 fs-6 text-white">
                                <a href="http://dsa.vlute.edu.vn/">{{ __('footer.col__13') }}</a>
                            </li>
                            <li class="my-2 fs-6 text-white">
                                <a href="https://ems.vlute.edu.vn">{{ __('footer.col__14') }}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-4">
                        <h5 class="text-white fw-semibold mb-2">{{ __('footer.col__2') }}</h5>
                        <ul class="list-unstyled">
                            <li class="my-2 fs-6 text-white">
                                <a href="https://qldt.vlute.edu.vn/VLUTE-Web/home.action">{{ __('footer.col__21') }}</a>
                            </li>
                            <li class="my-2 fs-6 text-white">
                                <a href="https://ems.vlute.edu.vn">{{ __('footer.col__22') }}</a>
                            </li>
                            <li class="my-2 fs-6 text-white">
                                <a href="http://elearning.vlute.edu.vn">{{ __('footer.col__23') }}</a>
                            </li>
                            <li class="my-2 fs-6 text-white">
                                <a href="https://thanhtoan.vlute.edu.vn">{{ __('footer.col__24') }}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-4">
                        <h5 class="text-white fw-semibold mb-2">{{ __('footer.col__3') }}</h5>
                        <a href="https://www.facebook.com/vlute.edu.vn/">
                            <img src="{{asset('themes/images/' .__('footer.col__31'))}}" >
                        </a> &nbsp;&nbsp;
                        <a href="https://www.youtube.com/@tivivlute5460">
                            <img src="{{asset('themes/images/' .__('footer.col__32'))}}" >
                        </a>&nbsp;&nbsp;
                        <a href="#">
                            <img src="{{asset('themes/images/' .__('footer.col__33'))}}" >
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</footer>

<footer class="footer py-2 text-center footer-1" style="">
    <div class="container" >
        <div class="row">
            <div class="col-lg-12">
                {{ __('footer.name__7') }}
            </div>
        </div>
    </div>
</footer>
