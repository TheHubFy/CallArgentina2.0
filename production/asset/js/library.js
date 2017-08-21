//Versión 1.0
//Configuración de las secciones
var section = ["derivaciones", "trasladosSN", "trasladosPE", "usuariosg", "usuario", "gestionados", "auditoria", "contacto", "profile"];

visualizar('derivaciones');

function loginCkek(){
    if (document.formlogin.user.value.length==0 || document.formlogin.pass.value.length==0 ){ 
        $('#messenger').html('<p class="help-block"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span>  Ups, no podés loguearte sin usuario o contraseña.</p>');       
    }else{
        $.ajax({
          type: 'POST',
          url: 'asset/api/clase.php?login',
          data: {user: document.formlogin.user.value, pass: document.formlogin.pass.value},
          success: function(data) {			 
            $('#messenger').html(data);
          }
        })        
        return false;
    }   
}

function visualizar(v){
    //Recorro todas las secciones y las oculto.
    for(var x = 0; x < section.length; x++){
            $("#"+section[x]).hide();       
    }
    //Pregunto si el valor pasado por parámetro está visible.
    if( $('#'+v).is(":visible") ){
        $("#"+v).hide();
    }else{
        $("#"+v).show();
    }
}

function lock(){
    window.location = "usuario.php";
}

function LogOut(){
    window.location="logout.php";
}

function viewer ( idd, verbo, posicion ){


        $(document).ajaxStart(function() { 
            
        }).ajaxStop(function() {
            //alert('Visor de imágenes generado, presion [Ver imagen]');
        });    

        $.ajax({
            type: 'POST',
            url: 'asset/bloques/options/action/viewer.php',
            data: {numgestion: idd, accion: verbo, posiciones: posicion},
            success: function(data) {

            if(verbo == 'images'){
                $('#viewerNow').html(data);
                $("#Click_simulado").trigger("click"); 
            }else if(verbo == 'comentarios'){
                $('#estadoView').html(data);
                $("#click_comments").trigger("click"); 
            }else if(verbo == 'chatObservado'){
                $('#estadoView').html(data);
                $("#click_chat").trigger("click");                
            }else{
                $('#estadoView').html(data);
                $("#click_chat").trigger("click");
            }			 
            
            }
        })
}

function setEstado ( idd , tabla, origen, estado){

    var r = confirm("¿Estás segur@ que querés pasar a " + estado + " esta derivación?");
    if (r == true) {

        $(document).ajaxStart(function() { 
            
        }).ajaxStop(function() {

        });    

        $.ajax({
            type: 'POST',
            url: 'asset/bloques/options/action/gestion.php',
            data: {numgestion: idd, origenTable: tabla, proceso: origen, estado: estado},
            success: function(data) {			 
            $('#estadoAccion').html(data);
            //$("#Click_simulado").trigger("click");
            }
        })
    }
}


function sendChat(id,posicion){

    var chatObservado = $('#chatObservado').val();

    var comment = $('#chatComment').val();
    
    var r = confirm("¿Estás segur@ que querés enviar este comentario [" + comment + "] ?");
    if (r == true) {
        $(document).ajaxStart(function() { 
            
        }).ajaxStop(function() {

        });    
        
        $.ajax({
            type: 'POST',
            url: 'asset/bloques/options/action/chat.php',
            data: {nrogestion: id, comentario: comment, posiciones: posicion},
            success: function(data) {			 
            $('#chatResultado').html(data);

                if(chatObservado == 'chatObservado'){
                    if(posicion == "1"){
                        setEstado(id,'t_incidentec', 'derivaciones', 'Observado' );
                    }else if(posicion == "2"){
                        setEstado(id,'t_trasladoc', 'trasladosegundo', 'Observado' );
                    }else{

                    }
                }            

            $("#click_chat").trigger("click");
            }
        })
    }
    
}