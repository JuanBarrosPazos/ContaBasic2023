<?php

	global $cnt; 		$cnt = 0;

	require 'ArrayMesDia.php';
	
	require 'TablaIfErrors.php';

	require 'ArrayOrdenar.php';
	
	print("<table align='center' style=\"border:0px;margin-top:4px\">
				<tr>
					<th colspan=2>".$titulo."</th>
				</tr>
			<form name='form_tabla' method='post' action='$_SERVER[PHP_SELF]'>
				<tr>
					<td align='right' class='BorderSup'>
				<input type='submit' value='FILTRO GASTOS' title='FILTRO DE GASTOS' class='botonazul' />
				<input type='hidden' name='show_formcl' value=1 />
					</td>
					<td class='BorderSup'>
			<div style='float:left'>
		<select name='Orden' title='ORDENAR POR...' class='botonverde' >");
				foreach($ordenar as $option => $label){
					print ("<option value='".$option."' ");
					if($option == $defaults['Orden']){
									print ("selected = 'selected'");
										}
								print ("> $label </option>");
					}	
						
	print ("</select>
				</div> 
				<div style='float:left'>");
								
		require '../Inclu/year_select_bbdd.php';

	print ("</select>
				</div>
				<div style='float:left'>
						<select name='dm' title='SELECCIONAR MES...' class='botonverde' >");
				foreach($dm as $optiondm => $labeldm){
					print ("<option value='".$optiondm."' ");
					if($optiondm == @$defaults['dm']){
								print ("selected = 'selected'");
									}
								print ("> $labeldm </option>");
						}	
																
	print ("</select>
				</div>
				<div style='float:left'>
					<select name='dd' title='SELECCIONAR DIA...' class='botonverde'>");
				foreach($dd as $optiondd => $labeldd){
					print ("<option value='".$optiondd."' ");
					if($optiondd == @$defaults['dd']){
										print ("selected = 'selected'");
											}
									print ("> $labeldd </option>");
							}	
																
	print ("</select>
				</div>
				</td>
			</tr>
			<tr>					
				<td colspan='2' class='BorderInf'>	
				<div style='float:left; margin-right:12px'>
			Nº FACTURA: &nbsp;
			<input type='text' name='factnum' size=22 maxlength=20 value='".@$defaults['factnum']."' />
				</div>
				<div style='float:left; margin-right:12px'>
			NIF: &nbsp;
			<!--
			<input type='text' name='factnif' size=22 maxlength=10 value='".@$defaults['factnif']."' />
			-->
			<select name='factnif' title='NUMERO NIF FACTURA' class='botonverde'>
			<option value=''>Nº NIF</option>");
			global $db; 
			global $tabla1; 		$tabla1 = "`".$_SESSION['clave']."proveedores`";

			$sqlb =  "SELECT * FROM $tabla1 ORDER BY `rsocial` ASC ";
			$qb = mysqli_query($db, $sqlb);
			if(!$qb){
					print("* ".mysqli_error($db)."<br/>");
			} else {
					while($rows = mysqli_fetch_assoc($qb)){
						print ("<option value='".$rows['dni'].$rows['ldni']."' ");
						if($rows['dni'].$rows['ldni'] == @$defaults['factnif']){
													print ("selected = 'selected'");
															}
								print ("> ".$rows['dni'].$rows['ldni']." </option>");
							}
					}  

	print ("</select>
				</div>
				<div style='float:left; margin-right:12px'>
					RAZON SOCIAL: &nbsp;
					<!--
					<input type='text' name='factnom' size=22 maxlength=22 value='".@$defaults['factnom']."' />
					-->
			<select name='factnom' title='RAZON SOCIAL' class='botonverde'>
			<option value=''>RAZON SOCIAL</option>");
		global $db;
		global $tabla1; 		$tabla1 = "`".$_SESSION['clave']."proveedores`";
		$sqlb =  "SELECT * FROM $tabla1 ORDER BY `rsocial` ASC ";
		$qb = mysqli_query($db, $sqlb);
		if(!$qb){
				print("* ".mysqli_error($db)."<br/>");
		} else {
		while($rows = mysqli_fetch_assoc($qb)){
					print ("<option value='".$rows['ref']."' ");
					if($rows['ref'] == @$defaults['factnom']){
										print ("selected = 'selected'");
												}
								print ("> ".$rows['rsocial']." </option>");
						}
			}

	print ("</select>
				</div>
					</td>
				</tr>
			</form>");
						
	////////

	if(isset($_POST['show_formcl'])){	global $cnt;
										gt2();
											}
	////////

	print ("<form name='todo' method='post' action='$_SERVER[PHP_SELF]' >
				<tr>
					<td align='center' class='BorderSup'>
			<input type='submit' value='TODOS LOS GASTOS' title='VER TODOS LOS GASTOS' class='botonazul' />
			<input type='hidden' name='todo' value=1 />
					</td>
					<td class='BorderSup'>	
			<div style='float:left'>
			<select name='Orden' title='ORDENAR POR...' class='botonverde'>");
						
				foreach($ordenar as $option => $label){
					
					print ("<option value='".$option."' ");
					
					if($option == $defaults['Orden']){
															print ("selected = 'selected'");
																								}
													print ("> $label </option>");
												}	
						
	print ("</select>
				</div>
				<div style='float:left'>");
								
		require '../Inclu/year_select_bbdd.php';
									
	print ("</select>
				</div>
				<div style='float:left'>
					<select name='dm'  title='SELECCIONAR MES...' class='botonverde'>");
					foreach($dm as $optiondm => $labeldm){
								print ("<option value='".$optiondm."' ");
						if($optiondm == @$defaults['dm']){
											print ("selected = 'selected'");
													}
										print ("> $labeldm </option>");
							}	
																
	print ("</select>
				</div>
				<div style='float:left'>
					<select name='dd' title='SELECCIONAR DIA...' class='botonverde'>");
						foreach($dd as $optiondd => $labeldd){
							print ("<option value='".$optiondd."' ");
							if($optiondd == @$defaults['dd']){
												print ("selected = 'selected'");
															}
											print ("> $labeldd </option>");
									}	
																
	print ("</select>
					</div>
				</form>														
					</td></tr>");

	////////
	
		if(isset($_POST['todo'])){ gt1(); }

	////////
			
		print("	</table>
							
				"); /* Fin del print */


?>