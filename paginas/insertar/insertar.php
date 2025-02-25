<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <!-- Control de Glucosa -->
        <h2>Control de Glucosa</h2>
        <form action="inser.php" method="POST">
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

        <!-- Registro de Comida -->
        <h2 class="mt-4">Registro de Comida</h2>
        <form action="inser.php" method="POST">
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

        <!-- Registro de Hiperglucemia -->
        <h2 class="mt-4">Hiperglucemia</h2>
        <form action="inser.php" method="POST">
            <div class="form-group">
                <label for="tipo_comida_hiper">Tipo de Comida:</label>
                <select id="tipo_comida_hiper" name="tipo_comida_hiper" class="form-control" required>
                    <option>Desayuno</option>
                    <option>Comida</option>
                    <option>Cena</option>
                </select>
            </div>
            <div class="form-group">
                <label for="fecha_hiper">Fecha:</label>
                <input type="date" name="fecha_hiper" id="fecha_hiper" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="glucosa_hiper">Glucosa:</label>
                <input type="number" name="glucosa_hiper" id="glucosa_hiper" class="form-control" min="0" required>
            </div>
            <div class="form-group">
                <label for="hora_hiper">Hora:</label>
                <input type="time" name="hora_hiper" id="hora_hiper" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="correccion">Corrección:</label>
                <input type="number" name="correccion" id="correccion" class="form-control" min="0" required>
            </div>
            <button type="submit" name="submit_hiperglucemia" class="btn btn-primary mt-2 w-100">Añadir Hiperglucemia</button>
        </form>

        <!-- Registro de Hipoglucemia -->
        <h2 class="mt-4">Hipoglucemia</h2>
        <form action="inser.php" method="POST">
            <div class="form-group">
                <label for="tipo_comida_hipo">Tipo de Comida:</label>
                <select id="tipo_comida_hipo" name="tipo_comida_hipo" class="form-control" required>
                    <option>Desayuno</option>
                    <option>Comida</option>
                    <option>Cena</option>
                </select>
            </div>
            <div class="form-group">
                <label for="fecha_hipo">Fecha:</label>
                <input type="date" name="fecha_hipo" id="fecha_hipo" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="glucosa_hipo">Glucosa:</label>
                <input type="number" name="glucosa_hipo" id="glucosa_hipoglucemia" class="form-control" min="0" required>
            </div>
            <div class="form-group">
                <label for="hora_hipoglucemia">Hora:</label>
                <input type="time" name="hora_hipo" id="hora_hipo" class="form-control" required>
            </div>
            <button type="submit" name="submit_hipo" class="btn btn-primary mt-2 w-100">Añadir Hipoglucemia</button>
        </form>
    </div>
</body>

</html>
