              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Auditorias de cambios</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                      Toda actividad de la aplicación quedó registrado en un log de audoría.
                    </p>
                    <table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
                      <thead>
                        <tr>
                          <th>Número</th>
                          <th>Fecha</th>
                          <th>Nombre</th>
                          <th>Acción</th>
                          <th>Sección</th>
                          <th>Nota</th>
                        </tr>
                      </thead>
                      <tbody>
                            <?php                        
                              $sql="SELECT * FROM t_auditoria ORDER BY id desc";
                              $deri=mysql_query($sql,$link);
                                while($row_tras=mysql_fetch_array($deri)){                      
                                echo '<tr>
                                      <td>'.$row_tras['id'].'</td>
                                      <td>'.$row_tras['fechahora'].'</td>
                                      <td>'.$row_tras['nombre'].'</td>
                                      <td>'.$row_tras['accion'].'</td>
                                      <td>'.$row_tras['seccion'].'</td>
                                      <td>'.$row_tras['otro'].'</td>
                                    </tr>';                                      
                                }
                            ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>