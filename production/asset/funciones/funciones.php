<script language="javascript">
function pintar(tr)
{
	//tr = document.getElementById(tr);
	tr.style='background-color:#000000';
}

function despintar(tr)
{
	//tr = document.getElementById(tr);
	tr.style='background-color:#AAEECC';
}

function numerico(fld)
{
   var ValidChars = "0123456789.";
   var Char;

   for (i = 0; i < fld.value.length; i++) 
      { 
      Char = fld.value.charAt(i); 
		if (ValidChars.indexOf(Char) == -1) 
         {
         alert("Debe ingresar solo numeros. Separar los terminos con un . (punto)");
		 fld.focus();
		 return;
         }
	  }

}

function gestion(nro, nombre, tipo)
{
    var cmb = document.getElementById('cmb_gestion'+nro);
     
     if (cmb.value =="7")// si estado es aprobado
     {
         abrirpopup('popup_gestion.php?nro='+nro+'&nombre='+nombre+'&tipo='+tipo+'&estado='+cmb.value, 650, 400);
     }else{
         abrirpopup('popup_gestion.php?nro='+nro+'&nombre='+nombre+'&tipo='+tipo+'&estado='+cmb.value, 650, 400);
     }
}

function abrirpopup(direccion, ancho, alto,nombre_ventana){ 
     var opciones = "width="+ancho+",height="+alto 
     var ventana = window.open(direccion,nombre_ventana,opciones); 
}                     
//-->     

</script>

<?php

//error_reporting(0);

function sliderDocumentos($subcarpeta, $nro)
{
    $directorio = 'asset/archivos/'.$subcarpeta.'/'.$nro.'/';
    $ficheros  = scandir($directorio, 1);
    $z=1;
    ?>
            
    <td>
        <div id="links<?php echo $nro;?>">
            <?php foreach ($ficheros as $file)
            {
                if (!is_dir($directorio.$file))
                {?>
                <a <?php if($z!=1){ echo "style='display: none;'";}?> href="<?php echo $directorio.$file;?>" title="<?php echo $z;?>" data-gallery="#blueimp-gallery<?php echo $nro;?>"><img border="0" src="../img/buscar.png" /></a>
            <?php 
                $z=$z+1;
                }
            }?>
            
        </div>
    </td>

            <!-- The Bootstrap Image Gallery lightbox, should be a child element of the document body -->
<div id="blueimp-gallery<?php echo $nro;?>" class="blueimp-gallery">
    <!-- The container for the modal slides -->
    <div class="slides"></div>
    <!-- Controls for the borderless lightbox -->
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
    <!-- The modal dialog, which will be used to wrap the lightbox content -->
    <div class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body next"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left prev">
                        <i class="glyphicon glyphicon-chevron-left"></i>
                        Previous
                    </button>
                    <button type="button" class="btn btn-primary next">
                        Next
                        <i class="glyphicon glyphicon-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>  
<?php
}


function actualizarGestion($tipo, $nro, $estado, $obs, $idusuario, $datosorigen, $link)
{
    if ($tipo=='derivacion')
    {
        $sql="UPDATE t_incidentec SET c_estado = {$estado} WHERE c_nroincidente = {$nro}";
		$id = 'D'.$nro.date("Y").date("m").date("d");
		$toTGestion = "UPDATE t_gestion set clave_gestion = '{$id}' where nro_gestion = {$nro}";
    }else{
        $sql="UPDATE t_trasladoc SET c_estado = {$estado}  WHERE c_nrotraslado = {$nro}";
		$id = 'T2'.$nro.date("Y").date("m").date("d");
		$toTGestion = "UPDATE t_gestion set clave_gestion = '{$id}' where nro_gestion = {$nro}";
    }
	//Actualizo el estado
    mysql_query($sql, $link);

    //echo $sql."<br/>";
    $sql="INSERT INTO t_gestion (tipo_gestion, nro_gestion, estado_gestion, obs_gestion, id_usua_gestion, datosorigen_gestion) VALUES 
        ('{$tipo}', {$nro}, {$estado}, '{$obs}', {$idusuario}, '{$datosorigen}')";

    mysql_query($sql, $link);
   // echo $sql;

   	//Actualizo el codigo verificado
    mysql_query($toTGestion, $link);
    ?> 

    <script language="javascript">
    {
        alert('Cambios realizados');
        opener.location.reload();
        window.close();
    }
    </script>
    
<?php
}

function fechaMuestra($f)
{

	$f=date("d-m-Y",strtotime($f));
	
	return $f;
}

function fechaDB($f)
{

	$f=date("Y-m-d",strtotime($f));
	
	return $f;
}

function actualizaKM($km, $idpat, $c)//ACTUALIZA EL KM DEL CAMION
{
	reviCercana($idpat, $c);
	
	$sql = "UPDATE t_pat SET km_pat = $km WHERE id_pat = $idpat";	
	mysql_query($sql, $c);	
}

function promCarga($lt_carga, $km_carga, $id_pat_carga, $c)// CALCULA EL PROMEDIO DE CONSUMO
{
	$sql = "SELECT * FROM t_carga INNER JOIN t_pat ON id_pat_carga = id_pat WHERE id_pat_carga = '$id_pat_carga' ORDER BY id_carga DESC";
	$km=mysql_query($sql, $c);
	$row_km=mysql_fetch_array($km);

	if (mysql_num_rows($km) > 0)
	{
		$kmr=$km_carga - $row_km["km_carga"];
		$prom_carga=($lt_carga / $kmr)*100;
	}else
	{
		$sql = "SELECT * FROM t_pat WHERE id_pat = '$id_pat_carga'";
		$km=mysql_query($sql, $c);
		$row_km=mysql_fetch_array($km);

		$kmr=$km_carga - $row_km["km_pat"];
		$prom_carga=($lt_carga / $kmr)*100;	
	}
	
	return $prom_carga;
}


function pasoProm($prom_carga, $id_pat, $c)//VERIFICA SI EL PROMEDIO RECIBIDO SUPERA EL PROMEDIO DEL CAMION
{
	$sql = "SELECT * FROM t_pat WHERE id_pat = '$id_pat'";
	$km=mysql_query($sql, $c);
	$row_km=mysql_fetch_array($km);
	
	?>
	<script language="javascript">
	{
		if(<?php echo $prom_carga;?> > <?php echo $row_km["prom_pat"]+10;?>)
		{
			abrirpopup('../carga/alerta_popup.php?pat=<?php echo $row_km["pat_pat"];?>&exc=<?php echo $prom_carga-$row_km["prom_pat"]+10;?>', 650, 300);
		}
	}
	</script>
	<?php	
}

/////////////// VERIFICACION MATAFUEGO
function renovacionCercanaMF($c)//VERIFICA SI HAY UNA RENOVACION CERCANA
{
	$hoy = time();

	$sumar30 = 60*60*24*30; //40 dias

	$nuevafecha = $hoy + $sumar30;
	$nuevafecha = date("Y-m-d", $nuevafecha); 
		
	///////////////////////////// CCP
	$sql = "SELECT fv_mata, desc_mata,
		IF(DATEDIFF(current_timestamp, fv_mata) < 0, 'A VENCER', 'VENCIDO') AS alerta,
		IF(DATEDIFF(current_timestamp, fv_mata) < 0, 'green', 'red') AS color,
		IF(id_ofi_mata IS NULL, (SELECT pat_pat FROM t_pat WHERE id_pat = id_pat_mata), (SELECT nomb_ofi FROM t_ofi WHERE id_ofi = id_ofi_mata)) AS donde,
		IF(id_ofi_mata IS NULL, 'CAMION', 'OFICINA') AS tipo
	FROM t_mata WHERE activ_mata IS NULL
	AND DATEDIFF( '{$nuevafecha}', fv_mata ) > -40";
	$mata = mysql_query($sql, $c);

	while($row_mata = mysql_fetch_array($mata))
	{
	?>
		<script language="javascript">
		{
			abrirpopup("../mata/alerta.php?mata=<?php echo $row_mata["desc_mata"];?>&donde=<?php echo $row_mata["donde"];?>&tipo=<?php echo $row_mata["tipo"];?>&fecha=<?php echo $row_mata["fv_mata"];?>&alerta=<?php echo $row_mata["alerta"];?>&color=<?php echo $row_mata["color"];?>", 650, 300);
		}
		</script>	
	<?php
	}
	////////////////////////////////////////////
}

/////////////// VERIFICACION CHOFER
function renovacionCercanaC($c)//VERIFICA SI HAY UNA RENOVACION CERCANA 
{
	$hoy = time();

	$sumar30 = 60*60*24*30; //40 dias

	$nuevafecha = $hoy + $sumar30;
	$nuevafecha = date("Y-m-d", $nuevafecha); 
		
	///////////////////////////// CCP
	$sql = "SELECT fvccp_chofer, nomb_chofer,
		IF(DATEDIFF(current_timestamp, fvccp_chofer) < 0, 'A VENCER', 'VENCIDO') AS alerta,
		IF(DATEDIFF(current_timestamp, fvccp_chofer) < 0, 'green', 'red') AS color
	FROM t_chofer WHERE activ_chofer IS NULL AND id_cat_chofer IS NULL
	AND DATEDIFF( '{$nuevafecha}', fvccp_chofer ) > -40";
	
	$chofer = mysql_query($sql, $c);
	
	while($row_chofer = mysql_fetch_array($chofer))
	{
	?>
		<script language="javascript">
		{
			abrirpopup("../chofer/alerta.php?chofer=<?php echo $row_chofer["nomb_chofer"];?>&tipo=Curso Carga Peligrosa&fecha=<?php echo $row_chofer["fvccp_chofer"];?>&alerta=<?php echo $row_chofer["alerta"];?>&color=<?php echo $row_chofer["color"];?>", 650, 300);
		}
		</script>	
	<?php
	}
	////////////////////////////////////////////
	
	
	///////////////////////////// RM
	$sql = "SELECT fvrm_chofer, nomb_chofer,
		IF(DATEDIFF(current_timestamp, fvrm_chofer) < 0, 'A VENCER', 'VENCIDO') AS alerta,
		IF(DATEDIFF(current_timestamp, fvrm_chofer) < 0, 'green', 'red') AS color
	FROM t_chofer WHERE activ_chofer IS NULL AND id_cat_chofer IS NULL
	AND DATEDIFF( '{$nuevafecha}', fvrm_chofer ) > -40";
	$chofer = mysql_query($sql, $c);
		
	while($row_chofer = mysql_fetch_array($chofer))
	{
	?>
		<script language="javascript">
		{
			abrirpopup("../chofer/alerta.php?chofer=<?php echo $row_chofer["nomb_chofer"];?>&tipo=Registro Municipal&fecha=<?php echo $row_chofer["fvrm_chofer"];?>&alerta=<?php echo $row_chofer["alerta"];?>&color=<?php echo $row_chofer["color"];?>", 650, 300);
		}
		</script>	
	<?php
	}
	////////////////////////////////////////////
	
	
	///////////////////////////// PF
	$sql = "SELECT fvpf_chofer, nomb_chofer,
		IF(DATEDIFF(current_timestamp, fvpf_chofer) < 0, 'A VENCER', 'VENCIDO') AS alerta,
		IF(DATEDIFF(current_timestamp, fvpf_chofer) < 0, 'green', 'red') AS color
	FROM t_chofer WHERE activ_chofer IS NULL AND id_cat_chofer IS NULL
	AND DATEDIFF( '{$nuevafecha}', fvpf_chofer ) > -40";
	$chofer = mysql_query($sql, $c);
	
	while($row_chofer = mysql_fetch_array($chofer))
	{
	?>
		<script language="javascript">
		{
			abrirpopup("../chofer/alerta.php?chofer=<?php echo $row_chofer["nomb_chofer"];?>&tipo=Psicofisico&fecha=<?php echo $row_chofer["fvpf_chofer"];?>&alerta=<?php echo $row_chofer["alerta"];?>&color=<?php echo $row_chofer["color"];?>", 650, 300);
		}
		</script>	
	<?php
	}
	////////////////////////////////////////////
}

/////////////// VERIFICACION CAMION
function renovacionCercanaP($c)//VERIFICA SI HAY UNA RENOVACION CERCANA 
{
	$hoy = time();

	$sumar30 = 60*60*24*30; //40 dias

	$nuevafecha = $hoy + $sumar30;
	$nuevafecha = date("Y-m-d", $nuevafecha); 
		
	///////////////////////////// VTV
	$sql = "SELECT fvvtv_pat, pat_pat, 
		IF(DATEDIFF(current_timestamp, fvvtv_pat) < 0, 'A VENCER', 'VENCIDO') AS alerta,
		IF(DATEDIFF(current_timestamp, fvvtv_pat) < 0, 'green', 'red') AS color
	FROM t_pat
	WHERE activ_pat IS NULL
	AND DATEDIFF( '{$nuevafecha}', fvvtv_pat ) > -40";
	$pat = mysql_query($sql, $c);
	
	while($row_pat = mysql_fetch_array($pat))
	{
	?>
		<script language="javascript">
		{
			abrirpopup("../pat/alerta.php?pat=<?php echo $row_pat["pat_pat"];?>&tipo=VTV&fecha=<?php echo $row_pat["fvvtv_pat"];?>&alerta=<?php echo $row_pat["alerta"];?>&color=<?php echo $row_pat["color"];?>", 650, 300);
		}
		</script>	
	<?php
	}
	////////////////////////////////////////////
	
	
	///////////////////////////// RUTA
	$sql = "SELECT fvruta_pat, pat_pat, 
		IF(DATEDIFF(current_timestamp, fvruta_pat) < 0, 'A VENCER', 'VENCIDO') AS alerta,
		IF(DATEDIFF(current_timestamp, fvruta_pat) < 0, 'green', 'red') AS color
	FROM t_pat
	WHERE activ_pat IS NULL
	AND DATEDIFF( '{$nuevafecha}', fvruta_pat ) > -40";
	$pat = mysql_query($sql, $c);
	
	while($row_pat = mysql_fetch_array($pat))
	{
	?>
		<script language="javascript">
		{
			abrirpopup("../pat/alerta.php?pat=<?php echo $row_pat["pat_pat"];?>&tipo=RUTA&fecha=<?php echo $row_pat["fvruta_pat"]?>&alerta=<?php echo $row_pat["alerta"];?>&color=<?php echo $row_pat["color"];?>", 650, 300);
		}
		</script>	
	<?php
	}
	////////////////////////////////////////////
}



//////////// VERIFICACION PATENTE
function reviCercana($id_pat_carga, $c)//VERIFICA SI HAY UNA REVISION CERCANA 
{
	$sql = "SELECT * FROM t_pat WHERE id_pat = '$id_pat_carga'";
	$pat = mysql_query($sql, $c);
	$row_pat = mysql_fetch_array($pat);
	$kma = $row_pat["km_pat"];

	// MECANICA
	$sql = "SELECT * FROM t_meca INNER JOIN t_tipo ON id_tipo_meca = id_tipo WHERE id_pat_meca = '$id_pat_carga' AND activ_meca IS NULL ORDER BY id_meca DESC";
	$meca = mysql_query($sql, $c);
	
	while($row_meca = mysql_fetch_array($meca))
	{
		$idmeca = $row_meca["id_meca"];

		$sql = "SELECT * FROM t_trab WHERE id_meca_trab = '$idmeca'";
		$trab = mysql_query($sql, $c);

		while($row_trab=mysql_fetch_array($trab))
		{
			$kms = $row_trab["kmp_trab"] - $kma;

			?>
				<script language="javascript">
				{
					if(<?php echo $kms;?> < 1000 && <?php echo $kms;?> > 0)
					{
						abrirpopup('../carga/alerta.php?pat=<?php echo $row_pat["pat_pat"];?>&rueda=<?php echo $row_trab["rueda_trab"];?>&tipo=<?php echo $row_meca["desc_tipo"]?>', 650, 300);
					}
				}
				</script>	
			<?php

		}
	}
//////////////////////////////////////////////////////////////////	

	// MECANICA GENERAL
	$sql="SELECT * FROM t_meca INNER JOIN t_pat ON id_pat_meca = id_pat LEFT JOIN t_tipo ON id_tipo_meca = id_tipo WHERE activ_meca IS NULL AND (id_tipo_meca IS NULL OR id_tipo_meca = 4) AND id_pat_meca = '$id_pat_carga' ORDER BY id_meca DESC";	
	$mecag = mysql_query($sql, $c);

	while($row_mecag=mysql_fetch_array($mecag))
	{
		$kms = $row_mecag["kmp_meca"] - $row_mecag["km_pat"];
		$vinculo = '../meca/ver_meca.php?flag=detalle&idmeca='.$row_mecag['id_meca'];
		?>
			<script language="javascript">
			{
				if(<?php echo $kms;?> < 1000 && <?php echo $kms;?> > 0)
				{
					abrirpopup('../carga/alerta.php?pat=<?php echo $row_pat["pat_pat"];?>&tipo=<?php echo $row_mecag["desc_tipo"]?>', 650, 300);
				}
			}
			</script>	
		<?php 
	}
//////////////////////////////////////////////////////////////////	

	// TACOGRAFO
	$sql = "SELECT * FROM t_taco WHERE id_pat_taco = '$id_pat_carga' AND activ_taco IS NULL ORDER BY id_taco DESC";
	$taco = mysql_query($sql, $c);
	$row_taco = mysql_fetch_array($taco);
	$kmp_taco = $row_taco["kmp_taco"];
	
	$kms = $kmp_taco - $kma;
	?> 

		<script language="javascript">
			if(<?php echo $kms;?> < 1000 && <?php echo $kms;?> > 0)
			{
				abrirpopup('../taco/alerta.php?pat=<?php echo $row_pat["pat_pat"];?>', 650, 300);
			}
		</script>
	<?php
}
?>