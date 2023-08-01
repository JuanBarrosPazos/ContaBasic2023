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

  	<li><a href='#' class='MenuBarItemSubmenu'>ADMINISTRADORES</a>
    <ul>

    <li><a href='../Admin/Admin_Ver.php'>ADMIN CONSULTAR</a></li>  
    <li><a href='../Admin/Admin_Crear.php'>ADMIN CREAR</a></li> 
    <li><a href='../Admin/Admin_Modificar_01.php'>ADMIN MODIFICAR</a></li>
    <li><a href='../Admin/Admin_Borrar_01.php'>ADMIN BORRAR</a></li>

   	</ul>
  	</li>

<!-- Fin MENU ADMINISTRADORES-->
 
<!-- MENU GASTOS PROVEEDORES -->

  	<li><a href='#' class='MenuBarItemSubmenu'>PROVEEDORES</a>
    <ul>

	<li><a href='../cbj_proveedores/proveedores_Ver.php'>PROVEE. CONSULTAR</a></li>  
	<li><a href='../cbj_proveedores/proveedores_Crear.php'>PROVEE. CREAR</a></li> 
	<li><a href='../cbj_proveedores/proveedores_Modificar_01.php'>PROVEE. MODIFICAR</a></li>
	<li><a href='../cbj_proveedores/proveedores_Borrar_01.php'>PROVEE. BORRAR</a></li>

    </ul>
  	</li>

<!-- Fin MENU GASTOS PROVEEDORES -->
	
<!-- MENU INGRESOS PROVEEDORES -->

  	<li><a href='#' class='MenuBarItemSubmenu'>CLIENTES</a>
    <ul>

	<li><a href='../cbj_clientes/clientes_Ver.php'>CLIENTE CONSULTAR</a></li>  
	<li><a href='../cbj_clientes/clientes_Crear.php'>CLIENTE CREAR</a></li> 
	<li><a href='../cbj_clientes/clientes_Modificar_01.php'>CLIENTE MODIFICAR</a></li>
	<li><a href='../cbj_clientes/clientes_Borrar_01.php'>CLIENTE BORRAR</a></li>

    </ul>
 	</li>

<!-- Fin MENU INGRESOS PROVEEDORES-->
 
<!-- Inicio GESTIÓN DE GASTOS -->

  	<li><a href='#' class='MenuBarItemSubmenu'>GASTOS</a>
    <ul>
    
    <li><a href='../cbj_gastos/Gastos_Ver.php'>GASTO CONSULTAR</a></li>
    <li><a href='../cbj_gastos/Gastos_Crear.php'>GASTO CREAR DATOS</a></li>
    <li><a href='../cbj_gastos/Gastos_Modificar_01.php'>GASTO MODIFICAR</a></li>
    <li><a href='../cbj_gastos/Gastos_Borrar_01.php'>GASTO BORRAR</a></li>

    <li><a href='../cbj_gastos/Gastos_Pendientes_Ver.php'>G. PENDIENTE VER</a></li>
    <li><a href='../cbj_gastos/Gastos_Pendientes_Crear.php'>G. PENDIENTE CREAR</a></li>
    <li><a href='../cbj_gastos/Gastos_Pendientes_Modificar_01.php'>G. PENDIENTE MODIF</a></li>
    <li><a href='../cbj_gastos/Gastos_Pendientes_Borrar_01.php'>G. PENDIENTE BORRA</a></li>

    </ul>
  	</li>
	
<!-- Fin GESTIÓN DE GASTOS -->

<!-- Inicio GESTIÓN DE INGRESOS -->

  	<li><a href='#' class='MenuBarItemSubmenu'>INGRESOS</a>
    <ul>
    
    <li><a href='../cbj_ingresos/Ingresos_Ver.php'>INGRESO VER</a></li>
    <li><a href='../cbj_ingresos/Ingresos_Crear.php'>INGRESO CREAR</a></li>
    <li><a href='../cbj_ingresos/Ingresos_Modificar_01.php'>INGRESO MODIFICAR</a></li>
    <li><a href='../cbj_ingresos/Ingresos_Borrar_01.php'>INGRESO ELIMINAR</a></li>

    <li><a href='../cbj_ingresos/Ingresos_Pendientes_Ver.php'>I. PENDIENTE VER</a></li>
    <li><a href='../cbj_ingresos/Ingresos_Pendientes_Crear.php'>I. PENDIENTE CREAR</a></li>
    <li><a href='../cbj_ingresos/Ingresos_Pendientes_Modificar_01.php'>I. PENDIENTE MODIF</a></li>
    <li><a href='../cbj_ingresos/Ingresos_Pendientes_Borrar_01.php'>I. PENDIENTE BORRA</a></li>

    </ul>
	</li>
	
<!-- Fin GESTIÓN DE INGRESOS -->

<!-- Inicio GESTIÓN DE BALANCES -->

	<li><a href='#' class='MenuBarItemSubmenu'>BALANCES</a>
    <ul>
	
	<li><a href='../cbj_Balances/Balances.php'>BALANCE VER</a></li>
	<li><a href='../cbj_ingresos/Ingresos_Ver.php'>BALANCE INGRESO</a></li>
	<li><a href='../cbj_gastos/Gastos_Ver.php'>BALANCE GASTO</a></li>
	
   	</ul>
	</li>
	
<!-- Fin GESTIÓN DE BALANCES -->
 
<!-- Inicio GESTIÓN DE IMPUESTOS -->

<li><a href='#' class='MenuBarItemSubmenu'>% IMPUESTOS</a>
    <ul>
	
	<li><a href='../cbj_impuestos/Impuestos_Ver.php'>IMPUESTOS VER %</a></li>
	<li><a href='../cbj_impuestos/Impuestos_Crear.php'>IMPUESTOS CREA %</a></li>
	<li><a href='../cbj_impuestos/Impuestos_Modificar_01.php'>IMPUESTOS MODIF %</a></li>
	<li><a href='../cbj_impuestos/Impuestos_Borrar_01.php'>IMPUESTOS ELIMINA</a></li>
		
    </ul>
	</li>
	
<!-- Fin GESTIÓN DE IMPUESTOS -->
 
<!-- Inicio RETENCION -->

<li><a href='#' class='MenuBarItemSubmenu'>% RETENCIONES</a>
    <ul>
	
	<li><a href='../cbj_retencion/retencion_Ver.php'>RETENCION VER</a></li>
	<li><a href='../cbj_retencion/retencion_Crear.php'>RETENCION CREAR</a></li>
	<li><a href='../cbj_retencion/retencion_Modificar_01.php'>RETENCION MODIF</a></li>
	<li><a href='../cbj_retencion/retencion_Borrar_01.php'>RETENCION ELIMINA</a></li>

    </ul>
	</li>
	
<!-- Fin RETENCION -->

<!-- Inicio STATUS EJERCICIOS -->

<li><a href='#' class='MenuBarItemSubmenu'>STATUS EJERCICIOS</a>
    <ul>
	
	<li><a href='../cbj_Status/status_Modificar_01.php'>STATUS MODIFICAR</a></li>
	<li><a href='../cbj_Status/status_Crear.php'>EJERCICIO CREAR</a></li>
	<li><a href='../cbj_Status/status_Borrar_01.php'>EJERCICIO ELIMINAR</a></li>
	<li><a href='../cbj_Status/status_feedback_recuperar_01.php'>FEEDBACK RECUPER</a></li>
	<li><a href='../cbj_Status/status_feedback_borrar_01.php'>FEEDBACK BORRAR</a></li>
		
    </ul>
	</li>
	
<!-- Fin STATUS EJERCICIO -->

<!-- Inicio BBDD -->

  <li><a href='bbdd.php'>BACKUP BBDD</a></li>
	
<!-- Fin BBDD -->

 <!-- Inicio NOTIFICACIONES -->

  <li><a href='#' class='MenuBarItemSubmenu'>NOTIFICACIONES</a>
    <ul>
		<li>
		<a href='../Mail_Php/index.php' target='_blank'>
		NOTIFICAR UN ERROR
		</a>
		</li>
 		<li>
		<a href='../Mail_Php/index.php' target='_blank'>
		AGRADECIMIENTOS
		</a>
		</li>
     </ul>
    </li>
	
<!-- Fin NOTIFICACIONES -->

  	</ul>
  	</li>
  
<!-- FIN MENU ADMINISTRADORES -->

  	<li style='text-align:left'>
  				<form name='cerrar' action='../Admin/mcgexit.php' method='post'>
						<input type='submit' value='CLOSE SESION' />
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