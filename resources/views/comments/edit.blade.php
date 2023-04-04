@extends('adminlte::page')

@section('title', 'Commentaires - NK informatique')

@section('content_header')
<div class="container">
    <h1>Modifier un commentaire</h1>
</div>
@stop

@section('content')
<h1>Edit Comment</h1>
<form action="{{ route('actions.comments.update', [$action->id, $comment->id]) }}" method="POST">
    @csrf
    @method('PUT')
    <div>
        <label for="comment">Comment:</label>
        <textarea name="comment" id="comment" required>{{ old('comment', $comment->comment) }}</textarea>
    </div>
    <button type="submit">Update Comment</button>
</form>
@endsection