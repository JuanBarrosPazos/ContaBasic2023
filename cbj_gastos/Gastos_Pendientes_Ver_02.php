<?php
session_start();

	//require '../Inclu/error_hidden.php';
	require '../Inclu/Admin_Inclu_popup.php';

	require '../Conections/conection.php';
	require '../Conections/conect.php';

///////////////////////////////////////////////////////////////////////////////////////

if ($_SESSION['Nivel'] == 'admin'){

				if($_POST['oculto2']){
													process_form();
													info();
										} 
				} else { require '../Inclu/table_permisos.php'; }

//////////////////////////////////////////////////////////////////////////////////////////////

function process_form(){
	
	global $db;
	global $db_name;
	global $vname;
	
	$vname = $_POST['vname'];
//	print("** ".$_POST['vname']." / ".$_POST['dyt1']);
	
		$sqlc =  "SELECT * FROM `$db_name`.$vname WHERE `id` = '$_POST[id]'";
		$qc = mysqli_query($db, $sqlc);
		$countc = mysqli_num_rows($qc);
		$rowsc = mysqli_fetch_assoc($qc);
	
		$ext_permitidas = array('pdf','PDF');
		
		$extension1 = substr($rowsc['myimg1'],-3);
		// print($extension1);
		// $extension1 = end(explode('.', $_FILES['myimg1']['name']) );
		$ext_correcta1 = in_array($extension1, $ext_permitidas);
		if(!$ext_correcta1){ $myimg1 = $rowsc['myimg1'];}
		else{$myimg1 = 'pdf.png';}

		$extension2 = substr($rowsc['myimg2'],-3);
		// print($extension2);
		// $extension2 = end(explode('.', $_FILES['myimg2']['name']) );
		$ext_correcta2 = in_array($extension2, $ext_permitidas);
		if(!$ext_correcta2){ $myimg2 = $rowsc['myimg2'];}
		else{$myimg2 = 'pdf.png';}

		$extension3 = substr($rowsc['myimg3'],-3);
		// print($extension3);
		// $extension3 = end(explode('.', $_FILES['myimg3']['name']) );
		$ext_correcta3 = in_array($extension3, $ext_permitidas);
		if(!$ext_correcta3){ $myimg3 = $rowsc['myimg3'];}
		else{$myimg3 = 'pdf.png';}

		$extension4 = substr($rowsc['myimg4'],-3);
		// print($extension4);
		// $extension4 = end(explode('.', $_FILES['myimg4']['name']) );
		$ext_correcta4 = in_array($extension4, $ext_permitidas);
		if(!$ext_correcta4){ $myimg4 = $rowsc['myimg4'];}
		else{$myimg4 = 'pdf.png';}

	print("<table class='detalle' align='center'>
				<tr>
					<th colspan=4 class='BorderInf'>
							RAZON SOCIAL ".strtoupper($_POST['factnom']).".
							NIF ".$_POST['factnif']."
							</br> 
							DOCS FACT Nº: ".$_POST['factnum']."
					</th>
				</tr>
				
        <tr>
		
          <td class='img1'>
		  <img src='../cbj_Docs/docgastos_pendientes/".$myimg1."'  onclick=\"MM_showHideLayers('contenedor','','show','foto1A','','show','foto2A','','hide','foto3A','','hide','foto4A','','hide')\" onload=\"MM_showHideLayers('foto1A','','show','foto2A','','hide','foto3A','','hide','foto4A','','hide')\" /> 
<a style='font-size:14px' href='../cbj_Docs/docgastos_pendientes/".$rowsc['myimg1']."' target='_blank'>
				DOWNLOAD 1
			</a>
		  </td>
		  
          <td class='img1'>
		  <img src='../cbj_Docs/docgastos_pendientes/".$myimg2."' onclick=\"MM_showHideLayers('foto1A','','hide','foto2A','','show','foto3A','','hide','foto4A','','hide')\" /> 
<a style='font-size:14px' href='../cbj_Docs/docgastos_pendientes/".$rowsc['myimg2']."' target='_blank'>
				DOWNLOAD 2
			</a>
		  </td>
		  
          <td class='img1'>
		  <img src='../cbj_Docs/docgastos_pendientes/".$myimg3."' onclick=\"MM_showHideLayers('foto1A','','hide','foto2A','','hide','foto3A','','show','foto4A','','hide')\" /> 
<a style='font-size:14px' href='../cbj_Docs/docgastos_pendientes/".$rowsc['myimg3']."' target='_blank'>
				DOWNLOAD 3
			</a>
		  </td>
		  
          <td class='img1'>
		  <img src='../cbj_Docs/docgastos_pendientes/".$myimg4."' onclick=\"MM_showHideLayers('foto1A','','hide','foto2A','','hide','foto3A','','hide','foto4A','','show')\" /> 
<a style='font-size:14px' href='../cbj_Docs/docgastos_pendientes/".$rowsc['myimg4']."' target='_blank'>
				DOWNLOAD 4
			</a>
		  </td>
       </tr>
       
			<div id='foto1A' class='img2'> 
				<img src='../cbj_Docs/docgastos_pendientes/".$myimg1."' /> 
			</div>
			
            <div id='foto2A' class='img2'> 
				<img src='../cbj_Docs/docgastos_pendientes/".$myimg2."' /> 
			</div>
			
            <div id='foto3A' class='img2'> 
				<img src='../cbj_Docs/docgastos_pendientes/".$myimg3."' /> 
			</div>
			
            <div id='foto4A' class='img2'> 
				<img src='../cbj_Docs/docgastos_pendientes/".$myimg4."' /> 
			</div>
		
		<tr>
					<td colspan=4 align='right' class='BorderSup'>
	<form name='closewindow' action='$_SERVER[PHP_SELF]'  onsubmit=\"window.close()\">
											<input type='submit' value='CERRAR VENTANA' />
											<input type='hidden' name='oculto2' value=1 />
			</form>
					</td>
				</tr>
	</table>
	
<div style='clear:both'></div>

<!-- Inicio footer -->
<div id='footer' style='margin-top:410px'>&copy; Juan Barr&oacute;s Pazos 2020.</div>
<!-- Fin footer -->
</div>

		");	

			}	
			
/////////////////////////////////////////////////////////////////////////////////////////////////

function info(){

	global $db;

	$ActionTime = date('H:i:s');

	global $dir;
	if ($_SESSION['Nivel'] == 'admin'){ 
				$dir = "../cbj_Docs/log";
				}
	
	if ($_SESSION['usuarios'] != $_SESSION['ref']){$a = "DEL USUARIO ".$_SESSION['usuarios'].". ";}
	else{$a = " DEL USUARIO ".$_SESSION['ref'].". ";}
	
	global $text;
	$text = "\n- GASTOS PENDIENTES DETALLES ".$a.$ActionTime.".\n\tRAZON SOCIAL: ".strtoupper($_POST['factnom']).".\n\tNIF: ".$_POST['factnif']."\n\tFACTURA Nº: ".$_POST['factnum'].".";

	$logdocu = $_SESSION['ref'];
	$logdate = date('Y_m_d');
	$logtext = $text."\n";
	$filename = $dir."/".$logdate."_".$logdocu.".log";
	$log = fopen($filename, 'ab+');
	fwrite($log, $logtext);
	fclose($log);

	}

/////////////////////////////////////////////////////////////////////////////////////////////////
	
	function desconexion(){

			print("<form name='cerrar' action='mcgexit.php' method='post'>
							<tr>
								<td valign='bottom' align='right' colspan='8'>
											<input type='submit' value='Cerrar Sesion' />
								</td>
							</tr>								
											<input type='hidden' name='cerrar' value=1 />
					</form>	
							");
	
			} 
	
/////////////////////////////////////////////////////////////////////////////////////////////////

	//require '../Inclu/Admin_Inclu_02.php';
		
?>