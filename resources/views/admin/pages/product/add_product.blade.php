@include('admin.master.header')
    <style>
        .product-image, .product-action{
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .thumbnail-image{
            width:50px;
            height:50px;
        }
        .product-add-form .thumbnail-image{
            margin: 10px 0px 10px 0px;
        }
    </style>
    @php
        if (isset($product)) {
            $route = 'product.store';
            $routeParams = ['id' => $product->id];
            $title = 'Edit';
        } else {
            $route = 'product.store';
            $routeParams = [];
            $title = 'Add';
        }

        if(isset($product) and isset($product->categories)){
            $categories = $product->categories;
            $categoriesData = explode(', ', $categories);

            // $categories = array_map(function ($pair) {
            //     $parts = explode(':', $pair);
            //     return ['id' => $parts[0], 'name' => $parts[1]];
            // }, $categoriesData);

            $categories = [];
            foreach ($categoriesData as $pair) {
                $parts = explode(':', $pair);
                $categories[$parts[0]] =  $parts[1];
            }
        }
    @endphp
    @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    <div class="content-wrapper">
        <div class="row">
            <x-module-container>
                <header>
                    <div class="row">
                        <div class="col-md-8 module-text">
                            <h2 class="module-title text-gray-900 dark:text-gray-100">Product {{$title}} </h2>
                        </div>
                    </div>
                </header>
                <div class="product-add-form card col-xs-12 col-sm-12 col-md-12 col-xs-12 col-lg-12">
                    <div class="card-body">
                        <form action="{{ route($route, $routeParams) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 col-md-6 col-xs-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text" class="form-control" id="title" name="title" placeholder="Enter product title" value="{{ isset($product) ? $product->title:'' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="image">Thumbnail</label>
                                        @if(isset($product) && $product->image)
                                            <img src="{{ get_image($product->image,'product')  }}" alt="" class="thumbnail-image">
                                        @endif
                                        <input type="file" class="form-control" id="image" name="image">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea type="text" class="form-control" id="description" name="description">{{ isset($product) ? $product->description:'' }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <input type="text" class="form-control" id="price" name="price" placeholder="Price" value="{{ isset($product) ? $product->price:'' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="offer">Offer price</label>
                                        <input type="text" class="form-control" id="offer" name="offer" placeholder="Offer" value="{{ isset($product) ? $product->offer:'' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="shipping_price">Shipping price</label>
                                        <input type="text" class="form-control" id="shippingPrice" name="shipping_price" placeholder="Shipping" value="{{ isset($product) ? $product->shipping:'' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="quantity">Quantity</label>
                                        <input type="text" class="form-control" id="quantity" name="quantity" placeholder="Quantity" value="{{ isset($product) ? $product->quantity:'' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="Brand">Brand</label>
                                        <input type="text" class="form-control" id="brand" name="brand" placeholder="Brand" value="{{ isset($product) ? $product->brand:'' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="Brand">Max quantity per order</label>
                                        <input type="text" class="form-control" id="maxQuantityPerOrder" name="max_quantity_per_order" placeholder="Max quantity per order" value="{{ isset($product) ? $product->max_quantity_per_order:'' }}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-6 col-xs-6 col-lg-6">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6 col-md-6 col-xs-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="item_size">Item size</label>
                                                <input type="text" class="form-control" id="itemSize" name="item_size" placeholder="Item size" value="{{ isset($product) ? $product->item_size:'' }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="item_weight">Item weight</label>
                                                <input type="text" class="form-control" id="itemWeight" name="item_weight" placeholder="Item weight" value="{{ isset($product) ? $product->item_weight:'' }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="item_unit">Item unit</label>
                                                <input type="text" class="form-control" id="itemUnit" name="item_unit" placeholder="Item unit" value="{{ isset($product) ? $product->item_unit:'' }}">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-6 col-xs-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="item_color">Item color</label>
                                                <input type="text" class="form-control" id="itemColor" name="item_color" placeholder="Item color" value="{{ isset($product) ? $product->item_color:'' }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="item_materials">Item materials</label>
                                                <input type="text" class="form-control" id="itemMaterials" name="materials" placeholder="Item materials" value="{{ isset($product) ? $product->materials:'' }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="item_gender">Item gender</label>
                                                <input type="text" class="form-control" id="itemGender" name="item_gender" placeholder="Item gender" value="{{ isset($product) ? $product->gender:'' }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select class="form-select" name="status">
                                            <option value="1">Publish</option>
                                            <option value="0">Unpublish</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="category">Category</label>
                                        <select class="form-select select2" name="category[]">
                                            @if(@isset($categories))
                                                @foreach ($categories as $key =>$category)
                                                    <option value="{{$key}}">{{ $category }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="delivery_days">Delivery days</label>
                                        <input type="number" class="form-control" id="deliveryDays" name="delivery_days" placeholder="Delivery days" value="{{ isset($product) ? $product->delivery_days:'' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="ean">Ean</label>
                                        <input type="number" class="form-control" id="ean" name="ean" placeholder="Enter product ean" value="{{ isset($product) ? $product->ean:'' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_key">Meta Key</label>
                                        <input type="text" class="form-control" id="metaKey" name="meta_key" placeholder="Enter product meta key" value="{{ isset($product) ? $product->meta_key:'' }}">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                        </form>
                    </div>
                </div>
            </x-module-container>
        </div>
    </div>
@include('admin.master.footer')
