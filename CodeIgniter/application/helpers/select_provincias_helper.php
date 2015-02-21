<?php
/**
 * Crea la etiqueta select con la lista de provincias
 * @param string $name Nombre del campo
 * @param array $opciones Opciones que tiene el select
 * 			clave array=valor option
 * 			valor array=texto option
 * @param string $valorDefecto Valor seleccionado
 * @return string
 */
function CreaSelect($name, $opciones, $valorDefecto, $atributos='')
{
	$html="\n".'<select name="'.$name.'" '.$atributos.'>';
	foreach($opciones as $value)
	{
		if ($value==$valorDefecto)
			$select='selected="selected"';
		else
			$select="";
		$html.= "\n\t<option value=".$value['codigo']." ".$select.">".$value['nombre']."</option>";
	}
	$html.="\n</select>";

	return $html;
}