<?php
session_start();

	require '../../Mod_Admin/Inclu/error_hidden.php';
	require '../Inclu/Conta_Head.php';
	require '../../Mod_Admin/Inclu/my_bbdd_clave.php';
	require '../../Mod_Admin/Conections/conection.php';
	require '../../Mod_Admin/Conections/conect.php';

	require '../Inclu/sqld_query_fetch_assoc.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	if ($_SESSION['Nivel'] == 'admin'){

		master_index();

		if(isset($_POST['oculto'])){
								
			if($form_errors = validate_form()){
							show_form($form_errors);
			} else { process_form();
					 info();
						}
								
		} else { show_form(); }
		
	} else { require '../Inclu/table_permisos.php'; } 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function validate_form(){
	
		global $sqld; 		global $qd; 		global $rowd;

		$errors = array();
		
		require 'ValidateForm.php';
		require 'ValidateImg.php';

		return $errors;

	} 
		
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function process_form(){
	
	global $db; 		global $db_name;
	global $dyt1; 		global $dm1;

	require 'Ingresos_factdate.php';

	require 'FormatNumber.php';

	global $vname; 		$vname = "`".$_SESSION['clave']."ingresos_".$dyt1."`";

	global $iniy; 		$iniy = substr(date('Y'),0,2);

	global $title;	$title = 'SE HA GRABADO EN ';

	global $link1; 	
	$link1 = "<a href='Ingresos_Ver.php' class='botonazul' style='color:#343434 !important' >INICIO INGRESOS</a>";
	global $link2;
	$link2 = "<a href='Ingresos_Crear.php' class='botonazul' style='color:#343434 !important' >CREAR NUEVO INGRESO</a>";
	 
	require 'TableFormResult.php';
		
	/************* CREAMOS LAS IMAGENES EN LA IMG PRO SECCION ***************/
		
		/////////////

	if($_FILES['myimg1']['size'] == 0){$new_name1 = 'untitled.png';
			$new_name1 = $_POST['factnum']."_1.png";
			$rename_filename1 = "../cb23_Docs/docingresos_".$dyt1."/".$new_name1;								
			copy("../cb23_Docs/docingresos_".$dyt1."/untitled.png", $rename_filename1);
			}
		else{

			$safe_filename1 = trim(str_replace('/', '', $_FILES['myimg1']['name']));
			$safe_filename1 = trim(str_replace('..', '', $safe_filename1));
	
			$nombre1 = $_FILES['myimg1']['name'];
			$nombre1_tmp = $_FILES['myimg1']['tmp_name'];
			$tipo1 = $_FILES['myimg1']['type'];
			$tamano1 = $_FILES['myimg1']['size'];
	
			$destination_file1 = "../cb23_Docs/docingresos_".$dyt1."/".$safe_filename1;
		
	    if( file_exists("../cb23_Docs/docingresos_".$dyt1."/".$nombre1) ){
				unlink("../cb23_Docs/docingresos_".$dyt1."/".$nombre1);
			//	print("** El archivo ".$nombre1." Ya existe, seleccione otra imagen.</br>");
			}
			
		elseif (move_uploaded_file($_FILES['myimg1']['tmp_name'], $destination_file1)){

			// Renombrar el archivo:
			$extension1 = substr($_FILES['myimg1']['name'],-3);
			// print($extension1);
			// $extension1 = end(explode('.', $_FILES['myimg1']['name']) );
			global $new_name1;
			$new_name1 = $_POST['factnum']."_1.".$extension1;
			$rename_filename1 = "../cb23_Docs/docingresos_".$dyt1."/".$new_name1;								
			rename($destination_file1, $rename_filename1);
		}
		else {print("NO SE HA PODIDO GUARDAR EN ".$destination_file1);}
		}

		/////////////

	if($_FILES['myimg2']['size'] == 0){$new_name2 = 'untitled.png';
			$new_name2 = $_POST['factnum']."_2.png";
			$rename_filename2 = "../cb23_Docs/docingresos_".$dyt1."/".$new_name2;								
			copy("../cb23_Docs/docingresos_".$dyt1."/untitled.png", $rename_filename2);
			}
		else{

			$safe_filename2 = trim(str_replace('/', '', $_FILES['myimg2']['name']));
			$safe_filename2 = trim(str_replace('..', '', $safe_filename2));
	
			$nombre2 = $_FILES['myimg2']['name'];
			$nombre2_tmp = $_FILES['myimg2']['tmp_name'];
			$tipo2 = $_FILES['myimg2']['type'];
			$tamano2 = $_FILES['myimg2']['size'];
	
			$destination_file2 = "../cb23_Docs/docingresos_".$dyt1."/".$safe_filename2;
		
	    if( file_exists("../cb23_Docs/docingresos_".$dyt1."/".$nombre2) ){
				unlink("../cb23_Docs/docingresos_".$dyt1."/".$nombre2);
			//	print("** El archivo ".$nombre1." Ya existe, seleccione otra imagen.</br>");
			}
			
		elseif (move_uploaded_file($_FILES['myimg2']['tmp_name'], $destination_file2)){

			// Renombrar el archivo:
			$extension2 = substr($_FILES['myimg2']['name'],-3);
			// print($extension2);
			// $extension2 = end(explode('.', $_FILES['myimg2']['name']) );
			global $new_name2;
			$new_name2 = $_POST['factnum']."_2.".$extension2;
			$rename_filename2 = "../cb23_Docs/docingresos_".$dyt1."/".$new_name2;								
			rename($destination_file2, $rename_filename2);
		}
		else {print("NO SE HA PODIDO GUARDAR EN ".$destination_file2);}
		}
			
		/////////////

	if($_FILES['myimg3']['size'] == 0){$new_name3 = 'untitled.png';
			$new_name3 = $_POST['factnum']."_3.png";
			$rename_filename3 = "../cb23_Docs/docingresos_".$dyt1."/".$new_name3;								
			copy("../cb23_Docs/docingresos_".$dyt1."/untitled.png", $rename_filename3);
			}
		else{

			$safe_filename3 = trim(str_replace('/', '', $_FILES['myimg3']['name']));
			$safe_filename3 = trim(str_replace('..', '', $safe_filename3));
	
			$nombre3 = $_FILES['myimg3']['name'];
			$nombre3_tmp = $_FILES['myimg3']['tmp_name'];
			$tipo3 = $_FILES['myimg3']['type'];
			$tamano3 = $_FILES['myimg3']['size'];
	
			$destination_file3 = "../cb23_Docs/docingresos_".$dyt1."/".$safe_filename3;
		
	    if( file_exists("../cb23_Docs/docingresos_".$dyt1."/".$nombre3) ){
				unlink("../cb23_Docs/docingresos_".$dyt1."/".$nombre3);
			//	print("** El archivo ".$nombre1." Ya existe, seleccione otra imagen.</br>");
			}
			
		elseif (move_uploaded_file($_FILES['myimg3']['tmp_name'], $destination_file3)){

			// Renombrar el archivo:
			$extension3 = substr($_FILES['myimg3']['name'],-3);
			// print($extension3);
			// $extension3 = end(explode('.', $_FILES['myimg3']['name']) );
			global $new_name3;
			$new_name3 = $_POST['factnum']."_3.".$extension3;
			$rename_filename3 = "../cb23_Docs/docingresos_".$dyt1."/".$new_name3;								
			rename($destination_file3, $rename_filename3);
		}
		else {print("NO SE HA PODIDO GUARDAR EN ".$destination_file3);}
		}
			
		/////////////
		
	if($_FILES['myimg4']['size'] == 0){$new_name4 = 'untitled.png';
			$new_name4 = $_POST['factnum']."_4.png";
			$rename_filename4 = "../cb23_Docs/docingresos_".$dyt1."/".$new_name4;								
			copy("../cb23_Docs/docingresos_".$dyt1."/untitled.png", $rename_filename4);
			}
		else{

			$safe_filename4 = trim(str_replace('/', '', $_FILES['myimg4']['name']));
			$safe_filename4 = trim(str_replace('..', '', $safe_filename4));
	
			$nombre4 = $_FILES['myimg4']['name'];
			$nombre4_tmp = $_FILES['myimg4']['tmp_name'];
			$tipo4 = $_FILES['myimg4']['type'];
			$tamano4 = $_FILES['myimg4']['size'];
	
			$destination_file4 = "../cb23_Docs/docingresos_".$dyt1."/".$safe_filename4;
		
	    if( file_exists("../cb23_Docs/docingresos_".$dyt1."/".$nombre4) ){
				unlink("../cb23_Docs/docingresos_".$dyt1."/".$nombre4);
			//	print("** El archivo ".$nombre1." Ya existe, seleccione otra imagen.</br>");
			}
			
		elseif (move_uploaded_file($_FILES['myimg4']['tmp_name'], $destination_file4)){

			// Renombrar el archivo:
			$extension4 = substr($_FILES['myimg4']['name'],-3);
			// print($extension4);
			// $extension4 = end(explode('.', $_FILES['myimg4']['name']) );
			global $new_name4;
			$new_name4 = $_POST['factnum']."_4.".$extension4;
			$rename_filename4 = "../cb23_Docs/docingresos_".$dyt1."/".$new_name4;								
			rename($destination_file4, $rename_filename4);
		}
		else {print("NO SE HA PODIDO GUARDAR EN ".$destination_file4);}
		}
			
		/////////////
		
	global $db; 		global $db_name;

	if(strlen(trim($factrete)) == 0){
		$factrete = 0.0;
	} else { }

	$sqla = "INSERT INTO `$db_name`.$vname (`factnum`, `factdate`, `refcliente`, `factnom`, `factnif`, `factiva`, `factivae`, `factpvp`, `factret`, `factrete`, `factpvptot`,`coment`, `myimg1`, `myimg2`, `myimg3`, `myimg4`) VALUES ('$_POST[factnum]', '$factdate', '$_POST[refcliente]', '$_POST[factnom]', '$_POST[factnif]', '$_POST[factiva]', '$factivae', '$factpvp', '$_POST[factret]', '$factrete', '$factpvptot', '$_POST[coment]', '$new_name1', '$new_name2', '$new_name3', '$new_name4')";
		
		if(mysqli_query($db, $sqla)){ print($tabla); 
		} else { print("* MODIFIQUE LA ENTRADA 846: ".mysqli_error($db));
					show_form();
					global $texerror; 	$texerror = "\n\t ".mysqli_error($db);
				}
			
		/////////////
	
	global $dyx; 	$dyx = "20".$_POST['dy'];
	global $dmx; 	$dmx = "M".$_POST['dm'];
/*
	if(($dmx != 10)||($dmx != 11)||($dmx != 12)){
	$dmx = substr($_POST['dm'],-1);
		}
*/
	
	global $mes;
	if(($dmx == "M01")||($dmx == "M02")||($dmx == "M03")){$mes = "TRI1";}
	elseif(($dmx == "M04")||($dmx == "M05")||($dmx == "M06")){$mes = "TRI2";}
	elseif(($dmx == "M07")||($dmx == "M08")||($dmx == "M09")){$mes = "TRI3";}
	elseif(($dmx == "10")||($dmx == "11")||($dmx == "12")){$mes = "TRI4";}
	
	} // FIN function process_form()	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function show_form($errors=[]){
	
		global $db; 		global $db_name;
		
		global $sesionref; 		$sesionref = "`".$_SESSION['clave']."clientes`";

		if(isset($_POST['clienteingresos'])){
			$sqlx =  "SELECT * FROM $sesionref WHERE `ref` = '$_POST[clienteingresos]'";
			$qx = mysqli_query($db, $sqlx);
			$rowcliente = mysqli_fetch_assoc($qx);

			$qx = mysqli_query($db, $sqlx);
			$rowcliente = mysqli_fetch_assoc($qx);
			$_rsocial = $rowcliente['rsocial'];
			$_ref = $rowcliente['ref'];
			$_dni = $rowcliente['dni'];
			$_ldni = $rowcliente['ldni'];
			global $_dnil;
			$_dnil = $_dni.$_ldni;
		}
	
		if(isset($_POST['oculto'])){
				 //$defaults = $_POST;
				 $defaults = array ( 'clienteingresos' => $_POST['clienteingresos'],
									 'dy' => $_POST['dy'],
									 'dm' => $_POST['dm'],
									 'dd' => $_POST['dd'],
									 'factnum' => strtoupper($_POST['factnum']),
								     // 'factdate' => $_POST['factdate'],
								   	 'refcliente' => $rowcliente['ref'],
								   	 'factnom' => $rowcliente['rsocial'],
								   	 'factnif' => $_dnil,
								   	 'factiva' => $_POST['factiva'],
									 'factivae1' => $_POST['factivae1'],	
									 'factivae2' => $_POST['factivae2'],	
								   	 'factret' => $_POST['factret'],
									 'factrete1' => $_POST['factrete1'],	
									 'factrete2' => $_POST['factrete2'],	
									 'factpvp1' => $_POST['factpvp1'],	
									 'factpvp2' => $_POST['factpvp2'],	
									 'factpvptot1' => $_POST['factpvptot1'],	
									 'factpvptot2' => $_POST['factpvptot2'],	
									 'coment' => $_POST['coment'],	
									 'myimg1' => @$_POST['myimg1'],	
									 'myimg2' => @$_POST['myimg2'],	
									 'myimg3' => @$_POST['myimg3'],	
									 'myimg4' => @$_POST['myimg4']);

		} elseif(isset($_POST['oculto1'])) {
				$defaults = $_POST;
				$defaults = array ( 'clienteingresos' => $_POST['clienteingresos'],
								   	'refcliente' => $rowcliente['ref'],
								   	'factnom' => $rowcliente['rsocial'],
								   	'factnif' => $_dnil);

		} else { $defaults = array ( 'clienteingresos' => @$_POST['clienteingresos'],
									 'dy' => @$_POST['dy'],
									 'dm' => @$_POST['dm'],
									 'dd' => @$_POST['dd'],
									 'factnum' => strtoupper(@$_POST['factnum']),
								     // 'factdate' => $_POST['factdate'],
								   	 'refcliente' => @$rowcliente['ref'],
								   	 'factnom' => @$rowcliente['rsocial'],
								   	 'factnif' => @$_dnil,
								   	 'factiva' => @$_POST['factiva'],
									 'factivae1' => @$_POST['factivae1'],	
									 'factivae2' => '00',	
								   	 'factret' => @$_POST['factret'],
									 'factrete1' => @$_POST['factrete1'],	
									 'factrete2' => '00',	
									 'factpvp1' => @$_POST['factpvp1'],	
									 'factpvp2' => '00',	
									 'factpvptot1' => @$_POST['factpvptot1'],	
									 'factpvptot2' => '00',	
									 'coment' => @$_POST['coment'],	
									 'myimg1' => @$_POST['myimg1'],	
									 'myimg2' => @$_POST['myimg2'],	
									 'myimg3' => @$_POST['myimg3'],	
									 'myimg4' => @$_POST['myimg4']);
		}

		require 'TablaIfErrors.php';

		require 'ArrayMesDia.php';
										
		global $Titulo; 	$Titulo = "CREAR INGRESO";
		global $TitValue;	$TitValue = "SELECCIONE CLIENTE";
		require 'FormSelectCliente.php';
		print ("</table>");
				
	////////////////////

	if ((isset($_POST['oculto1'])) || (isset($_POST['oculto']))) {
	if (($_POST['clienteingresos'] == '') && ($defaults['factnom'] == '')) { 
			print("<table align='center' style=\"margin-top:20px;margin-bottom:20px\">
						<tr align='center'>
							<td>
								<font color='red'>SELECCIONE UN CLIENTE</font>
							</td>
						</tr>
					</table>");
				}

	if($_POST['clienteingresos'] != '') {
	 
		print("<table align='center' style=\"margin-top:10px\">
				<tr>
					<th colspan=2 class='BorderInf'>CREAR NUEVO INGRESO</th>
				</tr>");
 
		require 'FormDatos.php';

		print("<tr>
					<td>PDF / FOTO 1</td>
					<td>
		<input type='file' name='myimg1' value='".@$defaults['myimg1']."' style='color:#fff !important;' />
					</td>
				</tr>
				<tr>
					<td>PDF / FOTO 2</td>
					<td>
		<input type='file' name='myimg2' value='".@$defaults['myimg2']."' style='color:#fff !important;' />
					</td>
				</tr>
				<tr>
					<td>PDF / FOTO 3</td>
					<td>
		<input type='file' name='myimg3' value='".@$defaults['myimg3']."' style='color:#fff !important;' />
					</td>
				</tr>
				<tr>
					<td>PDF / FOTO 4</td>
					<td>
		<input type='file' name='myimg4' value='".@$defaults['myimg4']."' style='color:#fff !important;' />
					</td>
				</tr>
				<tr>
					<td colspan='2' align='right' valign='middle' >
						<input type='submit' value='GRABAR INGRESO' class='botonverde' />
						<input type='hidden' name='oculto' value=1 />
			</form>														
					</td>
				</tr>
				<tr>
					<td colspan='4' align='center'>
			<a href='Ingresos_Ver.php' class='botonazul' style='color:#343434 !important' >INICIO INGRESOS</a>
					</td>
				</tr>
			</table>"); 
			}
		}

	} // FIN function show_form()

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function info(){

		global $factdate; 			global $factpvp;
		global $factpvptot; 		global $factrete;
		
		$ActionTime = date('H:i:s');

		global $dir;
		if ($_SESSION['Nivel'] == 'admin'){ 
					$dir = "../cb23_Docs/log";
					}
		
		global $text;
		$text = "\n- INGRESO CREADO ".$ActionTime.".\n\tNº FACTURA: ".$_POST['factnum'].".\n\tDATE FACTURA: ".$factdate.".\n\tRAZON SOCIAL: ".$_POST['factnom'].".\n\tNIF: ".$_POST['factnif'].".\n\tTIPO IVA %: ".$_POST['factiva'].".\n\tTIPO RETEN %: ".$_POST['factret'].".\n\tRETEN €: ".$factrete.".\n\tNETO €: ".$factpvp.".\n\tTOTAL €: ".$factpvptot;

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
	
	function master_index(){
		
		global $rutaIndex;		$rutaIndex = "../";
		require '../Inclu_MInd/MasterIndexVar.php';
		global $rutaIngresos;	$rutaIngresos = "";
		require '../Inclu_MInd/MasterIndex.php'; 
		
				} /* Fin funcion master_index.*/

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	require '../Inclu/Conta_Footer.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

?>