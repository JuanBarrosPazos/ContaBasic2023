<?php

		print("<table align='center' style='margin-top:10px'>
				<tr>
					<th colspan=2 class='BorderInf'>
						".$titulo."
					</th>
				</tr>
			<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]' enctype='multipart/form-data'>
				<tr>
					<td style='text-align:right;'>CLIENTE </td>
					<td>
				<input type='hidden' name='proveegastos' value='".$defaults['proveegastos']."' />
				<input type='hidden' name='factnom' value='".$defaults['factnom']."' />".$defaults['factnom']."
					</td>
				</tr>
				<tr>
					<td style='text-align:right;'>REF. CLIENTE </td>
					<td>
				<input type='hidden' name='refprovee' value='".$defaults['refprovee']."' />".$defaults['refprovee']."
					</td>
				</tr>
				<tr>
					<td style='text-align:right;'>ID </td>
					<td>
				<input type='hidden' name='id' value='".$defaults['id']."' />".$defaults['id']."
					</td>
				</tr>
                ".$Checkbox."
				<tr>
					<td style='text-align:right;'>NUMERO</td>
					<td>
			<input type='hidden' name='factnum' value='".$defaults['factnum']."' />".$defaults['factnum']."
					</td>
				</tr>
				<tr>
					<td style='text-align:right;'>FECHA</td>
					<td>
						".$defaults['dy']."/".$defaults['dm']."/".$defaults['dd']."
						<input type='hidden' name='dy' value='".$defaults['dy']."' />
						<input type='hidden' name='dm' value='".$defaults['dm']."' />
						<input type='hidden' name='dd' value='".$defaults['dd']."' />
					</td>
				</tr>
				<tr>
					<td style='text-align:right;'>RAZON SOCIAL</td>
					<td>
			<input type='hidden' name='factnom' value='".$defaults['factnom']."' />".$defaults['factnom']."
					</td>
				</tr>
				<tr>
					<td style='text-align:right;'>NIF/CIF</td>
					<td>
			<input type='hidden' name='factnif'value='".$defaults['factnif']."' />".$defaults['factnif']."
					</td>
				</tr>
				<tr>
					<td style='text-align:right;'>IMP %</td>
					<td>
			<input type='hidden' name='factiva' value='".$defaults['factiva']."' />".$defaults['factiva']."
					</td>
				</tr>
				<tr>
					<td style='text-align:right;'>IMP €</td>
					<td>
						".$defaults['factivae1'].",".$defaults['factivae2']."
						<input type='hidden' name='factivae1' value='".$defaults['factivae1']."' />
						<input type='hidden' name='factivae2' value='".$defaults['factivae2']."' />
					</td>
				</tr>
				<tr>
					<td style='text-align:right;'>RET %</td>
					<td>
			<input type='hidden' name='factret' value='".$defaults['factret']."' />".$defaults['factret']."
					</td>
				</tr>
				<tr>
					<td style='text-align:right;'>RET €</td>
					<td>
						".$defaults['factrete1'].",".$defaults['factrete2']."
						<input type='hidden' name='factrete1' value='".$defaults['factrete1']."' />
						<input type='hidden' name='factrete2' value='".$defaults['factrete2']."' />
					</td>
				</tr>
				<tr>
					<td style='text-align:right;'>SUBTOTAL €</td>
					<td>
						".$defaults['factpvp1'].",".$defaults['factpvp2']."
						<input type='hidden' name='factpvp1' value='".$defaults['factpvp1']."' />
						<input type='hidden' name='factpvp2' value='".$defaults['factpvp2']."' />
					</td>
				</tr>
				<tr>
					<td style='text-align:right;'>TOTAL €</td>
					<td>
						".$defaults['factpvptot1'].",".$defaults['factpvptot2']."
						<input type='hidden' name='factpvptot1' value='".$defaults['factpvptot1']."' />
						<input type='hidden' name='factpvptot2' value='".$defaults['factpvptot2']."' />
					</td>
				</tr>
				<tr>
					<td style='text-align:right; vertical-align:top;'>DESCRIPCIÓN</td>
					<td style='width:220px; text-align:left;'>
			<input type='hidden' name='coment' value='".$defaults['coment']."' />".$defaults['coment']."
					</td>
				</tr>
					<input name='myimg1' type='hidden' value='".$defaults['myimg1']."' />
					<input name='myimg2' type='hidden' value='".$defaults['myimg2']."' />
					<input name='myimg3' type='hidden' value='".$defaults['myimg3']."' />
					<input name='myimg4' type='hidden' value='".$defaults['myimg4']."' />
				<tr>
					<td colspan='2' align='right' >
						<input type='submit' value='BORRAR GASTO PENDIENTE' class='botonnaranja' />
						<input type='hidden' name='oculto' value=1 />
			</form>														
					</td>
				</tr>
				<tr>
					<td colspan='4' align='center'>
			<a href='Gastos_Pendientes_Ver.php' class='botonazul' style='color:#343434 !important' >INICIO GASTOS PENDIENTES</a>
					</td>
				</tr>
			</table>"); 


?>