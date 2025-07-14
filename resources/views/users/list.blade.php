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
                                <a href="{{ route('user.show', ['user'=> $user->id]) }}" class="btn-visualize">Visualizar</a>
                                <a href="{{ route('user.edit', ['user'=> $user->id]) }}" class="btn-edit">Editar</a>
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
            @php
                $currentPage = $users->currentPage();
                $lastPage = $users->lastPage();

                if ($currentPage == 1) {
                    $start = 1;
                    $end = min(3, $lastPage);
                } elseif ($currentPage == $lastPage) {
                    $start = max($lastPage - 2, 1);
                    $end = $lastPage;
                } else {
                    $start = $currentPage - 1;
                    $end = $currentPage + 1;
                }
            @endphp

            @if ($currentPage > 2 )
                <a href="{{ $users->url( 1 )}}" class="btn-page"> << </a>
            @endif
                
            @if ($currentPage > 1)
                <a href="{{ $users->url($currentPage - 1) }}" class="btn-page">Anterior</a>
            @endif
            
            @for ($i = $start; $i <= $end; $i++)
                @if ($i == $currentPage)
                    <span class="btn-page active">{{ $i }}</span>
                @else
                    <a href="{{ $users->url($i) }}" class="btn-page">{{ $i }}</a>
                @endif
            @endfor

            @if ($currentPage < $lastPage)
                <a href="{{ $users->url($currentPage + 1) }}" class="btn-page">Próxima</a>
            @endif

            @if ($currentPage < $lastPage -1 )
                <a href="{{ $users->url( $lastPage )}}" class="btn-page"> >> </a>
            @endif
        </div>
        
    @endsection
