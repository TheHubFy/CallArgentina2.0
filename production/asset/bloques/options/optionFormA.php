
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>SOPORTE TÉCNICO <small>Generación de Ticket</small></h2>

                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div id="resultado"></div>
                    <br />
                    <form id="soporte" data-parsley-validate class="form-horizontal form-label-left" name="soporte" method="POST" action="asset/bloques/options/action/sendticket.php">

                      <div class="form-group">
                        <!-- OBTENGO EL ORIGEN DEL FORMULARIO -->
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="hidden" name="origen" value="SOPORTE" >
                        </div>                       
                        <!-- FIN OBTENGO EL ORIGEN DEL FORMULARIO -->  
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Usuario <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="first-name" name="nomb" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $_SESSION['nomb']?>" readonly>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="heard" class="control-label col-md-3 col-sm-3 col-xs-12">Motivo de consulta <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="heard" name="heard" class="form-control" required>
                            <!--<option value="">Seleccione...</option>-->
                            <option value="duda">Tengo una duda</option>
                            <option value="sugerencia">Sugerir un cambio</option>
                            <option value="error">Reportar un error</option>
                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Fecha <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="birthday" name="birthday" class="date-picker form-control col-md-7 col-xs-12" value="<?php echo date("d").'/'.date("m").'/'.date("Y").''; ?>" required="required" type="text" readonly>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Comentarios <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea name="comments" class="form-control" rows="3"></textarea>
                        </div>
                      </div>                      
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Cancelar</button>
                          <button type="submit" id="enviaTicket" class="btn btn-success">Enviar</button>
                        </div>
                      </div>

                      <!-- Modal -->
                      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <h4 class="modal-title" id="myModalLabel">Confirmación</h4>
                            </div>
                            <div class="modal-body">
                              ¿Estás seguro que querés cancelar la edición del ticket?
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