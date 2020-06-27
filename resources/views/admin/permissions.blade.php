@extends('layouts.app')

@section('content')

    <div class="container">

        <h3 class="text-center mb-4">View and change the roles and permissions table</h3>
        <h5 class="col-md-10 offset-md-1 box-rounded-orange text-center mb-4">
            <span class="fas fa-exclamation-triangle red"></span>
            Be careful what you do here! <u>Don't give permissions</u> to users who shouldn't have access
            <span class="fas fa-exclamation-triangle red"></span>
        </h5>

        {!! $table !!}
    </div>

    <div id="snackbar"></div>

@endsection

@push('js')
    <script>
        const $permissions = {!! $permissions !!};
        //add styles to the table
        $('table').addClass('table table-bordered table-sm table-hover');
        const $header_ths = $('thead > tr').find('th');
        $($header_ths).addClass('bg-info text-center');
        $($header_ths[0]).removeClass('text-center').addClass('text-right');
        const $header = $($('thead')[0]).html();
        const $trs = $('tbody').children();
        $trs.each(function () {
            //repeat the header every 15 rows
            let $index = $(this).index();
            if ($index % 15 === 0 && $index !== 0) {
                $(this).after($header);
            }
            //center the cells, except the first one
            let $tds = $(this).children();
            $($tds).addClass('editable text-center').attr('id', function (arr) {
                if (arr !== 0) {
                    let $perm_index = $permissions[$($tds[0]).text()];
                    return 'cell_' + $perm_index + '_' + --arr;
                }
            }).attr('style', function (arr) {
                if (arr !== 0) {
                    return 'cursor: pointer;';
                }
            });
            $($tds[0]).removeClass('editable text-center').addClass('font-weight-bold text-right');
        });

        //a cell has been clicked
        $('.editable').click(function (e) {
            e.preventDefault();
            let id = $(this).prop('id');
            let val = $(this).text() === '✔' ? '1' : '0';
            let _token = $('meta[name="csrf-token"]').attr('content');
            $(this).removeClass('font-weight-bold green').html('<span class="fas fa-sync fa-spin fa-fw"></span>');
            $.ajax({
                type: 'POST',
                url: '{{ route('admin.permissions.change') }}',
                data: {id, val, _token},
                context: this,
                dataType: 'json',
                success: function (data) {
                    let $cell = $('#' + data.id);
                    data.val === "1" ? $cell.text('✔') : $cell.text('');
                    let access = '';
                    if (data.val === "1") {
                        $cell.text('✔');
                        $cell.addClass('font-weight-bold green');
                        access = 'now';
                    } else {
                        $cell.text('');
                        access = 'no more';
                    }
                    if (data.hasOwnProperty('error')) {
                        snackbar(data.error, 'error');
                    } else {
                        snackbar(
                            'The role <strong>'
                            + data.role + '</strong> has <u>'
                            + access + ' access</u> to the permission <strong>'
                            + data.permission + '</strong>',
                            'success'
                        );
                    }
                }
            })
        });

        function snackbar(message, c) {
            const x = $("div#snackbar");
            x.addClass('show ' + c).html(message);
            setTimeout(function () {
                x.removeClass('show ' + c);
            }, 4000);
        }
    </script>
@endpush
