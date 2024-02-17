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
                <div class="category-list" id="categoryList">
                    @foreach ($categories as $data)
                        <div class="card-body mb-2 category-card">
                            <div class="row">
                                <div class="category-info col-sm-10 col-md-10 col-lg-10">
                                    <a href="" target="_blank">
                                        <h4 class="category-title">{{ substr($data->name,0,100) }}</h4>
                                    </a>
                                </div>
                                <div class="category-action col-sm-2 col-md-2 col-lg-2">
                                    <a href="{{ route('category.edit',$data->id) }}" class="btn btn-primary me-2">Edit</a>
                                    <a href="{{ route('category.destroy',$data->id) }}" class="btn btn-danger me-2">Delete</a>
                                    {{-- <a href="{{ route('category.details',$data->url) }}" class="btn btn-info" target="_blank">View</a> --}}
                                </div>
                            </div>
                        </div>
                    @endforeach
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
