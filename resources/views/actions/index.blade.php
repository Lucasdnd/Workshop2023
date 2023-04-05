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
                <td>{{ substr($action->comment, 0, 50) }}@if(strlen($action->comment) > 50)...@endif</td>
                <td>{{ \Carbon\Carbon::parse($action->scheduled_at)->format('d/m/Y H:i') }}</td>
                <td>{{ $action->contact->first_name }} {{ $action->contact->last_name }}</td>
                <td>
                    <form class="d-inline-block" action="{{ route('actions.mark-as-done', $action) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn {{ $action->is_done ? 'btn-success' : 'btn-outline-success' }} mr-4"><i class="fa fa-check"></i></button>
                    </form>
                    <a href="{{ route('actions.show', $action->id) }}" class="btn btn-info" title="Voir"><i class="fas fa-eye"></i></a>
                    <a href="{{ route('actions.edit', $action->id) }}" class="btn btn-primary" title="Mettre à jour"><i class="fas fa-pencil-alt"></i></a>
                    <form action="{{ route('actions.destroy', $action->id) }}" method="POST" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette action ?')"><i class="fas fa-trash-alt"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
@endsection