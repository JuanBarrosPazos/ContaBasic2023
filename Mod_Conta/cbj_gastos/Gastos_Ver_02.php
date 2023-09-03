<?php
	//session_start();

	//require '../../Mod_Admin/Inclu/error_hidden.php';
	//require '../Inclu/Conta_Head.php';
	//require '../../Mod_Admin/Inclu/my_bbdd_clave.php';
	//equire '../../Mod_Admin/Conections/conection.php';
	//require '../../Mod_Admin/Conections/conect.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	/*
	if ($_SESSION['Nivel'] == 'admin'){

		if(isset($_POST['ocultoDetalle'])){ process_form_Dealle();
											info_Dealle();
									} 
	} else { require '../Inclu/table_permisos.php'; }
	*/

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function process_form_Dealle(){
	
		global $CancelBlackTit;		$CancelBlackTit = "CERRAR VENTANA";
		global $MoneypBlackTit;		$MoneypBlackTit = "VER TODOS LOS GASTOS";
		global $AddBlackTit; 		$AddBlackTit = "CREAR NUEVO GASTO";
		require '../Inclu/BotoneraVar.php';
		global $closeButton;
	
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

		print("<table class='detalle tableForm' style='width:fit-content !important;' >
					<tr>
						<th colspan=2 >
								RAZON SOCIAL ".strtoupper($_POST['factnom']).".
								NIF ".$_POST['factnif']."
								</br> 
								DOCS FACT Nº: ".$_POST['factnum']."
						</th>
					</tr>

					<tr>
						<td colspan=2 style='text-align:center;' >

						<div class='img1'>
			<button type='submit' class='botonnaranja' title='DESCARGAR DOCUMENTO 1' >
				<a style='font-size:14px' href='../cbj_Docs/docgastos_".$_POST['dyt1']."/".$rowsc['myimg1']."' target='_blank'>
					<img src='../cbj_Docs/docgastos_".$_POST['dyt1']."/".$myimg1."'> 
				</a>
			</button>							
						</div>
						<div class='img1'>
			<button type='submit' class='botonnaranja' title='DESCARGAR DOCUMENTO 2' >
				<a style='font-size:14px' href='../cbj_Docs/docgastos_".$_POST['dyt1']."/".$rowsc['myimg2']."' target='_blank'>
					<img src='../cbj_Docs/docgastos_".$_POST['dyt1']."/".$myimg2."' > 
				</a>
			</button>							
						</div>
						<div class='img1'>
			<button type='submit' class='botonnaranja' title='DESCARGAR DOCUMENTO 3' >
				<a style='font-size:14px' href='../cbj_Docs/docgastos_".$_POST['dyt1']."/".$rowsc['myimg3']."' target='_blank'>
					<img src='../cbj_Docs/docgastos_".$_POST['dyt1']."/".$myimg3."' > 
				</a>
			</button>							
						</div>
						<div class='img1'>
			<button type='submit' class='botonnaranja' title='DESCARGAR DOCUMENTO 4' >
				<a style='font-size:14px' href='../cbj_Docs/docgastos_".$_POST['dyt1']."/".$rowsc['myimg4']."' target='_blank'>
					<img src='../cbj_Docs/docgastos_".$_POST['dyt1']."/".$myimg4."' > 
				</a>
			</button>							
						</div>
				</td>
			</tr>
			<tr>
				<td class='BorderSup' style='text-align: right !important;' >ID </td>
				<td class='BorderSup' >".$_POST['id']."</td>	
			</tr>		
			<tr>
				<td style='text-align: right !important;' >NUMERO </td>
				<td>".$_POST['factnum']."</td>			
			</tr>		
			<tr>
				<td style='text-align: right !important;' >FECHA </td>
				<td>".$_POST['factdate']."</td>				
			</tr>		
			<tr>
				<td style='text-align: right !important;'>RAZON SOCIAL </td>
				<td>".$_POST['factnom']."</td>
			</tr>		
			<tr>
				<td style='text-align: right !important;' >NIF/CIF </td>
				<td>".$_POST['factnif']."</td>
			</tr>		
			<tr>
				<td style='text-align: right !important;' >IMPUESTOS % </td>
				<td>".$_POST['factiva']."</td>
			</tr>		
			<tr>
				<td style='text-align: right !important;' >IMPUESTOS € </td>
				<td>".$_POST['factivae']."</td>
			</tr>		
			<tr>
				<td style='text-align: right !important;' >SUBTOTAL </td>
				<td>".$_POST['factpvp']."</td>
			</tr>		
			<tr>
				<td style='text-align: right !important;' >RETENCIONES % </td>
				<td>".$_POST['factret']."</td>
			</tr>		
			<tr>
				<td style='text-align: right !important;' >RETENCIONES € </td>
				<td>".$_POST['factrete']."</td>
			</tr>		
			<tr>
				<td style='text-align: right !important;' >TOTAL € </td>
				<td>".$_POST['factpvptot']."</td>
			</tr>		
			<tr>
				<td colspan=2 style='text-align: left !important;' >DESCRIPCION </td>
			</tr>
			<tr>
				<td colspan=2 style='text-aling:left;' >".$_POST['coment']."</td>
			</tr>		
			<tr>
				<td colspan=2 align='right' >
						".$MoneypBlack."
								<a href='Gastos_Ver.php' >&nbsp;&nbsp;&nbsp;</a>
						".$closeButton.$AddBlack."
								<a href='Gastos_Crear.php'>&nbsp;&nbsp;&nbsp;</a>
						".$closeButton.$CancelBlack."
								<a href='Gastos_Ver.php' >&nbsp;&nbsp;&nbsp;</a>
						".$closeButton."
				</td>
			</tr>
		</table>");

	} // FIN function process_form_Dealle()
			
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function info_Dealle(){

		global $db;

		$ActionTime = date('H:i:s');

		global $dir;
		if ($_SESSION['Nivel'] == 'admin'){ 
					$dir = "../cbj_Docs/log";
					}
		
		if ($_SESSION['usuarios'] != $_SESSION['ref']){$a = "DEL USUARIO ".$_SESSION['usuarios'].". ";}
		else{$a = " DEL USUARIO ".$_SESSION['ref'].". ";}

		global $text;
		$text = "\n- GASTO DETALLES ".$a.$ActionTime.".\n\tRAZON SOCIAL: ".strtoupper($_POST['factnom']).".\n\tNIF: ".$_POST['factnif']."\n\tFACTURA IN Nº: ".$_POST['factnum'].".";

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

	//require '../Inclu/Conta_Footer.php';
	
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

?>