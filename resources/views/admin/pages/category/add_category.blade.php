@include('admin.master.header')
    <style>
        .category-image, .category-action{
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .thumbnail-image{
            width:50px;
            height:50px;
        }
        .category-add-form .thumbnail-image{
            margin: 10px 0px 10px 0px;
        }
    </style>
    @php
        if (isset($category)) {
            $route = 'category.store';
            $routeParams = ['id' => $category->id];
            $title = 'Edit';
        } else {
            $route = 'category.store';
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
                            <h2 class="module-title text-gray-900 dark:text-gray-100">Category {{$title}} </h2>
                        </div>
                    </div>
                </header>
                <div class="category-add-form card col-xs-12 col-sm-12 col-md-12 col-xs-12 col-lg-12">
                    <div class="card-body">
                        <form action="{{ route($route, $routeParams) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-xs-12 col-lg-12">
                                    <div class="form-group">
                                        <label for="name">Category name</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter category title" value="{{ isset($category) ? $category->title:'' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="Brand">Content Type</label>
                                        <select class="form-select" name="type">
                                            <option value="1">Product</option>
                                            <option value="2">Blog</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="parent_id">Parent categories</label>
                                        <select class="form-select" name="parent_id">
                                            <option value="0">Please select parent cateory</option>
                                            <option value="1">Parent one</option>
                                        </select>
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
