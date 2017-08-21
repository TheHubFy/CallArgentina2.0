              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>ABM DE USUARIOS <small> y guarde los cambios</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <div id="result"></div>
                    <br />
                  <?php
                    if(isset($_GET['idusermodify'])){
                      $idusua = $_GET['idusermodify'];
                      $sql="SELECT * FROM t_usua WHERE id_usua = '$idusua' ";                   
                      $trab=mysql_query($sql,$link) or die (mysql_error());
                      $row_usua= mysql_fetch_array($trab);
                      $usua_usua = $row_usua['usua_usua'];
                      $pass_usua = $row_usua['pass_usua'];
                      $nomb_usua = $row_usua['nomb_usua'];

                      if ( !(strpos($row_usua['perm_usua'], '1') === false) ){ 
                        $uno = "checked=checked";
                      }else{
                        $uno = '';                        
                      }
                      if ( !(strpos($row_usua['perm_usua'], '2') === false) ){ 
                        $dos = "checked=checked";
                      }else{
                        $dos = '';                        
                      }
                      if ( !(strpos($row_usua['perm_usua'], '3') === false) ){ 
                        $tres = "checked=checked";
                      }else{
                        $tres = ''; 
                      }
                      if ( !(strpos($row_usua['perm_usua'], '4') === false) ){ 
                        $cuatro = "checked=checked";
                      }else{
                        $cuatro = '';
                      }
                      if ( !(strpos($row_usua['perm_usua'], '5') === false) ){ 
                        $cinco = "checked=checked";
                      }else{
                        $cinco = '';
                      }
                      if($_GET['idusermodify'] == $_SESSION['id_usua']){
                        $origen = 'MODMY';
                      }else{
                        $origen = 'MOD';
                      }

                    }else if(isset($_GET['modifymy'])){
                      $idusua = $_SESSION['id_usua'];
                      $sql="SELECT * FROM t_usua WHERE id_usua = '$idusua' ";                   
                      $trab=mysql_query($sql,$link) or die (mysql_error());
                      $row_usua= mysql_fetch_array($trab);
                      $usua_usua = $row_usua['usua_usua'];
                      $pass_usua = $row_usua['pass_usua'];
                      $nomb_usua = $row_usua['nomb_usua'];

                      if ( !(strpos($row_usua['perm_usua'], '1') === false) ){ 
                        $uno = "checked=checked";
                      }else{
                        $uno = '';                        
                      }
                      if ( !(strpos($row_usua['perm_usua'], '2') === false) ){ 
                        $dos = "checked=checked";
                      }else{
                        $dos = '';                        
                      }
                      if ( !(strpos($row_usua['perm_usua'], '3') === false) ){ 
                        $tres = "checked=checked";
                      }else{
                        $tres = ''; 
                      }
                      if ( !(strpos($row_usua['perm_usua'], '4') === false) ){ 
                        $cuatro = "checked=checked";
                      }else{
                        $cuatro = '';
                      }
                      if ( !(strpos($row_usua['perm_usua'], '5') === false) ){ 
                        $cinco = "checked=checked";
                      }else{
                        $cinco = '';
                      }
                      $origen = 'MODMY';
                    }else{
                      $usua_usua = '';
                      $pass_usua = '';
                      $nomb_usua =  '';
                      $uno = '';
                      $dos = '';
                      $tres = '';
                      $cuatro = '';
                      $cinco = '';
                      $origen = 'ALTA';
                      $idusua = '';
                    }
                  ?>
                    <form class="form-horizontal form-label-left" id="historiac" name="historiac" method="POST" action="asset/bloques/options/action/adminprofile.php">

                      <div class="form-group">
                        <!-- OBTENGO EL ORIGEN DEL FORMULARIO -->
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="hidden" name="origen" value="<?php echo $origen; ?>" >
                        </div>

                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="hidden" name="idd" value="<?php echo $idusua; ?>" >
                        </div>                        
                        <!-- FIN OBTENGO EL ORIGEN DEL FORMULARIO -->  
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Usuario</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" name="usua_usua" value="<?php echo $usua_usua; ?>" placeholder="Usuario">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Contraseña</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" name="pass_usua" value="<?php echo $pass_usua; ?>" placeholder="Contraseña">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre y Apellido</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" name="nomb_usua" value="<?php echo $nomb_usua; ?>"placeholder="Nombre y Apellido">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Permisos
                          <br>
                          <small class="text-navy">Edite los permisos para el usuario</small>
                        </label>

                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" name="perm_usua_1" <?php echo $uno;?> > Derivaciones
                            </label>
                          </div>
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" name="perm_usua_2" <?php echo $dos;?> > Traslados
                            </label>
                          </div>
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" name="perm_usua_3" <?php echo $tres;?> > Programas Específicos
                            </label>
                          </div>
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" name="perm_usua_4" <?php echo $cuatro;?> > Usuarios y auditoría
                            </label>
                          </div>
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" name="perm_usua_5" <?php echo $cinco;?>  > Gestionados
                            </label>
                          </div>                          
                        </div>
                      </div>

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal2">Cancelar</button>
                          <button type="submit" class="btn btn-success">Guardar</button>
                        </div>
                      </div>

                      <!-- Modal -->
                      <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <h4 class="modal-title" id="myModalLabel">Confirmación</h4>
                            </div>
                            <div class="modal-body">
                              ¿Estás seguro que querés cancelar la edición de usuario?
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                              <button type="button" onclick="lock()" class="btn btn-primary">Si</button>
                            </div>
                          </div>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>           