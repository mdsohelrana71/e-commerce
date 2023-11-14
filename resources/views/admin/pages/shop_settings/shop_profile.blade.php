@include('admin.master.header')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <style>
            .shop-profile img{
                width:50px;
                height:50px;
            }
            .shop-profile .image{
                margin: 10px 0px 10px 0px;
            }
            .shop-profile .form-group .image label {
                vertical-align: bottom;
            }
        </style>
        <!-- partial -->
        <div class="content-wrapper">
            <div class="row">
                <x-module-container>
                    <header>
                        <h2 class="module-title text-gray-900 dark:text-gray-100">Shop Profile Information</h2>
                        <p class="mt-1 text-sm g-color">Update your shop <span class="text-green">Name, Logo and Favicon</span></p>
                    </header>
                    <div class="card shop-profile">
                        <div class="card-body">
                          <form method="POST" id="shopProfileUpdate" action="{{ route('shop.profile.update') }}" enctype="multipart/form-data" class="forms-sample">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputPassword1">Shop name</label>
                                <input type="text" class="form-control" id="shopName" name="shop_name" placeholder="Entry shop name" value="{{get_potion('shop_name')}}">
                            </div>
                            <div class="form-group">
                                <div class="image">
                                    <label for="logo">Shop logo upload</label>
                                    <img src="{{ get_image(get_potion('shop_logo'),'logo') }}" alt="shop logo">
                                </div>
                              <input type="file" class="form-control" id="logo" name="logo">
                            </div>
                            <div class="form-group">
                                <div class="image">
                                    <label for="favicon">Shop favicon upload</label>
                                    <img src="{{ get_image(get_potion('shop_favicon'),'logo') }}" alt="shop favicon">
                                </div>
                              <input type="file" class="form-control" id="favicon" name="favicon">
                            </div>
                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                          </form>
                        </div>
                    </div>
                </x-module-container>
            </div>
        </div>
        <!-- content-wrapper ends -->
        {{-- <script>
            $(document).ready(function(){
                $("#shopProfileUpdate").submit(function(e) {
                    e.preventDefault();
                    var data = new FormData(this);
                    console.log(data);
                    $("#add_employee_btn").text('Adding...');
                    $.ajax({
                    url: '{{ route('shop.profile.update') }}',
                    method: 'post',
                    data: data,
                    success: function(response) {
                        if (response.status == 200) {
                        Swal.fire(
                            'Added!',
                            'Employee Added Successfully!',
                            'success'
                        )
                        fetchAllEmployees();
                        }
                    }
                    });
                });
            });
        </script> --}}
@include('admin.master.footer')
