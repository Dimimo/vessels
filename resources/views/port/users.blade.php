@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header text-center"><h3>Port Authority access and Vessel Operators</h3></div>
            <div class="card-body">
                @foreach ($ports as $port)
                    <div class="box-rounded-grey mb-4 shadow">
                        <div class="box-title mb-3"><h5>{{ $port->name }} in {{ $port->city->name }}</h5></div>
                        <div class="row">
                            <div class="col">
                                <h5 class="mb-3">Current Port Authority users</h5>
                                <ul class="list-group">
                                    @foreach ($port->admins as $admin)
                                        <li class="list-group-item">
                                            {{ $admin->name }} <span class="fas fa-info-circle text-muted float-right" data-toggle="tooltip"
                                                                     data-placement="right" data-html="true"
                                                                     title="{{ $admin->city->name }}<br>{{ $admin->contact_nr }}"></span>
                                        </li>
                                    @endforeach
                                </ul>
                                <h5 class="my-3">Vessel Operators in the Port</h5>
                                <ul class="list-group">
                                    @foreach ($port->operators as $operator)
                                        <li class="list-group-item">
                                            {{ $operator->name }}
                                            <span class="fas fa-info-circle text-muted float-right" data-toggle="tooltip"
                                                  data-placement="right" data-html="true"
                                                  title="{{ $operator->company_name }}<br>{{ $operator->city->name }}<br>{{ $operator->contact_nr }}"></span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col">
                                <h5>Edit Port Authority access</h5>
                                <form method="POST" action="{{ route('port.admins.edit') }}">
                                    <input name="_method" type="hidden" value="PUT">
                                    @csrf
                                    <ul class="list-group">
                                        @foreach ($admins as $admin)
                                            <li class="list-group-item">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input admin-edit"
                                                           id="admin[{{ $port->id }}][{{ $admin->id }}]"
                                                           name="admin[{{ $admin->id }}]"
                                                           value="1" {{ $port->admins->contains($admin->id) ? ' checked' : '' }}>
                                                    <label class="custom-control-label"
                                                           for="admin[{{ $port->id }}][{{ $admin->id }}]">{{ $admin->name }}</label>
                                                    <span class="fas fa-info-circle text-muted float-right" data-toggle="tooltip"
                                                          data-placement="right" data-html="true"
                                                          title="{{ $admin->city->name }}<br>{{ $admin->contact_nr }}"></span>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <input name="port_id" type="hidden" value="{{ $port->id }}">
                                    <button type="submit" class="btn btn-block btn-primary text-center my-3">Update PA access
                                        for {{ $port->name }}</button>
                                </form>
                                <div class="text-center">- OR -</div>
                                <form method="POST" action="{{ route('user.external.add') }}">
                                    <input name="_method" type="hidden" value="POST">
                                    @csrf
                                    <input name="model" type="hidden" value="{{ encrypt('Port') }}">
                                    <input name="model_id" type="hidden" value="{{ encrypt($port->id) }}">
                                    <input name="reason" value="{{ encrypt('is_port_authority') }}" type="hidden">
                                    <button type="submit" class="btn btn-block btn-success text-center my-3">Create a new PA User</button>
                                </form>
                            </div>
                            <div class="col">
                                <h5>Add or remove Vessel Operators</h5>
                                <form method="POST" action="{{ route('port.operators.edit') }}">
                                    <input name="_method" type="hidden" value="PUT">
                                    @csrf
                                    <ul class="list-group">
                                        @foreach ($operators as $operator)
                                            <li class="list-group-item">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input operator-edit"
                                                           id="operator[{{ $port->id }}][{{ $operator->id }}]"
                                                           name="operator[{{ $operator->id }}]" {{ $operator->ports->contains($port->id) ? ' checked' : '' }}>
                                                    <label class="custom-control-label"
                                                           for="operator[{{ $port->id }}][{{ $operator->id }}]">{{ $operator->name }}</label>
                                                    <span class="fas fa-info-circle text-muted float-right" data-toggle="tooltip"
                                                          data-placement="right" data-html="true"
                                                          title="{{ $operator->company_name }}<br>{{ $operator->city->name }}<br>{{ $operator->contact_nr }}"></span>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <input name="port_id" type="hidden" value="{{ $port->id }}">
                                    <button type="submit" class="btn btn-primary btn-block align-center my-3">Update operators
                                        for {{ $port->name }}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

{{-- build jsuery for admin-edit and for operator-edit --}}

@push('js')
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
            $('.fa-info-circle').css("cursor", "pointer");
        })
    </script>
@endpush
