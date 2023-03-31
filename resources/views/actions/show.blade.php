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
                <td>
                    @if ($action->type === 'call')
                    {{ __('Appel') }}
                    @elseif ($action->type === 'email')
                    {{ __('Email') }}
                    @elseif ($action->type === 'meeting')
                    {{ __('Réunion') }}
                    @elseif ($action->type === 'note')
                    {{ __('Note') }}
                    @elseif ($action->type === 'other')
                    {{ __('Autre') }}
                    @endif
                </td>
            </tr>
            <tr>
                <th>Commentaire</th>
                <td>{{ $action->comment ?? 'Aucun commentaire' }}</td>
            </tr>
            <tr>
                <th>Date planifiée</th>
                <td>{{ \Carbon\Carbon::parse($action->scheduled_at)->format('d/m/Y H:i') }}</td>
            </tr>
            <tr>
                <th>Contact</th>
                <td>{{ $action->contact->first_name }} {{ $action->contact->last_name }}</td>
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