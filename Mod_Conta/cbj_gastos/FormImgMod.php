<?php

		global $safe_filename;
		$safe_filename = trim(str_replace('/', '', $_FILES['myimg']['name']));
		$safe_filename = trim(str_replace('..', '', $safe_filename));

		global $nombre;	$nombre = $_FILES['myimg']['name'];
		$nombre_tmp = $_FILES['myimg']['tmp_name'];
		$tipo = $_FILES['myimg']['type'];
		$tamano = $_FILES['myimg']['size'];

		global $destination_file;
		$destination_file = $ruta.$safe_filename;
		
	    if(file_exists($ruta.$nombre) ){
						unlink($ruta.$nombre);
		}elseif(move_uploaded_file($_FILES['myimg']['tmp_name'], $destination_file)){

			// Eliminar el archivo antiguo untitled.png
			if($_SESSION['ImgCbj'] != 'untitled.png' ){
						@unlink($ruta.$_SESSION['ImgCbj']);
										}
			// Renombrar el archivo:
			$extension = substr($_FILES['myimg']['name'],-3);
			// print($extension);
			// $extension = end(explode('.', $_FILES['myimg']['name']) );
			//global $new_name;
			//	$new_name = $_SESSION['ImgCbj'];
			date('H:i:s');
			date('Y-m-d');
			$dt = date('is');
			global $new_name;
			$new_name = $_SESSION['mivalor']."_".$dt.".".$extension;
			$rename_filename = $ruta.$new_name;								
			rename($destination_file, $rename_filename);
			
			global $db; 		global $db_name;

			global $mivalor; 	$imgcamp = "`".$_SESSION['imgcamp']."`";
			$mivalor = $_SESSION['mivalor'];
			
			
			$sqla = "UPDATE `$db_name`.$vname SET $imgcamp = '$new_name' WHERE $vname.`id` = '$_SESSION[miid]' AND $vname.`factnum` = '$mivalor' LIMIT 1 ";
			
			if(mysqli_query($db, $sqla)){
				
				global $redir;
				$redir = "<script type='text/javascript'>
								function redir(){
								window.location.href='Gastos_".$rutaRedir."Ver.php?imagen=1';
							}
							setTimeout('redir()',2);
							</script>";
				print ($redir);
		
			}else { print("* ERROR ".mysqli_error($db));
					show_form ();
					global $texerror;		$texerror = "\n\t ".mysqli_error($db);
						}
		}else{print("NO SE HA PODIDO GUARDAR EN ../imgpro/imgpro".$_SESSION['miseccion']."/");}


?>