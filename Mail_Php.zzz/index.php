
<?php


	//require '../Inclu/error_hidden.php';
	require '../Conections/conection.php';
	require '../Conections/conect.php';

///////////////////////////////////////////////////////////////////////////////////////
		
	$sqlt =  "SELECT * FROM `admin` ORDER BY `id` ASC LIMIT 1";
	$qt = mysqli_query($db, $sqlt);
	$rowt = mysqli_fetch_assoc($qt);
	$_SESSION['title'] = $rowt['Nombre']." ".$rowt['Apellidos'];
	$_SESSION['tdir'] = "City: ".$rowt['Direccion'].".<br/> ";
	$_SESSION['tmail'] = "Email: ".$rowt['Email']." / ";
	$_SESSION['ttlf'] = "Tlf: ".$rowt['Tlf1'].".";
	$_SESSION['mmail'] = $rowt['Email'];
	require 'Admin_Inclu_01b.php';

	$sql =  "SELECT * FROM `admin` WHERE `Usuario` = '$_POST[Usuario]' AND `Password` = '$_POST[Password]'";
 	
	$q = mysqli_query($db, $sql);
	$row = mysqli_fetch_assoc($q);
	
	$_SESSION['Nivel'] = $row['Nivel'];
	$_SESSION['Nombre'] = $row['Nombre'];
	$_SESSION['Apellidos'] = $row['Apellidos'];

///////////////////////////////////////////////////////////////////////////////////////////////

if (trim($_SESSION['Nivel']) == 'XBPadmin'){

				
}
///////////////////////////////////////////////////////////////////////////////////////////////

		if($_POST['oculto']){if($form_errors = validate_form()){
					print("<table align='center'>
								<tr>
									<td>
										<font color='#FF0000'>
											NO SE HA ENVIADO EL FORMULARIO.
										</font>
									</td>
								</tr>
								<tr>
									<td align='center'>
					<a href='http://juanbarrospazos.blogspot.com.es/' target='_blank'>
							Contactos Juan Barros
					</a>
									</td>
								</tr>
							</table>
											");
												
						show_form($form_errors);
										
					} else {process_Mail();}
					
									}	/* Fin del if $_POST['oculto']*/
										
							else {show_form();}
												

/////////////////////////////////////////////////////////////////////////////////////////

 function validate_form(){
	 
	 $errors = array();
		
	/* Validamos el campo Nombre. */
	
		if(strlen(trim($_POST['nombre'])) == 0){
		$errors [] = "Nombre: <font color='#FF0000'>Este campo es obligatorio.</font>";
		}
	
	elseif (strlen(trim($_POST['nombre'])) < 3 ){
		$errors [] = "Nombre: <font color='#FF0000'>Escriba más de tres carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^0-9@#$&%<>:"·\(\)=¿?!¡\[\]\{\};,:\.\*]+$/',$_POST['nombre'])){
		$errors [] = "Nombre: <font color='#FF0000'>Solo texto</font>";
		}
		
	/* Validamos el campo Apellidos. */
	
		if(strlen(trim($_POST['apellidos'])) == 0){
		$errors [] = "Apellidos: <font color='#FF0000'>Este campo es obligatorio.</font>";
		}
	
	elseif (strlen(trim($_POST['apellidos'])) < 3 ){
		$errors [] = "Apellidos: <font color='#FF0000'>Escriba más de tres carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^0-9@#$&%<>:"·\(\)=¿?!¡\[\]\{\};,:\.\*]+$/',$_POST['apellidos'])){
		$errors [] = "Apellidos: <font color='#FF0000'>Solo texto</font>";
		}


	/* Validamos el campo mail. */
	
		if(strlen(trim($_POST['Email'])) == 0){
		$errors [] = "Mail: <font color='#FF0000'>Este campo es obligatorio.</font>";
		}
	
	elseif (strlen(trim($_POST['Email'])) < 5 ){
		$errors [] = "Mail: <font color='#FF0000'>Escriba más de cinco carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^@#$&%<>:"·\(\)=¿?!¡\[\]\{\};,:*\s]+@([-a-z0-9]+\.)+[a-z]{2,}$/',$_POST['Email'])){
		$errors [] = "Mail: <font color='#FF0000'>Esta dirección no es válida.</font>";
		}
		
	/* Validamos el campo Asunto. */
	
		if(strlen(trim($_POST['asunto'])) == 0){
		$errors [] = "Asunto: <font color='#FF0000'>Este campo es obligatorio.</font>";
		}
	
	elseif (strlen(trim($_POST['asunto'])) < 3 ){
		$errors [] = "Asunto: <font color='#FF0000'>Escriba más de tres carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^0-9@#$&%<>:"·\(\)=¿?!¡\[\]\{\};,:\.\*]+$/',$_POST['asunto'])){
		$errors [] = "Asunto: <font color='#FF0000'>Solo texto</font>";
		}

	/* Validamos el campo Mensaje. */
	
		if(strlen(trim($_POST['mensaje'])) == 0){
		$errors [] = "Mensaje: <font color='#FF0000'>Este campo es obligatorio.</font>";
		}
	
	elseif (strlen(trim($_POST['mensaje'])) < 3 ){
		$errors [] = "Mensaje: <font color='#FF0000'>Escriba más de tres carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^$<>\[\]\{\}]+$/',$_POST['mensaje'])){
		$errors [] = "Mensaje: <font color='#FF0000'>Caracteres no permitidos $<>[]{}</font>";
		}

	return $errors;
 			}

//////////////////////////////////////////////////////////////////////////////////////////////

function show_form($errors=''){
	
	
	if(($_POST['oculto'])||($_POST['enviar'])){
				$defaults = $_POST;
									} 
	else {
				$defaults = array (	'nombre' => $_POST['nombre'],
									'apellidos' => $_POST['apellidos'],
									'Email' => $_POST['Email'],	
									'asunto' => $_POST['asunto'],	
									'mensaje' => $_POST['mensaje']);
									}
	
	if ($errors){
		print("<font color='#FF0000'>Solucione estos errores:</font><br/>");
		
		for($a=0; $c=count($errors), $a<$c; $a++){
			print("<font color='#FF0000'>* </font>".$errors [$a]."<br/>");
					}
				}
	
	print(" <table align='center' style=\"border:0px;margin_bottom:6px;margin-top:15px\">
			
 			<form name='Perdidos' method='post' action='$_SERVER[PHP_SELF]'>
			
     <tr>
        <td>Nombre:</td>
            <td width='12'><span style='color:#FF0000;'>*</span></td>
            <td><input name='nombre' type='text' id='nombre' size='40' maxlength='35' value='".$defaults['nombre']."'/></td>
      </tr>
      <tr>
        <td>Apellidos:</td>
            <td width='12'><span style='color:#FF0000;'>*</span></td>
            <td><input name='apellidos' type='text' id='apellidos' size='40' maxlength='35' value='".$defaults['apellidos']."'/></td>
      </tr>
      <tr>
        <td>Email:</td>
            <td><span style='color:#FF0000;'>*</span></td>
            <td><input name='Email' type='text' id='Email' size='40' maxlength='40' value='".$defaults['Email']."'/></td>
      </tr>
      <tr>
        <td>Asunto:</td>
            <td><span style='color:#FF0000;'>*</span></td>
            <td><input name='asunto' type='text' id='asunto' size='40' maxlength='25' value='".$defaults['asunto']."'/></td>
      </tr>
      <tr>
        <td>Mensaje:</td>
            <td><span style='color:#FF0000;'>*</span></td>
            <td rowspan='2'>
<textarea onkeypress='return limita(event, 200)' onkeyup='actualizaInfo(200)' name='mensaje' id='mensaje' cols='40' rows='5'>".$defaults['mensaje']."</textarea>
             
			 <div id='info' align='center' style='color:#0080C0;'>
			  			 Maximum 200 characters            
			</div>          
					<br />
		</td>
      </tr>
      <tr>
        	<td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>
              <div align='right'>
				<input type='hidden' name='oculto' id='oculto' value=1 />
                <input name='enviar' type='submit' class='boton' id='enviar' onclick='MM_validateForm('nombre','','R','Email','','RisEmail','asunto','','R','mensaje','','R');return document.MM_returnValue' value='enviar' />
              </div>
            </td>
      </tr>
		</form>	
	</table>				
				"); /* Fin del print */

	}	/* Fin de la función show_form(); */

/////////////////////////////////////////////////////////////////////////////////////////////////

 function process_Mail(){	 

	 $text_body = '
							 <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
						<html>
						<head>
						<title>Untitled Document</title>
						<meta http-equiv="content-type" content="text/html" charset="utf-8" />
						<meta http-equiv="Content-Language" content="es-es">
						<META NAME="Language" CONTENT="Spanish">
						</head>
						
						<body bgcolor="#D7F0E7">
						
						<STYLE>
						body {
							font-family: "Times New Roman", Times, serif;
						}
						body a {
							text-decoration:none;
						}
						table a {
							color: #666666;
							text-decoration: none;
							font-family: "Times New Roman", Times, serif;
						}
						table a:hover {
							color: #FF9900;
							text-decoration: none;
						}
						tr {
							margin: 0px;
							padding: 0px;
						}
						td {
							margin: 0px;
							padding: 6px;
						}
						th {
							padding: 6px;
							margin: 0px;
							text-align: center;
							color: #666666;
						}
						
						</STYLE>
						


	<table font-family="Times New Roman" width="600px" border="0" align="center" cellpadding="0" cellspacing="0">
						  <tr>
							<th colspan="3">Formulario de contacto.</th>
						  </tr>
						  <tr>
							<td align="right" width="40px">Asunto:</td>
							<td width="12" width="12px">&nbsp;</td>
							<td align="left">'.$_POST['asunto'].'</td>
						  </tr>
						  <tr>
						  <tr>
							<td align="right">Nombre:</td>
							<td width="12">&nbsp;</td>
							<td align="left">'.$_POST['nombre'].'</td>
						  </tr>
						  <tr>
							<td align="right">Apellidos:</td>
							<td>&nbsp;</td>
							<td align="left">'.$_POST['apellidos'].'</td>
						  </tr>
						  <tr>
							<td align="right">Email:</td>
							<td>&nbsp;</td>
							<td align="left">'.$_POST['Email'].'</td>
						  </tr>
						  <tr>
							<td align="right" valign="top">Mensaje:</td>
							<td>&nbsp;</td>
							<td align="left">'.$_POST['mensaje'].'</td>
						  </tr>
					</table>
						</body>
							</html>
									';
			
	$headers = array ('From' => $_POST['Email'],
					  'Subject' => $_POST['asunto']);
					  
		# datos del mensaje
		
				$destinatario= "JuanBarrosPazos@hotmail.es";
				$titulo= $_POST['asunto']." ".$_POST['nombre']." ".$_POST['apellidos'].".";
				$responder= $_POST['Email'];
				$remite= $_POST['Email'];
				$remitente= $_POST['nombre']." ".$_POST['apellidos']."."; //sin tilde para evitar errores de servidor

				$separador = "_separador".md5 (uniqid (rand()));
		
				
		# cabeceras
		
				$cabecera = "Date: ".date("l j F Y, G:i")."\n";
				$cabecera .="MIME-Version: 1.0\n";
				$cabecera .="From: ".$remitente."<".$remite.">\n";
				$cabecera .="Return-path: ". $remite."\n";
				$cabecera .="Reply-To: ".$remite."\n";
				$cabecera .="X-Mailer: PHP/". phpversion()."\n";
				$cabecera .="Content-Type: multipart/mixed;"."\n";
				
				$cabecera .= " boundary=$separador"."\r\n\r\n";	/**/
				
				$texto_html ="\n"."--$separador"."\n";			/**/
				$texto_html .="Content-Type:text/html; charset=\"utf-8\""."\n";
				$texto_html .="Content-Transfer-Encoding: 7bit"."\r\n\r\n";
				
				# Añado la cadena que contiene el mensaje
				$texto_html .= $text_body;
				
				/* Le pasamos a la variable $mensaje el valor de $texto_html*/
				$mensaje= $texto_html;

				/* SOLO PARA ARCHIVOS ADJUNTOS. 
				Adjuntamos una imagen en el mensaje. 
				$adj1 = "\n"."--$separador"."\n"; 
				
				$adj1 .="Content-Type: image/gif;";
				$adj1 .=" name=\"Degra3A.gif\""."\n";
				$adj1 .="Content-Disposition: attachment; ";
				$adj1 .="filename=\"Degra3A.gif\""."\n";
				$adj1 .="Content-Transfer-Encoding: base64"."\r\n\r\n";
				
				$fp = fopen("Degra3A.gif", "r");
				$buff = fread($fp, filesize("Degra3A.gif"));
				fclose($fp);
				
				$adj1 .=chunk_split(base64_encode($buff));
				*/
								
				/* Le pasamos a la variable $mensaje el valor de $texto_html y $adj1, que es la imagen
				$mensaje= $texto_html.$adj1;
				*/
				
			if( mail($destinatario, $titulo, $mensaje, $cabecera)){
				
						print("<table align='center' style=\"margin-top:40px\">
								<tr>
									<td align='center'>
										<font color='#0080C0'>
											SU MENSAJE HA SIDO ENVIADO.
											<br/>
											MUCHAS GRACIAS. ".$_POST['nombre']." ".$_POST['apellidos'].".
										</font>
									</td>
								 </tr>
								<tr>
									<td align='center'>
										<a href='http://juanbarrospazos.blogspot.com.es/' target='_blank'>
											Contactos Juan Barros
										</a>
									</td>
								</tr>
							<table>
									");
							}else{
			print("<table align='center' style=\"margin-top:20px;margin-bottom:20px\">
						<tr>
							<td align='center'>
								<font color='#FF0000'>
									EL MENSAJE NO HA PODIDO ENVIARSE,
									LO SENTIMOS MUCHO, ".$_POST['nombre']." ".$_POST['apellidos'].".
									MUCHAS GRACIAS.
								</font>
							</td>
						</tr>
						<tr>
							<td align='center'>
								<a href='http://juanbarrospazos.blogspot.com.es/' target='_blank'>
									Contactos Juan Barros
								</a>
							</td>
						</tr>
					<table>
						");
														
					} /*Fin del if del mail*/
														
	 		}	/* Fin funcion process_Mail(); */
			
/////////////////////////////////////////////////////////////////////////////////////////////////
	
	require 'Admin_Inclu_02.php';

?>
