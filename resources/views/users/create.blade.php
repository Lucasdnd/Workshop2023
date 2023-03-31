@extends('adminlte::page')

@section('title', 'Gestion des utilisateurs - NK informatique')

@section('content_header')
<div class="container">
    <h1>Création d'un utilisateur :</h1>
</div>

@if ($errors->any())
<div class="alert alert-danger">
    <strong>Oups!</strong> Il y a des problèmes avec les données entrées.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="container">
    <form action="{{ route('users.store') }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nom :</strong>
                    <input type="text" name="name" class="form-control" placeholder="Nom">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Adresse email :</strong>
                    <input type="text" name="email" class="form-control" placeholder="Email">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Mot de passe :</strong>
                    <input type="password" name="password" class="form-control" placeholder="Mot de passe">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Confirmer le mot de passe :</strong>
                    <input type="password" name="confirm-password" class="form-control" placeholder="Mot de passe">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Role :</strong>
                    <select name="role" class="form-control">
                        <option value="User">Utilisateur</option>
                        <option value="Admin">Administrateur</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Envoyer</button>
            </div>
        </div>

    </form>
</div>
@endsection