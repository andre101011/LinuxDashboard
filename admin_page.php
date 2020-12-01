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
<div class="container-xl" style="padding-top:2rem;">
	<div class="table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2>Administrar <b>Usuarios</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Añadir usuario</span></a>
<br></br>
<form method="POST" enctype="multipart/form-data">
 <span>Añadir usuarios desde un archivo csv</span>
<input type="file" id="file" name="file"  accept=".csv"></input>
<button type="submit" class="btn btn-success"> CREAR<button/>
</form>
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
							<td> 
                            <a type="button" href="/LinuxDashboard/admin_page.php?nombre='.$salida.'-r "                            class="btn btn-danger">Eliminar</a>
							<a type="button"  href="/LinuxDashboard/admin_page.php?nombre='.$salida.'-u "   class="btn btn-primary">Editar</a>
                            </td>
						</tr>  
						';
                        $i += 1;
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
			<form method="POST" enctype="multipart/form-data">
				<div class="modal-header">						
					<h4 class="modal-title" id="titulo" >Añadir usuario</h4>
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
							
							<option value="/bin/sh" selected>/bin/sh</option>
							<option value="/bin/bash">/bin/bash</option>
						
						</select>
					</div>				
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
					<input type="submit"  class="btn btn-success" value="Guardar">

				</div>
			</form>

		</div>
	</div>


</div>

					<?php
						if ($_SERVER['REQUEST_METHOD'] == "POST") {


if(is_null($_FILES['file']['name'])){
echo "holaaa";

							$nombre = $_POST["nombre"];
							$password = $_POST["password"];
                            $tipo = $_POST["select"];
						
							exec("sudo useradd -m -s" . $tipo . " " . $nombre, $salida, $res);						
							exec("echo '".$nombre.":".$password."'| sudo chpasswd");
}else{


$nombre_archivo =$_FILES['file']['tmp_name'];


$archivo = fopen($nombre_archivo, "r");
$data;
//Lo recorremos
while (($datos = fgetcsv($archivo, ",")) == true) 
{
  $num = count($datos);
  $linea++;
  //Recorremos las columnas de esa linea
    $cont=0;
  for ($columna = 0; $columna < $num; $columna++) 
      {

if($cont<2){
    $data.=$datos[$columna]."-";
    $cont+=1;
}else{
    $cont=0;
    $data.=$datos[$columna].";";
}


     }
}
//Cerramos el archivo
fclose($archivo);

echo $data;

$filas=explode(";",$data);

foreach($filas as $fila){

    $user=explode("-",$fila)[0];
    $pass=explode("-",$fila)[1];
    $shell=explode("-",$fila)[2];

						
	exec("sudo useradd -m -s" . $shell . " " . $user, $salida,$res);						
	exec("echo '".$user.":".$pass."'| sudo chpasswd");


}

}

echo "<script> window.location.assign('/LinuxDashboard/admin_page.php')</script>";

}


							
					

?>





<?php
if ($_SERVER['REQUEST_METHOD'] == "GET") {

							$nombre = $_GET["nombre"];
							$accion=explode("-",$nombre);


if($accion[1]=="r"){

exec("sudo userdel -r ".$accion[0]);
echo "<script> window.location.assign('/LinuxDashboard/admin_page.php')</script>";

}
if($accion[1]=="u"){
exec("sudo passwd ".$nombre,$pass);
    echo "<script>

$('#addEmployeeModal').modal('show');
$('#nombre').val("."' ".$accion[0]."' ".");
$('#password').val("."' ".$pass."' ".");
$('#titulo').text('Editar Usuario');

</script>";


}
}
?>


</body>
</html>
