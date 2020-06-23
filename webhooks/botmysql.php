<?php

include_once "../somosioticos/somosioticos_dialogflow.php";

credenciales('botmysql', 'rodri76374_18');
debug();

$mysqli = mysqli_connect("localhost", "rleonrlg_rleon", "chompy_5", "rleonrlg_botmysql");

if(!$mysqli){
  echo "Error: no se pudo conectar a MySQL." . PHP_EOL;
  die();
}

//demora
$demoraXempanada = 4;

if(intent_recibido("consultar_precio")){
$p_queso = consultarPrecio('queso');
$p_charque = consultarPrecio('charque');
$p_api = consultarPrecio('api');
$p_huminta = consultarPrecio('huminta');

enviar_texto("Las de queso salen a bs.$p_queso, las de charque a bs.$p_charque, las de api son a .bs.$p_api y las humintas te salen a .bs.$p_huminta");


}

if(intent_recibido("tomar_pedido_follow")){
  $numero1 = obtener_variables()['numero1'];
  $variedad1 = obtener_variables()['variedad1'];
  $disponibilidad1 = 0;
  $precio1 = 0;
  $subtotal1 = 0;
  if($numero1>0){
    $precio1 = consultarPrecio($variedad1);
    $disponibilidad1 = consultarStock($variedad1);
    $subtotal1 = $numero1*$precio1;
    if($numero1 > $disponibilidad1){
      enviar_texto("Lo sentimos pero no tenemos sufientes empanadas de $variedad1 en este momento, si deseas reformular el pedido por favor escribe 'ordenar'. La cantidad que tenemos actualmente es de $disponibilidad1 unidades");
      return;
    }
  }

  $numero2 = obtener_variables()['numero2'];
  $variedad2 = obtener_variables()['variedad2'];
  $disponibilidad2 = 0;
  $precio2 = 0;
  $subtotal2 = 0;
  if($numero2>0){
    $precio2 = consultarPrecio($variedad2);
    $disponibilidad2 = consultarStock($variedad2);
    $subtotal2 = $numero2*$precio2;
    if($numero2>$disponibilidad2){
      enviar_texto("Lo sentimos pero no tenemos sufientes empanadas de $variedad2 en este momento, si deseas reformular el pedido por favor escribe 'ordenar'. La cantidad que tenemos actualmente es de $disponibilidad2 unidades");
      return;
    }
  }

  $numero3 = obtener_variables()['numero3'];
  $variedad3 = obtener_variables()['variedad3'];
  $disponibilidad3 = 0;
  $precio3 = 0;
  $subtotal3 = 0;
  if($numero3>0){
    $precio3 = consultarPrecio($variedad3);
    $disponibilidad3 = consultarStock($variedad3);
    $subtotal1 = $numero3*$precio3;
    if($numero3>$disponibilidad3){
      enviar_texto("Lo sentimos pero no tenemos sufientes empanadas de $variedad3 en este momento, si deseas reformular el pedido por favor escribe 'ordenar'. La cantidad que tenemos actualmente es de $disponibilidad3 unidades");
      return;
    }
  }
  $total =$subtotal1+$subtotal2+$subtotal3;
  enviar_texto("Su pedido es de: $numero1 $variedad1 $numero2 $variedad2 $numero3 $variedad3 y el total de su pedido es de bs.$total por favor digame si desea confirmar este pedido.");

}

//si se confirma el pedido
if(intent_recibido("orden_confirmada")){
  $nombre = obtener_variables()["nombre"];
  $direccion = obtener_variables()["direccion"];
  $telefono = obtener_variables()["telefono"];


  $variedad1 = obtener_variables()["variedad1"];
  $numero1 = obtener_variables()["numero1"];
  $subtotal1 = 0;
  if($numero1>0){
    $subtotal1 = $numero1 * consultarPrecio($variedad1);
    descuentaStock($numero1, $variedad1);
  }

  $variedad2 = obtener_variables()["variedad2"];
  $numero2 = obtener_variables()["numero2"];
  $subtotal2 = 0;
  if($numero2>0){
    $subtotal2 = $numero2 * consultarPrecio($variedad2);
    descuentaStock($numero2, $variedad2);
  }

  $variedad3 = obtener_variables()["variedad3"];
  $numero3 = obtener_variables()["numero3"];
  $subtotal3 = 0;
  if($numero3>0){
    $subtotal3 = $numero3 * consultarPrecio($variedad3);
    descuentaStock($numero3, $variedad3);
  }

  $total = $subtotal1+$subtotal2+$subtotal3;
  global $mysqli;
  $sql = "INSERT INTO clientes (id_cliente, nombre, direccion, telefono) VALUES (null, '$nombre', '$direccion' , '$telefono')";
  if($mysqli->query($sql)==true){
    $cantidadTotal = $numero1+$numero2+$numero3;
    $demora = $demoraXempanada * $cantidadTotal;
    enviar_texto("Listo!!, su pedido esta en camino, estara en aproximadamente $demora minutos. Gracias!!!");
  }else {

    enviar_texto("no se pudo resgistrar sus datos, por favor intente de nuevo");
  }
  //Para mandar mail
  $mensaje = "Nueva orden para $nombre enviar: \n\n\n $variedad1 $numero1 \n\n $variedad2 $numero2 \n\n $variedad3 $numero3 \n\n enviar a $direccion \n\n  telefono: $telefono \n\n Total a cobrar: $total";
  mail('rleon.rlg@gmail.com', 'NUEVA ORDEN desde botmysql!!!', $mensaje);





}


function consultarStock($variedad){
  global $mysqli;
  $resultado = $mysqli->query("SELECT $variedad FROM `stock` WHERE 1");
  $stock = mysqli_fetch_assoc($resultado);
  $cantidad = $stock[$variedad];
  return $cantidad;
}

function consultarPrecio($variedad){
  global $mysqli;
  $resultado = $mysqli->query("SELECT $variedad FROM `precios` WHERE 1");
  $precios = mysqli_fetch_assoc($resultado);
  $precio = $precios[$variedad];
  return $precio;
}


function descuentaStock($numero, $variedad){
  global $mysqli;
  $mysqli->query("UPDATE `stock` SET $variedad = $variedad - $numero");
}

function agregaStock($numero, $variedad){
  global $mysqli;
  $mysqli->query("UPDATE `stock` SET $variedad = $variedad + $numero");
}

?>
