@extends('layouts.jobseeker')

@section('content')
<div class="container">
    <a href="{{ route('job-insight.index') }}" class="btn btn-secondary mb-3">← Back</a>
    <h2>{{ $insight->title }}</h2>
    @if($insight->image)
        <img src="{{ asset('storage/'.$insight->image) }}" class="img-fluid my-3" alt="">
    @endif
    <div>{!! nl2br(e($insight->content)) !!}</div>

    @if($insight->comparison_data)
        <div class="mt-5">
            <h4>Career Comparison</h4>
            <canvas id="comparisonChart"></canvas>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const data = @json(json_decode($insight->comparison_data, true));
            const ctx = document.getElementById('comparisonChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data.labels,
                    datasets: data.datasets
                },
            });
        </script>
    @endif
</div>
@endsection
