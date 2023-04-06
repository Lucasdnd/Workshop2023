@extends('adminlte::page')

@section('title', 'Gestion des utilisateurs - NK informatique')

@section('content_header')
<div class="form-group">
    <a href="{{ route('actions.index') }}" class="btn btn-secondary">Retour</a>
</div>
<div class="container">
    <h1>{{ $user->name }}</h1>
</div>
@stop

@section('content')
<div class="container">
    <table class="table">
        <tbody>
            <tr>
                <th>Adresse email :</th>
                <td>{{ $user->email }}</td>
            </tr>
            <tr>
                <th>Role :</th>
                <td>{{ $user->role }}</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection