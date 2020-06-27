@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header"><h3>Administration</h3></div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Real Name</th>
                        <th scope="col" title="Super Administrator"><span class="fas fa-user-tie"></span></th>
                        <th scope="col" title="Administrator"><span class="fas fa-user-cog"></span></th>
                        <th scope="col" title="Editor"><span class="fas fa-user-edit"></span></th>
                        <th scope="col" title="Statistical"><span class="fas fa-chart-bar"></span></th>
                        <th scope="col" title="Port Authority"><span class="fas fa-broadcast-tower"></span></th>
                        <th scope="col" title="Operator"><span class="fas fa-ship"></span></th>
                        <th scope="col" title="Agent"><span class="fas fa-atlas"></span></th>
                        <th scope="col" title="Captain"><span class="fas fa-dharmachakra"></span></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <th scope="row">{{ $user->id }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->contact_name }}</td>
                            <td>@if ($user->is_super_admin) <span class="fas fa-check"></span> @endif</td>
                            <td>@if ($user->is_admin) <span class="fas fa-user-cog"></span> @endif</td>
                            <td>@if ($user->is_editor) <span class="fas fa-user-edit"></span> @endif</td>
                            <td>@if ($user->is_statistical) <span class="fas fa-chart-bar"></span> @endif</td>
                            <td>@if ($user->is_port_authority) <span class="fas fa-broadcast-tower"></span> @endif</td>
                            <td>@if ($user->is_operator) <span class="fas fa-ship"></span> @endif</td>
                            <td>@if ($user->is_agent) <span class="fas fa-atlas"></span> @endif</td>
                            <td>@if ($user->is_captain) <span class="fas fa-dharmachakra"></span> @endif</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection