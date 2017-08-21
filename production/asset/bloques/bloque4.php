              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Gestionados <small>Administración</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                      Son todas las gestiones que se realizaron sobre los traslados o las derivaciones.
                    </p>
                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <!--class="table table-striped table-bordered dt-responsive nowrap"  table table-striped table-bordered-->
                      <thead>
                        <tr>
                          <th>Número</th>
                          <th>Fecha</th>
                          <th>Tipo</th>
                          <th>Estado</th>
                          <th>Paciente</th>
                          <th>Cod. Verificación</th>
                          <th>Observación</th>
                          <th>Usuario</th>
                          <th><a href="http://call-argentina.com.ar/aprobaciones/derivacion/xls_gestionados.php"><h3><i class="fa fa-file-excel-o" aria-hidden="true"></i></h3></a></th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php 
                        $sql="SELECT * FROM t_gestion left JOIN t_usua ON id_usua = id_usua_gestion ORDER BY fecha_gestion DESC limit 0,30";
                        $deri=mysql_query($sql,$link);
                        $estado = '';
                        while($row_deri=mysql_fetch_array($deri)){ 
                                  switch ($row_deri['estado_gestion']){
                                        case 7:
                                            $estado = "APROBADO";
                                            break;
                                        case 8:
                                            $estado = "RECHAZADO";    
                                            break;
                                        case 9:
                                            $estado = "OBSERVADO";    
                                            break;
                                    }

                        //Para Google Maps                                    
                        if($row_deri['tipo_gestion']!= 'derivaciones'){
                          
                          $button = '<a href="http://www.call-argentina.com.ar/aprobaciones/derivacion/mapa.php?tipo=segundonivel&nro='.$row_deri["nro_gestion"].'" target="_blank" ><i id="icon-new" class="fa fa-map" aria-hidden="true"></i> </a>';
                        }else{
                          $button = '';
                        }

                        if($row_deri["tipo_gestion"] != 'DERIVACIONES'){
                          $tipGestion = 'traslado';
                        }else{
                          $tipGestion = 'derivaciones';
                        }
                                                             
                              echo '<tr>
                                      <td>'.$row_deri['nro_gestion'].'</td>
                                      <td>'.date("d/m/Y", strtotime($row_deri['fecha_gestion'])).'</td>
                                      <td>'.strtoupper($row_deri['tipo_gestion']).'</td>
                                      <td>'.$estado.'</td>
                                      <td>'.wordwrap($row_deri['nombrepaciente'], 10, "<br />\n").'</td>
                                      <td>'.$row_deri['clave_gestion'].'</td>
                                      <td>
<a href="javascript:viewer('.$row_deri["nro_gestion"].',\'chat\', \'3\')"><span class="glyphicon glyphicon-comment" aria-hidden="true"></span> Chat </a>                                      
                                      '.wordwrap($row_deri['obs_gestion'], 20, "<br />\n").'</td>
                                      <td>'.$row_deri['nomb_usua'].'</td>
                                      <td> 
                                        <a href="http://call-argentina.com.ar/aprobaciones/derivacion/pdf_gestion.php?idgestion='.$row_deri["id_gestion"].'&tipogestion='.$tipGestion.'" target="_blank">
                                          <i id="icon-new" class="fa fa-file-pdf-o" aria-hidden="true"></i>
                                        </a>
                                        '.$button.'
                                      </td>
                                    </tr>';        
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
                  </div>
                </div>
              </div>