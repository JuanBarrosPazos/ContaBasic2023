<?php

	print("<table align='center' style=\"margin-top:10px\">
				<tr>
					<th colspan=2 class='BorderInf'>
								".$Titulo."					
					</th>
				</tr>
				<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'>
					<input type='hidden' name='proveegastos' value='".$defaults['proveegastos']."' />
					<input type='hidden' name='xl' value='".@$defaults['xl']."' />
					<input type='hidden' name='id' value='".@$defaults['id']."' />
					<input type='hidden' name='dy' value='".@$defaults['dy']."' />
					<input type='hidden' name='dm' value='".@$defaults['dm']."' />
					<input type='hidden' name='dd' value='".@$defaults['dd']."' />
					<input type='hidden' name='factnum' value='".strtoupper(@$defaults['factnum'])."' />
					<input type='hidden' name='refprovee' value='".$defaults['refprovee']."' />
					<input type='hidden' name='factnom' value='".$defaults['factnom']."' />
					<input type='hidden' name='factnif' value='".$defaults['factnif']."' />
					<input type='hidden' name='factiva' value='".@$defaults['factiva']."' />
					<input type='hidden' name='factivae1' value='".@$defaults['factivae1']."' />
					<input type='hidden' name='factivae2' value='".@$defaults['factivae2']."' />
					<input type='hidden' name='factret' value='".@$defaults['factret']."' />
					<input type='hidden' name='factrete1' value='".@$defaults['factrete1']."' />
					<input type='hidden' name='factrete2' value='".@$defaults['factrete2']."' />
					<input type='hidden' name='factpvp1' value='".@$defaults['factpvp1']."' />
					<input type='hidden' name='factpvp2' value='".@$defaults['factpvp2']."' />
					<input type='hidden' name='factpvptot1' value='".@$defaults['factpvptot1']."' />
					<input type='hidden' name='factpvptot2' value='".@$defaults['factpvptot2']."' />
					<input type='hidden' name='coment' value='".@$defaults['coment']."' />
				<tr>
					<td>
						<div style='float:left'>
							<input type='submit' value='".$TitValue."' class='botonverde' />
							<input type='hidden' name='oculto1' value=1 />
						</div>
					</td>
					<td>
						<div style='float:left'>
					<select name='proveegastos' class='botonverde'>");

		global $db;
		global $tabla1; 		$tabla1 = "`".$_SESSION['clave']."proveedores`";

		$sqlb =  "SELECT * FROM $tabla1 ORDER BY `rsocial` ASC ";
		$qb = mysqli_query($db, $sqlb);
		if(!$qb){
				print("* ".mysqli_error($db)."<br/>");
		} else {
					
			while($rows = mysqli_fetch_assoc($qb)){
					print ("<option value='".$rows['ref']."' ");
						if($rows['ref'] == $defaults['proveegastos']){
									print ("selected = 'selected'");
												}
									print ("> ".$rows['rsocial']." </option>");
				}
			}  

		print ("</select>
						</div>
						</form>	
					</td>
				</tr>"); 

?>