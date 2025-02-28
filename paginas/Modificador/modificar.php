<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Registro</title>
    <!-- Incluir Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 400px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .d-grid gap-3 {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2 class="mb-4">Actualizar Registro</h2>
        <div class="d-grid gap-3">
            <!-- Formulario para Control Glucosa -->
            <form action="Paginas_Modificar/modi_control.php" method="post">
                <button type="submit" name="submit_control" class="btn btn-warning">Control Glucosa</button>
            </form>
            <!-- Formulario para Comida -->
            <form action="Paginas_Modificar/modi_comida.php" method="post">
                <button type="submit" name="submit_comida" class="btn btn-warning">Comida</button>
            </form>
            <!-- Formulario para Hiper o Hipo -->
            <form action="Paginas_Modificar/hiper_hipo.php" method="post">
                <button type="submit" name="submit_hiper_hipo" class="btn btn-warning">Hiper o Hipo</button>
            </form>
        </div>
    </div>

    <!-- Incluir el script de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
