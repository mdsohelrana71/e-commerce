@include('admin.master.header')
    <style>
        .product-image, .product-action{
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .product-image img{
            width: 150px;
            height:100px;
        }

        .product-card:hover{
            background-color: #fff;
        }
        .product-data-info{
            display: flex;
        }
        .product-list .price, .quantity, .ean, .shipping-price{
            width: 25%;
        }
        .product-list .product-data-info span{
            color: grey
        }
    </style>
    <!-- partial -->
    <div class="content-wrapper">
        <div class="row">
            <x-module-container>
                <header>
                    <div class="row">
                        <div class="col-md-4 module-text">
                            <h2 class="module-title text-gray-900 dark:text-gray-100">Products List</h2>
                            <p class="mt-1 text-sm g-color text-green">Here is a list of all the product in our store</p>
                        </div>
                        <div class="col-md-4">
                            <div class="search-input-field">
                                <input type="text" class="form-control" id="dataSearch" onkeyup="searchFunction()" placeholder="Search here...">
                            </div>
                        </div>
                        <div class="col-md-4 product-add text-end">
                            <div class="dropdown filter-dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Filter</button>
                                <ul class="dropdown-menu">
                                  <li><a class="dropdown-item text-green" href="{{ route('products','1') }}">Publish</a></li>
                                  <li><a class="dropdown-item text-yellow" href="{{ route('products','0') }}">Unpublish</a></li>
                                </ul>
                            </div>
                            <a href="{{ route('product.create') }}" class="btn btn-success"><i class="mdi mdi-plus-circle"></i>Add</a>
                        </div>
                    </div>
                </header>
                <div class="product-list" id="productList">
                    @foreach ($products as $data)
                        <div class="card-body mb-2 product-card">
                            <div class="row">
                                <div class="product-image col-sm-2 col-md-2 col-lg-2">
                                    <img class="card-img-top" src="{{ get_image($data->image,'product') }}" alt="">
                                </div>
                                <div class="product-info col-sm-8 col-md-8 col-lg-8">
                                    <a href="" target="_blank">
                                        <h4 class="product-title">{{ substr($data->title,0,100) }}</h4>
                                    </a>
                                    <div class="category">
                                        <strong>Category: </strong><span>Category one</span>,<span>Category two</span>
                                    </div>
                                    <div class="product-data-info">
                                        <div class="price">
                                            <strong>Price:</strong>
                                            <span>{{ $data->price }}</span>
                                        </div>
                                        <div class="quantity">
                                            <strong>Quantity:</strong>
                                            <span>{{ $data->quantity }}</span>
                                        </div>
                                        <div class="ean">
                                            <strong>Ean:</strong>
                                            <span>{{ $data->ean }}</span>
                                        </div>
                                        <div class="shipping-price">
                                            <strong>Shipping price:</strong>
                                            <span>{{ $data->shipping }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-action col-sm-2 col-md-2 col-lg-2">
                                    <a href="{{ route('product.edit',$data->id) }}" class="btn btn-primary me-2">Edit</a>
                                    <a href="{{ route('product.destroy',$data->id) }}" class="btn btn-danger me-2">Delete</a>
                                    {{-- <a href="{{ route('product.details',$data->url) }}" class="btn btn-info" target="_blank">View</a> --}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="data-pagination">
                        {!! $products->withQueryString()->links('pagination::bootstrap-5') !!}
                    </div>
                </div>
            </x-module-container>
        </div>
    </div>
    <script>
        function searchFunction() {
            let value = document.getElementById("dataSearch").value;
            $.ajax({
                type: "GET",
                url: "<?=route('products.search')?>",
                data: {
                    value
                },
                success: function(data) {
                    var data = data.data;
                    $("#productList").html(data);
                },
            });
        }
    </script>

@include('admin.master.footer')
