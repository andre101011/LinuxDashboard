<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard-Linux</title>

    <link rel="stylesheet" href="/LinuxDashboard/assets/css/style.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

</head>

<body>
    <?php
    include './partials/navigation.php';
    ?>
    <div class="container" style="padding-top: 2rem;">
        <div class="card-deck">
            <div class="card">
                <?php
                include './partials/gauge_data.php';
                ?>
                <div class="card-body">
                    <h5 class="card-title">Consumo de CPU</h5>
                    <p class="card-text">Valor promedio de acuerdo al número de núcleos de los último minuto, últimos 10 minutos y últimos 15 minutos.</p>
                    <?php
                    include './partials/cputable.php';
                    ?>
                </div>
                <div class="card-footer">
                    <?php

                    exec("nproc", $numero_nucleos);
                    exec(" uptime|awk '{print $8,$9,$10}'", $av);
                 
                    $data=explode(" ",$av[0]);
                    $av1=substr($data[0],0,strlen($data[0])-1);
                    $av2=substr($data[1],0,strlen($data[1])-1);
                    $av3=$data[2];
                   
                    $av3=(str_replace(",", ".", $av3)/$numero_nucleos[0])*100;
                    $av2=(str_replace(",", ".", $av2)/$numero_nucleos[0])*100;
                    $av1=(str_replace(",", ".", $av1)/$numero_nucleos[0])*100;

                    echo $av1.";";
                    echo $av2.";";
                    echo $av3;
                    ?>
                    <small class="text-muted">Se actualiza cada 5 minutos </small>
                </div>
            </div>
            <div class="card">
                <?php
                include './partials/donut_chart_data.php';
                ?>
                <div class="card-body">
                    <h5 class="card-title">Consumo de RAM</h5>
                    <p class="card-text">Memoria libre y ocupada en porcentaje y en valor (GB)</p>
                    <?php
                    include './partials/ramtable.php';
                    ?>
                </div>
                <div class="card-footer">
                    <small class="text-muted">Se actualiza cada 5 minutos </small>
                </div>
            </div>
            <div class="card">
                <?php
                include './partials/treemap_data.php';
                ?>
                <div class="card-body">
                    <h5 class="card-title">Ocupación Disco Duro</h5>
                    <p class="card-text">Mapa que contiene tamaños de volumenes y porcentaje de ocupación</p>
                </div>
                <div class="card-footer">
                    <small class="text-muted">Se actualiza cada 5 minutos </small>
                </div>
            </div>
        </div>
    </div>
</body>

</html>