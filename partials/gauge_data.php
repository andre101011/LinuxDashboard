<script type="text/javascript">

        /**  Script creado por:
        Andres Llinas
        Neyder Figueroa
        Daniel Bonilla
        */
        


  google.charts.load('current', {
    'packages': ['gauge']
  });
  google.charts.setOnLoadCallback(drawChart);
´
  /** Funcion que consigue los datos mediante comandos linux y los devuelve con el formato requerido */
  function drawChart() {

    var data = google.visualization.arrayToDataTable([
      ['Label', 'Value'],
   
      <?php

      #Calculo de numero de procesadores y porcentaje de uso del procesador en diferentes tiempos
      exec("nproc", $numero_nucleos);
      exec(" uptime|awk '{print $8,$9,$10}'", $av);

      $data = explode(" ", $av[0]);
      $av1 = substr($data[0], 0, strlen($data[0]) - 1);
      $av2 = substr($data[1], 0, strlen($data[1]) - 1);
      $av3 = $data[2];

      #con el substring luego se reemplaza las otras comas por puntos y se calcula el porcentaje
      $av3 = (str_replace(",", ".", $av3) / $numero_nucleos[0]) * 100;
      $av2 = (str_replace(",", ".", $av2) / $numero_nucleos[0]) * 100;
      $av1 = (str_replace(",", ".", $av1) / $numero_nucleos[0]) * 100;

      
      #luego se imprime el formato del arreglo tipo javascript
      echo "['1 Min',".$av1."],";
      echo "['5 Min',".$av2."],";
      echo "['15 Min',".$av3."],";
      ?>
    ]);

    var options = {
      width: 400,
      height: 110,
      redFrom: 90,
      redTo: 100,
      yellowFrom: 75,
      yellowTo: 90,
      minorTicks: 5
    };

    var chart = new google.visualization.Gauge(document.getElementById('chart_div'));

    chart.draw(data, options);


  }
</script>

<div id="chart_div" style=" margin: 2rem 0 2rem;"></div>