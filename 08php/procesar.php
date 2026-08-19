<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=datos, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    datos registrados <br/>
    <?php
    if(isset($_POST["placa"])){
    echo $_POST["placa"]."<br/>";
    echo $_POST["tipo"];
    } else {
        echo "no hay datos...";
        ?>
        <a href ="formulario.php"> regresar </a>
        <?php
    }
    ?>
</body>
</html>