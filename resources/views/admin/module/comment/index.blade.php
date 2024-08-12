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

                                            <div class="modal-body">
                                                <form action="{{ route('employe.comment.task', $tasks->id) }}" method="POST">
                                                    @csrf
                                  
                                                    <div class="row mb-3">
                                                        <div class="col-md-6">
                                                            <label class="form-label" for="inputEmail4">Comment</label>
                                                            <textarea name="comment" id="" cols="100" rows="5"></textarea>
                                                           
                                                        </div>
                                                    </div>


                                                    <button type="submit" class="btn btn-primary">Comment</button>
                                                </form>
                                            </div>

                                            <br><br>

                                            <table class="table lms_table_active3 dataTable no-footer dtr-inline"
                                                id="DataTables_Table_1" role="grid"
                                                aria-describedby="DataTables_Table_1_info" style="width: 886px;">
                                                <thead>
                                                    <tr role="row">
                                                        <th>Task Name</th>
                                                        <th>User Name</th>
                                                        <th>Comment</th>
                                                        
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($comments as $comment)
                                                    <tr>
                                                        <td>{{ $comment->task->name ?? 'N/A' }}</td>
                                                        <td>{{ $comment->user->name ?? 'N/A' }}</td>
                                                        <td>{{ $comment->comment }}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
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
