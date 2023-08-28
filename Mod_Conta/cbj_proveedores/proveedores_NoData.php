<?php

	global $KeyForm;        global $BotonPaelera;   global $estilo;    global $tituloLoc;

	if($KeyForm == "feed"){
                $BotonPaelera = "";
                $estilo = "";
                $tituloLoc = "PAPELERA PROVEEDORES<br><br>";
	}else{
                $BotonPaelera = "<button type='submit' title='INICIO PAPELERA PROVEEDORES' class='botonverde imgDelete DeleteBlack'><a href='proveedoresFeed_Ver.php' >&nbsp;&nbsp;&nbsp;</a> </button>";
                $estilo = "style='margin-right:0.8em;'";
                $tituloLoc = "PROVEEDORES<br><br>";
	}	

        print ("<table class='tableForm' style='padding:0.6em;' >
                <tr>
                        <th>
                                ".$tituloLoc."
                                <font color='#FF0000'>NO HAY DATOS</font>
                        </th>
                </tr>
                <tr>
                        <th>

                <button type='submit' title='CREAR NUEVO PROVEEDOR' class='botonverde imgDelete PersonAddBlack' style='margin-right:0.8em;'>
                        <a href='proveedores_Crear.php' >&nbsp;&nbsp;&nbsp;</a>
                </button>

                <button type='submit' title='VER TODOS LOS PROVEEDORES' class='botonverde imgDelete PersonsBlack' ".$estilo." >
                        <a href='proveedores_Ver.php' >&nbsp;&nbsp;&nbsp;</a>
                </button>
                ".$BotonPaelera."
                        </th>
                </tr>
                </table>");

?>