<?php
session_start();

	require '../../Mod_Admin/Inclu/error_hidden.php';
	require '../Inclu/Conta_Head.php';
	require '../../Mod_Admin/Inclu/my_bbdd_clave.php';
	require '../../Mod_Admin/Conections/conection.php';
	require '../../Mod_Admin/Conections/conect.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	if ($_SESSION['Nivel'] == 'admin'){

		if(isset($_POST['oculto2'])){ 	process_form();
										info();
									} 
	} else { require '../Inclu/table_permisos.php'; }

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function process_form(){
	
			global $db; 		global $db_name;
			global $vname; 		$vname = $_POST['vname'];
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

			print("<table align='center'>
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
		<img src='../cb23_Docs/docingresos_pendientes/".$myimg1."'  onclick=\"MM_showHideLayers('contenedor','','show','foto1A','','show','foto2A','','hide','foto3A','','hide','foto4A','','hide')\" onload=\"MM_showHideLayers('foto1A','','show','foto2A','','hide','foto3A','','hide','foto4A','','hide')\" /> 
		<a style='font-size:14px' href='../cb23_Docs/docingresos_pendientes/".$rowsc['myimg1']."' target='_blank'>
						DOWNLOAD 1
					</a>
				</td>
				<td class='img1'>
		<img src='../cb23_Docs/docingresos_pendientes/".$myimg2."' onclick=\"MM_showHideLayers('foto1A','','hide','foto2A','','show','foto3A','','hide','foto4A','','hide')\" /> 
		<a style='font-size:14px' href='../cb23_Docs/docingresos_pendientes/".$rowsc['myimg2']."' target='_blank'>
						DOWNLOAD 2
					</a>
				</td>
				<td class='img1'>
		<img src='../cb23_Docs/docingresos_pendientes/".$myimg3."' onclick=\"MM_showHideLayers('foto1A','','hide','foto2A','','hide','foto3A','','show','foto4A','','hide')\" /> 
		<a style='font-size:14px' href='../cb23_Docs/docingresos_pendientes/".$rowsc['myimg3']."' target='_blank'>
						DOWNLOAD 3
					</a>
				</td>
				<td class='img1'>
		<img src='../cb23_Docs/docingresos_pendientes/".$myimg4."' onclick=\"MM_showHideLayers('foto1A','','hide','foto2A','','hide','foto3A','','hide','foto4A','','show')\" /> 
		<a style='font-size:14px' href='../cb23_Docs/docingresos_pendientes/".$rowsc['myimg4']."' target='_blank'>
						DOWNLOAD 4
					</a>
				</td>
			</tr>
			<tr>
				<div id='foto1A' class='img2'> 
					<img src='../cb23_Docs/docingresos_pendientes/".$myimg1."' /> 
				</div>
				<div id='foto2A' class='img2'> 
					<img src='../cb23_Docs/docingresos_pendientes/".$myimg2."' /> 
				</div>
				<div id='foto3A' class='img2'> 
					<img src='../cb23_Docs/docingresos_pendientes/".$myimg3."' /> 
				</div>
				<div id='foto4A' class='img2'> 
					<img src='../cb23_Docs/docingresos_pendientes/".$myimg4."' /> 
				</div>
			</tr>
			<tr>
				<td colspan=2 class='BorderSup' style='text-align: right !important;' >ID </td>
				<td colspan=2 class='BorderSup' >".$_POST['id']."</td>	
			</tr>		
			<tr>
				<td colspan=2 style='text-align: right !important;' >NUMERO </td>
				<td colspan=2 >".$_POST['factnum']."</td>			
			</tr>		
			<tr>
				<td colspan=2 style='text-align: right !important;' >FECHA </td>
				<td colspan=2 >".$_POST['factdate']."</td>				
			</tr>		
			<tr>
				<td colspan=2 style='text-align: right !important;'>RAZON SOCIAL </td>
				<td colspan=2 >".$_POST['factnom']."</td>
			</tr>		
			<tr>
				<td colspan=2 style='text-align: right !important;' >NIF/CIF </td>
				<td colspan=2 >".$_POST['factnif']."</td>
			</tr>		
			<tr>
				<td colspan=2 style='text-align: right !important;' >IMPUESTOS % </td>
				<td colspan=2 >".$_POST['factiva']."</td>
			</tr>		
			<tr>
				<td colspan=2 style='text-align: right !important;' >IMPUESTOS € </td>
				<td colspan=2 >".$_POST['factivae']."</td>
			</tr>		
			<tr>
				<td colspan=2 style='text-align: right !important;' >SUBTOTAL </td>
				<td colspan=2 >".$_POST['factpvp']."</td>
			</tr>		
			<tr>
				<td colspan=2 style='text-align: right !important;' >RETENCIONES % </td>
				<td colspan=2 >".$_POST['factret']."</td>
			</tr>		
			<tr>
				<td colspan=2 style='text-align: right !important;' >RETENCIONES € </td>
				<td colspan=2 >".$_POST['factrete']."</td>
			</tr>		
			<tr>
				<td colspan=2 style='text-align: right !important;' >TOTAL € </td>
				<td colspan=2 >".$_POST['factpvptot']."</td>
			</tr>		
			<tr >
					<td colspan=4 style='text-align: left !important;' >DESCRIPCION </td>
			</tr>
			<tr>
				<td colspan=4 style='text-aling:left;' >".$_POST['coment']."</td>
			</tr>		
			<tr>
				<td colspan=4 align='right' >
		<form name='closewindow' action='$_SERVER[PHP_SELF]'  onsubmit=\"window.close()\">
					<input type='submit' value='CERRAR VENTANA' class='botonverde' />
					<input type='hidden' name='oculto2' value=1 />
		</form>
				</td>
			</tr>
		</table>");

	} // FIN function process_form()
			
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function info(){

		global $db;

		$ActionTime = date('H:i:s');

		global $dir;
		if ($_SESSION['Nivel'] == 'admin'){ 
					$dir = "../cb23_Docs/log";
					}
		
		if ($_SESSION['usuarios'] != $_SESSION['ref']){$a = "DEL USUARIO ".$_SESSION['usuarios'].". ";}
		else{$a = " DEL USUARIO ".$_SESSION['ref'].". ";}

		global $text;
		$text = "\n- INGRESO DETALLES ".$a.$ActionTime.".\n\tRAZON SOCIAL: ".strtoupper($_POST['factnom']).".\n\tNIF: ".$_POST['factnif']."\n\tFACTURA IN Nº: ".$_POST['factnum'].".";

		$logdocu = $_SESSION['ref'];
		$logdate = date('Y-m-d');
		$logtext = $text."\n";
		$filename = $dir."/".$logdate."_".$logdocu.".log";
		$log = fopen($filename, 'ab+');
		fwrite($log, $logtext);
		fclose($log);

	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	require '../Inclu/Conta_Footer.php';
	
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

?>