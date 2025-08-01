@extends('layouts.admin')


@section('content')
    <div class="content">
        <div class="content-title">
            <h1 class="page-title">Listar Usuários</h1>
            <a href="{{ route('user.create') }}" class="btn-primary">Cadastrar</a>
        </div>

        <x-alert />

        <form class="pb-3 grid xl:grid-cols-5 md:grid-cols-2 gap-2 items-end">
            <input type="text" name="name" class="form-input" placeholder="Digite o nome" value="{{ $name }}">

            <input type="text" name="email" class="form-input" placeholder="Digite o e-mail" value="{{ $email }}">
            
            <input type="datetime-local" name="start_date_registration" class="form-input" value="{{ $start_date_registration }}">

            <input type="datetime-local" name="end_date_registration" class="form-input" value="{{ $end_date_registration }}">

            <div class="flex gap-1">
                <button type="submit" class="btn-primary">
                    <span>Pesquisar</span>
                </button>
                <a href="{{ route('user.list') }}" class="btn-edit">Limpar</a>
                
            </div>
        </form>

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
                                <form id="delete-form-{{ $user->id }}" action="{{ route('user.erase', ['user'=> $user->id]) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                <button type="button" class="btn-delete" onclick="confirmDelete({{ $user->id }})">Apagar</button>
                                </form>
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
