<?php
    //Versión 1.0

    date_default_timezone_set('America/Argentina/Buenos_Aires');
    
    //include('config_inc.php');

    $version = 'Versión 1.0';

    //Obtengo el año actual.
    function getDateNow(){
        return date("Y");
    }

    function Conectarse(){
        if (!($link=mysql_connect($_SESSION['hostapp'],$_SESSION['userapp'],$_SESSION['passapp']))){
            echo "Error conectando a la base de datos.link.<br>".mysql_error(); 
            exit();
        }
        if (!mysql_select_db($_SESSION['baseapp'],$link)){ 
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
        $in = 600;     
        // verificamos que ya exista un valor para timeout
        $time = time();
        if (isset($_SESSION["timeout"])){
            // calculamos el tiempo que lleva la sesion
            $result =  time() - $_SESSION["timeout"];
            if($result > $in){
                echo '<script>window.location.replace("logout.php?timeout")</script>';
            }
        }else{
            //el usuario interactua por primera vez
            $_SESSION["timeout"] = time();
        }        
    }

    function auditoriaLog($accion, $seccion, $otro, $link){
        $query = "INSERT INTO t_auditoria (nombre, accion, seccion, otro) VALUES ('".$_SESSION['nomb']."', '".$accion."', '".$seccion."', '".$otro."')";
        $resultado = mysql_query($query, $link);
        if(!$resultado){
            die(mysql_error() );
        }
    } 

?>
