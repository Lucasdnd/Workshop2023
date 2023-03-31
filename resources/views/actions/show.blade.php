@extends('adminlte::page')

@section('title', 'Actions - NK informatique')

@section('content_header')
<div class="container">
    <h1>Détails de l'action</h1>
</div>
@stop


@section('content')
<div class="container">
    <table class="table">
        <tbody>
            <tr>
                <th>Type</th>
                <td>{{ $action->type }}</td>
            </tr>
            <tr>
                <th>Commentaire</th>
                <td>{{ $action->comment ?? 'Aucun commentaire' }}</td>
            </tr>
            <tr>
                <th>Date planifiée</th>
                <td>{{ $action->scheduled_at }}</td>
            </tr>
            <tr>
                <th>Contact</th>
                <td>{{ $action->contact->name }}</td>
            </tr>
        </tbody>
    </table>
    <a href="{{ route('actions.edit', $action->id) }}" class="btn btn-primary">Modifier</a>
    <form action="{{ route('actions.destroy', $action->id) }}" method="POST" class="d-inline-block">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette action ?')">Supprimer</button>
    </form>
</div>
@endsection