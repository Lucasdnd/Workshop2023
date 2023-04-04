<!-- Vue Blade -->
@extends('adminlte::page')

@section('title', 'Leads - NK informatique')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <a href="{{ route('contact.create') }}" class="btn btn-primary">Create Contact</a>
</div>
@endsection

@section('content')
<div class="container">
    <h1>{{ ucfirst(request()->segment(1)) }}</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Company</th>
                <th>Type</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contacts as $contact)
            <tr>
                <td>{{ $contact->first_name }}</td>
                <td>{{ $contact->email }}</td>
                <td>{{ $contact->phone }}</td>
                <td>{{ $contact->company ? $contact->company->name : '' }}</td>
                <td>{{ $contact->type }}</td>
                <td>
                    <a href="mailto:{{ $contact->email }}" class="btn btn-outline-success"><i class="fas fa-envelope"></i></a>
                    <a href="tel:{{ $contact->phone }}" class="btn btn-outline-success mr-4"><i class="fas fa-phone"></i></a>

                    <a href="{{ route('contact.show', $contact->id) }}" class="btn btn-info"><i class="fas fa-user"></i></a>
                    <a href="{{ route('contact.edit', $contact->id) }}" class="btn btn-primary"><i class="fas fa-pencil-alt"></i></a>
                    <form action="{{ route('contact.destroy', $contact->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this contact?')"><i class="fas fa-trash-alt"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
