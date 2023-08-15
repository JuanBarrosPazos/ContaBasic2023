<?php

	$errors = array();

/* 	VALIDAMOS EL CAMPO my_img */

	if(isset($_POST['oculto'])){
		
	/*	CALCULAMOS LA REFERENCIA DE USUARIO	*/
	
	if (preg_match('/^(\w{1})/',$_POST['rsocial'],$ref1)){	$rf1 = $ref1[1];
															$rf1 = trim($rf1);
																			}
	if (preg_match('/^(\w{1})*(\s\w{1})/',$_POST['rsocial'],$ref2)){$rf2 = $ref2[2];
																	$rf2 = trim($rf2);
																			}
	
	global $rf;		global $rf1;	global $rf2;
	$rf = strtolower($rf1.$rf2.$_POST['dni'].$_POST['ldni']);
	$rf = trim($rf);
			
	/////////////////

	global $db; 		global $db_name; 		global $vname;
	global $sqldni; 	global $qdni;
			
	if($_POST['v']=='g'){
		$vname = "`".$_SESSION['clave']."proveedores`";
	} elseif($_POST['v']=='i'){
		$vname = "`".$_SESSION['clave']."clientes`";
	}

		$prove =  "SELECT * FROM `$db_name`.$vname WHERE `ref` = '$rf'";
		$qprove = mysqli_query($db, $prove);
		$cprove = mysqli_num_rows($qprove);
		$rowdni = mysqli_fetch_assoc($qprove);

	if(isset($_POST['id'])){
		if($_POST['id'] == $rowdni['id']){}
		elseif($cprove > 0){$errors [] = "EL PROVEEDOR <font color='#FF0000'> YA EXISTE ".$rf.".</font>";}
	} else { }
	

			///////////////////////////////////////////////////////////////////////////////////
			///////////////////////////////////////////////////////////////////////////////////

	if($_FILES['myimg']['size'] == 0){}
	
	else{
			
	$limite = 500 * 1024;
	
	$ext_permitidas = array('jpg','JPG','gif','GIF','png','PNG','bmp','BMP');
	$extension = substr($_FILES['myimg']['name'],-3);
	// print($extension);
	// $extension = end(explode('.', $_FILES['myimg']['name']) );
	$ext_correcta = in_array($extension, $ext_permitidas);

	// $tipo_correcto = preg_match('/^image\/(gif|png|jpg|bmp)$/', $_FILES['myimg']['type']);

/*		if($_FILES['myimg']['size'] == 0){
			$errors [] = "Ha de seleccionar una fotograf&iacute;a.";
			global $img2;
			$img2 = 'untitled.png';
		}
		 
		else*/if(!$ext_correcta){
			$errors [] = "La extension no esta admitida: ".$_FILES['myimg']['name'];
			global $img2;
			$img2 = 'untitled.png';
			}
	/*
		elseif(!$tipo_correcto){
			$errors [] = "Este tipo de archivo no esta admitido: ".$_FILES['myimg']['name'];
			global $img2;
			$img2 = 'untitled.png';
			}
	*/
		elseif ($_FILES['myimg']['size'] > $limite){
		$tamanho = $_FILES['myimg']['size'] / 1024;
		$errors [] = "El archivo".$_FILES['myimg']['name']." es mayor de 500 KBytes. ".$tamanho." KB";
		global $img2;
		$img2 = 'untitled.png';
			}
		
			elseif ($_FILES['myimg']['error'] == UPLOAD_ERR_PARTIAL){
				$errors [] = "La carga del archivo se ha interrumpido.";
				global $img2;
				$img2 = 'untitled.png';
				}
				
				elseif ($_FILES['myimg']['error'] == UPLOAD_ERR_NO_FILE){
					$errors [] = "Es archivo no se ha cargado.";
					global $img2;
					$img2 = 'untitled.png';
					}
		}
	}

			///////////////////////////////////////////////////////////////////////////////////
			///////////////////////////////////////////////////////////////////////////////////

	/* VALIDAMOS EL CAMPO RAZON SOCIAL. */
	
	if(isset($_POST['id'] )){
		if($_POST['id'] == @$rowdni['id']){}
		elseif(@$cprove > 0){$errors [] = " RAZON SOCIAL <font color='#FF0000'>YA EXISTE ".$_POST['rsocial']."</font>";}
	} else { }
	
	if(strlen(trim($_POST['rsocial'])) == 0){
		$errors [] = "R. SOCIAL <font color='#FF0000'>Este campo es obligatorio.</font>";
		}
	
	elseif (strlen(trim($_POST['rsocial'])) < 2){
		$errors [] = "R. SOCIAL <font color='#FF0000'>Escriba más de 2 carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^@´`\'áéíóú#$%<>:"·\_(\)=¿?!¡\[\]\{\};,:\.\*]+$/',$_POST['rsocial'])){
		$errors [] = "R. SOCIAL <font color='#FF0000'>Caracteres no validos. Se permite espacio blanco</font>";
		}
		

			///////////////////////////////////////////////////////////////////////////////////
			///////////////////////////////////////////////////////////////////////////////////

	/* VALIDAMOS EL CAMPO  NUMERO DNI/NIF */
	global $db;		global $db_name;		global $vname;

	if($_POST['v']=='g'){
		$vname = "`".$_SESSION['clave']."proveedores`";
	} elseif($_POST['v']=='i'){
		$vname = "`".$_SESSION['clave']."clientes`";
	}

	$sqldni =  "SELECT * FROM `$db_name`.$vname WHERE $vname.`dni` = '$_POST[dni]'";
	$qdni = mysqli_query($db, $sqldni);
	$rowdni = mysqli_fetch_assoc($qdni);
	$count = mysqli_num_rows($qdni);

	if(isset($_POST['id'] )){ 
		if($_POST['id'] == $rowdni['id']){}
		elseif(mysqli_num_rows($qdni)!= 0){ 
			$errors [] = "N&uacute;mero DNI/NIF: <font color='#FF0000'>Ya Existe.</font>"; 
		}
	}
	
	if($_POST['doc'] == 'DNI') {
		if(strlen(trim($_POST['dni'])) == 0){
		$errors [] = "N&uacute;mero DNI/NIF: <font color='#FF0000'>Campo Obligatorio.</font>";
		} elseif (!preg_match('/^[\d]+$/',$_POST['dni'])){
			$errors [] = "N&uacute;mero DNI/NIF: <font color='#FF0000'>Sólo Números.</font>";
		} elseif (strlen(trim($_POST['dni'])) < 8){
			$errors [] = "N&uacute;mero DNI/NIF: <font color='#FF0000'>Más de 7 Carácteres.</font>";
			}
	}
	
	/* VALIDAMOS EL CAMPO  
							NUMERO NIE/NIF  XYZ - 
							NIF ESPECIAL KLM - 
							NIF PERSONAS JURIDICAS Y ENTIDADES EN GENERAL 
	*/

	/* VALIDACION COMUN A TODAS LAS OPCIONES */
	
	if (($_POST['doc'] == 'NIE') || ($_POST['doc'] == 'NIFespecial') || ($_POST['doc'] == 'NIFsa') || ($_POST['doc'] == 'NIFsrl') || ($_POST['doc'] == 'NIFscol') || ($_POST['doc'] == 'NIFscom') || ($_POST['doc'] == 'NIFcbhy') || ($_POST['doc'] == 'NIFscoop') || ($_POST['doc'] == 'NIFasoc') || ($_POST['doc'] == 'NIFcpph') || ($_POST['doc'] == 'NIFsccspj') || ($_POST['doc'] == 'NIFee') || ($_POST['doc'] == 'NIFcl') || ($_POST['doc'] == 'NIFop') || ($_POST['doc'] == 'NIFcir') || ($_POST['doc'] == 'NIFoaeca') || ($_POST['doc'] == 'NIFute') || ($_POST['doc'] == 'NIFotnd') || ($_POST['doc'] == 'NIFepenr')) {

		if(strlen(trim($_POST['dni'])) == 0){
		$errors [] = "N&uacute;mero NIE/NIF: <font color='#FF0000'>Campo obligatorio.</font>";
		}

	elseif (strlen(trim($_POST['dni'])) < 8){
		$errors [] = "N&uacute;mero NIE/NIF: <font color='#FF0000'>Más de 7 carácteres.</font>";
		}
		
	elseif (!preg_match('/\b[a-zA-Z]/',$_POST['dni'])){
		$errors [] = "N&uacute;mero NIE/NIF: <font color='#FF0000'>Falta la Letra</font>";
		}
		
	elseif (!preg_match('/^[^@´`\'áéíóú#$&%<>:"·\(\)=¿?!¡\[\]\{\};,\/:\.\*]+$/',$_POST['dni'])){
		$errors [] = "N&uacute;mero NIE/NIF: <font color='#FF0000'>Sin caracteres especiales</font>";
		}

	elseif (!preg_match('/^[^a-z]+$/',$_POST['dni'])){
		$errors [] = "N&uacute;mero NIE/NIF: <font color='#FF0000'>Solo mayusculas</font>";
		}
		
	
	/* SE VALIDAN LAS LETRAS DEL CAMPO NUMERO NIE/NIF */	
		
	elseif($_POST['doc'] == 'NIE') {
		
		if (preg_match('/^[^XYZ]+$/',$_POST['dni'])){	// SOLO SE ADMINTE XYZ //
		$errors [] = "N&uacute;mero NIE/NIF: <font color='#FF0000'>Letra Invalida Solo X,Y,Z.</font>";
		}
			}
					
	elseif($_POST['doc'] == 'NIFespecial') {	// SOLO SE ADMINTE KLM //
		
		if(preg_match('/^[^KLM]+$/',$_POST['dni'])){
	$errors [] = "N&uacute;mero NIF Especial: <font color='#FF0000'>Letra Invalida Solo K,L,M.</font>";
		}
			}
			
	elseif($_POST['doc'] == 'NIFsa') {	// SOLO SE ADMITE A //
		
		if(preg_match('/^[^A]+$/',$_POST['dni'])){
	$errors [] = "N&uacute;mero NIF Sociedad An&oacute;nima: <font color='#FF0000'>Letra Invalida Solo A.  </font>";
		}
			}
			
	elseif($_POST['doc'] == 'NIFsrl') {	// SOLO SE ADMITE B //
		
		if(preg_match('/^[^B]+$/',$_POST['dni'])){
	$errors [] = "N&uacute;mero NIF Sociedad Respons Limitada: <font color='#FF0000'>Letra Invalida Solo B.</font>";
		}
			}
		
	elseif($_POST['doc'] == 'NIFscol') {	// SOLO SE ADMITE C //
		
		if(preg_match('/^[^C]+$/',$_POST['dni'])){
	$errors [] = "N&uacute;mero NIF Sociedad Colectiva: <font color='#FF0000'>Letra Invalida Solo C.</font>";
		}
			}
			
	elseif($_POST['doc'] == 'NIFscom') {	// SOLO SE ADMITE D //
		
		if(preg_match('/^[^D]+$/',$_POST['dni'])){
	$errors [] = "N&uacute;mero NIF Sociedad Comanditaria: <font color='#FF0000'>Letra Invalida Solo D.</font>";
		}
			}
			
	elseif($_POST['doc'] == 'NIFcbhy') {	// SOLO SE ADMITE E //
		
		if(preg_match('/^[^E]+$/',$_POST['dni'])){
	$errors [] = "N&uacute;mero NIF Comunidad Bienes y Herencias Yacentes: <font color='#FF0000'>Letra Invalida Solo E.</font>";
		}
			}
			
	elseif($_POST['doc'] == 'NIFscoop') {	// SOLO SE ADMITE F //
		
		if (preg_match('/^[^F]+$/',$_POST['dni'])){
	$errors [] = "N&uacute;mero NIF Sociedades Cooperativas: <font color='#FF0000'>Letra Invalida Solo F.</font>";
		}
			}
			
	elseif($_POST['doc'] == 'NIFasoc') {	// SOLO SE ADMITE G //
		
		if(preg_match('/^[^G]+$/',$_POST['dni'])){
	$errors [] = "N&uacute;mero NIF Asociaciones: <font color='#FF0000'>Letra Invalida Solo G.</font>";
		}
			}
			
	elseif($_POST['doc'] == 'NIFcpph') {	// SOLO SE ADMITE H //
		
		if(preg_match('/^[^H]+$/',$_POST['dni'])){
	$errors [] = "N&uacute;mero NIF Comunidad Propietarios Propiedad Horizontal: <font color='#FF0000'>Letra Invalida Solo H.</font>";
		}
			}
			
	elseif($_POST['doc'] == 'NIFsccspj') {	// SOLO SE ADMITE J //
		
		if(preg_match('/^[^J]+$/',$_POST['dni'])){
	$errors [] = "N&uacute;mero NIF Sociedad Civil, con o sin Personalidad Juridica: <font color='#FF0000'>Letra Invalida Solo J.</font>";
		}
			}
			
	elseif($_POST['doc'] == 'NIFee') {	// SOLO SE ADMITE N //
		
		if(preg_match('/^[^N]+$/',$_POST['dni'])){
		$errors [] = "N&uacute;mero NIF Entidad Extranjera: <font color='#FF0000'>Letra Invalida Solo N.</font>";
		}
			}
			
	elseif($_POST['doc'] == 'NIFcl') {	// SOLO SE ADMITE P //
		
		if(preg_match('/^[^P]+$/',$_POST['dni'])){
		$errors [] = "N&uacute;mero NIF Corporación Local: <font color='#FF0000'>Letra Invalida Solo P.</font>";
		}
			}
			
	elseif($_POST['doc'] == 'NIFop') {	// SOLO SE ADMITE Q //
		
		if(preg_match('/^[^Q]+$/',$_POST['dni'])){
		$errors [] = "N&uacute;mero NIF Organismo Publico: <font color='#FF0000'>Letra Invalida Solo Q.</font>";
		}
			}
			
	elseif($_POST['doc'] == 'NIFcir') {	// SOLO SE ADMITE R //
		
		if(preg_match('/^[^R]+$/',$_POST['dni'])){
		$errors [] = "N&uacute;mero NIF Congregaciones Instituciones Religiosas: <font color='#FF0000'>Letra Invalida Solo R.</font>";
		}
			}
			
	elseif($_POST['doc'] == 'NIFoaeca') {	// SOLO SE ADMITE S //
		
		if(preg_match('/^[^S]+$/',$_POST['dni'])){
		$errors [] = "N&uacute;mero NIF Organos Admin Estado y Comunidades Autónomas: <font color='#FF0000'>Letra Invalida Solo S.</font>";
		}
			}
		
	elseif($_POST['doc'] == 'NIFute') {	// SOLO SE ADMITE U //
		
		if(preg_match('/^[^U]+$/',$_POST['dni'])){
		$errors [] = "N&uacute;mero NIF Unión Temporal de Empresas: <font color='#FF0000'>Letra Invalida Solo U.</font>";
		}
			}
		
	elseif($_POST['doc'] == 'NIFotnd') {	// SOLO SE ADMITE V //
		
		if(preg_match('/^[^V]+$/',$_POST['dni'])){
		$errors [] = "N&uacute;mero NIF Otros Tipos no Definidos: <font color='#FF0000'>Letra Invalida Solo V.</font>";
		}
			}
		
	elseif($_POST['doc'] == 'NIFepenr') {	// SOLO SE ADMITE W //
		
		if(preg_match('/^[^W]+$/',$_POST['dni'])){
		$errors [] = "N&uacute;mero NIF Establecimientos Permanentes Entidades no Residentes: <font color='#FF0000'>Letra Invalida Solo W.</font>";
		}
			}
		
			} /* FIN PRIMER CONDICIONAL IF DEL CAMPO NUMERO */
	
			///////////////////////////////////////////////////////////////////////////////////
			///////////////////////////////////////////////////////////////////////////////////
			///////////////////////////////////////////////////////////////////////////////////
			///////////////////////////////////////////////////////////////////////////////////


	/* VALIDAMOS LA LETRA DE CONTROL DEL DNI */

			/* DEFINO EL ALGORITMO PARA EL CALCULO DE LA LETRA CONTROL DEL DNI */
		
						$letras = 'TRWAGMYFPDXBNJZSQVHLCKE';
						$dni = $_POST['dni'];
						$indice = intval($_POST['dni'])%23;
						$letra = $letras[$indice];
	
			/* FIN DEL ALGORITMO DE DEFINICION DEL LA LETRA CONTROL DEL DNI */
	
	
	if($_POST['doc'] == 'DNI') {
		
		if(strlen(trim($_POST['ldni'])) == 0){
		$errors [] = "Letra DNI: <font color='#FF0000'>Campo obligatorio.</font>";
		}

	elseif(!preg_match('/^[^0-9@#$&%<>:"·\(\)=¿?!¡\[\]\{\};,:\.\*]+$/',$_POST['ldni'])){
		$errors [] = "Letra Control DNI: <font color='#FF0000'>Solo texto</font>";
		}

	elseif(!preg_match('/^[^a-z]+$/',$_POST['ldni'])){
		$errors [] = "Letra Control DNI: <font color='#FF0000'>Solo mayusculas</font>";
		}

	elseif(trim($_POST['ldni'] != $letra)){
	$errors [] = "Letra Control DNI: <font color='#FF0000'>Letra no correcta. $letra is ok.</font>";
		}
	}
	
			///////////////////////////////////////////////////////////////////////////////////
			///////////////////////////////////////////////////////////////////////////////////
			///////////////////////////////////////////////////////////////////////////////////
			///////////////////////////////////////////////////////////////////////////////////


	/* VALIDAMOS LA LETRA DE CONTROL DE NIE EXTRANJEROS NORMAL Y ESPECIALES */
	
		/* DEFINO DEL ALGORITMO PARA EL CALCULO DE LA LETRA CONTROL DEL NIE NORMAL */

		// Si es un NIE hay que cambiar la primera letra por 0, 1 ó 2 dependiendo de si es X, Y o Z.
					$dni2 = $_POST['dni'];
					$dni2 = strtoupper($dni2);
				 
					$letra2 = substr($dni2, -1, 1);
					$numero = substr($dni2, 0, 8);
 
		// Si es un NIE hay que cambiar la primera letra por 0, 1 ó 2 dependiendo de si es X, Y o Z.
	
					$numero = str_replace(array('X', 'Y', 'Z'), array(0, 1, 2), $numero);	
				 
					$modulo = (int) $numero % 23;
					$letras_validas = "TRWAGMYFPDXBNJZSQVHLCKE";
					$letra2 = substr($letras_validas, $modulo, 1);
		//	print ("ESTA ES LA LETRA NIE $letra2 </br>");
	
		/* FIN DE LA FUNCION PARA EL CALCULO DE LA LETRA CONTROL DEL NIE NORMAL */


		/* DEFINO EL ALGORITMO PARA EL CALCULO DE LA LETRA CONTROL DEL NIE/NIF ESPECIAL */

		global $num1;	global $num2;	global $num3;	global $num4;
		global $num5;	global $num6;	global $num7;

		if(strlen(trim($_POST['dni'])) == 0){ }
		else {	$dni3 = $_POST['dni'];
			
				$num1 = $dni3[1];
				$num2 = $dni3[2];
				$num3 = $dni3[3];
				$num4 = $dni3[4];
				$num5 = $dni3[5];
				$num6 = $dni3[6];
				$num7 = $dni3[7];
			}
			
			$sumaa = $num2 + $num4 + $num6 ;
			// print ("LA SUMA A: $num2 + $num4 + $num6 = $sumaa </br>");
			
			$sumab1 = $num1 * 2;
			$sumab1 = "$sumab1";
			if ($sumab1 < 10){ 	$sumab1st = "0$sumab1";
								$sumab1tot = ($sumab1st[0] + $sumab1st[1]);
														}
								elseif ($sumab1 > 9) { 	$sumab1st = "$sumab1";
														$sumab1tot = ($sumab1st[0] + $sumab1st[1]);}
			$sumab3 = $num3 * 2;
			$sumab3 = "$sumab3";
			if ($sumab3 < 10){ 	$sumab3st = "0$sumab3";
								$sumab3tot = ($sumab3st[0] + $sumab3st[1]);
														}
								elseif ($sumab3 > 9) { 	$sumab3st = "$sumab3";
														$sumab3tot = ($sumab3st[0] + $sumab3st[1]);}
			$sumab5 = $num5 * 2;
			$sumab5 = "$sumab5";
			if ($sumab5 < 10){ 	$sumab5st = "0$sumab5";
								$sumab5tot = ($sumab5st[0] + $sumab5st[1]);
														}
								elseif ($sumab5 > 9) { 	$sumab5st = "$sumab5";
														$sumab5tot = ($sumab5st[0] + $sumab5st[1]);}
			$sumab7 = $num7 * 2;
			$sumab7 = "$sumab7";
			if ($sumab7 < 10){ 	$sumab7st = "0$sumab7";
								$sumab7tot = ($sumab7st[0] + $sumab7st[1]);
														}
								elseif ($sumab7 > 9) { 	$sumab7st = "$sumab7";
														$sumab7tot = ($sumab7st[0] + $sumab7st[1]);}
			
			$sumab = $sumab1tot + $sumab3tot + $sumab5tot + $sumab7tot;
			
			/* 
			print ("LA SUMA B: ( $num1 x 2 = $sumab1 => $sumab1st[0] + $sumab1st[1] = $sumab1tot ) + ( $num3 x 2 = $sumab3 => $sumab3st[0] + $sumab3st[1] = $sumab3tot ) + ( $num5 x 2 = $sumab5 => $sumab5st[0] + $sumab5st[1] = $sumab5tot ) + ( $num7 x 2 = $sumab7 => $sumab7st[0] + $sumab7st[1] = $sumab7tot ) = ($sumab1tot + $sumab3tot + $sumab5tot + $sumab7tot) =$sumab </br>");
			*/
			
			$sumatot = $sumaa + $sumab;
			// print ("SUMA A $sumaa + SUMA B $sumab = SUMA TOTAL $sumatot </br>");
			
			$sumatotc = $sumatot;
			
			if (@$sumatotc[1] == 0) {	$sumacont = 0;
										// print ("TOTAL SUMA CONTROL = $sumacont </br>");
													}
													
				else {	$sumacont = 10 - $sumatotc[1];
								// print ("TOTAL SUMA CONTROL = 10 - $sumatotc[1] = $sumacont </br>");
														}
														
			$nifcontrolnumero = "0123456789";
			$nifcontrolletra = "JABCDEFGHI";
			 
			$nifnumero = $nifcontrolnumero[$sumacont];
			$nifletra = $nifcontrolletra[$sumacont];
			
			// print ("NUMERO: $nifnumero </br>");
			// print ("LETRA: $nifletra </br>");


		/* FIN DEL LA FUNCION PARA EL CALCULO DE LA LETRA CONTROL DEL NIE/NIF ESPECIAL */


		/* CONDICIONAL PARA TODOS LOS NIE/NIF */
		
	if (($_POST['doc'] == 'NIE') || ($_POST['doc'] == 'NIFespecial') || ($_POST['doc'] == 'NIFsa') || ($_POST['doc'] == 'NIFsrl') || ($_POST['doc'] == 'NIFscol') || ($_POST['doc'] == 'NIFscom') || ($_POST['doc'] == 'NIFcbhy') || ($_POST['doc'] == 'NIFscoop') || ($_POST['doc'] == 'NIFasoc') || ($_POST['doc'] == 'NIFcpph') || ($_POST['doc'] == 'NIFsccspj') || ($_POST['doc'] == 'NIFee') || ($_POST['doc'] == 'NIFcl') || ($_POST['doc'] == 'NIFop') || ($_POST['doc'] == 'NIFcir') || ($_POST['doc'] == 'NIFoaeca') || ($_POST['doc'] == 'NIFute') || ($_POST['doc'] == 'NIFotnd') || ($_POST['doc'] == 'NIFepenr')) 
	
	{
		if(strlen(trim($_POST['ldni'])) == 0){
		$errors [] = "Letra Control NIE/NIF: <font color='#FF0000'>Campo obligatorio.</font>";
		}
		

		/* CONDICIONAL PARA TODOS LOS NIE/NIF CON LETRA DE CONTROL */
		
	elseif(($_POST['doc'] == 'NIE') || ($_POST['doc'] == 'NIFespecial') || ($_POST['doc'] == 'NIFee') || ($_POST['doc'] == 'NIFcl') || ($_POST['doc'] == 'NIFop') || ($_POST['doc'] == 'NIFcir') || ($_POST['doc'] == 'NIFoaeca') || ($_POST['doc'] == 'NIFepenr'))
	
	{		
		if (!preg_match('/^[^0-9@#$&%<>:"·\(\)=¿?!¡\[\]\{\};,:\.\*]+$/',$_POST['ldni'])){
		$errors [] = "Letra Control NIE/NIF: <font color='#FF0000'>Solo texto.</font>";
		}
		
	elseif (!preg_match('/^[^a-z]+$/',$_POST['ldni'])){
		$errors [] = "Letra Control NIE/NIF: <font color='#FF0000'>Solo mayusculas.</font>";
		}
		
		
		/* CONDICIONAL PARA VALIDAR LA LETRA CONTROL DEL NIE/NIF NORMAL*/
		
	elseif($_POST['doc'] == 'NIE') {
		
		if(trim($_POST['ldni'] != $letra2)){
	$errors [] = "Letra Control NIE Extranjeros: <font color='#FF0000'>Letra no correcta.</font>";
		}

	}
		
			
		/* CONDICIONAL PARA VALIDAR LA LETRA CONTROL DEL NIF ESPECIAL Y OTROS CON LETRA */
		
	elseif (($_POST['doc'] == 'NIFespecial') || ($_POST['doc'] == 'NIFee') || ($_POST['doc'] == 'NIFcl') || ($_POST['doc'] == 'NIFop') || ($_POST['doc'] == 'NIFcir') || ($_POST['doc'] == 'NIFoaeca') || ($_POST['doc'] == 'NIFepenr')) {
		
		if (trim($_POST['ldni'] != $nifletra)){
	$errors [] = "Letra Control NIF Especial: <font color='#FF0000'>Letra no correcta.</font>";
		}

	}
		
				} 		/* FIN CONDICIONAL PARA TODOS LOS NIE/NIF CON LETRA DE CONTROL */
				
				
		/* CONDICIONAL PARA TODOS LOS NIF CON NUMERO DE CONTROL */
		
	elseif (($_POST['doc'] == 'NIFsa') || ($_POST['doc'] == 'NIFsrl') || ($_POST['doc'] == 'NIFscol') || ($_POST['doc'] == 'NIFscom') || ($_POST['doc'] == 'NIFcbhy') || ($_POST['doc'] == 'NIFscoop') || ($_POST['doc'] == 'NIFasoc') || ($_POST['doc'] == 'NIFcpph') || ($_POST['doc'] == 'NIFsccspj') || ($_POST['doc'] == 'NIFute') || ($_POST['doc'] == 'NIFotnd')) {
		
		if (!preg_match('/^[\d]+$/',$_POST['ldni'])){
		$errors [] = "Numero Control NIF Especial : <font color='#FF0000'>Sólo números.</font>";
		}
		
			/* CONDICIONAL PARA VALIDAR EL NUMERO DE CONTROL */
		
	else {
		
		if (trim($_POST['ldni'] != $nifnumero)){
	$errors [] = "Numero Control NIF Especial: <font color='#FF0000'>Numero incorrecto.</font>";
		}

	}
			} 		/* fIN CONDICIONAL PARA TODOS LOS NIF CON NUMERO DE CONTROL */

			} /* FIN PRIMER IF */
		
	
			///////////////////////////////////////////////////////////////////////////////////
			///////////////////////////////////////////////////////////////////////////////////
			///////////////////////////////////////////////////////////////////////////////////
			///////////////////////////////////////////////////////////////////////////////////

	
	/* Validamos el campo mail. */
	
	global $db; 		global $sqlml;
	global $qml; 		global $db_name;

	$sqlml =  "SELECT * FROM `$db_name`.$vname WHERE $vname.`Email` = '$_POST[Email]'";
	$qml = mysqli_query($db, $sqlml);
	$rowml = mysqli_fetch_assoc($qml);

	if((isset($_POST['id']))&&($_POST['Email']!="")){
		if($_POST['id'] == $rowml['id']){}
		elseif(mysqli_num_rows($qml)!= 0){
			$errors [] = "Mail: <font color='#FF0000'>YA EXISTE.</font>";
			}
	} else { }
		
	if(strlen(trim($_POST['Email']) > 0)){
	/*if(strlen(trim($_POST['Email'])) == 0){
		$errors [] = "Mail: <font color='#FF0000'>Este campo es obligatorio.</font>";
		}
	
	else*/if (strlen(trim($_POST['Email'])) < 5 ){
		$errors [] = "Mail: <font color='#FF0000'>Escriba más de cinco carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^A-Z]+$/',$_POST['Email'])){
		$errors [] = "Mail: <font color='#FF0000'>Solo Minusculas</font>";
		}

	elseif (!preg_match('/^[^@´`\'áéíóú#$&%<>:"·\(\)=¿?!¡\[\]\{\};,:\*\s]+@([-a-z0-9]+\.)+[a-z]{2,}$/',$_POST['Email'])){
		$errors [] = "Mail: <font color='#FF0000'>Esta dirección no es válida.</font>";
		}
		
	/* 
	if(trim($_POST['id'] == $rowd['id'])&&(!strcasecmp($_POST['Email'] , $rowd['Email']))){}
			elseif(!strcasecmp($_POST['Email'] , $rowd['Email'])){
				$errors [] = "Mail: <font color='#FF0000'>No se puede registrar con este Mail.</font>";
				}	
	
	elseif(!strcasecmp($_POST['Email'] , $rowd['Email'])){
		$errors [] = "Mail: <font color='#FF0000'>No se puede registrar con este Mail.</font>";
		}	
	*/
	} // FIN ISSET MAIL
	
	/* Validamos el campo Dirección. */
	
	if(strlen(trim($_POST['Direccion'])) == 0){
		$errors [] = "Dirección: <font color='#FF0000'>Este campo es obligatorio.</font>";
		}
	
	elseif (!preg_match('/^\b[^@#$%&<>\?\[\]\{\}\+]+$/',$_POST['Direccion'])){
		$errors [] = "Dirección: <font color='#FF0000'>No se admiten carácteres especiales.</font>";
		}
		
	/* Validamos el campo Tlf1 */
	
	$sqltlf1 = "SELECT * FROM `$db_name`.$vname WHERE $vname.`Tlf1` = '$_POST[Tlf1]' OR $vname.`Tlf2` = '$_POST[Tlf1]' ";
	$qtlf1 = mysqli_query($db, $sqltlf1);
	$rowtlf1 = mysqli_fetch_assoc($qtlf1);
	$countlf1 = mysqli_num_rows($qtlf1);

	if((isset($_POST['id']))&&($_POST['Tlf1']!='000000000')){
		if($_POST['id'] == $rowtlf1['id']){}
		elseif($countlf1 != 0){
			$errors [] = "Teléfono 1: <font color='#FF0000'>YA EXISTE.</font>";
			}
	}

	if(strlen(trim($_POST['Tlf1'])) == 0){
		$errors [] = "Teléfono 1: <font color='#FF0000'>Este campo es obligatorio.</font>";
		}
	
	elseif ((trim($_POST['Tlf1'])) == (trim($_POST['Tlf2']))){
				$errors [] = "Teléfono 1 y 2: <font color='#FF0000'>SON IGUALES</font>";
	}
	elseif (!preg_match('/^[\d]+$/',$_POST['Tlf1'])){
		$errors [] = "Teléfono 1: <font color='#FF0000'>Sólo se admiten números.</font>";
		}

	elseif (strlen(trim($_POST['Tlf1'])) < 9){
		$errors [] = "Teléfono 1: <font color='#FF0000'>No menos de nueve números</font>";
		}
		
	/* Validamos el campo Tlf2 */
	

	if((strlen(trim($_POST['Tlf2'])) > 0)&&($_POST['Tlf2']!='000000000')){

	$sqltlf2 =  "SELECT * FROM `$db_name`.$vname WHERE $vname.`Tlf1` = '$_POST[Tlf2]' OR $vname.`Tlf2` = '$_POST[Tlf2]'";
	$qtlf2 = mysqli_query($db, $sqltlf2);
	$rowtlf2 = mysqli_fetch_assoc($qtlf2);
	$countlf2 = mysqli_num_rows($qtlf2);
		
	if($_POST['id'] == $rowtlf2['id']){}
		elseif($countlf2 > 0){
		$errors [] = "Teléfono 2: <font color='#FF0000'>YA EXISTE.</font>";
			}
				
	elseif (!preg_match('/^[\d]+$/',$_POST['Tlf2'])){
		$errors [] = "Teléfono 2: <font color='#FF0000'>Sólo se admiten números.</font>";
			}
		
	elseif (strlen(trim($_POST['Tlf2'])) < 9){
		$errors [] = "Teléfono 2: <font color='#FF0000'>No menos de nueve números</font>";
			}

	}

?>