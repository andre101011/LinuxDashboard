
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">

        /**  Script creado por:
        Andres Llinas
        Neyder Figueroa
        Daniel Bonilla
        */
        
    google.charts.load("current", {
      packages: ["corechart"]
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Estado", "Cantidad"],
        ["Libre",
          <?php
          #Se crean las lineas de comando que devuelven las cifras de uso de la memoria RAM
          $memoria_total = exec("free | head -2 |tail -1| awk '{print $2}'");
          $memoria_usada = exec("free | head -2 |tail -1| awk '{print $3}'");
          echo ($memoria_total - $memoria_usada) / 1048576;
          ?>

        ],
        ["En Uso",

          <?php
          #Se formatea el comando free para extraer unicamente las cifras pertinentes
          $memoria_usada = exec("free | head -2 |tail -1| awk '{print $3}'");
          echo $memoria_usada / 1048576;
          ?>


        ],
      ]);
      /** Opciones graficas para el uso de la grafica de google charts */
      var options = {
        pieHole: 0.3,
        chartArea:{left:'0',width:'80%',height:'80%'},
        legend:{position:'bottom',alignment:'center'}
      };

      /**Se vincula la grafica al html y se pinta */
      var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
      chart.draw(data, options);
    }
  </script>
</head>


  <div id="donutchart" style="width: 430px; height: 200px;"></div>
