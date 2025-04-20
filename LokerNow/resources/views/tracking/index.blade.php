@extends('layouts.app')

@section('content')
    <h1 class="text-xl font-bold mb-4">Job Tracking</h1>

    @if ($trackings->isEmpty())
        <p>No job tracking records found.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Job Title</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($trackings as $tracking)
                    <tr>
                        <td>{{ $tracking->job_title ?? 'N/A' }}</td>
                        <td>{{ $tracking->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
