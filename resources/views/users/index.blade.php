@extends('adminlte::page')

@section('title', 'Gestion des utilisateurs - NK informatique')

@section('content')
<div class="container">
    <h1>Utilisateurs</h1>
    <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Créer un utilisateur</a>
    <table class="table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Adresse email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td>
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">Mettre à jour</a>
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection