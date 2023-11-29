    @include('admin.master.header')
        <!-- partial -->
        <div class="content-wrapper">
            <div class="row">
                <x-module-container>
                    <header>
                        <div class="row">
                            <div class="col-md-8 module-text">
                                <h2 class="module-title text-gray-900 dark:text-gray-100">Add Task</h2>
                            </div>
                        </div>
                    </header>
                    <div class="card">
                        <div class="card-body">
                        <form action="{{ route('task.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                            <label for="title">Task Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Enter task title">
                            </div>
                            <div class="form-group">
                            <label for="description">Task Description</label>
                            <textarea type="textarea" class="form-control" id="description" name="description"></textarea>
                            </div>
                            <div class="form-group">
                            <label for="date">Due Date</label>
                            <input type="date" class="form-control" id="date" name="date" placeholder="Enter due date">
                            </div>
                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                        </form>
                        </div>
                    </div>
                </x-module-container>
            </div>
        </div>
        <script type="text/javascript" src='https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js' referrerpolicy="origin"></script>
        <script type="text/javascript">
            tinymce.init({
                selector: '#description',
                height: 300,
                plugins: [
                'advlist', 'autolink', 'link', 'image', 'lists', 'charmap', 'preview', 'anchor', 'pagebreak',
                'searchreplace', 'wordcount', 'visualblocks', 'visualchars', 'code', 'fullscreen', 'insertdatetime',
                'media', 'table', 'emoticons', 'template', 'help'
                ],
                toolbar: 'undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | ' +
                'bullist numlist outdent indent | link image | print preview media fullscreen | ' +
                'forecolor backcolor emoticons | help',
                menu: {
                favs: { title: 'My Favorites', items: 'code visualaid | searchreplace | emoticons' }
                },
                menubar: 'favs file edit view insert format tools table help',
                content_css: 'css/content.css'
            });
        </script>
    @include('admin.master.footer')
