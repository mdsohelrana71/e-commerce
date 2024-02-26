@include('admin.master.header')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <style>
            .shop-settings-list img{
                width:50px;
                height:50px;
            }
            .shop-settings-list .image{
                margin: 10px 0px 10px 0px;
            }
            .shop-settings-list .form-group .image label {
                vertical-align: bottom;
            }
        </style>
        <!-- partial -->
        <div class="content-wrapper">
            <div class="row">
                <x-module-container>
                    <header>
                        <h2 class="module-title text-gray-900 dark:text-gray-100">Shop others settings</h2>
                        <p class="mt-1 text-sm g-color text-green">Here is a list of all the others settings in our store</p>
                    </header>
                    <div class="col-md-12 shop-settings-list">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4>Settings title</h4>
                                    <p>some text</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    hasldsald
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    hasldsald
                                </div>
                            </div>
                        </div>
                    </div>
                </x-module-container>
            </div>
        </div>
        <!-- content-wrapper ends -->
        {{-- <script>
        </script> --}}
@include('admin.master.footer')
