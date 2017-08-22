              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Traslados de segundo nivel <small>autorizaciones</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                      Estas son todas las derivaciones pendientes de gestión.
                    </p>
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                      <tr>
                          <th>Traslado[Número]</th>
                          <th>Traslado[Estado]</th>
                          <th>Traslado[Fecha]</th>
                          <th>Traslado[Motivo]</th>
                          <th>Traslado[Código]</th>

                          <th>Afiliado[DNI]</th>
                          <th>Afiliado[Número]</th>
                          <th>Afiliado[Nombre]</th>
                          <th>Afiliado[Edad]</th>
                          <th>Afiliado[Género]</th> 
                          
                          <th>ORIGEN->[Diagnóstico]</th>
                          <th>ORIGEN->[Nombre]</th>
                          <th>ORIGEN->[Domicilio]</th>
                          <th>ORIGEN->[Número]</th>
                          <th>ORIGEN->[Provincia]</th>
                          <th>ORIGEN->[Partido]</th>
                          <th>ORIGEN->[Localidad]</th>

                          <th>DESTINO->[Institución]</th>
                          <th>DESTINO->[Domicilio]</th>
                          <th>DESTINO->[Número]</th>
                          <th>DESTINO->[Provincia]</th>
                          <th>DESTINO->[Partido]</th>
                          <th>DESTINO->[Localidad]</th>

                          <th>Retorno</th>
                          <th>Espera</th>
                          <th>Quien llama</th>
                          <th>Llamada</th>
                          <th>KM por recorrer</th>
                          <th>Interacciones</th>
                          <th>Estados</th>
                        </tr>
                      </thead>
                      <tbody>
<?php
	$sql = "
            SELECT * 
			FROM t_trasladoc
			WHERE c_estado
			IN ( 0, 3 ) 
			AND c_tipo =  'T'
				UNION ALL 
			SELECT * 	
			FROM t_trasladoc
			WHERE c_estado = 9
			AND c_fechainicio >=  '2017-05-17'
			ORDER BY c_trfecha 
            ";
//2017-05-17
    $deri=mysql_query($sql,$link);
    while($row_tras=mysql_fetch_array($deri)){
        if($row_tras["c_estado"]=='0'){$estado = "NO DEFINIDO";}else if($row_tras["c_estado"] == '3'){$estado = 'PENDIENTE';}else if($row_tras["c_estado"] == '9'){$estado = 'OBSERVADO';}else{$estado = "UNDEFINED";}
        $c_orcodlocalidad = str_replace('(CABECERA PDO.)', '', $row_tras['c_orcodlocalidad']);
        $c_ordomicilio = str_replace($row_tras['c_orcodpartido'], '', $row_tras['c_ordomicilio']);
        $c_ordomicilio = str_replace($c_orcodlocalidad, '', $c_ordomicilio);

        $c_decodlocalidad = str_replace('(CABECERA PDO.)', '', $row_tras['c_decodlocalidad']);
        $c_dedomicilio = str_replace($row_tras['c_orcodpartido'], '', $row_tras['c_dedomicilio']);
        $c_dedomicilio = str_replace($c_decodlocalidad, '', $c_dedomicilio); 
        echo '<tr>';
            echo '<td>'.$row_tras["c_nrotraslado"].'</td>';
            echo '<td>'.$estado.'</td>';
            echo '<td>'.$row_tras["c_fechainicio"].'</td>';
            echo '<td>'.$row_tras["c_trmotivo"].'</td>';           
            echo '<td>'.$row_tras["c_codigoa"].'</td>';
            echo '<td>'.$row_tras["c_afnrodni"].'</td>';
            echo '<td>'.$row_tras["c_afnro"].'</td>';
            echo '<td>'.utf8_encode($row_tras['c_afnombre']).'</td>';
            echo '<td>'.$row_tras["c_afedad"].'</td>';
            echo '<td>'.$row_tras["c_afsexo"].'</td>';
            echo '<td>'.utf8_encode($row_tras['c_afdiagnostico']).'</td>';
            echo '<td>'.utf8_encode($row_tras['c_ornombre']).'</td>';
            echo '<td>'.utf8_encode($c_ordomicilio).'</td>';
            echo '<td>'.$row_tras["c_ornro"].'</td>';
            echo '<td>'.$row_tras["c_orcodprovincia"].'</td>';
            echo '<td>'.$row_tras["c_orcodpartido"].'</td>';
            echo '<td>'.utf8_encode($c_orcodlocalidad).'</td>';
            echo '<td>'.$row_tras["c_denombre"].'</td>';
            echo '<td>'.utf8_encode($c_dedomicilio).'</td>';
            echo '<td>'.$row_tras["c_denro"].'</td>';
            echo '<td>'.$row_tras["c_decodprovincia"].'</td>';
            echo '<td>'.$row_tras["c_decodpartido"].'</td>';
            echo '<td>'.utf8_encode($c_decodlocalidad).'</td>';
            echo '<td>'.$row_tras["c_deretorno"].'</td>';
            echo '<td>'.$row_tras["c_deespera"].'</td>';
            echo '<td>'.$row_tras["c_quienllama"].'</td>';
            echo '<td>'.$row_tras["c_regllamada"].'</td>';
            echo '<td>'.$row_tras["c_km_recorrido"].'</td>';
            echo '<td>
                    <div class="btn-group" role="group" aria-label="...">
                      <a href="http://www.call-argentina.com.ar/aprobaciones/derivacion/mapa.php?tipo=segundonivel&nro='.$row_tras["c_nrotraslado"].'" target="_blank" class="btn btn-default" ><i class="glyphicon glyphicon-road"></i> Ruta </a>
                      <a href="javascript:viewer('.$row_tras["c_nrotraslado"].',\'images\', \'2\')" class="btn btn-default" ><i class="glyphicon glyphicon-picture"></i> Generar visor </a>
                      <a href="javascript:viewer('.$row_tras["c_nrotraslado"].',\'comentarios\', \'2\')" class="btn btn-default" ><span class="glyphicon glyphicon-inbox" aria-hidden="true"></span> Comentarios </a>
                      <!--<a href="javascript:viewer('.$row_tras["c_nrotraslado"].',\'chat\', \'2\')" class="btn btn-default" ><span class="glyphicon glyphicon-comment" aria-hidden="true"></span> Chat </a>-->
                    </div>
                </td>';
            echo '<td>
                    <div class="btn-group" role="group" aria-label="...">
                      <a href="javascript:setEstado('.$row_tras["c_nrotraslado"].',\'t_trasladoc\', \'trasladosegundo\', \'Autorizado\' )" class="btn btn-default" ><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span> Aprobado </a>
                      <a href="javascript:viewer('.$row_tras["c_nrotraslado"].',\'chatObservado\', \'2\')" class="btn btn-default" ><span class="glyphicon glyphicon-comment" aria-hidden="true"></span> Observado </a>
                      <a href="javascript:setEstado('.$row_tras["c_nrotraslado"].',\'t_trasladoc\', \'trasladosegundo\', \'Rechazado\' )" class="btn btn-default" ><span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span> Rechazado </a>
                    </div>
                  </td>';
        echo '</tr>';
      }    
?>
                      </tbody>
                    </table>

<div id="viewerNow"></div>

<button id="Click_simulado" class="btn btn-default" data-toggle="modal" data-target=".bs-example-modal-lg">Ver imagen</button>

<div id="estadoAccion"></div>
<div id="estadoView"></div>
<button id="click_comments" type="button" class="btn btn-default" data-toggle="modal" data-target=".bs-example-modal-sm2"><span class="glyphicon glyphicon-inbox" aria-hidden="true"></span> Comentarios</button>
<button id="click_chat" type="button" class="btn btn-default" data-toggle="modal" data-target=".bs-example-modal-sm3"><span class="glyphicon glyphicon-comment" aria-hidden="true"></span> Chat</button>
 
<div id="chatResultado"></div>                                       

                    <!-- Fin Small modal -->                                       
                  </div>
                </div>
              </div>
