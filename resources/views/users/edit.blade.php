@extends('layouts.admin')


@section('content')
    <div class="content">
        <div class="content-title">
            <h1 class="page-title">Editar Usuário</h1>
            <span>
                <a href="{{ route('user.list') }}" class="btn-primary">Voltar</a>
                <a href="{{ route('user.show', ['user' => $user->id]) }}" class="btn-visualize">Visualizar</a>
            </span>
        </div>

        <x-alert />

        <form action="{{ route('user.update', ['user' => $user->id]) }}" method="POST" class="form-container">

            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="form-label">Nome:</label>
                <input type="text" name="name" id="name" class="form-input" placeholder="Nome completo" value="{{ old('name', $user->name) }}"><br><br>
            </div>

            <div class="mb-4">
                <label for="email" class="form-label">E-mail:</label>
                <input type="text" name="email" id="email" class="form-input" placeholder="E-mail" value="{{ old('email', $user->email) }}"><br><br>
            </div>

            <button type="submit" class="btn-edit">Salvar</button>

        </form>
    </div>
@endsection
