@include('frontend.master.header')
    <div class="user-panel">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <div class="intro-excerpt align-middle">
                        <h1>User Dashboard</h1>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="hero-img-wrap">
                        <img style="opacity:0.5" src="{{ asset('frontend/images/couch.png') }}" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
@include('frontend.master.footer')
