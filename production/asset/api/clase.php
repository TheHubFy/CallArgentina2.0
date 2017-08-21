<?php
//API Versión 1.0
session_start();

//Incluyo los parámetros de conexión.
include('config_inc.php');

//Incluyo Librería
include('library.php');

//Valido el logeo
if(isset($_GET['login'])){
    $link = Conectarse();

    $sql="SELECT * FROM t_usua 
    WHERE activ_usua IS NULL
    AND usua_usua = '{$_POST['user']}'
    AND pass_usua = '{$_POST['pass']}'";

    $usua=mysql_query($sql,$link);

    $row_usua=mysql_fetch_array($usua);

    if ($row_usua){
        $_SESSION['pass']=$_POST['pass'];
        $_SESSION['usua']=$row_usua['usua_usua'];
        $_SESSION['id_usua']=$row_usua['id_usua'];
        $_SESSION['perm']=$row_usua['perm_usua'];
        $_SESSION['nomb']=$row_usua['nomb_usua'];
        $_SESSION['logeo']='si';

        echo '<script>window.location.replace("././cpanel.php")</script>';
    }else{
        echo 'Error con el usuario o contraseña.';
    }    
}
?>