<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sistema Ensino </title>
</head>
<body>
    <h1>Cadastrar Usuário</h1>

    @if (session('success'))
        <p style="color:green"> {{ session('success') }} </p>

    @elseif (session('error'))
        <p style="color:red"> {{ session('error') }} </p>

    @endif

    <form action="{{ route('user.store') }}" method="POST">
 
        @csrf

        <label for="name">Nome:</label>
        <input type="text" name="name" id="name" placeholder="Nome completo"
        value="{{ old('name') }}" required><br><br>

        <label for="email">E-mail:</label>
        <input type="text" name="email" id="email" placeholder="E-mail"
        value="{{ old('email') }}" required><br><br>

        <label for="password">Senha:</label>
        <input type="password" name="password" id="password" placeholder="Senha com no minimo 6 caracteres"
        value="{{ old('password') }}" required><br><br>

        <button type="submit">Cadastrar</button>

    </form>
</body>
</html>
