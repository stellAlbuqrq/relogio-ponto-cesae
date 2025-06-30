@extends('layouts.paginaAluno')


@section('content')
    <h1 class="text-2xl font-bold text-gray-700 mb-4">Cronograma de Aulas</h1>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FullCalendar Teste Local</title>
    <!-- FullCalendar CSS -->
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />

</head>
<body>

    <div id='calendar'></div>

    <!-- FullCalendar JS -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales-all.min.js'></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            // SIMULAÇÃO DE DADOS DO BANCO DE DADOS
            // Este array 'mockEvents' simula a estrutura JSON que o Laravel enviaria.
        const mockEvents = @json($cronogramaEventos);
        console.log('Dados do banco:', mockEvents);

        /*    var mockEvents = [
                {
                    id: 1,
                    title: 'Reunião de Equipe',
                    start: '2025-06-26T10:00:00', // Formato ISO 8601 (YYYY-MM-DDTHH:MM:SS)
                    end: '2025-06-26T11:00:00',
                    color: '#FF5733' // Cor opcional para este evento
                },
            ];*/
            // FIM DA SIMULAÇÃO DE DADOS

            var calendar = new FullCalendar.Calendar(calendarEl, {
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                },
                initialView: 'dayGridMonth',
                locale: 'pt-br',


                // Em vez de 'events: "/events"', passamos o array de eventos diretamente
                events: mockEvents,

                // Você pode manter eventColor para definir uma cor padrão para eventos que não têm uma cor específica em 'mockEvents'
                eventColor: '#378006',
            });

            calendar.render();
        });
    </script>
</body>
</html>
@endsection

