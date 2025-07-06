<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Frequência de Módulos</title>

    {{-- Fonte --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap"
        rel="stylesheet">

</head>

@extends('layouts.paginaAluno')

@section('content')
    <div>
        <h1 class="ml-8 mt-7 mb-9 font-bold text-[#232526] text-4xl">Frequência de Módulos</h1>

    </div>

    <div class="m-5">
        <div class="bg-white rounded-2xl border border-stone-300 shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-gray-800 bg-white mx-auto p-10">
                    <thead class="bg-[#190E40] text-white">
                        <tr>
                            <th class="py-3 px-4 text-center">Módulo</th>
                            <th class="py-3 px-4 text-center">Carga Horária</th>
                            <th class="py-3 px-4 text-center">Presenças</th>
                            <th class="py-3 px-4 text-center">Ausências</th>
                            <th class="py-3 px-4 text-center">Detalhes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($frequencias as $freq)
                            <tr class="odd:bg-white even:bg-gray-100 hover:bg-gray-200 transition">
                                <td class="py-3 px-4 text-center font-semibold">{{ $freq['modulo'] }}</td>
                                <td class="py-3 px-4 text-center">{{ $freq['carga_horaria'] }}h</td>
                                <td class="py-3 px-4 text-center font-bold text-[#279666]">{{ $freq['horas_presenca'] }}h
                                </td>
                                <td class="py-3 px-4 text-center font-bold text-[#f24444]">{{ $freq['horas_ausencia'] }}h
                                </td>
                                <td class="py-3 px-4 text-center">
                                    <button onclick="openModal({{ (int) $freq['modulo_id'] }})"
                                        class="bg-[#7426AA] text-white font-medium py-2.5 px-3 rounded-xl hover:bg-[#632193] transition">
                                        Ver Gráfico
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-gray-500">Sem dados de presença disponíveis
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="modalGrafico" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center p-4">

        <div class="bg-white rounded-lg shadow-lg w-full max-w-lg md:max-w-xl p-6 relative">

            <h2 class="text-2xl font-bold text-center mb-1 text-[#190E40]">Detalhes de Frequência:</h2>
            <h2 id="modalTitle" class="text-2xl font-bold text-center mb-4 text-[#7426AA]"></h2>
            <p id="modalCargaHoraria" class="text-gray-600 mb-4 mr-4 text-right"></p>

            <div style="height: 300px; width: 100%;">
                <canvas id="graficoPresenca"></canvas>
            </div>


            <button onclick="fecharModal()"
                class="absolute top-4 right-4 text-gray-700 hover:text-gray-900 text-xl">&times;</button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const dadosPorModulo = @json($frequencias);
        let graficoPresencaInstance = null;

        function openModal(moduloId) {
            const modulo = dadosPorModulo.find(f => f.modulo_id === moduloId);

            if (!modulo) {
                console.error("Módulo não encontrado para o ID:", moduloId);
                return;
            }


            document.getElementById('modalTitle').innerText = `${modulo.modulo}`;
            document.getElementById('modalCargaHoraria').innerText = `Carga Horária Total: ${modulo.carga_horaria}h`;


            const data = {
                labels: ['Horas de Presença', 'Horas de Ausência'],
                datasets: [{
                    data: [modulo.horas_presenca, modulo.horas_ausencia],
                    backgroundColor: ['#32bb80', '#f94343'],
                    hoverOffset: 4,
                    borderColor: '#fff',
                    borderWidth: 2
                }]
            };

            const config = {
                type: 'doughnut',
                data: data,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                font: {
                                    size: 14
                                },
                                usePointStyle: true,
                                padding: 30
                            }
                        },
                        title: {
                            display: false,
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const valor = context.raw;
                                    const total = modulo.carga_horaria;
                                    const percentual = total > 0 ? ((valor / total) * 100).toFixed(1) : 0;
                                    return `${context.label}: ${valor}h (${percentual}%)`;
                                }
                            },
                            bodyFont: {
                                size: 14
                            },
                            padding: 10
                        }
                    },
                   
                },
            };

            const ctx = document.getElementById('graficoPresenca').getContext('2d');

            if (graficoPresencaInstance) {
                graficoPresencaInstance.destroy();
            }

            graficoPresencaInstance = new Chart(ctx, config);

            document.getElementById('modalGrafico').classList.remove('hidden');
        }

        function fecharModal() {
            document.getElementById('modalGrafico').classList.add('hidden');
            if (graficoPresencaInstance) {
                graficoPresencaInstance.destroy();
                graficoPresencaInstance = null;
            }
        }
    </script>
@endsection
