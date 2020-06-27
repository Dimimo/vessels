@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header"><h3>Ports of entry</h3></div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">City</th>
                        <th scope="col">Contact nr</th>
                        <th scope="col">contact name</th>
                        @can('official_info')
                            <th scope="col">Emergency nr</th>
                            <th scope="col" title="Emergency name">Name</th>
                        @endcan
                        <th scope="col"><span class="fas fa-ship" title="Number of Operators connected to this port"></span></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($ports as $port)
                        <tr>
                            <th scope="row">{{ $port->id }}</th>
                            <td>
                                @can('edit own ports')
                                    <a href="{{ route('port.edit', [$port->id, $port->slug]) }}" title="Edit this port">
                                        <span class="fas fa-edit smaller-80 grey"></span>
                                    </a>
                                @endcan
                                <a href="{{ route('port.show', [$port->id, $port->slug]) }}">{{ $port->name }}</a>
                            </td>
                            <td>{{ $port->city->name }}</td>
                            <td>{{ $port->contact_nr }}</td>
                            <td>{{ $port->contact_name }}</td>
                            @can('official_info')
                                <td class="brown">{{ $port->emergency_nr }}</td>
                                <td class="brown">{{ $port->emergency_name }}</td>
                            @endcan
                            <td>{{ $port->operators()->count() }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection