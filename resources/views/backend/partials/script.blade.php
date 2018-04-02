<script data-exec-on-popstate>
    /**
     * MORE SCRIPTS
     */
    $(function () {
        @foreach($script as $s)
            {!! $s !!}
        @endforeach
    });
</script>