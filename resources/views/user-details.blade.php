@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h2>Your profile</h2>

                <div class="container">
                    <p><strong>First name:</strong> {{ $agent->first_name }}</p>
                    <p><strong>Last name:</strong> {{ $agent->last_name }}</p>
                    <p><strong>Age:</strong> {{ $agent->age }}</p>
                    <p><strong>Gender:</strong> {{ $agent->gender }}</p>
                    <p><strong>Zip code:</strong> {{ $agent->zip_code }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
