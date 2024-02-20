<section class="hero" style="margin-bottom: -100px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="hero__categories">
                    <div class="hero__categories__all">
                        <i class="fa fa-bars"></i>
                        <span>All departments</span>
                    </div>
                    <ul @if(request()->route()->getName() != 'main.index' ) style="display: none;" @endif>
                        @forelse($categories as $category)
                        <li><a href="#">{{ $category->category }}</a></li>
                        @empty
                        <li>No categories found</li>
                        @endforelse
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="hero__search">
                    <div class="hero__search__form">
                        <form action="#">
                            <div class="hero__search__categories">
                                All Categories
                                <span class="arrow_carrot-down"></span>
                            </div>
                            <input type="text" placeholder="What do yo u need?">
                            <button type="submit" class="site-btn">SEARCH</button>
                        </form>
                    </div>
                    <div class="hero__search__phone">
                        <div class="hero__search__phone__icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="hero__search__phone__text">
                            <h5>{{ $settings['sys_contact'] }}</h5>
                            <span>support 24/7 time</span>
                        </div>
                    </div>
                </div>

                @if(request()->route()->getName() == 'main.index' )
                <div class="hero__item set-bg" data-setbg="{{$settings['sys_banner']}}">
                    <div class="hero__text">
                        <span>LOREM IPSUM</span>
                        <h2>Lorem <br />Ipsum dolor set amet</h2>
                        <p>Lorem ipsum</p>
                        <a href="#" class="primary-btn">SHOP NOW</a>
                    </div>
                </div>

                @endif
            </div>
        </div>
    </div>
</section>