<div class="humberger__menu__overlay"></div>
<div class="humberger__menu__wrapper">
    <div class="humberger__menu__logo">
        <a href="#"><img src="" alt=""></a>
    </div>
    @if(Auth::check())
    <div class="humberger__menu__cart">
        <ul>
            <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
            <li><a href="#"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
        </ul>
        <div class="header__cart__price">item: <span>&#8369; 00.00</span></div>
    </div>
    @endif
    <div class="humberger__menu__widget">
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
                <li><a href="#sign-out" id="btn-logout-h">Log out</a></li>
            </ul>
        </div>

        <script>
            $('#btn-logout-h').click(function(e) {

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
    <nav class="humberger__menu__nav mobile-menu">
        <ul>
            <li class="active"><a href="{{ route('main.index') }}">Home</a></li>
            <li class="{{ request()->route()->getName() == 'main.shop' ? 'active' : '' }}"><a href="{{ route('main.shop') }}">Shop</a></li>
            @if(Auth::check())
            <li >Cart</a>
                <ul class="header__menu__dropdown">
                    <li><a href="#">Shop Details</a></li>
                    <li><a href="#">Shoping Cart</a></li>
                    <li><a href="#">Check Out</a></li>
                </ul>
            </li>
            @endif

            <li><a href="#">Contact</a></li>
        </ul>
    </nav>
    <div id="mobile-menu-wrap"></div>
    <div class="header__top__right__social">
        <a href="#"><i class="fa fa-facebook"></i></a>
        <a href="#"><i class="fa fa-twitter"></i></a>
        <a href="#"><i class="fa fa-linkedin"></i></a>
        <a href="#"><i class="fa fa-pinterest-p"></i></a>
    </div>
    <div class="humberger__menu__contact">
        <ul>
            <li><i class="fa fa-envelope"></i> {{ $settings['sys_email']}}</li>
            <li>Send us an email</li>
        </ul>
    </div>
</div>