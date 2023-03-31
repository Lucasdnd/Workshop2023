@extends('adminlte::page')

@section('title', 'Actions - NK informatique')

@section('content_header')
<div class="container">
    <h1>Modifier une action</h1>
</div>
@stop

@section('content')
<div class="container">
    <form action="{{ route('actions.update', $action) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="type">Type</label>
            <select class="form-control" id="type" name="type">
                <option value="call" {{ $action->type === 'call' ? 'selected' : '' }}>Appel</option>
                <option value="email" {{ $action->type === 'email' ? 'selected' : '' }}>Email</option>
                <option value="meeting" {{ $action->type === 'meeting' ? 'selected' : '' }}>Rendez-vous</option>
                <option value="note" {{ $action->type === 'note' ? 'selected' : '' }}>Note</option>
                <option value="other" {{ $action->type === 'other' ? 'selected' : '' }}>Autre</option>
            </select>
        </div>

        <div class="form-group">
            <label for="comment">Commentaire</label>
            <textarea class="form-control" id="comment" name="comment">{{ $action->comment }}</textarea>
        </div>

        <div class="form-group">
            <label for="scheduled_at">Date planifiée</label>
            <input type="datetime-local" class="form-control" name="scheduled_at" value="{{ $action->scheduled_at }}">
        </div>

        <div class="form-group">
            <label for="contact_id">Contact</label>
            <select class="form-control" id="contact_id" name="contact_id">
                @foreach ($contacts as $contact)
                <option value="{{ $contact->id }}" {{ $contact->id == $action->contact_id ? 'selected' : '' }}>
                    {{ $contact->first_name }} {{ $contact->last_name }} ({{ $contact->email }})
                </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
</div>
@stop