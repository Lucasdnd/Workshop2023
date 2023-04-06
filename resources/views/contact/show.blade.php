@extends('adminlte::page')

@section('title', 'Contacts - NK informatique')

@section('content_header')
<div class="form-group">
    <a href="{{ URL::previous() }}" class="btn btn-secondary">Retour</a>
</div>

<div class="container">
    <h1>Détails du contact</h1>
</div>
@stop
@section('content')

<div class="container">
    <table class="table">
        <tbody>
            <tr>
                <th>Status :</th>
                <td>{{ $contact->status }}</td>
            </tr>
            <tr>
                <th>Nom :</th>
                <td>{{ $contact->first_name }}</td>
            </tr>
            <tr>
                <th>Prénom :</th>
                <td>{{ $contact->last_name }}</td>
            </tr>
            <tr>
                <th>Email :</th>
                <td>{{ $contact->email }}</td>
            </tr>
            <tr>
                <th>Téléphone :</th>
                <td>{{ $contact->phone }}</td>
            </tr>
            <tr>
                <th>Entreprise :</th>
                <td>{{ $contact->company ? $contact->company->name : '' }}</td>
            </tr>
            <tr>
                <th>Type :</th>
                <td>{{ $contact->type }}</td>
            </tr>
            <tr>
                <th>Pays :</th>
                <td>{{ $contact->country }}</td>
            </tr>
            <tr>
                <th>Province :</th>
                <td>{{ $contact->state }}</td>
            </tr>
            <tr>
                <th>Ville :</th>
                <td>{{ $contact->city }}</td>
            </tr>
            <tr>
                <th>Adresse :</th>
                <td>{{ $contact->address }}</td>
            </tr>
            <tr>
                <th>Code Postal :</th>
                <td>{{ $contact->zip_code }}</td>
            </tr>
        </tbody>
    </table>
    <div class="mt-3">
        <a href="{{ route('contact.edit', $contact->id) }}" class="btn btn-primary">Modifier</a>
        <form action="{{ route('contact.destroy', $contact->id) }}" method="POST" class="d-inline-block">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce contact ?')">Supprimer</button>
        </form>
    </div>
    <div class="mt-5">
        <h2>Actions liées</h2>

        @if ($actions->count())
        <table class="table">
            <thead>
                <tr>
                    <th>Type</th>
                    <th>Commentaire</th>
                    <th>Date planifiée</th>
                    <th>Réalisée</th>
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
                    <td class="text-center">
                        @if ($action->is_done)
                        <i class="fas fa-check"></i>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('actions.show', $action->id) }}" class="btn btn-info"><i class="fas fa-eye"></i></a>
                        <a href="{{ route('actions.edit', $action->id) }}" class="btn btn-primary"><i class="fas fa-pencil-alt"></i></a>
                        <form action="{{ route('actions.destroy', ['action' => $action->id, 'source' => 'contact']) }}" method="POST" class="d-inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette action ?')"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p>Aucune action n'a été trouvée pour ce contact.</p>
        @endif
    </div>
</div>
@endsection