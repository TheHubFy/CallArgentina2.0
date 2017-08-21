<?php
error_reporting(0);
    session_start();
    $idusua = $_SESSION['id_usua'];
    include('../../../api/library.php');
    $link=Conectarse();
    $numgestion = $_POST['numgestion'];
    $accion = $_POST['accion'];
    $posicion = $_POST['posiciones'];

    if($posicion == "1"){
      $subcarpeta = 'derivacion';
    }else if($posicion == "2"){
      $subcarpeta = 'segundonivel';
    }else{
      $subcarpeta = 'especificos';
    }

    if($accion == 'images'){

    $directorio = '../../../archivos/'.$subcarpeta.'/'.$numgestion.'/';
    $ficheros = scandir($directorio, 1);
    $z=1;
    if(count($ficheros)==1){echo '<script>alert("La derivación no posee imagenes adjuntas en '.$subcarpeta.' para la gestión '.$numgestion.' ");</script>';}else{
    echo '
        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
              <!-- Wrapper for slides -->
              <div class="carousel-inner">';
              foreach ($ficheros as $file){
                if (!is_dir($directorio.$file)){
                  if($z == 1){echo '<div class="item active">';}else{echo '<div class="item">';}
                  echo '
                    <img class="img-responsive" src="'.str_replace("../../..","asset/",$directorio.$file).'" alt="...">
                      <div class="carousel-caption">
                      <p>'.$numgestion.'</p>
                      <p>'.$z.' de '.$cantidad.'</p>
                      </div>
                    </div>
                  ';
                  //echo $directorio.$file.'<br>';
                  $z=$z+1;
                }
              }
    echo '          
              </div>
          <!-- Controls -->
          <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
          </a>
          <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
          </a>
        </div>
            </div>
          </div>
        </div>';
    }
    }else if($accion == 'comentarios'){

    if($posicion=="1"){
      $sql = "SELECT c_observa, c_afnombre FROM t_incidentec WHERE  c_nroincidente = {$numgestion}";
    }else if($posicion=="2"){
      $sql = "SELECT c_observa, c_afnombre FROM t_trasladoc WHERE  c_nrotraslado = {$numgestion}";
    }else{
      $sql = "SELECT c_observa, c_afnombre FROM t_trasladoc WHERE  c_nrotraslado = {$numgestion}";
    }

    $deri=mysql_query($sql,$link);
    while($row_deri=mysql_fetch_array($deri)){
      $nombre = $row_deri['c_afnombre'];
      $observaciones = $row_deri['c_observa'];     
    }
    if($observaciones == ''){$observaciones = 'Sin comentarios';}
    echo '<!-- Small modal -->
            <div class="modal fade bs-example-modal-sm2" tabindex="-1" role="dialog" aria-labelledby="Comentarios">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Call Argentina 2.0</h4>
                    </div>
                    <div class="modal-body">

                      <h3>'.$nombre.'</h3>
                      <p>'.utf8_encode($observaciones).'</p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                  </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div>';
    }else if($accion == "chatObservado"){

    $sql="SELECT c.nro_tablaorigen, c.mensaje, c.fechahora, u.nomb_usua 
          FROM t_chat_historial c 
          join t_usua u on c.usuario = u.id_usua 
          WHERE c.nro_tablaorigen = '".$numgestion."' ORDER BY c.fechahora";

    $deri=mysql_query($sql,$link);   

    echo '<!-- Small modal -->
          <div class="modal fade bs-example-modal-sm3" tabindex="-1" role="dialog" aria-labelledby="chat">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Call Argentina 2.0</h4>
                  </div>
                  <div class="modal-body">
                    	<div class="table-responsive">
                        <table bgcolor="#000000" class="table table-striped">
                        <tr>
                        <th>Numero</th>
                        <th>Mensaje</th>
                        <th>Fecha/Hora</th>
                        <th>usuario</th>
                        </tr>
                        ';
                        while($row_deri=mysql_fetch_array($deri)){
                        echo '<tr>
                                <td>'.$row_deri["nro_tablaorigen"].'</td>
                                <td>'.utf8_decode($row_deri["mensaje"]).'</td>
                                <td>'.$row_deri["fechahora"].'</td>
                                <td>'.$row_deri["nomb_usua"].'</td>
                              </tr>';
                        }
                        echo '
                        </table> 
                      </div>
<hr>
                      <form>
                      <div class="form-group">
                        <textarea class="form-control" id="chatComment" rows="3"></textarea>
                        <input type="hidden" id="chatObservado" value="chatObservado">
                      </div>
                      
                      <p class="help-block">Escriba su comentario y presione enviar el mismo quedará asociado a '.$numgestion.'</p>
                      
                      <!--<button type="submit" class="btn btn-info">Enviar</button>-->
                      <a href="javascript:sendChat('.$numgestion.', \''.$posicion.'\')" class="btn btn-warning" ><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> Observar </a>

                      </form>

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
          </div>';

    }else{
    $sql="SELECT c.nro_tablaorigen, c.mensaje, c.fechahora, u.nomb_usua 
          FROM t_chat_historial c 
          join t_usua u on c.usuario = u.id_usua 
          WHERE c.nro_tablaorigen = '".$numgestion."' ORDER BY c.fechahora";

    $deri=mysql_query($sql,$link);   

    echo '<!-- Small modal -->
          <div class="modal fade bs-example-modal-sm3" tabindex="-1" role="dialog" aria-labelledby="chat">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Call Argentina 2.0</h4>
                  </div>
                  <div class="modal-body">
                    	<div class="table-responsive">
                        <table bgcolor="#000000" class="table table-striped">
                        <tr>
                        <th>Numero</th>
                        <th>Mensaje</th>
                        <th>Fecha/Hora</th>
                        <th>usuario</th>
                        </tr>
                        ';
                        while($row_deri=mysql_fetch_array($deri)){
                        echo '<tr>
                                <td>'.$row_deri["nro_tablaorigen"].'</td>
                                <td>'.utf8_decode($row_deri["mensaje"]).'</td>
                                <td>'.$row_deri["fechahora"].'</td>
                                <td>'.$row_deri["nomb_usua"].'</td>
                              </tr>';
                        }
                        echo '
                        </table> 
                      </div>
<hr>
                      <form>
                      <div class="form-group">
                        <textarea class="form-control" id="chatComment" rows="3"></textarea>
                      </div>
                      
                      <p class="help-block">Escriba su comentario y presione enviar el mismo quedará asociado a '.$numgestion.'</p>
                      
                      <!--<button type="submit" class="btn btn-info">Enviar</button>-->
                      <a href="javascript:sendChat('.$numgestion.', \''.$posicion.'\')" class="btn btn-info" ><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> Enviar </a>

                      </form>

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
          </div>';
    }    
?>