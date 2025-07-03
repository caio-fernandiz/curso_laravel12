@extends('layouts.admin')

@section('content')
    <h1>Bem vindo</h1>

    <a href="{{ route('user.create') }}">Cadastrar</a>
@endsection
