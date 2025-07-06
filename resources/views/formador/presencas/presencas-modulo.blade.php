<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presenças de Alunos</title>

    {{-- Fonte --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Nunito Sans', sans-serif;
            background-color: #f4f1fa;
            color: #190E40;
        }

        .container {
            max-width: 960px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .module-wrapper {
            display: flex;
            justify-content: center;
            margin-bottom: 1.5rem;
        }

        .module-card {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 4px 10px rgba(64, 21, 94, 0.1);
            max-width: 520px;
            width: 100%;
            color: #40155E;
        }

        .module-stats {
            display: flex;
            justify-content: space-between;
            margin-top: 12px;
            font-size: 14px;
            color: #6A239B;
        }

        .progress-bar {
            height: 8px;
            border-radius: 4px;
            overflow: hidden;
            display: flex;
            background-color: #e0d7f4;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .bar-presenca {
            background-color: #6ee7b7;
        }

        .bar-falta {
            background-color: #FCA5A5;
        }

        .bar-restante {
            background-color: #d1d5db;
        }

        .legend {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 1rem;
        }

        .legend span {
            display: inline-flex;
            align-items: center;
            font-size: 13px;
            margin-left: 1.25rem;
            color: #40155E;
            font-weight: 600;
        }

        .legend span::before {
            content: "";
            width: 14px;
            height: 14px;
            border-radius: 3px;
            margin-right: 6px;
            display: inline-block;
        }

        .legend .presenca::before {
            background-color: #6ee7b7;
        }

        .legend .falta::before {
            background-color: #FCA5A5;
        }

        .legend .restante::before {
            background-color: #d1d5db;
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(64, 21, 94, 0.1);
            background: white;
        }

        thead {
            background-color: #40155E;
            color: white;
            font-weight: 700;
            font-size: 0.9rem;
        }

        thead th {
            padding: 0.75rem 2.5rem;
            text-align: center;
            border-bottom: 2px solid #7426AA;
        }

        tbody tr {
            border-bottom: 1px solid #E5DFFC;
            transition: background-color 0.2s ease;
        }

        tbody tr:hover {
            background-color: #f5efff;
        }

        tbody td {
            padding: 0.75rem 1rem;
            font-size: 1rem;
            color: #40155E;
            vertical-align: top;
        }

        tbody td:first-child {
            font-weight: 600;
            width: 180px;
            text-align: center;
            white-space: nowrap;
        }

        .progress-bar {
            margin-top: 4px;
        }

        select#modulo-select {
            border: 1px solid #7426AA;
            border-radius: 6px;
            padding: 0.5rem 1rem;
            font-weight: 600;
            color: #40155E;
            background-color: white;
            box-shadow: 0 1px 4px rgba(64, 21, 94, 0.1);
            transition: border-color 0.2s ease;
            max-width: 520px;
        }

        select#modulo-select:hover,
        select#modulo-select:focus {
            border-color: #40155E;
            outline: none;
        }


        td.col-aluno {
            padding-left: 2rem;
            padding-right: 2rem;
            font-weight: 600;
            text-align: left;
            width: 260px;
            white-space: nowrap;
        }


        .table-container {
            padding: 1.5rem;
            border-radius: 12px;
            background-color: white;
            box-shadow: 0 2px 8px rgba(64, 21, 94, 0.1);
        }
    </style>

</head>

@extends('layouts.paginaFormador')

@section('content')
    <div class="container">

        <div>
            <h1 class="ml-8 mt-7 mb-9 font-bold text-[#6A239B] text-4xl">Estatística de Presença de Alunos.</h1>
        </div>

        <div class="ml-6">
        <!-- Select dos módulos -->
        <label for="modulo-select" class="block mb-2 font-semibold text-lg text-[#40155E]">Escolha o módulo:</label>
        <select id="modulo-select" class="mb-6 w-full max-w-xl">
            @foreach ($modulos as $modulo)
                <option value="{{ $modulo->id }}" data-nome="{{ $modulo->nome }}"
                    data-percentual="{{ $modulo->percentual_concluido }}"
                    data-horas-passadas="{{ $modulo->horas_passadas }}" data-carga-horaria="{{ $modulo->carga_horaria }}"
                    data-status="{{ $modulo->status }}" data-status-color="{{ $modulo->status_color }}">
                    {{ $modulo->nome }}
                </option>
            @endforeach
        </select>

        <!-- Card do módulo -->

            <div class="module-card" role="region" aria-label="Informações do módulo selecionado">
                <div class="flex justify-between text-md font-medium mb-2">
                    <span id="modulo-nome">{{ $modulos->first()->nome }}</span>
                    <span id="modulo-percentual">{{ $modulos->first()->percentual_concluido }}%</span>
                </div>

                <div class="progress-bar mb-2" role="progressbar" aria-valuemin="0" aria-valuemax="100"
                    aria-valuenow="{{ $modulos->first()->percentual_concluido }}">
                    <div id="progress-fill" class="bar-presenca h-full"
                        style="width: {{ $modulos->first()->percentual_concluido }}%"></div>
                </div>

                <div class="module-stats">
                    <span id="modulo-horas">{{ $modulos->first()->horas_passadas }}h /
                        {{ $modulos->first()->carga_horaria }}h</span>
                    <span id="modulo-status"
                        style="color: {{ $modulos->first()->status_color }}">{{ $modulos->first()->status }}</span>
                </div>
            </div>
            </div>

        <!-- Legenda -->

        <div class="legend mr-4 mb-5" role="list" aria-label="Legenda das cores de presença">
            <span class="presenca" role="listitem">Presença</span>
            <span class="falta" role="listitem">Falta</span>
            <span class="restante" role="listitem">Restante</span>
        </div>


        <!-- Tabela de presença -->

        <table aria-describedby="tabela-presenca-desc">
            <caption id="tabela-presenca-desc" class="sr-only">Tabela de presença dos alunos por módulo</caption>
            <thead>
                <tr class="text-md m-3">
                    <th scope="col">Aluno</th>
                    <th scope="col">Frequência</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($modulos as $modulo)
                    @foreach ($modulo->alunosPresenca as $aluno)
                        <tr class=" text-md">
                            <td>{{ $aluno['nome'] }}</td>
                            <td>
                                <div class="text-xs mb-1" style="color:#40155E;">
                                    Presença: {{ $aluno['presenca'] }}% |
                                    Falta: {{ $aluno['falta'] }}% |
                                    Restante: {{ $aluno['restante'] }}%
                                </div>
                                <div class="progress-bar" aria-hidden="true">
                                    <div class="bar-presenca" style="width: {{ $aluno['presenca'] }}%"></div>
                                    <div class="bar-falta" style="width: {{ $aluno['falta'] }}%"></div>
                                    <div class="bar-restante" style="width: {{ $aluno['restante'] }}%"></div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>

    </div>

    <script>
        const modulosData = {
            @foreach ($modulos as $modulo)
                "{{ $modulo->id }}": {!! json_encode($modulo->alunosPresenca) !!},
            @endforeach
        };

        document.addEventListener('DOMContentLoaded', function() {
            const select = document.getElementById('modulo-select');
            const tbody = document.querySelector('table tbody');
            const nome = document.getElementById('modulo-nome');
            const percentual = document.getElementById('modulo-percentual');
            const horas = document.getElementById('modulo-horas');
            const status = document.getElementById('modulo-status');
            const progressFill = document.getElementById('progress-fill');

            function renderTable(moduleId) {
                const alunos = modulosData[moduleId] || [];
                if (alunos.length === 0) {
                    tbody.innerHTML =
                        `<tr><td colspan="2" class="px-4 py-6 text-center text-gray-500">Nenhum dado disponível para este módulo.</td></tr>`;
                    return;
                }
                let rows = '';
                alunos.forEach(aluno => {
                    const restante = aluno.restante ?? (100 - (aluno.presenca + aluno.falta));
                    rows += `
                        <tr>
                            <td>${aluno.nome}</td>
                            <td>
                                <div class="text-xs mb-1" style="color:#40155E;">
                                    Presença: ${aluno.presenca}% | Falta: ${aluno.falta}% | Restante: ${restante}%
                                </div>
                                <div class="progress-bar" aria-hidden="true">
                                    <div class="bar-presenca" style="width: ${aluno.presenca}%"></div>
                                    <div class="bar-falta" style="width: ${aluno.falta}%"></div>
                                    <div class="bar-restante" style="width: ${restante}%"></div>
                                </div>
                            </td>
                        </tr>`;
                });
                tbody.innerHTML = rows;
            }

            select.addEventListener('change', function() {
                const option = select.options[select.selectedIndex];
                nome.textContent = option.getAttribute('data-nome');
                percentual.textContent = option.getAttribute('data-percentual') + '%';
                horas.textContent = option.getAttribute('data-horas-passadas') + 'h / ' +
                    option.getAttribute('data-carga-horaria') + 'h';
                status.textContent = option.getAttribute('data-status');
                status.style.color = option.getAttribute('data-status-color');
                progressFill.style.width = option.getAttribute('data-percentual') + '%';

                renderTable(option.value);
            });

            renderTable(select.value);
        });
    </script>
@endsection
