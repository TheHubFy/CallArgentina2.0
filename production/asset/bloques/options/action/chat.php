<?php
    session_start();
    $idusua = $_SESSION['id_usua'];
    $nombreUsuario = $_SESSION['nomb'];

    include('../../../api/library.php');
    $link=Conectarse();

    $posicion = $_POST["posiciones"];
    $numgestion = $_POST["nrogestion"];
    $comentario = $_POST["comentario"];
    
    if($posicion == "1"){
        $tipo = 'Derivaciones';
        $sql="SELECT c_estado FROM t_incidentec WHERE  c_nroincidente = {$numgestion}";
    }else if($posicion == "2"){
        $tipo = 'SegundoNivel';
        $sql="SELECT c_estado FROM t_trasladoc WHERE  c_nrotraslado = {$numgestion}";
    }else{
        $tipo = 'TrasEspecifico';
        $sql="SELECT c_estado FROM t_trasladoc WHERE  c_nrotraslado = {$numgestion}";
    }

    $deri=mysql_query($sql,$link) or die(mysql_error());

    while($row_deri=mysql_fetch_array($deri)){
      $estado = $row_deri['c_estado'];     
    }

	$sql="INSERT INTO t_chat_historial (nro_tablaorigen, mensaje, usuario, nombreyapellido, tipo, estado) VALUES 
                                       ('{$numgestion}', '{$comentario}', '{$idusua}', '{$nombreUsuario}', '{$tipo}', {$estado})";
	
	$resultado = mysql_query($sql, $link);

    if(!$resultado){
        die(mysql_error() );
    }else{
        auditoriaLog('Insertar', 'chat', $numgestion.$comentario, $link);
        echo '<script>alert("¡Comentario ingresado con éxito!");</script>';
    }
?>