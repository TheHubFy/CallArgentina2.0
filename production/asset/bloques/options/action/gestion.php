<?php
    session_start();
    $idusua = $_SESSION['id_usua'];
    $hostDDR = $_SERVER['SERVER_NAME'];
    include('../../../api/library.php');
    $link=Conectarse();

    $numgestion = $_POST["numgestion"];
    $origenTable = $_POST["origenTable"];
    $proceso = $_POST["proceso"];
    $estado = $_POST["estado"];

    switch ($estado){
            case 'Autorizado':
                $estado = 7;
                break;
            case 'Rechazado':
                $estado = 8;    
                break;
            case 'Observado':
                $estado = 9;    
                break;
    }

    if($origenTable == "t_incidentec"){
      $atributo = 'c_nroincidente';
    }else if($origenTable == "t_trasladoc"){
      $atributo = 'c_nrotraslado';
    }else{
      $atributo = '';
    }

    $sql="SELECT c_afnombre, c_observa FROM ".$origenTable." WHERE  ".$atributo." = {$numgestion}";

    $deri=mysql_query($sql,$link) or die (mysql_error());
    while($row_deri=mysql_fetch_array($deri)){
      $c_afnombre = $row_deri['c_afnombre'];
      $observaciones = $row_deri['c_observa'];     
    }

    $sql="INSERT INTO t_gestion (tipo_gestion, nro_gestion, nombrepaciente, estado_gestion, obs_gestion, id_usua_gestion, datosorigen_gestion) VALUES 
        ('{$proceso}', {$numgestion}, '{$c_afnombre}', {$estado}, '{$observaciones}', {$idusua}, '{$hostDDR}')";

    $resultado = mysql_query($sql, $link);

    if(!$resultado){
        die(mysql_error() );
    }else{
        if ($proceso=='derivaciones')
        {
            $sql="UPDATE t_incidentec SET c_estado = {$estado} WHERE c_nroincidente = {$numgestion}";
        }else if($proceso == 'trasladosegundo'){
            $sql="UPDATE t_trasladoc SET c_estado = {$estado}  WHERE c_nrotraslado = {$numgestion}";
        }else{
            $sql="UPDATE t_trasladoc SET c_estado = {$estado}  WHERE c_nrotraslado = {$numgestion}";            
        }
        
        //Actualizo el estado
        $resultado = mysql_query($sql, $link);
        if(!$resultado){
            die(mysql_error() );
        }else{
            auditoriaLog('Modifica', 'Estado', $numgestion.' - '.$estado, $link);
            echo '<script>alert("Se realizó el cambio de estado con exito"); window.location = ""; </script>';            
        }
    }
?>