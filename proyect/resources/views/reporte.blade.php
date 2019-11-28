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
	<h2>Reporte</h2>
	<table>
		<tr>
			<th>ID</th>
			<th>Nombre</th>
			<th>TIPO</th>
			<th>ARCHIVO</th>
		</tr>
		@foreach($reportes AS $r)
			<tr>
				<!--
				<td>{{ $r->id }}</td>
				<td>{{ $r->nombre_archivo }}</td>
				<td>{{ $r->tipo_archivo }}</td>
				<td><img src="{{asset($r->archivo_bin) }}"></td>
			-->
			


namespace \..\..\App\Http\Controllers;

use Illuminate\Http\Request;

// Require PDF class of the library
use PDFMerger;
		class DefaultController extends Controller
		{
			 public function index(){
			$pdfFile1Path = public_path() . '{{asset($r->archivo_bin) }}';
			$pdf = new PDFMerger();
			$pdf->addPDF($pdfFile1Path, 'all');
			$pdf->merge('download', "mergedpdf.pdf");
		}
	}
		

			</tr>
		@endforeach
	</table>
</body>
</html>