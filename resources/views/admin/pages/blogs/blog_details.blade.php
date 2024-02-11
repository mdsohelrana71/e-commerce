@include('frontend.master.header')
    @php
        use Carbon\Carbon;
    @endphp
    <style>
        .blog-image img{
            width: 100%;
            max-height: 600px;
        }
    </style>
    <!-- Start Blog Section -->
    <div class="blog-details-section my-3 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12">
                    <div class="blog-info my-3">
                        <div class="blog-title mt-2">
                            <h3><a href="#">{{  $blog->title }}</a></h3>
                        </div>
                        <div class="blog-image">
                            <a href="#" class="post-thumbnail"><img src="{{ get_image($blog->image,'blog') }}" alt="Image" class="img-fluid"></a>
                        </div>
                        <div class="blog-description mt-2">
                            <p>{!! $blog->description !!}</h3>
                        </div>  
                        <div class="blog-date-auth mt-2">
                            <span>by <a href="#">{{ $blog->name?$blog->name:'Admin' }}</a></span> <span>on <a href="#">{{ Carbon::parse($blog->created_at)->format('d-M-Y') }}</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Blog Section -->

@include('frontend.master.footer')
