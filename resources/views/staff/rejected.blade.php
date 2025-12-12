@extends('layouts.app')

@section('title', 'Application Rejected')

@section('content')
<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <h1>Application Status</h1>
            <h2>Rejected</h2>
            <p>Your application was rejected. For questions, please contact support.</p>
        </div>
        <div class="auth-footer">
            <p><a href="{{ route('index') }}">Return to Home</a></p>
        </div>
    </div>
</div>
@endsection

