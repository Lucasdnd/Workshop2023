<!-- Vue Blade : edit.blade.php -->
@extends('adminlte::page')

@section('title', 'Edit Contact')

@section('content_header')
    <h1>Edit Contact</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <form action="{{ route('contacts.update', $contact->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="first_name">First Name:</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $contact->first_name }}" required>
                </div>

                <div class="form-group">
                    <label for="last_name">Last Name:</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $contact->last_name }}">
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $contact->email }}" required>
                </div>

                <div class="form-group">
                    <label for="phone">Phone:</label>
                    <input type="tel" class="form-control" id="phone" name="phone" value="{{ $contact->phone }}">
                </div>

                <div class="form-group">
                    <label for="address">Address:</label>
                    <input type="text" class="form-control" id="address" name="address" value="{{ $contact->address }}">
                </div>

                <div class="form-group">
                    <label for="city">City:</label>
                    <input type="text" class="form-control" id="city" name="city" value="{{ $contact->city }}">
                </div>

                <div class="form-group">
                    <label for="state">State:</label>
                    <input type="text" class="form-control" id="state" name="state" value="{{ $contact->state }}">
                </div>

                <div class="form-group">
                    <label for="zip_code">Zip Code:</label>
                    <input type="text" class="form-control" id="zip_code" name="zip_code" value="{{ $contact->zip_code }}">
                </div>

                <div class="form-group">
                    <label for="country">Country:</label>
                    <input type="text" class="form-control" id="country" name="country" value="{{ $contact->country }}">
                </div>

                <div class="form-group">
                    <label for="status">Status:</label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="">-- Select a status --</option>
                        <option value="lead" @if ($contact->status == 'lead') selected @endif>Lead</option>
                        <option value="prospect" @if ($contact->status == 'prospect') selected @endif>Prospect</option>
                        <option value="client" @if ($contact->status == 'client') selected @endif>Client</option>
                        <option value="dead_lead" @if ($contact->status == 'dead_lead') selected @endif>Dead Lead</option>
                        <option value="dead_prospect" @if ($contact->status == 'dead_prospect') selected @endif>Dead Prospect</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="type">Type:</label>
                    <select class="form-control" id="type" name="type" required>
                        <option value="">-- Select a type --</option>
                        <option value="B2B" @if ($contact->type == 'B2B') selected @endif>B2B</option>
                        <option value="B2C" @if ($contact->type == 'B2C') selected @endif>B2C</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Update Contact</button>
            </form>
        </div>
    </div>
@stop
