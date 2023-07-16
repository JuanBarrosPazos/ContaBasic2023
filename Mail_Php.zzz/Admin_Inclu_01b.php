<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html" charset="utf-8" />
<meta http-equiv="Content-Language" content="es-es">
<META NAME="Language" CONTENT="Spanish">

<meta name="description" content="Juan Barros Pazos" />

<meta name="keywords" content="Juan Barros Pazos" />
<meta name="robots" content="all, index, follow" />

<meta name="audience" content="All" />

<title>Juan Barros Pazos. Contactos</title>

<link href="Descargas.css" rel="stylesheet" type="text/css" />
<link href="favicon.ico" type='image/ico' rel='shortcut icon' />

<script type="text/JavaScript">
<!--
// Esta función limita el número de carácteres del text area de comentarios.
function limita(elEvento, maximoCaracteres) {
  var elemento = document.getElementById("mensaje");
 
  // Obtener la tecla pulsada 
  var evento = elEvento || window.event;
  var codigoCaracter = evento.charCode || evento.keyCode;
  // Permitir utilizar las teclas con flecha horizontal
  if(codigoCaracter == 37 || codigoCaracter == 39) {
    return true;
  }
 
  // Permitir borrar con la tecla Backspace y con la tecla Supr.
  if(codigoCaracter == 8 || codigoCaracter == 46) {
    return true;
  }
  else if(elemento.value.length >= maximoCaracteres ) {
    return false;
  }
  else {
    return true;
  }
}
 
function actualizaInfo(maximoCaracteres) {
  var elemento = document.getElementById("mensaje");
  var info = document.getElementById("info");
 
  if(elemento.value.length >= maximoCaracteres ) {
    info.innerHTML = "Máximo "+maximoCaracteres+"caracteres";
  }
  else {
    info.innerHTML = "You can write up to "+(maximoCaracteres-elemento.value.length)+" additional characters";
  }
}
// Tendremos que dar el id que tenga el text area y añadir onkeypress="return limita(event, 200);" onkeyup="actualizaInfo(200)" para limitar los caracteres a 200 en este caso.
function MM_validateForm() { //v4.0
  if (document.getElementById){
    var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
    for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=document.getElementById(args[i]);
      if (val) { nm=val.name; if ((val=val.value)!="") {
        if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
          if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';
        } else if (test!='R') { num = parseFloat(val);
          if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
          if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
            min=test.substring(8,p); max=test.substring(p+1);
            if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
      } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' is required.\n'; }
    } if (errors) alert('The following error(s) occurred:\n'+errors);
    document.MM_returnValue = (errors == '');
} }
//-->
</script>
<style type="text/css">
<!--
.Estilo1 {color: #FFFFFF}
-->
#absolut {
	position: absolute;
	top: -2000px;
	width: 800px;
}
</style>


</head>

<body topmargin="0">
<div id="Conte">

  <div id="head" style="padding-bottom:12px; padding-top:6px">
  			<font style="font-family:'Times New Roman', Times, serif; font-size:24px">
  				<?php 
				$title = $_SESSION['title'];
				print("".strtoupper($title)."."); ?>
            </font>
  	<br />
			<font style="font-family:'Times New Roman', Times, serif; font-size:16px">
  				<?php print("".$_SESSION['tdir'].$_SESSION['tmail'].$_SESSION['ttlf']); ?>
          	</font>
 </div>

  	<div style="clear:both"></div>
   
   <div id="TitTut" style="margin-top:12px; text-align:center; font-family:'Times New Roman', Times, serif; font-size:18px">
   
        <font color="#59746A">
					<strong> <i>
		               FORMULARIO DE CONTACTO, GRACIAS.
            		</i></strong>
    	</font>

	        <br />

	</div>

	  <div style="clear:both"></div>
        

  <div id="Caja2Admin">


