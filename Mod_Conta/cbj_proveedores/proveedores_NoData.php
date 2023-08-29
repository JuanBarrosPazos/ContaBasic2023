<?php

        global $DeleteBlackTit;         $DeleteBlackTit = "INICIO PAPELERA PROVEEDORES";
        global $PersonAddBlacktit;      $PersonAddBlacktit = "CREAR NUEVO PROVEEDOR";
        global $PersonsBlackTit;        $PersonsBlackTit = "VER TODOS LOS PROVEEDORES";
        require '../Inclu/BotoneraVar.php';
        global $closeButton;

	global $KeyForm;        global $BotonPapelera;   global $tituloLoc;

	if($KeyForm == "feed"){
                $BotonPapelera = "";
                $tituloLoc = "PAPELERA PROVEEDORES<br><br>";
	}else{
                $BotonPapelera = $DeleteBlack."<a href='proveedoresFeed_Ver.php' >&nbsp;&nbsp;&nbsp;</a>".$closeButton;
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
                                ".$PersonAddBlack."
                                        <a href='proveedores_Crear.php' >&nbsp;&nbsp;&nbsp;</a>
                                ".$closeButton.$PersonsBlack."
                        <a href='proveedores_Ver.php' >&nbsp;&nbsp;&nbsp;</a>
                                ".$closeButton.$BotonPapelera."
                        </th>
                </tr>
        </table>");

?>