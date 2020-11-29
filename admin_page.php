<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard-Linux</title>

    <link rel="stylesheet" href="/LinuxDashboard/assets/css/style.css">
    <link rel="stylesheet" href="/LinuxDashboard/assets/css/bootstrap.min.css">

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


</head>

<body>





    <?php
    include './partials/navigation.php';
    ?>



    <div class="card border-primary mb-3" style="max-width: 18rem;">
        <div class="card-header">Lista de usuarios</div>
        <div class="card-body text-primary">
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">nombre</th>
                        <th scope="col">Opciones</th>

                    </tr>
                </thead>
                <tbody>

                    <?php

                    exec('/bin/bash -c "getent passwd {1000..2000}"', $salida);

                    $i = 1;
                    foreach ($salida as $linea) {

                        $salida = explode(":", $linea)[0];
                        echo '<tr>
                <th scope="row">' . $i . '</th>
                <td>' . $salida . '</td>
                <td> <button type="button" class="btn btn-danger">Eliminar</button>
               <button type="button" class="btn btn-primary">Editar</button></td>
                </tr>  
                
                <tr>

                ';
                        $i += 10;
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </div>

    <form method="POST">
        <div class="form-row">
            <div class="col-md-4 mb-3">
                <label for="validationDefault01">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="Mark" required>
            </div>

            <div class="col-md-4 mb-3">
                <label for="validationDefault02">Contraseña</label>
                <input type="text" class="form-control" id="password" name="password" value="1234q351" required>
            </div>
            <select class="custom-select custom-select-sm" name="select">
                <option selected>"Shell"</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
            </select>


    </form>
    <button class="btn btn-primary" type="submit">Agregar</button>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        $nombre = $_POST["nombre"];
        $password = $_POST["password"];
        echo $password;
        echo $nombre;
        exec("sudo useradd -m -s" . "/bin/bash" . " " . $nombre, $salida, $res);

        echo $res;
        if ($res) {
            exec("whoami", $salida2, $res2);
            foreach ($salida2 as $linea) {
                echo $linea;
            }
            //exec("echo '".$nombre.":".$password."'| sudo chpasswd");
        }
    }
    ?>

</body>



</html>