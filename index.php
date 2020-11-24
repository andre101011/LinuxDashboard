<?php
include './partials/navigation.php';
?>

<div class="container" style="padding-top: 2rem;">
    <div class="row row-cols-1 row-cols-md-3">
        <div class="col mb-4">
            <div class="card">
                <div>
                    <?php
                    include './partials/gauge_data.php';
                    ?>
                </div>
                <div class="card-body">

                    <h5 class="card-title">Consumo de CPU</h5>
                    <p class="card-text">Valor promedio de acuerdo al número de núcleos de los últimos 5
                        minutos, últimos 10 minutos y últimos 15 minutos</p>
                </div>
              
            </div>
        </div>
        <div class="col mb-4">
            <div class="card">

                <?php
                include './partials/donut_chart_data.php';
                ?>

                <div class="card-body">
                    <h5 class="card-title">Memoria RAM</h5>
                    <p class="card-text">Memoria libre y
                        ocupada en porcentaje y en valor</p>
                </div>
              
            </div>
        </div>
        <div class="col mb-4">
            <div class="card">
                <?php
                include './partials/treemap_data.php';
                ?>
                <div class="card-body">
                    <h5 class="card-title">​ Disco duro</h5>

                    <?php
                    echo "'df | tail -n +2 | awk {'print \"['\'\" $6 \"'\', \" $3 \"],\"\'}\'";
                    $salida = shell_exec(`'df | tail -n +2 | awk {'print "['\''" $6 "'\'', " $3 "],"'}'`);
                    echo "<pre>$salida</pre>";

                    ?>
                    <p class="card-text">Porcentaje de ocupación de cada
                        volumen</p>
                </div>
                
            </div>
        </div>
    </div>
</div>