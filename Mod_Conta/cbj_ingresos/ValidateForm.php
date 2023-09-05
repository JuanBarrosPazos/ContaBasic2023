<?php

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	require 'FormatNumber.php'; 

	global $civae;
	$civae = $factpvp * ($fiva / 100);
	$civae = floatval($civae);
    $civae = number_format($civae,2,".","");
	//$civae = number_format($civae,2,".","");
    //echo "*** ".$civae."<br>";

	if(trim($factivae) != trim($civae)){
		$errors [] = "IMPUESTOS € <font color='#FF0000'>CANTIDAD CORRECTA => </font> ".$civae." €";
	}
	
	$fret = $_POST['factret'];

	$crete = $factpvp * ($fret / 100);
	$crete = floatval($crete);
	$crete = number_format($crete,2,".","");
	if(trim($factrete) != trim($crete)){
		$errors [] = "RETENCIONES € <font color='#FF0000'>CANTIDAD CORRECTA => </font> ".$crete." €";
	}
	
	$cftot = ($factpvp + $civae) + $factrete;
	$cftot = floatval($cftot);
	$cftot = number_format($cftot,2,".","");
	if(trim($factpvptot) != trim($cftot)){
			$errors [] = "TOTAL € <font color='#FF0000'>CANTIDAD CORRECTA => </font> ".$cftot." €";
	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
        
     // VALIDO EL CAMPO dy & dm & dd 
		 
	if(trim($_POST['dy']) == ''){
		$errors [] = "YEAR <font color='#FF0000'>Campo obligatorio.</font>";
		}
	
	if(trim($_POST['dm']) == ''){
		$errors [] = "MONTH <font color='#FF0000'>Campo obligatorio.</font>";
		}
	
	if(trim($_POST['dd']) == ''){
		$errors [] = "DAY <font color='#FF0000'>Campo obligatorio.</font>";
		}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
    // VALIDO NUMERO DE FACTURA
	if(strlen(trim($_POST['factnum'])) == 0){
		$errors [] = "FACTURA NUMERO <font color='#FF0000'>Campo obligatorio.</font>";
		}
	
	elseif (strlen(trim($_POST['factnum'])) < 5){
		$errors [] = "FACTURA NUMERO <font color='#FF0000'>Más de 4 carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^@´`\'áéíóú#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\.\*\']+$/',$_POST['factnum'])){
		$errors [] = "FACTURA NUMERO <font color='#FF0000'>Caracteres no válidos.</font>";
		}
		
	elseif (!preg_match('/^[a-zA-Z,0-9_\s]+$/',$_POST['factnum'])){
		$errors [] = "FACTURA NUMERO <font color='#FF0000'>Solo letras o números sin acentos.</font>";
		}

	elseif (!preg_match('/^[A-Z,0-9_\s]+$/',$_POST['factnum'])){
$errors [] = "FACTURA NUMERO <font color='#FF0000'>Solo mayusculas, números sin acentos 0 _.</font>";
		}

    /*
	if(strlen(trim($_POST['factdate'])) == 0){
		$errors [] = "FECHA <font color='#FF0000'>Campo obligatorio.</font>";
		}
	
	elseif (strlen(trim($_POST['factdate'])) < 5){
		$errors [] = "FECHA <font color='#FF0000'>Más de 4 carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^@´`\'áéíóú#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\.\*\']+$/',$_POST['factdate'])){
		$errors [] = "FECHA <font color='#FF0000'>Caracteres no válidos.</font>";
		}
	elseif (!preg_match('/^[a-zA-Z,0-9\s]+$/',$_POST['factdate'])){
		$errors [] = "FECHA <font color='#FF0000'>Solo letras o números sin acentos.</font>";
		}
    */

	 // VALIDO EL CAMPO factnom RAZON SOCIAL
	
	if(strlen(trim($_POST['factnom'])) == 0){
		$errors [] = "RAZON SOCIAL <font color='#FF0000'>Campo obligatorio.</font>";
		}
	
	elseif (strlen(trim($_POST['factnom'])) < 4){
		$errors [] = "RAZON SOCIAL <font color='#FF0000'>Más de 3 carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^@´`\'áéíóú#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\.\*\']+$/',$_POST['factnom'])){
		$errors [] = "RAZON SOCIAL <font color='#FF0000'>Caracteres no válidos.</font>";
		}
		
	elseif (!preg_match('/^[a-zA-Z,0-9_\s]+$/',$_POST['factnom'])){
		$errors [] = "RAZON SOCIAL <font color='#FF0000'>Solo letras, números sin acentos o _.</font>";
		}

	 // VALIDO EL CAMPO factnif NIF DEL CLIENTE
	
	if(strlen(trim($_POST['factnif'])) == 0){
		$errors [] = "NIF/CIF <font color='#FF0000'>Campo obligatorio.</font>";
		}
	
	elseif (strlen(trim($_POST['factnif'])) < 5){
		$errors [] = "NIF/CIF <font color='#FF0000'>Más de 4 carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^@´`\'áéíóú#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\.\*\']+$/',$_POST['factnif'])){
		$errors [] = "NIF/CIF <font color='#FF0000'>Caracteres no válidos.</font>";
		}
		
	elseif (!preg_match('/^[A-Z,a-z,0-9\s]+$/',$_POST['factnif'])){
		$errors [] = "NIF/CIF <font color='#FF0000'>Solo mayusculas o números sin acentos.</font>";
		}

	// VALIDO EL campo factiva
	
	if($_POST['factiva'] == ''){
		$errors [] = "IMPUESTOS: <font color='#FF0000'>SELECCIONE EL TIPO DE IVA</font>";
	}
					
	// VALIDOEL CAMPO factivae

        if(strlen(trim($_POST['factivae1'])) == 0){
                $errors [] = "IMPUESTOS € <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
                }
            
        elseif (!preg_match('/^[^@´`\'áéíóú#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\*\']+$/',$_POST['factivae1'])){
                $errors [] = "IMPUESTOS € <font color='#FF0000'>CARACTERES NO VALIDOS.</font>";
                }
			
		elseif (!preg_match('/^[0-9]+$/',$_POST['factivae1'])){
			$errors [] = "IMPUESTOS € <font color='#FF0000'>SOLO NUMEROS</font>";
			}

		if(strlen(trim($_POST['factivae2'])) == 0){
			$errors [] = "IMPUESTOS € <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
			}
		
        elseif (!preg_match('/^[^@´`\'áéíóú#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\*\']+$/',$_POST['factivae2'])){
                $errors [] = "IMPUESTOS € <font color='#FF0000'>CARACTERES NO VALIDOS.</font>";
                }
			
		elseif (!preg_match('/^[0-9]+$/',$_POST['factivae2'])){
			$errors [] = "IMPUESTOS € <font color='#FF0000'>SOLO NUMEROS</font>";
			}

	// VALIDO CAMPO factret
	
	if($_POST['factret'] == ''){
		$errors [] = "RETENCIONES: <font color='#FF0000'>SELECCIONE EL TIPO DE IVA</font>";
		}
					
	// VALIDO EL CAMPO factrete
	
		if(strlen(trim($_POST['factrete1'])) == 0){
			$errors [] = "RETENCIONES € <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
			}
		
	elseif (!preg_match('/^[^@´`\'áéíóú#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\*\']+$/',$_POST['factrete1'])){
			$errors [] = "RETENCIONES € <font color='#FF0000'>CARACTERES NO VALIDOS.</font>";
			}
			
		elseif (!preg_match('/^[0-9]+$/',$_POST['factrete1'])){
			$errors [] = "RETENCIONES € <font color='#FF0000'>SOLO NUMEROS</font>";
			}

		if(strlen(trim($_POST['factrete2'])) == 0){
			$errors [] = "RETENCIONES € <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
			}
		
        elseif (!preg_match('/^[^@´`\'áéíóú#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\*\']+$/',$_POST['factrete2'])){
                $errors [] = "RETENCIONES € <font color='#FF0000'>CARACTERES NO VALIDOS.</font>";
                }
			
		elseif (!preg_match('/^[0-9]+$/',$_POST['factrete2'])){
			$errors [] = "IMPUESTOS € <font color='#FF0000'>SOLO NUMEROS</font>";
			}

	// VALIDO EL CAMPO factpvp
	
		if(strlen(trim($_POST['factpvp1'])) == 0){
			$errors [] = "SUBTOTAL € <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
			}
		
		elseif (!preg_match('/^[^@´`\'áéíóú#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\*\']+$/',$_POST['factpvp1'])){
			$errors [] = "SUBTOTAL € <font color='#FF0000'>CARACTERES NO VALIDOS.</font>";
			}
			
		elseif (!preg_match('/^[0-9]+$/',$_POST['factpvp1'])){
			$errors [] = "SUBTOTAL € <font color='#FF0000'>SOLO NUMEROS</font>";
			}

		if(strlen(trim($_POST['factpvp2'])) == 0){
			$errors [] = "SUBTOTAL € <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
			}
		
		elseif (!preg_match('/^[^@´`\'áéíóú#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\*\']+$/',$_POST['factpvp2'])){
			$errors [] = "SUBTOTAL € <font color='#FF0000'>CARACTERES NO VALIDOS.</font>";
			}
			
		elseif (!preg_match('/^[0-9]+$/',$_POST['factpvp2'])){
			$errors [] = "SUBTOTAL € <font color='#FF0000'>SOLO NUMEROS</font>";
			}

	// VALIDO EL CAMPO factpvptot
	
		if(strlen(trim($_POST['factpvptot1'])) == 0){
			$errors [] = "TOTAL € <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
			}
		
        elseif (!preg_match('/^[^@´`\'áéíóú#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\*\']+$/',$_POST['factpvptot1'])){
                $errors [] = "TOTAL € <font color='#FF0000'>CARACTERES NO VALIDOS.</font>";
                }
			
		elseif (!preg_match('/^[0-9]+$/',$_POST['factpvptot1'])){
			$errors [] = "TOTAL € <font color='#FF0000'>SOLO NUMEROS</font>";
			}

		if(strlen(trim($_POST['factpvptot2'])) == 0){
			$errors [] = "TOTAL € <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
			}
		
        elseif (!preg_match('/^[^@´`\'áéíóú#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\*\']+$/',$_POST['factpvptot2'])){
                $errors [] = "TOTAL € <font color='#FF0000'>CARACTERES NO VALIDOS.</font>";
                }
			
		elseif (!preg_match('/^[0-9]+$/',$_POST['factpvptot2'])){
			$errors [] = "TOTAL € <font color='#FF0000'>SOLO NUMEROS</font>";
			}

	 // VALIDAMOS EL CAMPO coment
		
	if(strlen(trim($_POST['coment'])) == 0){
		$errors [] = "DESCRIPCIÓN <font color='#FF0000'>Campo obligatorio.</font>";
		}
	
	elseif (strlen(trim($_POST['coment'])) < 10){
		$errors [] = "DESCRIPCIÓN <font color='#FF0000'>Más de 10 carácteres.</font>";
		}
		
	elseif (strlen(trim($_POST['coment'])) > 19){

	if (!preg_match('/^[a-z A-Z 0-9 \s ,.;:\'-() áéíóúñ € \/]+$/',$_POST['coment'])){
		$errors [] = "DESCRIPCIÓN  <font color='#FF0000'>A escrito caracteres no permitidos. { } [ ] ¿ ? < > ¡ ! @ # ...</font>";
		}
	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	if($_POST['dy'] != ''){
	
        global $db; 	global $db_name;

        $dyt1 = "20".$_POST['dy'];
                                                                    
        global $vname; 		$vname = "`".$_SESSION['clave']."ingresos_".$dyt1."`";
        
		if(isset($_POST['id'])){
			$sqlx =  "SELECT * FROM `$db_name`.$vname WHERE `id` <> '$_POST[id]' AND `factnum` = '$_POST[factnum]'";
		}else{
			$sqlx =  "SELECT * FROM `$db_name`.$vname WHERE `factnum` = '$_POST[factnum]'";
		}
        $qx = mysqli_query($db, $sqlx);
        $countx = mysqli_num_rows($qx);
        $rowsx = mysqli_fetch_assoc($qx);
        
        if($countx > 0){
			$errors [] = "<font color='#FF0000'>YA EXISTE LA FACTURA</font>";
	    } 
	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////


?>