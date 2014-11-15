@extends('layouts.default')

@section('content')
    <h1>Patient Table {{ link_to_route('login.destroy', 'Logout', [], ['class' => 'btn btn-default pull-right']) }}</h1>

    <form class="form-search">
        <input type="text" class="input-medium search-query">
        <button type="submit" class="btn">Search</button>
        {{ link_to_route('patient.create', 'Create', [], ['class' => 'btn btn-info']) }}
    </form>

    <table class="table table-hover table-condensed">
        <thead>
            <tr>
                <th>Personal Health  Number</th>
                <th>Full Name</th>
                <th>Preferred Name</th>
                <th>Sex</th>
                <th>Date of Birth</th>
            </tr>
        </thead>

        <tbody>
            @foreach($patients as $patient)
            <tr>
                <td>{{ $patient->phn }}</td>
                <td>{{ $patient->name }}</td>
                <td>{{ $patient->preferred_name }}</td>
                <td>{{ $patient->sex }}</td>
                <td>{{ $patient->date_of_birth }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div>
        {{ $patients->appends(Request::except('page'))->links() }}
    </div>
@stop
