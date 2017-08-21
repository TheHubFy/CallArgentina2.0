              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Traslado de Programas específicos <small>Administración</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="card-box table-responsive">
                          <p class="text-muted font-13 m-b-30">
                            KeyTable provides Excel like cell navigation on any table. Events (focus, blur, action etc) can be assigned to individual cells, columns, rows or all cells.
                          </p>

                          <table id="datatable-keytable" class="table table-striped table-bordered">
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
                            ?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>