</div>
    </div>
    <script src="../utility/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../utility/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../utility/popper.js"></script>
    <script src="../utility/bootstrap.js"></script>
    <script src="../utility/feather.js"></script>
    <script src="../utility/web.js"></script>
    <script>
      feather.replace()
    </script>
    <script src="../utility/Chart.js"></script>

    <script>
      // social engagement graph
      var ctx = document.getElementById("socialEngage");
      var myChart = new Chart(ctx, {
        type: 'polarArea',
        data: {
          labels: ['Facebook', 'Website', 'Word by Mouth', 'Friend', 'Myself' ],
          datasets: [{
            data: [56, 78, 40, 45, 29],
            lineTension: 0,
            backgroundColor: 'transparent',
            borderColor: '#8797b0',
            borderWidth: 4,
            pointBackgroundColor: '#93ba30'
          }]
        },
        options: {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: false
              }
            }]
          },
          legend: {
            display: false,
          }
        }
      });
    </script>

<script>
      // social engagement graph
      var ctx = document.getElementById("daySales");
      var myChart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 23, 14, 15],
          datasets: [{
            data: [10, 12, 13, 40, 45, 16, 37, 28, 19, 30, 21, 22, 13, 40, 22],
            lineTension: 0,
            backgroundColor: 'transparent',
            borderColor: '#8797b0',
            borderWidth: 4,
            pointBackgroundColor: '#93ba30'
          }]
        },
        options: {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: false
              }
            }]
          },
          legend: {
            display: false,
          }
        }
      });
    </script>

    <script>
      // monthly sales from 2012 to current year graph
      var ctx = document.getElementById("myChart");
      var myChart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: <?php echo json_encode($month); ?>,
          datasets: [{
            data: <?php echo json_encode($total); ?>,
            lineTension: 0,
            backgroundColor: 'transparent',
            borderColor: '#007bff',
            borderWidth: 4,
            pointBackgroundColor: '#007bff'
          }]
        },
        options: {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: false
              }
            }]
          },
          legend: {
            display: false,
          }
        }
      });
    </script>

<script>
  // top clients for 2018 and 2019 graph
      var ctx = document.getElementById("topChart");
      var myChart = new Chart(ctx, {
        type: 'horizontalBar',
        data: {
          labels: <?php echo json_encode($name); ?>,
          datasets: [{
            data: <?php echo json_encode($frequency); ?>,
            lineTension: 0,
            backgroundColor: 'black',
            borderColor: '#e1e1e1',
            borderWidth: 4,
            pointBackgroundColor: '#f00f00'
          }]
        },
        options: {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: false
              }
            }]
          },
          legend: {
            display: false,
          }
        }
      });
    </script>

<script>
  // monthly sales report for the current year
      var ctx = document.getElementById("monthlyReportChart");
      var myChart = new Chart(ctx, {
        type: 'horizontalBar',
        data: {
          labels: <?php echo json_encode($monthName); ?>,
          datasets: [{
            data: <?php echo json_encode($monthTotal); ?>,
            lineTension: 0,
            backgroundColor: '#729c7f',
            borderColor: '#99906a',
            borderWidth: 4,
            pointBackgroundColor: '#f00f00'
          }]
        },
        options: {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: false
              }
            }]
          },
          legend: {
            display: false,
          }
        }
      });
    </script>

<script src="../utility/jquery.inputmask.min.js"></script>
<script src="../utility/inputmask.min.js"></script>

</body>
</html>