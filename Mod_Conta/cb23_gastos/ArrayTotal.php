<?php

    global $VarArray;
    if($VarArray == 1){

		$defaults = array ( 'id' => $_POST['id'],
							'proveegastos' => $_POST['refprovee'],
							'refprovee' => $_POST['refprovee'],
							'xl' => @$_POST['xl'],
							'dy' => $dyx,
							'dm' => $dmx,
							'dd' => $ddx,
							'factnum' => strtoupper($_POST['factnum']),
							'factnumini' => strtoupper($_POST['factnumini']),
							'factdate' => $_POST['factdate'],
							'factdateini' => $_POST['factdateini'],
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
							'myimg1' => @$_POST['myimg1'],	
							'myimg2' => @$_POST['myimg2'],	
							'myimg3' => @$_POST['myimg3'],	
							'myimg4' => @$_POST['myimg4'],
							'vname'  => @$_POST['vname'],
							'factcrea' => $_POST['factcrea'],
							'factmodif' => $_POST['factmodif'],
							'delruta' => @$DelRuta /*@$_POST['delruta']*/);

    }else{ }

    if($VarArray == 2){

		// DATOS DEL FORMULARIO MODIFICAR

		$_POST['factivae1'] = $valIvaeEnt;		$_POST['factivae2'] = $valIvaeDec;
		$_POST['factrete1'] = $valReteEnt;		$_POST['factrete2'] = $valReteDec;
		$_POST['factpvptot1'] = $valToteEnt;	$_POST['factpvptot2'] = $valToteDec;
		$dyx = $_POST['dy'];	$dyt1 = $dyx;

		$defaults = array ( 'id' => $_POST['id'],
							'proveegastos' => $_POST['proveegastos'],
							'dy' => $_POST['dy'],
							'dm' => $_POST['dm'],
							'dd' => $_POST['dd'],
							'factnum' => strtoupper($_POST['factnum']),
							'factnumini' => strtoupper($_POST['factnumini']),
							'factdate' => $_POST['factdate'],
							'factdateini' => $_POST['factdateini'],
							'refprovee' => $_POST['refprovee'],
						   	'factnom' => $_POST['factnom'],
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
							'factcrea' => $_POST['factcrea'],
							'factmodif' => $_POST['factmodif']);

    }else{ }

    if($VarArray == 3){

		$defaults = array (	'id' => $_SESSION['idx'],
							'proveegastos' => $_POST['proveegastos'],
						   	'refprovee' => $_POST['refprovee'],
							'xl' => $_POST['xl'],
							'dy' => $_POST['dy'],
							'dm' => $_POST['dm'],
							'dd' => $_POST['dd'],
							'factnum' => strtoupper($_POST['factnum']),
							'factnumini' => strtoupper($_POST['factnumini']),
							'factdate' => $_POST['factdate'],
							'factdateini' => $_POST['factdateini'],
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
							'factcrea' => $_POST['factcrea'],
							'factmodif' => $_POST['factmodif'],
							'vname'  => $_POST['vname'],
							'delruta' => @$_POST['delruta']);

    }else{ }

?>