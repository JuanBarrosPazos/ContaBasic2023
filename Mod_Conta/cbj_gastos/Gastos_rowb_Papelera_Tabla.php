<?php
	
	print ("<table class='tableForm' >
			<tr>
				<th colspan=14 class='BorderInf'>
					GASTOS PAPELERA ".$dyt1." - ".mysqli_num_rows($qb)." RESULTADOS
				</th>
			</tr>
			<tr>
				<th class='BorderInfDch'>ID</th>			
				<th class='BorderInfDch'>NUMERO</th>			
				<th class='BorderInfDch'>Y/M/D</th>				
				<th class='BorderInfDch'>RAZON SOCIAL</th>
				<th class='BorderInfDch'>NIF / CIF</th>
				<th class='BorderInfDch'>IMP %</th>
				<th class='BorderInfDch'>IMP €</th>
				<th class='BorderInfDch'>SUBTOT</th>										
				<th class='BorderInfDch'>RET %</th>
				<th class='BorderInfDch'>RET €</th>
				<th class='BorderInfDch'>TOTAL</th>
				<th colspan=5 class='BorderInf' style='text-align:center;' >
					".$AddBlack."
						<a href='Gastos_Crear.php'>&nbsp;&nbsp;&nbsp;</a>
					".$closeButton."
					".$MoneypGrey."
						<a href='Gastos_Ver.php' >&nbsp;&nbsp;&nbsp;</a>
					".$closeButton."
					".$MoneypWhite."
						<a href='Gastos_Pendientes_Ver.php' >&nbsp;&nbsp;&nbsp;</a>
					".$closeButton."
				</th>
			</tr>");
		
	global $styleBgc; global $i; $i = 1;

	while($rowb = mysqli_fetch_assoc($qb)){

		if(($i%2) == 0){ $styleBgc = "bgctdb"; }else{ $styleBgc = "bgctd"; }
		$i++;

		global $vname; 		global $dyt1;
				
		print ("<tr class='".$styleBgc."'>
					<td align='center'>".$rowb['id']."</td>
					<td align='center'>".$rowb['factnum']."</td>
					<td align='left'>".$rowb['factdate']."</td>
					<td align='center'>".$rowb['factnom']."</td>
					<td align='left'>".$rowb['factnif']."</td>
					<td align='right'>".$rowb['factiva']."</td>
					<td align='right'>".$rowb['factivae']."</td>
					<td align='right'>".$rowb['factpvp']."</td>
					<td align='right'>".$rowb['factret']."</td>
					<td align='right'>".$rowb['factrete']."</td>
					<td align='right'>".$rowb['factpvptot']."</td>
					<td style='text-align:center;' >
		<form name='ver' action='$_SERVER[PHP_SELF]' method='POST'>");

			require 'Gastos_rowb_Total.php';

			print($DetalleBlack.$closeButton."
				<input type='hidden' name='ocultoDetalle' value=1 />
			</form>
				</td>

				<td style='text-align:center;' >
		<form name='modifica' action='Gastos_Papelera_Recuperar.php' method='POST'>");

			require 'Gastos_rowb_Total.php';

			print($RestoreBlack.$closeButton."
				<input type='hidden' name='oculto2' value=1 />
		</form>
				</td>

				<td style='text-align:center;' >
			<form name='modifica' action='Gastos_Papelera_Borrar.php' method='POST'>");

			require 'Gastos_rowb_Total.php';

			print($DeleteWhite.$closeButton."
					<input type='hidden' name='oculto2' value=1 />
			</form>
					</td>
				</tr>");

		} // FIN WHILE

		print("<tr>
					<td colspan='14' class='BorderInf'></td>
				</tr>
				<tr>
					<td colspan='3' class='BorderDch' align='center'>IMPUESTOS REPERC €</td>
					<td colspan='3' class='BorderDch' align='center'>RETENCION REPERC €</td>
					<td colspan='3' class='BorderDch' align='center'>TOTAL €</td>
					<td colspan='5' rowspan=2 align='center'>
						<div id='footer'>&copy; Juan Barr&oacute;s Pazos 2016/2023</div>
					</td>
				</tr>
				<tr>
					<td colspan='3' class='BorderDch' align='center'>".$sumaivae." €</td>
					<td colspan='3' class='BorderDch' align='center'>".$sumarete." €</td>
					<td colspan='3' class='BorderDch' align='center'>".$sumapvptot." €</td>
				</tr>
					</table>");

?>