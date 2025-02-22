<?php
include_once "../../conexion.php";
session_start();

// Habilitar el modo de errores de MySQLi
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$fecha = $_POST['fecha'];
$tipo_comida = $_POST['tipo_comida'];
$gl_1h = $_POST['gl_1h'];
$gl_2h = $_POST['gl_2h'];
$raciones = $_POST['raciones'];
$insulina = $_POST['insulina'];
$deporte = $_POST['deporte'];
$lenta = $_POST['lenta'];
$glucosa_hiper = $_POST['glucosa_hiper'] ?? null;
$hora_hiper = $_POST['hora_hiper'] ?? null;
$correccion = $_POST['correccion'] ?? null;
$glucosa_hipo = $_POST['glucosa_hipo'] ?? null;
$hora_hipo = $_POST['hora_hipo'] ?? null;
$id_usuario = $_SESSION['id_usu'];

// Verificar los datos antes de la modificación
echo "Datos a modificar: tipo_comida=$tipo_comida, gl_1h=$gl_1h, gl_2h=$gl_2h, raciones=$raciones, insulina=$insulina, fecha=$fecha, id_usuario=$id_usuario, deporte=$deporte, lenta=$lenta, glucosa_hiper=$glucosa_hiper, hora_hiper=$hora_hiper, correccion=$correccion, glucosa_hipo=$glucosa_hipo, hora_hipo=$hora_hipo";

// Actualizar registros en la tabla COMIDA según la fecha y tipo de comida
$sql_update_comida = "UPDATE COMIDA SET gl_1h = ?, gl_2h = ?, raciones = ?, insulina = ? WHERE fecha = ? AND tipo_comida = ? AND id_usu = ?";
$stmt_update_comida = $conn->prepare($sql_update_comida);
$stmt_update_comida->bind_param("iiisssi", $gl_1h, $gl_2h, $raciones, $insulina, $fecha, $tipo_comida, $id_usuario);

if ($stmt_update_comida->execute()) {
    echo "Datos modificados correctamente en COMIDA.";
} else {
    echo "Error al modificar datos en COMIDA: " . $stmt_update_comida->error;
}

// Actualizar registros en la tabla CONTROL_GLUCOSA según la fecha y id_usu
$sql_update_glucosa = "UPDATE CONTROL_GLUCOSA SET deporte = ?, lenta = ? WHERE fecha = ? AND id_usu = ?";
$stmt_update_glucosa = $conn->prepare($sql_update_glucosa);
$stmt_update_glucosa->bind_param("iisi", $deporte, $lenta, $fecha, $id_usuario);

if ($stmt_update_glucosa->execute()) {
    echo "Datos modificados correctamente en CONTROL_GLUCOSA.";
} else {
    echo "Error al modificar datos en CONTROL_GLUCOSA: " . $stmt_update_glucosa->error;
}

// Actualizar registros en la tabla HIPERGLUCEMIA según la fecha y id_usu
if (!empty($glucosa_hiper) && !empty($hora_hiper) && !empty($correccion)) {
    $sql_update_hiper = "UPDATE HIPERGLUCEMIA SET glucosa_hiper = ?, hora_hiper = ?, correccion = ? WHERE fecha = ? AND id_usu = ?";
    $stmt_update_hiper = $conn->prepare($sql_update_hiper);
    $stmt_update_hiper->bind_param("isisi", $glucosa_hiper, $hora_hiper, $correccion, $fecha, $id_usuario);

    if ($stmt_update_hiper->execute()) {
        echo "Datos modificados correctamente en HIPERGLUCEMIA.";
    } else {
        echo "Error al modificar datos en HIPERGLUCEMIA: " . $stmt_update_hiper->error;
    }
}

// Actualizar registros en la tabla HIPOGLUCEMIA según la fecha y id_usu
if (!empty($glucosa_hipo) && !empty($hora_hipo)) {
    $sql_update_hipo = "UPDATE HIPOGLUCEMIA SET glucosa_hipo = ?, hora_hipo = ? WHERE fecha = ? AND id_usu = ?";
    $stmt_update_hipo = $conn->prepare($sql_update_hipo);
    $stmt_update_hipo->bind_param("issi", $glucosa_hipo, $hora_hipo, $fecha, $id_usuario);

    if ($stmt_update_hipo->execute()) {
        echo "Datos modificados correctamente en HIPOGLUCEMIA.";
    } else {
        echo "Error al modificar datos en HIPOGLUCEMIA: " . $stmt_update_hipo->error;
    }
}
?>