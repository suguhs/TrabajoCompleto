<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Registro</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        form {
            max-width: 400px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        label, input, select {
            display: block;
            width: 100%;
            margin-bottom: 10px;
        }
        button {
            background-color: blue;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
        }
        button:hover {
            background-color: darkblue;
        }
    </style>
    <script>
        function toggleGlucoseFields() {
            var option = document.getElementById("glucose_type").value;
            document.getElementById("hiper_fields").style.display = option === "hiper" ? "block" : "none";
            document.getElementById("hipo_fields").style.display = option === "hipo" ? "block" : "none";
        }
    </script>
</head>
<body>
    <h2>Actualizar Registro</h2>
    <form action="../modificador.php" method="post">
        <label for="fecha">Fecha:</label>
        <input type="date" id="fecha" name="fecha" required>

        <label for="tipo_comida">Tipo de Comida:</label>
        <select id="tipo_comida" name="tipo_comida" required>
            <option value="desayuno">Desayuno</option>
            <option value="almuerzo">Almuerzo</option>
            <option value="cena">Cena</option>
        </select>

        <label for="glucose_type">Tipo de Glucosa:</label>
        <select id="glucose_type" name="glucose_type" onchange="toggleGlucoseFields()">
            <option value="">Seleccione...</option>
            <option value="hiper">Hiperglucemia</option>
            <option value="hipo">Hipoglucemia</option>
        </select>

        <div id="hiper_fields" style="display:none;">
            <label for="glucosa_hiper">Glucosa Hiper:</label>
            <input type="number" id="glucosa_hiper" name="glucosa_hiper">
            
            <label for="hora_hiper">Hora Hiper:</label>
            <input type="time" id="hora_hiper" name="hora_hiper">
            
            <label for="correccion">Corrección:</label>
            <input type="number" id="correccion" name="correccion">
        </div>

        <div id="hipo_fields" style="display:none;">
            <label for="glucosa_hipo">Glucosa Hipo:</label>
            <input type="number" id="glucosa_hipo" name="glucosa_hipo">
            
            <label for="hora_hipo">Hora Hipo:</label>
            <input type="time" id="hora_hipo" name="hora_hipo">
        </div>

        <button type="submit_hipo">Actualizar</button>
    </form>
</body>
</html>
