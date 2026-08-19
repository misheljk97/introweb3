<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<form action="procesar.php"method="POST">
    <label>Placa:</label>
    <input type="text" name="placa" required>

    <label>Tipo de Vehículo:</label>
    <select name="tipo">
        <option value="A01">Automóvil</option>
        <option value="A02">Motocicleta</option>
    </select>

    <button type="submit">Registrar Ingreso</button>
</form>


</body>
</html>