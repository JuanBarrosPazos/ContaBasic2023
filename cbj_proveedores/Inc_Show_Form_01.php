<?php

	if(isset($_POST['oculto'])){
		$defaults = $_POST;
		}
	elseif(isset($_POST['todo'])){
		$defaults = $_POST;
		} else {
				$defaults = array ('rsocial' => '',
								   'ref' => '',
								   'dni' => '',
								   'Orden' => isset($ordenar)
										);
					}
	
	if ($errors){
        print("<table align='center'>
                <tr>
					<th style='text-align:center'>
                        <font color='#FF0000'>* SOLUCIONE ESTOS ERRORES:</font><br/>
                    </th>
                </tr>
				<tr>
					<td style='text-align:left'>");
			
		for($a=0; $c=count($errors), $a<$c; $a++){
			print("<font color='#FF0000'>**</font>  ".$errors [$a]."<br/>");
			}
		print("</td>
				</tr>
				</table>");
		}
		
	$ordenar = array (	'`rsocial` ASC' => 'R. SOCIAL ASC',
						'`rsocial` DESC' => 'R. SOCIAL DESC',
						'`ref` ASC' => 'REF. ASC',
						'`ref` DESC' => 'REF. DESC',
						'`dni` ASC' => 'DNI. ASC',
						'`dni` DESC' => 'DNI. DESC',
								);

	print("<table align='center' style=\"border:0px;margin-top:4px\">
				<tr>
					<th class='BorderInf BorderSup' colspan=2 width=100% >
						".$titulo."
					</th>
				</tr>
				
	<form name='form_tabla' method='post' action='$_SERVER[PHP_SELF]'>
						
				<tr>
					<td align='right'>
						<input type='submit' value='CONSULTA' />
						<input type='hidden' name='oculto' value=1 />
					</td>
					<td>

		<select name='Orden'>");
						
			foreach($ordenar as $option => $label){
				print ("<option value='".$option."' ");
					if($option == $defaults['Orden']){ print ("selected = 'selected'"); }
													print ("> $label </option>");
												}	
						
	print (" </select>
				</td>
			</tr>

			<tr>
				<td align='right'>	
					REFERENCIA
				</td>
				<td>
	<input type='text' name='ref' size=20 maxlenth=20 value='".@$defaults['ref']."' />
				</td>
			</tr>
	
			<tr>
				<td align='right'>	
					Nº DNI
				</td>
				<td>
	<input type='text' name='dni' size=20 maxlenth=8 value='".@$defaults['dni']."' />
				</td>
			</tr>
				
			<tr>
				<td align='right'>	
					RAZON SOCIAL
				</td>
				<td>
	<input type='text' name='rsocial' size=20 maxlenth=20 value='".@$defaults['rsocial']."' />
				</td>
			</tr>
	</form>	
				
	<form name='todo' method='post' action='$_SERVER[PHP_SELF]' >
		
			<tr>
				<td align='right' class='BorderInf BorderSup'>
					<input type='submit' value='VER TODOS' />
					<input type='hidden' name='todo' value=1 />
				</td>
				<td class='BorderInf BorderSup'>

		<select name='Orden'>");
						
			foreach($ordenar as $option => $label){
				print ("<option value='".$option."' ");
					if($option == $defaults['Orden']){ print ("selected = 'selected'");}
													print ("> $label </option>");
												}	
						
	print (" </select>
				</td>
				</tr>
	        </form>														
		</table>"); /* Fin del print */


?>