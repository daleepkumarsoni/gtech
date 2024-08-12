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
                                                <form action="{{ route('admin.project.update',$project->id) }}" method="POST">
                                                    @csrf
                                                    <div class="row mb-3">
                                                        <div class="col-md-6">
                                                            <label class="form-label" for="inputEmail4">Name</label>
                                                            <input type="text" class="form-control" name="name" id="inputName" placeholder="Name" value="{{$project->name}}">
                                                        </div>
                                                        <div class=" col-md-6">
                                                            <label class="form-label" for="inputPassword4">Description</label>
                                                            <input type="text" class="form-control" name="description" id="inputPassword4"
                                                                placeholder="Description" value="{{$project->description}}">
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="inputAddress">Start date</label>
                                                        <input type="date" class="form-control" name="start_date" id="inputAddress"
                                                            placeholder="Start Date" value="{{$project->start_date}}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="inputAddress2">End Date</label>
                                                        <input type="date" class="form-control" name="end_date" id="inputAddress2"
                                                            placeholder="End Date" value="{{$project->end_date}}">
                                                    </div>
                            
                                                    <button type="submit" class="btn btn-primary">Update</button>
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
