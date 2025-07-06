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
            margin-left: 20px;
            margin-right: 20px;
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

        .chart-wrapper {
            width: 100%;
            overflow-x: hidden;
            max-width: 100%;
            margin-left: -10px;
            overflow-y: hidden;
        }

        #line-chart {
            width: 80% !important;
            height: 280px;

            max-width: 100%;
        }
    </style>

    <!-- FullCalendar CSS -->
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />
</head>

@extends('layouts.paginaAluno')

@section('content')
    <main class="w-full">


        <div>
            <h1 class="ml-8 mt-7 mb-9 font-bold text-[#6A239B] text-4xl">Área do Aluno</h1>
        </div>

        {{-- Alerta de sucesso --}}
        @if (session('mensagem-sucesso'))
            <div class="flex justify-center">
                <div
                    class="flex items-start space-x-3 bg-green-100 border border-green-200 text-green-800 rounded-lg p-4 text-lg font-medium w-fit">
                    <svg class="w-6 h-6 flex-shrink-0 text-green-600 mt-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M16.707 5.293a1 1 0 010 1.414l-7.364 7.364a1 1 0 01-1.414 0L3.293 9.414a1 1 0 011.414-1.414L9 12.293l6.293-6.293a1 1 0 011.414 0z" />
                    </svg>
                    <div>{{ session('mensagem-sucesso') }}</div>
                    <button type="button" onclick="this.parentElement.remove()"
                        class="text-green-500 hover:text-green-700 focus:outline-none text-xl leading-none self-start">&times;</button>
                </div>
            </div>
        @endif

        {{-- Identificação da aula de hoje --}}
        <div class="w-full px-8 mb-16">
            <div class="flex items-center ml-4 mt-4 mb-6 flex-wrap">
                <h2 class="font-bold text-[#6A239B] text-2xl whitespace-nowrap">As aulas de hoje serão de:</h2>

                @if ($aulas->isEmpty())
                    <span class="font-semibold text-[#6A239B] text-2xl ml-3">Não há aulas para hoje.</span>
                @else
                    <div class="flex flex-wrap gap-4 ml-[150px]">
                        @foreach ($aulas as $aula)
                            <div class="border p-2 rounded-xl bg-[#d8c2e7] text-[#6A239B] min-w-[180px] max-w-xs">
                                <p class="font-semibold text-center text-sm">
                                    <span><strong>Formador(a):</strong> {{ $aula->formador->nome }}</span><br>
                                    <span><strong>Módulo:</strong> {{ $aula->modulo->nome }}</span>
                                </p>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>



        {{-- Gráfico de presenças --}}
        <div class="container mx-auto px-4 mb-16">
            <div class="chart-wrapper w-full">
                <div id="line-chart" class="w-full"></div>
            </div>
        </div>


        {{-- Calendário --}}
        <div id='calendar'></div>

        {{-- ApexCharts --}}
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script>
            // ApexCharts - Siglas no eixo X, nomes completos nos tooltips
            const dadosChart = @json($dados ?? []);
            const siglasModulos = @json($siglasModulos ?? []);

            // Criar mapeamento inverso: sigla -> nome completo
            const siglaParaNome = {};
            Object.keys(siglasModulos).forEach(nomeCompleto => {
                const sigla = siglasModulos[nomeCompleto];
                siglaParaNome[sigla] = nomeCompleto;
            });

            const chartConfig = {
                series: [{
                        name: "Presença",
                        data: dadosChart.dados_presenca || []
                    },
                    {
                        name: "Falta",
                        data: dadosChart.dados_falta || []
                    }
                ],
                chart: {
                    type: "line",
                    height: 280,
                    width: 1500,
                    toolbar: {
                        show: false
                    },
                    zoom: {
                        enabled: false
                    }
                },
                title: {
                    text: 'Frequência do Aluno:',
                    align: 'center',
                    style: {
                        fontSize: '25px',
                        fontWeight: 'bold',
                        color: '#6A239B',
                        fontFamily: 'Nunito Sans'
                    }
                },
                colors: ["#6ee7b7", "#fca5a5"],
                stroke: {
                    curve: "smooth",
                    width: 3
                },
                markers: {
                    size: 5,
                    colors: ["#6ee7b7", "#fca5a5"],
                    strokeWidth: 2,
                    hover: {
                        sizeOffset: 4
                    }
                },
                dataLabels: {
                    enabled: false
                },
                xaxis: {
                    categories: dadosChart.categorias || [],
                    labels: {
                        style: {
                            colors: "#40155E",
                            fontSize: "13px",
                            fontFamily: "Nunito Sans",
                            fontWeight: 600
                        }
                    },
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    }
                },
                yaxis: {
                    labels: {
                        style: {
                            colors: "#40155E",
                            fontSize: "13px",
                            fontFamily: "Nunito Sans",
                            fontWeight: 600
                        }
                    }
                },
                grid: {
                    borderColor: "#E5DFFC",
                    strokeDashArray: 4,
                    padding: {
                        left: 10,
                        right: 10
                    }
                },
                legend: {
                    show: false
                },
                tooltip: {
                    theme: "light",
                    style: {
                        fontFamily: "Nunito Sans"
                    },
                    custom: function({
                        series,
                        seriesIndex,
                        dataPointIndex,
                        w
                    }) {
                        const sigla = w.globals.categoryLabels[dataPointIndex];
                        const nomeCompleto = siglaParaNome[sigla] || sigla;
                        const presenca = series[0][dataPointIndex];
                        const falta = series[1][dataPointIndex];

                        return `
                <div style="padding: 12px; background: white; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); max-width: 300px;">
                    <div style="font-weight: bold; margin-bottom: 8px; color: #6A239B; font-size: 14px; line-height: 1.3;">
                        ${nomeCompleto}
                    </div>
                    <div style="margin-bottom: 4px; font-size: 13px;">
                        <span style="color: #6ee7b7; font-weight: bold;">●</span> Presença: ${presenca}%
                    </div>
                    <div style="font-size: 13px;">
                        <span style="color: #fca5a5; font-weight: bold;">●</span> Falta: ${falta}%
                    </div>
                </div>
            `;
                    }
                }
            };

            const chart = new ApexCharts(document.querySelector("#line-chart"), chartConfig);
            chart.render();
        </script>




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
                    slotDuration: '00:30:00', // intervalos de 30 minutos
                    slotLabelInterval: '01:00:00'
                });

                calendar.render();
            });
        </script>
    </main>
@endsection
