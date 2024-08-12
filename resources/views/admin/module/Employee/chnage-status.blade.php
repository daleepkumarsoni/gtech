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
                                                <form action="{{ route('employe.task.update', $tasks->id) }}" method="POST">
                                                    @csrf
                                                    
                                                    <div class="mb-3">
                                                        <label class="form-label" for="inputState">Status</label>
                                                        <select id="status" name="status" class="form-select">
                                                            <option value="{{ $tasks->id }}">{{ $tasks->status }}
                                                            </option>
                                                            <option value="pending">pending</option>
                                                            <option value="in_progress">In Progress</option>
                                                            <option value="completed">Completed</option>
                                                        </select>
                                                    </div>

                                                    <button type="submit" class="btn btn-primary">Comment</button>
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
