<div class="col-lg-4 col-md-6 col-6">
    <!-- Start Single Product -->
    <div class="single-product">

        <div class="product-image">
            <a href="{{ route('products.show', $product->slug ?? '') }}">
                <a href="">
                    <img src="{{ $product->image_url }}" alt="#{{ $product->name }} img" style="aspect-ratio: 1/1" />
                </a>
                @if ($product->compare_price)
                    <span class="sale-tag">{{ $product->sale_price }}%</span>
                @endif

                {{-- <form action="{{ route('cart.store') }}" method="POST"> --}}
                    <form action="{{  route('home') ) }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}" id="">
                    <input type="hidden" name="quantity" value="1" id="">

                    <div class="button">
                        <button type="submit" class="btn button bg-primary-subtle ">
                            <i class="lni lni-cart"></i>
                            Add to Cart
                        </button>
                    </div>
                </form>
        </div>

        <div class="product-info">
            <span class="category">{{ $product->category->name ?? '' }}</span>
            <h4 class="title">
                <a style="display: block" href="{{ route('products.show', $product->slug ?? '') }}">
                    {{ $product->name ?? '' }}
                </a>
            </h4>
            <div class="price">
                @if ($product->compare_price)
                    <span>{{ Currency::format($product->compare_price) }}</span>
                    <span class="discount-price">{{ Currency::format($product->price) }}</span>
                @else
                    <span>{{ Currency::format($product->price) }}</span>
                @endif
            </div>
        </div>
    </div>
    <!-- End Single Product -->
</div>
