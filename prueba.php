


<?php 

//Mostrar errores 
ini_set ('display_errors',1);
error_reporting(E_ALL);

//concexion
$conexion = new mysqli ("localhost","paola","dani321","Login");

//verificamos si hubo herrores de conexion
if ($conexion->connect_error){
die ("error de concexion:" . $conexion->connect_error);
}

//comprobamos formulario
if ($_SERVER["REQUEST_METHOD"]=="POST"){

	//capturamos datos del formulario
	$Nombre = $_POST["Nombre"];
	$Descripcion=$_POST["Descripcion"];


//preparar consulta segura para evitar sql injection
//los ss o ssi son los tipos de datps que resive el bindparam
$stmt=$conexion->prepare("INSERT INTO Usuarios(Nombre,Descripcion)VALUES(?,?)");
$stmt->bind_param("ss",$Nombre,$Descripcion);

//ejecutar insercion y mostrar resultado
if ($stmt->execute()){
	echo "Nuevo registro insertado correctamente";

}else {
	echo"Error al insertar : " . $stmt->error;

}
$stmt->close();
}
$conexion->close();
?>

<h2 style="color:blue; font-family:Arial, sans-serif;">Formulario de tu Opinion sobre lo aprendido en los permisos de linux</h2>
<form method="post">
Nombre:<input type="text" name="Nombre" required><br>


Descripcion:<input type="text" name="Descripcion" required><br>
<input type="submit" value="Enviar">
</form>
<a class="button"href="Panel.html">Volver</a>
