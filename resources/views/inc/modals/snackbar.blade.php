{{--
show the snackbar remark, this a a message box that comes up center bottom of the page
the message is shown in the box, 'c' makes the color of the box. If nothing is given, the box is darkgrey with white letters
options for 'c' are success, warning, error or null
you HAVE to add this somewhere in the html body: <div id="snackbar">my text</div> this is not standard
--}}

<script>
    function snackbar(message, c) {
        const x = $("div#snackbar");
        x.addClass('show ' + c).html(message);
        setTimeout(function () {
            x.removeClass('show ' + c);
        }, 4000);
    }
</script>
