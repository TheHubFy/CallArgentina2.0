<?php
    session_start();
    $idusua = $_SESSION['id_usua'];
    $hostDDR = $_SERVER['SERVER_NAME'];
    include('../../../api/library.php');
    $link=Conectarse();

    if(isset($_POST["origen"])){ $origen = $_POST["origen"]; }
    if(isset($_POST["nomb"])){ $nomb = $_POST["nomb"]; }
    if(isset($_POST["heard"])){ $heard = $_POST["heard"]; }
    if(isset($_POST["birthday"])){ $birthday = $_POST["birthday"]; }
    if(isset($_POST["comments"])){ $comments = $_POST["comments"]; }


    $destinatario = "lcondori@gmail.com; jrossotti@gmail.com"; 
    $asunto = "Call-Argentina envío un mensaje!"; 
    $cuerpo = ' <html> 
                    <head> 
                        <title>Ticket de incidencia</title> 
                    </head> 
                    <body> 
                        <h1>'.$birthday.'</h1> 
                        <p> 
                            Estos son los datos ingresados.<br>
                            Nombre: '.$nomb.'<br>
                            Email: '.$heard.'<br>
                            Mensaje: '.$comments.'<br> 
                        </p>
                    </body>
                </html>'; 

    //para el envío en formato HTML 
    $headers = "MIME-Version: 1.0\r\n"; 
    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 

    //dirección del remitente 
    $headers .= "From: CallArgentina2.0 <help@call-argentina.com.ar>\r\n"; 

    //dirección de respuesta, si queremos que sea distinta que la del remitente 
    //$headers .= "Reply-To: mariano@desarrolloweb.com\r\n"; 

    //ruta del mensaje desde origen a destino 
    //$headers .= "Return-path: holahola@desarrolloweb.com\r\n"; 

    //direcciones que recibián copia 
    //$headers .= "Cc: maria@desarrolloweb.com\r\n"; 

    //direcciones que recibirán copia oculta 
    //$headers .= "Bcc: lcondori@gmail.com\r\n"; 

    if(!mail($destinatario,$asunto,$cuerpo,$headers)){
        auditoriaLog('Enviar', 'Mail', 'No se pudo enviar mail para generar ticket de '.$nomb, $link);
        echo '<div class="alert alert-danger" role="alert">No se pudo enviar el mail</div>';
    }else{
        auditoriaLog('Enviar', 'Mail', 'No se pudo enviar mail para generar ticket de '.$nomb, $link);
        echo '<div class="alert alert-success" role="alert">¡Ticket generado con éxito!</div>';
    }
?>