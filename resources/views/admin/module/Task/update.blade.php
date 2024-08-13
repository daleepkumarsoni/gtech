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
                                   
                                       
                                    </div>
                                </div>
                                <div class="QA_table mb_30">

                                    <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper no-footer">
                                        <div class="contanier" style="margin-left: 20%">

                                            <div class="modal-body">
                                                <form action="{{ route('manage.task.update',$tasks->id) }}" method="POST">
                                                    @csrf
                                                    <div class="row mb-3">
                                                        <div class="col-md-6">
                                                            <label class="form-label" for="inputEmail4">Name</label>
                                                            <input type="text" class="form-control" name="name" id="inputName" placeholder="Name" value="{{$tasks->name}}">
                                                        </div>
                                                        <div class=" col-md-6">
                                                            <label class="form-label" for="inputPassword4">Description</label>
                                                            <input type="text" class="form-control" name="description" id="inputPassword4"
                                                                placeholder="Description" value="{{$tasks->description}}">
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="inputAddress">Due date</label>
                                                        <input type="date" class="form-control" name="due_date" id="inputAddress"
                                                            placeholder="Start Date" value="{{$tasks->due_date}}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="inputState">Status</label>
                                                        <select id="status" name="status" class="form-select">
                                                            <option value="{{$tasks->status}}">{{$tasks->status}}</option>
                                                            <option value="pending">pending</option>
                                                            <option value="in_progress">In Progress</option>
                                                            <option value="completed">Completed</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="inputState">Priority</label>
                                                        <select id="priority" name="priority" class="form-select">
                                                            <option value="{{$tasks->priority}}">{{$tasks->priority}}</option>
                                                            <option value="low">low</option>
                                                            <option value="medium">medium</option>
                                                            <option value="high">high</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="inputState">Project</label>
                                                        <select id="project_id" name="project_id" class="form-select">
                                                            <option value="{{$tasks->project->id}}">{{$tasks->project->name}}</option>
                                                            @foreach($projet as $projet)
                                                            <option value="{{$projet->id }}">{{$projet->name }}</option>
                                                        @endforeach
                                                        </select>
                                                    </div>
                            
                                                    <div class="mb-3">
                                                        <label class="form-label" for="inputState">Employe</label>
                                                        <select id="assigned_to" name="assigned_to" class="form-select">
                                                            <option value="{{$tasks->assignee->id}}">{{$tasks->assignee->name}}</option>
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
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


   
@endsection
