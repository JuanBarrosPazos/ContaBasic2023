<?php

		require 'Gastos_factdate.php';

		require 'FormatNumber.php';

		if(file_exists($rutaold.$_SESSION['myimg1'])){
					copy($rutaold.$_SESSION['myimg1'], $rutanew.$_SESSION['myimg1']);
					//unlink($rutaold.$_SESSION['myimg1']);
					/*	
					print(" <br/>* CHANGE YEAR FACT: 20".$_SESSION['yold']." X 20".$dyt1."
									<br/>- Ok Copy & Unlink Img Name 1.");
					*/
		}else{
			print("<br/>- No Ok Copy & Unlink Img Name 1 ".$rutaold.$_SESSION['myimg1']. " TO ".$rutanew.$_SESSION['myimg1']);}

		if(file_exists($rutaold.$_SESSION['myimg2']) ){
					copy($rutaold.$_SESSION['myimg2'], $rutanew.$_SESSION['myimg2']);
					//unlink($rutaold.$_SESSION['myimg2']);
					/* print("<br/>- Ok Copy & Unlink Img Name 2."); */
		}else{
			print("<br/>- No Ok Copy & Unlink Img Name 2 ".$rutaold.$_SESSION['myimg2']. " TO ".$rutanew.$_SESSION['myimg2']);}
										
		if(file_exists($rutaold.$_SESSION['myimg3']) ){
					copy($rutaold.$_SESSION['myimg3'], $rutanew.$_SESSION['myimg3']);
					//unlink($rutaold.$_SESSION['myimg3']);
					/* print("<br/>- Ok Copy & Unlink Img Name 3."); */
		}else{
			print("<br/>- No Ok Copy & Unlink Img Name 3 ".$rutaold.$_SESSION['myimg3']. " TO ".$rutanew.$_SESSION['myimg3']);}
										
		if(file_exists($rutaold.$_SESSION['myimg4']) ){
					copy($rutaold.$_SESSION['myimg4'], $rutanew.$_SESSION['myimg4']);
					//unlink($rutaold.$_SESSION['myimg4']);
					/* print("<br/>- Ok Copy & Unlink Img Name 4."); */
		}else{print("<br/>- No Ok Copy & Unlink Img Name 4 ".$rutaold.$_SESSION['myimg4']. " TO ".$rutanew.$_SESSION['myimg4']);}
						
		$idx = $_SESSION['idx'];

		//global $vnamei; 		$vnamei = "`".$_SESSION['clave']."gastos_pendientes`";
		$_SESSION['vname'] = $vnamei;
		
		global $sent;
		$sent = "INSERT INTO `$db_name`.$vnamei (`factnum`, `factdate`, `refprovee`, `factnom`, `factnif`, `factiva`, `factivae`, `factpvp`, `factret`, `factrete`, `factpvptot`,`coment`, `myimg1`, `myimg2`, `myimg3`, `myimg4`) VALUES ('$_POST[factnum]', '$factdate', '$_POST[proveegastos]', '$_POST[factnom]', '$_POST[factnif]', '$_POST[factiva]', '$factivae', '$factpvp', '$_POST[factret]', '$factrete', '$factpvptot', '$_POST[coment]', '$_SESSION[myimg1]', '$_SESSION[myimg2]', '$_SESSION[myimg3]', '$_SESSION[myimg4]')";
		
		if(mysqli_query($db, $sent)){

			//global $title;			$title = 'SE INSERTADO LA FACTURA EN ';
			global $Borrar2;		$Borrar2= "style='display:none; visibility: hidden;'";
			global $Modif2;			$Modif2= "style='display:none; visibility: hidden;'";
			global $ModImg2;		$ModImg2= "style='display:none; visibility: hidden;'";
			global $PendienteG;		$PendienteG= "style='display:none; visibility: hidden;'";
			global $Recupera3;		$Recupera3 = "style='display:none; visibility: hidden;'";
			global $Ver2;			$Ver2= "style='display:none; visibility: hidden;'";
			global $ConteBotones;	$ConteBotones = "style='display:block;'";
			require 'TableFormResult.php';	
			
			unlink($rutaold.$_SESSION['myimg1']);
			unlink($rutaold.$_SESSION['myimg2']);
			unlink($rutaold.$_SESSION['myimg3']);
			unlink($rutaold.$_SESSION['myimg4']);
				
		}else{
			print("* ERROR L.93: ".mysqli_error($db));
			global $texerror; 	$texerror = "\n\t ".mysqli_error($db);
				}

		$idx = $_SESSION['idx'];
		// global $vnamed; 		$vnamed = "`".$_SESSION['clave']."gastos_".$dyt1."`";
		$sqla = "DELETE FROM `$db_name`.$vnamed  WHERE $vnamed.`id` = '$idx'  ";

		if(mysqli_query($db, $sqla)){ //	print("<br/>* OK DELETE DATA."); 
		}else{
			print("* ERROR LINEA 98: ".mysqli_error($db));
			global $texerror; 	$texerror = "\n\t ".mysqli_error($db);
				}

		/*
		global $redir;
		$redir = "<script type='text/javascript'>
						function redir(){
						window.location.href='Gastos_Ver.php';
					}
					setTimeout('redir()',8000);
					</script>";
		print ($redir);
		*/


?>