@include('admin.master.header')
    <link rel="stylesheet" href="{{ asset('admin/assets/css/modules-css/tasks.css') }}">
    <!-- partial -->
    <div class="content-wrapper">
        <div class="row">
            <x-module-container>
                <header>
                    <div class="row">
                        <div class="col-md-6 module-text">
                            <h2 class="module-title text-gray-900 dark:text-gray-100">Tasks List</h2>
                            <p class="mt-1 text-sm g-color">Our tasks list and add, edit, delete functionality.</p>
                        </div>
                        <div class="col-md-3">
                            <span id="successMessage" style="display: none;" class="text-success">
                                <!-- Success message will appear here -->
                            </span>
                        </div>
                        <div class="col-md-3 task-add text-end">
                            <div class="dropdown task-filter">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Filter</button>
                                <ul class="dropdown-menu">
                                  <li><a class="dropdown-item text-primary" href="#">Done</a></li>
                                  <li><a class="dropdown-item text-warning" href="#">Inprogress</a></li>
                                  <li><a class="dropdown-item text-success" href="#">To Do</a></li>
                                  <li><a class="dropdown-item text-danger" href="#">Trash</a></li>
                                </ul>
                            </div>
                            <a href="{{ route('task.add') }}" class="btn btn-success">Add</a>
                        </div>
                    </div>
                </header>
                <div class="inprogress-tasks">
                    @if(isset($tasks[1]))
                        <div class="card-header text-white">
                            <strong class="">Inprogress:</strong>
                        </div>
                        @php
                            $i = 1;
                            $currentDate = date("Y-m-d");
                        @endphp
                        @foreach ($tasks[1] as $task)
                            <div class="card-body mb-1">
                                <div class="row">
                                    <div class="col-sm-10 col-md-10 col-lg-10 text-start">
                                        <span class="text-white bg-warning task-number">1</span>
                                        <div class="dropdown">
                                            <button class="btn text-warning dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Inprogress</button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item text-success" href="javascript:void(0);" onclick="taskStatusChange({{$task->id}},0)">To Do</a></li>
                                                <li><a class="dropdown-item text-warning" href="javascript:void(0);" onclick="taskStatusChange({{$task->id}},1)">Inprogress</a></li>
                                                <li><a class="dropdown-item text-primary" href="javascript:void(0);" onclick="taskStatusChange({{$task->id}},2)">Done</a></li>
                                            </ul>
                                        </div>
                                        <div class="task-title">
                                            <span class="card-text">{{ $task->title}}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-2 col-md-2 col-lg-2 text-end">
                                        <div class="task-date">
                                            <span class="card-text mr-5 @php if($task->date < $currentDate){ echo 'text-warning';} @endphp">{{ $task->date}}</span>
                                        </div>
                                        <div class="task-action">
                                            {{-- <a href="#" class="text-primary" title="Edit"><i class="mdi mdi-table-edit"></i></a> --}}
                                            <a href="#" class="text-warning" title="Trash" onclick="taskRemove({{$task->id}},0)"><i class="mdi mdi-delete-forever"></i></a>
                                            <a href="#" class="text-danger" title="Delete" onclick="taskRemove({{$task->id}},1)"><i class="mdi mdi-delete"></i></a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

                <div class="to-do-tasks">
                    @if(isset($tasks[0]))
                        <div class="card-header text-white">
                            <strong>To Do:</strong>
                        </div>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($tasks[0] as $task)
                            <div class="card-body mb-1" id="single_{{$task->id}}">
                                <div class="row">
                                    <div class="col-sm-11 col-md-11 col-lg-11 text-start">
                                        <span class="task-status">
                                            <span class="text-white bg-success task-number">{{ $i++ }}</span>
                                            <div class="dropdown">
                                                <button class="btn text-success dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">To Do</button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item text-success" href="javascript:void(0);" onclick="taskStatusChange({{$task->id}},0)">To Do</a></li>
                                                    <li><a class="dropdown-item text-warning" href="javascript:void(0);" onclick="taskStatusChange({{$task->id}},1)">Inprogress</a></li>
                                                    <li><a class="dropdown-item text-primary" href="javascript:void(0);" onclick="taskStatusChange({{$task->id}},2)">Done</a></li>
                                                </ul>
                                            </div>
                                        </span>

                                        <div class="task-title" id="taskDetails" onclick="taskDetails({{$task->id}})">
                                            <span class="card-text">{{ $task->title}}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-1 col-md-1 col-lg-1 text-end">
                                        <div class="task-date">
                                            <span class="card-text mr-5 @php if($task->date < $currentDate){ echo 'text-warning';} @endphp">{{ $task->date}}</span>
                                        </div>
                                        <div class="task-action">
                                            {{-- <a href="javascript:void(0);" class="text-primary" title="Edit" onclick="taskEdit({{$task->id}})"><i class="mdi mdi-table-edit"></i></a> --}}
                                            <a href="javascript:void(0);" class="text-warning" title="Trash" onclick="taskRemove({{$task->id}},0)"><i class="mdi mdi-delete-forever"></i></a>
                                            <a href="javascript:void(0);" class="text-danger" title="Delete" onclick="taskRemove({{$task->id}},1)"><i class="mdi mdi-delete"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </x-module-container>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="task-title" id="taskTitle">
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                <div class="modal-body">
                    <div class="card-bodys">
                        <form action="{{ route('task.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="title">Task Title <span class="text-danger">*</span></label>
                            </div>
                            <div class="form-group">
                                <label for="description">Task Description</label>
                                <textarea type="textarea" class="form-control" id="description" name="description"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="date">Due Date</label>
                                <input type="date" class="form-control" id="dueDate" name="due-date" placeholder="Enter due date">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>

        function taskDetails(id){
            $.ajax({
                type: "GET",
                url: "<?=route('task.details')?>",
                data: {
                    id
                },
                success: function(data) {
                    var data = data.data;
                    console.log(data);
                    $("#taskTitle").append(data.title);
                    $("#description").append(data.title);
                    $("#dueDate").append(data.date);
                    $("#myModal").modal('show');
                },
            });
        }
        function taskStatusChange(id,type){
            $.ajax({
                type: "POST",
                url: "<?=route('task.status.change')?>",
                data: {
                    id,type,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    var type = data.data[1];
                    if(type == 0){
                        $("#successMessage").text('This task move to To Do!').fadeIn();
                    }else if(type == 1){
                        $("#successMessage").text('This task move to Inprogress!').fadeIn();
                    }else{
                        $("#successMessage").text('This task move to Done!').fadeIn();
                    }
                    setTimeout(function () {
                        $("#successMessage").fadeOut();
                        location.reload();
                    }, 1000);
                },
            });
        }

        function taskRemove(id,type){
            $.ajax({
                type: "DELETE",
                url: "<?=route('task.destroy')?>",
                data: {
                    id,type,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    var id   = data.data[0];
                    var type = data.data[1];
                    if(type == 'trash'){
                        $("#successMessage").text('This task successfully Trash!').fadeIn();
                    }else{
                        $("#successMessage").text('This task successfully Delete!').fadeIn();
                    }
                    setTimeout(function () {
                        $("#successMessage").fadeOut();
                    }, 1000);

                    var myElement = document.getElementById('single_'+id);
                    myElement.style.display = 'none';
                },
            });
        }
    </script>
@include('admin.master.footer')
