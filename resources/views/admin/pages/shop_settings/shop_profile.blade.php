@include('admin.master.header')

        <!-- partial -->
        <div class="content-wrapper">
            <div class="row ">
                <x-module-container>
                    <header>
                        <h2 class="module-title text-gray-900 dark:text-gray-100">
                            Profile Information
                        </h2>

                        <p class="mt-1 text-sm g-color">
                            Update your account's profile information and email address.
                        </p>
                    </header>

                    <div class="card">
                        <div class="card-body">
                          <h4 class="card-title">Default form</h4>
                          <p class="card-description"> Basic form layout </p>
                          <form class="forms-sample">
                            <div class="form-group">
                              <label for="exampleInputUsername1">Username</label>
                              <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Username">
                            </div>
                            <div class="form-group">
                              <label for="exampleInputEmail1">Email address</label>
                              <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
                            </div>
                            <div class="form-group">
                              <label for="exampleInputPassword1">Password</label>
                              <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                            </div>
                            <div class="form-group">
                              <label for="exampleInputConfirmPassword1">Confirm Password</label>
                              <input type="password" class="form-control" id="exampleInputConfirmPassword1" placeholder="Password">
                            </div>
                            <div class="form-check form-check-flat form-check-primary">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input"> Remember me </label>
                            </div>
                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                            <button class="btn btn-dark">Cancel</button>
                          </form>
                        </div>
                      </div>
                </x-module-container>
            </div>
        </div>
        <!-- content-wrapper ends -->

@include('admin.master.footer')
