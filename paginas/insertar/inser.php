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
    

    // Verificar si ya existe un registro en control_glucosa para la misma fecha y usuario
    $sql_check = "SELECT COUNT(*) FROM control_glucosa WHERE fecha = ? AND id_usu = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("si", $fecha, $id_usuario);
    $stmt_check->execute();
    $stmt_check->bind_result($count_control_glucosa);
    $stmt_check->fetch();
    $stmt_check->close();

    if ($count_control_glucosa > 0) {
        // Si ya existe un registro, mostrar error
        echo "<script>alert('Ya existe un registro de control de glucosa para esta fecha'); window.location.href='insertar.php';</script>";
        exit();
    }

    // Si no existe, se procede a la inserción
    $sql_glucosa = "INSERT INTO control_glucosa (fecha, deporte, lenta, id_usu) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql_glucosa);
    $stmt->bind_param("siii", $fecha, $deporte, $lenta, $id_usuario);

    if ($stmt->execute()) {
        // Redirigir a opcion_inser.php después de la inserción
        header('Location: opcion_inser.php');
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
    $sql_check = "SELECT COUNT(*) FROM comida WHERE fecha = ? AND tipo_comida = ? AND id_usu = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("ssi", $fecha_comida, $tipo_comida, $id_usuario);
    $stmt_check->execute();
    $stmt_check->bind_result($count_comida);
    $stmt_check->fetch();
    $stmt_check->close();

    if ($count_comida == 0) {
        $sql_comida = "INSERT INTO comida (tipo_comida, gl_1h, gl_2h, raciones, insulina, fecha, id_usu) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql_comida);
        $stmt->bind_param("siiiisi", $tipo_comida, $gl_1h, $gl_2h, $raciones, $insulina, $fecha_comida, $id_usuario);
        
        if ($stmt->execute()) {
            // Redirigir a opcion_inser.php después de la inserción
            header('Location: opcion_inser.php');
            exit();
        } else {
            echo "Error al insertar datos en COMIDA: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "<script>alert('Ya existe un registro de COMIDA con la misma fecha y tipo de comida'); window.location.href='insertar.php';</script>";
        exit();
    }
}

// ---------------------
// HIPERGLUCEMIA
// ---------------------
if (isset($_POST['submit_hiperglucemia'])) {
    // Recoger datos del formulario
    $fecha_hiper       = $_POST['fecha_hiper'];
    $glucosa_hiper     = $_POST['glucosa_hiper'] ?? null;
    $hora_hiper        = $_POST['hora_hiper'] ?? null;
    $correccion        = $_POST['correccion'] ?? null;
    $tipo_comida_hiper = $_POST['tipo_comida_hiper'];

    //  Verificar si la fecha existe en control_glucosa para el usuario
    $sql_check_control = "SELECT COUNT(*) FROM control_glucosa WHERE fecha = ? AND id_usu = ?";
    $stmt_check_control = $conn->prepare($sql_check_control);
    $stmt_check_control->bind_param("si", $fecha_hiper, $id_usuario);
    $stmt_check_control->execute();
    $stmt_check_control->bind_result($count_control);
    $stmt_check_control->fetch();
    $stmt_check_control->close();

    if ($count_control == 0) {
        //  Si no existe en control_glucosa, mostrar error y evitar la inserción
        echo "<script>alert('Error: No puedes registrar una hiperglucemia en una fecha sin un control de glucosa previo.'); window.location.href='insertar.php';</script>";
        exit();
    }

    //  Verificar si ya existe un registro en hiperglucemia con la misma fecha y tipo de comida
    $sql_check_hiper = "SELECT COUNT(*) FROM hiperglucemia WHERE fecha = ? AND tipo_comida = ? AND id_usu = ?";
    $stmt_check_hiper = $conn->prepare($sql_check_hiper);
    $stmt_check_hiper->bind_param("ssi", $fecha_hiper, $tipo_comida_hiper, $id_usuario);
    $stmt_check_hiper->execute();
    $stmt_check_hiper->bind_result($count_hiper);
    $stmt_check_hiper->fetch();
    $stmt_check_hiper->close();

    if ($count_hiper > 0) {
        //  Si ya existe, evitar la inserción
        echo "<script>alert('Ya existe un registro de HIPERGLUCEMIA con la misma fecha y tipo de comida'); window.location.href='insertar.php';</script>";
        exit();
    }

    //  Si no existe, verificar que todos los campos estén completos
    if (!empty($glucosa_hiper) && !empty($hora_hiper) && !empty($correccion)) {
        // Insertar en la tabla hiperglucemia
        $sql_hiper = "INSERT INTO hiperglucemia (glucosa, hora, correccion, tipo_comida, fecha, id_usu) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql_hiper);
        $stmt->bind_param("isisss", $glucosa_hiper, $hora_hiper, $correccion, $tipo_comida_hiper, $fecha_hiper, $id_usuario);

        if ($stmt->execute()) {
            // Redirigir a opcion_inser.php después de la inserción
            header('Location: opcion_inser.php');
            exit();
        } else {
            echo "Error al insertar datos en HIPERGLUCEMIA: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "<script>alert('Por favor, complete todos los campos'); window.location.href='insertar.php';</script>";
        exit();
    }
}

// ---------------------
// HIPOGLUCEMIA
// ---------------------
if (isset($_POST['submit_hipo'])) {
    

    // Recoger datos del formulario
    $fecha             = $_POST['fecha_hipo'] ?? null;
    $glucosa_hipo      = $_POST['glucosa_hipo'] ?? null;
    $hora_hipo         = $_POST['hora_hipo'] ?? null;
    $tipo_comida_hipo  = $_POST['tipo_comida_hipo'] ?? null;
    

    if (empty($fecha) || empty($glucosa_hipo) || empty($hora_hipo) || empty($tipo_comida_hipo)) {
        echo "<script>alert('Error: Todos los campos son obligatorios'); window.location.href='insertar.php';</script>";
        exit();
    }

    // Verificar si la fecha existe en control_glucosa para el usuario
    $sql_check_control = "SELECT COUNT(*) FROM control_glucosa WHERE fecha = ? AND id_usu = ?";
    $stmt_check_control = $conn->prepare($sql_check_control);
    $stmt_check_control->bind_param("si", $fecha, $id_usuario);
    $stmt_check_control->execute();
    $stmt_check_control->bind_result($count_control);
    $stmt_check_control->fetch();
    $stmt_check_control->close();

    if ($count_control == 0) {
        echo "<script>alert('Error: No puedes registrar una hipoglucemia en una fecha sin un control de glucosa previo.'); window.location.href='insertar.php';</script>";
        exit();
    }

    //  Verificar si ya existe un registro en hipoglucemia con la misma fecha y tipo de comida
    $sql_check_hipo = "SELECT COUNT(*) FROM hipoglucemia WHERE fecha = ? AND tipo_comida = ? AND id_usu = ?";
    $stmt_check_hipo = $conn->prepare($sql_check_hipo);
    $stmt_check_hipo->bind_param("ssi", $fecha, $tipo_comida_hipo, $id_usuario);
    $stmt_check_hipo->execute();
    $stmt_check_hipo->bind_result($count_hipo);
    $stmt_check_hipo->fetch();
    $stmt_check_hipo->close();

    if ($count_hipo > 0) {
        echo "<script>alert('Ya existe un registro de HIPOGLUCEMIA con la misma fecha y tipo de comida'); window.location.href='insertar.php';</script>";
        exit();
    }

    //  Insertar en la tabla hipoglucemia   
    $sql_hipo = "INSERT INTO hipoglucemia (glucosa, hora, tipo_comida, fecha, id_usu) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql_hipo);
    $stmt->bind_param("isssi", $glucosa_hipo, $hora_hipo, $tipo_comida_hipo, $fecha, $id_usuario);

    if ($stmt->execute()) {
        header('Location: opcion_inser.php');
        exit();
    } else {
        echo "<script>alert('Error al insertar datos en HIPOGLUCEMIA: " . $stmt->error . "'); window.location.href='insertar.php';</script>";
        exit();
    }

    $stmt->close();
}