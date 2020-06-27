@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header"><h3>Vessel Operators</h3></div>
            <div class="card-body">
                <table class="table">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Ports</th>
                        <th scope="col">City</th>
                        <th scope="col">Contact nr</th>
                        @can('official_info')
                            <th scope="col">Emergency nr</th>
                            <th scope="col" title="Emergency name">Name</th>
                        @endcan
                        <th scope="col" title="Number of vessels"><span class="fas fa-ship"></span></th>
                        <th scope="col" title="Departures"><span class="fas fa-plane-departure"></span></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($operators as $operator)
                        <tr>
                            <th scope="row">{{ $operator->id }}</th>
                            <td>
                                @can('edit own operators')
                                    <a href="{{ route('operator.edit', [$operator->id, $operator->slug]) }}" title="Edit this operator">
                                        <span class="fas fa-edit smaller-80 grey"></span>
                                    </a>
                                @endcan
                                <a href="{{ route('operator.show', [$operator->id, $operator->slug]) }}">{{ $operator->name }}</a>
                            </td>
                            <td>
                                @if ($operator->ports->count() == 0)
                                    No port access added as yet
                                @else
                                    <ul class="list-group">
                                        @foreach ($operator->ports as $port)
                                            <a href="{{ route('port.show', [$port->id, $port->slug]) }}"
                                               class="list-group-item list-group-item-action">{{ $port->name }}</a>
                                        @endforeach
                                    </ul>

                                @endif
                            </td>
                            <td>{{ $operator->city->name }}</td>
                            <td>{{ $operator->contact_nr }}</td>
                            @can('official_info')
                                <td class="brown">{{ $operator->emergency_nr }}</td>
                                <td class="brown">{{ $operator->emergency_name }}</td>
                            @endcan
                            <td>{{ count($operator->vessels) }}</td>
                            <td>{{ $operator->departures ? count($operator->departures) : '--' }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection