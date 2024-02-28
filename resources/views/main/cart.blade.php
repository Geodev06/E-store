<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">

    @php
    $logo = DB::table('system_settings')->where('setting_name', 'SYSTEM_LOGO')->first();
    $sys_name = DB::table('system_settings')->where('setting_name', 'SYSTEM_NAME')->first();

    @endphp

    @if($logo)
    <link rel="icon" type="image/png" href="{{ asset($logo->value) }}">

    @else
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">

    @endif
    <title>
        {{ $sys_name->value ?? '' }}
    </title>

    <!-- Google Font -->
    @include('main_partials.core_css')
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Humberger Begin -->
    @include('main_partials.hamburger')
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    @include('main_partials.header')

    <!-- Header Section End -->

    <!-- Hero Section Begin -->
    @include('main_partials.hero')


    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table id="table-cart">
                            <thead>
                                <tr>
                                    <th class="shoping__product">Products</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($items_in_stash as $item)

                                <tr id="row_{{$item->id}}">
                                    <td class="shoping__cart__item">
                                        <img src="{{ $item->photo }}" alt="" style="max-height: 100px;">
                                        <h5>{{ $item->name }}</h5>
                                    </td>
                                    <td class="shoping__cart__price">
                                        &#8369; {{ number_format($item->price, 2) }}
                                    </td>
                                    <td class="shoping__cart__quantity">
                                        <div class="quantity">
                                            <span class="fw-bold">1</span>
                                        </div>
                                    </td>
                                    <td class="shoping__cart__total">
                                        &#8369; {{ number_format($item->price, 2) }}

                                    </td>
                                    <td class="shoping__cart__item__close">
                                        <span class="icon_close" data-id="{{$item->id}}"></span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="shoping__cart__item" colspan="5">
                                        No Item in Cart
                                    </td>
                                </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="{{ route('main.shop') }}" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                        <!-- <a href="#" class="primary-btn cart-btn cart-btn-right"><span class="icon_loading"></span>
                            Upadate Cart</a> -->
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__continue">
                        <div class="shoping__discount">
                            <h5>Discount Codes</h5>
                            <form action="#">
                                <input type="text" placeholder="Enter your coupon code">
                                <button type="submit" class="site-btn">APPLY COUPON</button>
                            </form>
                        </div>
                    </div>
                </div>
                @if(count($items_in_stash) > 0)
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Cart Total</h5>
                        <ul>
                            <li>Total <span>&#8369; <span class="item-total"></span> </span></li>
                        </ul>
                        <form action="{{ route('paypal.pay') }}" method="post" id="form-pay">
                            @csrf

                            @forelse($items_in_stash as $p)
                            <input type="hidden" name="products[]" value="{{$p->product_id}}">
                            <input type="hidden" name="order_id[]" value="{{$p->id}}">
                            @empty
                            <input type="hidden" name="amount" value="0.00">

                            @endforelse



                            <a href="#" class="primary-btn" id="btn-checkout">PROCEED TO CHECKOUT</a>
                        </form>
                    </div>
                </div>
                @endif
            </div>
        </div>

        @if(Session::has('success_payment'))
        <script>
            showToast("{{ Session::get('success_payment') }}", 1)
        </script>
        @endif
    </section>
    <!-- Shoping Cart Section End -->
    <script>
        $('#table-cart tbody').on('click', 'tr .icon_close', function(e) {
            var id = $(this)[0].dataset.id
            removeFromStash(id)
            get_stash_count()

        })
        $('#btn-checkout').on('click', function(e) {
            e.preventDefault()
            if ($('#amount').val() <= 0) {
                showToast('Your cart is empty. cannot proceed', 2)
                return
            }
            $('#form-pay').submit()
        })
    </script>

    @include('main_partials.footer')

    @include('main_partials.core_js')


</body>

</html>