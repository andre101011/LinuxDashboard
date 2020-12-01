<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['treemap']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Volumen', 'Parent', 'Tamaño', 'Porcentaje de uso (color)'],
            ['Global', null, 0, 0],
            <?php

            exec("df |tail -n +2| awk {'print \"['\''\" $6 \"'\'', \" $3+$2 \" , \" $5 \"],\"'}", $salida);
            $i = 10;
            foreach ($salida as $linea) {
                $linea = str_replace("]", "", $linea);
                $linea = str_replace("[", "", $linea);
                $volumen = explode(",", $linea)[0];
                $tamanio = explode(",", $linea)[1];

                $uso = explode(",", $linea)[2];
                $uso = str_replace('%', '', $uso) / 100.00;
                $parent = substr($volumen, 1, strrpos($volumen, '/'));
                if (strlen($volumen) == 1) {
                    $parent = 'null';
                }
                $parent = substr($parent, 0, -1);
                $parent = "'" . $parent .   "'";

                echo "[" . $volumen . "," . "'Global'," .  $tamanio . "," . $uso . "]," . "\n";
                $i += 10;
            }


            ?>

        ]);



        tree = new google.visualization.TreeMap(document.getElementById('treemap_div'));


        function showFullTooltip(row, size, value) {
            return '<div style="background:#fd9; padding:10px; border-style:solid">' +
                '<span style="font-family:Courier"><b>' + data.getValue(row, 0) +
                '</b>, ' + data.getValue(row, 1) + ', ' + data.getValue(row, 2) +
                ', ' + data.getValue(row, 3) + '</span><br>' +
                data.getColumnLabel(2) +
                ' : ' + size + '<br>' +
                data.getColumnLabel(3) + ': ' + value + ' </div>';
        }
        tree.draw(data, {
            maxColor: '#f00',
            minColor: '#ddd',
            minColor: '#0d0',
            headerHeight: 15,
            fontColor: 'black',
            showScale: true,
            width: '94%',
            generateTooltip: showFullTooltip,
            legend: {
                position: 'top'
            },
            width: '100%'
        });

    }
</script>


<div id="treemap_div"></div>