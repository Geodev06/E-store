<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__left">
                        <ul>
                            <li><i class="fa fa-envelope"></i> {{ $settings['sys_email'] }}</li>
                            <li>Feel free to email us</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__right">
                        <div class="header__top__right__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-linkedin"></i></a>
                            <a href="#"><i class="fa fa-pinterest-p"></i></a>
                        </div>

                        @if(!Auth::check())
                        <div class="header__top__right__auth">
                            <a href="{{ route('main.login') }}"><i class="fa fa-user"></i> Login</a>
                        </div>

                        @else


                        <div class="header__top__right__language">
                            <i class="fa fa-user"></i>
                            <div>{{ Auth::user()->name ?? '' }}</div>
                            <span class="arrow_carrot-down"></span>
                            <ul>
                                <li><a href="#">Settings</a></li>
                                <li><a href="#sign-out" id="btn-logout">Log out</a></li>
                            </ul>
                        </div>

                        <script>
                            $('#btn-logout').click(function(e) {

                                e.preventDefault()

                                const url = "{{ route('user.logout') }}"

                                var formData = {
                                    _token: "{{ csrf_token() }}"
                                }

                                $.ajax({
                                    type: "POST",
                                    url: url,
                                    data: formData,
                                    success: function(response) {
                                        if (response.status == 200) {
                                            window.location.assign(response.link)
                                        }
                                    },
                                    error: function(xhr, status, error) {
                                        showToast(xhr.responseJSON, 2)

                                    }
                                });
                            })
                        </script>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="header__logo">
                    <a href="{{ route('main.index') }}"><img src="{{ asset($settings['sys_logo']) }}" alt=""></a>
                </div>
            </div>
            <div class="col-lg-6">
                <nav class="header__menu">
                    <ul>
                        <li class="{{ request()->route()->getName() == 'main.index' ? 'active' : '' }}"><a href="{{ route('main.index') }}">Home</a></li>
                        <li class="{{ request()->route()->getName() == 'main.shop' ? 'active' : '' }}"><a href="{{ route('main.shop') }}">Shop</a></li>
                        @if(Auth::check())
                        <li><a href="#">Cart</a>
                            <ul class="header__menu__dropdown">
                                <li><a href="{{ route('main.cart') }}">Shoping Cart</a></li>

                                <li><a href="#">Check Out</a></li>
                            </ul>
                        </li>

                        @endif
                        <li class="{{ request()->route()->getName() == 'main.contact' ? 'active' : '' }}"><a href="{{ route('main.contact') }}">Contact</a></li>
                    </ul>
                </nav>
            </div>
            @if(Auth::check())
            <div class="col-lg-3">
                <div class="header__cart">
                    <ul>
                        <li><a href="#"><i class="fa fa-heart"></i> <span>0</span></a></li>
                        <li><a href="{{ route('main.cart') }}"><i class="fa fa-shopping-bag"></i> <span class="item-count">0</span></a></li>
                    </ul>
                    <div class="header__cart__price">item: <span>&#8369; <span class="item-total"></span></span></div>
                </div>
            </div>

            @endif
        </div>
        <div class="humberger__open">
            <i class="fa fa-bars"></i>
        </div>
    </div>
</header>