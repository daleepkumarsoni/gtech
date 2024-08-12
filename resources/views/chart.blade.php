<!DOCTYPE html>
<html>
<head>
    <title>Task Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div style="width: 50%; margin: auto;">
        <canvas id="taskChart"></canvas>
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
</body>
</html>
