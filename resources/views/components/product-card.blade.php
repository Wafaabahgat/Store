<div class="col-lg-4 col-md-6 col-6">
    <!-- Start Single Product -->
    <div class="single-product">

        <div class="product-image">
            <a href="{{ route('singleproduct.show', $product->slug ?? 1) }}">
                <a href="">
                    <img src="{{ $product->image_url }}" alt="#{{ $product->name }} img" style="aspect-ratio: 1/1" />
                </a>
                @if ($product->compare_price)
                    <span class="sale-tag">-{{ $product->sale_price }}%</span>
                @endif
                @if ($product->new)
                    <span class="sale-tag">New</span>
                @endif
                
                <form action="{{ route('cart.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}" id="">
                    <input type="hidden" name="quantity" value="1" id="">

                    <div class="button">
                        <button type="submit" class="btn button bg-primary-subtle ">
                            <i class="fa-solid fa-cart-shopping"></i>
                            Add to Cart
                        </button>
                    </div>
                </form>
        </div>

        <div class="product-info">
            <span class="category">{{ $product->category->name ?? '' }}</span>
            <h4 class="title">
                <a style="display: block" href="{{ route('singleproduct.show', $product->slug ?? 1) }}">
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
