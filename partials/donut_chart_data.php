<script>
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
        echo ($memoria_total-$memoria_usada)/1048576;
        ?>

      ],
      ["En Uso",

        <?php

        $memoria_usada = exec("free | head -2 |tail -1| awk '{print $3}'");
        echo $memoria_usada/1048576;
        ?>


      ],

    ]);

    var options = {
      title: "Uso de la memoria en GB",
      is3D: true,
    };

    var chart = new google.visualization.PieChart(
      document.getElementById("piechart_3d")
    );
    chart.draw(data, options);
  }
</script>

<div id="piechart_3d" style="width: 20rem; height: 20rem;"></div>