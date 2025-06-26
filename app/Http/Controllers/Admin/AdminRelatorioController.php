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

        $presencas = Presenca::with(['aluno', 'cronograma.modulo.curso'])->get();

        $filePath = storage_path('app/presencas_export.csv');

        SimpleExcelWriter::create($filePath)
            ->addHeader(['Aluno', 'Curso', 'Módulo', 'Data', 'Estado'])
            ->addRows(
                $presencas->map(function ($p) {
                    return [

                        'Aluno'  => $p->aluno->nome ?? 'N/A', // Usar 'N/A' ou '' para casos onde o aluno pode ser nulo
                        'Curso'  => $p->cronograma->modulo->turma->curso->nome ?? 'N/A',
                        'Módulo' => $p->cronograma->modulo->nome ?? 'N/A',
                        'Data'   => $p->created_at->format('d/m/Y H:i'),
                        'Estado' => $p->estado,
                    ];
                })
            );

        return response()->download($filePath)->deleteFileAfterSend(true);
    }

    public function exportarPresencasPDF()
{
    $presencas = Presenca::with(['aluno', 'cronograma.modulo.curso'])->get();

    $pdf = Pdf::loadView('admin.relatorios.presencas_pdf', compact('presencas'));

    return $pdf->download('relatorio_presencas.pdf');
}
}
