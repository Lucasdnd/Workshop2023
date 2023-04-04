@extends('adminlte::page')

@section('title', 'Commentaires - NK informatique')

@section('content_header')
<div class="container">
    <h1>Modifier un commentaire</h1>
</div>
@stop

@section('content')
<div class="container">
    <form action="{{ route('actions.comments.update', [$action->id, $comment->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="comment">Commentaire :</label>
            <textarea name="comment" id="comment" required class="form-control">{{ old('comment', $comment->comment) }}</textarea>
        </div>
        <button class="btn btn-primary" type="submit">Modifier</button>
    </form>
</div>
@endsection