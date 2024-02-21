@include('admin.master.header')
    <style>
        .category-image, .category-action{
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .category-image img{
            width: 150px;
            height:100px;
        }

        .category-card:hover{
            background-color: #fff;
        }
        .category-data-info{
            display: flex;
        }
        .category-list .price, .quantity, .ean, .shipping-price{
            width: 25%;
        }
        .category-list .category-data-info span{
            color: grey
        }

        .category-list ul{
            list-style-type: none;
        }

        .category-list .parent-category{
            background: #fff;
            color: #000;
            border-radius: 4px;
            padding: 5px 5px 5px 10px;
            margin: 0px 0px 5px 0px;
        }
        .category-list .category{
            background: #f6f6f6;
            border-radius: 4px;
            padding: 5px 5px 5px 10px;
            margin: 5px 0px 5px 0px;
            display: flex;
            justify-content: space-between;
        }
    </style>
    <!-- partial -->
    <div class="content-wrapper">
        <div class="row">
            <x-module-container>
                <header>
                    <div class="row">
                        <div class="col-md-4 module-text">
                            <h2 class="module-title text-gray-900 dark:text-gray-100">Categories List</h2>
                            <p class="mt-1 text-sm g-color text-green">Here is a list of all the category in our store</p>
                        </div>
                        <div class="col-md-4">
                            <div class="search-input-field">
                                <input type="text" class="form-control" id="dataSearch" onkeyup="searchFunction()" placeholder="Search here...">
                            </div>
                        </div>
                        <div class="col-md-4 category-add text-end">
                            <div class="dropdown filter-dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Filter</button>
                                <ul class="dropdown-menu">
                                  <li><a class="dropdown-item text-green" href="{{ route('category','1') }}">Publish</a></li>
                                  <li><a class="dropdown-item text-yellow" href="{{ route('category','0') }}">Unpublish</a></li>
                                </ul>
                            </div>
                            <a href="{{ route('category.create') }}" class="btn btn-success"><i class="mdi mdi-plus-circle"></i>Add</a>
                        </div>
                    </div>
                </header>
                <div class="category-list">
                    <ul id="categoryList">
                        @foreach ($categories as $category)
                            <li class="parent-category">
                                <div class="category">
                                    <span class="categoy-title">
                                        {{ $category->name }}
                                    </span>
                                    <span class="categoy-action">
                                        <a href="{{ route('category.edit',$category->id) }}" class="btn btn-primary btn-sm me-2">Edit</a>
                                        <a href="{{ route('category.destroy',$category->id) }}" class="btn btn-danger btn-sm me-2">Delete</a>
                                    </span>
                                </div>
                                @if ($category->children->count() > 0)
                                    @include('admin/pages/category/subcategories', ['categories' => $category->children])
                                @endif
                            </li>
                        @endforeach
                    </ul>
                    <div class="data-pagination">
                        {!! $categories->withQueryString()->links('pagination::bootstrap-5') !!}
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
                url: "<?=route('category.search')?>",
                data: {
                    value
                },
                success: function(data) {
                    var data = data.data;
                    $("#categoryList").html(data);
                },
            });
        }
    </script>

@include('admin.master.footer')
