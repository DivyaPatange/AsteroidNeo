<!DOCTYPE html>
<html lang="en">
<head>
  <title>Asteroid Chart</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<section class="mt-4">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <h4>Neo Asteroid Details</h4>
                    </div>
                    <div class="card-body">                  
                        <h6>Fastest Asteroid ID :</h6>
                        <p>{{ $fastest_ast_id }}</p>
                        <h6>Fastest Asteroid in km/h :</h6>
                        <p>{{ $fastest_ast_speed }}</p>
                        <hr>
                        <h6>Closest Asteroid ID :</h6>
                        <p>{{ $closest_ast_id }}</p>
                        <h6>Closest Asteroid in km/h :</h6>
                        <p>{{ $closest_ast_distance }}</p>
                        <hr>
                        <h6>Average Size of the Asteroids in km (Min Diameter) :</h6>
                        <p>{{ $avgMinAsteroid }}</p>
                        <h6>Average Size of the Asteroids in km (Max Diameter) :</h6>
                        <p>{{ $avgMaxAsteroid }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="mt-4">
                <canvas id="asteroidChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
    <script>
        var ctx = document.getElementById('asteroidChart').getContext("2d");

        
        var asteroidChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!!$dateWiseAstJson!!},
                datasets: [{
                    label: "Total No. of Asteroid on Each Day",
                    borderColor: "#80b6f4",
                    pointBorderColor: "#80b6f4",
                    pointBackgroundColor: "#80b6f4",
                    pointHoverBackgroundColor: "#80b6f4",
                    pointHoverBorderColor: "#80b6f4",
                    pointBorderWidth: 10,
                    pointHoverRadius: 10,
                    pointHoverBorderWidth: 1,
                    pointRadius: 3,
                    fill: false,
                    borderWidth: 4,
                    data: {!!$dateWiseRecordAstJson!!}
                }]
            },
            options: {
                legend: {
                    position: "bottom"
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            fontColor: "rgba(0,0,0,0.5)",
                            fontStyle: "bold",
                            beginAtZero: true,
                            maxTicksLimit: 7,
                            padding: 20
                        },
                        gridLines: {
                            drawTicks: false,
                            display: false
                        }

                    }],
                    xAxes: [{
                        gridLines: {
                            zeroLineColor: "transparent"
                        },
                        ticks: {
                            padding: 20,
                            fontColor: "rgba(0,0,0,0.5)",
                            fontStyle: "bold"
                        }
                    }]
                }
            }
        });
    </script>
</body>
</html>
