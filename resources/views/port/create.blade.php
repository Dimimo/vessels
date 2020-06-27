@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header"><h3>Create a new Port</h3></div>
            <div class="card-body">
                @include('inc.errors')

                <form method="POST" action="{{ route('port.store') }}">
                    @csrf
                    <div class="box-rounded-lime mb-4 shadow">
                        <h5 class="box-title">This information is the minimum necessary to create a new Port</h5>
                        <div class="form-group">
                            <label for="name">Name of the Port</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><span class="fas fa-user-plus"></span></div>
                                </div>
                                <input type="text"
                                       class="form-control @if ($errors->has('name')) is-invalid @elseif (count($errors) > 0) is-valid @endif"
                                       name="name" id="name" aria-describedby="userHelp" placeholder="" max="255"
                                       value="{{ request()->old('name') }}">
                                @if ($errors->has('name'))
                                    <div class="invalid-feedback ml-5 bigger-110">{{ $errors->first('name') }}</div>
                                @elseif (count($errors) > 0)
                                    <div class="valid-feedback ml-5">Valid Port name</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><span class="fas fa-at"></span></div>
                                </div>
                                <input type="email"
                                       class="form-control{{ $errors->has('email') ? ' is-invalid' : (count($errors) > 0 ? ' is-valid' : '') }}"
                                       name="email" id="email" aria-describedby="emailHelp" placeholder="" max="255"
                                       value="{{ request()->old('email') }}">
                                @if ($errors->has('email'))
                                    <div class="invalid-feedback ml-5 bigger-110">{{ $errors->first('email') }}</div>
                                @elseif (count($errors) > 0)
                                    <div class="valid-feedback ml-5">Valid Email address</div>
                                @endif
                            </div>
                            <small id="emailHelp" class="form-text text-muted">
                                This email is for internal use only. This address will receive the auto generated reports.
                            </small>
                        </div>
                        <div class="form-group">
                            <label for="city_id">City</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><span class="fas fa-map"></span></div>
                                </div>
                                <input type="text"
                                       class="form-control{{ $errors->has('city_id') ? ' is-invalid' : (count($errors) > 0 ? ' is-valid' : '') }}"
                                       name="city_id" id="city_id" aria-describedby="cityIdHelp" placeholder="(start typing)" max="255"
                                       value="{{ request()->old('city_id') }}">
                                @if ($errors->has('city_id'))
                                    <div class="invalid-feedback ml-5 bigger-110 visible">{{ $errors->first('city_id') }}</div>
                                @elseif (count($errors) > 0)
                                    <div class="valid-feedback ml-5">Valid city</div>
                                @endif
                            </div>
                            <small id="cityIdHelp" class="form-text text-muted">
                                A city can have more than one Port. Please start typing and <strong>choose a city from the proposed list</strong>.
                            </small>
                        </div>
                    </div>

                    <div class="box-rounded-grey mb-4 shadow">
                        <h5 class="box-title">The Port's physical address, also useful for people who use GPS</h5>
                        <div class="form-group">
                            <label for="address1">Address line 1</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><span class="fas fa-map-marker-alt dark-blue"></span></div>
                                </div>
                                <input type="text" class="form-control" name="address1" id="address1" aria-describedby="addressHelp"
                                       placeholder="" max="255" value="{{ request()->old('address1') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address1">Address line 2</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><span class="fas fa-map-marker-alt dark-green"></span></div>
                                </div>
                                <input type="text" class="form-control" name="address2" id="address2" placeholder="" max="255"
                                       value="{{ request()->old('address2') }}">
                            </div>
                        </div>
                    </div>

                    <div class="box-rounded-white mb-4 shadow">
                        <h5 class="box-title">Public contact information</h5>
                        <div class="form-group">
                            <label for="contact_nr">Telephone number (public information)</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><span class="fas fa-phone-square dark-blue"></span></div>
                                </div>
                                <input type="text" class="form-control" name="contact_nr" id="contact_nr" aria-describedby="contactHelp"
                                       placeholder="" max="255" value="{{ request()->old('contact_nr') }}">
                            </div>
                            <small id="contactHelp" class="form-text grey">
                                For example a help desk.
                            </small>
                        </div>
                        <div class="form-group">
                            <label for="contact_name">Name or service behind the contact number (public information)</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><span class="fas fa-user-tie dark-blue"></span></div>
                                </div>
                                <input type="text" class="form-control" name="contact_name" id="contact_name" placeholder="" max="255"
                                       value="{{ request()->old('contact_name') }}">
                            </div>
                        </div>
                    </div>

                    <div class="box-rounded-lime mb-4 shadow">
                        <h5 class="box-title">Emergency contact information, for internal use only</h5>
                        <div class="form-group">
                            <label for="emergency_nr">Emergency number (internal information)</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><span class="fas fa-first-aid dark-blue"></span></div>
                                </div>
                                <input type="text" class="form-control" name="emergency_nr" id="emergency_nr" aria-describedby="emergencyHelp"
                                       placeholder="" max="255" value="{{ request()->old('emergency_nr') }}">
                            </div>
                            <small id="emergencyHelp" class="form-text grey">
                                This contact is in case of emergencies ONLY. It is available to Administrators, Port Authorities and Vessel
                                Operators.
                            </small>
                        </div>
                        <div class="form-group">
                            <label for="emergency_name">Person or service behind the emergency number (internal information)</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><span class="fas fa-user-md dark-blue"></span></div>
                                </div>
                                <input type="text" class="form-control" name="emergency_name" id="emergency_name" placeholder="" max="255"
                                       value="{{ request()->old('emergency_name') }}">
                            </div>
                        </div>
                    </div>

                    <div class="box-rounded-white mb-4 shadow">
                        <h5 class="box-title">If the Port has a website or is on social media, please add it here</h5>
                        <div class="form-group">
                            <label for="url">Website of the Port and/or Port Authority</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><span class="fas fa-external-link-alt dark-green"></span></div>
                                </div>
                                <input type="url" class="form-control" name="url" id="url" placeholder="https://" max="255"
                                       value="{{ request()->old('url') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="facebook">FaceBook page of the Port and/or Port Authority</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><span class="fab fa-facebook dark-green"></span></div>
                                </div>
                                <input type="url" class="form-control" name="facebook" id="facebook" placeholder="" max="255"
                                       value="{{ request()->old('facebook') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="twitter">Twitter account of the Port and/or Port Authority</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><span class="fab fa-twitter dark-green"></span></div>
                                </div>
                                <input type="url" class="form-control" name="twitter" id="twitter" placeholder="" max="255"
                                       value="{{ request()->old('twitter') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="instagram">Instagram account of the Port and/or Port Authority</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><span class="fab fa-instagram dark-green"></span></div>
                                </div>
                                <input type="url" class="form-control" name="instagram" id="instagram" placeholder="" max="255"
                                       value="{{ request()->old('instagram') }}">
                            </div>
                        </div>
                    </div>

                    <div class="box-rounded-grey mb-4 shadow">
                        <div class="form-group">
                            <label for="body">Extended info to the <strong>public</strong></label>
                            <div class="input-group">
                                <textarea class="form-control" name="body" id="body" placeholder="">{!! request()->old('body') !!}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="official_info">Extended info for <strong>internal</strong> use only</label>
                            <div class="input-group">
                                <textarea class="form-control" name="official_info" id="official_info"
                                          placeholder="">{!! request()->old('official_info') !!}
                                </textarea>
                            </div>
                        </div>
                    </div>

                    <div class="box-rounded-white mb-4 shadow">
                        <h5 class="box-title">Geographical information for use on Google Maps. If not sure, just ignore.</h5>
                        <div class="form-group">
                            <label for="lat">The Port's latitude</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><span class="fas fa-map-marker-alt"></span></div>
                                </div>
                                <input type="text" class="form-control" name="lat" id="lat" placeholder="" max="255"
                                       value="{{ request()->old('lat') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lng">The Port's longitude</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><span class="fas fa-map-marker-alt"></span></div>
                                </div>
                                <input type="text" class="form-control" name="lng" id="lng" placeholder="" max="255"
                                       value="{{ request()->old('lng') }}">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg btn-block px-5">Create this Port</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@include('inc.autocomplete_city', ['field' => 'city_id'])
