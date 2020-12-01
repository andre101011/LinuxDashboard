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
            <div class="card" >
                <?php
                    include './partials/gauge_data.php';
                ?>
                <div class="card-body">
                <h5 class="card-title">Consumo de CPU</h5>
                <p class="card-text">Valor promedio de acuerdo al número de núcleos de los últimos 5 minutos, últimos 10 minutos y últimos 15 minutos.</p>
                <?php
                    include './partials/cputable.php';
                ?>
                </div>
                <div class="card-footer">
                <small class="text-muted">Last updated 3 mins ago</small>
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
                <small class="text-muted">Last updated 3 mins ago</small>
                </div>
            </div>
            <div class="card">
                <?php
                    include './partials/treemap_data.php';
                ?>
                <div class="card-body">
                <h5 class="card-title">Ocupacion Disco Duro</h5>
                <p class="card-text">Mapa que contiene tamaños de volumenes y porcentaje de ocupacion</p>
                </div>
                <div class="card-footer">
                <small class="text-muted">Last updated 3 mins ago</small>
        </div>
    </div>
</div>
    </div>
</body>

</html>
