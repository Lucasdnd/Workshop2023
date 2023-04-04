@extends('adminlte::page')

@section('title', 'Commentaires - NK informatique')

@section('content_header')
<div class="container">
    <h1>Ajouter un commentaire</h1>
</div>
@stop

@section('content')
<form action="{{ route('actions.comments.store', $action->id) }}" method="POST">
    @csrf
    <div>
        <label for="comment">Commentaire :</label>
        <textarea name="comment" id="comment" required>{{ old('comment') }}</textarea>
    </div>
    <button type="submit">Ajouter le commentaire</button>
</form>
@endsection