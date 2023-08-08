<?php
session_start();

	require '../../Mod_Admin/Inclu/error_hidden.php';
	require '../Inclu/Conta_Head.php';
	require '../../Mod_Admin/Inclu/my_bbdd_clave.php';
	require '../../Mod_Admin/Conections/conection.php';
	require '../../Mod_Admin/Conections/conect.php';

	require '../Inclu/sqld_query_fetch_assoc.php';

///////////////////////////////////////////////////////////////////////////////////////////////

	if ($_SESSION['Nivel'] == 'admin'){

		master_index();

		if(isset($_POST['oculto'])){
								
			if($form_errors = validate_form()){
							show_form($form_errors);
			} else { process_form();
					 info();
					 difer1();
						}
								
		} else { show_form(); }
		
	} else { require '../Inclu/table_permisos.php'; } 

//////////////////////////////////////////////////////////////////////////////////////////////

	function validate_form(){
	
		$errors = array();
		
		require 'validate.php';

		return $errors;

	} 
		
//////////////////////////////////////////////////////////////////////////////////////////////

	function difer1(){

	global $db;
	global $db_name;
	
	$_SESSION['diferyear'] = $_POST['dy'];
	
	global $dyx;
	$dyx = "20".$_POST['dy'];
	global $dmx;
	$dmx = "M".$_POST['dm'];
/*
	if(($dmx != 10)||($dmx != 11)||($dmx != 12)){
	$dmx = substr($_POST['dm'],-1);
		}
*/
	global $sesionref;

	global $vnamebali; 		$vnamebali = "`".$_SESSION['clave']."balancei`";
	global $vnamebalg; 		$vnamebalg = "`".$_SESSION['clave']."balanceg`";
	global $vnamebald; 		$vnamebald = "`".$_SESSION['clave']."balanced`";
	
	////////////////	DIFERENCIAL MES		////////////////

	$sqlbalg =  "SELECT * FROM `$db_name`.$vnamebalg WHERE `year` = '$dyx' AND `mes` = '$dmx' ";
	$qbalg = mysqli_query($db, $sqlbalg);
	$countbalg = mysqli_num_rows($qbalg);
	$rowbalg = mysqli_fetch_assoc($qbalg);
	
	$sqlbali =  "SELECT * FROM `$db_name`.$vnamebali WHERE `year` = '$dyx' AND `mes` = '$dmx' ";
	$qbali = mysqli_query($db, $sqlbali);
	$countbali = mysqli_num_rows($qbali);
	$rowbali = mysqli_fetch_assoc($qbali);
	
	$sumamesiva = $rowbali['iva'] - $rowbalg['iva'];
		$sumamesiva = number_format($sumamesiva,2,".","");	
	$sumamespvp = $rowbali['sub'] - $rowbalg['sub'];
		$sumamespvp = number_format($sumamespvp,2,".","");	
	$sumamesret = $rowbali['ret'] - $rowbalg['ret'];
		$sumamesret = number_format($sumamesret,2,".","");	
	$sumamestot = $rowbali['tot'] - $rowbalg['tot'];
		$sumamestot = number_format($sumamestot,2,".","");	

	//	print("* ".$dyt1." ".$dm1.".</br>");
	//	print("* ".$sumamesiva." ".$sumamespvp." ".$sumamestot.".</br>");

	$sqlbg = "UPDATE `$db_name`.$vnamebald  SET `iva` = '$sumamesiva', `sub` = '$sumamespvp', `ret` =  '$sumamesret', `tot` =  '$sumamestot' WHERE `year` = '$dyx' AND `mes` = '$dmx' ";
		
		if(mysqli_query($db, $sqlbg)){ //print("**"); 
		} else { print("* MODIFIQUE LA ENTRADA 87: ".mysqli_error($db));
									global $texerror;
									$texerror = "\n\t ".mysqli_error($db);
							}

	////////////////	DIFERENCIAL ANUAL		////////////////

	$sqlbalg2 =  "SELECT * FROM `$db_name`.$vnamebalg WHERE `year` = '$dyx' AND `mes` = 'ANU' ";
	$qbalg2 = mysqli_query($db, $sqlbalg2);
	$countbalg2 = mysqli_num_rows($qbalg2);
	$rowbalg2 = mysqli_fetch_assoc($qbalg2);

	$sqlbali2 =  "SELECT * FROM `$db_name`.$vnamebali WHERE `year` = '$dyx' AND `mes` = 'ANU' ";
	$qbali2 = mysqli_query($db, $sqlbali2);
	$countbali2 = mysqli_num_rows($qbali2);
	$rowbali2 = mysqli_fetch_assoc($qbali2);
	
	$sumayeariva2 = $rowbali2['iva'] - $rowbalg2['iva'];
		$sumayeariva2 = number_format($sumayeariva2,2,".","");	
	$sumayearpvp2 = $rowbali2['sub'] - $rowbalg2['sub'];
		$sumayearpvp2 = number_format($sumayearpvp2,2,".","");	
	$sumayearret2 = $rowbali2['ret'] - $rowbalg2['ret'];	
		$sumayearret2 = number_format($sumayearret2,2,".","");	
	$sumayeartot2 = $rowbali2['tot'] - $rowbalg2['tot'];	
		$sumayeartot2 = number_format($sumayeartot2,2,".","");	

	//	print("* ".$sumayeariva." ".$sumayearpvp." ".$sumayeartot.".</br>");

	$sqlbg2 = "UPDATE `$db_name`.$vnamebald  SET `iva` = '$sumayeariva2', `sub` = '$sumayearpvp2', `ret` =  '$sumayearret2', `tot` =  '$sumayeartot2' WHERE `year` = '$dyx' AND `mes` = 'ANU' ";
		
		if(mysqli_query($db, $sqlbg2)){ //print("**"); 
					} else {
							print("* MODIFIQUE LA ENTRADA 118: ".mysqli_error($db));
									global $texerror;
									$texerror = "\n\t ".mysqli_error($db);
							}

	////////////////	DIFERENCIAL TRIMESTRAL		////////////////

	global $mes;
	if(($dmx == "M01")||($dmx == "M02")||($dmx == "M03")){$mes = "TRI1";}
	elseif(($dmx == "M04")||($dmx == "M05")||($dmx == "M06")){$mes = "TRI2";}
	elseif(($dmx == "M07")||($dmx == "M08")||($dmx == "M09")){$mes = "TRI3";}
	elseif(($dmx == "10")||($dmx == "11")||($dmx == "12")){$mes = "TRI4";}
	
	$sqlbalg3 =  "SELECT * FROM `$db_name`.$vnamebalg WHERE `year` = '$dyx' AND `mes` = '$mes' ";
	$qbalg3 = mysqli_query($db, $sqlbalg3);
	$countbalg3 = mysqli_num_rows($qbalg3);
	$rowbalg3 = mysqli_fetch_assoc($qbalg3);

	$sqlbali3 =  "SELECT * FROM `$db_name`.$vnamebali WHERE `year` = '$dyx' AND `mes` = '$mes' ";
	$qbali3 = mysqli_query($db, $sqlbali3);
	$countbali3 = mysqli_num_rows($qbali3);
	$rowbali3 = mysqli_fetch_assoc($qbali3);
	
	$sumatriiva3 = $rowbali3['iva'] - $rowbalg3['iva'];
		$sumatriiva3 = number_format($sumatriiva3,2,".","");	
	$sumatripvp3 = $rowbali3['sub'] - $rowbalg3['sub'];
		$sumatripvp3 = number_format($sumatripvp3,2,".","");	
	$sumatriret3 = $rowbali3['ret'] - $rowbalg3['ret'];
		$sumatriret3 = number_format($sumatriret3,2,".","");	
	$sumatritot3 = $rowbali3['tot'] - $rowbalg3['tot'];
		$sumatritot3 = number_format($sumatritot3,2,".","");	

	//	print("* ".$sumatriiva." ".$sumatripvp." ".$sumatritot.".</br>");

	$sqlbg3 = "UPDATE `$db_name`.$vnamebald  SET `iva` = '$sumatriiva3', `sub` = '$sumatripvp3', `ret` =  '$sumatriret3', `tot` =  '$sumatritot3' WHERE `year` = '$dyx' AND `mes` = '$mes' ";
		
		if(mysqli_query($db, $sqlbg3)){ //print("**"); 
					} else {
							print("* MODIFIQUE LA ENTRADA 156: ".mysqli_error($db));
									global $texerror;
									$texerror = "\n\t ".mysqli_error($db);
							}
			
		}
		
//////////////////////////////////////////////////////////////////////////////////////////////

function process_form(){
	
	global $db; 		global $db_name;	
	global $dyt1; 		global $dm1;

	if($_POST['dy'] == ''){ $dy1 = '';
							 $dyt1 = date('Y');	} else {$dy1 = $_POST['dy'];
														$dy1 = $dy1;
														$dyt1 = "20".$_POST['dy'];
																		}
	if($_POST['dm'] == ''){ $dm1 = '';} else {$dm1 = $_POST['dm'];
												$dm1 = "/".$dm1."/";}
	if($_POST['dd'] == ''){ $dd1 = '';} else {$dd1 = $_POST['dd'];
												$dd1 = $dd1;}

	global $factdate;
	$factdate = $_POST['dy']."/".$_POST['dm']."/".$_POST['dd'];

	$factivae1 = $_POST['factivae1'];
	$factivae2 = $_POST['factivae2'];
	global $factivae;
	$factivae = $factivae1.".".$factivae2;

	$factrete1 = $_POST['factrete1'];
	$factrete2 = $_POST['factrete2'];
	global $factrete;
	$factrete = $factrete1.".".$factrete2;

	$factpvp1 = $_POST['factpvp1'];
	$factpvp2 = $_POST['factpvp2'];
	global $factpvp;
	$factpvp = $factpvp1.".".$factpvp2;

	$factpvptot1 = $_POST['factpvptot1'];
	$factpvptot2 = $_POST['factpvptot2'];
	global $factpvptot;
	$factpvptot = $factpvptot1.".".$factpvptot2;

	global $vname; 		$vname = "`".$_SESSION['clave']."gastos_".$dyt1."`";

	global $iniy; 		$iniy = substr(date('Y'),0,2);
	 
	$tabla = "<table style='text-align:center; margin-top:10px;' >
				<tr>
					<th colspan=4 class='BorderInf'>
						SE HA GRABADO EN ".strtoupper($vname)."
					</th>
				</tr>
				<tr>
					<td style='whidth:220px; text-align:right;'>NUMERO</td>
					<td style='whidth:220px;>".$_POST['factnum']."</td>
					<td style='whidth:220px;>FECHA</td>
					<td>".$iniy.$factdate."</td>
				</tr>
				<tr>
					<td style='text-align:right;'>RAZON SOCIAL</td>
					<td>".$_POST['factnom']."</td>
					<td>NIF / CIF</td>
					<td>".$_POST['factnif']."</td>
				</tr>
				<tr>
					<td style='text-align:right;'>IMPUESTOS %</td>
					<td>".$_POST['factiva']."</td>
					<td>IMPUESTOS €</td>
					<td>".$factivae."</td>
				</tr>
				<tr>
					<td style='text-align:right;'>RETENCIONES %</td>
					<td>".$_POST['factret']."</td>
					<td>RETENCIONES €</td>
					<td>".$factivae."</td>
				</tr>
				<tr>
					<td style='text-align:right;'>SUBTOTAL</td>
					<td>".$factpvp."</td>
					<td>TOTAL</td>
					<td>".$factpvptot."</td>
				</tr>
				<tr>
					<td style='text-align:right;'>DESCRIPCION</td>
					<td colspan='3' style='text-align:left;'>".$_POST['coment']."</td>
				</tr>
				<tr>
				<td colspan='4' align='center'>
					<a href='Gastos_Crear.php'>VOLVER GASTOS CREAR</a>
				</td>
				</tr>
			</table>";	
		
	/************* CREAMOS LAS IMAGENES EN LA IMG PRO SECCION ***************/
		
		/////////////

	if($_FILES['myimg1']['size'] == 0){$new_name1 = 'untitled.png';
			$new_name1 = $_POST['factnum']."_1.png";
			$rename_filename1 = "../cbj_Docs/docgastos_".$dyt1."/".$new_name1;								
			copy("../cbj_Docs/docgastos_".$dyt1."/untitled.png", $rename_filename1);
			}
		else{

			$safe_filename1 = trim(str_replace('/', '', $_FILES['myimg1']['name']));
			$safe_filename1 = trim(str_replace('..', '', $safe_filename1));
	
			$nombre1 = $_FILES['myimg1']['name'];
			$nombre1_tmp = $_FILES['myimg1']['tmp_name'];
			$tipo1 = $_FILES['myimg1']['type'];
			$tamano1 = $_FILES['myimg1']['size'];
	
			$destination_file1 = "../cbj_Docs/docgastos_".$dyt1."/".$safe_filename1;
		
	    if( file_exists("../cbj_Docs/docgastos_".$dyt1."/".$nombre1) ){
				unlink("../cbj_Docs/docgastos_".$dyt1."/".$nombre1);
			//	print("** El archivo ".$nombre1." Ya existe, seleccione otra imagen.</br>");
			}
			
		elseif (move_uploaded_file($_FILES['myimg1']['tmp_name'], $destination_file1)){

			// Renombrar el archivo:
			$extension1 = substr($_FILES['myimg1']['name'],-3);
			// print($extension1);
			// $extension1 = end(explode('.', $_FILES['myimg1']['name']) );
			global $new_name1;
			$new_name1 = $_POST['factnum']."_1.".$extension1;
			$rename_filename1 = "../cbj_Docs/docgastos_".$dyt1."/".$new_name1;								
			rename($destination_file1, $rename_filename1);
		}
		else {print("NO SE HA PODIDO GUARDAR EN ".$destination_file1);}
		}

		/////////////

	if($_FILES['myimg2']['size'] == 0){$new_name2 = 'untitled.png';
			$new_name2 = $_POST['factnum']."_2.png";
			$rename_filename2 = "../cbj_Docs/docgastos_".$dyt1."/".$new_name2;								
			copy("../cbj_Docs/docgastos_".$dyt1."/untitled.png", $rename_filename2);
			}
		else{

			$safe_filename2 = trim(str_replace('/', '', $_FILES['myimg2']['name']));
			$safe_filename2 = trim(str_replace('..', '', $safe_filename2));
	
			$nombre2 = $_FILES['myimg2']['name'];
			$nombre2_tmp = $_FILES['myimg2']['tmp_name'];
			$tipo2 = $_FILES['myimg2']['type'];
			$tamano2 = $_FILES['myimg2']['size'];
	
			$destination_file2 = "../cbj_Docs/docgastos_".$dyt1."/".$safe_filename2;
		
	    if( file_exists("../cbj_Docs/docgastos_".$dyt1."/".$nombre2) ){
				unlink("../cbj_Docs/docgastos_".$dyt1."/".$nombre2);
			//	print("** El archivo ".$nombre1." Ya existe, seleccione otra imagen.</br>");
			}
			
		elseif (move_uploaded_file($_FILES['myimg2']['tmp_name'], $destination_file2)){

			// Renombrar el archivo:
			$extension2 = substr($_FILES['myimg2']['name'],-3);
			// print($extension2);
			// $extension2 = end(explode('.', $_FILES['myimg2']['name']) );
			global $new_name2;
			$new_name2 = $_POST['factnum']."_2.".$extension2;
			$rename_filename2 = "../cbj_Docs/docgastos_".$dyt1."/".$new_name2;								
			rename($destination_file2, $rename_filename2);
		}
		else {print("NO SE HA PODIDO GUARDAR EN ".$destination_file2);}
		}
			
		/////////////

	if($_FILES['myimg3']['size'] == 0){$new_name3 = 'untitled.png';
			$new_name3 = $_POST['factnum']."_3.png";
			$rename_filename3 = "../cbj_Docs/docgastos_".$dyt1."/".$new_name3;								
			copy("../cbj_Docs/docgastos_".$dyt1."/untitled.png", $rename_filename3);
			}
		else{

			$safe_filename3 = trim(str_replace('/', '', $_FILES['myimg3']['name']));
			$safe_filename3 = trim(str_replace('..', '', $safe_filename3));
	
			$nombre3 = $_FILES['myimg3']['name'];
			$nombre3_tmp = $_FILES['myimg3']['tmp_name'];
			$tipo3 = $_FILES['myimg3']['type'];
			$tamano3 = $_FILES['myimg3']['size'];
	
			$destination_file3 = "../cbj_Docs/docgastos_".$dyt1."/".$safe_filename3;
		
	    if( file_exists("../cbj_Docs/docgastos_".$dyt1."/".$nombre3) ){
				unlink("../cbj_Docs/docgastos_".$dyt1."/".$nombre3);
			//	print("** El archivo ".$nombre1." Ya existe, seleccione otra imagen.</br>");
			}
			
		elseif (move_uploaded_file($_FILES['myimg3']['tmp_name'], $destination_file3)){

			// Renombrar el archivo:
			$extension3 = substr($_FILES['myimg3']['name'],-3);
			// print($extension3);
			// $extension3 = end(explode('.', $_FILES['myimg3']['name']) );
			global $new_name3;
			$new_name3 = $_POST['factnum']."_3.".$extension3;
			$rename_filename3 = "../cbj_Docs/docgastos_".$dyt1."/".$new_name3;								
			rename($destination_file3, $rename_filename3);
		}
		else {print("NO SE HA PODIDO GUARDAR EN ".$destination_file3);}
		}
			
		/////////////
		
	if($_FILES['myimg4']['size'] == 0){$new_name4 = 'untitled.png';
			$new_name4 = $_POST['factnum']."_4.png";
			$rename_filename4 = "../cbj_Docs/docgastos_".$dyt1."/".$new_name4;								
			copy("../cbj_Docs/docgastos_".$dyt1."/untitled.png", $rename_filename4);
			}
		else{

			$safe_filename4 = trim(str_replace('/', '', $_FILES['myimg4']['name']));
			$safe_filename4 = trim(str_replace('..', '', $safe_filename4));
	
			$nombre4 = $_FILES['myimg4']['name'];
			$nombre4_tmp = $_FILES['myimg4']['tmp_name'];
			$tipo4 = $_FILES['myimg4']['type'];
			$tamano4 = $_FILES['myimg4']['size'];
	
			$destination_file4 = "../cbj_Docs/docgastos_".$dyt1."/".$safe_filename4;
		
	    if( file_exists("../cbj_Docs/docgastos_".$dyt1."/".$nombre4) ){
				unlink("../cbj_Docs/docgastos_".$dyt1."/".$nombre4);
			//	print("** El archivo ".$nombre1." Ya existe, seleccione otra imagen.</br>");
			}
			
		elseif (move_uploaded_file($_FILES['myimg4']['tmp_name'], $destination_file4)){

			// Renombrar el archivo:
			$extension4 = substr($_FILES['myimg4']['name'],-3);
			// print($extension4);
			// $extension4 = end(explode('.', $_FILES['myimg4']['name']) );
			global $new_name4;
			$new_name4 = $_POST['factnum']."_4.".$extension4;
			$rename_filename4 = "../cbj_Docs/docgastos_".$dyt1."/".$new_name4;								
			rename($destination_file4, $rename_filename4);
		}
		else {print("NO SE HA PODIDO GUARDAR EN ".$destination_file4);}
		}
			
		/////////////
		
	global $db; 		global $db_name;

	if(strlen(trim($factrete)) == 0){
		$factrete = 0.0;
	} else { }

	$sqla = "INSERT INTO `$db_name`.$vname (`factnum`, `factdate`, `refprovee`, `factnom`, `factnif`, `factiva`, `factivae`, `factpvp`, `factret`, `factrete`, `factpvptot`,`coment`, `myimg1`, `myimg2`, `myimg3`, `myimg4`) VALUES ('$_POST[factnum]', '$factdate', '$_POST[refprovee]', '$_POST[factnom]', '$_POST[factnif]', '$_POST[factiva]', '$factivae', '$factpvp', '$_POST[factret]', '$factrete', '$factpvptot', '$_POST[coment]', '$new_name1', '$new_name2', '$new_name3', '$new_name4')";
		
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
	global $vnamebalg; 		$vnamebalg = "`".$_SESSION['clave']."balanceg`";
	global $vnamebali; 		$vnamebali = "`".$_SESSION['clave']."balancei`";
	$sqlbalg =  "SELECT * FROM `$db_name`.$vnamebalg WHERE `year` = '$dyx' AND `mes` = '$dmx' ";
	$qbalg = mysqli_query($db, $sqlbalg);
	$countbali = mysqli_num_rows($qbalg);
	$rowbalg = mysqli_fetch_assoc($qbalg);
	
	$sumamesiva = $rowbalg['iva'] + $factivae;	
		$sumamesiva = number_format($sumamesiva,2,".","");	
	$sumamespvp = $rowbalg['sub'] + $factpvp;	
		$sumamespvp = number_format($sumamespvp,2,".","");	
	$sumamesret = $rowbalg['ret'] + $factrete;	
		$sumamesret = number_format($sumamesret,2,".","");	
	$sumamestot = $rowbalg['tot'] + $factpvptot;	
		$sumamestot = number_format($sumamestot,2,".","");	

	//print("* ".$dyt1." ".$dm1.".</br>");
	//print("* ".$sumamesiva." ".$sumamespvp." ".$sumamestot.".</br>");

	$sqlbi = "UPDATE `$db_name`.$vnamebalg  SET `iva` = '$sumamesiva', `sub` = '$sumamespvp', `ret` = '$sumamesret', `tot` =  '$sumamestot' WHERE `year` = '$dyx' AND `mes` = '$dmx' ";
		
		if(mysqli_query($db, $sqlbi)){ //print("**"); 
					} else {
							print("* MODIFIQUE LA ENTRADA 914: ".mysqli_error($db));
									global $texerror;
									$texerror = "\n\t ".mysqli_error($db);
							}

		/////////////
	
	$sqlbalg2 =  "SELECT * FROM `$db_name`.$vnamebalg WHERE `year` = '$dyx' AND `mes` = 'ANU' ";
	$qbalg2 = mysqli_query($db, $sqlbalg2);
	$countbalg2 = mysqli_num_rows($qbalg2);
	$rowbalg2 = mysqli_fetch_assoc($qbalg2);

	$sumayeariva = $rowbalg2['iva'] + $factivae;	
		$sumayeariva = number_format($sumayeariva,2,".","");	
	$sumayearpvp = $rowbalg2['sub'] + $factpvp;	
		$sumayearpvp = number_format($sumayearpvp,2,".","");	
	$sumayearret = $rowbalg2['ret'] + $factrete;	
		$sumayearret = number_format($sumayearret,2,".","");	
	$sumayeartot = $rowbalg2['tot'] + $factpvptot;	
		$sumayeartot = number_format($sumayeartot,2,".","");	

	//print("* ".$sumayeariva." ".$sumayearpvp." ".$sumayeartot.".</br>");

	$sqlbg2 = "UPDATE `$db_name`.$vnamebalg  SET `iva` = '$sumayeariva', `sub` = '$sumayearpvp', `ret` = '$sumayearret', `tot` =  '$sumayeartot' WHERE `year` = '$dyx' AND `mes` = 'ANU' ";
		
		if(mysqli_query($db, $sqlbg2)){ //print("**"); 
					} else {
							print("* MODIFIQUE LA ENTRADA 936: ".mysqli_error($db));
									global $texerror;
									$texerror = "\n\t ".mysqli_error($db);
							}

		/////////////

	global $mes;
	if(($dmx == "M01")||($dmx == "M02")||($dmx == "M03")){$mes = "TRI1";}
	elseif(($dmx == "M04")||($dmx == "M05")||($dmx == "M06")){$mes = "TRI2";}
	elseif(($dmx == "M07")||($dmx == "M08")||($dmx == "M09")){$mes = "TRI3";}
	elseif(($dmx == "10")||($dmx == "11")||($dmx == "12")){$mes = "TRI4";}
	
	$sqlbalg3 =  "SELECT * FROM `$db_name`.$vnamebalg WHERE `year` = '$dyx' AND `mes` = '$mes' ";
	$qbalg3 = mysqli_query($db, $sqlbalg3);
	$countbalg3 = mysqli_num_rows($qbalg3);
	$rowbalg3 = mysqli_fetch_assoc($qbalg3);

	$sumatriiva = $rowbalg3['iva'] + $factivae;	
		$sumatriiva = number_format($sumatriiva,2,".","");	
	$sumatripvp = $rowbalg3['sub'] + $factpvp;	
		$sumatripvp = number_format($sumatripvp,2,".","");	
	$sumatriret = $rowbalg3['ret'] + $factrete;	
		$sumatriret = number_format($sumatriret,2,".","");	
	$sumatritot = $rowbalg3['tot'] + $factpvptot;	
		$sumatritot = number_format($sumatritot,2,".","");	

	//print("* ".$sumatriiva." ".$sumatripvp." ".$sumatritot.".</br>");

	$sqlbg3 = "UPDATE `$db_name`.$vnamebalg  SET `iva` = '$sumatriiva', `sub` = '$sumatripvp',`ret` = '$sumatriret', `tot` =  '$sumatritot' WHERE `year` = '$dyx' AND `mes` = '$mes' ";
		
		if(mysqli_query($db, $sqlbg3)){ //print("**"); 
					} else {
							print("* MODIFIQUE LA ENTRADA 964: ".mysqli_error($db));
									global $texerror;
									$texerror = "\n\t ".mysqli_error($db);
							}
			
	
	}	

//////////////////////////////////////////////////////////////////////////////////////////////

	function show_form($errors=[]){
	
		global $db; 		global $db_name;
		
		global $sesionref; 		$sesionref = "`".$_SESSION['clave']."proveedores`";

		if(isset($_POST['proveegastos'])){
			$sqlx =  "SELECT * FROM $sesionref WHERE `ref` = '$_POST[proveegastos]'";
			$qx = mysqli_query($db, $sqlx);
			$rowprovee = mysqli_fetch_assoc($qx);

			$qx = mysqli_query($db, $sqlx);
			$rowprovee = mysqli_fetch_assoc($qx);
			$_rsocial = $rowprovee['rsocial'];
			$_ref = $rowprovee['ref'];
			$_dni = $rowprovee['dni'];
			$_ldni = $rowprovee['ldni'];
			global $_dnil;
			$_dnil = $_dni.$_ldni;
		}
	
		/*
		if((isset($_POST['oculto']))||(isset($_POST['oculto1']))){

			$defaults = $_POST;
			$sqlx =  "SELECT * FROM $sesionref WHERE `ref` = '$_POST[proveegastos]'";
			$qx = mysqli_query($db, $sqlx);
			$rowprovee = mysqli_fetch_assoc($qx);
			$sqlx =  "SELECT * FROM $sesionref WHERE `ref` = '$_POST[proveegastos]'";
			$qx = mysqli_query($db, $sqlx);
			$rowprovee = mysqli_fetch_assoc($qx);

			$defaults['refprovee'] = $rowprovee['ref'];
			$defaults['factnom'] = $rowprovee['rsocial'];
			$defaults['factnif'] = $rowprovee['dni'].$rowprovee['ldni'];

		} else {
				$defaults = array (	'proveegastos' => '',
								'dy' => '',
								'dm' => '',
								'dd' => '',
								'factnum' => '',
								'factdate' => '',
							   	'refprovee' => '',
							   	'factnom' => '',
							   	'factnif' => '',
							   	'factiva' => '',
								'factivae1' => '',	
								'factivae2' => '',	
							   	'factret' => '',
								'factrete1' => '',	
								'factrete2' => '',	
								'factpvp1' => '',	
								'factpvp2' => '',	
								'factpvptot1' => '',	
								'factpvptot2' => '',	
								'coment' => '',	
								'myimg1' => '',	
								'myimg2' => '',	
								'myimg3' => '',	
								'myimg4' => '');
						}
		*/

		if(isset($_POST['oculto'])){
				 //$defaults = $_POST;
				 $defaults = array ( 'proveegastos' => $_POST['proveegastos'],
									 'dy' => $_POST['dy'],
									 'dm' => $_POST['dm'],
									 'dd' => $_POST['dd'],
									 'factnum' => strtoupper($_POST['factnum']),
								     // 'factdate' => $_POST['factdate'],
								   	 'refprovee' => $rowprovee['ref'],
								   	 'factnom' => $rowprovee['rsocial'],
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
				$defaults = array ( 'proveegastos' => $_POST['proveegastos'],
								   	 'refprovee' => $rowprovee['ref'],
								   	 'factnom' => $rowprovee['rsocial'],
								   	 'factnif' => $_dnil);

		} else { $defaults = array ( 'proveegastos' => @$_POST['proveegastos'],
									 'dy' => @$_POST['dy'],
									 'dm' => @$_POST['dm'],
									 'dd' => @$_POST['dd'],
									 'factnum' => strtoupper(@$_POST['factnum']),
								     // 'factdate' => $_POST['factdate'],
								   	 'refprovee' => @$rowprovee['ref'],
								   	 'factnom' => @$rowprovee['rsocial'],
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

	if ($errors){
		print("	<div>
					<table style='width: max-content; margin: 0.4em auto 0.4em auto; border: none;'>
					<th style='text-align:left'>
					<font color='#FF0000'>* SOLUCIONE ESTOS ERRORES:</font><br/>
					</th>
					<tr>
					<td style='text-align:left'>");
			
		for($a=0; $c=count($errors), $a<$c; $a++){
			print("<font color='#FF0000'>**</font>  ".$errors [$a]."<br/>");
			}
		print("</td>
				</tr>
				</table>
				</div>
				<div style='clear:both'></div>");
		}

	$dm = array (	'' => 'MONTH',
					'01' => 'ENERO',
					'02' => 'FEBRERO',
					'03' => 'MARZO',
					'04' => 'ABRIL',
					'05' => 'MAYO',
					'06' => 'JUNIO',
					'07' => 'JULIO',
					'08' => 'AGOSTO',
					'09' => 'SEPTIEMBRE',
					'10' => 'OCTUBRE',
					'11' => 'NOVIEMBRE',
					'12' => 'OCTUBRE',
									);
	
	$dd = array (	'' => 'DAY',
					'01' => '01',
					'02' => '02',
					'03' => '03',
					'04' => '04',
					'05' => '05',
					'06' => '06',
					'07' => '07',
					'08' => '08',
					'09' => '09',
					'10' => '10',
					'11' => '11',
					'12' => '12',
					'13' => '13',
					'14' => '14',
					'15' => '15',
					'16' => '16',
					'17' => '17',
					'18' => '18',
					'19' => '19',
					'20' => '20',
					'21' => '21',
					'22' => '22',
					'23' => '23',
					'24' => '24',
					'25' => '25',
					'26' => '26',
					'27' => '27',
					'28' => '28',
					'29' => '29',
					'30' => '30',
					'31' => '31',
									);
										

		print("
			<table align='center' style=\"border:0px;margin-top:4px\" width='auto'>
				
			<form name='form_tabla' method='post' action='$_SERVER[PHP_SELF]'>
				<tr>
					<td colspan='4' align='center'>
							SELECCIONE UN PROVEEDOR
					</td>
				</tr>		
				<tr>
					<td>
					<div style='float:left'>
						<input type='submit' value='SELECCIONE PROVEEDOR' />
						<input type='hidden' name='oculto1' value=1 />
					</div>
					<div style='float:left'>

						<select name='proveegastos'>");

	global $db;
	global $tabla1; 		$tabla1 = "`".$_SESSION['clave']."proveedores`";

	$sqlb =  "SELECT * FROM $tabla1 ORDER BY `rsocial` ASC ";
	$qb = mysqli_query($db, $sqlb);
	if(!$qb){
			print("* ".mysqli_error($db)."</br>");
	} else {
					
		while($rows = mysqli_fetch_assoc($qb)){
					
					print ("<option value='".$rows['ref']."' ");
					
					if($rows['ref'] == $defaults['proveegastos']){
															print ("selected = 'selected'");
																								}
													print ("> ".$rows['rsocial']." </option>");
		}

	}  

	print ("</select>
					</div>
				</td>
			</tr>
		</form>	
			</table>"); 
				
////////////////////

	if ((isset($_POST['oculto1'])) || (isset($_POST['oculto']))) {
	if (($_POST['proveegastos'] == '') && ($defaults['factnom'] == '')) { 
			print("<table align='center' style=\"margin-top:20px;margin-bottom:20px\">
						<tr align='center'>
							<td>
								<font color='red'>SELECCIONE UN PROVEEDOR</font>
							</td>
						</tr>
					</table>");
				}

	if($_POST['proveegastos'] != '') {
	print("<table align='center' style=\"margin-top:10px\">
				<tr>
					<th colspan=2 class='BorderInf'>GRABAR GASTO</th>
				</tr>
		<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]' enctype='multipart/form-data'>
			<input type='hidden' name='proveegastos' value='".$defaults['proveegastos']."' />
				<tr>
					<td>NUMERO</td>
					<td>
			<input type='text' name='factnum' size=22 maxlength=20 value='".strtoupper(@$defaults['factnum'])."' />
					</td>
				</tr>
				<tr>
					<td>FECHA</td>
					<td>
				<div style='float:left'>");
								
		require '../Inclu/year_in_select_bbdd.php';
																
		print ("</select>
					</div>
					<div style='float:left'>
				<select style='margin-left:12px' name='dm'>");
					foreach($dm as $optiondm => $labeldm){
						print ("<option value='".$optiondm."' ");
					if($optiondm == @$defaults['dm']){
										print ("selected = 'selected'");
											}
								print ("> $labeldm </option>");
							}	
																
		print ("</select>
					</div>
					<div style='float:left'>
						<select style='margin-left:12px' name='dd'>");
			foreach($dd as $optiondd => $labeldd){
						print ("<option value='".$optiondd."' ");
					if($optiondd == @$defaults['dd']){
										print ("selected = 'selected'");
											}
							print ("> $labeldd </option>");
						}	
		print ("</select> 
					</div>
					</td>
				</tr>
				<tr>
					<td>RAZON SOCIAL</td>
					<td>
		<input type='hidden' name='factnom' value='".@$defaults['factnom']."' />".@$defaults['factnom']."
					</td>
				</tr>
				<tr>
					<td>REFERENCIA</td>
					<td>
		<input type='hidden' name='refprovee' value='".$defaults['refprovee']."' />".$defaults['refprovee']."
					</td>
				</tr>
				<tr>
					<td>NIF/CIF</td>
					<td>
	<input type='hidden' name='factnif'value='".@$defaults['factnif']."' />".@$defaults['factnif']."
					</td>
				</tr>
				<tr>
					<td>IMPUESTOS %</td>
					<td>
			<div style='float:left'>
				<select name='factiva'>");

		global $db;
		global $vname; 		$vname = "`".$_SESSION['clave']."impuestos`";
		$sqli =  "SELECT * FROM $vname ORDER BY `iva` ASC ";
		$qi = mysqli_query($db, $sqli);

			if(!$qi){	print("* ".mysqli_error($db)."</br>");
				} else {
					while($rowimp = mysqli_fetch_assoc($qi)){
							print ("<option value='".$rowimp['iva']."' ");
							if($rowimp['iva'] == @$defaults['factiva']){
							print ("selected = 'selected'");
									}
							print ("> ".$rowimp['name']." </option>");
							}
						} 
						 
		print ("</select>
						</div>
					</td>
				</tr>
				<tr>
					<td>IMPUESTOS €</td>
					<td>
			<input style='text-align:right' type='text' name='factivae1' size=5 maxlength=5 value='".@$defaults['factivae1']."' />,
			<input type='text' name='factivae2' size=2 maxlength=2 value='".@$defaults['factivae2']."' />€
					</td>
				</tr>
				<tr>
					<td>RETENCIONES %</td>
					<td>
			<div style='float:left'>
				<select name='factret'>");

		global $db;
		global $vnamer; 	$vnamer = "`".$_SESSION['clave']."retencion`";
		$sqlr =  "SELECT * FROM $vnamer ORDER BY `ret` ASC ";
		$qr = mysqli_query($db, $sqlr);

			if(!$qr){	print("* ".mysqli_error($db)."</br>");
				} else {
					while($rowret = mysqli_fetch_assoc($qr)){
							print ("<option value='".$rowret['ret']."' ");
							if($rowret['ret'] == @$defaults['factret']){
							print ("selected = 'selected'");
								}
							print ("> ".$rowret['name']." </option>");
							}
						} 
						 
		print ("</select>
						</div>
					</td>
				</tr>
				<tr>
					<td>RETENCIONES €</td>
					<td>
			<input style='text-align:right' type='text' name='factrete1' size=5 maxlength=5 value='".@$defaults['factrete1']."' />,
			<input type='text' name='factrete2' size=2 maxlength=2 value='".@$defaults['factrete2']."' />€
					</td>
				</tr>
				<tr>
					<td>SUBTOTAL €</td>
					<td>
			<input style='text-align:right' type='text' name='factpvp1' size=5 maxlength=5 value='".@$defaults['factpvp1']."' />,
			<input type='text' name='factpvp2' size=2 maxlength=2 value='".@$defaults['factpvp2']."' />€
					</td>
				</tr>
				<tr>
					<td>TOTAL €</td>
					<td>
			<input style='text-align:right' type='text' name='factpvptot1' size=5 maxlength=5 value='".@$defaults['factpvptot1']."' />,
			<input type='text' name='factpvptot2' size=2 maxlength=2 value='".@$defaults['factpvptot2']."' />€
					</td>
				</tr>
				<tr>
					<td>DESCRIPCIÓN</td>
					<td>
			<textarea cols='35' rows='7' onkeypress='return limitac(event, 200);' onkeyup='actualizaInfoc(200)' name='coment' id='coment'>".@$defaults['coment']."</textarea>
			</br>
	            <div id='infoc' align='center' style='color:#0080C0;'>
        					Maximum 200 characters            
				</div>
					</td>
				</tr>
				<tr>
					<td>PDF / FOTO 1</td>
					<td>
		<input type='file' name='myimg1' value='".@$defaults['myimg1']."' />						
					</td>
				</tr>
				<tr>
					<td>PDF / FOTO 2</td>
					<td>
		<input type='file' name='myimg2' value='".@$defaults['myimg2']."' />						
					</td>
				</tr>
				<tr>
					<td>PDF / FOTO 3</td>
					<td>
		<input type='file' name='myimg3' value='".@$defaults['myimg3']."' />						
					</td>
				</tr>
				<tr>
					<td>PDF / FOTO 4</td>
					<td>
		<input type='file' name='myimg4' value='".@$defaults['myimg4']."' />						
					</td>
				</tr>
				<tr>
					<td colspan='2' align='right' valign='middle'  class='BorderSup'>
						<input type='submit' value='GRABAR GASTO' />
						<input type='hidden' name='oculto' value=1 />
					</td>
				</tr>
		</form>														
			</table>"); 
			}
		}

	} // FIN function show_form()

/////////////////////////////////////////////////////////////////////////////////////////////////

function info(){

	global $db;
	global $factdate;
	global $factivae;
	global $factpvp;
	global $factpvptot;
	global $factrete;
	
	$ActionTime = date('H:i:s');

	global $dir;
	if ($_SESSION['Nivel'] == 'admin'){ 
				$dir = "../cbj_Docs/log";
				}
	
global $text;
$text = "\n- GASTO CREADO ".$ActionTime.".\n\tNº FACTURA: ".$_POST['factnum'].".\n\tDATE FACTURA: ".$factdate.".\n\tRAZON SOCIAL: ".$_POST['factnom'].".\n\tNIF: ".$_POST['factnif'].".\n\tTIPO IVA %: ".$_POST['factiva'].".\n\tTIPO RETEN %: ".$_POST['factret'].".\n\tRETEN €: ".$factrete.".\n\tNETO €: ".$factpvp.".\n\tTOTAL €: ".$factpvptot;

		$logdocu = $_SESSION['ref'];
		$logdate = date('Y-m-d');
		$logtext = $text."\n";
		$filename = $dir."/".$logdate."_".$logdocu.".log";
		$log = fopen($filename, 'ab+');
		fwrite($log, $logtext);
		fclose($log);

	}

/////////////////////////////////////////////////////////////////////////////////////////////////
	
	function master_index(){
		
		global $rutaIndex;		$rutaIndex = "../";
		require '../Inclu_MInd/MasterIndexVar.php';
		global $rutaGastos;	$rutaGastos = "";
		require '../Inclu_MInd/MasterIndex.php'; 
		
				} /* Fin funcion master_index.*/

/////////////////////////////////////////////////////////////////////////////////////////////////
	
/////////////////////////////////////////////////////////////////////////////////////////////////

	require '../Inclu/Conta_Footer.php';

?>