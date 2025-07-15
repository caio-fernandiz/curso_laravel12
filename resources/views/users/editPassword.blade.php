@extends('layouts.admin')


@section('content')
    <div class="content">
        <div class="content-title">
            <h1 class="page-title">Editar Usuário</h1>
            <a href="{{ route('user.list') }}" class="btn-primary">Voltar</a>
        </div>

        <x-alert />

        <form action="{{ route('user.update-password', ['user' => $user->id]) }}" method="POST" class="form-container">

            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="password" class="form-label">Senha:</label>
                <input type="password" name="password" id="password" class="form-input" placeholder="Senha com no minimo 6 caracteres" value="{{ old('password') }}"><br><br>
            </div>

            <button type="submit" class="btn-edit">Salvar</button>

        </form>
    </div>
@endsection
