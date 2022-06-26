<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Treinos do Aluno</title>
</head>

<body>
    <style>
        * {
            font-family: Arial, Helvetica, sans-serif
        }

        h2 {
            font-weight: bold
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
        }

        table {
            display: table;
            border: 1px solid gray;
            border-collapse: collapse;
            width: 100%
        }

        th,
        td {
            border: 1px solid gray;
            text-align: left;
            padding: 4px 10px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }


        .tb-head {
            background: #ffd484;
        }
    </style>
    <div class="container mt-5">
        {{-- identificação do aluno --}}
        <table class="table">
            <tbody>
                <tr>
                    <th class="tb-head" colspan="2" style="text-align:center">IDENTIFICAÇÃO DO ALUNO</th>
                </tr>
                <tr>
                    <th>Nome</th>
                    <td>{{ $aluno->user->name }}</td>
                </tr>
                <tr>
                    <th>E-mail</th>
                    <td>{{ $aluno->user->email }}</td>
                </tr>
                <tr>
                    <th>Gênero</th>
                    <td>{{ $aluno->sexo == 'm' ? 'Masculino' : 'Feminino' }}</td>
                </tr>
                <tr>
                    <th>Data de Nascimento</th>
                    <td>{{ date('d/m/Y', strtotime($aluno->data_nascimento)) }}</td>
                </tr>
                <tr>
                    <th>Telefone</th>
                    <td>{{ $aluno->user->celular }}</td>
                </tr>

            </tbody>
        </table>
        <h1>Treinos</h1>
        @foreach ($treinos['diasdasemana'] as $key => $dia)
            <p class="tb-head" colspan="5" style="text-align:center">{{ $dia }} </p>
            <table class="table table-dark table-striped table-hover">
                <thead>
                    <tr>
                        <th>Exercício</th>
                        <th>Séries</th>
                        <th>Repetições</th>
                        <th>Carga</th>
                        <th>Vídeo</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($treinos['treinos'][$key]))
                        @foreach ($treinos['treinos'][$key] as $treino)
                            <tr>
                                <td>{{ $treino->treino }}</td>
                                <td>{{ $treino->series }}</td>
                                <td>{{ $treino->repeticoes }}</td>
                                <td>{{ $treino->carga }}</td>
                                <td> {{ $treino->video }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="p-3 text-center text-muted">
                                Não há treinos para este dia.
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        @endforeach
    </div>

</body>

</html>
