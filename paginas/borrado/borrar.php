<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Registro</title>
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
            background-color: red;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
        }
        button:hover {
            background-color: darkred;
        }
    </style>
</head>
<body>
    <h2>Eliminar Registro</h2>
    <form action="borrador.php" method="post">
        <label for="fecha">Fecha:</label>
        <input type="date" id="fecha" name="fecha" required>

        <label for="tipo_comida">Tipo de Comida:</label>
        <select id="tipo_comida" name="tipo_comida" required>
            <option value="desayuno">Desayuno</option>
            <option value="almuerzo">Almuerzo</option>
            <option value="cena">Cena</option>
        </select>

        <button type="submit">Eliminar</button>
    </form>
</body>
</html>
