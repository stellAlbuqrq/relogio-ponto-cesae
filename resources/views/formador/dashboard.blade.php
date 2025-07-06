<head>
    {{-- Fonte --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap"
        rel="stylesheet">

    <style>
        #calendar {
            height: 600px;
            background-color: white;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            padding: 10px;
        }


        .fc .fc-button {
            background-color: #40155E;
            border-color: #40155E;
            color: white;
        }

        .fc .fc-button:hover,
        .fc .fc-button:focus {
            background-color: #462063;
            border-color: #57287A;
        }

        .fc .fc-button:disabled {
            background-color: #40155E;
            opacity: 0.5;
        }

        .fc-col-header-cell {
            background-color: #40155E !important;
            color: white !important;
            font-weight: 600;
            padding: 0.5rem 0;
            border: 1px solid #d1d5db;
        }


        .fc-event-dot {
            background-color: #7426AA !important;
        }

        .fc-event-title {
            white-space: normal !important;
            overflow-wrap: break-word;
            font-size: 0.875rem;
            padding-top: 10px;
            padding-bottom: 10px;
            padding-left: 10px;
            padding-right: 4px;
            line-height: 1.25;
        }

        .fc-event {
            line-height: 1.2;
            padding: 2px 4px;
        }

        .fc-daygrid-event-harness {
            display: block !important;
        }


        .fc-button,
        .fc-button-primary {
            background-color: #40155E !important;
            border-color: #40155E !important;
            color: white !important;
            border-radius: 0.1rem;
            padding: 0.25rem 0.75rem;
        }

        .fc-button:hover {
            filter: brightness(1.1);
            background-color: #2e0d44 !important;
        }


        .fc-daygrid-day-events {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .fc-day-today {
            background-color: #e5c5fc !important;
            color: #190E40 !important;
        }

        .fc-toolbar-title {
            font-weight: bold !important;
            font-size: 1.5rem !important;
            text-align: center !important;
            width: 100%;
        }


        .fc-event {
            background-color: #D6BBF8 !important;
            border: none !important;
            color: #190E40 !important;
            white-space: normal !important;
            overflow-wrap: break-word;
            padding: 2px 4px;
        }


        .fc-list-event-dot {
            border-color: #D6BBF8 !important;
        }

        .fc-timegrid-col.fc-day-today,
        .fc-daygrid-day.fc-day-today {
            background-color: transparent !important;
        }


        .fc-list-event-time {
            color: #190E40;
        }

        .fc-list-day-cushion {
            background-color: #6A239B !important;
            color: white !important;
            font-weight: bold !important;
        }

        .fc-list-event {
            background-color: white !important;
        }

        .fc-list-event-title,
        .fc-list-event-time {
            color: #190E40 !important;
            font-weight: 600 !important;
        }

        .fc-list-event-dot,
        .fc-daygrid-event-dot {
            border-color: #D6BBF8 !important;
        }


        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        .module-card {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 100%;
        }

        .module-stats {
            display: flex;
            justify-content: space-between;
            margin-top: 16px;
            font-size: 14px;
            color: #6b7280;
        }

        .progress-indicator {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 12px;
        }

        .progress-bar {
            flex: 1;
            height: 6px;
            background: #e5e7eb;
            border-radius: 3px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #6366f1, #8b5cf6);
            transition: width 0.3s ease;
        }
    </style>

    <!-- FullCalendar CSS -->
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />
</head>

@extends('layouts.paginaFormador')

@section('content')
    <div class="flex">

        {{-- CONTEÚDO PRINCIPAL --}}
        <main class="flex-1 pr-72 px-8">
            <h1 class="mt-7 mb-9 font-bold text-[#40155E] text-4xl">Área do Formador</h1>

            {{-- Gráfico do módulo --}}
            <div class="container mb-6">
                @if ($modulo)
                    <div class="module-card" role="region" aria-label="Progresso do módulo {{ $modulo->nome }}">
                        <div class="module-item mb-6">
                            <div class="flex justify-between text-lg mb-1">
                                <span>{{ $modulo->nome }}</span>
                                <span>{{ $modulo->percentual_concluido }}%</span>
                            </div>
                            <div class="progress-indicator" aria-label="Barra de progresso">
                                <div class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100"
                                    aria-valuenow="{{ $modulo->percentual_concluido }}">
                                    <div class="progress-fill" style="width: {{ $modulo->percentual_concluido }}%"></div>
                                </div>
                            </div>

                            <div class="module-stats mt-3">
                                <span>{{ $modulo->horas_passadas }}h / {{ $modulo->carga_horaria }}h</span>
                                <span style="color: {{ $modulo->status_color }};">{{ $modulo->status }}</span>
                            </div>
                        </div>
                    </div>
                @else
                    <p class="text-center text-gray-500 mt-8">Nenhum módulo em curso no momento.</p>
                @endif
            </div>

            {{-- Alunos sem CheckIn --}}
            <aside
                class="fixed top-0 right-0 h-screen w-64 border-l border-gray-300 dark:border-white/10 overflow-y-auto p-4 bg-transparent z-50">
                <h2 class="font-bold text-center text-[#40155E] text-base mb-3">Alunos sem Check-In:</h2>

                <div class="flex flex-col gap-3">
                    @foreach ($alunosSemCheckin as $aluno)
                        <div
                            class="flex items-center gap-2 bg-gray-100 text-gray-800 px-3 py-1.5 rounded-md shadow-sm dark:bg-zinc-800 dark:text-white">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($aluno->nome) }}&background=8B5CF6&color=fff&size=48"
                                alt="Foto de {{ $aluno->nome }}"
                                class="h-8 w-8 rounded-full object-cover object-center border border-white shadow-sm" />
                            <span class="text-s font-medium truncate">{{ $aluno->nome }}</span>
                        </div>
                    @endforeach
                </div>
            </aside>

            <div id='calendar'></div>

            <!-- FullCalendar JS -->
            <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>
            <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales-all.min.js'></script>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var calendarEl = document.getElementById('calendar');

                    // Recebe os eventos do backend via blade (Laravel)
                    const mockEvents = @json($cronogramaEventos);

                    var calendar = new FullCalendar.Calendar(calendarEl, {
                        headerToolbar: {
                            left: 'prev,next today',
                            center: 'title',
                            right: 'timeGridWeek'
                        },
                        initialView: 'timeGridWeek',
                        locale: 'pt-br',
                        events: mockEvents,
                        eventColor: '#6366f1',
                        nowIndicator: true,
                        allDaySlot: false,
                        slotMinTime: "08:00:00",
                        slotMaxTime: "18:00:00",
                        contentHeight: 600,
                        slotDuration: '00:30:00',
                        slotLabelInterval: '01:00:00'
                    });

                    calendar.render();
                });
            </script>

        </main>
    </div>
@endsection
