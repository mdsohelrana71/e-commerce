@include('admin.master.header')
    <style>

    </style>
    <!-- partial -->
    <div class="content-wrapper">
        <div class="row">
            <x-module-container>
                <header>
                    <h2 class="module-title text-gray-900 dark:text-gray-100">Blog Settings</h2>
                    <p class="mt-1 text-sm text-green">Here our blog all settings information.</p>
                </header>
                <div class="card blog-settings">
                    <div class="card-body">
                        <form method="POST" id="shopProfileUpdate" action="{{ route('shop.profile.update') }}" enctype="multipart/form-data" class="forms-sample">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputPassword1">Shop name</label>
                                <input type="text" class="form-control" id="shopName" name="shop_name" placeholder="Entry shop name" value="{{get_potion('shop_name')}}">
                            </div>
                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                        </form>
                    </div>
                </div>
            </x-module-container>
        </div>
    </div>
@include('admin.master.footer')
