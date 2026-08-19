<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    hola a todos <br/> 
    <?php
    //mensaje php
    echo"<b>Mishel Ichau </b> <br/>"; 
    

    //tipos de datos y variables 
    // para declarar una variable se usa este simbolo $
    $nombres = "Jungkook"; 
    $edad = 48;
    $estatura = 1.56; 
    $es_estudiante = TRUE;
// otra forma de presentar el nombre y la edad
echo "$nombres-$edad años- $estatura m <br/>";

//operaciones
$num1= "2";
$num2=60;
$suma=$num1+$num2;
echo "Resultado: $suma <br/>";

//condicionales
$num1 =12;
$num2=24;
if($num1 > $num2){
    echo"el mayor es: $num1";
}

elseif ( $num1 <$num2){
    echo "el mayor es: $num2";
}

else {
    echo "NUmeros iguales";
}

    ?>

<h2> BUCLES<h2>
    <ul>
  <li>Ecuador</li>
  <li>korea</li>
  <li>EEUU</li>
  <li>España</li>
  <?php
  for ($i=1 ; $i <=10; $i++){
    echo"<li> $i Japon </li>";
  }
  ?>
</ul>

<h3> tabla de multiplicar </h3>
<?php
echo "<table border='1' cellpadding='8' cellspacing='0' style='text-align: center;'>";

$i = 1;
while ($i <= 10) {
    echo "<tr>";
    
    // Celda 1: El número base (6)
    echo "<td>3</td>";
    
    // Celda 2: El signo de multiplicación
    echo "<td>x</td>";
    
    // Celda 3: El multiplicador (1 al 10)
    echo "<td>{$i}</td>";
    
    // Celda 4: El signo de igual
    echo "<td>=</td>";
    
    // Celda 5: El resultado de la multiplicación
    $resultado = 6 * $i;
    echo "<td>{$resultado}</td>";
    
    echo "</tr>";
    $i++;
}

echo "</table>";
?>
</body>
</html>