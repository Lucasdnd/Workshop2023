@extends('adminlte::page')

@section('title', 'Dashboard - NK informatique')

@section('content_header')

@section('content')
<div class="container">
    @if ($errors->has('email'))
<div class="alert alert-danger" role="alert">
    L'adresse email est déjà utilisée.
</div>
    @endif
    <h1>Create Contact</h1>
    <form method="POST" action="{{ route('contact.store') }}">
        @csrf
        <div class="form-group">
            <label for="first_name">First Name</label>
            <input type="text" class="form-control" name="first_name" id="first_name" value="{{ old('first_name') }}" required>
        </div>
        <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="text" class="form-control" name="last_name" id="last_name" value="{{ old('last_name') }}">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" class="form-control" name="phone" id="phone" value="{{ old('phone') }}" required>
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control" name="address" id="address" value="{{ old('address') }}" required>
        </div>
        <div class="form-group">
            <label for="city">City</label>
            <input type="text" class="form-control" name="city" id="city" value="{{ old('city') }}" required>
        </div>
        <div class="form-group">
            <label for="state">State</label>
            <input type="text" class="form-control" name="state" id="state" value="{{ old('state') }}" required>
        </div>
        <div class="form-group">
            <label for="zip_code">Zip Code</label>
            <input type="text" class="form-control" name="zip_code" id="zip_code" value="{{ old('zip_code') }}" required>
        </div>
        <div class="form-group">
            <label for="country">Country</label>
            <input type="text" class="form-control" name="country" id="country" value="{{ old('country') }}" required>
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" name="status" id="status" required>
                <option value="">-- Select status --</option>
                <option value="lead" {{ old('status') == 'lead' ? 'selected' : '' }}>Lead</option>
                <option value="prospect" {{ old('status') == 'prospect' ? 'selected' : '' }}>Prospect</option>
                <option value="client" {{ old('status') == 'client' ? 'selected' : '' }}>Client</option>
                <option value="dead_lead" {{ old('status') == 'dead_lead' ? 'selected' : '' }}>Dead lead</option>
                <option value="dead_prospect" {{ old('status') == 'dead_prospect' ? 'selected' : '' }}>Dead prospect</option>
            </select>
        </div>
        <div class="form-group">
            <label for="type">Type</label>
            <select class="form-control" name="type" id="type" required>
                <option value="">-- Select type --</option>
                <option value="B2B" {{ old('type') == 'B2B' ? 'selected' : '' }}>B2B</option>
                <option value="B2C" {{ old('type') == 'B2C' ? 'selected' : '' }}>B2C</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection