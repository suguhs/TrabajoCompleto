<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
        <h2>Control de Glucosa</h2>
        <form action="../modificador.php" method="POST">
            <div class="form-group">
                <label for="fecha_control" class="form-label">Fecha:</label>
                <input type="date" id="fecha_control" name="fecha_control" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="deporte" class="form-label">Tiempo de Deporte:</label>
                <input type="number" id="deporte" name="deporte" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="lenta" class="form-label">Insulina Lenta:</label>
                <input type="number" id="lenta" name="lenta" class="form-control" required>
            </div>
            <button type="submit" name="submit_control" class="btn btn-primary mt-2 w-100">Añadir Control</button>
        </form>

</body>
</html>