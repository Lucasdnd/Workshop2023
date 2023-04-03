@extends('adminlte::page')

@section('title', 'Importer des contacts - NKInformatique')

@section('content_header')
<div class="container">
    <h1>Importer des contacts</h1>
</div>
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('contact.import.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="file">Fichier CSV</label>
                    <input type="file" class="form-control-file @error('file') is-invalid @enderror" id="file" name="file">

                    @error('file')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary"> Importer </button>
            </form>
        </div>
    </div>
</div>
@endsection