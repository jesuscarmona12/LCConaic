<?php

namespace App\Http\Controllers;
use App\Http\Controllers\LynX39\LaraPdfMerger\PdfManage;
use LynX39\LaraPdfMerger\Facades\PdfMerger;
use Illuminate\Http\Request;
use App\Evidencia;
use PDF;

class ReportController extends Controller{

		
	
	public function generar(){
		$this->middleware('auth');
		//$reportes = \DB::table('evidencias')->select(['id', 'nombre_archivo', 'tipo_archivo', 'archivo_bin'])->get();

		/*
		$view = \View::make('reporte', compact('reportes'))->render();
		$pdf = \App::make('dompdf.wrapper');
		$pdf->loadHTML($view);
		$output = $pdf->output();
		file_put_contents('filename.pdf', $output);
		return $pdf->stream('informe'.'.pdf');
		*/
		//$reportes = Evidencia::all();
		$reportes = \DB::table('evidencias')->select(['archivo_mod'])->get();
		$pdf = PDFMerger::init();
		foreach ($reportes as $rep) {
			//dd($rep->archivo_mod);
			$pdf->addPDF(public_path().$rep->archivo_mod, 'all');
		}
		$pdf->merge();
		$pdf->save(public_path()."/reportes/file_name.pdf", "browser");
	}

}