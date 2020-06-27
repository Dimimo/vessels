@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header"><h3>All Vessels</h3></div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Nickname</th>
                        <th scope="col">Operator</th>
                        <th scope="col">Vessel type</th>
                        <th scope="col">Capacity</th>
                        <th scope="col">Captain</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($vessels as $vessel)
                        <tr>
                            <th scope="row">{{ $vessel->id }}</th>
                            <td><a href="{{ route('vessel.show', [$vessel->slug]) }}">{{ $vessel->name }}</a></td>
                            <td>{{ $vessel->nickname }}</td>
                            <td>{{ @$vessel->operator->name }}</td>
                            <td>{{ $vessel->type->name }}</td>
                            <td>{{ $vessel->capacity }}</td>
                            <td>{{ $vessel->captain->name }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection