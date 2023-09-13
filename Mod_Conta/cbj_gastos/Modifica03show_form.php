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
								'myimg1' => $_POST['myimg1'],	
								'myimg2' => $_POST['myimg2'],	
								'myimg3' => $_POST['myimg3'],	
								'myimg4' => $_POST['myimg4'],
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
								'vname'  => $_POST['vname'],
								'delruta' => @$_POST['delruta']);
						}

		global $dyt1; 		$dyt1 = "20".$defaults['dy'];
		$_SESSION['dyt1'] = $dyt1;
		echo "* ".$dyt1."<br>";
			
		require 'TablaIfErrors.php';

		require 'ArrayMesDia.php';

		
		////////////////////
		
		global $rutaDir;		$rutaDir = @$defaults['delruta'];
		//echo "== ".$rutaDir."<br>";

		if($_POST['proveegastos'] != ''){

			global $checked;
			if(@$defaults['xl'] == 'yes') { $checked = "checked='checked'";}else{ $checked = ""; }
			global $Checkbox;
			$Checkbox = "<tr>
							<td colspan='2' style='text-align:center;' >
								".$TituloCheck." : &nbsp; 
								<input type='checkbox' name='xl' value='yes' ".$checked."/>
							</td>
						</tr>";

			//global $titulo; 		$titulo = "MARCAR COMO NO PAGADO ESTE GASTO";
			//global $titInput;		$titInput = "GUARDAR COMO GASTO PENDIENTE DE PAGO";
			global $Recupera3;		$Recupera3 = "style='display:none; visibility: hidden;'";
			global $PendienteG;		$PendienteG = "style='display:none; visibility: hidden;'";
			require 'TableBorrar.php';

		}

?>