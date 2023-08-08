<?php

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	$factivae1 = $_POST['factivae1'];
	$factivae2 = $_POST['factivae2'];
	global $factivae;
	$factivae = $factivae1.".".$factivae2;
	$factivae = floatval($factivae);
    $factivae = number_format($factivae,2,".","");
    //echo "*** ".$factivae."<br>";
    
	$factrete1 = $_POST['factrete1'];
	$factrete2 = $_POST['factrete2'];
	global $factrete;
	$factrete = $factrete1.".".$factrete2;
	$factrete = floatval($factrete);
    $factrete = number_format($factrete,2,".","");
    //echo "*** ".$factrete."<br>";

	$factpvp1 = $_POST['factpvp1'];
	$factpvp2 = $_POST['factpvp2'];
	global $factpvp;
	$factpvp = $factpvp1.".".$factpvp2;
	$factpvp = floatval($factpvp);
    $factpvp = number_format($factpvp,2,".","");
    //echo "*** ".$factpvp."<br>";

	$factpvptot1 = $_POST['factpvptot1'];
	$factpvptot2 = $_POST['factpvptot2'];
	global $factpvptot;
	$factpvptot = $factpvptot1.".".$factpvptot2;
	$factpvptot = floatval($factpvptot);
    $factpvptot = number_format($factpvptot,2,".","");
    //echo "*** ".$factpvptot."<br>";

	global $fiva;
	$fiva = floatval($_POST['factiva']);
	$fiva = number_format($fiva,2,".","");
    //echo "*** ".$fiva."<br>";

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
	
	$cftot = ($factpvp + $civae) - $factrete;
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

	 // VALIDO EL CAMPO factnif NIF DEL PROVEEDOR
	
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
                                                                    
        global $vname;
        $vname = "`".$_SESSION['clave']."gastos_".$dyt1."`";
        
        $sqlx =  "SELECT * FROM `$db_name`.$vname WHERE `factnum` = '$_POST[factnum]'";
        $qx = mysqli_query($db, $sqlx);
        $countx = mysqli_num_rows($qx);
        $rowsx = mysqli_fetch_assoc($qx);
        
        global $exist;	
        if($countx > 0){$errors [] = "<font color='#FF0000'>YA EXISTE LA FACTURA</font>";
                        }

    } 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

    // VALIDAMOS LAS IMAGENES DE LA FACTURA

	if($_FILES['myimg1']['size'] == 0){
		// NADA
	}else{
			
	$limite = 500 * 1024;
	
	$ext_permitidas = array('jpg','JPG','gif','GIF','png','PNG','pdf','PDF','bmp','BMP');
	
	$extension1 = substr($_FILES['myimg1']['name'],-3);
	// print($extension1);
	// $extension1 = end(explode('.', $_FILES['myimg1']['name']) );

	$ext_correcta1 = in_array($extension1, $ext_permitidas);

	// $tipo_correcto1 = preg_match('/^image\/(gif|png|jpg|bmp)$/', $_FILES['myimg1']['type']);

	if(!$ext_correcta1){
			$errors [] = "La extension no esta admitida: ".$_FILES['myimg1']['name'];
			}
    /*	
		elseif(!$tipo_correcto1){
			$errors [] = "Este tipo de archivo no esta admitido: ".$_FILES['myimg1']['name'];
			}
    */	
	
	elseif ($_FILES['myimg1']['size'] > $limite){
	$tamanho1 = $_FILES['myimg1']['size'] / 1024;
	$errors [] = "El archivo".$_FILES['myimg1']['name']." es mayor de 500 KBytes. ".$tamanho1." KB";
			}
			elseif ($_FILES['myimg1']['error'] == UPLOAD_ERR_PARTIAL){
				$errors [] = "La carga del archivo se ha interrumpido.";
				}
			elseif ($_FILES['myimg1']['error'] == UPLOAD_ERR_NO_FILE){
				$errors [] = "Es archivo no se ha cargado.";
				}
		}
		
    //////////////

		if($_FILES['myimg2']['size'] == 0){

		}else{
		 
		$limite = 500 * 1024;
		$ext_permitidas = array('jpg','JPG','gif','GIF','png','PNG','pdf','PDF','bmp','BMP');
		
		$extension2 = substr($_FILES['myimg2']['name'],-3);
		// print($extension2);
		// $extensio2n = end(explode('.', $_FILES['myimg2']['name']) );
		$ext_correcta2 = in_array($extension2, $ext_permitidas);

	// $tipo_correcto2 = preg_match('/^image\/(gif|png|jpg|bmp)$/', $_FILES['myimg2']['type']);

		if(!$ext_correcta2){
			$errors [] = "La extension no esta admitida: ".$_FILES['myimg2']['name'];
			}
/*
		elseif(!$tipo_correcto2){
			$errors [] = "Este tipo de archivo no esta admitido: ".$_FILES['myimg2']['name'];
			}
*/
	elseif ($_FILES['myimg2']['size'] > $limite){
	$tamanho2 = $_FILES['myimg2']['size'] / 1024;
	$errors [] = "El archivo".$_FILES['myimg2']['name']." es mayor de 500 KBytes. ".$tamanho2." KB";
			}
		
			elseif ($_FILES['myimg2']['error'] == UPLOAD_ERR_PARTIAL){
				$errors [] = "La carga del archivo se ha interrumpido.";
				}
				
				elseif ($_FILES['myimg2']['error'] == UPLOAD_ERR_NO_FILE){
					$errors [] = "Es archivo no se ha cargado.";
					}
		}

    //////////////

		if($_FILES['myimg3']['size'] == 0){

		}else{
		 
		$limite = 500 * 1024;
		$ext_permitidas = array('jpg','JPG','gif','GIF','png','PNG','pdf','PDF','bmp','BMP');
		
		$extension3 = substr($_FILES['myimg3']['name'],-3);
		// print($extension3);
		// $extension3 = end(explode('.', $_FILES['myimg3']['name']) );
		$ext_correcta3 = in_array($extension3, $ext_permitidas);

	// $tipo_correcto3 = preg_match('/^image\/(gif|png|jpg|bmp)$/', $_FILES['myimg3']['type']);

		 
		if(!$ext_correcta3){
			$errors [] = "La extension no esta admitida: ".$_FILES['myimg3']['name'];
			}
/*
		elseif(!$tipo_correcto3){
			$errors [] = "Este tipo de archivo no esta admitido: ".$_FILES['myimg3']['name'];
			}
*/
	elseif ($_FILES['myimg3']['size'] > $limite){
	$tamanho3 = $_FILES['myimg3']['size'] / 1024;
	$errors [] = "El archivo".$_FILES['myimg3']['name']." es mayor de 500 KBytes. ".$tamanho3." KB";
			}
		
			elseif ($_FILES['myimg3']['error'] == UPLOAD_ERR_PARTIAL){
				$errors [] = "La carga del archivo se ha interrumpido.";
				}
				
				elseif ($_FILES['myimg3']['error'] == UPLOAD_ERR_NO_FILE){
					$errors [] = "Es archivo no se ha cargado.";
					}
		}

    //////////////

		if($_FILES['myimg4']['size'] == 0){

		}else{
		 
		$limite = 500 * 1024;
		$ext_permitidas = array('jpg','JPG','gif','GIF','png','PNG','pdf','PDF','bmp','BMP');
		
		$extension4 = substr($_FILES['myimg4']['name'],-3);
		// print($extension4);
		// $extension4 = end(explode('.', $_FILES['myimg4']['name']) );
		$ext_correcta4 = in_array($extension4, $ext_permitidas);

	// $tipo_correcto4 = preg_match('/^image\/(gif|png|jpg|bmp)$/', $_FILES['myimg4']['type']);

		if(!$ext_correcta4){
			$errors [] = "La extension no esta admitida: ".$_FILES['myimg4']['name'];
			}
/*
		elseif(!$tipo_correcto4){
			$errors [] = "Este tipo de archivo no esta admitido: ".$_FILES['myimg4']['name'];
			}
*/
	elseif ($_FILES['myimg4']['size'] > $limite){
	$tamanho4 = $_FILES['myimg4']['size'] / 1024;
	$errors [] = "El archivo".$_FILES['myimg4']['name']." es mayor de 500 KBytes. ".$tamanho4." KB";
			}
		
			elseif ($_FILES['myimg4']['error'] == UPLOAD_ERR_PARTIAL){
				$errors [] = "La carga del archivo se ha interrumpido.";
				}
				
				elseif ($_FILES['myimg4']['error'] == UPLOAD_ERR_NO_FILE){
					$errors [] = "Es archivo no se ha cargado.";
					}
		}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////


?>