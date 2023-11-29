@include('admin.master.header')
    <link rel="stylesheet" href="{{ asset('admin/assets/css/modules-css/tasks.css') }}">
    <!-- partial -->
    @php
        $tasks = DB::table('tasks')
                ->orderBy('created_at')
                ->whereIn('status', [1, 2])
                ->where('tresh', 0)
                ->get()
                ->groupBy('status');
    @endphp
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
                            <span id="successMessage" style="display: none;" class="text-danger">
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
                    <div class="card-header text-white">
                        <strong class="">Inprogress:</strong>
                    </div>
                    @if(isset($tasks))
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($tasks[2] as $task)
                            <div class="card-body mb-1">
                                <div class="row">
                                    <div class="col-sm-10 col-md-10 col-lg-10 text-start">
                                        <span class="text-white bg-warning task-number">1</span>
                                        <div class="dropdown">
                                            <button class="btn text-warning dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Inprogress</button>
                                            <ul class="dropdown-menu">
                                            <li><a class="dropdown-item text-success" href="#">To Do</a></li>
                                            <li><a class="dropdown-item text-warning" href="#">Inprogress</a></li>
                                            <li><a class="dropdown-item text-primary" href="#">Done</a></li>
                                            </ul>
                                        </div>
                                        <div class="task-title">
                                            <span class="card-text">{{ $task->title}}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-2 col-md-2 col-lg-2 text-end">
                                        <div class="task-date">
                                            <span class="card-text mr-5">{{ $task->date}}</span>
                                        </div>
                                        <div class="task-action">
                                            <a href="#" class="text-primary" title="Edit"><i class="mdi mdi-table-edit"></i></a>
                                            <a href="#" class="text-warning" title="Tresh"><i class="mdi mdi-delete-forever"></i></a>
                                            <a href="#" class="text-danger" title="Delete"><i class="mdi mdi-delete"></i></a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

                <div class="to-do-tasks">
                    <div class="card-header text-white">
                        <strong>To Do:</strong>
                    </div>
                    @if(isset($tasks))
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($tasks[1] as $task)
                            <div class="card-body mb-1" id="single_{{$task->id}}">
                                <div class="row">
                                    <div class="col-sm-10 col-md-10 col-lg-10 text-start">
                                        <span class="text-white bg-success task-number">{{ $i++ }}</span>
                                        <div class="dropdown">
                                            <button class="btn text-success dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">To Do</button>
                                            <ul class="dropdown-menu">
                                            <li><a class="dropdown-item text-success" href="#">To Do</a></li>
                                            <li><a class="dropdown-item text-warning" href="#">Inprogress</a></li>
                                            <li><a class="dropdown-item text-primary" href="#">Done</a></li>
                                            </ul>
                                        </div>
                                        <div class="task-title">
                                            <span class="card-text">{{ $task->title}}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-2 col-md-2 col-lg-2 text-end">
                                        <div class="task-date">
                                            <span class="card-text mr-5">{{ $task->date}}</span>
                                        </div>
                                        <div class="task-action">
                                            <a href="javascript:void(0);" class="text-primary" title="Edit" onclick="taskEdit({{$task->id}})"><i class="mdi mdi-table-edit"></i></a>
                                            <a href="javascript:void(0);" class="text-warning" title="Tresh" onclick="taskRemove({{$task->id}},'tresh')"><i class="mdi mdi-delete-forever"></i></a>
                                            <a href="javascript:void(0);" class="text-danger" title="Delete" onclick="taskRemove({{$task->id}},'delete')"><i class="mdi mdi-delete"></i></a>
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
    <script>
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
                    if(type == 'tresh'){
                        $("#successMessage").text('Successfully Tresh!').fadeIn();
                    }else{
                        $("#successMessage").text('Successfully Delete!').fadeIn();
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
