@extends('adminlte::page')

@section('title', 'Gestion des utilisateurs - NK informatique')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>{{ $user->name }}</h3>
        </div>
        <div class="card-body">
            <p>Adresse email : {{ $user->email }}</p>
            <p>Role : {{ $user->role }}</p>
        </div>
    </div>
</div>
@endsection