<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Recordatorio de curso</title>
</head>

<body style="
    margin: 0;
    padding: 0;
    background-color: #f3f6f5;
    font-family: Arial, Helvetica, sans-serif;
    color: #24332f;
">

<table
    width="100%"
    cellpadding="0"
    cellspacing="0"
    role="presentation"
    style="background-color: #f3f6f5; padding: 35px 15px;"
>
    <tr>
        <td align="center">

            <table
                width="100%"
                cellpadding="0"
                cellspacing="0"
                role="presentation"
                style="
                    max-width: 620px;
                    background-color: #ffffff;
                    border-radius: 16px;
                    overflow: hidden;
                    box-shadow: 0 8px 24px rgba(16, 79, 66, 0.08);
                "
            >

                <tr>
                    <td style="
                        padding: 32px;
                        background-color: #104f42;
                        color: #ffffff;
                    ">
                        <p style="
                            margin: 0 0 10px;
                            font-size: 13px;
                            letter-spacing: 1px;
                            text-transform: uppercase;
                            color: #c9e5dc;
                        ">
                            Jardín Filosófico
                        </p>

                        <h1 style="
                            margin: 0;
                            font-size: 28px;
                            line-height: 1.3;
                        ">
                            @if ($diasRestantes === 1)
                                Tu curso comienza mañana
                            @else
                                Tu curso comienza en 7 días
                            @endif
                        </h1>
                    </td>
                </tr>

                <tr>
                    <td style="padding: 34px 32px;">

                        <p style="
                            margin: 0 0 18px;
                            font-size: 17px;
                            line-height: 1.7;
                        ">
                            Hola
                            <strong>
                                {{ $inscripcion->asistente->nombre }}
                            </strong>,
                        </p>

                        <p style="
                            margin: 0 0 24px;
                            font-size: 16px;
                            line-height: 1.7;
                            color: #52635e;
                        ">
                            Te recordamos que estás inscrito en la siguiente
                            actividad del Jardín Filosófico.
                        </p>

                        <table
                            width="100%"
                            cellpadding="0"
                            cellspacing="0"
                            role="presentation"
                            style="
                                margin-bottom: 26px;
                                border: 1px solid #dce8e4;
                                border-radius: 12px;
                                background-color: #f8fbfa;
                            "
                        >
                            <tr>
                                <td style="padding: 22px;">

                                    <p style="
                                        margin: 0 0 8px;
                                        font-size: 13px;
                                        font-weight: bold;
                                        text-transform: uppercase;
                                        color: #317163;
                                    ">
                                        Curso
                                    </p>

                                    <h2 style="
                                        margin: 0 0 18px;
                                        font-size: 22px;
                                        color: #123f35;
                                    ">
                                        {{ $inscripcion->curso->nombre }}
                                    </h2>

                                    <p style="
                                        margin: 0 0 10px;
                                        font-size: 15px;
                                        color: #52635e;
                                    ">
                                        <strong>Fecha de inicio:</strong>

                                        {{ \Carbon\Carbon::parse(
                                            $inscripcion->curso->fecha_inicio
                                        )->format('d/m/Y') }}
                                    </p>

                                    <p style="
                                        margin: 0;
                                        font-size: 15px;
                                        color: #52635e;
                                    ">
                                        <strong>Estado de inscripción:</strong>
                                        {{ ucfirst($inscripcion->estado) }}
                                    </p>

                                </td>
                            </tr>
                        </table>

                        @if (
                            $inscripcion->curso->programaciones->isNotEmpty()
                        )
                            <h3 style="
                                margin: 0 0 14px;
                                font-size: 18px;
                                color: #123f35;
                            ">
                                Sesiones programadas
                            </h3>

                            @foreach (
                                $inscripcion->curso->programaciones as $sesion
                            )
                                <div style="
                                    margin-bottom: 10px;
                                    padding: 14px 16px;
                                    border-left: 4px solid #287d69;
                                    background-color: #f4f9f7;
                                ">
                                    <strong>
                                        {{ \Carbon\Carbon::parse(
                                            $sesion->fecha
                                        )->format('d/m/Y') }}
                                    </strong>

                                    <span>
                                        ·
                                        {{ \Carbon\Carbon::parse(
                                            $sesion->hora_inicio
                                        )->format('H:i') }}
                                        a
                                        {{ \Carbon\Carbon::parse(
                                            $sesion->hora_fin
                                        )->format('H:i') }}
                                    </span>
                                </div>
                            @endforeach
                        @endif

                        <p style="
                            margin: 28px 0 0;
                            font-size: 15px;
                            line-height: 1.7;
                            color: #52635e;
                        ">
                            Te recomendamos llegar con anticipación y conservar
                            este mensaje como referencia.
                        </p>

                    </td>
                </tr>

                <tr>
                    <td style="
                        padding: 22px 32px;
                        background-color: #edf5f2;
                        text-align: center;
                        font-size: 13px;
                        line-height: 1.6;
                        color: #61736d;
                    ">
                        Sistema de Gestión de Eventos del Jardín Filosófico
                        <br>
                        Parque Cancún
                    </td>
                </tr>

            </table>

        </td>
    </tr>
</table>

</body>
</html>