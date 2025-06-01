@extends('layouts.jobseeker')

@section('content')
<div class="container">
    <h2 class="mb-4">Job Insights</h2>
    <div class="row">
        @foreach ($insights as $insight)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    @if($insight->image)
                        <img src="{{ asset('storage/'.$insight->image) }}" class="card-img-top" alt="...">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $insight->title }}</h5>
                        <a href="{{ route('job-insight.show', $insight->id) }}" class="btn btn-primary">Read More</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{ $insights->links() }}
</div>
@endsection
