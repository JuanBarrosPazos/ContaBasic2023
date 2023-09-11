<?php
    
    global $dyt1;		
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

    global $db; 	global $db_name;	global $vnameBot; global $vname;      global $rutPend;
    if($rutPend == 'Pendientes_'){
        $vnameBot = "`".$_SESSION['clave']."gastos_pendientes`";
    }else{
     	$vnameBot = $vname;
    }
    
    global $sqlBot;		$sqlBot = "SELECT * FROM `$db_name`.$vnameBot $selBotones LIMIT 1";
    //echo "** ".$rutPend;
    //echo "-- ".$sqlBot."<br>";
    $qBot = mysqli_query($db, $sqlBot);
    $countBot = mysqli_num_rows($qBot);
    $rowb = mysqli_fetch_assoc($qBot);
    //echo "** ".@$rowb['id']."<br>";

    print("<div ".$ConteBotones." ><!-- INICIO DIV CONTENEDOR -->

    <div ".$Crear.">
            ".$AddBlack."
				<a href='Gastos_".$rutPend."Crear.php' >&nbsp;&nbsp;&nbsp;</a>
			".$closeButton."
    </div>
            ".$MoneypGrey."
				<a href='Gastos_Ver.php' >&nbsp;&nbsp;&nbsp;</a>
			".$closeButton."

            ".$MoneypWhite."
				<a href='Gastos_Pendientes_Ver.php' >&nbsp;&nbsp;&nbsp;</a>
			".$closeButton."

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
   
	<div ".$Borrar2.">
        <form name='borrar' action='Gastos_".$rutPend."Borrar_02.php' method='POST' >");

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

    print($CancelBlack."
				<a href='Gastos_".$rutPend."Ver.php' >&nbsp;&nbsp;&nbsp;</a>
			".$closeButton."

	</div><!-- FIN DIV CONTENEDOR -->");

?>