<!DOCTYPE html>
<html>
<title>Reporte</title>
<head>
	<style>
		table{
			font-family: arial, sans-serif;
			border-collapse: collapse;
			width: 100%;
		}
		td, th{
			border: 1px solid #dddddd;
			text-align: left;
			padding: 8px;
		}
		tr:nth-child(even){
			background-color: #dddddd;
		}
		.center-embed {
        	display: block;
        	margin: auto;
    	}
	</style>
</head>
<body>
@foreach($reportes AS $r)
	<?php
		if($r->tipo_archivo != 'pdf'){
	?>
		<img class="center-embed" src="{{public_path().$r->archivo_bin}}">
	<?php

		}
	?>
@endforeach
<!--
	<table>
		<tr>
			<th>ID</th>
			<th>Nombre</th>
			<th>TIPO</th>
			<th>ARCHIVO</th>
		</tr>
	</table>
-->
</body>
</html>