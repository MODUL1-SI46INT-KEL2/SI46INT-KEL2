@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $companyProfile->company_name }}</h1>
    <p>{{ $companyProfile->description }}</p>
    <a href="{{ route('company-profiles.edit', $companyProfile->id) }}" class="btn btn-warning">Edit</a>
</div>
@endsection
