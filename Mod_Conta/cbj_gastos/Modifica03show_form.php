<?php

		global $sesionref; 		$sesionref = "`".$_SESSION['clave']."clientes`";
		
		if(isset($_POST['provegastos'])){
			$sqlx =  "SELECT * FROM $sesionref WHERE `ref` = '$_POST[proveedores]'";
			$qx = mysqli_query($db, $sqlx);
			$rowprovee = mysqli_fetch_assoc($qx);
			$_rsocial = $rowprovee['rsocial'];
			$_ref = $rowprovee['ref'];
			$_dni = $rowprovee['dni'];
			$_ldni = $rowprovee['ldni'];
			global $_dnil; 		$_dnil = $_dni.$_ldni;
		}
		
		$_SESSION['idx'] = $_POST['id'];

		global $defaults;

		if(isset($_POST['oculto2'])){
			
			$datex = $_POST['factdate'];
			$dyx = substr($_POST['factdate'],0,2);
			$dmx = substr($_POST['factdate'],3,2);
			$ddx = substr($_POST['factdate'],-2,2);

			$_SESSION['yold'] = $dyx;
			$_SESSION['mold'] = $dmx;
			$_SESSION['dold'] = $ddx;
		
			$_SESSION['myimg1'] = $_POST['myimg1'];
			$_SESSION['myimg2'] = $_POST['myimg2'];
			$_SESSION['myimg3'] = $_POST['myimg3'];
			$_SESSION['myimg4'] = $_POST['myimg4'];

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
			global $_dnil; 		$_dnil = $_dni.$_ldni;
			

			$sqlImg = "SELECT * FROM $_POST[vname] WHERE `id` = '$_POST[id]' LIMIT 1 ";
			echo "\$sqlImg = ".$sqlImg."<br>";
			$qImg = mysqli_query($db, $sqlImg);
			$rowImg = mysqli_fetch_assoc($qImg);


			$_POST['proveegastos'] = $_POST['refprovee'];
		
			$defaults = array ( 'id' => $_POST['id'],
								'proveegastos' => $_POST['refprovee'],
							   	'refprovee' => $_POST['refprovee'],
							   	'xl' => @$_POST['xl'],
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
								'coment' => $_POST['coment'],
								'myimg1' => $rowImg['myimg1'],	
								'myimg2' => $rowImg['myimg2'],	
								'myimg3' => $rowImg['myimg3'],	
								'myimg4' => $rowImg['myimg4'],
								'vname'  => $_POST['vname'],
								'delruta' => @$_POST['delruta']);

		}elseif(isset($_POST['oculto'])){
					$defaults = $_POST;
		}elseif(isset($_POST['oculto1'])){

			$defaults = array (	'id' => $_SESSION['idx'],
								'proveegastos' => $_POST['proveegastos'],
							   	'refprovee' => $_POST['refprovee'],
								'xl' => $_POST['xl'],
								'dy' => $_POST['dy'],
								'dm' => $_POST['dm'],
								'dd' => $_POST['dd'],
								'factnum' => strtoupper($_POST['factnum']),
							//	'factdate' => $_POST['factdate'],
							   	'refprovee' => $_POST['ref'],
							   	'factnom' => $_POST['rsocial'],
							   	'factnif' => $_POST['factnif'],
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
								'myimg1' => $_POST['myimg1'],	
								'myimg2' => $_POST['myimg2'],	
								'myimg3' => $_POST['myimg3'],	
								'myimg4' => $_POST['myimg4'],
								'vname'  => $_POST['vname'],
								'delruta' => @$_POST['delruta']);

		}elseif((isset($_POST['ocultoRecup']))||(isset($_POST['ocultoModif3']))){

				//echo "SOY OCULTO RECUP...<br>";
				$defaults = $_POST;

				global $valIvaeEnt;						global $valIvaeDec;
				$_POST['factivae1'] = $valIvaeEnt;		$_POST['factivae2'] = $valIvaeDec;
				$defaults['factivae1'] = $valIvaeEnt;	$defaults['factivae2'] = $valIvaeDec;

				global $valReteEnt; 					global $valReteDec;
				$_POST['factrete1'] = $valReteEnt;		$_POST['factrete2'] = $valReteDec;
				$defaults['factrete1'] = $valReteEnt;	$defaults['factrete2'] = $valReteDec;

				global $valToteEnt;						global $valToteDec;	
				$_POST['factpvptot1'] = $valToteEnt;	$_POST['factpvptot2'] = $valToteDec;
				$defaults['factpvptot1'] = $valToteEnt;	$defaults['factpvptot2'] = $valToteDec;
				//echo "\$_POST['delruta'] = ".$_POST['delruta']."<br>";

				
			}

		require 'TablaIfErrors.php';

		require 'ArrayMesDia.php';

		////////////////////
		
		global $rutaOld;	global $papeleraRecup;		global $gastoModif3;
		if($papeleraRecup == 1){
			$idx = $_SESSION['idx'];
			$vnamed = "`".$_SESSION['clave']."gastosfeed`";
			$sqlrt = "SELECT * FROM `$db_name`.$vnamed  WHERE $vnamed.`id` = '$idx' LIMIT 1 ";
			$qrt = mysqli_query($db,$sqlrt);
			$rowrt = mysqli_fetch_assoc($qrt);
		}elseif($gastoModif3 == 1){
			$rutaOld = "../cbj_Docs/docgastos_pendientes/";
			//echo "\$RutaOld = ".$rutaOld."<br>";
		}else{ }


		global $rutaDir;
		if((strlen(trim($rutaOld)))!= 0){
			$rutaDir = $rutaOld;
		}elseif((strlen(trim(@$defaults['delruta']))) != 0){
			$rutaDir = @$defaults['delruta'];
		}elseif((strlen(trim(@$_POST['delruta']))) != 0){
			$rutaDir = @$_POST['delruta'];
		}else{  }

		if($_POST['proveegastos'] != ''){

			global $checked;		global $checkedb;

			global $Checkbox;
			if(@$defaults['xl'] == 'yes'){ $checked = "checked='checked'";}else{ $checked = ""; }
			global $Checkboxb;
			if(@$defaults['xlb'] == 'yes'){ $checkedb = "checked='checked'";}else{ $checkedb = ""; }
			
			$Checkbox = "<tr>
							<td colspan='2' style='text-align:center;' >
								".$TituloCheck." : &nbsp; 
								<input type='checkbox' name='xl' value='yes' ".$checked."/>
							</td>
						</tr>";

			global $a;	$a = "20".$defaults['dy'];
			global $vnameStatus; 		$vnameStatus = "`".$_SESSION['clave']."status`";
			$sqlSTatus =  "SELECT * FROM $vnameStatus WHERE `year`='$a' LIMIT 1 ";
			echo "\$sqlSTatus = ".$sqlSTatus."<br>";
			$qStauts = mysqli_query($db, $sqlSTatus);
			$rowStatus = mysqli_fetch_assoc($qStauts);
			global $nY;		$nY = date('Y');
			global $papeleraRecup;		global $ejerStatus;

			if(($papeleraRecup == 1)||($gastoModif3 == 1)){
				if($rowStatus['stat']=='close'){
					$ejerStatus =  "<tr><td colspan=2 style='text-align:center;' >EL EJERCICIO ".$a." ESTÁ CERRADO<br>";
					if(@$defaults['delruta'] == "../cbj_Docs/docgastos_pendientes/"){
						$_SESSION['stat'] = "closePendiente";
						$ejerStatus .=  "SE RECUPERARÁ EN ".@$defaults['delruta']."</td></tr>";
					}else{
						$_SESSION['stat'] = 'close';
						$defaults['delruta'] = "../cbj_Docs/docgastos_".$nY."/";
						$_SESSION['newDy'] = substr($nY,2,2);
						$ejerStatus .=  "SE RECUPERARÁ EN ".@$defaults['delruta']."</td></tr>
						<tr>
							<td style='text-align:right;'>FECHA NUEVA</td>
							<td>20".$_SESSION['newDy']."/".date('m/d')."</td>
						</tr>";
						$Checkboxb = "<tr>
										<td colspan='2' style='text-align:center;' >
											CONFIRMO LA NUEVA RUTA Y FECHA: &nbsp; 
											<input type='checkbox' name='xlb' value='yes' ".$checkedb."/>
										</td>
									</tr>";
					}
					
				}else{
					$_SESSION['stat'] = 'open';
					$ejerStatus =  "<tr><td colspan=2 style='text-align:center;' >EL EJERCICIO ".$a." ESTÁ ABIERTO</td></tr>"; 
				}

				global $rutaDirTr;
				$rutaDirTr ="<tr>
								<td style='text-align: right !important;' >RUTA DIR</td>
								<td>".$rutaDir."</td>			
							</tr>";

			}else{ $rutaDirTr =""; }

			//global $titulo; 		$titulo = "MARCAR COMO NO PAGADO ESTE GASTO";
			//global $titInput;		$titInput = "GUARDAR COMO GASTO PENDIENTE DE PAGO";
			global $Recupera3;		$Recupera3 = "style='display:none; visibility: hidden;'";
			global $PendienteG;		$PendienteG = "style='display:none; visibility: hidden;'";
			
			//if($rowStatus['stat']==''){
			if($rowStatus['stat']=='close'){
				if($rutPend == 'Pendientes_'){
					global $Modif2;			$Modif2 = "style='display:none; visibility: hidden;'";
					global $ModImg2;		$ModImg2 = "style='display:none; visibility: hidden;'";
				}else{
					global $Modif2;			$Modif2 = "style='display:inline-block;'";
					global $ModImg2;		$ModImg2 = "style='display:inline-block;'";
				}
				//global $Borrar2;		$Borrar2= "style='display:none; visibility: hidden;'";
				//global $PendienteG;		$PendienteG = "style='display:none; visibility: hidden;'";
				//global $Recupera3;		$Recupera3 = "style='display:none; visibility: hidden;'";
			}else{ }

		global $dyt1; 		$dyt1 = "20".$defaults['dy'];
		$_SESSION['dyt1'] = "20".$defaults['dy'];

			require 'TableBorrar.php';

		}

?>