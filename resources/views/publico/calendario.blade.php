@extends('layouts.publico')

@section('title', 'Calendario de Cursos | Jardín Filosófico')

@section('content')

@php
    $eventosCalendario = $programaciones
        ->map(function ($programacion) {
            return [
                'fecha' => \Carbon\Carbon::parse(
                    $programacion->fecha
                )->format('Y-m-d'),

                'nombre' => $programacion->curso->nombre,

                'hora_inicio' => \Carbon\Carbon::parse(
                    $programacion->hora_inicio
                )->format('H:i'),

                'hora_fin' => \Carbon\Carbon::parse(
                    $programacion->hora_fin
                )->format('H:i'),

                'duracion' => $programacion->curso->duracion,

                'url' => route(
                    'publico.detalle',
                    $programacion->curso
                ),
            ];
        })
        ->values();
@endphp


{{-- =====================================================
     HERO DEL CALENDARIO
===================================================== --}}

<section class="calendar-editorial-hero">

    <div class="public-container calendar-editorial-hero-grid">

        <div class="calendar-editorial-hero-copy">

            <span class="calendar-editorial-eyebrow">

                <span class="calendar-editorial-eyebrow-icon">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        aria-hidden="true"
                    >
                        <rect
                            x="3"
                            y="5"
                            width="18"
                            height="16"
                            rx="2"
                        />

                        <path d="M16 3v4M8 3v4M3 10h18"/>
                    </svg>

                </span>

                Programación del Jardín Filosófico

            </span>

            <h1>
                Calendario de
                <span>cursos y sesiones</span>
            </h1>

            <p>
                Consulta las fechas y horarios de las actividades
                programadas en el Jardín Filosófico de Parque Cancún.
            </p>

        </div>


        <aside class="calendar-editorial-summary">

            <span class="calendar-editorial-summary-icon">

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    aria-hidden="true"
                >
                    <circle cx="12" cy="12" r="9"/>
                    <path d="M12 7v5l3 2"/>
                </svg>

            </span>

            <div>

                <span>
                    Sesiones programadas
                </span>

                <strong>
                    {{ $programaciones->count() }}
                </strong>

                <p>
                    Actividades disponibles actualmente
                    para consulta.
                </p>

            </div>

        </aside>

    </div>

</section>


{{-- =====================================================
     CONTENIDO DEL CALENDARIO
===================================================== --}}

<section class="calendar-editorial-section">

    <div class="public-container">

        <header class="calendar-editorial-section-heading">

            <div>

                <span class="section-label">
                    Programación
                </span>

                <h2>
                    Consulta las próximas actividades
                </h2>

                <p>
                    Navega entre los meses y selecciona una sesión
                    para consultar la información completa del curso.
                </p>

            </div>

            <a
                href="{{ route('publico.cursos') }}"
                class="public-button public-button-secondary"
            >
                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    aria-hidden="true"
                >
                    <path d="M4 5.5A2.5 2.5 0 0 1 6.5 3H11v16H6.5A2.5 2.5 0 0 0 4 21.5z"/>
                    <path d="M20 5.5A2.5 2.5 0 0 0 17.5 3H13v16h4.5a2.5 2.5 0 0 1 2.5 2.5z"/>
                </svg>

                Ver todos los cursos
            </a>

        </header>


        {{-- =================================================
             CALENDARIO INTERACTIVO
        ================================================== --}}

        <article class="calendar-editorial-card">

            <header class="calendar-editorial-card-header">

                <div class="calendar-editorial-current-month">

                    <span class="calendar-editorial-current-icon">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            aria-hidden="true"
                        >
                            <rect
                                x="3"
                                y="5"
                                width="18"
                                height="16"
                                rx="2"
                            />

                            <path d="M16 3v4M8 3v4M3 10h18"/>
                        </svg>

                    </span>

                    <div>

                        <span>
                            Calendario mensual
                        </span>

                        <h3 id="calendarMonthTitle">
                            Mes y año
                        </h3>

                    </div>

                </div>


                <div class="calendar-editorial-navigation">

                    <button
                        type="button"
                        id="previousMonthButton"
                        class="calendar-editorial-navigation-button"
                        aria-label="Mostrar mes anterior"
                        title="Mes anterior"
                    >
                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            aria-hidden="true"
                        >
                            <path d="m15 18-6-6 6-6"/>
                        </svg>
                    </button>

                    <button
                        type="button"
                        id="todayButton"
                        class="calendar-editorial-today-button"
                    >
                        Hoy
                    </button>

                    <button
                        type="button"
                        id="nextMonthButton"
                        class="calendar-editorial-navigation-button"
                        aria-label="Mostrar mes siguiente"
                        title="Mes siguiente"
                    >
                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            aria-hidden="true"
                        >
                            <path d="m9 18 6-6-6-6"/>
                        </svg>
                    </button>

                </div>

            </header>


            {{-- =================================================
                 FILTROS
            ================================================== --}}

            <div class="calendar-editorial-toolbar">

                <div class="calendar-editorial-filter-group">

                    <div class="calendar-editorial-filter">

                        <label for="calendarMonthSelect">
                            Mes
                        </label>

                        <select id="calendarMonthSelect">

                            <option value="0">Enero</option>
                            <option value="1">Febrero</option>
                            <option value="2">Marzo</option>
                            <option value="3">Abril</option>
                            <option value="4">Mayo</option>
                            <option value="5">Junio</option>
                            <option value="6">Julio</option>
                            <option value="7">Agosto</option>
                            <option value="8">Septiembre</option>
                            <option value="9">Octubre</option>
                            <option value="10">Noviembre</option>
                            <option value="11">Diciembre</option>

                        </select>

                    </div>


                    <div class="calendar-editorial-filter">

                        <label for="calendarYearSelect">
                            Año
                        </label>

                        <select id="calendarYearSelect"></select>

                    </div>

                </div>


                <div class="calendar-editorial-month-status">

                    <strong id="calendarMonthEventCount">
                        0 sesiones
                    </strong>

                    <span>
                        Selecciona una actividad para consultar
                        los detalles del curso.
                    </span>

                </div>

            </div>


            {{-- =================================================
                 CUADRÍCULA DEL CALENDARIO
            ================================================== --}}

            <div class="calendar-editorial-scroll">

                <div class="calendar-editorial-month">

                    <div class="calendar-editorial-weekdays">

                        <div>Lun</div>
                        <div>Mar</div>
                        <div>Mié</div>
                        <div>Jue</div>
                        <div>Vie</div>
                        <div>Sáb</div>
                        <div>Dom</div>

                    </div>

                    <div
                        id="calendarDays"
                        class="calendar-editorial-days"
                    ></div>

                </div>

            </div>


            {{-- =================================================
                 LEYENDA
            ================================================== --}}

            <footer class="calendar-editorial-legend">

                <div class="calendar-editorial-legend-items">

                    <span>

                        <i class="calendar-editorial-legend-event"></i>

                        Día con actividad

                    </span>

                    <span>

                        <i class="calendar-editorial-legend-today"></i>

                        Día actual

                    </span>

                    <span>

                        <i class="calendar-editorial-legend-other"></i>

                        Otro mes

                    </span>

                </div>

                <small>
                    En dispositivos pequeños, desliza horizontalmente
                    para consultar el calendario completo.
                </small>

            </footer>

        </article>


        {{-- =================================================
             ESTADO SIN PROGRAMACIONES
        ================================================== --}}

        @if($programaciones->isEmpty())

            <div class="calendar-editorial-empty">

                <span class="calendar-editorial-empty-icon">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        aria-hidden="true"
                    >
                        <rect
                            x="3"
                            y="5"
                            width="18"
                            height="16"
                            rx="2"
                        />

                        <path d="M16 3v4M8 3v4M3 10h18"/>
                        <path d="M9 15h6"/>
                    </svg>

                </span>

                <div>

                    <strong>
                        Actualmente no hay sesiones programadas
                    </strong>

                    <p>
                        Las nuevas actividades aparecerán
                        automáticamente en este calendario cuando
                        sean publicadas.
                    </p>

                </div>

                <a
                    href="{{ route('publico.cursos') }}"
                    class="public-button public-button-secondary"
                >
                    Consultar cursos
                </a>

            </div>

        @endif

    </div>

</section>


{{-- =====================================================
     FUNCIONAMIENTO DEL CALENDARIO
===================================================== --}}

<script>
document.addEventListener('DOMContentLoaded', function () {

    const calendarEvents = @json($eventosCalendario);

    const monthNames = [
        'Enero',
        'Febrero',
        'Marzo',
        'Abril',
        'Mayo',
        'Junio',
        'Julio',
        'Agosto',
        'Septiembre',
        'Octubre',
        'Noviembre',
        'Diciembre'
    ];

    const calendarDays = document.getElementById(
        'calendarDays'
    );

    const monthTitle = document.getElementById(
        'calendarMonthTitle'
    );

    const monthEventCount = document.getElementById(
        'calendarMonthEventCount'
    );

    const monthSelect = document.getElementById(
        'calendarMonthSelect'
    );

    const yearSelect = document.getElementById(
        'calendarYearSelect'
    );

    const previousMonthButton = document.getElementById(
        'previousMonthButton'
    );

    const nextMonthButton = document.getElementById(
        'nextMonthButton'
    );

    const todayButton = document.getElementById(
        'todayButton'
    );

    const today = new Date();

    const initialEvent = calendarEvents.find(function (event) {

        return event.fecha >= formatDateKey(today);

    });

    let displayedDate;

    if (initialEvent) {

        const initialParts = initialEvent.fecha.split('-');

        displayedDate = new Date(
            Number(initialParts[0]),
            Number(initialParts[1]) - 1,
            1
        );

    } else {

        displayedDate = new Date(
            today.getFullYear(),
            today.getMonth(),
            1
        );

    }


    function formatDateKey(date) {

        const year = date.getFullYear();

        const month = String(
            date.getMonth() + 1
        ).padStart(2, '0');

        const day = String(
            date.getDate()
        ).padStart(2, '0');

        return `${year}-${month}-${day}`;

    }


    function escapeHtml(value) {

        return String(value)
            .replaceAll('&', '&amp;')
            .replaceAll('<', '&lt;')
            .replaceAll('>', '&gt;')
            .replaceAll('"', '&quot;')
            .replaceAll("'", '&#039;');

    }


    function getCalendarYearLimits() {

        const currentYear = today.getFullYear();

        let minimumYear = currentYear - 3;
        let maximumYear = currentYear + 5;

        calendarEvents.forEach(function (event) {

            const eventYear = Number(
                event.fecha.substring(0, 4)
            );

            minimumYear = Math.min(
                minimumYear,
                eventYear - 1
            );

            maximumYear = Math.max(
                maximumYear,
                eventYear + 1
            );

        });

        minimumYear = Math.min(
            minimumYear,
            displayedDate.getFullYear() - 1
        );

        maximumYear = Math.max(
            maximumYear,
            displayedDate.getFullYear() + 1
        );

        return {
            minimumYear,
            maximumYear
        };

    }


    function populateYearSelector() {

        const limits = getCalendarYearLimits();

        yearSelect.innerHTML = '';

        for (
            let year = limits.minimumYear;
            year <= limits.maximumYear;
            year++
        ) {

            const option = document.createElement('option');

            option.value = year;
            option.textContent = year;

            yearSelect.appendChild(option);

        }

    }


    function getEventsForDate(dateKey) {

        return calendarEvents.filter(function (event) {

            return event.fecha === dateKey;

        });

    }


    function createEventElement(event, index) {

        const eventLink = document.createElement('a');

        eventLink.href = event.url;

        eventLink.className =
            'calendar-editorial-event event-color-' +
            ((index % 3) + 1);

        eventLink.title =
            event.nombre +
            ' · ' +
            event.hora_inicio +
            ' a ' +
            event.hora_fin;

        eventLink.innerHTML = `
            <span class="calendar-editorial-event-dot"></span>

            <span class="calendar-editorial-event-content">

                <strong>
                    ${escapeHtml(event.nombre)}
                </strong>

                <small>

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        aria-hidden="true"
                    >
                        <circle
                            cx="12"
                            cy="12"
                            r="9"
                        />

                        <path d="M12 7v5l3 2"/>
                    </svg>

                    ${escapeHtml(event.hora_inicio)}
                    –
                    ${escapeHtml(event.hora_fin)}

                </small>

            </span>
        `;

        return eventLink;

    }


    function renderCalendar() {

        const displayedYear = displayedDate.getFullYear();
        const displayedMonth = displayedDate.getMonth();

        monthTitle.textContent =
            monthNames[displayedMonth] +
            ' ' +
            displayedYear;

        monthSelect.value = displayedMonth;

        populateYearSelector();

        yearSelect.value = displayedYear;

        const firstDayOfMonth = new Date(
            displayedYear,
            displayedMonth,
            1
        );

        const firstDayPosition =
            (firstDayOfMonth.getDay() + 6) % 7;

        const calendarStartDate = new Date(
            displayedYear,
            displayedMonth,
            1 - firstDayPosition
        );

        const monthPrefix =
            displayedYear +
            '-' +
            String(displayedMonth + 1).padStart(2, '0');

        const eventsInDisplayedMonth =
            calendarEvents.filter(function (event) {

                return event.fecha.startsWith(monthPrefix);

            });

        monthEventCount.textContent =
            eventsInDisplayedMonth.length +
            (
                eventsInDisplayedMonth.length === 1
                    ? ' sesión'
                    : ' sesiones'
            );

        calendarDays.innerHTML = '';

        /*
         * Se muestran seis semanas completas para evitar
         * cambios de altura al navegar entre meses.
         */
        for (let cellIndex = 0; cellIndex < 42; cellIndex++) {

            const cellDate = new Date(
                calendarStartDate.getFullYear(),
                calendarStartDate.getMonth(),
                calendarStartDate.getDate() + cellIndex
            );

            const dateKey = formatDateKey(cellDate);

            const eventsForDay = getEventsForDate(dateKey);

            const belongsToDisplayedMonth =
                cellDate.getMonth() === displayedMonth &&
                cellDate.getFullYear() === displayedYear;

            const isToday =
                dateKey === formatDateKey(today);

            const isWeekend =
                cellDate.getDay() === 0 ||
                cellDate.getDay() === 6;

            const dayCell = document.createElement('div');

            dayCell.className =
                'calendar-editorial-day';

            if (!belongsToDisplayedMonth) {

                dayCell.classList.add(
                    'calendar-editorial-day-other'
                );

            }

            if (eventsForDay.length > 0) {

                dayCell.classList.add('has-events');

            }

            if (isToday) {

                dayCell.classList.add('is-today');

            }

            if (isWeekend) {

                dayCell.classList.add('is-weekend');

            }

            const dayHeader = document.createElement('div');

            dayHeader.className =
                'calendar-editorial-day-header';

            const dayNumber = document.createElement('span');

            dayNumber.className =
                'calendar-editorial-day-number';

            dayNumber.textContent = cellDate.getDate();

            dayHeader.appendChild(dayNumber);

            if (isToday) {

                const todayLabel = document.createElement(
                    'span'
                );

                todayLabel.className =
                    'calendar-editorial-today-label';

                todayLabel.textContent = 'Hoy';

                dayHeader.appendChild(todayLabel);

            }

            dayCell.appendChild(dayHeader);

            const eventsContainer = document.createElement(
                'div'
            );

            eventsContainer.className =
                'calendar-editorial-day-events';

            const visibleEvents = eventsForDay.slice(0, 3);

            visibleEvents.forEach(function (event, index) {

                eventsContainer.appendChild(
                    createEventElement(event, index)
                );

            });

            if (eventsForDay.length > 3) {

                const remainingEvents =
                    document.createElement('span');

                remainingEvents.className =
                    'calendar-editorial-more-events';

                remainingEvents.textContent =
                    '+' +
                    (eventsForDay.length - 3) +
                    ' actividades más';

                eventsContainer.appendChild(
                    remainingEvents
                );

            }

            dayCell.appendChild(eventsContainer);

            calendarDays.appendChild(dayCell);

        }

    }


    previousMonthButton.addEventListener(
        'click',
        function () {

            displayedDate = new Date(
                displayedDate.getFullYear(),
                displayedDate.getMonth() - 1,
                1
            );

            renderCalendar();

        }
    );


    nextMonthButton.addEventListener(
        'click',
        function () {

            displayedDate = new Date(
                displayedDate.getFullYear(),
                displayedDate.getMonth() + 1,
                1
            );

            renderCalendar();

        }
    );


    todayButton.addEventListener(
        'click',
        function () {

            displayedDate = new Date(
                today.getFullYear(),
                today.getMonth(),
                1
            );

            renderCalendar();

        }
    );


    monthSelect.addEventListener(
        'change',
        function () {

            displayedDate = new Date(
                displayedDate.getFullYear(),
                Number(monthSelect.value),
                1
            );

            renderCalendar();

        }
    );


    yearSelect.addEventListener(
        'change',
        function () {

            displayedDate = new Date(
                Number(yearSelect.value),
                displayedDate.getMonth(),
                1
            );

            renderCalendar();

        }
    );


    renderCalendar();

});
</script>

@endsection