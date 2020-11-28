
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load("current", {
      packages: ["corechart"]
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Estado", "Cantidad"],
        ["Libre",
          <?php

          $memoria_total = exec("free | head -2 |tail -1| awk '{print $2}'");
          $memoria_usada = exec("free | head -2 |tail -1| awk '{print $3}'");
          echo ($memoria_total - $memoria_usada) / 1048576;
          ?>

        ],
        ["En Uso",

          <?php

          $memoria_usada = exec("free | head -2 |tail -1| awk '{print $3}'");
          echo $memoria_usada / 1048576;
          ?>


        ],
      ]);

      var options = {
        title: 'Uso de memoria en GB',
        pieHole: 0.4,
      };

      var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
      chart.draw(data, options);
    }
  </script>
</head>


  <div id="donutchart" style="width: 430px; height: 200px;"></div>
