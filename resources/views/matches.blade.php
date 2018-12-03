@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h2>Hi {{ $agent->first_name }}, this are your contact matches for the zip code {{ $agent->zip_code }}</h2>

            <form method="GET" action="{{ route('matches') }}">
                @csrf

                <form class="form-inline">
                    <div class="form-group mb-2">
                        <label for="search-radius" class="">Search radius (in meters)</label>
                        <input type="number" id="search-radius" name="search_radius" value="{{ $searchRadius }}">
                        <button type="submit" class="btn btn-primary mb-2">Search</button>
                    </div>
                </form>
            </form>

            @if ($matchedContacts->count() > 0)
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First name</th>
                        <th scope="col">Last name</th>
                        <th scope="col">Profession</th>
                        <th scope="col">Zip Code</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($matchedContacts as $contact)
                            <tr>
                                <th scope="row">{{ $loop->index }}</th>
                                <td>{{ $contact->first_name }}</td>
                                <td>{{ $contact->last_name }}</td>
                                <td>{{ $contact->profession->name }}</td>
                                <td>{{ $contact->zip_code }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>We're sorry looks like we couldn't find any contact near you.</p>
            @endif
        </div>
    </div>
</div>
@endsection
