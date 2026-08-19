<?php
$arreglos=["Ecuador","Japon","korea"];
 echo $arreglos[1]."<br/>";

foreach($arreglos as $pais){
    echo "$pais<br/>";
}

$registro =[
    "placa"=> "PBA-1234",
    "tipo"=> "auto",
    "propietario"=> "mishel ichau"
];
echo $registro["placa"]. "<br/>";

foreach($registro as $clave => $valor){
    echo "-$clave: $valor <br/>";
}
?>
