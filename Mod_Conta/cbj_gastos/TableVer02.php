<?php

	global $rutaDirTr;
	
    print("<table class='tableForm' style='width:34.4em !important;' >
			<tr>
				<th colspan=2 >
					RAZON SOCIAL: ".strtoupper($_POST['factnom'])."
						</br>
                    NIF ".$_POST['factnif']."
						</br> 
					FACT Nº. ".$_POST['factnum']."
				</th>
			</tr>
			<tr>
				<td colspan=2 style='text-align:center;' >
				    <div class='img1'>
		<button type='submit' class='botonnaranja' title='DESCARGAR DOCUMENTO 1' >
			<a style='font-size:14px' href='".$rutaDir.$rowsc['myimg1']."' target='_blank'>
				<img src='".$rutaDir.$myimg1."'> 
			</a>
		</button>							
				    </div>
				    <div class='img1'>
		<button type='submit' class='botonnaranja' title='DESCARGAR DOCUMENTO 2' >
			<a style='font-size:14px' href='".$rutaDir.$rowsc['myimg2']."' target='_blank'>
				<img src='".$rutaDir.$myimg2."' > 
			</a>
		</button>							
				    </div>
				    <div class='img1'>
		<button type='submit' class='botonnaranja' title='DESCARGAR DOCUMENTO 3' >
			<a style='font-size:14px' href='".$rutaDir.$rowsc['myimg3']."' target='_blank'>
				<img src='".$rutaDir.$myimg3."' > 
			</a>
		</button>							
				    </div>
				    <div class='img1'>
		<button type='submit' class='botonnaranja' title='DESCARGAR DOCUMENTO 4' >
			<a style='font-size:14px' href='".$rutaDir.$rowsc['myimg4']."' target='_blank'>
				<img src='".$rutaDir.$myimg4."' >
			</a>
		</button>							
				    </div>
			    </td>
			</tr>
            <tr>
				<td style='text-align: right !important; width: 50%;'>ID </td>
				<td style='width: 50%;' >".$_POST['id']."</td>	
			</tr>
					".$rutaDirTr."	
			<tr>
				<td style='text-align: right !important;' >NUMERO</td>
				<td>".$_POST['factnum']."</td>			
			</tr>		
			<tr>
				<td style='text-align: right !important;' >FECHA </td>
				<td>".$_POST['factdate']."</td>				
			</tr>		
			<tr>
				<td style='text-align: right !important;'>RAZON SOCIAL</td>
				<td>".$_POST['factnom']."</td>
			</tr>		
			<tr>
				<td style='text-align: right !important;' >NIF/CIF</td>
				<td>".$_POST['factnif']."</td>
			</tr>		
			<tr>
				<td style='text-align: right !important;' >SUBTOTAL</td>
				<td>".$_POST['factpvp']." €</td>
			</tr>		
			<tr>
				<td style='text-align: right !important;' >IMPUESTOS</td>
				<td>
                    <span style='display:inline-block; width: 2.8em !important;' >
                    ".$_POST['factiva']." %</span> = ".$_POST['factivae']." €
                </td>
			</tr>		
			<tr>
				<td style='text-align: right !important;' >RETENCIONES</td>
				<td>
                <span style='display:inline-block; width: 2.8em !important;' >
                ".$_POST['factret']." %</span> = ".$_POST['factrete']." €</td>
			</tr>		
			<tr>
				<td style='text-align: right !important;' >TOTAL</td>
				<td>".$_POST['factpvptot']." €</td>
			</tr>		
			<tr>
				<td colspan=2 style='text-align: left !important;' >DESCRIPCION</td>
			</tr>
			<tr>
				<td colspan=2 style='text-aling:left;' >".$_POST['coment']."</td>
			</tr>
			<tr>
				<td colspan=2 align='center' >");

	global $Ver2;			$Ver2 = "style='display:none; visibility: hidden;'";
	global $ConteBotones;	$ConteBotones = "style='display:block;'";
	
		global $a;	$a= "20".(substr($_POST['factdate'],0,2));
		global $vnameStatus; 		$vnameStatus = "`".$_SESSION['clave']."status`";
		$sqlSTatus =  "SELECT * FROM $vnameStatus WHERE `year`='$a' LIMIT 1 ";
		$qStauts = mysqli_query($db, $sqlSTatus);
		$rowStatus = mysqli_fetch_assoc($qStauts);
		global $style;
		//if($rowStatus['stat']==''){
		if($rowStatus['stat']=='close'){
			if($rutPend == 'Pendientes_'){
				global $Modif2;			$Modif2 = "style='display:none; visibility: hidden;'";
				global $ModImg2;		$ModImg2 = "style='display:none; visibility: hidden;'";
			}else{
				global $Modif2;			$Modif2 = "style='display:inline-block;'";
				global $ModImg2;		$ModImg2 = "style='display:inline-block;'";
			}
			//global $Borrar2;		$Borrar2= "style='display:none; visibility: hidden;'";
			//global $PendienteG;		$PendienteG = "style='display:none; visibility: hidden;'";
			//global $Recupera3;		$Recupera3 = "style='display:none; visibility: hidden;'";
		}else{ }

			require 'Gastos_Botones.php';

		print("</td></tr></table>");

?>