<?php

//foreach($nuevo as $ele){
//echo $ele. "<br/>";
//}

$xml= simplexml_load_file ("https://wendysoto.github.io/facturacion-examen_SOA/facturaexportada-final.xml");

//MAPEAR DATOS HIJOS

foreach($xml->detalle_factura as $nodo){
      echo $nodo->nombre."<br>";
      //otro foreach para el otro nodo hijo
      foreach($nodo->fecha as $d){
          echo $d->dia."";
          echo $d->mes;
          echo "<br>";

      

      //CADENA DE CONEXION

      $db_host="mysql-wendy19.alwaysdata.net";
      $db_nombrebdd="wendy19_examen";
      $db_usuario="wendy19";
      $db_contra="arquitectura";
      

$conexion=mysqli_connect($db_host,$db_usuario,$db_contra);

if(mysqli_connect_errno())
{
    echo "CONEXION FALLIDA \n";
    exit();
}

mysqli_set_charset ($conexion,"utf8");
mysqli_select_db ($conexion,$db_nombrebdd) or die ("LA BASE DD NO SE ENCUENTRA");

$consulta = "INSERT INTO Negocio (codigo,ruc,cedula,nombre,apellido,dia,mes,anio,telefono,direccion,cantidad,detalle,formapago,total) VALUES
 ('$nodo->codigo','$nodo->ruc','$nodo->cedula','$nodo->nombre','$nodo->apellido','$d->dia', '$d->mes','$d->anio','$nodo->telefono','$nodo->direccion','$nodo->cantidad','$nodo->detalle','$nodo->formapago','$nodo->total');";
$resultado= mysqli_query($conexion,$consulta);

}
}

if(resultado==true){
echo "<br>";
echo "REGISTRO GUARDADO EXITOSAMENTE";
}
else{
echo "REGISTRO NO INGRESADO";
}
mysqli_close($conexion);




?>