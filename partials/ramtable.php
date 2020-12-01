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

            exec("ps -Ao pmem,comm |sort|tail -4 |head -3 |awk '{print $1,$2}'", $ram_usada);

            $i = 0;
            foreach ($ram_usada as $linea) {

              if ($i < 3) {
                $data = explode(" ", $linea);
                $texto = "['%s', {
        f: '%s'
      }],";
                echo sprintf($texto, $data[1], $data[0]);
              }
              $i += 1;
            }
            

            ?>

          ]);

          var table = new google.visualization.Table(document.getElementById('table_div_ram'));

          table.draw(data, {
            showRowNumber: true,
            width: '100%',
            height: '100%'
          });
        }
      </script>

      <div id="table_div_ram"></div>