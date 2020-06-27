@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header text-center">
                <h3>Vessel operator <strong>{{ $operator->name }}</strong> in <strong>{{ $operator->city->name }}</strong></h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-2"><span class="float-right font-weight-bold">Name</span></div>
                    <div class="col-10">{{ $operator->name }}</div>
                    <div class="w-100"></div>
                    <div class="col-2"><span class="float-right font-weight-bold">Company Name</span></div>
                    <div class="col-10">{{ $operator->company_name }}</div>
                    <div class="w-100"></div>
                    <div class="col-2"><span class="float-right font-weight-bold">City</span></div>
                    <div class="col-10">{{ $operator->city->name }}</div>
                    <div class="w-100"></div>
                    <div class="col-2"><span class="float-right font-weight-bold">Address</span></div>
                    <div class="col-10">
                        {{ $operator->address1 }}<br/>
                        @if ($operator->address2)
                            {{ $operator->address2 }}<br/>
                        @endif
                    </div>
                    <div class="w-100"></div>
                    <div class="col-2"><span class="float-right font-weight-bold">Telephone</span></div>
                    <div class="col-10"> @if ($operator->contact_name)<strong>{{ $operator->contact_name }}</strong><br/>
                        <div class="fas fa-phone-square"></div> {{ $operator->contact_nr }} @endif
                    </div>
                    <div class="w-100"></div>
                    @can('official info')
                        <div class="col-2"><span class="float-right font-weight-bold brown">Emergency</span></div>
                        <div class="col-10 brown"> @if ($operator->emergency_name)
                                <strong>{{ $operator->emergency_name }}</strong><br/>
                                <div class="fas fa-phone-square"></div>  {{ $operator->emergency_nr }}</div> @endif
                    <div class="w-100"></div>
                    @endcan
                    @if ($operator->url)
                        <div class="col-2"><span class="float-right font-weight-bold">Website</span></div>
                        <div class="col-10"><a href="{{ $operator->url }}" target="_blank">{{ $operator->url }}</a></div>
                        <div class="w-100"></div>
                    @endif
                    @if ($operator->facebook)
                        <div class="col-2"><span class="float-right font-weight-bold">Facebook</span></div>
                        <div class="col-10"><a href="{{ $operator->facebook }}" target="_blank">{{ $operator->facebook }}</a></div>
                        <div class="w-100"></div>
                    @endif
                    @if ($operator->twitter)
                        <div class="col-2"><span class="float-right font-weight-bold">Twitter</span></div>
                        <div class="col-10"><a href="{{ $operator->twitter }}" target="_blank">{{ $operator->twitter }}</a></div>
                        <div class="w-100"></div>
                    @endif
                    @if ($operator->instagram)
                        <div class="col-2"><span class="float-right font-weight-bold">Instagram</span></div>
                        <div class="col-10"><a href="{{ $operator->instagram }}" target="_blank">{{ $operator->instagram }}</a></div>
                        <div class="w-100"></div>
                    @endif
                    <div class="col-2"><span class="float-right font-weight-bold">Details</span></div>
                    <div class="col-10">
                        <div class="box-rounded-grey mb-3">
                            {!! nl2br($operator->body) !!}
                        </div>
                    </div>
                    <div class="w-100"></div>
                    @if ($operator->official_info)
                        @can('official info')
                            <div class="col-2"><span class="float-right font-weight-bold brown">For Officials</span></div>
                            <div class="col-10 brown">
                                <div class="box-rounded-lime mb-3">
                                    {!! nl2br($operator->official_info) !!}
                                </div>
                            </div>
                            <div class="w-100"></div>
                        @endcan
                    @endif
                </div>

                @if ($operator->vessels->count() > 0)
                    <div class="card bg-light my-3">
                        <div class="card-header"><h4><span class="fas fa-ship dark-green"></span> Vessels run by {{ $operator->name }}</h4></div>
                        <div class="card-body">
                            <ul class="list-group">
                                @foreach ($operator->vessels as $vessel)
                                    <li class="list-group-item">
                                        @if (!$vessel->in_service)
                                            <span class="fa-stack smaller-80" title="Out of service">
                                                <i class="fas fa-ship fa-stack-1x"></i>
                                                <i class="fas fa-ban fa-stack-2x" style="color:Tomato"></i>
                                            </span>
                                        @else
                                            <span class="fa-stack fa smaller-80" title="In service">
                                                <i class="fas fa-circle fa-stack-2x dark-blue"></i>
                                                <i class="fas fa-ship fa-stack-1x fa-inverse"></i>
                                            </span>
                                        @endif
                                        <a href="{{ route('vessel.show', [$vessel->id, $vessel->slug]) }}">{{ $vessel->name }}</a>
                                        ({{ $vessel->type ? $vessel->type->name : 'type unknown' }})
                                        @can('edit own vessels')
                                            <span class="float-right">
                                                <a class="btn btn-success smaller-70" href="{{ route('vessel.edit', [$vessel->id, $vessel->slug]) }}"
                                                   title="Edit the vessel '{{ $vessel->name }}'">
                                                    <span class="fas fa-edit"></span>
                                                </a>
                                            </span>
                                        @endcan
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
            </div>
            @can('edit own operators')
                <div class="card-footer">
                    <div class="row">
                        <div class="col-12">
                            <a class="pr-3 float-right btn btn-success mb-1" href="{{ route('operator.edit', [$operator->id, $operator->slug]) }}">
                                <span class="fas fa-edit"></span> edit {{ $operator->name }}</a>
                        </div>
                        <div class="col-12">
                            <form method="POST" class="float-right" action="{{ route('operator.delete', [$operator->id]) }}"
                                  onsubmit="return confirm('Are you sure you want to delete?');">
                                <input name="_method" type="hidden" value="DELETE">
                                @csrf
                                <button type="submit" class="btn btn-danger" title="Delete {{ $operator->name }}"><i class="fas fa-trash-alt"></i>
                                    Delete {{ $operator->name }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endcan
        </div>
    </div>
@endsection