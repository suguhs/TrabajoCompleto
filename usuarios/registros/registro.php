<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex justify-content-center align-items-center vh-100 bg-light">
    <!--Cambiar un Poco el registro y inicio de sesion para que sea diferente no me gusta-->
    <div class="card p-4 shadow-lg" style="width: 30rem;">
        <h2 class="text-center">Iniciar Sesión</h2>
        <form action="introducir.php" method="POST">
            <div class="mb-3">
                <label for="usuario" class="form-label">Nombre De Usuario</label>
                <input type="text" id="usuario" name="usuario" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" id="nombre" name="nombre" class="form-control" required>
                <!--Cambiar los id y los name para que no esten repetidos-->
            </div>
            <div class="mb-3">
                <label for="apellidos" class="form-label">Apellidos</label>
                <input type="text" id="apellidos" name="apellidos" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="contra" class="form-label">Contraseña</label>
                <input type="password" id="contra" name="contra" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="fecha_nacimiento">Selecciona una fecha:</label>
                <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" min="1975-01-01" required>
                <script>
                    // Obtener la fecha de hoy en formato YYYY-MM-DD
                    let hoy = new Date().toISOString().split("T")[0];
                    document.getElementById("fecha_nacimiento").setAttribute("max", hoy);
                </script>
            </div>
            <button type="submit" class="btn btn-primary w-100">Iniciar Sesión</button>
        </form>
        <div class="text-center mt-3">
            <p>¿Ya tienes una cuenta? <a href="../inicio/iniciarses.php">Iniciar Sesion</a></p>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>