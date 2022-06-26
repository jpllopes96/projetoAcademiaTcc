<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">

        <div class="dropdown">
            <button class="btn btn-secondary p-1 px-2 me-2" type="button" id="triggerId" data-bs-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <span class="navbar-toggler-icon"></span>
                <span class="">Menu</span>
            </button>

            <div class="dropdown-menu" aria-labelledby="triggerId">
                <a class="dropdown-item" href="{{ route('home') }}"><i class="fas fa-home"></i> Início</a>
                @can('academia')
                    <a href="{{ route('professor.create') }}" class="dropdown-item">
                        <i class="fas fa-plus-circle"></i> Cadastrar professor(a)
                    </a>
                    <a href="{{ route('aluno.create') }}" class="dropdown-item">
                        <i class="fas fa-plus-circle"></i> Cadastrar aluno(a)
                    </a>
                    <a href="{{ route('alunos.exportar') }}" class="dropdown-item">
                        <i class="fa-solid fa-file-excel"></i> Exportar Alunos
                    </a>
                @endcan
                @can('professor')
                    <a href="{{ route('aluno.create') }}" class="dropdown-item">
                        <i class="fas fa-plus-circle"></i> Cadastrar aluno(a)
                    </a>
                @endcan
                @can('aluno')
                    <a href="{{ route('treinos.exportar') }}" class="dropdown-item">
                        <i class="fa-solid fa-file-pdf"></i> Exportar Treino
                    </a>
                @endcan

            </div>
        </div>

        <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav me-auto mt-2 mt-lg-0">

            </ul>
            @canany(['academia', 'professor'])
                <form action="{{ route('aluno.pesquisar') }}" class="d-flex my-2 my-lg-0">
                    <input class="form-control me-2" type="text" name="p" placeholder="Pesquisar aluno(a)"
                        required>
                    <button type="submit" class="btn btn-info rounded-pill my-2 my-sm-0">
                        <i class="fas fa-search text-white"></i>
                        <span class="visually-hidden">Pesquisar</span>
                    </button>
                </form>
            @endcanany

            <ul class="navbar-nav">
                <li class="nav-item dropdown ms-lg-2">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdownId2" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownId2">
                        @can('academia')
                            <a class="dropdown-item" href="{{ route('estatisticas', Auth::user()->academia->id) }}">
                                <i class="fas fa-chart-pie"></i> Estatísticas
                            </a>
                        @endcan
                        @canany(['academia'])
                            <a class="dropdown-item" href="{{ route('academia.show', Auth::user()->academia->id) }}">
                                Dados da academia
                            </a>
                        @endcanany
                        <a class="dropdown-item" href="{{ route('modificar-dados', Auth::user()->id) }}">
                            Modificar dados de acesso
                        </a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>

        </div>
    </div>
</nav>
