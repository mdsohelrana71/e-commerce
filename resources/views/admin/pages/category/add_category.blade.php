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
                        <form action="{{ route($route, $routeParams) }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-xs-12 col-lg-12">
                                    <div class="form-group">
                                        <label for="name">Category name</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter category title" value="{{ isset($category) ? $category->name:'' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="Brand">Content Type</label>
                                        <select class="form-select" name="type" id="contentType" onchange="getSelectedType()">
                                            <option value="1" @if(isset($category) && $category->type == 1) selected @endif>Product</option>
                                            <option value="2" @if(isset($category) && $category->type == 2) selected @endif>Blog</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="parent_id">Choose a parent</label>
                                        <select class="form-select single-select" name="parent_id" id="ParentList">
                                            <option value="0">Choose a parent</option>
                                            @foreach ($categories as $data)
                                                <option value="{{ $data->id }}" @if(isset($category) && $category->parent_id != 0 && $category->parent_id == $data->id) selected @endif>{{ $data->name }}</option>
                                            @endforeach
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
    <script>
        function getSelectedType() {
          var value = document.getElementById("contentType").value;
          $.ajax({
                type: "GET",
                url: "<?=route('category.create')?>",
                data: {
                    value
                },
                success: function(data) {
                    var data = data.data;
                    var optionsHtml = "";
                    data.forEach(function(item) {
                        optionsHtml += '<option value="' + item.id + '">' + item.name + '</option>';
                    });
                    $("#ParentList").empty().append(optionsHtml);
                },
            });
        }
    </script>
@include('admin.master.footer')
