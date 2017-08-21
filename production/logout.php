<?php
    session_start();
    session_unset();
    session_destroy();
    if(isset($_GET['timeout'])){$origen = 'timeout';}else{$origen='logout';}
    header('Location: index.php?'.$origen);
?>