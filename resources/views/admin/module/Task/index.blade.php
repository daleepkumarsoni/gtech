@extends('admin.module.layouts')
@section('content')
    <div class="main_content_iner ">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="white_card card_height_100 mb_30">
                        <div class="white_card_header">
                            <div class="box_header m-0">
                                <div class="main-title">
                                    <h3 class="m-0">Data table 1</h3>
                                </div>
                            </div>
                        </div>
                        <div class="white_card_body">
                            <div class="QA_section">
                           
                                <div class="white_box_tittle list_header">
                               
                                    <h4>shorting Arrow</h4>
                                    @if ($errors->any())
                                    <div class="alert alert-danger ">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif
                                    <div class="box_right d-flex lms_block">
                                   
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal">
                                            Add Task
                                        </button>

                                        {{-- <div class="add_button ms-2">
                                            <a href="{{route('admin.add.project')}}"class="btn_1">Add Project</a>
                                        </div> --}}
                                    </div>
                                </div>
                                <div class="QA_table mb_30">

                                    <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper no-footer">
                                        <div class="contanier" style="margin-left: 20%">

                                            <table class="table lms_table_active3 dataTable no-footer dtr-inline"
                                                id="DataTables_Table_1" role="grid"
                                                aria-describedby="DataTables_Table_1_info" style="width: 886px;">
                                                <thead>
                                                    <tr role="row">
                                                        <th>Project Name</th>
                                                        <th>Task Name</th>
                                                        <th>Description</th>
                                                        <th>Due date</th>
                                                        <th>Update</th>
                                                        <th>Delete</th>
                                                        <th>Comment</th>
                                                        <th>Created By</th>
                                                        <th>Assigner  Name</th>
                                                        <th>Status</th>
                                                        <th>Priority</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($tasks as $tasks)
                                                        <tr role="row" class="odd">

                                                            <td>{{ $tasks->project->name }}</td>
                                                            <td>{{ $tasks->name }}</td>
                                                            <td>{{ $tasks->description }}</td>
                                                            <td>{{ $tasks->due_date }}</td>
                                                            <td>
                                                                <a href="{{route('manage.task.edit',$tasks->id)}}" class="btn btn-info btn-sm">Edit</a>
                                                            </td>
                                                            <td>
                                                                <a href="{{route('manage.task.delete',$tasks->id)}}" class="btn btn-danger btn-sm">Delete</a>
                                                            </td>
                                                            <td>
                                                                <a href="{{route('manager.comment.task.list',$tasks->id)}}" class="btn btn-info btn-sm">Comment</a>
                                                            </td>
                                                            <td>{{ $tasks->creator->name }}</td>
                                                            <td>{{ $tasks->assignee->name }}</td>
                                                            <td>{{ $tasks->status }}</td>
                                                            <td>{{ $tasks->priority }}</td>



                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="dataTables_info" id="DataTables_Table_1_info" role="status"
                                            aria-live="polite">Showing 1 to 10 of 11 entries</div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Project</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('manage.task.assign') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label" for="inputEmail4">Name</label>
                                <input type="text" class="form-control" name="name" id="inputName" placeholder="Name">
                            </div>
                            <div class=" col-md-6">
                                <label class="form-label" for="inputPassword4">Description</label>
                                <input type="text" class="form-control" name="description" id="inputPassword4"
                                    placeholder="Description">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="inputAddress">Due date</label>
                            <input type="date" class="form-control" name="due_date" id="inputAddress"
                                placeholder="Start Date">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="inputState">Status</label>
                            <select id="status" name="status" class="form-select">
                                <option selected="">Choose...</option>
                                <option value="pending">pending</option>
                                <option value="in_progress">In Progress</option>
                                <option value="completed">Completed</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="inputState">Priority</label>
                            <select id="priority" name="priority" class="form-select">
                                <option selected="">Choose...</option>
                                <option value="low">low</option>
                                <option value="medium">medium</option>
                                <option value="high">high</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="inputState">Project</label>
                            <select id="project_id" name="project_id" class="form-select">
                                <option selected="">Choose...</option>
                                @foreach($projet as $projet)
                                <option value="{{$projet->id }}">{{$projet->name }}</option>
                            @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="inputState">Employe</label>
                            <select id="assigned_to" name="assigned_to" class="form-select">
                                <option selected="">Choose...</option>
                                @foreach($employees as $employee)
                                <option value="{{$employee->id }}">{{$employee->name }}</option>
                            @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Assign Task</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
