<?php
session_start();
include_once 'conexion.php';

if (!isset($_SESSION['id_usu'])) {
    header("Location: index.php");
    exit();
}

$query = "SELECT nombre FROM usuario WHERE id_usu = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $_SESSION['id_usu']);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($nombre);
$stmt->fetch();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Diabetes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body class="d-flex align-items-center justify-content-center vh-100 bg-light">

<div class="container text-center">
    <h1 class="mb-4">Bienvenido, <?php echo $nombre; ?>!</h1>
    <p class="lead">Selecciona una opción:</p>

    <div class="row justify-content-center">
        <!-- Registrar -->
        <div class="col-md-5 m-2">
            <a href="paginas/insertar/insertar.php" class="text-decoration-none">
                <div class="card bg-primary text-white p-3">
                    <div class="card-body">
                        <h3><i class="fas fa-plus-circle"></i> Registrar Datos</h3>
                        <p>Accede al formulario para ingresar los datos del día.</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- Consultar -->
        <div class="col-md-5 m-2">
            <a href="paginas/visualizar.php" class="text-decoration-none">
                <div class="card bg-success text-white p-3">
                    <div class="card-body">
                        <h3><i class="fas fa-table"></i> Consultar Registros</h3>
                        <p>Revisa los datos almacenados en la tabla.</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- Modificar -->
        <div class="col-md-5 m-2">
            <a href="paginas\modificar.php" class="text-decoration-none">
                <div class="card bg-warning text-white p-3">
                    <div class="card-body">
                        <h3><i class="fas fa-edit"></i> Modificar Datos</h3>
                        <p>Edita registros existentes en la base de datos.</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- Borrar -->
        <div class="col-md-5 m-2">
            <a href="paginas\borrar.php" class="text-decoration-none">
                <div class="card bg-danger text-white p-3">
                    <div class="card-body">
                        <h3><i class="fas fa-trash-alt"></i> Borrar Datos</h3>
                        <p>Elimina registros almacenados en la base de datos.</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
