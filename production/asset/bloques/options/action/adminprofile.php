<?php
    session_start();
    
    $idusua = $_SESSION['id_usua'];
    
    include('../../../api/library.php');
    
    $link=Conectarse();

    if(isset($_POST['origen'])){$origen = $_POST['origen'];}else{$origen='';}
    if(isset($_POST['idd'])){$idd = $_POST['idd'];}else{$idd='';}
    if(isset($_POST['nomb_usua'])){$nomb_usua = $_POST['nomb_usua'];}else{$nomb_usua='';}
    if(isset($_POST['usua_usua'])){$usua_usua = $_POST['usua_usua'];}else{$usua_usua='';}
    if(isset($_POST['pass_usua'])){$pass_usua = $_POST['pass_usua'];}else{$pass_usua='';}
       
    $perm_usua = '';
    if(isset($_POST['perm_usua_1'])){ $perm_usua=$perm_usua.'1';}
    if(isset($_POST['perm_usua_2'])){ $perm_usua=$perm_usua.'2';}
    if(isset($_POST['perm_usua_3'])){ $perm_usua=$perm_usua.'3';}
    if(isset($_POST['perm_usua_4'])){ $perm_usua=$perm_usua.'4';}
    if(isset($_POST['perm_usua_5'])){ $perm_usua=$perm_usua.'5';}

    if($origen == 'ALTA'){
        auditoriaLog('Alta', 'Usuarios', $nomb_usua.$perm_usua, $link);
        $query = "INSERT INTO t_usua (nomb_usua, usua_usua, pass_usua, perm_usua) VALUES ('$nomb_usua', '$usua_usua', '$pass_usua', '$perm_usua')";
        $message = '<div class="alert alert-info" role="alert">¡Usuario creado con éxito!</div>';
        $idusua = '';
    }

    if($origen == 'MODMY'){
        auditoriaLog('Modificacion', 'Usuarios', $nomb_usua.$perm_usua, $link);
        $query = "UPDATE t_usua SET 
                        nomb_usua = '$nomb_usua',
                        usua_usua = '$usua_usua',
                        pass_usua = '$pass_usua',
                        perm_usua = '$perm_usua'
                WHERE id_usua = '$idusua'";
        $message = '<div class="alert alert-success" role="alert">¡Tus datos se han actualizados con éxito!</div>';
        $alert = '<div class="alert alert-danger" role="alert"> En breve se cerrá tu sesión para actualizar los cambios</div>';               
    }

    if($origen == 'MOD'){
        auditoriaLog('Modificacion', 'Usuarios', $nomb_usua.$perm_usua, $link);
        $query = "UPDATE t_usua SET 
                        nomb_usua = '$nomb_usua',
                        usua_usua = '$usua_usua',
                        pass_usua = '$pass_usua',
                        perm_usua = '$perm_usua'
                WHERE id_usua = '$idd'";
        $message = '<div class="alert alert-success" role="alert">¡Datos actualizados con éxito!</div>';
    }
    if(isset($_GET['iduserdelete'])){
        auditoriaLog('Borrado', 'Usuarios', $nomb_usua.$perm_usua, $link);
        if(empty($_GET['iduserdelete'])){
            echo $message = '<div class="alert alert-success" role="alert"> No tengo ID para borrar</div>';
            exit; 
        }else{
            $message = '<div class="alert alert-success" role="alert"> El registro fue eliminado con exito </div>'; 
            $us = $_GET['iduserdelete'];
            $query = "UPDATE t_usua SET activ_usua = 1 WHERE id_usua = '".$us."' ";
            $idd = $_GET['iduserdelete'];
        }
    }

    $resultado = mysql_query($query, $link);

    if(!$resultado){
        die(mysql_error() );
    }else{
        if($origen == 'MODMY'){            
                echo $message;
                echo $alert;
                echo '<script>
                        function redireccionarPagina() {
                            window.location = "logout.php";
                        }
                        setTimeout("redireccionarPagina()", 5000);
                    </script>';
        }else{         
            echo $message;
                echo '<script>
                        function redireccionarPagina2() {
                            window.location = "usuario.php?idd='.$idd.'";
                        }
                        setTimeout("redireccionarPagina2()", 1000);
                    </script>';            
        }
    }
?>