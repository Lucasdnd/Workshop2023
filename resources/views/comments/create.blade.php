@extends('adminlte::page')

@section('title', 'Commentaires - NK informatique')

@section('content_header')
<div class="container">
    <h1>Ajouter un commentaire</h1>
</div>
@stop

@section('content')
<h1>Add Comment</h1>
<form action="{{ route('actions.comments.store', $action->id) }}" method="POST">
    @csrf
    <div>
        <label for="comment">Comment:</label>
        <textarea name="comment" id="comment" required>{{ old('comment') }}</textarea>
    </div>
    <button type="submit">Add Comment</button>
</form>
@endsection