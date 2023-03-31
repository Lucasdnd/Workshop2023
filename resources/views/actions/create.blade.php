@extends('adminlte::page')

@section('title', 'Actions - NK informatique')

@section('content_header')
<div class="container">
  <h1>Création d'une action</h1>
</div>
@stop

@section('content')
<div class="container">
  <form action="{{ route('actions.store') }}" method="POST">
    @csrf
    <div class="form-group">
      <label for="type">Type :</label>
      <select class="form-control @error('type') is-invalid @enderror" id="type" name="type" value="{{ old('type') }}">
        <option value="call">Appel</option>
        <option value="email">Email</option>
        <option value="meeting">Rendez-vous</option>
        <option value="note">Note</option>
        <option value="other">Autre</option>
      </select>
      @error('type')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>
    <div class="form-group">
      <label for="comment">Commentaire :</label>
      <textarea class="form-control @error('comment') is-invalid @enderror" id="comment" name="comment">{{ old('comment') }}</textarea>
      @error('comment')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>
    <div class="form-group">
      <label for="scheduled_at">Planifiée le :</label>
      <input type="datetime-local" class="form-control @error('scheduled_at') is-invalid @enderror" id="scheduled_at" name="scheduled_at" value="{{ old('scheduled_at') }}">
      @error('scheduled_at')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>
    <div class="form-group">
      <label for="contact_id">Contact :</label>
      <select class="form-control @error('contact_id') is-invalid @enderror" id="contact_id" name="contact_id">
        @foreach ($contacts as $contact)
        <option value="{{ $contact->id }}" {{ old('contact_id') == $contact->id ? 'selected' : '' }}>{{ $contact->first_name }} {{ $contact->last_name }}</option>
        @endforeach
      </select>
      @error('contact_id')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>
    <button type="submit" class="btn btn-primary">Créer</button>
  </form>
</div>
@endsection