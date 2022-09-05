# Sistema para academias

## Níveis de acesso e funcionalidades

### 1- Admin

-   Acesso inicial do sistema, o sistema é composto por apenas 1 admin que é considerado o dono do sistema e irá cadastrar outras academias, as academias representam os clientes do admin.
-   CRUD de academias
-   Após fazer o login vai exibir a lista de academis com opção para excluir ou editar, e um botão para cadastrar mais
-   Alterar dados de login(E-mail/senha)

### 2- Academia

-   Pode cadastrar professores, exercícios (supino, abdominal...), alunos e também os treinos referente a cada aluno (1 aluno pode ter o treino a,b,c... que são compostos por vários exercícios)
-   Após fazer o logn irá mostrar uma lista de professores e alunos que pertencem a essa academia com opções de editar e excluir conta, editar treinos
-   Adicionar, editar e alocar treinos a alunos
-   Exportar os alunos para o excel
-   Gráficos com informação da idade dos alunos, sexo(M/F), quantidade de professores e quantidade de alunos
-   Campo para pesquisar aluno(a)

### 3- Professor

-   Pode logar com usuário cadastrado pela academia, ele terá acesso as mesmas funcionalidade do usuário de nível academia, exceto cadastrar um novo professor

### 4- Aluno

-   O aluno vai visualizar os treinar relacionados a ele
-   Exportar o treino em PDF

## Frameworks Utilizados

-   Laravel 9.19.0
-   Bootstrap 5.1.3

## Pacotes Utilizados

**[Spatie](https://spatie.be/docs/laravel-permission/v5/installation-laravel)**

```
composer require spatie/laravel-permission
```

**[Laravel pt-BR](https://github.com/lucascudo/laravel-pt-BR-localization)**

```
composer require lucascudo/laravel-pt-br-localization --dev
```

**[LaravelLegends pt-BR Validator](https://github.com/LaravelLegends/pt-br-validator)**

```
composer require laravellegends/pt-br-validator
```

**[Dom PDF](https://spatie.be/docs/laravel-permission/v5/installation-laravel)**

```
composer require barryvdh/laravel-dompdf
```

**[Laravel Excel](https://laravel-excel.com/)**

```
composer require maatwebsite/excel
```

**[Laravel Socialite](https://laravel.com/docs/8.x/socialite)**

```
composer require laravel/socialite
```

## Bibliotecas Utilizadas

-   Smask (https://www.cssscript.com/input-mask-validation/)
-   Izitoast (https://izitoast.marcelodolza.com/)
-   Font Awesome (https://fontawesome.com/)
-   Chart.js (https://www.chartjs.org/)

## Instalação do Projeto

### Baixar as depêndencias

```
composer install
```

### Copiar .env.example para .env e configure o banco de dados e as variáveis necessárias para login social

```
cp .env.example .env
```

### Gerar chave

```
php artisan key:generate
```

### Executando os migrations

```
php artisan migrate
```

### Seeders Obrigatórios

Permissões de acesso

```
php artisan db:seed --class=PermissoesSeeder
```

Dias da semana

```
php artisan db:seed --class=DiasDaSemanaSeeder
```

### Seeders para testes

Gerar usuários(É necessário ter cadastrado o admin antes de executar esse seeder, pois ele ira gerar academias, professores e alunos)

```
php artisan db:seed --class=UsuariosSeeder
```

### Iniciar servidor local

```
php artisan serve
```
