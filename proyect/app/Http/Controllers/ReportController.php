<?php namespace App\Http\Controllers;
namespace App\Http\Controllers;
use Illuminate\Http\Request;

// Require PDF class of the library
use PDFMerger;
class ReportController extends Controller{
	public function __construct(){
		$this->middleware('guest');
	}
	public function generar(){
		$reportes = \DB::table('evidencias')->select(['id', 'nombre_archivo', 'tipo_archivo', 'archivo_bin'])->get();

		
		
			print('con');
			
			$pdfFile1Path = public_path() . '{{asset($reportes->archivo_bin) }}';
			$pdf = new PDFMerger();
			$pdf->addPDF($pdfFile1Path, 'all');
			$pdf->merge('download', "mergedpdf.pdf");


		
	
	

		$view = \View::make('reporte', compact('reportes'))->render();
		$pdf = \App::make('dompdf.wrapper');
		$pdf->loadHTML($view);
		$output = $pdf->output();
		file_put_contents(reporte.odf, $output);

	}
}
