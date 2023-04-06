@extends('adminlte::page')

@section('title', 'Entreprises - NK informatique')

@section('content_header')
<div class="container">
    <h1>Mettre à jour {{ $company->name }}</h1>
</div>
@stop


@section('content')
<div class="container">
    <form method="POST" action="{{ route('companies.update', $company->id) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Nom</label>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $company->name) }}" required autocomplete="name" autofocus>
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $company->email) }}" autocomplete="email">
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="phone">Téléphone</label>
            <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone', $company->phone) }}" autocomplete="phone">
            @error('phone')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="country">Pays</label>
            <input id="country" type="text" class="form-control @error('country') is-invalid @enderror" name="country" value="{{ old('country', $company->country) }}" autocomplete="country">
            @error('country')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="state">Province</label>
            <input id="state" type="text" class="form-control @error('state') is-invalid @enderror" name="state" value="{{ old('state', $company->state) }}" autocomplete="state">
            @error('state')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="city">Ville</label>
            <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city', $company->city) }}" autocomplete="city">
            @error('city')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="zip_code">Code postal</label>
            <input id="zip_code" type="text" class="form-control @error('zip_code') is-invalid @enderror" name="zip_code" value="{{ old('zip_code', $company->zip_code) }}" autocomplete="zip_code">
            @error('zip_code')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="address">Adresse</label>
            <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address', $company->address) }}" autocomplete="address">
            @error('address')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
            <a href="{{ route('companies.index') }}" class="btn btn-secondary">Retour</a>
        </div>
    </form>
</div>
@endsection