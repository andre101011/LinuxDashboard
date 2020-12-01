<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">

<title>Dashboard-Linux</title>

<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>



</head>
<body>

    <?php
    include './partials/navigation.php';
    ?>
<div class="container-xl">
	<div class="table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2>Administrar <b>Usuarios</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Añadir usuario</span></a>
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>

						<th>#</th>
						<th>Nombre</th>
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody>
 				<?php

                    exec('/bin/bash -c "getent passwd {1000..2000}"', $salida);

                    $i = 1;
                    foreach ($salida as $linea) {

                        $salida = explode(":", $linea)[0];
						echo '
						<tr>
							<th scope="row">' . $i . '</th>
							<td>' . $salida . '</td>
							<td> <button type="button" class="btn btn-danger">Eliminar</button>
							<button type="button" class="btn btn-primary">Editar</button></td>
						</tr>  
						';
                        $i += 10;
                    }
                    ?>
				</tbody>
			</table>
			
		</div>
	</div>        
</div>

<div id="addEmployeeModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="POST">
				<div class="modal-header">						
					<h4 class="modal-title">Añadir usuario</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<div class="form-group">
						<label>Nombre</label>
						<input type="text" id="nombre" name="nombre" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Contraseña</label>
						<input type="password" id="password" name="password" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="shellselect">Seleccione el Shell</label>
						<select class="custom-select custom-select-sm" name="select">
							<option selected>"Shell"</option>
							<option value="1">One</option>
							<option value="2">Two</option>
							<option value="3">Three</option>
						</select>
					</div>				
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
					<input type="submit" class="btn btn-success" value="Guardar">
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
				</div>
			</form>

		</div>
	</div>
</div>

</body>
</html>