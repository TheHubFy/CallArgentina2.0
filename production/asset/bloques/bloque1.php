              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>DERIVACIONES <small>autorizaciones</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                      Estas son todas las derivaciones pendientes de gestión.
                    </p>
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                      <tr>
                          <th>Número</th>
                          <th>Estado</th>
                          <th>Fecha</th>
                          <th>DNI</th>
                          <th>Núm. afiliado</th>
                          <th>Nombre</th>
                          <th>Provincia</th>
                          <th>Partido</th>
                          <th>Localidad</th>
                          <th>Edad</th>
                          <th>Género</th>
                          <th>Contacto</th>
                          <th>Teléfono</th>
                          <th>Diagnóstico</th>
                          <th>Motivo</th>
                          <th>Tipo móvil</th>
                          <th>Requerimiento</th>
                          <th>Quien</th>
                          <th>Código</th>
                          <th>Institución</th>
                          <th>Domicilio</th>
                          <th>Provincia</th>
                          <th>Partido</th>
                          <th>Localidad</th>
                          <th>Tél. Htal.</th>
                          <th>Cat. Htal.</th>
                          <th>Neo Htal.</th>
                          <th>Sector Htal.</th>
                          <th>Nombre Dr.</th>
                          <th>Interacciones</th>
                          <th>Estados</th>
                        </tr>
                      </thead>
                      <tbody>
<?php
    $sql="SELECT * 
        FROM t_incidentec
        WHERE c_estado
        IN ( 0, 3 ) 
        UNION ALL 
        SELECT * 
        FROM t_incidentec
        WHERE c_fechainicio >=  '2017-05-17'
        AND c_estado =9
        ORDER BY c_fechainicio";

    $deri=mysql_query($sql,$link);
    while($row_deri=mysql_fetch_array($deri)){
      if($row_deri["c_estado"]=='0'){$estado = "NO DEFINIDO";}else if($row_deri["c_estado"] == '3'){$estado = 'PENDIENTE';}else if($row_deri["c_estado"] == '9'){$estado = 'OBSERVADO';}else{$estado = "UNDEFINED";}
        echo '<tr>';
            echo '<td>'.$row_deri["c_nroincidente"].'</td>';
            echo '<td>'.$estado.'</td>';
            echo '<td>'.$row_deri["c_fechainicio"].'</td>';           
            echo '<td>'.$row_deri["c_afnrodni"].'</td>';
            echo '<td>'.$row_deri["c_afnro"].'</td>';
            echo '<td>'.$row_deri["c_afnombre"].'</td>';
            echo '<td>'.$row_deri["c_afcodprovincia"].'</td>';
            echo '<td>'.$row_deri["c_afcodpartido"].'</td>';
            echo '<td>'.str_replace("(CABECERA PDO.)","",$row_deri["c_afcodlocalidad"]).'</td>';
            echo '<td>'.$row_deri["c_afedad"].'</td>';
            echo '<td>'.$row_deri["c_afsexo"].'</td>';
            echo '<td>'.$row_deri["c_afcontacto"].'</td>';
            echo '<td>'.$row_deri["c_aftelefono"].'</td>';
            echo '<td>'.$row_deri["c_afdiagnostico"].'</td>';
            echo '<td>'.$row_deri["c_afmotivo"].'</td>';
            echo '<td>'.$row_deri["c_aftipomovil"].'</td>';
            echo '<td>'.$row_deri["c_afrequerim"].'</td>';
            echo '<td>'.$row_deri["c_afquien"].'</td>';
            echo '<td>'.$row_deri["c_orcodhospital"].'</td>';
            echo '<td>'.$row_deri["c_ornombrehospital"].'</td>';
            echo '<td>'.$row_deri["c_ordomiciliohospital"].'</td>';
            echo '<td>'.$row_deri["c_orcodprovinciahospital"].'</td>';
            echo '<td>'.$row_deri["c_orcodpartidohospital"].'</td>';
            echo '<td>'. str_replace("(CABECERA PDO.)","",$row_deri["c_orcodlocalidadhospital"]).'</td>';
            echo '<td>'.$row_deri["c_ortelefonohospital"].'</td>';
            echo '<td>'.$row_deri["c_orcategoriahospital"].'</td>';
            echo '<td>'.$row_deri["c_orneohospital"].'</td>';
            echo '<td>'.$row_deri["c_orsector"].'</td>';
            echo '<td>'.$row_deri["c_ornombredr"].'</td>';
            echo '<td>
                    <div class="btn-group" role="group" aria-label="...">
                      <a href="javascript:viewer('.$row_deri["c_nroincidente"].',\'images\', 1)" class="btn btn-default" ><i class="glyphicon glyphicon-picture"></i> Generar visor </a>
                      <a href="javascript:viewer('.$row_deri["c_nroincidente"].',\'comentarios\', 1)" class="btn btn-default" ><span class="glyphicon glyphicon-inbox" aria-hidden="true"></span> Comentarios </a>
                      <a href="javascript:viewer('.$row_deri["c_nroincidente"].',\'chat\', 1)" class="btn btn-default" ><span class="glyphicon glyphicon-comment" aria-hidden="true"></span> Chat </a>
                    </div>
                </td>';
            echo '<td>
                    <div class="btn-group" role="group" aria-label="...">
                      <a href="javascript:setEstado('.$row_deri["c_nroincidente"].',\'t_incidentec\', \'derivaciones\', \'Autorizado\' )" class="btn btn-default" ><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span> Aprobado </a>
                      <a href="javascript:viewer('.$row_deri["c_nroincidente"].',\'chatObservado\', 1)" class="btn btn-default" ><span class="glyphicon glyphicon-comment" aria-hidden="true"></span> Observado </a>
                      <a href="javascript:setEstado('.$row_deri["c_nroincidente"].',\'t_incidentec\', \'derivaciones\', \'Rechazado\' )" class="btn btn-default" ><span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span> Rechazado </a>
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
