@include('admin.master.header')
    <style>
        .blog-image, .blog-action{
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .thumbnail-image{
            width:50px;
            height:50px;
        }
        .blog-add-form .thumbnail-image{
            margin: 10px 0px 10px 0px;
        }
    </style>
    @php
        if (isset($blog)) {
            $route = 'blog.store';
            $routeParams = ['id' => $blog->id];
            $title = 'Edit';
        } else {
            $route = 'blog.store';
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
                            <h2 class="module-title text-gray-900 dark:text-gray-100">Blog {{$title}} </h2>
                        </div>
                    </div>
                </header>
                <div class="blog-add-form card">
                    <div class="card-body">
                        <form action="{{ route($route, $routeParams) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Enter blog title" value="{{ isset($blog) ? $blog->title:'' }}">
                            </div>
                            <div class="form-group">
                                <label for="image">Thumbnail</label>
                                @if(isset($blog) && $blog->image)
                                    <img src="{{ get_image($blog->image,'blog')  }}" alt="" class="thumbnail-image">
                                @endif
                                <input type="file" class="form-control" id="image" name="image">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea type="text" class="form-control" id="description" name="description">{{ isset($blog) ? $blog->description:'' }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="description">Category</label>
                                <select class="form-select select2" name="status">
                                    <option value="1">Category one</option>
                                    <option value="2">Category two</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="description">Status</label>
                                <select class="form-select" name="status">
                                    <option value="1">Publish</option>
                                    <option value="0">Unpublish</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="meta_key">Meta Key</label>
                                <input type="text" class="form-control" id="metaKey" name="meta_key" placeholder="Enter blog meta key" value="{{ isset($blog) ? $blog->meta_key:'' }}">
                            </div>
                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                        </form>
                    </div>
                </div>
            </x-module-container>
        </div>
    </div>
@include('admin.master.footer')
