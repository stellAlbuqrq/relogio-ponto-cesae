<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Presenca;
use Spatie\SimpleExcel\SimpleExcelWriter;
use Barryvdh\DomPDF\Facade\Pdf;


class AdminRelatorioController extends Controller
{
    public function exportarPresencasCSV()
    {
        $presencas = Presenca::with(['user', 'cronograma.modulo.curso'])->get();

        $filePath = storage_path('app/presencas_export.csv');

        SimpleExcelWriter::create($filePath)
            ->addHeader(['Aluno', 'Curso', 'Módulo', 'Data', 'Estado'])
            ->addRows(
                $presencas->map(function ($p) {
                    return [
                        'Aluno'  => $p->user->name ?? '',
                        'Curso'  => $p->cronograma->modulo->curso->nome ?? '',
                        'Módulo' => $p->cronograma->modulo->nome ?? '',
                        'Data'   => $p->created_at->format('d/m/Y H:i'),
                        'Estado' => $p->estado,
                    ];
                })
            );

        return response()->download($filePath)->deleteFileAfterSend(true);
    }

    public function exportarPresencasPDF()
{
    $presencas = Presenca::with(['user', 'cronograma.modulo.curso'])->get();

    $pdf = Pdf::loadView('admin.relatorios.presencas_pdf', compact('presencas'));

    return $pdf->download('relatorio_presencas.pdf');
}
}
