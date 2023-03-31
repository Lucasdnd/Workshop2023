@extends('adminlte::page')

@section('title', 'Actions - NK informatique')

@section('content_header')
<div class="container">
    <h1>Actions</h1>
</div>
@stop

@section('content')
<div class="container">
    <a href="{{ route('actions.create') }}" class="btn btn-primary mb-3">Créer une action</a>
    <table class="table">
        <thead>
            <tr>
                <th>Type</th>
                <th>Commentaire</th>
                <th>Date planifiée</th>
                <th>Contact</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($actions as $action)
            <tr>
                <td>
                    @if ($action->type === 'call')
                    Appel
                    @elseif ($action->type === 'email')
                    Email
                    @elseif ($action->type === 'meeting')
                    Réunion
                    @elseif ($action->type === 'note')
                    Note
                    @elseif ($action->type === 'other')
                    Autre
                    @endif
                </td>
                <td>{{ $action->comment }}</td>
                <td>{{ $action->scheduled_at }}</td>
                <td>{{ $action->contact->name }}</td>
                <td>
                    <a href="{{ route('actions.show', $action->id) }}" class="btn btn-info">Voir</a>
                    <a href="{{ route('actions.edit', $action->id) }}" class="btn btn-primary">Mettre à jour</a>
                    <form action="{{ route('actions.destroy', $action->id) }}" method="POST" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette action ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection