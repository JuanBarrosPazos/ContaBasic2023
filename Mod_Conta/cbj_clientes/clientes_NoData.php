<?php

	global $KeyForm;        global $BotonPaelera;   global $estilo;    global $tituloLoc;

	if($KeyForm == "feed"){
                $BotonPaelera = "";
                $estilo = "";
                $tituloLoc = "PAPELERA CLIENTES<br><br>";
	}else{
                $BotonPaelera = "<button type='submit' title='INICIO PAPELERA CLIENTES' class='botonverde imgDelete DeleteBlack'><a href='clientesFeed_Ver.php' >&nbsp;&nbsp;&nbsp;</a> </button>";
                $estilo = "style='margin-right:0.8em;'";
                $tituloLoc = "CLIENTES<br><br>";
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

                <button type='submit' title='CREAR NUEVO CLIENTE' class='botonverde imgDelete PersonAddBlack' style='margin-right:0.8em;'>
                        <a href='clientes_Crear.php' >&nbsp;&nbsp;&nbsp;</a>
                </button>

                <button type='submit' title='VER TODOS LOS CLIENTES' class='botonverde imgDelete PersonsBlack' ".$estilo." >
                        <a href='clientes_Ver.php' >&nbsp;&nbsp;&nbsp;</a>
                </button>
                ".$BotonPaelera."
                        </th>
                </tr>
                </table>");

?>