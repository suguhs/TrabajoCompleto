<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h2 class="mt-4">Registro de Comida</h2>
        <form action="../modificador.php" method="POST">
            <div class="form-group">
                <label for="tipo_comida" class="form-label">Tipo de Comida:</label>
                <select id="tipo_comida" name="tipo_comida" class="form-control" required>
                    <option>Desayuno</option>
                    <option>Comida</option>
                    <option>Cena</option>
                </select>
            </div>
            <div class="form-group">
                <label for="fecha_comida">Fecha:</label>
                <input type="date" name="fecha_comida" id="fecha_comida" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="gl_1h">Glucosa 1h después:</label>
                <input type="number" name="gl_1h" id="gl_1h" class="form-control" min="0" required>
            </div>
            <div class="form-group">
                <label for="gl_2h">Glucosa 2h después:</label>
                <input type="number" name="gl_2h" id="gl_2h" class="form-control" min="0" required>
            </div>
            <div class="form-group">
                <label for="raciones">Raciones:</label>
                <input type="number" name="raciones" id="raciones" class="form-control" min="0" required>
            </div>
            <div class="form-group">
                <label for="insulina">Insulina:</label>
                <input type="number" name="insulina" id="insulina" class="form-control" min="0" required>
            </div>
            <button type="submit" name="submit_comida" class="btn btn-primary mt-2 w-100">Añadir Comida</button>
        </form>
</body>
</html>