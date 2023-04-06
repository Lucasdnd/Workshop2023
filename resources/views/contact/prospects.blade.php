<!-- Vue Blade -->
@extends('adminlte::page')

@section('title', 'Leads - NK informatique')

@section('content_header')
<div class="container">
    <h1>Prospects</h1>
</div>
@endsection

@section('content')
<div class="container">
<a href="{{ route('contact.create') }}" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Créer un nouveau contact</a>
    <table class="table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Entreprise</th>
                <th>Type</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contacts as $contact)
            <tr>
                <td>{{ $contact->first_name }}</td>
                <td>{{ $contact->last_name }}</td>
                <td>{{ $contact->email }}</td>
                <td>{{ $contact->phone }}</td>
                <td>{{ $contact->company ? $contact->company->name : '' }}</td>
                <td>{{ $contact->type }}</td>
                <td>
                    <a href="mailto:{{ $contact->email }}" target="_blank" onclick="updateContactStatus('{{ route('update-contact-status', ['id' => $contact->id, 'status' => 'prospect']) }}')" class="btn btn-outline-success"><i class="fas fa-envelope"></i></a>
                    <a href="tel:{{ $contact->phone }}" onclick="updateContactStatus('{{ route('update-contact-status', ['id' => $contact->id, 'status' => 'prospect']) }}')" class="btn btn-outline-success"><i class="fas fa-phone"></i></a>
                    <a href="#" onclick="validateSale('{{ route('update-contact-status', ['id' => $contact->id, 'status' => 'client']) }}'); location.reload();" class="btn btn-outline-success mr-4"><i class="fas fa-shopping-cart"></i></a>

                    <a href="{{ route('contact.show', $contact->id) }}" class="btn btn-info"><i class="fas fa-eye"></i></a>
                    <a href="{{ route('contact.edit', $contact->id) }}" class="btn btn-primary"><i class="fas fa-pencil-alt"></i></a>
                    <form action="{{ route('contact.destroy', $contact->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Etes vous sur de vouloir supprimer ce contact ?')"><i class="fas fa-trash-alt"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
@section('js')
<script>
function updateContactStatus(url) {
    fetch(url, {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        credentials: 'same-origin'
    }).then(function(response) {
        if (!response.ok) {
            throw Error(response.statusText);
        }
        return response;
    }).catch(function(error) {
        console.error('There was a problem with the fetch operation:', error);
    });
}
function validateSale(url) {
    if (confirm('Etes vous sûr de vouloir valider une vente avec ce client ?')) {
        updateContactStatus(url);
    }
}

</script>
@endsection
