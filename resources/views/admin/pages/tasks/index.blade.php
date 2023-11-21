@include('admin.master.header')
    <style>
        .card-body{
            background: #1f2939;
            color: #fff;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            padding: 5px;
        }
        .card-body{
            justify-content: center;
            align-items: center;
        }
        .task-number {
            height: 25px;
            width: 25px;
            border-radius: 50%;
            display: inline-block;
            text-align: center
        }
        .task-filter, .task-date, .task-action{
            display: inline-block
        }
        .tasks, .mdi{
            font-size: 20px
        }
    </style>
    <!-- partial -->
    <div class="content-wrapper">
        <div class="row">
            <x-module-container>
                <header>
                    <div class="row">
                        <div class="col-md-8 module-text">
                            <h2 class="module-title text-gray-900 dark:text-gray-100">Tasks List</h2>
                            <p class="mt-1 text-sm g-color">Our tasks task list <span class="text-green">task add, edit and delete functionality.</span></p>
                        </div>
                        <div class="col-md-4 task-add text-end">
                            <div class="dropdown task-filter">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Filter</button>
                                <ul class="dropdown-menu">
                                  <li><a class="dropdown-item text-primary" href="#">Done</a></li>
                                  <li><a class="dropdown-item text-danger" href="#">Trash</a></li>
                                </ul>
                            </div>
                            <a href="#" class="btn btn-success">Add</a>
                        </div>
                    </div>
                </header>
                <div class="tasks">
                    <div class="card-body mb-1">
                        <div class="row">
                            <div class="col-sm-1 col-md-1 col-lg-1 text-start">
                                <div class="dropdown">
                                    <button class="btn text-success dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">To Do</button>
                                    <ul class="dropdown-menu">
                                      <li><a class="dropdown-item text-success" href="#">To Do</a></li>
                                      <li><a class="dropdown-item text-warning" href="#">Inprogress</a></li>
                                      <li><a class="dropdown-item text-primary" href="#">Done</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-9 col-md-9 col-lg-9 text-start">
                                <div class="task-numbering">
                                    <span class="text-white bg-success task-number">1</span>
                                    <span class="card-text">Some example description.</span>
                                </div>
                            </div>
                            <div class="col-sm-2 col-md-2 col-lg-2 text-end">
                                <div class="task-date">
                                    <span class="card-text mr-5">10-Dec-2023</span>
                                </div>
                                <div class="task-action">
                                    <a href="#" class="text-primary"><i class="mdi mdi-table-edit"></i></a>
                                    <a href="#" class="text-warning"><i class="mdi mdi-delete-forever"></i></a>
                                    <a href="#" class="text-danger"><i class="mdi mdi-delete"></i></a>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card-body mb-1">
                        <div class="row">
                            <div class="col-sm-1 col-md-1 col-lg-1 text-start">
                                <div class="dropdown">
                                    <button class="btn text-warning dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Inprogress</button>
                                    <ul class="dropdown-menu">
                                      <li><a class="dropdown-item text-success" href="#">To Do</a></li>
                                      <li><a class="dropdown-item text-warning" href="#">Inprogress</a></li>
                                      <li><a class="dropdown-item text-primary" href="#">Done</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-9 col-md-9 col-lg-9 text-start">
                                <div class="task-numbering">
                                    <span class="text-white bg-warning task-number">1</span>
                                    <span class="card-text">Some example description.</span>
                                </div>
                            </div>
                            <div class="task-action col-sm-2 col-md-2 col-lg-2 text-end">
                                <span class="card-text">10-Dec-2023</span>
                                <a href="#" class="text-primary"><i class="mdi mdi-table-edit"></i></a>
                                <a href="#" class="text-warning"><i class="mdi mdi-delete-forever"></i></a>
                                <a href="#" class="text-danger"><i class="mdi mdi-delete"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body mb-1">
                        <div class="row">
                            <div class="col-sm-1 col-md-1 col-lg-1 text-start">
                                <div class="dropdown">
                                    <button class="btn text-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Done</button>
                                    <ul class="dropdown-menu">
                                      <li><a class="dropdown-item text-success" href="#">To Do</a></li>
                                      <li><a class="dropdown-item text-warning" href="#">Inprogress</a></li>
                                      <li><a class="dropdown-item text-primary" href="#">Done</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-9 col-md-9 col-lg-9 text-start">
                                <div class="task-numbering">
                                    <span class="text-white bg-primary task-number">1</span>
                                    <span class="card-text">Some example description.</span>
                                </div>
                            </div>
                            <div class="task-action col-sm-2 col-md-2 col-lg-2 text-end">
                                <span class="card-text">10-Dec-2023</span>
                                <a href="#" class="text-primary"><i class="mdi mdi-table-edit"></i></a>
                                <a href="#" class="text-warning"><i class="mdi mdi-delete-forever"></i></a>
                                <a href="#" class="text-danger"><i class="mdi mdi-delete"></i></a>
                            </div>
                        </div>
                    </div>

                </div>
            </x-module-container>
        </div>
    </div>
@include('admin.master.footer')
