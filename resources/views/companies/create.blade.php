@extends('adminlte::page')

@section('title', 'Entreprises - NK informatique')

@section('content_header')
<div class="container">
    <h1>Ajouter une entreprise</h1>
</div>
@stop

@section('content')
<div class="container">

    <form method="POST" action="{{ route('companies.store') }}">
        @csrf

        <div class="form-group">
            <label for="name">Nom</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}">
        </div>

        <div class="form-group">
            <label for="phone">Téléphone</label>
            <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone') }}">
        </div>

        <div class="form-group">
            <label for="address">Adresse</label>
            <input type="text" id="address" name="address" class="form-control" value="{{ old('address') }}">
        </div>

        <div class="form-group">
            <label for="city">Ville</label>
            <input type="text" id="city" name="city" class="form-control" value="{{ old('city') }}">
        </div>

        <div class="form-group">
            <label for="state">État</label>
            <input type="text" id="state" name="state" class="form-control" value="{{ old('state') }}">
        </div>

        <div class="form-group">
            <label for="zip_code">Code postal</label>
            <input type="text" id="zip_code" name="zip_code" class="form-control" value="{{ old('zip_code') }}">
        </div>

        <div class="form-group">
            <label for="country">Pays</label>
            <input type="text" id="country" name="country" class="form-control" value="{{ old('country') }}">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Créer</button>
            <a href="{{ route('companies.index') }}" class="btn btn-secondary">Retour</a>
        </div>
    </form>
</div>
@endsection