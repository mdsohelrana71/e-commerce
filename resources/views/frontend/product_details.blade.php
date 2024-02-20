@include('frontend.master.header')

<div class="product-inner-section pt-5">
    <div class="container">
        <div class="row">
            <!-- Start Column 1 -->
                <div class="col-6 col-md-6 col-lg-6">
                    <img src="{{ get_image($product->image,'product') }}" class="img-fluid product-thumbnail">
                </div>
                <div class="col-6 col-md-6 col-lg-6">
                    <div class="product-info">
                        <div class="product-title">
                            <h4 class="product-title">{{ $product->title }}</h4>
                        </div>
                        <div class="product-categroies">
                            <strong class="product-title">Category:</strong>
                            <span>{{ $product->category_names }}</span>
                        </div>
                        <div class="product-price">
                            <strong class="product-price">Price:</strong>
                            <span>{{ $product->price }}</span>
                        </div>
                        <div class="add-to-card pt-3">
                            <button class="btn btn-primary btn-md">Add To Card</button>
                        </div>
                    </div>
                </div>
            <!-- End Column 1 -->
        </div>
    </div>
</div>

@include('frontend.master.footer')
