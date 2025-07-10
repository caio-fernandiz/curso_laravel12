@extends('layouts.admin')


@section('content')
    <div class="content">
        <div class="content-title">
            <h1 class="page-title">Listar Usuários</h1>
            <a href="{{ route('user.create') }}" class="btn-primary">Cadastrar</a>
        </div>

        <x-alert />

        <div class="table-container">
            <table class="table">
                <thead>
                    <tr class="table-header">
                        <th class="table-header">ID</th>
                        <th class="table-header">Nome</th>
                        <th class="table-header">E-mail</th>
                        <th class="table-header center">Ações</th>
                    </tr>
                </thead>
                <tbody class="table-body">
                    @forelse ($users as $user)
                        <tr class="table-row">
                            <td class="table-cell">{{ $user->id }}</td>
                            <td class="table-cell">{{ $user->name }}</td>
                            <td class="table-cell">{{ $user->email }}</td>
                            <td class="table-actions">
                                <a href="#" class="btn-primary">Visualizar</a>
                                <a href="#" class="btn-edit">Editar</a>
                                <a href="#" class="btn-delete">Apagar</a>
                            </td>
                        </tr>
                    @empty
                        <div class="table-error">
                            Nenhum usuário foi encontrado ou não possui registros
                        </div>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pagination">
                {{ $users->links() }}
            </div>
    @endsection
