@include('admin.seo.seo_header')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->

</div>

@include('admin.inc.footer')

<script>
    $(function () {
        $('#example1').DataTable()
        $('#example2').DataTable({
            'paging'      : true,
            'lengthChange': false,
            'searching'   : false,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false
        })
    })
</script>
<body>
</body>
</html>
