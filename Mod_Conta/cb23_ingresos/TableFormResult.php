<?php
 
	global $iniy;

	$tabla = "<table align='center' style='margin-top:10px'>
				<tr>
					<th colspan=4 class='BorderInf'>
						".$title.strtoupper($vname)."
					</th>
				</tr>
				<tr>
					<td style='whidth:230px; text-align:right;'>NUMERO</td>
					<td style='whidth:220px;'>".$_POST['factnum']."</td>
					<td style='whidth:230px;text-align:right;'>FECHA</td>
					<td>".$iniy.$factdate."</td>
				</tr>
				<tr>
					<td style='text-align:right;'>RAZON SOCIAL</td>
					<td>".$_POST['factnom']."</td>
					<td style='text-align:right;'>NIF / CIF</td>
					<td>".$_POST['factnif']."</td>
				</tr>
				<tr>
					<td style='text-align:right;'>IMPUESTOS %</td>
					<td>".$_POST['factiva']."</td>
					<td style='text-align:right;'>IMPUESTOS €</td>
					<td>".$factivae."</td>
				</tr>
				<tr>
					<td style='text-align:right;'>RETENCIONES %</td>
					<td>".$_POST['factret']."</td>
					<td style='text-align:right;'>RETENCIONES €</td>
					<td>".$factivae."</td>
				</tr>
				<tr>
					<td style='text-align:right;'>SUBTOTAL</td>
					<td>".$factpvp."</td>
					<td style='text-align:right;'>TOTAL</td>
					<td>".$factpvptot."</td>
				</tr>
				<tr>
					<td style='text-align:right;'>DESCRIPCION</td>
					<td colspan='3' style='text-align:left;'>".$_POST['coment']."</td>
				</tr>
				<tr>
					<td colspan='4' align='center'>
							".$link1.$link2."
					</td>
				</tr>
			</table>";	

?>