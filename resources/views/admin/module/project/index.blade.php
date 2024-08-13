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
                                    <div class="alert alert-danger">
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
                                            Add Project
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
                                                        <th>Start date</th>
                                                        <th>End date</th>
                                                        <th>Edit</th>
                                                        <th>Delete</th>
                                                        <th>Task List</th>
                                                        <th>Download</th>
                                                        <!-- <th>Chart</th> -->
                                                        <th>Description</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($projects as $project)
                                                        <tr role="row" class="odd">

                                                            <td>{{ $project->name }}</td>
                                                            <td>{{ $project->start_date }}</td>
                                                            <td>{{ $project->end_date }}</td>
                                                            <td>
                                                                <a href="{{route('admin.project.edit',$project->id)}}" class="btn btn-info btn-sm">Edit</a>
                                                            </td>
                                                            <td>
                                                                <a href="{{route('admin.project.delete',$project->id)}}" class="btn btn-danger btn-sm">Delete</a>
                                                            </td>
                                                            <td>
                                                                <a href="{{route('admin.get.task.list',$project->id)}}" class="btn btn-success btn-sm">TaskList</a>
                                                            </td>
                                                            <td>
                                                                <a href="{{route('admin.download.pdf',$project->id)}}" class="btn btn-success">PDF</a>
                                                            </td>
                                                            <!-- <td>
                                                                <a href="{{route('admin.chart.view',$project->id)}}" class="btn btn-success">Chart</a>
                                                            </td> -->
                                                            <td>{{ $project->description }}</td>
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
                    <form action="{{ route('admin.add.project') }}" method="POST">
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
                            <label class="form-label" for="inputAddress">Start date</label>
                            <input type="date" class="form-control" name="start_date" id="inputAddress"
                                placeholder="Start Date">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="inputAddress2">End Date</label>
                            <input type="date" class="form-control" name="end_date" id="inputAddress2"
                                placeholder="End Date">
                        </div>

                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
