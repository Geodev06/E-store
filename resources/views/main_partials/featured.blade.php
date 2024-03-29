 <!-- Featured Section Begin -->
 <section class="featured spad">
     <div class="container">
         <div class="row">
             <div class="col-lg-12">
                 <div class="section-title">
                     <h2>Featured Product</h2>
                 </div>
                 <div class="featured__controls">
                     <ul>
                         <li class="active" data-filter="*">All</li>
                         <!-- <li data-filter=".fresh-meat">Fresh Meat</li>
                            <li data-filter=".vegetables">Vegetables</li>
                            <li data-filter=".fastfood">Fastfood</li>  -->

                         @forelse($categories as $category)
                         <li data-filter=".{{$category->category}}">{{ $category->category}}</li>
                         @empty
                         <li>No categories found</li>
                         @endforelse
                     </ul>
                 </div>
             </div>
         </div>
         <div class="row featured__filter">
             @forelse($products as $product)
             <div class="col-lg-3 col-md-4 col-sm-6 mix {{ $product->categories }}">
                 <div class="featured__item">
                     <div class="featured__item__pic set-bg" data-setbg="{{ asset($product->photo) }}">
                         <ul class="featured__item__pic__hover">
                             <li><a href="{{ route('main.details', encrypt($product->id)) }}"><i class="fa fa-book"></i></a></li>

                             @if(Auth::check())
                             <li><a href="#"><i class="fa fa-heart"></i></a></li>
                             <li><a href="#"><i class="fa fa-retweet"></i></a></li>

                             @if(!in_array($product->id,$customer_book_ids))
                             <li><a href="#"><i class="fa fa-shopping-cart add_to_cart" data-id="{{ $product->id }}"></i></a></li>
                             @endif

                             @endif
                         </ul>
                     </div>
                     <div class="featured__item__text">
                         <h6><a href="#">{{ $product->name}}</a></h6>
                         <h5>&#8369; {{ number_format($product->price, 2) }}</h5>
                     </div>
                 </div>
             </div>
             @empty
             <div class="col-lg-12">
                 <div class="text-center">
                     <p class="mx-3">No product available.</p>
                 </div>
             </div>
             @endforelse

         </div>
     </div>
 </section>
 <!-- Featured Section End -->

 <script>
     $('.featured__filter .featured__item').on('click', '.add_to_cart', function(e) {
         e.preventDefault()
         var product_id = $(this)[0].dataset.id
         addToStash(product_id)
         get_stash_count()

     })
 </script>