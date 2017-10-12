<?php
error_reporting();

session_start();

function Conectarse() 

{ 

  // if (!($link=mysql_connect("localhost","root",""))) 
  //if (!($link=mysql_connect("pdb6.awardspace.net","2142072_db","Chichilita.123"))) // HERRAMIENTAS A MEDIDA
    //if (!($link=mysql_connect("bsascallsj.ddns.net","autoriza","autoriza"))) // SERVER PRODUCCION
    //if (!($link=mysql_connect("localhost","call_argentina","5a24to"))) // SERVER PRODUCCION
    if (!($link=mysql_connect("200.41.168.147","autoriza","aut0r1za"))) // SERVER PRODUCCION
   { 

      echo "Error conectando a la base de datos.link.<br>".mysql_error(); 
      exit(); 

   } 

   // if (!mysql_select_db("2142072_db",$link))  // HERRAMIENTAS A MEDIDA
    //if (!mysql_select_db("autoriza",$link))
    if (!mysql_select_db("autoriza",$link)) 
    { 

      echo "Error seleccionando la base de datos.selectdb"; 
      //die("Fallo la conexión a la Base de Datos: " . mysql_error());
      echo mysql_error(); 
      exit(); 

   } 

   return $link; 

} 
?>
