<?php

if ($_SESSION['Nivel'] == 'admin') {	


print("<div style='clear:both'></div>
		
<div class='MenuVertical'>
Hello: ".$_SESSION['Nombre'][0]." ".$_SESSION['Apellidos'].".</br>

 <!-- Comienza ul global -->
 		
<ul id='MenuBar1' class='MenuBarVertical'>

  <li class='MenuBarItemSubmenu'>
  <a href='#'>APP MENU</a>
  <ul>
 
<!-- MENU ADMINISTRADORES -->

  	<li>
		<a href='".$rutaModAdmin."Admin/Admin_Ver.php' >ADMINISTRADORES</a>
  	</li>

<!-- Fin MENU ADMINISTRADORES-->
 
<!-- MENU GASTOS PROVEEDORES -->

  	<li>
		<a href='".$rutaProveedores."proveedores_Ver.php'>PROVEEDORES</a>
  	</li>

<!-- Fin MENU GASTOS PROVEEDORES -->
	
<!-- MENU INGRESOS PROVEEDORES -->

  	<li>
		<a href='".$rutaClientes."clientes_Ver.php' >CLIENTES</a>
 	</li>

<!-- Fin MENU INGRESOS PROVEEDORES-->
 
<!-- Inicio GESTIÓN DE GASTOS -->

  	<li><a href='#' class='MenuBarItemSubmenu'>GASTOS</a>
		<ul>
			<li><a href='".$rutaGastos."Gastos_Ver.php'>GASTO CONSULTAR</a></li>
			<li><a href='".$rutaGastos."Gastos_Crear.php'>GASTO CREAR DATOS</a></li>
			<li><a href='".$rutaGastos."Gastos_Modificar_01.php'>GASTO MODIFICAR</a></li>
			<li><a href='".$rutaGastos."Gastos_Borrar_01.php'>GASTO BORRAR</a></li>

			<li><a href='".$rutaGastos."Gastos_Pendientes_Ver.php'>G. PENDIENTE VER</a></li>
			<li><a href='".$rutaGastos."Gastos_Pendientes_Crear.php'>G. PENDIENTE CREAR</a></li>
			<li><a href='".$rutaGastos."Gastos_Pendientes_Modificar_01.php'>G. PENDIENTE MODIF</a></li>
			<li><a href='".$rutaGastos."Gastos_Pendientes_Borrar_01.php'>G. PENDIENTE BORRA</a></li>
		</ul>
  	</li>
	
<!-- Fin GESTIÓN DE GASTOS -->

<!-- Inicio GESTIÓN DE INGRESOS -->

  	<li><a href='#' class='MenuBarItemSubmenu'>INGRESOS</a>
		<ul>
			<li><a href='".$rutaIngresos."Ingresos_Ver.php'>INGRESO VER</a></li>
			<li><a href='".$rutaIngresos."Ingresos_Crear.php'>INGRESO CREAR</a></li>
			<li><a href='".$rutaIngresos."Ingresos_Modificar_01.php'>INGRESO MODIFICAR</a></li>
			<li><a href='".$rutaIngresos."Ingresos_Borrar_01.php'>INGRESO ELIMINAR</a></li>

			<li><a href='".$rutaIngresos."Ingresos_Pendientes_Ver.php'>I. PENDIENTE VER</a></li>
			<li><a href='".$rutaIngresos."Ingresos_Pendientes_Crear.php'>I. PENDIENTE CREAR</a></li>
			<li><a href='".$rutaIngresos."Ingresos_Pendientes_Modificar_01.php'>I. PENDIENTE MODIF</a></li>
			<li><a href='".$rutaIngresos."Ingresos_Pendientes_Borrar_01.php'>I. PENDIENTE BORRA</a></li>
		</ul>
	</li>
	
<!-- Fin GESTIÓN DE INGRESOS -->

<!-- Inicio GESTIÓN DE BALANCES -->

	<li><a href='#' class='MenuBarItemSubmenu'>BALANCES</a>
		<ul>
			<li><a href='".$rutaBalaces."Balances.php'>BALANCE VER</a></li>
			<li><a href='".$rutaIngresos."Ingresos_Ver.php'>BALANCE INGRESO</a></li>
			<li><a href='".$rutaGastos."Gastos_Ver.php'>BALANCE GASTO</a></li>
		</ul>
	</li>
	
<!-- Fin GESTIÓN DE BALANCES -->
 
<!-- Inicio GESTIÓN DE IMPUESTOS -->

	<li><a href='#' class='MenuBarItemSubmenu'>% IMPUESTOS</a>
		<ul>
			<li><a href='".$rutaImpuestos."Impuestos_Ver.php'>IMPUESTOS VER %</a></li>
			<li><a href='".$rutaImpuestos."Impuestos_Crear.php'>IMPUESTOS CREA %</a></li>
			<li><a href='".$rutaImpuestos."Impuestos_Modificar_01.php'>IMPUESTOS MODIF %</a></li>
			<li><a href='".$rutaImpuestos."Impuestos_Borrar_01.php'>IMPUESTOS ELIMINA</a></li>
		</ul>
	</li>
	
<!-- Fin GESTIÓN DE IMPUESTOS -->
 
<!-- Inicio RETENCION -->

	<li><a href='#' class='MenuBarItemSubmenu'>% RETENCIONES</a>
		<ul>
			<li><a href='".$rutaRetencion."retencion_Ver.php'>RETENCION VER</a></li>
			<li><a href='".$rutaRetencion."retencion_Crear.php'>RETENCION CREAR</a></li>
			<li><a href='".$rutaRetencion."retencion_Modificar_01.php'>RETENCION MODIF</a></li>
			<li><a href='".$rutaRetencion."retencion_Borrar_01.php'>RETENCION ELIMINA</a></li>
		</ul>
	</li>
	
<!-- Fin RETENCION -->

<!-- Inicio STATUS EJERCICIOS -->

	<li><a href='#' class='MenuBarItemSubmenu'>STATUS EJERCICIOS</a>
		<ul>
			<li><a href='".$rutaStatus."status_Modificar_01.php'>STATUS MODIFICAR</a></li>
			<li><a href='".$rutaStatus."status_Crear.php'>EJERCICIO CREAR</a></li>
			<li><a href='".$rutaStatus."status_Borrar_01.php'>EJERCICIO ELIMINAR</a></li>
			<li><a href='".$rutaStatus."status_feedback_recuperar_01.php'>FEEDBACK RECUPER</a></li>
			<li><a href='".$rutaStatus."status_feedback_borrar_01.php'>FEEDBACK BORRAR</a></li>
		</ul>
	</li>
	
<!-- Fin STATUS EJERCICIO -->

<!-- Inicio BBDD -->

  <li><a href='".$rutaUpBbdd."bbdd.php'>BACkUP BBDD</a></li>
	
<!-- Fin BBDD -->

 <!-- Inicio NOTIFICACIONES

  <li><a href='#' class='MenuBarItemSubmenu'>NOTIFICACIONES</a>
    <ul>
		<li>
			<a href='Mail_Php/index.php' target='_blank'>
				NOTIFICAR UN ERROR
			</a>
		</li>
 		<li>
			<a href='Mail_Php/index.php' target='_blank'>
				AGRADECIMIENTOS
			</a>
		</li>
     </ul> 
    </li>
-->
<!-- Fin NOTIFICACIONES -->

  	</ul>
  	</li>
  
<!-- FIN MENU ADMINISTRADORES -->
 
  	<li style='text-align:left'>
  		<form name='cerrar' action='".$rutaModAdmin."Admin/mcgexit.php' method='post'>
			<input type='submit' value='CLOSE SESION' class='botonverde' style='margin:0.2em auto 0.2em -0.4em;'/>
			<input type='hidden' name='cerrar' value=1 />
	</form>	
	</li>
	
	</ul>
	
<!-- FIN UL GLOBAL -->
 

<script type='text/javascript'>
<!--
var MenuBar1 = new Spry.Widget.MenuBar('MenuBar1', {imgRight:'MenuVerticalTutor/SpryMenuBarRightHover.gif'});
//-->
</script>

</div>");

	} 
	
?>