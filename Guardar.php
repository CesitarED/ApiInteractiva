<?php
// Configuración de cabeceras para permitir peticiones fetch
header("Access-Control-Allow-Origin: *");

// Conexión a la base de datos
$servidor = "localhost";
$usuario_db = "root";
$password_db = "";
$nombre_db = "JUEGO_NASA";
$puerto = 3307; // Puerto actualizado a 3307

$conexion = mysqli_connect($servidor, $usuario_db, $password_db, $nombre_db, $puerto);

if (!$conexion) {
    die('Error al conectar: ' . mysqli_connect_error());
}

// Recibir datos vía POST
if (isset($_POST['usuario']) && isset($_POST['puntaje']) && isset($_POST['nivel'])) {
    $usuario = mysqli_real_escape_string($conexion, $_POST['usuario']);
    $puntaje = (int)$_POST['puntaje'];
    $nivel = (int)$_POST['nivel'];

    // Insertar en la base de datos
    $sql = "INSERT INTO scores (usuario, puntaje, nivel) VALUES ('$usuario', $puntaje, $nivel)";

    if (mysqli_query($conexion, $sql)) {
        echo "Puntaje guardado exitosamente";
    } else {
        echo "Error al guardar: " . mysqli_error($conexion);
    }
} else {
    echo "Datos incompletos";
}

// Cerrar la conexión
mysqli_close($conexion);
?>
