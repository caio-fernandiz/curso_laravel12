<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sistema Ensino </title>

    @vite(['resources/css/app.css'])

</head>

<body>

    <div class="main-container">

        <header class="header">
            <div class="content-header">
                <h2 class="title-logo"> <a href="{{ route('dashboard') }}">SisEn</a> </h2>
                <ul class="list-nav-link">
                    <li> <a href="#" class="nav-link">Usuário</a> </li>
                </ul>
            </div>
        </header>

        <h1>Cadastrar Usuário</h1>

        @if (session('success'))
            <p style="color:green"> {{ session('success') }} </p>
        @elseif (session('error'))
            <p style="color:red"> {{ session('error') }} </p>
        @endif

        <form action="{{ route('user.store') }}" method="POST">

            @csrf

            <label for="name">Nome:</label>
            <input type="text" name="name" id="name" placeholder="Nome completo" value="{{ old('name') }}"
                required><br><br>

            <label for="email">E-mail:</label>
            <input type="text" name="email" id="email" placeholder="E-mail" value="{{ old('email') }}"
                required><br><br>

            <label for="password">Senha:</label>
            <input type="password" name="password" id="password" placeholder="Senha com no minimo 6 caracteres"
                value="{{ old('password') }}" required><br><br>

            <button type="submit">Cadastrar</button>

        </form>

    </div>
</body>

</html>
