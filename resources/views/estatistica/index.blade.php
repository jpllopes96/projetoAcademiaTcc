@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="card-title text-white mb-3 h3" style="text-shadow: 2px 2px 1px #222">
            <i class="fas fa-chart-area"></i> Estatísticas
        </h1>

        <div class="row gy-4">
            <!-- col -->
            <div class="col-12 col-lg-6">
                <div class="card border-0" id="xxx">
                    <div class="card-header bg-danger text-white d-flex justify-content-between fw-bold">
                        Professores <span>Total {{ $data['professores']['total'] }}</span>
                    </div>
                    <div class="card-body ">
                        <canvas id="professores"></canvas>
                    </div>
                </div>
            </div>
            <!-- col -->
            <div class="col-12 col-lg-6">
                <div class="card border-0">
                    <div class="card-header bg-warning text-dark d-flex justify-content-between fw-bold">
                        Alunos <span> Total {{ $data['alunos']['total'] }}</span>
                    </div>
                    <div class="card-body ">
                        <canvas id="alunos"></canvas>
                    </div>
                </div>
            </div>

            <!-- col -->
            <div class="col-12 col-lg-6">
                <div class="card border-0">
                    <div class="card-header bg-success text-white d-flex justify-content-between fw-bold">
                        Homens e mulheres <span> Total {{ $data['alunos']['total'] }}</span>
                    </div>
                    <div class="card-body ">
                        <div class="mx-auto">
                            <canvas id="homens-e-mulheres"
                                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- col -->
            <div class="col-12 col-lg-6">
                <div class="card border-0">
                    <div class="card-header bg-dark text-white d-flex justify-content-between fw-bold">
                        Faixa etária dos alunos
                        <span> Total {{ $data['alunos']['total'] }}</span>
                    </div>
                    <div class="card-body ">
                        <div class="mx-auto">
                            <canvas id="faixa-etaria"
                                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- col -->

        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('js/chart-custom.js') }}"></script>

    <script>
        const data = JSON.parse('<?= json_encode($data) ?>')
        const professores = {
            labels: data.professores.data_meses.meses,
            data: data.professores.data_meses.dados,
            backgroundColor: "#dc3545",
            title: 'Professores',
            elementId: 'professores'
        }
        chartCustomTypeLine(professores);

        const alunos = {
            labels: data.alunos.data_meses.meses,
            data: data.alunos.data_meses.dados,
            backgroundColor: "#ffc107",
            title: 'Alunos',
            elementId: 'alunos'
        }
        chartCustomTypeLine(alunos);

        // homes e mulheres
        const homensEmulheres = {
            elementId: 'homens-e-mulheres',
            labels: data.homens_e_mulheres.data_chart.labels,
            data: data.homens_e_mulheres.data_chart.data,
        }
        chartCustomTypeDoughnut(homensEmulheres)

        // faixa etária
        const faixaEtaria = {
            elementId: 'faixa-etaria',
            labels: data.faixa_etaria.labels,
            data: data.faixa_etaria.data,
        };
        chartCustomTypeBar(faixaEtaria)
    </script>
@endsection
