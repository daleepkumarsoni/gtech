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
                                    <div class="box_right d-flex lms_block">

                                        
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
                                                                <a href="{{route('admin.comment.task.list',$tasks->id)}}" class="btn btn-info btn-sm">Comment</a>
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


@endsection
