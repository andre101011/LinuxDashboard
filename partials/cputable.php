      <script type="text/javascript">
        google.charts.load('current', {
          'packages': ['table']
        });
        google.charts.setOnLoadCallback(drawTable);

        function drawTable() {
          var data = new google.visualization.DataTable();
          data.addColumn('string', 'Proceso');
          data.addColumn('number', 'Porcentaje');
          data.addRows([
            <?php

            exec("top -n1 -b | head -10 | tail -3 |awk '{print   $12 , $9}'", $cpu_usada);

            foreach ($cpu_usada as $linea) {

              $data = explode(" ", $linea);
              $texto = "['%s', {
        f: '%s '
      }],";
              echo sprintf($texto, $data[0], $data[1]);
            }

            ?>
          ]);

          var table = new google.visualization.Table(document.getElementById('table_div_cpu'));

          table.draw(data, {
            showRowNumber: true,
            width: '100%',
            height: '100%'
          });
        }
      </script>

      <div id="table_div_cpu"></div>