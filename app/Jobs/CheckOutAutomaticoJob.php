<?php

namespace App\Jobs;

use App\AcaoPresenca;
use App\Models\Presenca;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class CheckOutAutomaticoJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $aluno_id;
    protected $cronograma_id;
    protected $periodo;

    public function __construct($aluno_id, $cronograma_id, $periodo)
    {
        $this->aluno_id = $aluno_id;
        $this->cronograma_id = $cronograma_id;
        $this->periodo = $periodo;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //verificar se o aluno fez check-out antecipado
        $jaTemCheckOut = Presenca::where('aluno_id', $this->aluno_id)
        ->where('cronograma_id', $this->cronograma_id)
        ->where('acao', AcaoPresenca::CheckOut)
        ->exists();

        if ($jaTemCheckOut) {
            return;
        }

        //se não tem, cria o ckeck-out automático
        Presenca::create([
            'aluno_id' => $this->aluno_id,
            'cronograma_id' => $this->cronograma_id,
            'acao' => AcaoPresenca::CheckOut,
            'pin' => null,
            'comentario' => "Check-out automático - fim do período da {$this->periodo}",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }
}
