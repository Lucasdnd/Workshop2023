@extends('adminlte::page')

@section('title', 'Commentaires - NK informatique')

@section('content_header')
<div class="container">
    <h1>Ajouter un commentaire</h1>
</div>
@stop

@section('content')
<div class="container">
    <form action="{{ route('actions.comments.store', $action->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="comment">Commentaire :</label>
            <textarea name="comment" id="comment" required class="form-control">{{ old('comment') }}</textarea>
        </div>
        <button class="btn btn-primary" type="submit">Ajouter le commentaire</button>
    </form>
</div>
@endsection