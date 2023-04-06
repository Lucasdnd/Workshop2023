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
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('contact.importContacts') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="import_file">Fichier CSV d'import :</label>
                                <input type="file" name="import_file" id="import_file" class="form-control-file">
                            </div>
                            <button type="submit" class="btn btn-primary">Importer les contacts</button>
                        </form>
                    </div>
                </div>

                @if(session()->has('success'))
                    <div class="alert alert-success mt-2">
                        {{ session()->get('success') }}
                    </div>
                @endif

                @if(session()->has('error'))
                    <div class="alert alert-danger mt-2">
                        {{ session()->get('error') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
