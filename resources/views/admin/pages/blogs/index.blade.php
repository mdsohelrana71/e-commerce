@include('admin.master.header')
    <style>
        .card-body{
            background: #fff;
            color: #000
        }
        .blog-image, .blog-action{
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .blog-image img{
            width: 100px;
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
                            <p class="mt-1 text-sm g-color">Our shop blog list <span class="text-green">blog add, edit and delete functionality.</span></p>
                        </div>
                        <div class="col-md-4 blog-add text-end">
                            <a href="{{ route('blog.create') }}" class="btn btn-success">Add</a>
                        </div>
                    </div>
                </header>
                <div class="shop-profile">
                    @foreach ($blogs as $data)
                        <div class="card-body mb-2">
                            <div class="row">
                                <div class="blog-image col-sm-2 col-md-2 col-lg-2">
                                    <img class="card-img-top" src="{{ get_image($data->image,'blog') }}" alt="">
                                </div>
                                <div class="blog-info col-sm-8 col-md-8 col-lg-8">
                                    <h4 class="blog-title">{{ substr($data->title,0,100) }}</h4>
                                    <p class="card-text">{!! substr(strip_tags($data->description), 0, 250) . '...'; !!}</p>
                                </div>
                                <div class="blog-action col-sm-2 col-md-2 col-lg-2">
                                    <a href="{{ route('blog.edit',$data->id) }}" class="btn btn-primary m-2">Edit</a>
                                    <a href="{{ route('blog.destroy',$data->id) }}" class="btn btn-danger m-2">Delete</a>
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
