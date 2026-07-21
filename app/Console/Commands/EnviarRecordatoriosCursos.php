<?php

namespace App\Console\Commands;

use App\Mail\RecordatorioCursoMail;
use App\Models\Inscripcion;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

class EnviarRecordatoriosCursos extends Command
{
    /**
     * Nombre con el que ejecutaremos el comando.
     */
    protected $signature = 'recordatorios:enviar';

    /**
     * Descripción mostrada en Artisan.
     */
    protected $description =
        'Envía recordatorios de cursos 7 días y 1 día antes de su inicio';

    public function handle(): int
    {
        $this->info('Iniciando revisión de recordatorios...');

        $enviadosSieteDias = $this->enviarRecordatorios(7);
        $enviadosUnDia = $this->enviarRecordatorios(1);

        $total = $enviadosSieteDias + $enviadosUnDia;

        $this->newLine();
        $this->info("Proceso finalizado. Recordatorios enviados: {$total}");

        Log::info('Proceso de recordatorios finalizado', [
            'recordatorios_7_dias' => $enviadosSieteDias,
            'recordatorios_1_dia' => $enviadosUnDia,
            'total' => $total,
        ]);

        return self::SUCCESS;
    }

    private function enviarRecordatorios(int $diasRestantes): int
    {
        $fechaObjetivo = now()
            ->addDays($diasRestantes)
            ->toDateString();

        $columnaControl = $diasRestantes === 7
            ? 'recordatorio_7_dias_enviado_at'
            : 'recordatorio_1_dia_enviado_at';

        $inscripciones = Inscripcion::with([
            'asistente',
            'curso.programaciones' => function ($consulta) {
                $consulta
                    ->orderBy('fecha')
                    ->orderBy('hora_inicio');
            },
        ])
            ->where('estado', 'confirmada')
            ->whereNull($columnaControl)
            ->whereHas('curso', function ($consulta) use ($fechaObjetivo) {
                $consulta
                    ->where('estado', 'activo')
                    ->whereDate('fecha_inicio', $fechaObjetivo);
            })
            ->get();

        $this->line(
            "Inscripciones encontradas para {$diasRestantes} día(s): " .
            $inscripciones->count()
        );

        $enviados = 0;

        foreach ($inscripciones as $inscripcion) {
            try {
                if (
                    !$inscripcion->asistente ||
                    !$inscripcion->curso ||
                    !$inscripcion->asistente->correo
                ) {
                    Log::warning(
                        'No se pudo enviar un recordatorio por datos incompletos',
                        [
                            'id_inscripcion' =>
                                $inscripcion->id_inscripcion,
                            'dias_restantes' => $diasRestantes,
                        ]
                    );

                    continue;
                }

                Mail::to($inscripcion->asistente->correo)
                    ->send(
                        new RecordatorioCursoMail(
                            $inscripcion,
                            $diasRestantes
                        )
                    );

                $inscripcion->update([
                    $columnaControl => now(),
                ]);

                $enviados++;

                $this->info(
                    "Enviado a {$inscripcion->asistente->correo} " .
                    "para el curso {$inscripcion->curso->nombre}"
                );

                Log::info('Recordatorio de curso enviado', [
                    'id_inscripcion' =>
                        $inscripcion->id_inscripcion,
                    'correo' =>
                        $inscripcion->asistente->correo,
                    'curso' =>
                        $inscripcion->curso->nombre,
                    'dias_restantes' =>
                        $diasRestantes,
                ]);
            } catch (Throwable $error) {
                $this->error(
                    "No se pudo enviar el recordatorio de la inscripción " .
                    "{$inscripcion->id_inscripcion}"
                );

                Log::error('Error al enviar recordatorio de curso', [
                    'id_inscripcion' =>
                        $inscripcion->id_inscripcion,
                    'dias_restantes' =>
                        $diasRestantes,
                    'mensaje' =>
                        $error->getMessage(),
                ]);
            }
        }

        return $enviados;
    }
}