<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Registro</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-light">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-lg border-0">
                    <div class="card-body text-center">
                        <h2 class="card-title mb-4">Actualizar Registro</h2>
                        <div class="d-grid gap-3">
                            <form action="visualizar_dia.php" method="post">
                                <button type="submit" name="submit_control" class="btn btn-success">Visualizar un día específico</button>
                            </form>
                            <form action="visualizar_todo.php" method="post">
                                <button type="submit" name="submit_comida" class="btn btn-success">Visualizar todos los registros</button>
                            </form>
                        </div>
                    </div>
                    <!-- Enlaces centrados con separación -->
                    <div class="text-center mb-3">
                        <a href="../../menu.php" class="btn btn-primary btn-sm mx-2">Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
