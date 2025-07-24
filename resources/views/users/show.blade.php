@extends('layouts.admin')


@section('content')
    <div class="content">
        <div class="content-title">
            <h1 class="page-title">Detalhes Usuário</h1>
            <span class="flex items-center gap-2 justify-end">
                <a href="{{ route('user.list') }}" class="btn-primary">Lista</a>
                <a href="{{ route('user.generate-pdf', ['user' => $user->id]) }}" class="btn-edit">Gerar PDF</a>
                <a href="{{ route('user.edit', ['user' => $user->id]) }}" class="btn-edit">Editar</a>
                <a href="{{ route('user.edit-password', ['user' => $user->id]) }}" class="btn-edit">Editar Senha</a>
                <form id="delete-form-{{ $user->id }}" action="{{ route('user.erase', ['user' => $user->id]) }}"
                    method="POST">
                    @csrf
                    @method('delete')
                    <button type="button" class="btn-delete" onclick="confirmDelete({{ $user->id }})">Apagar</button>
                </form>
            </span>
        </div>

        <x-alert />

        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-4">Informações do Uusário</h2>
            <div class="text-gray-700">
                <div class="mb-1">
                    <span class="font-bold">ID: </span> <span> {{ $user->id }} </span>
                </div>
                <div class="mb-1">
                    <span class="font-bold">Nome: </span> <span> {{ $user->name }} </span>
                </div>
                <div class="mb-1">
                    <span class="font-bold">E-mail: </span> <span> {{ $user->email }} </span>
                </div>
                <div class="mb-1">
                    <span class="font-bold">Cadastado em: </span> <span>
                        {{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y H:i:s') }} </span>
                </div>
                <div class="mb-1">
                    <span class="font-bold">Última atualização: </span> <span>
                        {{ \Carbon\Carbon::parse($user->updated_at)->format('d/m/Y H:i:s') }} </span>
                </div>
            </div>
        </div>

    </div>
@endsection
