@include('admin.master.header')
    <style>
        .blog-image, .blog-action{
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .blog-image img{
            width: 150px;
            height:100px;
        }
    </style>
    <!-- partial -->
    <div class="content-wrapper">
        <div class="row">
            <x-module-container>
                <header>
                    <div class="row">
                        <div class="col-md-8 module-text">
                            <h2 class="module-title text-gray-900 dark:text-gray-100">Blog List</h2>
                            <p class="mt-1 text-sm g-color text-green">Here is a list of all the blogs in our store</p>
                        </div>
                        <div class="col-md-4 blog-add text-end">
                            <div class="dropdown filter-dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Filter</button>
                                <ul class="dropdown-menu">
                                  <li><a class="dropdown-item text-green" href="#">Publish</a></li>
                                  <li><a class="dropdown-item text-warning" href="#">Unpublish</a></li>
                                </ul>
                            </div>
                            <a href="{{ route('blog.create') }}" class="btn btn-success"><i class="mdi mdi-plus-circle"></i>Add</a>
                        </div>
                    </div>
                </header>
                <div class="blog-list">
                    @foreach ($blogs as $data)
                        <div class="card-body mb-2 blog-card">
                            <div class="row">
                                <div class="blog-image col-sm-2 col-md-2 col-lg-2">
                                    <img class="card-img-top" src="{{ get_image($data->image,'blog') }}" alt="">
                                </div>
                                <div class="blog-info col-sm-8 col-md-8 col-lg-8">
                                    <a href="{{ route('blog.details',$data->url) }}" target="_blank">
                                        <h4 class="blog-title">{{ substr($data->title,0,100) }}</h4>
                                    </a>
                                    <p class="card-text">{!! substr(strip_tags($data->description), 0, 250) . '...'; !!}</p>
                                </div>
                                <div class="blog-action col-sm-2 col-md-2 col-lg-2">
                                    <a href="{{ route('blog.edit',$data->id) }}" class="btn btn-primary me-2">Edit</a>
                                    <a href="{{ route('blog.destroy',$data->id) }}" class="btn btn-danger me-2">Delete</a>
                                    <a href="{{ route('blog.details',$data->url) }}" class="btn btn-info" target="_blank">View</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </x-module-container>
        </div>
    </div>
@include('admin.master.footer')
