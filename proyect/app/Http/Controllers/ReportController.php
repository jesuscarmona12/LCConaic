<?php

namespace App\Http\Controllers;
use App\Http\Controllers\LynX39\LaraPdfMerger\PdfManage;
use LynX39\LaraPdfMerger\Facades\PdfMerger;
use Illuminate\Http\Request;
use App\Evidencia;
use PDF;
use App\PlanAccion;
use App\Categoria;
use App\Recomendacion;

class ReportController extends Controller{
	public function generar($id){
		$this->middleware('auth');

		$plan = PlanAccion::findOrFail($id);
		$pdf = PDFMerger::init();
		$info = PDF::loadView('reporte', ['plan'=>$plan]);
		$output = $info->output();
        file_put_contents(public_path().'/pdf/portadas/'.$plan->nombre .= ".pdf", $output);
        $pdf->addPDF(public_path().'/pdf/portadas/'.$plan->nombre, 'all');

		foreach ($plan->evidencias as $rep) {
			$pdf->addPDF(public_path().$rep->archivo_mod, 'all');
		}

		$pdf->merge();
		$file = public_path()."/reportes/planes/".$plan->nombre;
		$pdf->save($file, "file");
		$pdf->save($plan->nombre, "browser");
	}

	public function ReporteArea($id){
		$categoria = Categoria::findOrFail($id);
		$recomendacion = Recomendacion::where('categoria_id', $id)->get();
		$pdf = PDFMerger::init();
		$info = PDF::loadView('reporteArea', ['categoria'=>$categoria]);
		$output = $info->output();
        file_put_contents(public_path().'/pdf/portadas/areas/'.$categoria->nombre .= ".pdf", $output);
        $pdf->addPDF(public_path().'/pdf/portadas/areas/'.$categoria->nombre, 'all');

		foreach ($recomendacion as $rec) {
			$info = PDF::loadView('portadaRecomendacion', ['recomendacion'=>$rec]);
			$output = $info->output();
		    file_put_contents(public_path().'/pdf/portadas/recomendaciones/'.$rec->nombre .= ".pdf", $output);
		    $pdf->addPDF(public_path().'/pdf/portadas/recomendaciones/'.$rec->nombre, 'all');
			$idRecomendacion = $rec->id;
			$planes = PlanAccion::where('recomendacion_id',$idRecomendacion)->get();
			foreach ($planes as $plan) {
				$info = PDF::loadView('reporte', ['plan'=>$plan]);
				$output = $info->output();
		        file_put_contents(public_path().'/pdf/portadas/'.$plan->nombre .= ".pdf", $output);
		        $pdf->addPDF(public_path().'/pdf/portadas/'.$plan->nombre, 'all');

				foreach ($plan->evidencias as $rep) {
					$pdf->addPDF(public_path().$rep->archivo_mod, 'all');
				}
			}
		}
		$pdf->merge();
		$file = public_path()."/reportes/areas/".$categoria->nombre.'.pdf';
		$pdf->save($file, "file");
		$pdf->save($categoria->nombre, "browser");
	}
}