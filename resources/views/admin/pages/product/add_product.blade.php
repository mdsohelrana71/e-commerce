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
    @endphp
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
                                        <label for="description">Category</label>
                                        <select class="form-select select2" name="status">
                                            <option value="1">Category one</option>
                                            <option value="2">Category two</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_key">Price</label>
                                        <input type="text" class="form-control" id="metaKey" name="meta_key" placeholder="Enter product meta key" value="{{ isset($product) ? $product->meta_key:'' }}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-6 col-xs-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="description">Status</label>
                                        <select class="form-select" name="status">
                                            <option value="1">Publish</option>
                                            <option value="0">Unpublish</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text" class="form-control" id="title" name="title" placeholder="Enter product title" value="{{ isset($product) ? $product->title:'' }}">
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
