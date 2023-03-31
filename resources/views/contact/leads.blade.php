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
                    <a href="{{ route('contact.edit', $contact->id) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('contact.destroy', $contact->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this contact?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection