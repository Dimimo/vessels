@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header text-center">
                <h3>Administration: updates and tasks</h3>
            </div>
            <div class="card-body">
                <div class="box-rounded-yellow text-center">
                    <h5 class="pt-2">In this section some tasks can be done</h5>
                </div>
                <br/>
                <ul class="list-group">
                    <li class="list-group-item">
                        <a href="{{ route('admin.api.city_list') }}" id="api_city_list">Update the city list for auto complete</a>
                    </li>
                </ul>
                <div id="spinner" style="display: none;"><span class="fas fa-sync fa-spin fa-2x fa-fw"></span></div>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script>
        $('#spinner').hide();
        $('.list-group-item a').click(function (e) {
            e.preventDefault();
            $('#spinner').show();
            const href = $(this).attr('href');
            const id = $(this).attr('id');
            $.ajax({
                url: href,
                type: "GET",
                cache: false,
                dataType: 'json',
                success: function () {
                    $('#spinner').fadeOut().hide();
                    $('#' + id).before('<span class="fas fa-check-circle green"> Done!</span> ').fadeOut(2000);
                }
            });
        });
    </script>
@endpush
