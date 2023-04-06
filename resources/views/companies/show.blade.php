@extends('adminlte::page')

@section('title', 'Entreprises - NK informatique')

@section('content_header')
<div class="form-group">
    <a href="{{ route('actions.index') }}" class="btn btn-secondary">Retour</a>
</div>
<div class="container">
    <h1>Détails de {{ $company->name }}</h1>
</div>
@stop

@section('content')
<div class="container">
    <div class="row">
        <table class="table">
            <tr>
                <th>Nom</th>
                <td>{{ $company->name }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $company->email }}</td>
            </tr>
            <tr>
                <th>Téléphone</th>
                <td>{{ $company->phone }}</td>
            </tr>
            <tr>
                <th>Adresse</th>
                <td>{{ $company->address }}</td>
            </tr>
            <tr>
                <th>Ville</th>
                <td>{{ $company->city }}</td>
            </tr>
            <tr>
                <th>État</th>
                <td>{{ $company->state }}</td>
            </tr>
            <tr>
                <th>Code postal</th>
                <td>{{ $company->zip_code }}</td>
            </tr>
            <tr>
                <th>Pays</th>
                <td>{{ $company->country }}</td>
            </tr>
            <tr>
                <th>Contacts</th>
                <td>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Email</th>
                                <th>Téléphone</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($company->contacts as $contact)
                            <tr>
                                <td>{{ $contact->first_name }} {{ $contact->last_name }}</td>
                                <td>{{ $contact->email }}</td>
                                <td>{{ $contact->phone }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </td>
            </tr>
        </table>
    </div>
</div>
@endsection