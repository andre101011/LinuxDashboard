<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['treemap']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Volumen', 'Parent', 'size', 'Market increase/decrease (color)'],
            ['Global', null, 0, 0],
            <?php

            exec("df |tail -n +2| awk {'print \"['\''\" $6  \"'\'', \" $3 \"],\"'}", $salida);
           
            $i=10;
            foreach ($salida as $linea) {
                $linea = str_replace("]", "", $linea);
                $linea = str_replace("[", "", $linea);
                $volumen = explode(",", $linea)[0];
                $tamanio = explode(",", $linea)[1];
                //$linea= str_replace("]", ", 30, 10]", $linea);
                echo "[" . $volumen . "," . "'Global'," . $tamanio . ",".$i . "]," . "\n";
                $i+=10;
            }
            

            ?>

        ]);

        tree = new google.visualization.TreeMap(document.getElementById('treemap_div'));

        tree.draw(data, {
            minColor: '#f00',
            midColor: '#ddd',
            maxColor: '#0d0',
            headerHeight: 15,
            fontColor: 'black',
            showScale: true
        });

    }
</script>


<div id="treemap_div" style="width: 400x; height: 300px;"></div>