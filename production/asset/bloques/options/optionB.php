        <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Traslados de segundo nivel <small>Administración</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                      ...
                    </p>
                    <table id="datatable-fixed-header" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Número</th>
                          <th>Fecha</th>
                          <th>Motivo</th>
                          <th>DNI</th>
                          <th>Nombre</th>
                          <th>Edad</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php                                             
                          $sql="SELECT * FROM t_trasladoc WHERE c_estado in(0,3) AND c_tipo = 'T' ORDER BY c_trfecha";
                          $deri=mysql_query($sql,$link);
                          while($row_tras=mysql_fetch_array($deri)){                      
                          echo '<tr>
                                <td>'.$row_tras['c_nrotraslado'].'</td>
                                <td>'.$row_tras['c_fechainicio'].'</td>
                                <td>'.$row_tras['c_trmotivo'].'</td>
                                <td>'.$row_tras['c_afnrodni'].'</td>
                                <td>'.$row_tras['c_afnombre'].'</td>
                                <td>'.$row_tras['c_afedad'].'</td>
                              </tr>';                                      
                          }                     
                     ?></tbody>
                    </table>
                  </div>
                </div>
              </div>