<style type="text/css">
    div#checkstates {
        float: right;
        margin-right: 7em;
    }
</style>

<div id="checkstates">
    <!-- loading ... waiting for response -->
    <span title="loading" id="loading_little"></span>
</div>

<script type="text/javascript">
    printStatus('{{ route('get.checkstate.status', ['id' => $wallet['id']]) }}', 'checkstates');
</script>
