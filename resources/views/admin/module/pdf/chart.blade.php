@extends('admin.module.layouts')
@section('content')

    <div id="container"></div>
            
@endsection
@section('after_scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

    <script src="https://code.highcharts.com/stock/highstock.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            var deviceId = "{{ $entry->id }}"; // Ensure this is correctly set

            // Set default dates for the past week, including time
            const today = new Date();
            const todayISO = today.toISOString().split('.')[0]; // Remove milliseconds
            const oneWeekAgo = new Date();
            oneWeekAgo.setDate(oneWeekAgo.getDate() - 7);
            const pastWeekDateISO = oneWeekAgo.toISOString().split('.')[0]; // Remove milliseconds

            $('#start_date').val(pastWeekDateISO);
            $('#end_date').val(todayISO);

            // Load chart data with default dates
            loadChartData(pastWeekDateISO, todayISO);

            // Filter button click event
            $('#filter-button').on('click', function() {
                const startDate = $('#start_date').val();
                const endDate = $('#end_date').val();
                loadChartData(startDate, endDate);
            });

            function loadChartData(startDate, endDate) {
                const names = ['Temperature', 'Humidity'];

                const promises = names.map(name => new Promise(resolve => {
                    (async () => {
                        let apiUrl =
                            `{{ route('admin.chart.view', ['id' => ':slug']) }}`;
                        apiUrl = apiUrl.replace(':id', name.toLowerCase());
                        
                        try {
                            const response = await fetch(apiUrl);
                            const data = await response.json();
                            resolve({
                                name,
                                data: data.data
                            });
                        } catch (error) {
                            console.error(`Error fetching data for ${name}:`, error);
                            resolve({
                                name,
                                data: []
                            });
                        }
                    })();
                }));

                Promise.all(promises).then(series => {

                    Highcharts.stockChart('container', {
                        rangeSelector: {
                            enabled: false // Disable the date range picker
                        },
                        yAxis: {
                            labels: {
                                format: '{#if (gt value 0)}+{/if}{value}%'
                            },
                            plotLines: [{
                                value: 0,
                                width: 2,
                                color: 'silver'
                            }]
                        },
                        plotOptions: {
                            series: {
                                compare: 'percent',
                                showInNavigator: true
                            }
                        },
                        tooltip: {
                            pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.change}%)<br/>',
                            valueDecimals: 2,
                            split: true,
                            xDateFormat: '%Y-%m-%d %I:%M:%S %p' // Format date and time with AM/PM
                        },
                        series
                    });
                });
            }
        });
    </script>
@endsection
