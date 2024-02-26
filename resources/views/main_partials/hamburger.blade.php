<div class="humberger__menu__overlay"></div>
<div class="humberger__menu__wrapper">
    <div class="humberger__menu__logo">
        <a href="#"><img src="" alt=""></a>
    </div>
    @if(Auth::check())
    <div class="humberger__menu__cart">
        <ul>
            <li><a href="#"><i class="fa fa-heart"></i> <span>0</span></a></li>
            <li><a href="{{ route('main.cart') }}"><i class="fa fa-shopping-bag"></i> <span class="item-count"></span></a></li>
        </ul>
        <div class="header__cart__price">item: <span>&#8369; <span class="item-total"></span></span></div>
    </div>



    <script>
        function get_stash_count() {
            $.ajax({
                type: "GET",
                url: "{{ route('stash.get_count') }}",
                data: {},
                success: function(response) {
                    if (response.status == 200) {
                        $('.item-total').text(parseFloat(response.item_total).toFixed(2))
                        $('.item-count').text(response.item_count)
                    }
                },
                error: function(xhr, status, error) {
                    showToast(xhr.responseJSON, 2)

                }
            });
        }

        get_stash_count()

        function addToStash(product_id) {

            var url = "{{ route('add_to_stash',':product_id') }}"

            $.ajax({
                type: "POST",
                url: url.replace(':product_id', product_id),
                data: {
                    _token: "{{ csrf_token() }}",
                    product_id: product_id
                },
                success: function(response) {
                    if (response.status == 200) {
                        showToast(response.message, 1)
                    }

                    if (response.status == 305) {
                        showToast(response.message, 3)

                    }
                },
                error: function(xhr, status, error) {
                    showToast(xhr.responseJSON, 2)

                }
            });
        }

        function removeFromStash(id) {

            var url = "{{ route('remove_from_stash',':id') }}"

            $.ajax({
                type: "POST",
                url: url.replace(':id', id),
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.status == 200) {
                        $('#row_' + id).remove();
                        showToast(response.message, 1);
                    }

                },
                error: function(xhr, status, error) {
                    showToast(xhr.responseJSON, 2)

                }
            });
        }
    </script>
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
            <li>Cart</a>
                <ul class="header__menu__dropdown">
                    <li><a href="{{ route('main.cart') }}">Shoping Cart</a></li>
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