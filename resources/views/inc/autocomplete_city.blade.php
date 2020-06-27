@push('css')
    <link rel="stylesheet" href="/css/jquery.autocomplete.css">
@endpush

@push('js')

    <script src="/js/jquery.autocomplete.js"></script>
    <script src="/storage/cities.js"></script>
    <script>
        $(function () {
            $("input#{{ $field }}").autocomplete({
                minLength: 2,
                dropdownWidth: 'auto',
                source: [cities]
            });
        });
    </script>

@endpush
