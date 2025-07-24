<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SisEn</title>
</head>
<body>
    <h2>Usuário</h2>

    ID: {{ $user->id }}<br>
    Nome: {{ $user->name }}<br>
    E-mail: {{ $user->email }}<br>
    Data de cadastro: {{ \Carbon\Carbon::parse($user->updated_at)->format('d/m/Y H:i:s') }}
</body>
</html>