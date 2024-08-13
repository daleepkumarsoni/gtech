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
                               
                                <div class="QA_table mb_30">
                                    <div style="width: 50%; margin: auto;">
                                        <canvas id="taskChart"></canvas>
                                    </div>
                                    <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper no-footer">
                                        <div class="contanier" style="margin-left: 20%">

                                           
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
    <script>
        
        var ctx = document.getElementById('taskChart').getContext('2d');
        var chartData = @json($chartData);

        var labels = Object.keys(chartData);
        var data = {
            labels: labels,
            datasets: [
                {
                    label: 'Low Priority',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1,
                    data: labels.map(function(status) {
                        return chartData[status]['low'] || 0;
                    })
                },
                {
                     label: 'Medium Priority',
                    backgroundColor: 'rgba(255, 206, 86, 0.2)',
                    borderColor: 'rgba(255, 206, 86, 1)',
                    borderWidth: 1,
                    data: labels.map(function(status) {
                        return chartData[status]['medium'] || 0;
                    })
                },
                {
                    label: 'High Priority',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1,
                    data: labels.map(function(status) {
                        return chartData[status]['high'] || 0;
                    })
                }
            ]
        };

        var taskChart = new Chart(ctx, {
            type: 'bar', // You can change this to 'line', 'pie', etc.
            data: data,
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    
@endsection
