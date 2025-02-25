<?php
include_once "../../conexion.php";
session_start();

// Habilitar el modo de errores de MySQLi (muy útil para depurar)
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Verificar que el usuario esté autenticado y obtener su ID
$query = "SELECT id_usu FROM usuario WHERE id_usu = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $_SESSION['id_usu']);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($id_usuario);
$stmt->fetch();
$stmt->close();

// ---------------------
// CONTROL DE GLUCOSA
// ---------------------
if (isset($_POST['submit_control'])) {
    // Se esperan los campos: fecha, deporte y lenta
    $fecha   = $_POST['fecha_control'];
    $deporte = $_POST['deporte'];
    $lenta   = $_POST['lenta'];
    
    $sql_glucosa = "INSERT INTO CONTROL_GLUCOSA (fecha, deporte, lenta, id_usu) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql_glucosa);
    $stmt->bind_param("siii", $fecha, $deporte, $lenta, $id_usuario);
    
    if ($stmt->execute()) {
        
        exit();
    } else {
        echo "Error en CONTROL_GLUCOSA: " . $stmt->error;
    }
    $stmt->close();
}

// ---------------------
// COMIDA
// ---------------------
if (isset($_POST['submit_comida'])) {
    // Se esperan los campos: fecha, tipo_comida, gl_1h, gl_2h, raciones e insulina
    $fecha_comida = $_POST['fecha_comida'];
    $tipo_comida = $_POST['tipo_comida'];
    $gl_1h       = $_POST['gl_1h'];
    $gl_2h       = $_POST['gl_2h'];
    $raciones    = $_POST['raciones'];
    $insulina    = $_POST['insulina'];

    // Comprobar si ya existe un registro en COMIDA para la misma fecha, tipo de comida y usuario
    $sql_check = "SELECT COUNT(*) FROM COMIDA WHERE fecha = ? AND tipo_comida = ? AND id_usu = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("ssi", $fecha_comida, $tipo_comida, $id_usuario);
    $stmt_check->execute();
    $stmt_check->bind_result($count_comida);
    $stmt_check->fetch();
    $stmt_check->close();

    if ($count_comida == 0) {
        $sql_comida = "INSERT INTO COMIDA (tipo_comida, gl_1h, gl_2h, raciones, insulina, fecha, id_usu) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql_comida);
        $stmt->bind_param("siiiisi", $tipo_comida, $gl_1h, $gl_2h, $raciones, $insulina, $fecha_comida, $id_usuario);
        
        if ($stmt->execute()) {
            
            exit();
        } else {
            echo "Error al insertar datos en COMIDA: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "<script>alert('Ya existe un registro de COMIDA con la misma fecha y tipo de comida'); window.location.href='añadir.php';</script>";
        exit();
    }
}

// ---------------------
// HIPERGLUCEMIA
// ---------------------
if (isset($_POST['submit_hiperglucemia'])) {
    // Se esperan los campos: fecha, glucosa_hiper, hora_hiper y correccion
    $fecha_hiper          = $_POST['fecha_hiper'];
    $glucosa_hiper   = $_POST['glucosa_hiper'] ?? null;
    $hora_hiper      = $_POST['hora_hiper'] ?? null;
    $correccion      = $_POST['correccion'] ?? null;
    $tipo_comida_hiper = $_POST['tipo_comida_hiper'];

    if (!empty($glucosa_hiper) && !empty($hora_hiper) && !empty($correccion)) {
        $sql_hiper = "INSERT INTO HIPERGLUCEMIA (glucosa, hora, correccion, tipo_comida, fecha, id_usu) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql_hiper);
        $stmt->bind_param("isisss", $glucosa_hiper, $hora_hiper, $correccion,$tipo_comida_hiper, $fecha_hiper, $id_usuario);
        $stmt->execute();
        $stmt->close();
    }
}

// ---------------------
// HIPOGLUCEMIA
// ---------------------
if (isset($_POST['submit_hipo'])) {
    var_dump($_POST);
    // Se esperan los campos: fecha, glucosa_hipo, hora_hipo y tipo_comida_hipo
    $fecha             = $_POST['fecha_hipo'];
    $glucosa_hipo      = $_POST['glucosa_hipo'] ?? null;
    $hora_hipo         = $_POST['hora_hipo'] ?? null;
    $tipo_comida_hipo  = $_POST['tipo_comida_hipo'];

    if (!empty($glucosa_hipo) && !empty($hora_hipo)) {
        $sql_hipo = "INSERT INTO HIPOGLUCEMIA (glucosa, hora, tipo_comida, fecha, id_usu) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql_hipo);
        // Se corrige la variable en bind_param: usar $tipo_comida_hipo en lugar de $tipo_comida_hiper
        $stmt->bind_param("isssi", $glucosa_hipo, $hora_hipo, $tipo_comida_hipo, $fecha, $id_usuario);
        $stmt->execute();
        $stmt->close();
    }
}

$conn->close();

?>
