
<script type="application/javascript" src="/js/manifest.js"></script>
<script type="application/javascript" src="/js/vendor.js"></script>
<script type="application/javascript" src="/js/bootstrap.js"></script>

<script type="application/javascript">
        $('.dropdown-button').dropdown();
</script>


<script type="application/javascript">
    window.Laravel = {!! json_encode(['csrfToken' => csrf_token()]) !!};
</script>

{{ $slot }}
