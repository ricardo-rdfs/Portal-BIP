<?php

include(dirname(__FILE__).'/../../config/config.inc.php');
include(dirname(__FILE__).'/../../init.php');

$C_CODIGO = " ORDER BY dacoBip";
$C_TIENDA = " ORDER BY dacoTienda";
$C_PRECIO = " ORDER BY internet";
$C_EMAIL = " ORDER BY dacoEmail";
$C_USUARIO = " ORDER BY dacoUsuario";
$C_FECHA = " ORDER BY dacoFecha";
$C_RELACION = " ORDER BY dacoRelacion";
$C_COMPARACION = " ORDER BY dacoComparacionActiva";
$C_CATEGORIA = " ORDER BY dacoCategoryDefault";
$C_MARCA = " ORDER BY dacoMarca";

$C_ASC = " ASC";
$C_DESC = " DESC";

$queryComboCategoria = " SELECT distinct(dacoCategoryDefault) categoria
			FROM comparadorprecios 
			ORDER BY dacoCategoryDefault ASC";
$resultCategoria = Db::getInstance()->ExecuteS($queryComboCategoria);
			
$queryComboMarca = " SELECT distinct(dacoMarca) marca
			FROM comparadorprecios 
			ORDER BY dacoMarca ASC";
$resultMarca = Db::getInstance()->ExecuteS($queryComboMarca);

$query = "	SELECT cp.*, pl.name name, vpp.internet 
			FROM comparadorprecios cp, ps_product_lang pl, view_prod_price_C vpp
			WHERE pl.id_product = dacoBip
			AND id_lang =3
			AND pl.id_product = vpp.id_product ";
			if(isset($_POST["tienda"])){
				$query.=" AND dacoURL like '%".$_POST["tienda"]."%'";	
			}
			if(isset($_POST["relacion"])){
				$query.=" AND dacoRelacion like '%".$_POST["relacion"]."%'";	
			}
			if(isset($_POST["busId"])){
				$query.=" AND dacoBip like '%".$_POST["busId"]."%'";	
			}
			if(isset($_POST["busNombre"])){
				$query.=" AND pl.name like '%".$_POST["busNombre"]."%'";	
			}
			if(isset($_POST["porvalidar"]) && $_POST["porvalidar"]!= '' ){
				$query.=" AND dacoComparacionActiva =".$_POST["porvalidar"];	
			}
			if(isset($_POST["marca"]) && $_POST["marca"]!= '' ){
				$query.=" AND dacoMarca ='".$_POST["marca"]."'";	
			}
			if(isset($_POST["categoria"]) && $_POST["categoria"]!= '' ){
				$query.=" AND dacoCategoryDefault ='".$_POST["categoria"]."'";	
			}
			if(isset($_POST["orderByHidden"])){
				$query.=" ".$_POST["orderByHidden"];
			}
			if(isset($_POST["theDate1"])&& strlen($_POST["theDate1"])>0 && isset($_POST["theDate2"])&& strlen($_POST["theDate2"])>0 ){
				$query.= " AND DATE(dacoFecha) BETWEEN str_to_date('".$_POST["theDate1"]."','%e/%m/%Y') AND str_to_date( '".$_POST["theDate2"]."','%e/%m/%Y') ";
			}elseif((isset($_POST["theDate1"])&& strlen($_POST["theDate1"])>0) || (isset($_POST["theDate2"])&& strlen($_POST["theDate2"])>0)){
				?><SCRIPT LANGUAGE="javascript">alert('Para hacer una búsqueda por fecha, debe seleccionar ambas fechas'); </SCRIPT> 
				  <SCRIPT LANGUAGE="javascript">location.href = "adminComparador.php"; </SCRIPT>
				<?php
			}
$resultLineas = Db::getInstance()->ExecuteS($query);

function ascODesc($orderBy,$ascDesc){
	if(!strpos($ascDesc, " DESC") === false){
		return ($orderBy." ASC");
	}else{
		return ($orderBy." DESC");
	}
	return "";
}

function orderBy($orderBy,$orderPost){
	$ascDesc = trim(substr($orderPost, strlen($orderPost)-6));
	return ascODesc($orderBy,$ascDesc);
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" rel="stylesheet" href="'._PS_JS_DIR_.'jquery/datepicker/datepicker.css" />
<title>Comparador</title>
<link type="text/css" rel="stylesheet" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css" media="screen"></LINK>
<SCRIPT type="text/javascript" src="./dhtmlgoodies_calendar/dhtmlgoodies_calendar.js"></script>
<script language="javascript" type="text/javascript">
function calculaLargo() { 
	var elLargo=document.body.scrollHeight;
	window.parent.document.getElementById('ZONE1').height=elLargo+50; 
} 

function checkUnckeck(checksEliminar, status){
	for(var i = 0; i<checksEliminar.length; i++){
		checksEliminar[i].checked = status;
	}
}

function seleccionarTodo() {
	checkUnckeck(document.getElementsByName('checkEliminar[]'),document.getElementById("selTodo").checked);
} 


function seguroEliminar(producto, dacoId) { 
	if(confirm('¿Seguro desea eliminar la comparación del artículo '+producto+' ?')){
		location.href = 'ajaxResponse.php?idConsulta=3&dacoId='+dacoId;
	}
} 

function botonOk(dacoId){
	location.href = "ajaxResponse.php?idConsulta=2&dacoId="+dacoId;
}

function seguroEliminarMasivo() { 
	var checksEliminar = document.getElementsByName('checkEliminar[]');
	var clickeados = 0;
	for(var i = 0; i<checksEliminar.length; i++){
		if(checksEliminar[i].checked){
			clickeados++;
		}
		
	}
	if(clickeados > 0){
		if(confirm('¿Esta seguro que desea eliminar las '+ clickeados +' comparaciones seleccionadas?')){
			parametros = "";
			for(var i = 0; i<checksEliminar.length; i++){
				if(checksEliminar[i].checked){
					parametros+= checksEliminar[i].value+"aaa";
				}
			}
			parametros+="-1";
			location.href = "ajaxResponse.php?idConsulta=4&dacoId="+parametros;
		}
	}else{
		alert('No hay registros seleccionados');
	}
} 
function actionCheck(dacoId){
	var ajaxObject = seConnect(dacoId);
	var url="<?php echo __PS_BASE_URI__; ?>modules/comparadordeprecios/ajaxResponse.php";
	var params = "?idConsulta=1";
	if (ajaxObject){	
		try{
		   var status = (document.getElementById("checkValido"+dacoId).checked?"1":"0");
		   
		   var selectRelacion = document.getElementById("relacion"+dacoId);
			var selectedIndex = selectRelacion.selectedIndex;
			var valorRelacion = selectRelacion.options[selectedIndex].value;
			
		   params+="&dacoId="+dacoId;
		   params+="&newStatus="+status;
		   params+="&dacoRelacion="+valorRelacion;
		   	
		   
		   ajaxObject.open("GET", url+params, true);
		   ajaxObject.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		   ajaxObject.setRequestHeader("Content-length", params.length);
		   ajaxObject.setRequestHeader("Connection", "close");            
		   ajaxObject.send(null);
		   if(status==1){
		   		document.getElementById("boton"+dacoId).disabled=false;
				
		   }else{
		   		document.getElementById("boton"+dacoId).disabled=true;
		   }
		   
		   selectRelacion.style.display='none';
		   document.getElementById("relacionTexto"+dacoId).style.display='block';
		   document.getElementById("relacionTexto"+dacoId).innerHTML= valorRelacion;
		   
		}catch(err){        
			alert("Problema al cambiar el estado");
		}
	}
}

var pkgAjaxObject=new Array();
function seConnect(objIndex){
    if(pkgAjaxObject[objIndex] == undefined){  
		if (window.XMLHttpRequest){
			pkgAjaxObject[objIndex] = new XMLHttpRequest();	
		}else{     
		  if (window.ActiveXObject){         
			try{
				pkgAjaxObject[objIndex] = new ActiveXObject("Microsoft.XMLHTTP");
			}catch (e){
				pkgAjaxObject[objIndex]=null;
				alert("Could not create wa.XMLHTTP Object");
			}
		  }
		}
    }   
    return pkgAjaxObject[objIndex];    
}

function cambioRelacion(numeroId){
	var selectRelacion = document.getElementById("relacion"+numeroId);
	var selectedIndex = selectRelacion.selectedIndex;
	var valorRelacion = selectRelacion.options[selectedIndex].value;
	
	if(valorRelacion==''){
		document.getElementById("checkValido"+numeroId).disabled = true;
		document.getElementById("checkValido"+numeroId).checked = false;
		document.getElementById("boton"+numeroId).disabled = true;
	}else{
		document.getElementById("checkValido"+numeroId).disabled = false;
	}
}

function cambiarOrderBy($orderBy){
	document.getElementById("orderByHidden").value = $orderBy;
	
}
</script>
<style type="text/css">
<!--
.precioBipIgual {
	background-color: #FFC;
}
.precioBipMayor {
	background-color: #FCC;
}
.precioBipMenor {
	background-color: #9FC;
}
.btnVolver {
	background-color: #FFF6D3;
	border-color: #FFF6D3 #DFD5AF #DFD5AF #FFF6D3;
	border-right: 1px solid #DFD5AF;
	border-style: solid;
	border-width: 1px;
	color: #268CCD;
	padding: 3px;
}
a.lknombreColumna {
	font-family: Arial, Helvetica, sans-serif;
	font-size:10px;
	color:green;
	background-color:#F4E6C9;
	text-decoration:none;
}
select.filtros {
	font-family: Arial, Helvetica, sans-serif;
	font-size:10px;
	color:#000;
	background-color:#FFFFFF;
	text-decoration:none;
	width:100px;
}
-->
</style>
</head>

<body>
<input type="button" value="Volver" onClick="location.href = 'comparacionPreciosIndex.php';" class="btnVolver"/>
<form action="adminComparador.php" enctype="multipart/form-data" autocomplete="off" id="buscarForm" name="buscarForm" method="post">
  <input type="hidden" id="orderByHidden" name="orderByHidden" value="<?php echo $orderBy; ?>"/>
  <table cellpadding="0" cellspacing="0" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#060; background-color:#FFFFFF; width:100%; height:35px;">
    </tr>
       <td width="31">Desde</td>
     <td width="121"><input type="text" readonly="readonly" id="theDate1" name="theDate1" size="15" class="texto2" value="<?php echo (isset($_POST["theDate1"])?$_POST["theDate1"]:''); ?>"/> <script language="javascript"> if(document.getElementById("theDate1").value==""){ document.getElementById("theDate1").value = obtenerFechaActual();}</script>
         <a href="#" onClick="displayCalendar(document.forms[0].theDate1,'dd/mm/yyyy',this)"><img src="dhtmlgoodies_calendar/imagenes/dtpick.gif" alt="Buscar Fecha" border="0" /></a></td>
      <td width="8"></td>
      <td width="57">Hasta</td>
<td width="96"><input type="text" readonly="readonly" id="theDate2" name="theDate2" size="15" class="texto2" value="<?php echo (isset($_POST["theDate2"])?$_POST["theDate2"]:''); ?>"/> <script language="javascript"> if(document.getElementById("theDate2").value==""){ document.getElementById("theDate2").value = obtenerFechaActual();}</script>
         <a href="#" onClick="displayCalendar(document.forms[0].theDate2,'dd/mm/yyyy',this)"><img src="dhtmlgoodies_calendar/imagenes/dtpick.gif" alt="Buscar Fecha" border="0" /></a></td>
      <td width="60"></td>
      <td width="38">Tienda: </td>
      <td width="100"><select name="tienda" id="tienda" class="filtros">
          <option value="" <?php echo (!isset($_POST["tienda"]))?'selected':''; ?>> Todas </option>
          <option value=".corona" <?php echo (isset($_POST["tienda"]) && $_POST["tienda"]=='.corona')?'selected':''; ?>> Corona </option>
          <option value=".falabella" <?php echo (isset($_POST["tienda"]) && $_POST["tienda"]=='.falabella')?'selected':''; ?>> Falabella </option>
          <option value=".paris" <?php echo (isset($_POST["tienda"]) && $_POST["tienda"]=='.paris')?'selected':''; ?>> Paris </option>
          <option value=".pcfactory" <?php echo (isset($_POST["tienda"]) && $_POST["tienda"]=='.pcfactory')?'selected':''; ?>> PC Factory </option>
          <option value=".ripley" <?php echo (isset($_POST["tienda"]) && $_POST["tienda"]=='.ripley')?'selected':''; ?>> Ripley </option>
          <option value=".wei" <?php echo (isset($_POST["tienda"]) && $_POST["tienda"]=='.wei')?'selected':''; ?>> WEI</option>
        </select></td>
      <td width="10"></td>
      <td width="47">Relaci&oacute;n: </td>
      <td width="100"><select name="relacion" id="relacion" class="filtros">
          <option value="" <?php echo (!isset($_POST["relacion"]))?'selected':''; ?>> Todos </option>
          <option value="Idéntico" <?php echo (isset($_POST["relacion"]) && $_POST["relacion"]=='Idéntico')?'selected':''; ?>> Similar </option>
          <option value="Similar" <?php echo (isset($_POST["relacion"]) && $_POST["relacion"]=='Similar')?'selected':''; ?>> Id&eacute;ntico </option>
        </select></td>
      <td width="10"></td>
      <td width="42">V&aacute;lidos: </td>
      <td width="100"><select name="porvalidar" id="porvalidar" class="filtros">
          <option value="" <?php echo (!isset($_POST["porvalidar"]))?'selected':''; ?>> Todos </option>
          <option value="0" <?php echo (isset($_POST["porvalidar"]) && $_POST["porvalidar"]=='0')?'selected':''; ?>> Inactivos </option>
          <option value="1" <?php echo (isset($_POST["porvalidar"]) && $_POST["porvalidar"]=='1')?'selected':''; ?>> Activos </option>
        </select></td>
      <td width="63" align="right"><input type="submit" value="Buscar" name="Buscar" id="Buscar" class="btnVolver"/></td>
    </tr>
    <tr>
    	<td>Id</td>
        <td><input type="text" id="busId" name="busId" value="<?php echo (isset($_POST["busId"])?mysql_real_escape_string(htmlspecialchars($_POST["busId"])):''); ?>" /></td>
        <td></td>
        <td>Nombre</td>
        <td><input type="text" id="busNombre" name="busNombre" value="<?php echo (isset($_POST["busNombre"])?mysql_real_escape_string(htmlspecialchars($_POST["busNombre"])):''); ?>" /></td>
        <td></td>
        <td>Marca</td>
        <td><select name="marca" id="marca" class="filtros">
          <option value="" <?php echo (!isset($_POST["marca"]))?'selected':''; ?>> Todas </option>
          <?php 
		  	foreach($resultMarca as $marca){
		  ?>
          	<option value="<?php echo $marca["marca"]; ?>" <?php echo (isset($_POST["marca"]) && $_POST["marca"]==$marca["marca"])?'selected':''; ?>><?php echo $marca["marca"]; ?> </option>
          <?php
			}
		  ?>
          </select>
          </td>
        <td></td>
        <td>Categor&iacute;a</td>
        <td><select name="categoria" id="categoria" class="filtros">
          <option value="" <?php echo (!isset($_POST["categoria"]))?'selected':''; ?>> Todas </option>
          <?php 
		  	foreach($resultCategoria as $categoria){
		  ?>
          	<option value="<?php echo $categoria["categoria"]; ?>" <?php echo (isset($_POST["categoria"]) && $_POST["categoria"]==$categoria["categoria"])?'selected':''; ?>><?php echo $categoria["categoria"]; ?> </option>
          <?php
			}
		  ?>
          </select></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr >
      <td colspan="14">Se han encontrado <?php echo sizeof($resultLineas); ?> registros.</td>
    <tr>
  </table>
</form>
<table border="0" cellpadding="2" cellspacing="1" style="border:1px solid #DFD5C3; width:100%;">
  <tr style="font-family: Arial, Helvetica, sans-serif; font-size:10px; color:green; background-color:#F4E6C9;">
    <td><input type="checkbox" name="selTodo" id="selTodo" onClick="seleccionarTodo()" /></td>
    <td><a class="lknombreColumna" href="#" onClick="cambiarOrderBy('<?php echo orderBy($C_CODIGO,(!isset($_POST["orderByHidden"])?$C_CODIGO:$_POST["orderByHidden"])); ?>'), document.getElementById('Buscar').click();"> C&oacute;digo <img src="down.gif" width="9" height="9" alt="Ordenar" border="0" /></a></td>
    <td><a class="lknombreColumna" href="#" onClick="cambiarOrderBy('<?php echo orderBy($C_TIENDA,(!isset($_POST["orderByHidden"])?$C_TIENDA:$_POST["orderByHidden"])); ?>'), document.getElementById('Buscar').click();">Tienda <img src="down.gif" width="9" height="9" alt="Ordenar" border="0" /></a></td>
    <td><a class="lknombreColumna" href="#" onClick="cambiarOrderBy('<?php echo orderBy($C_CATEGORIA,(!isset($_POST["orderByHidden"])?$C_CATEGORIA:$_POST["orderByHidden"])); ?>'), document.getElementById('Buscar').click();">Categoria <img src="down.gif" width="9" height="9" alt="Ordenar" border="0" /></a></td>
    <td><a class="lknombreColumna" href="#" onClick="cambiarOrderBy('<?php echo orderBy($C_MARCA,(!isset($_POST["orderByHidden"])?$C_MARCA:$_POST["orderByHidden"])); ?>'), document.getElementById('Buscar').click();">Marca <img src="down.gif" width="9" height="9" alt="Ordenar" border="0" /></a></td>
    <td>Nombre</td>
    <td><a class="lknombreColumna" href="#" onClick="cambiarOrderBy('<?php echo orderBy($C_PRECIO,(!isset($_POST["orderByHidden"])?$C_PRECIO:$_POST["orderByHidden"])); ?>'), document.getElementById('Buscar').click();">Precio BIP <img src="down.gif" width="9" height="9" alt="Ordenar" border="0" /></a></td>
    <td><a class="lknombreColumna" href="#" onClick="cambiarOrderBy('<?php echo orderBy($C_EMAIL,(!isset($_POST["orderByHidden"])?$C_EMAIL:$_POST["orderByHidden"])); ?>'), document.getElementById('Buscar').click();">E mail <img src="down.gif" width="9" height="9" alt="Ordenar" border="0" /></a></td>
    <td><a class="lknombreColumna" href="#" onClick="cambiarOrderBy('<?php echo orderBy($C_USUARIO,(!isset($_POST["orderByHidden"])?$C_USUARIO:$_POST["orderByHidden"])); ?>'), document.getElementById('Buscar').click();">Usuario <img src="down.gif" width="9" height="9" alt="Ordenar" border="0" /></a></td>
    <td><a class="lknombreColumna" href="#" onClick="cambiarOrderBy('<?php echo orderBy($C_FECHA,(!isset($_POST["orderByHidden"])?$C_FECHA:$_POST["orderByHidden"])); ?>'), document.getElementById('Buscar').click();">Fecha <img src="down.gif" width="9" height="9" alt="Ordenar" border="0" /></a></td>
    <td>URL</td>
    <td><a class="lknombreColumna" href="#" onClick="cambiarOrderBy('<?php echo orderBy($C_RELACION,(!isset($_POST["orderByHidden"])?$C_RELACION:$_POST["orderByHidden"])); ?>'), document.getElementById('Buscar').click();">Relaci&oacute;n <img src="down.gif" width="9" height="9" alt="Ordenar" border="0" /></a></td>
    <td>¿V&aacute;lida?</td>
    <td><a class="lknombreColumna" href="#" onClick="cambiarOrderBy('<?php echo orderBy($C_COMPARACION,(!isset($_POST["orderByHidden"])?$C_COMPARACION:$_POST["orderByHidden"])); ?>'), document.getElementById('Buscar').click();">Precio <img src="down.gif" width="9" height="9" alt="Ordenar" border="0" /></a></td>
    <td>Comparar</td>
    <td width="25px" align="center">Estado</td>
  </tr>
  <?php foreach($resultLineas as $linea){ ?>
  <tr style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000000; background-color:#FFFFFF;">
    <td class="txtcampos"><input type="checkbox" name="checkEliminar[]" id="checkEliminar[]" value="<?php echo $linea['dacoId']; ?>" /></td>
    <td class="txtcampos"><?php echo $linea['dacoBip']; ?></td>
    <td ><?php echo (($linea['dacoTienda']==null || $linea['dacoTienda']=="")?'No Comprobado':$linea['dacoTienda']); ?></td>
    <td class="txtcampos"><?php echo $linea['dacoCategoryDefault']; ?></td>
    <td class="txtcampos"><?php echo $linea['dacoMarca']; ?></td>
    <td class="txtcampos"><?php echo $linea['name']; ?></td>
    <td class="txtcampos"><?php echo number_format($linea['internet'],0,',','.'); ?></td>
    <td class="txtcampos"><?php echo $linea['dacoEmail']; ?></td>
    <td class="txtcampos"><?php echo $linea['dacoUsuario']; ?></td>
    <td class="txtcampos"><?php echo $linea['dacoFecha']; ?></td>
    <td class="txtcampos"><a href="<?php echo $linea['dacoURL']; ?>" target="_blank"><?php echo $linea['dacoURL']; ?></a></td>
    <td class="txtcampos"><select style="display:<?php echo $linea['dacoRelacion']==''?'inline':'none'; ?>" name="relacion<?php echo $linea['dacoId']; ?>" id="relacion<?php echo $linea['dacoId']; ?>" onChange="cambioRelacion(<?php echo $linea['dacoId']; ?>);" class="filtros">
        <option value="" <?php echo $linea['dacoRelacion']==''?'selected':''; ?>> No seleccionado </option>
        <option value="Idéntico" <?php echo $linea['dacoRelacion']=='Idéntico'?'selected':''; ?>> Id&eacute;ntico </option>
        <option value="Similar" <?php  echo $linea['dacoRelacion']=='Similar'?'selected':''; ?>> Similar </option>
      </select>
      <div id="relacionTexto<?php echo $linea['dacoId']; ?>"><?php echo $linea['dacoRelacion'];?></div></td>
    <td class="txtcampos"><input type="checkbox" onClick="actionCheck('<?php echo $linea['dacoId']; ?>')" name="checkValido<?php echo $linea['dacoId']; ?>" id="checkValido<?php echo $linea['dacoId']; ?>" <?php echo ($linea['dacoComparacionActiva']==0?'':'checked="checked"'); ?> <?php echo $linea['dacoRelacion']==''?'disabled="disabled"':''; ?>/>
      <br />
      <a href="#" onClick="seguroEliminar('<?php echo $linea['name']; ?>',<?php echo $linea['dacoId']; ?>)" > Eliminar </a></td>
    <td class="txtcampos"><?php echo number_format($linea['dacoPrecioComparacion'],0,',','.'); ?></td>
    <td class="txtcampos"><input id="boton<?php echo $linea['dacoId']; ?>" type="button" value="OK" onClick="botonOk('<?php echo $linea['dacoId']; ?>');" <?php echo ($linea['dacoComparacionActiva']!=0?'':'disabled="disabled"'); ?> class="btnVolver" /></td>
    <td class="txtcampos"><img src="<?php echo "".($linea['dacoFuncionando']==0?"alerta.png":"semaforo_verde.png"); ?>"></td>
  </tr>
  <?php  } ?>
</table>
<p style="margin: 0.5em 0 0; padding: 0 0 0.5em;">
  <input type="button" value="Borrar la selección" onClick="seguroEliminarMasivo()" class="btnVolver"/>
</p>
</body>
<script language="javascript" type="text/javascript">
calculaLargo();
</script>
</html>