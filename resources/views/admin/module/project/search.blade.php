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
                                    <h4>Search </h4>
                                    <form method="GET" action="{{ route('admin.search') }}">
                                    <div class="box_right d-flex lms_block">
                                    <label>Status:
                                        <select name="status" class="form-control">
                                            <option value="">All</option>
                                            <option value="pending">Pending</option>
                                            <option value="in_progress">In Progress</option>
                                            <option value="completed">Completed</option>
                                        </select>
                                        </label>
                                        <label>Priority:
                                    <select name=priority class="form-control">
                                        <option value="">All</option>
                                        <option value="low">Low</option>
                                        <option value="medium">Medium</option>
                                        <option value="high">High</option>
                                    </select>
                                    </label>
                                    <label>Due Date:
                        <input type="date" id="dueDateFilter" name=due_date  class="form-control"/>
                        </label>

                             <button type="submit" class="btn btn-primary">Apply Filters</button>
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
                                                        <th>status</th>
                                                        <th>priority</th>
                                                        <th>End date</th>
                                                        
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach ($tasks as $task)
                                                <tr role="row">
                                                        <th>{{ $task->status }}</th>
                                                        <th>{{ $task->priority }}</th>
                                                        <th>{{ $task->due_date }}</th>
                                                        </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- <div class="dataTables_info" id="DataTables_Table_1_info" role="status"
                                            aria-live="polite">Showing 1 to 10 of 11 entries</div> -->

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
