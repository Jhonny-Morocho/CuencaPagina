<?php
session_start();
error_reporting(E_ALL);
@ini_set('display_errors', '1');
//con session_start() creamos la sesión si no existe o la retomamos si ya
//ha sido creada.
extract($_REQUEST);
//Como antes, usamos extract() por comodidad, pero podemos no hacerlo
//tranquilamente.
$carro=$_SESSION['carro'];
//Asignamos a la variable $carro los valores guardados en la sessión
unset($carro[md5($id)]);
//la función unset borra el elemento de un array que le pasemos por parámetro.
//En este caso la usamos para borrar el elemento cuyo id le pasemos a la
//página por la url.
$_SESSION['carro']=$carro;
//Finalmente, actualizamos la sessión, como hicimos cuando agregamos un
//producto y volvemos al catálogo.
header("Location:vercarrito.php?".SID."&id=".$id."&precio=".$precio);
?>