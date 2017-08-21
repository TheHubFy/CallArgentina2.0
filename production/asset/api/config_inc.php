<?php
//Versión 1.0
/*  $userapp = 'autoriza';
    $passapp = 'aut0r1za';
    $baseapp = 'autoriza';
    $hostapp = '200.41.168.147';
*/
if($_SERVER['SERVER_NAME']=='localhost'){
    $userapp = 'root';
    $passapp = '';
    $baseapp = 'callArgentina';
    $hostapp = 'localhost';
}else{
/* Testing Call */
    $userapp = 'call_argentina02';
    $passapp = 'agaces2011';
    $baseapp = 'call_argentina02';
    $hostapp = 'localhost';
}
/* Local
    $userapp = 'root';
    $passapp = '';
    $baseapp = 'callArgentina';
    $hostapp = 'localhost';
*/



    $_SESSION['userapp'] = $userapp;
    $_SESSION['passapp'] = $passapp;
    $_SESSION['baseapp'] = $baseapp;
    $_SESSION['hostapp'] = $hostapp;

?>