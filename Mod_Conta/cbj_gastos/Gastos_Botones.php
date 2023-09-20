<?php
    
    global $dyt1;	global $db;     global $db_name;

    if((isset($dyx))&&($dyx != '')){
        $dyt1 = "20".$dyx;
    }elseif((!isset($dyt1))&&($dyt1 == '')){	
        $dyt1 = date('Y');
    }else{ }

    global $selBotones;

    if((isset($_POST['id']))&&(@$_POST['id'] != '')){
        $selBotones = " WHERE `id` = '$_POST[id]' ";
    }elseif((isset($_SESSION['miid']))&&($_SESSION['miid'] != '')){
        $selBotones = " WHERE `id` = '$_SESSION[miid]' ";
    }else{ $selBotones = " ORDER BY `id` DESC "; }

    global $db; 	global $db_name;	global $vnameBot;   global $vname;      global $rutPend;
    global $papelera;

    switch (true) {
        case ($papelera== '1'):
            $vnameBot = "`".$_SESSION['clave']."gastosfeed`";
            break;
        case ($rutPend == 'Pendientes_'):
            $vnameBot = "`".$_SESSION['clave']."gastos_pendientes`";
            global $PendienteG;		$PendienteG = "style='display:none; visibility: hidden;'";
            break;
        case ((isset($_POST['vname']))&&(strlen(trim($_POST['vname'])) != 0)):
            $vnameBot = $_POST['vname'];
            break;
        case ($vname!=''):
            $vnameBot = $vname;
            break;
        /*
        case ((isset($_SESSION['vname']))&&(strlen(trim(@$_SESSION['vname'])) != 0)):
            $vnameBot = @$_SESSION['vname'];
            break;
        */
        default:
            //echo "** NO SE CUMPLE NADA ** <br>";
            $vnameBot = "`".$_SESSION['clave']."gastos_".date('Y')."`";
            $vname = $vnameBot;
            break;
    } // FIN SWITCH CASE

    //echo "*_* ".$vname."<br>";
    //echo "*-* ".$vnameBot."<br>";
    global $sqlBot;		$sqlBot = "SELECT * FROM `$db_name`.$vnameBot $selBotones LIMIT 1 ";
    //echo "** ".$rutPend;
    echo "<br>-*- ".$sqlBot."<br>";
    $qBot = mysqli_query($db, $sqlBot);
    $countBot = mysqli_num_rows($qBot);
    $rowb = mysqli_fetch_assoc($qBot);
    //echo "** ".@$rowb['id']."<br>";

    print("<div ".$ConteBotones." ><!-- INICIO DIV CONTENEDOR -->");

    // INICIO SI ES LA PAPELERA DE GASTOS
    if($papelera == 1){

        print("<div ".$Ver2.">
        <form name='ver2' action='Gastos_Papelera_Ver.php' method='POST' style='display:inline-block;'>");

        require 'Gastos_rowb_Total.php';

        print($DetalleBlack.$closeButton."
                <input type='hidden' name='ocultoDetalle' value=1 />
        </form>
        </div>

        <div ".$Borrar2.">
        <form name='modifica' action='Gastos_Papelera_Borrar.php' method='POST' style='display:inline-block;' >");

        require 'Gastos_rowb_Total.php';

        print($DeleteWhite.$closeButton."
                <input type='hidden' name='oculto2' value=1 />
            </form>
        </div>
        <div ".$Recupera3.">
        <form name='modifica' action='Gastos_Papelera_Recuperar.php' method='POST' style='display:inline-block;' >");

        require 'Gastos_rowb_Total.php';

        print($RestoreBlack.$closeButton."
                <input type='hidden' name='oculto2' value=1 />
            </form>
            </div>

            <div style='display:inline-block;' >
                ".$CancelBlack."
                    <a href='Gastos_Papelera_Ver.php' >&nbsp;&nbsp;&nbsp;</a>
                ".$closeButton."
            </div>");
            
    }else{ // INICIO SI NO ES LA PAPELERA DE GASTOS
        print("<div ".$Crear.">
                    ".$AddBlack."
                        <a href='Gastos_".$rutPend."Crear.php' >&nbsp;&nbsp;&nbsp;</a>
                    ".$closeButton."
                </div>

                <div class='BorderIzd BorderDch'  style='display:inline-block;' >
                    ".$MoneypGrey."
                        <a href='Gastos_Ver.php' >&nbsp;&nbsp;&nbsp;</a>
                    ".$closeButton."

                    ".$MoneypWhite."
                        <a href='Gastos_Pendientes_Ver.php' >&nbsp;&nbsp;&nbsp;</a>
                    ".$closeButton."
                </div>
                
                <div ".$Ver2.">
                    <form name='ver2' action='Gastos_".$rutPend."Ver.php' method='POST' style='display:inline-block;'>");

                    require 'Gastos_rowb_Total.php';

                    print($DetalleBlack.$closeButton."
                            <input type='hidden' name='ocultoDetalle' value=1 />
                    </form>
                </div>

                <div ".$ModImg2.">
                    <form name='ver' action='Gastos_".$rutPend."Ver.php' method='POST'>");

                    require 'Gastos_rowb_Total.php';

                    print($FotoBlack.$closeButton."
                                <input type='hidden' name='oculto2' value=1 />
                    </form>
                </div>

                <div ".$Modif2.">
                    <form name='modifica' action='Gastos_".$rutPend."Modificar_02.php' method='POST' >");

                    require 'Gastos_rowb_Total.php';

                    print($DatosBlack.$closeButton."
                                <input type='hidden' name='oculto2' value=1 />
                            </form>
                </div>
        
                <div ".$PendienteG.">
                    <form name='modifica' action='Gastos_Modificar_03.php' method='POST'>");

                    require 'Gastos_rowb_Total.php';

                    print($MoneyWhite.$closeButton."
                            <input type='hidden' name='oculto2' value=1 />
                    </form>
                </div>

                <div ".$Borrar2.">
                    <form name='borrar' action='Gastos_".$rutPend."Borrar.php' method='POST' >");

                    require 'Gastos_rowb_Total.php';
                    
                    print($DeleteWhite.$closeButton."
                            <input type='hidden' name='oculto2' value=1 />
                    </form>
                </div>");

            if($rutPend == 'Pendientes_'){

                print("<div ".$Recupera3.">
                <form name='modifica' action='Gastos_Pendientes_Modificar_03.php' method='POST'>");

                require 'Gastos_rowb_Total.php';

                print($MoneyBlack.$closeButton."
                        <input type='hidden' name='oculto2' value=1 />
                        </form>
                    </div>");

            }else{ }

                print("<div class='BorderIzd BorderDch' style='display:inline-block;' >
                            ".$CancelBlack."
                                <a href='Gastos_".$rutPend."Ver.php' >&nbsp;&nbsp;&nbsp;</a>
                            ".$closeButton."
                        </div>");

    } // FIN SI NO ES LA PAPELERA DE GASTOS

	print("</div><!-- FIN DIV CONTENEDOR -->");

?>