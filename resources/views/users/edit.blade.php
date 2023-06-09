@extends('adminlte::page')

@section('title', 'Gestion des utilisateurs - NK informatique')

@section('content_header')
<div class="container">
    <h1>Mettre à jour {{ $user->name }}</h1>
</div>
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Nom :</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                </div>
                <div class="form-group">
                    <label for="email">Adresse email :</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                </div>
                <div class="form-group">
                    <label for="role">Role :</label>
                    <select class="form-control" id="role" name="role">
                        <option value="User" @if($user->role == 'User') selected="selected" @endif>Utilisateur</option>
                        <option value="Admin" @if($user->role == 'Admin') selected="selected" @endif>Administrateur</option>
                    </select>
                </div>
                <div class="form-group">
            <button type="submit" class="btn btn-primary">Enregistrer</button>
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Retour</a>
        </div>
            </form>
        </div>
    </div>
</div>
@endsection