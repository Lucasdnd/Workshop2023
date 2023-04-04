@extends('adminlte::page')

@section('title', 'Entreprises - NK informatique')

@section('content_header')
<div class="container">
    <h1>Entreprises</h1>
</div>
@stop

@section('content')
<div class="container">
    <a href="{{ route('companies.create') }}" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Ajouter une entreprise</a>
    <table class="table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($companies as $company)
            <tr>
                <td>{{ $company->name }}</td>
                <td>{{ $company->email ?? '-' }}</td>
                <td>{{ $company->phone ?? '-' }}</td>
                <td>
                    <a href="{{ route('companies.show', $company) }}" class="btn btn-info"><i class="fas fa-eye"></i></a>
                    <a href="{{ route('companies.edit', $company) }}" class="btn btn-primary"><i class="fas fa-pencil-alt"></i></a>
                    <form action="{{ route('companies.destroy', $company) }}" method="POST" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette entreprise ?')"><i class="fas fa-trash-alt"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@stop
