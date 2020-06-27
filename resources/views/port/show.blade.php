@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header text-center">
                <h3>Show <strong>{{ $port->name }}</strong> in <strong>{{ $port->city_name }}</strong></h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-2"><span class="float-right font-weight-bold">Name</span></div>
                    <div class="col-10">{{ $port->name }}</div>
                    <div class="w-100"></div>
                    <div class="col-2"><span class="float-right font-weight-bold">City</span></div>
                    <div class="col-10">{{ $port->city->name }}</div>
                    <div class="w-100"></div>
                    <div class="col-2"><span class="float-right font-weight-bold">Address</span></div>
                    <div class="col-10">
                        {{ $port->address1 }}<br/>
                        @if ($port->address2)
                            {{ $port->address2 }}<br/>
                        @endif
                    </div>
                    <div class="w-100"></div>
                    <div class="col-2"><span class="float-right font-weight-bold">Telephone</span></div>
                    <div class="col-10"> @if ($port->contact_name)<strong>{{ $port->contact_name }}</strong><br/>
                        <div class="fas fa-phone-square"></div> {{ $port->contact_nr }}</div> @else --- @endif
                    <div class="w-100"></div>
                    @can('official info')
                        <div class="col-2"><span class="float-right font-weight-bold brown">Emergency</span></div>
                        <div class="col-10 brown"> @if ($port->emergency_name)
                                <strong>{{ $port->emergency_name }}</strong><br/>
                                <div class="fas fa-phone-square"></div> {{ $port->emergency_nr }}</div> @else --- @endif
                    <div class="w-100"></div>
                    @endcan
                    @if ($port->url)
                        <div class="col-2"><span class="float-right font-weight-bold">Website</span></div>
                        <div class="col-10"><a href="{{ $port->url }}" target="_blank">{{ $port->url }}</a></div>
                        <div class="w-100"></div>
                    @endif
                    @if ($port->facebook)
                        <div class="col-2"><span class="float-right font-weight-bold">Facebook</span></div>
                        <div class="col-10"><a href="{{ $port->facebook }}" target="_blank">{{ $port->facebook }}</a></div>
                        <div class="w-100"></div>
                    @endif
                    @if ($port->twitter)
                        <div class="col-2"><span class="float-right font-weight-bold">Twitter</span></div>
                        <div class="col-10"><a href="{{ $port->twitter }}" target="_blank">{{ $port->twitter }}</a></div>
                        <div class="w-100"></div>
                    @endif
                    @if ($port->instagram)
                        <div class="col-2"><span class="float-right font-weight-bold">Instagram</span></div>
                        <div class="col-10"><a href="{{ $port->instagram }}" target="_blank">{{ $port->instagram }}</a></div>
                        <div class="w-100"></div>
                    @endif
                    <div class="col-2"><span class="float-right font-weight-bold">Details</span></div>
                    <div class="col-10">
                        <div class="box-rounded-grey mb-3">
                            {!! nl2br($port->body) !!}
                        </div>
                    </div>
                    <div class="w-100"></div>
                    @if ($port->official_info)
                        @can('official info')
                            <div class="col-2"><span class="float-right font-weight-bold brown">For Officials</span></div>
                            <div class="col-10 brown">
                                <div class="box-rounded-lime mb-3">
                                    {!! nl2br($port->official_info) !!}
                                </div>
                            </div>
                            <div class="w-100"></div>
                        @endcan
                    @endif
                </div>
                @if ($port->operators->count() > 0)
                    <div class="card bg-light my-3">
                        <div class="card-header"><h4><span class="fas fa-ship dark-green"></span> Active operators in {{ $port->name }}</h4></div>
                        <div class="card-body">
                            <ul class="list-group">
                                @foreach ($port->operators as $operator)
                                    <li class="list-group-item">
                                        <a href="{{ route('operator.show', [$operator->id, $operator->name]) }}">{{ $operator->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
            </div>
            @can('edit own port')
                <div class="card-footer">
                    <div class="row">
                        <div class="col-12">
                            <a class="pr-3 float-right btn btn-success mb-1" href="{{ route('port.edit', [$port->id, $port->slug]) }}">
                                <span class="fas fa-edit"></span> edit {{ $port->name }}</a>
                        </div>
                        <div class="col-12">
                            <form method="POST" class="float-right" action="{{ route('port.delete', [$port->id]) }}"
                                  onsubmit="return confirm('Are you sure you want to delete?');">
                                <input name="_method" type="hidden" value="DELETE">
                                @csrf
                                <button type="submit" class="btn btn-danger" title="Delete {{ $port->name }}"><i class="fas fa-trash-alt"></i>
                                    Delete {{ $port->name }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endcan
        </div>
    </div>
@endsection
