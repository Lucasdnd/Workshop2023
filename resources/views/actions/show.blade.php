@extends('adminlte::page')

@section('title', 'Actions - NK informatique')

@section('content_header')
<div class="container">
    <h1>Détails de l'action</h1>
</div>
@stop


@section('content')
<div class="container">
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if ($action->is_done)
    <div class="alert alert-success">Cette action a été marquée comme réalisée.</div>
    @else
    <div class="alert alert-warning">Cette action n'a pas encore été réalisée.</div>
    @endif

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
    <a href="{{ route('actions.edit', $action->id) }}" class="btn btn-primary d-inline-block">Modifier</a>
    <form action="{{ route('actions.destroy', $action->id) }}" method="POST" class="d-inline-block">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette action ?')">Supprimer</button>
    </form>

    <div class="mt-4">
        <h3 class="mb-4">Commentaires</h3>
        <div class="timeline timeline-card">
            @forelse ($action->comments ?? [] as $comment)
            <div>
                <i class="fas fa-comment bg-blue"></i>
                <div class="timeline-item">
                    <span class="time"><i class="fas fa-clock"></i> {{ $comment->created_at->format('d/m/Y à H:i') }}</span>
                    <h3 class="timeline-header">{{ $comment->user->name }}</h3>
                    <div class="timeline-body p-4">
                        {{ $comment->comment }}
                        @if ($comment->canBeEditedOrDeletedByUser(Auth::user()))
                        <div class="float-right">
                            <a href="{{ route('actions.comments.edit', [$action->id, $comment->id]) }}" class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i></a>
                            <form action="{{ route('actions.comments.destroy', [$action->id, $comment->id]) }}" method="POST" class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce commentaire ?')"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div>Aucun commentaire à afficher</div>
            @endforelse
        </div>
        <a href="{{ route('actions.comments.create', $action->id) }}" class="btn btn-success mb-2">Ajouter un commentaire</a>
    </div>
</div>
@endsection