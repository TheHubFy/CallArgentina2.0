            <!-- menu profile quick info -->
            <div class="profile">
              <div class="profile_pic">
                <!--<span class="glyphicon glyphicon-user" aria-hidden="true"></span>-->
                <img src="asset/images/user.png" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Hola,</span>
                <h2><?php echo $_SESSION['nomb']; ?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3></h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-bug"></i> Gestión <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                    <?php if (!(strpos($_SESSION['perm'], '1') === false)){?>
                      <li><a href="cpanel.php">Derivaciones</a></li>
                    <?php } ?>
                    <?php if (!(strpos($_SESSION['perm'], '2') === false)){?>
                      <li><a href="trasladosegundonivel.php">Traslados de segundo nivel</a></li>
                    <?php } ?>
                    <?php if (!(strpos($_SESSION['perm'], '3') === false)){?>
                      <li><a href="trasladosespecificos.php">Traslados de programas específicos</a></li>
                    <?php } ?>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-windows"></i> Admin. <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="profile.php?modifymy">Usuarios Gestión</a></li>
                      <?php if (!(strpos($_SESSION['perm'], '4') === false)){?>
                      <li><a href="usuario.php">Usuarios</a></li>
                      <?php } ?>
                      <?php if (!(strpos($_SESSION['perm'], '5') === false)){?>
                      <li><a href="gestionados.php">Gestionados</a></li>
                      <?php } ?>
                    </ul>
                  </li>
                </ul>
              </div>              
            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a href="profile.php?modifymy" data-toggle="tooltip" data-placement="top" title="Perfil">
                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
              </a>
              <?php if (!(strpos($_SESSION['perm'], '4') === false)){?>
              <a href="auditoria.php" class="menu_toggle" data-toggle="tooltip" data-placement="top" title="Auditoría">
                <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
              </a>
              <?}?>
              <a href="javascript: lock();" data-toggle="tooltip" data-placement="top" title="Actualizar">
                <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
              </a>
              <a href="logout.php" data-toggle="tooltip" data-placement="top" title="Logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="asset/images/user.png" alt=""><?php echo $_SESSION['nomb']; ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="profile.php?modifymy"> Perfil</a></li>
                    <li><a href="contacto.php">Ayuda</a></li>
                    <li><a href="#" data-toggle="modal" data-target="#logout"><i class="fa fa-sign-out pull-right"></i> Salir</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->