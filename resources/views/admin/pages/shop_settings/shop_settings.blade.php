@include('admin.master.header')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <style>
            .shop-settings-list i{
                font-size: 40px;
                color: #0090e7;
            }
            .settings-title strong{
                font-size: 20px;
            }
            .shop-settings-list .settings-header {
                display: flex;
                align-items: center;
            }

            .shop-settings-list .settings-icon {
                margin-right: 10px;
            }

            .shop-settings-list .settings-title {
                flex: 1;
            }
            .search-input-field .form-control, .form-control:focus{
                border: 1px solid #2A3038;
                height: calc(2.25rem + 2px);
                font-weight: normal;
                font-size: 0.875rem;
                padding: 0.625rem 0.6875rem;
                background-color: #2A3038;
                border-radius: 4px;
                color: #fff;
            }
        </style>
        <!-- partial -->
        <div class="content-wrapper">
            <div class="row">
                <x-module-container>
                    <div class="row">
                        <div class="col-md-4 module-text">
                            <h2 class="module-title text-gray-900 dark:text-gray-100">Shop others settings</h2>
                            <p class="mt-1 text-sm g-color text-green">Here is a list of all the others settings in our store</p>
                        </div>
                        <div class="col-md-6">
                            <div class="search-input-field">
                                <input type="text" class="form-control" id="dataSearch" onkeyup="searchFunction()" placeholder="Settings search here...">
                            </div>
                        </div>
                        <div class="col-md-2 product-add text-end">
                            <div class="dropdown filter-dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Filter</button>
                                <ul class="dropdown-menu">
                                  <li><a class="dropdown-item text-green" href="{{ route('products','1') }}">A to Z</a></li>
                                  <li><a class="dropdown-item text-yellow" href="{{ route('products','0') }}">Z to A</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="shop-settings-list">
                        <div class="row">
                            <div class="col-md-4 card module-text">
                                <div class="card-body">
                                    <div class="settings-header d-flex">
                                        <div class="settings-icon">
                                            <i class="mdi mdi-settings"></i>
                                        </div>
                                        <div class="settings-title">
                                            <strong>Payment Method</strong>
                                        </div>
                                    </div>
                                    <div class="settings-contnt">
                                        <p>Here is a list of all the others settings in our store</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 card module-text">
                                <div class="card-body">
                                    <div class="settings-header d-flex">
                                        <div class="settings-icon">
                                            <i class="mdi mdi-settings"></i>
                                        </div>
                                        <div class="settings-title">
                                            <strong>Payment Method</strong>
                                        </div>
                                    </div>
                                    <div class="settings-contnt">
                                        <p>Here is a list of all the others settings in our store</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 card module-text">
                                <div class="card-body">
                                    <div class="settings-header d-flex">
                                        <div class="settings-icon">
                                            <i class="mdi mdi-settings"></i>
                                        </div>
                                        <div class="settings-title">
                                            <strong>Payment Method</strong>
                                        </div>
                                    </div>
                                    <div class="settings-contnt">
                                        <p>Here is a list of all the others settings in our store</p>
                                    </div>
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
