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

	if(isset($_POST['oculto2'])){	info_01();
							show_form();
	} elseif(isset($_POST['oculto'])){							
			if($form_errors = validate_form()){
					show_form($form_errors);
			} else { process_form();
					 info_02();
				if(($_SESSION['yold'] != $_SESSION['ynew'])||($_SESSION['mold'] != $_SESSION['mnew'])){ }
					}
			} else {show_form();}

	} else { require '../Inclu/table_permisos.php'; } 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function validate_form(){
	
		global $sqld; 		global $qd; 		global $rowd;

		$errors = array();
	
		require 'ValidateForm.php';
	
		return $errors;

	} 
		
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function process_form(){
	
		global $db; 		global $db_name;	
		global $dyt1; 		global $dynew;
		
		require 'Ingresos_factdate.php';

		require 'FormatNumber.php';
	
	//////////////
		//////////////
	//////////////
	
		global $ivaold;
		$ivaold = $_SESSION['ivae1'].".".$_SESSION['ivae2'];
	
		if($_SESSION['ivae1'] == $factivae1) {
				global $diferiva;
				if($_SESSION['ivae2'] == $factivae2) {}
				elseif($_SESSION['ivae2'] > $factivae2) {
									$diferiva = $ivaold - $factivae;
									$diferiva = "-".$diferiva;
							}
				elseif($_SESSION['ivae2'] < $factivae2) {
									$diferiva = $factivae - $ivaold;
							}
		}
		elseif($_SESSION['ivae1'] > $factivae1) {
									global $diferiva;
									$diferiva = $ivaold - $factivae;
									$diferiva = "-".$diferiva;
		}
		elseif($_SESSION['ivae1'] < $factivae1) {
									global $diferiva;
									$diferiva = $factivae - $ivaold;
			}

		//	printf('%.2f', $diferiva);
		//	print("<br/>* Difer iva tot: ".$diferiva."<br/>");
		
	//////////////
	
		global $retold;
		$retold = $_SESSION['rete1'].".".$_SESSION['rete2'];
	
		if($_SESSION['rete1'] == $factrete1) {
				global $diferret;
				if($_SESSION['rete2'] == $factrete2) {}
				elseif($_SESSION['rete2'] > $factrete2) {
									$diferret = $retold - $factrete;
									$diferret = "-".$diferret;
							}
				elseif($_SESSION['rete2'] < $factrete2) {
									$diferret = $factrete - $retold;
							}
		}
		elseif($_SESSION['rete1'] > $factrete1) {
									global $diferret;
									$diferret = $retold - $factrete;
									$diferret = "-".$diferret;
		}
		elseif($_SESSION['rete1'] < $factrete1) {
									global $diferret;
									$diferret = $factrete - $retold;
			}

		//	printf('%.2f', $diferret);
		//	print("<br/>* Difer ret tot: ".$diferret."<br/>");
		
	//////////////

		global $pvpold;
		$pvpold = $_SESSION['factpvp1'].".".$_SESSION['factpvp2'];
		
		if($_SESSION['factpvp1'] == $factpvp1) {
				global $diferpvp;
				if($_SESSION['factpvp2'] == $factpvp2) {}
				elseif($_SESSION['factpvp2'] > $factpvp2) {
									$diferpvp = $pvpold - $factpvp;
									$diferpvp = "-".$diferpvp;
							}
				elseif($_SESSION['factpvp2'] < $factpvp2) {
									$diferpvp = $factpvp - $pvpold;
							}
		}
		elseif($_SESSION['factpvp1'] > $factpvp1) {
									global $diferpvp;
									$diferpvp = $pvpold - $factpvp;
									$diferpvp = "-".$diferpvp;
		}
		elseif($_SESSION['factpvp1'] < $factpvp1) {
									global $diferpvp;
									$diferpvp = $factpvp - $pvpold;
			}
		//	printf('%.2f', $diferpvp);
		//	print("<br/>* Difer pvp : ".$diferpvp."<br/>");
		
	//////////////
			
		global $pvptold;
		$pvptold = $_SESSION['factpvptot1'].".".$_SESSION['factpvptot2'];

		if($_SESSION['factpvptot1'] == $factpvptot1) {
				global $diferpvptot;
				if($_SESSION['factpvptot2'] == $factpvptot2) {}
				elseif($_SESSION['factpvptot2'] > $factpvptot2) {
									$diferpvptot = $pvptold - $factpvptot;
									$diferpvptot = "-".$diferpvptot;
							}
				elseif($_SESSION['factpvptot2'] < $factpvptot2) {
									$diferpvptot = $factpvptot - $pvptold;
							}
		}
		elseif($_SESSION['factpvp1'] > $factpvptot1) {
									global $diferpvptot;
									$diferpvptot = $pvptold - $factpvptot;
									$diferpvptot = "-".$diferpvptot;
		}
		elseif($_SESSION['factpvp1'] < $factpvptot1) {
									global $diferpvptot;
									$diferpvptot = $factpvptot - $pvptold;
			}
			
		//	printf('%.2f', $diferpvptot);
		//	print("<br/>* Difer pvp tot: ".$diferpvptot."<br/>");
		
	//////////////
		//////////////
	//////////////

	$_SESSION['ynew'] = $dynew;
	$_SESSION['mnew'] = $_POST['dm'];
	
	if(($_SESSION['yold'] == $dynew) && ($_SESSION['mold'] == $_POST['dm'])){
	
	global $dyx; 		$dyx = "20".$_POST['dy'];
	global $dmx; 		$dmx = "M".$_POST['dm'];
				
	
	global $mes;
	if(($dmx == "M01")||($dmx == "M02")||($dmx == "M03")){$mes = "TRI1";}
	elseif(($dmx == "M04")||($dmx == "M05")||($dmx == "M06")){$mes = "TRI2";}
	elseif(($dmx == "M07")||($dmx == "M08")||($dmx == "M09")){$mes = "TRI3";}
	elseif(($dmx == "M10")||($dmx == "M11")||($dmx == "M12")){$mes = "TRI4";}
	
}elseif(($_SESSION['yold'] == $dynew)&&($_SESSION['mold'] != $_POST['dm'])){
		
	global $factpvp;
	global $factivae;
	global $factrete;
	global $factpvptot;

		global $ivaold;
		$ivaold = $_SESSION['ivae1'].".".$_SESSION['ivae2'];
		global $retold;
		$retold = $_SESSION['rete1'].".".$_SESSION['rete2'];
		global $pvpold;
		$pvpold = $_SESSION['factpvp1'].".".$_SESSION['factpvp2'];
		global $pvptold;
		$pvptold = $_SESSION['factpvptot1'].".".$_SESSION['factpvptot2'];

	global $dyx; 		$dyx = "20".$_POST['dy'];
	global $dmx; 		$dmx = "M".$_POST['dm'];

		$dmxo = "M".$_SESSION['mold'];
		global $meso;
		if(($dmxo == "M01")||($dmxo == "M02")||($dmxo == "M03")){$meso = "TRI1";}
		elseif(($dmxo == "M04")||($dmxo == "M05")||($dmxo == "M06")){$meso = "TRI2";}
		elseif(($dmxo == "M07")||($dmxo == "M08")||($dmxo == "M09")){$meso = "TRI3";}
		elseif(($dmxo == "M10")||($dmxo == "M11")||($dmxo == "M12")){$meso = "TRI4";}
		global $mes;
		if(($dmx == "M01")||($dmx == "M02")||($dmx == "M03")){$mes = "TRI1";}
		elseif(($dmx == "M04")||($dmx == "M05")||($dmx == "M06")){$mes = "TRI2";}
		elseif(($dmx == "M07")||($dmx == "M08")||($dmx == "M09")){$mes = "TRI3";}
		elseif(($dmx == "M10")||($dmx == "M11")||($dmx == "M12")){$mes = "TRI4";}
		
		if($meso == $mes){
		global $mes;
		if(($dmx == "M01")||($dmx == "M02")||($dmx == "M03")){$mes = "TRI1";}
		elseif(($dmx == "M04")||($dmx == "M05")||($dmx == "M06")){$mes = "TRI2";}
		elseif(($dmx == "M07")||($dmx == "M08")||($dmx == "M09")){$mes = "TRI3";}
		elseif(($dmx == "M10")||($dmx == "M11")||($dmx == "M12")){$mes = "TRI4";}
		
		global $mes;
		if(($dmx == "M01")||($dmx == "M02")||($dmx == "M03")){$mes = "TRI1";}
		elseif(($dmx == "M04")||($dmx == "M05")||($dmx == "M06")){$mes = "TRI2";}
		elseif(($dmx == "M07")||($dmx == "M08")||($dmx == "M09")){$mes = "TRI3";}
		elseif(($dmx == "M10")||($dmx == "M11")||($dmx == "M12")){$mes = "TRI4";}

		$dmxo = "M".$_SESSION['mold'];
		global $meso;
		if(($dmxo == "M01")||($dmxo == "M02")||($dmxo == "M03")){$meso = "TRI1";}
		elseif(($dmxo == "M04")||($dmxo == "M05")||($dmxo == "M06")){$meso = "TRI2";}
		elseif(($dmxo == "M07")||($dmxo == "M08")||($dmxo == "M09")){$meso = "TRI3";}
		elseif(($dmxo == "M10")||($dmxo == "M11")||($dmxo == "M12")){$meso = "TRI4";}

	//	print("* ".$sumatriiva." ".$sumatripvp." ".$sumatritot.".<br/>");

			}
			
	}elseif($_SESSION['yold'] != $dynew){
	
		global $ivaold; 	$ivaold = $_SESSION['ivae1'].".".$_SESSION['ivae2'];
		global $retold; 	$retold = $_SESSION['rete1'].".".$_SESSION['rete2'];
		global $pvpold; 	$pvpold = $_SESSION['factpvp1'].".".$_SESSION['factpvp2'];
		global $pvptold; 	$pvptold = $_SESSION['factpvptot1'].".".$_SESSION['factpvptot2'];

		global $dyx; 		$dyx = "20".$_POST['dy'];
		global $dmx; 		$dmx = "M".$_POST['dm'];

		global $dyxo;
		global $dmxo;
		$dyxo = "20".$_SESSION['yold'];
		$dmxo = "M".$_SESSION['mold'];

		global $mes;
		if(($dmx == "M01")||($dmx == "M02")||($dmx == "M03")){$mes = "TRI1";}
		elseif(($dmx == "M04")||($dmx == "M05")||($dmx == "M06")){$mes = "TRI2";}
		elseif(($dmx == "M07")||($dmx == "M08")||($dmx == "M09")){$mes = "TRI3";}
		elseif(($dmx == "M10")||($dmx == "M11")||($dmx == "M12")){$mes = "TRI4";}
		
		$dmxo = "M".$_SESSION['mold'];
		global $meso;
		if(($dmxo == "M01")||($dmxo == "M02")||($dmxo == "M03")){$meso = "TRI1";}
		elseif(($dmxo == "M04")||($dmxo == "M05")||($dmxo == "M06")){$meso = "TRI2";}
		elseif(($dmxo == "M07")||($dmxo == "M08")||($dmxo == "M09")){$meso = "TRI3";}
		elseif(($dmxo == "M10")||($dmxo == "M11")||($dmxo == "M12")){$meso = "TRI4";}

		}

	//////////////
		//////////////
	//////////////

	$idx = $_SESSION['idx'];
	global $vname; 		$vname = "`".$_SESSION['clave']."ingresos_".$dyt1."`";
	$_SESSION['vname'] = $vname;
	
	if($_SESSION['yold'] != $dynew){
		
		global $rutaold;
		global $rutanew;
		$rutaold = "../cbj_Docs/docingresos_20".$_SESSION['yold']."/";
		$rutanew = "../cbj_Docs/docingresos_20".$dynew."/";
		
		if(file_exists($rutaold.$_SESSION['myimg1b']) ){
					copy($rutaold.$_SESSION['myimg1b'], $rutanew.$_SESSION['myimg1b']);
					unlink($rutaold.$_SESSION['myimg1b']);
			/*		print(" <br/>* CHANGE YEAR FACT: 20".$_SESSION['yold']." X 20".$dynew."
							<br/>- Ok Copy & Unlink Img Name 1.");
			*/
										}else{print("<br/>- No Ok Copy & Unlink Img Name 1.");}
										
		if(file_exists($rutaold.$_SESSION['myimg2b']) ){
								copy($rutaold.$_SESSION['myimg2b'], $rutanew.$_SESSION['myimg2b']);
								unlink($rutaold.$_SESSION['myimg2b']);
						/*		print("<br/>- Ok Copy & Unlink Img Name 2.");	*/
										}else{print("<br/>- No Ok Copy & Unlink Img Name 2.");}
										
		if(file_exists($rutaold.$_SESSION['myimg3b']) ){
								copy($rutaold.$_SESSION['myimg3b'], $rutanew.$_SESSION['myimg3b']);
								unlink($rutaold.$_SESSION['myimg3b']);
						/*		print("<br/>- Ok Copy & Unlink Img Name 3.");	*/
										}else{print("<br/>- No Ok Copy & Unlink Img Name 3.");}
										
		if(file_exists($rutaold.$_SESSION['myimg4b']) ){
								copy($rutaold.$_SESSION['myimg4b'], $rutanew.$_SESSION['myimg4b']);
								unlink($rutaold.$_SESSION['myimg4b']);
						/*		print("<br/>- Ok Copy & Unlink Img Name 4.");	*/
										}else{print("<br/>- No Ok Copy & Unlink Img Name 4.");}
										
	global $sent;								
		$sent = "INSERT INTO `$db_name`.$vname (`factnum`, `factdate`, `refcliente`, `factnom`, `factnif`, `factiva`, `factivae`, `factpvp`, `factret`, `factrete`, `factpvptot`,`coment`, `myimg1`, `myimg2`, `myimg3`, `myimg4`) VALUES ('$_POST[factnum]', '$factdate', '$_POST[clienteingresos]', '$_POST[factnom]', '$_POST[factnif]', '$_POST[factiva]', '$factivae', '$factpvp', '$_POST[factret]', '$factrete', '$factpvptot', '$_POST[coment]', '$_SESSION[myimg1b]', '$_SESSION[myimg2b]', '$_SESSION[myimg3b]', '$_SESSION[myimg4b]')";
		
	$idx = $_SESSION['idx'];
	global $vnamed; 		$vnamed = "`".$_SESSION['clave']."ingresos_20".$_SESSION['yold']."`";
		$sqla = "DELETE FROM `$db_name`.$vnamed  WHERE $vnamed.`id` = '$idx'  ";
		if(mysqli_query($db, $sqla)){ //	print("<br/>* OK DELETE DATA."); 
					} else {
							print("* MODIFIQUE LA ENTRADA 1187: ".mysqli_error($db));
									global $texerror;
									$texerror = "\n\t ".mysqli_error($db);
					}
		
	}	elseif($_SESSION['yold'] == $dynew){
		global $sent;								
		$sent = "UPDATE `$db_name`.$vname  SET `factnum` = '$_POST[factnum]', `factdate` = '$factdate', `refcliente` =  '$_POST[refcliente]', `factnom` =  '$_POST[factnom]', `factnif` = '$_POST[factnif]', `factiva` = '$_POST[factiva]', `factivae` = '$factivae', `factpvp` = '$factpvp', `factret` = '$_POST[factret]', `factrete` = '$factrete',  `factpvptot` = '$factpvptot', `coment` = '$_POST[coment]' WHERE $vname.`id` = '$idx'  ";
	}

	global $iniy; 		$iniy = substr(date('Y'),0,2);

	global $title;	$title = 'SE HA MODIFICADO EN ';
	
	global $link1; 	
	$link1 = "<a href='Ingresos_Ver.php' class='botonazul' style='color:#343434 !important' >INICIO INGRESOS</a>";
	global $link2;
	$link2 = "<a href='Ingresos_Crear.php' class='botonazul' style='color:#343434 !important' >CREAR NUEVO INGRESO</a>";
	
	require 'TableFormResult.php';
			
		/////////////
		
		global $db; 		global $sent; 		$sqla = $sent;
		
		if(mysqli_query($db, $sqla)){ //	print("<br/>* INSERT / UPDATE DB DATA.");
									  print($tabla); 
		} else { print("* MODIFIQUE LA ENTRADA: 1189/1195 ".mysqli_error($db));
				 show_form ();
				 global $texerror; 		$texerror = "\n\t ".mysqli_error($db);
					}

		/////////////
		
		$_SESSION['fnnew'] = $_POST['factnum'];
		
		if($_SESSION['fnold'] != $_POST['factnum']){
			
			$nombre1 = $_SESSION['myimg1b'];
			$extension1 = substr($_SESSION['myimg1b'],-3);
			$nombre1n = $_SESSION['fnnew']."_1.".$extension1;
			$_SESSION['$nombre1n'] = $nombre1n;
					
			$nombre2 = $_SESSION['myimg2b'];
			$extension2 = substr($_SESSION['myimg2b'],-3);
			$nombre2n = $_SESSION['fnnew']."_2.".$extension2;
			$_SESSION['$nombre2n'] = $nombre2n;

			$nombre3 = $_SESSION['myimg3b'];
			$extension3 = substr($_SESSION['myimg3b'],-3);
			$nombre3n = $_SESSION['fnnew']."_3.".$extension3;
			$_SESSION['$nombre3n'] = $nombre3n;

			$nombre4 = $_SESSION['myimg4b'];
			$extension4 = substr($_SESSION['myimg4b'],-3);
			$nombre4n = $_SESSION['fnnew']."_4.".$extension4;
			$_SESSION['$nombre4n'] = $nombre4n;

			global $ruta;
			$ruta = "../cbj_Docs/docingresos_20".$dynew."/";
			
			if( file_exists($ruta.$_SESSION['myimg1b'])){
						rename($ruta.$_SESSION['myimg1b'], $ruta.$_SESSION['$nombre1n']);
				/*		print("	<br/>* CHANGE FACT NUM: ".$_SESSION['fnold']." X ".$_SESSION['fnnew']."
								<br/>- Ok Rename Img Name 1.");
				*/
						}else{print("<br/>- No Ok Rename Img Name 1.");}

		if( file_exists($ruta.$_SESSION['myimg2b'])){
					rename($ruta.$_SESSION['myimg2b'], $ruta.$_SESSION['$nombre2n']);
			/*		print("<br/>- Ok Rename Img Name 2.");	*/
					}else{print("<br/>- No Ok Rename Img Name 2.");}
										
		if( file_exists($ruta.$_SESSION['myimg3b'])){
					rename($ruta.$_SESSION['myimg3b'], $ruta.$_SESSION['$nombre3n']);
			/*		print("<br/>- Ok Rename Img Name 3.");	*/
					}else{print("<br/>- No Ok Rename Img Name 3.");}
										
		if( file_exists($ruta.$_SESSION['myimg4b'])){
					rename($ruta.$_SESSION['myimg4b'], $ruta.$_SESSION['$nombre4n']);
			/*		print("<br/>- Ok Rename Img Name 4.");	*/
					}else{print("<br/>- No Ok Rename Img Name 4.");}

					mf1();
					
			}

	} ////

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function mf1(){
	
		global $db; 	global $db_name;
		$vn = $_SESSION['vname'];
		$img1 = $_SESSION['$nombre1n'];
		$img2 = $_SESSION['$nombre2n'];
		$img3 = $_SESSION['$nombre3n'];
		$img4 = $_SESSION['$nombre4n'];
		$fnnew = $_SESSION['fnnew'];

	$sqlfn = "UPDATE `$db_name`.$vn  SET `myimg1` = '$img1', `myimg2` = '$img2', `myimg3` =  '$img3', `myimg4` =  '$img4' WHERE $vn.`factnum` = '$fnnew'  ";
		
		if(mysqli_query($db, $sqlfn)){ //	print("<br/>* OK DB UPDATE."); 
					} else {
							print("* MODIFIQUE LA ENTRADA 1367: ".mysqli_error($db));
									global $texerror;
									$texerror = "\n\t ".mysqli_error($db);
							}
							
	}
	
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function show_form($errors=[]){

		global $db; 	global $db_name;
		
		global $sesionref; 		$sesionref = "`".$_SESSION['clave']."clientes`";
		
		if(isset($_POST['clienteingresos'])){
			$sqlx =  "SELECT * FROM $sesionref WHERE `ref` = '$_POST[clienteingresos]'";
			$qx = mysqli_query($db, $sqlx);
			$rowcliente = mysqli_fetch_assoc($qx);
			$_rsocial = @$rowcliente['rsocial'];
			$_ref = @$rowcliente['ref'];
			$_dni = @$rowcliente['dni'];
			$_ldni = @$rowcliente['ldni'];
			global $_dnil;
			$_dnil = $_dni.$_ldni;
		}

		$_SESSION['idx'] = $_POST['id'];

		if(isset($_POST['oculto2'])){
			
			$datex = $_POST['factdate'];
			$dyx = substr($_POST['factdate'],0,2);
			$dmx = substr($_POST['factdate'],3,2);
			$ddx = substr($_POST['factdate'],-2,2);

			$_SESSION['mold'] = $dmx;
			$_SESSION['dold'] = $ddx;
			$_SESSION['yold'] = $dyx;
		
			$_SESSION['myimg1b'] = $_POST['myimg1'];
			$_SESSION['myimg2b'] = $_POST['myimg2'];
			$_SESSION['myimg3b'] = $_POST['myimg3'];
			$_SESSION['myimg4b'] = $_POST['myimg4'];

			$ivae = strlen(trim($_POST['factivae']));
			$ivae = $ivae - 3;
			$ivaex = $_POST['factivae'];
			$ivae1 = substr($_POST['factivae'],0,$ivae);
			$ivae2 = substr($_POST['factivae'],-2,2);
			$_SESSION['ivae1'] = $ivae1;
			$_SESSION['ivae2'] = $ivae2;

			$rete = strlen(trim($_POST['factrete']));
			$rete = $rete - 3;
			$retex = $_POST['factrete'];
			$rete1 = substr($_POST['factrete'],0,$rete);
			$rete2 = substr($_POST['factrete'],-2,2);
			$_SESSION['rete1'] = $rete1;
			$_SESSION['rete2'] = $rete2;

			$factpvp = strlen(trim($_POST['factpvp']));
			$factpvp = $factpvp - 3;
			$factpvpx = $_POST['factpvp'];
			$factpvp1 = substr($_POST['factpvp'],0,$factpvp);
			$factpvp2 = substr($_POST['factpvp'],-2,2);
			$_SESSION['factpvp1'] = $factpvp1;
			$_SESSION['factpvp2'] = $factpvp2;
			
			$factpvptot = strlen(trim($_POST['factpvptot']));
			$factpvptot = $factpvptot - 3;
			$factpvptotx = $_POST['factpvptot'];
			$factpvptot1 = substr($_POST['factpvptot'],0,$factpvptot);
			$factpvptot2 = substr($_POST['factpvptot'],-2,2);
			$_SESSION['factpvptot1'] = $factpvptot1;
			$_SESSION['factpvptot2'] = $factpvptot2;
			
			$dnie = strlen(trim($_POST['factnif']));
			$dnie = $dnie - 1;
			$dnix = $_POST['factnif'];
			$dninx = substr($_POST['factnif'],0,$dnie);
			$dnilx = substr($_POST['factnif'],-1,1);
			$dninx = trim($dninx);
			$dnilx = trim($dnilx);
			$fil1 = "%".$dninx."%";
			$fil2 = "%".$dnilx."%";

			$_SESSION['fnold'] = $_POST['factnum'];

			$sx =  "SELECT * FROM $sesionref WHERE `dni` LIKE '$fil1' LIMIT 1 ";
			$qx = mysqli_query($db, $sx);
			$rowpv = mysqli_fetch_assoc($qx);
			$_rsocial = @$rowpv['rsocial'];
			$_ref = @$rowpv['ref'];
			$_dni = @$rowpv['dni'];
			$_ldni = @$rowpv['ldni'];
			global $_dnil; 	$_dnil = $_dni.$_ldni;
		
		$_POST['clienteingresos'] = $_POST['refcliente'];
		
				$defaults = array ( 'id' => $_POST['id'],
									'clienteingresos' => $_POST['refcliente'],
								   	'refcliente' => $_POST['refcliente'],
									'dy' => $dyx,
									'dm' => $dmx,
									'dd' => $ddx,
									'factnum' => strtoupper($_POST['factnum']),
								//	'factdate' => $_POST['factdate'],
								   	'factnom' => $_POST['factnom'],
								   	'factnif' => $_POST['factnif'],
								   	'factiva' => $_POST['factiva'],
									'factivae1' => $ivae1,	
									'factivae2' => $ivae2,	
								   	'factret' => $_POST['factret'],
									'factrete1' => $rete1,	
									'factrete2' => $rete2,	
									'factpvp1' => $factpvp1,	
									'factpvp2' => $factpvp2,	
									'factpvptot1' => $factpvptot1,	
									'factpvptot2' => $factpvptot2,	
									'coment' => $_POST['coment']);
							}

		elseif(isset($_POST['oculto'])){
			$defaults = $_POST;
		} elseif(isset($_POST['oculto1'])) {
				$defaults = array (	'id' => $_SESSION['idx'],
									'clienteingresos' => $_POST['clienteingresos'],
								   	'refcliente' => $_POST['refcliente'],
									'dy' => $_POST['dy'],
									'dm' => $_POST['dm'],
									'dd' => $_POST['dd'],
									'factnum' => strtoupper($_POST['factnum']),
								//	'factdate' => $_POST['factdate'],
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
									'coment' => $_POST['coment']);
							}

	require 'TablaIfErrors.php';
	
	require 'ArrayMesDia.php';

	////////////////////
	
	global $Titulo; 	$Titulo = "MODIFICAR INGRESO";
	global $TitValue;	$TitValue = "SELECCIONE NUEVO CLIENTE";

	print("<table align='center' style=\"margin-top:10px\">
	<tr>
		<th colspan=2'>MODIFICAR INGRESO</th>
	</tr>");

	require 'FormSelectCliente.php'; 

		if($_POST['clienteingresos'] != ''){
 
			require 'FormDatos.php';

			print("<tr>
						<td colspan='2' align='right' >
							<input type='submit' value='GRABAR INGRESO' class='botonverde' />
							<input type='hidden' name='oculto' value=1 />
					</form>														
						</td>
					</tr>
					<tr>
						<td colspan='4' align='center'>
			<a href='Ingresos_Ver.php' class='botonazul' style='color:#343434 !important' >INICIO INGRESOS</a>
			<a href='Ingresos_Crear.php' class='botonazul' style='color:#343434 !important' >CREAR INGRESO</a>
						</td>
					</tr>
				</table>");
		}

	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function info_01(){

	global $db;
	
		$filtro = "\n\tFiltro => \n\tDATE: ".$_POST['factdate'].".\n\tR. Social: ".$_POST['factnom'].".\n\tDNI: ".$_POST['factnif'].".\n\tNº FACTURA: ".$_POST['factnum'].".";

		$ActionTime = date('H:i:s');

		global $dir;
		if ($_SESSION['Nivel'] == 'admin'){ 
					$dir = "../cbj_Docs/log";
					}
	
		global $text;
		$text = "\n- INGRESO MODIFICAR SELECCIONADO ".$ActionTime.".\n\tNº FACTURA: ".$_POST['factnum'].".\n\tDATE FACTURA: ".$_POST['factdate'].".\n\tRAZON SOCIAL: ".$_POST['factnom'].".\n\tNIF: ".$_POST['factnif'].".\n\tTIPO IVA %: ".$_POST['factiva'].".\n\tIMP €: ".$_POST['factivae'].".\n\tNETO €: ".$_POST['factpvp'].".\n\tTOTAL €: ".$_POST['factpvptot'];
	
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

	function info_02(){

		global $db;
		global $factivae;
		global $factpvp;
		global $factpvptot;
		global $factdate;

		$ActionTime = date('H:i:s');

		global $dir;
		if ($_SESSION['Nivel'] == 'admin'){ 
					$dir = "../cbj_Docs/log";
					}
		
	global $text;
	$text = "\n- INGRESO MODIFICADO ".$ActionTime.".\n\tNº FACTURA: ".$_POST['factnum'].".\n\tDATE FACTURA: ".$factdate.".\n\tRAZON SOCIAL: ".$_POST['factnom'].".\n\tNIF: ".$_POST['factnif'].".\n\tTIPO IVA %: ".$_POST['factiva'].".\n\tIMP €: ".$factivae.".\n\tNETO €: ".$factpvp.".\n\tTOTAL €: ".$factpvptot;

			$logname = $_SESSION['Nombre'];	
			$logape = $_SESSION['Apellidos'];	
			$logname = trim($logname);	
			$logape = trim($logape);	
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