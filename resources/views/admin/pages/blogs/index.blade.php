@include('admin.master.header')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .card-body{
            background: #fff;
            color: #000
        }
        .blog-image, .blog-action{
            display: flex;
            justify-content: center; /* Horizontally center the content */
            align-items: center; /* Vertically center the content */
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
                            <a href="#" class="btn btn-success">Add</a>
                        </div>
                    </div>
                </header>
                <div class="shop-profile">
                    <div class="card-body mb-2">
                        <div class="row">
                            <div class="blog-image col-sm-2 col-md-2 col-lg-2">
                                <img class="card-img-top" src="{{ get_image(get_potion('shop_logo'),'logo') }}" alt="" style="width: 100px">
                            </div>
                            <div class="blog-info  col-sm-8 col-md-8 col-lg-8">
                                <h4 class="blog-title">Blog Tite</h4>
                                <p class="card-text">Some example description.</p>
                            </div>
                            <div class="blog-action col-sm-2 col-md-2 col-lg-2">
                                <a href="#" class="btn btn-primary m-2">Edit</a>
                                <a href="#" class="btn btn-danger">Delete</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body mb-2">
                        <div class="row">
                            <div class="blog-image col-sm-2 col-md-2 col-lg-2">
                                <img class="card-img-top" src="{{ get_image(get_potion('shop_logo'),'logo') }}" alt="" style="width: 100px">
                            </div>
                            <div class="blog-info  col-sm-8 col-md-8 col-lg-8">
                                <h4 class="blog-title">Blog Tite</h4>
                                <p class="card-text">Some example description.</p>
                            </div>
                            <div class="blog-action col-sm-2 col-md-2 col-lg-2">
                                <a href="#" class="btn btn-primary m-2">Edit</a>
                                <a href="#" class="btn btn-danger">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
            </x-module-container>
        </div>
    </div>
@include('admin.master.footer')
