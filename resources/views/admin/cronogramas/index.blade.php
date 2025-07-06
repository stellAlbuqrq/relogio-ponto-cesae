<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cronograma de Aulas</title>

    {{-- Fonte --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap"
        rel="stylesheet">

    <!-- FullCalendar CSS -->
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />

    <style>

        #calendar {
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
            background-color: #40155E;
            color: white;
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
        }

        .fc-daygrid-day-events {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .fc-day-today {
            background-color: #e5c5fc !important;
        }

        .fc-toolbar-title {
            font-weight: bold !important;
            font-size: 1.5rem !important;
            text-align: center !important;
            width: 100%;
        }

        .fc-col-header-cell {
            background-color: #40155E !important;
            color: white !important;
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


        .fc-day-today {
            background-color: #40155E !important;
            color: white !important;
        }


        .fc-timegrid-col.fc-day-today,
        .fc-daygrid-day.fc-day-today {
            background-color: transparent !important;
        }

        .fc-list-event-time {
            color: #190E40;
        }

        .fc-button:hover {
            background-color: #2e0d44 !important;
        }

        .fc-button-primary:not(:disabled).fc-button-active,
        .fc-button-primary:not(:disabled):active {
            background-color: #2e0d44 !important;
            border-color: #2e0d44 !important;
        }

        .fc-timegrid-event .fc-event-main,
        .fc-timegrid-event .fc-event-title,
        .fc-timegrid-event .fc-event-time,
        .fc-timegrid-event .fc-event-main-frame {
            color: #190E40 !important;
            font-weight:600 !important;
            font-size: medium;
            margin-top: 4px;
            margin-bottom: 2px;
            padding-left: 3px;
        }

        .fc-list-day-cushion {
            background-color: #6A239B!important;
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

    </style>

</head>

@extends('layouts.paginaAdministrador')

@section('content')
    <h1 class="text-3xl font-bold text-[#40155E] mt-2 mb-6">Cronograma de Aulas</h1>

    <div id='calendar'></div>

    <!-- FullCalendar JS -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales-all.min.js'></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            const mockEvents = @json($cronogramaEventos);
            console.log('Dados do banco:', mockEvents);

            var calendar = new FullCalendar.Calendar(calendarEl, {
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                },
                initialView: 'dayGridMonth',
                locale: 'pt-br',
                events: mockEvents,
                eventColor: '#8154BF',
            });

            calendar.render();
        });
    </script>
@endsection
