<?php
session_start();

	//require '../Inclu/error_hidden.php';
	require '../Inclu/Admin_Inclu_01b.php';

	require '../Conections/conection.php';
	require '../Conections/conect.php';

///////////////////////////////////////////////////////////////////////////////////////////////

if ($_SESSION['Nivel'] == 'admin'){

	master_index();

	if(isset($_POST['oculto2'])){ ver_todo();
	 							  show_form();
		} else { show_form();}
								
	} else { require '../Inclu/table_permisos.php'; }

//////////////////////////////////////////////////////////////////////////////////////////////

function show_form(){

	global $db;
	global $db_name;
	
	if(isset($_POST['oculto2'])){
				$defaults = array ('Orden' => isset($ordenar),
								   'tablas' => "",
								   						);
										}
		else{	unset($_SESSION['tablas']);
				$defaults = array ('Orden' => isset($ordenar),
								   'tablas' => '',
								   						);
										}

/////////////////////////////////
/////////////////////////////////

	
	
		if ((isset($_POST['todo'])) || ($_SESSION['Nivel'] == 'admin')) {
			
/* Se busca las tablas en la base de datos */

	//$consulta = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES ";
	$consulta = "SHOW TABLES FROM $db_name";
	$respuesta = mysqli_query($db, $consulta);
	if(!$respuesta){
	print("<font color='#FF0000'>Se ha producido un error: </font></br>".mysqli_error($db)."</br>");
		
		} else {	print( "<table align='center'>
		
									<tr>
										<th colspan=2 class='BorderInf'>
									NUMERO DE TABLAS ".mysqli_num_rows($respuesta).".
										</th>
									</tr>");
			while ($fila = mysqli_fetch_row($respuesta)) {
				if($fila[0]){
				print(	"<tr>
							<td class='BorderInfDch'>
											".$fila[0]."
							</td>
							<td class='BorderInf'>
				<form name='exporta' action='$_SERVER[PHP_SELF]' method='POST'>
					<input name='tabla' type='hidden' value='".$fila[0]."' />
						<input type='submit' value='EXPORTA TABLA ".strtoupper($fila[0])."' />
						<input type='hidden' name='oculto2' value=1 />
						</form>
										</td>
							<tr>			
								");
				}
					}
			print("</table>");		
					
				}
		}
	
	}	

/////////////////////////////////////////////////////////////////////////////////////////////////

function ver_todo(){
	
		require 'export_bbdd.php';

	}	/* Final ver_todo(); */

/////////////////////////////////////////////////////////////////////////////////////////////////
	
	function master_index(){
		
				require '../Inclu_Mind/Master_Index_bbdd.php';
		
				} /* Fin funcion master_index.*/

/////////////////////////////////////////////////////////////////////////////////////////////////

	require '../Inclu/Admin_Inclu_02.php';
		
?>