@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Company Profile</h1>

    <form method="POST" action="{{ route('company-profiles.store') }}">
        @csrf

        <div class="mb-3">
            <label for="company_name" class="form-label">Company Name</label>
            <input type="text" name="company_name" id="company_name" class="form-control"
                   value="{{ old('company_name') }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" required>{{ old('description') }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Create</button>
    </form>
</div>
@endsection
