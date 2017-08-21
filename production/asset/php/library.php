<?php
    //Versión 1.0
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    
    //Obtengo el año actual.
    function getDateNow(){
        return date("Y");
    }

    function Conectarse(){
        if (!($link=mysql_connect("200.41.168.147","autoriza","aut0r1za"))){
            echo "Error conectando a la base de datos.link.<br>".mysql_error(); 
            exit();
        }
        if (!mysql_select_db("autoriza",$link)){ 
            echo "Error seleccionando la base de datos.selectdb"; 
            echo mysql_error(); 
            exit();
        }
        return $link;
    }

    function readerGet(){
        $numero = count($_GET);
        $tags = array_keys($_GET);// obtiene los nombres de las varibles
        $valores = array_values($_GET);// obtiene los valores de las varibles

        // crea las variables y les asigna el valor
        for($i=0;$i<$numero;$i++){
        $$tags[$i]=$valores[$i];
        }        
    }

    function status($getValue){
    
        if(isset($_GET[$getValue])){
            return true;
        }else{
            return false;
        }
    }

    function countControl(){
        $inactivo = 2000;
        // verificamos que ya exista un valor para timeout
        
        if (isset($_SESSION["timeout"])){
            
            // calculamos el tiempo que lleva la sesion
            $timeSession = time() - $_SESSION["timeout"];
            // si se pasa el umbral de inactividad
            if ($timeSession > $inactivo){
                echo 'sss';
            }
        }
        
        //el usuario interactua por primera vez
        $_SESSION["timeout"] = time();        
    } 

?>
