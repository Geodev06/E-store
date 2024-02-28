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


    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">

                <div class="col-lg-12 col-md-7">
                    <div class="product__discount">
                        <div class="section-title product__discount__title">
                            <h2>Latest</h2>
                        </div>
                        <div class="row discounted_product_section">
                            <div class="product__discount__slider owl-carousel">
                                @forelse($products as $p)
                                <div class="col-lg-4">
                                    <div class="product__discount__item">
                                        <div class="product__discount__item__pic set-bg" data-setbg="{{ $p->photo}}">
                                            <div class="product__discount__percent">-20%</div>
                                            <ul class="product__item__pic__hover">
                                                <li><a href="{{ route('main.details', encrypt($p->id)) }}"><i class="fa fa-book"></i></a></li>

                                                @if(Auth::check())
                                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>

                                                @if(!in_array($p->id,$customer_book_ids))
                                                <li><a href="#"><i class="fa fa-shopping-cart add_to_cart" data-id="{{ $p->id }}"></i></a></li>
                                                @endif

                                                @endif
                                            </ul>
                                        </div>
                                        <div class="product__discount__item__text">
                                            <span></span>
                                            <h6><a href="#">{{ $p->name}}</a></h6>
                                            <h5>&#8369; {{ number_format($p->price, 2) }}</h5>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <p>No Data</p>
                                @endforelse

                            </div>
                        </div>
                    </div>
                    <div class="filter__item">
                        <div class="row">
                            <div class="col-lg-4 col-md-5">
                                <div class="filter__sort">
                                    <span>Sort By</span>
                                    <select>
                                        <option value="0">Default</option>
                                        <option value="0">Default</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="filter__found">
                                    <h6><span>{{ count($products)}}</span> Products found</h6>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-3">
                                <div class="filter__option">
                                    <span class="icon_grid-2x2"></span>
                                    <span class="icon_ul"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row product-section">
                        @forelse($products as $p)
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="{{ $p->photo }}">
                                    <ul class="product__item__pic__hover">
                                        <li><a href="{{ route('main.details', encrypt($p->id)) }}"><i class="fa fa-book"></i></a></li>

                                        @if(Auth::check())
                                        <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                        <li><a href="#"><i class="fa fa-retweet"></i></a></li>

                                        @if(!in_array($p->id,$customer_book_ids))
                                        <li><a href="#"><i class="fa fa-shopping-cart add_to_cart" data-id="{{ $p->id }}"></i></a></li>
                                        @endif
                                        @endif
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="#">{{ $p->name}}</a></h6>
                                    <h5>&#8369; {{ number_format($p->price, 2) }}</h5>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="mx-3 text-center">No products available</div>
                        @endforelse


                    </div>
                    @if($products )
                    <div class="product__pagination">
                        <a href="#">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#"><i class="fa fa-long-arrow-right"></i></a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->

    <script>
        $('.product-section .product__item').on('click', '.add_to_cart', function(e) {
            e.preventDefault()
            var product_id = $(this)[0].dataset.id
            addToStash(product_id)
            get_stash_count()

        })

        $('.discounted_product_section .product__discount__item').on('click', '.add_to_cart', function(e) {
            e.preventDefault()
            var product_id = $(this)[0].dataset.id
            addToStash(product_id)
            get_stash_count()

        })
    </script>



    @include('main_partials.footer')

    @include('main_partials.core_js')


</body>

</html>