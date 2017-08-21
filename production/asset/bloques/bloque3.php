<div class="col-md-12 col-sm-12 col-xs-12" role="main">
          <div class="">
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Usuarios</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div id="deleteresponse"></div>
                    <p>Listado de usuarios de sistema <a href="profile.php" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> Alta </a> </p>

                    <!-- start project list -->
                    <table class="table table-striped projects">
                      <thead>
                        <tr>
                          <th style="width: 1%">#</th>
                          <th style="width: 20%">Project Name</th>
                          <th>Status</th>
                          <th style="width: 20%">#Edit</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                            $sql="SELECT * FROM t_usua WHERE activ_usua IS NULL ORDER BY nomb_usua";
                            $usua=mysql_query($sql,$link);
                            if(isset($_GET['idd'])){ $idd_get = $_GET['idd']; }else{$idd_get='0';}
                            
                            while($row_usua=mysql_fetch_array($usua)){
                              
                              if($row_usua['id_usua'] == $idd_get){
                                $success = '<button type="button" class="btn btn-success btn-xs">Success</button>';
                              }else{
                                $success = '';
                              }
                              echo '<tr>
                                      <td>'.$row_usua['id_usua'].'</td>
                                      <td>
                                      <b><a>'.strtoupper($row_usua["usua_usua"]).'</a></b>
                                      <br />
                                      <small>'.$row_usua["nomb_usua"].'</small>
                                      </td>
                                      <td>'.$success.'</td>
                                      <td>
                                      <a href="profile.php?idusermodify='.$row_usua['id_usua'].'" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Modificar </a>
                                      <!--<a href="#" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal2323"><i class="fa fa-trash-o"></i> Borrar </a>-->
                                      <a href="javascript:deleteUser('.$row_usua['id_usua'].')" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Borrar </a>
                                      </td>
                                  </tr>';
                            }    
                        ?>
                      </tbody>
                    </table>

                    <!-- Modal -->
                    <div class="modal fade" id="myModal2323" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Confirmación</h4>
                          </div>
                          <div class="modal-body">
                            ¿Estás a punto de eliminar el registro, confirmás?
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            <a href="asset/bloques/options/action/adminprofile.php?iduserdelete=<?php echo $row_usua['id_usua']?>" class="btn btn-danger"> Si </a>
                          </div>
                        </div>
                      </div>
                    </div>                    
                    <!-- end project list <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal2">Cancelar</button> -->

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>