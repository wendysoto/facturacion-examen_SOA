<?php

//PASO 1. CREAR LA FUNCION PARA CREAR UN ARCHIVO

function crea_fichero($abc){
    //creamos fichero
    $flujo=fopen('factura exportada.xml','w');
    //volcamos el contenido de cadena al fichero
    fputs($flujo,$abc);
    //cerramos el flujo
    fclose($flujo);

}

//PASO 2 CREAR LA CONEXION CON LA BDD
$db_host="mysql-wendy19.alwaysdata.net";
$db_nombrebdd="wendy19_examen";
$db_usuario="wendy19";
$db_contra="arquitectura";

$dwes=mysqli_connect($db_host,$db_usuario,$db_contra);
if(mysqli_connect_errno($dwes))
{
    echo "CONEXION FALLIDA \n";
    echo "<br>";
}
else{
    echo "CONEXION EXITOSA \n";
    echo "<br>";
}
mysqli_set_charset ($dwes,"utf8");
mysqli_select_db ($dwes,$db_nombrebdd) or die ("LA BASE DD NO SE ENCUENTRA");

//PASO 3 PREPARAR LA CONSULTA PARA TRAER LOS REGISTROS DE MYQSL

if (isset ($dwes))
{
    $a=$sql="SHOW TABLES";
    //prologo
    $xml="<?xml version=\"1.0\"?>\n"; 

    $b=mysqli_query($dwes,$a);

    while(($ver=mysqli_fetch_row($b))==true)
    {
        $xml .="\t<".$ver[0].">\n";

        echo "$ver[0].<br/>";
        $c=$sql="select *from FACTURA";
        $d=mysqli_query($dwes,$c);

        while($fila=mysqli_fetch_array($d,MYSQLI_ASSOC)){
            $xml .= "\t\t<detalle_factura>\n";


            foreach ($fila as $k => $v){
                echo "$k => $v.\n";
                echo "\n";
               
                $xml .="\t\t\t<".$k.">".$v."</".$k.">\n";
            }
            $xml .= "\t\t</detalle_factura>\n";
        }
        $xml .= "\t</".$ver[0].">\n";
    }
    crea_fichero($xml);
}



 
?>