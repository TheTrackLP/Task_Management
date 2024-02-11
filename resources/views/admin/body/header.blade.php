<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Task</title>
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <link href="{{ asset('assets/vendor/datatables/DataTables-1.13.8/css/jquery.dataTables.min.css') }}"
        rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Summmnote -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet" />
</head>

<body class="sb-nav-fixed">
    @php
    $id = Auth::user()->id;
    $profileData = App\Models\User::find($id);
    @endphp @include('admin.body.navbar')
    <div id="layoutSidenav">
        @include('admin.body.sidebar')
        <div id="layoutSidenav_content">
            @yield('admin')
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('assets/demo/chart-bar-demo.js') }}"></script>>

    <script src="{{ asset('assets/vendor/datatables/jQuery-3.7.0/jquery-3.7.0.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/DataTables-1.13.8/js/jquery.dataTables.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{ asset('assets/js/sweat-alertDelete.js') }}"></script>

    <!-- Summernote JS -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>


</body>

</html>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
@if(Session::has('message'))
var type = "{{ Session::get('alert-type','info') }}"
switch (type) {
    case 'info':
        toastr.info(" {{ Session::get('message') }} ");
        break;

    case 'success':
        toastr.success(" {{ Session::get('message') }} ");
        break;

    case 'warning':
        toastr.warning(" {{ Session::get('message') }} ");
        break;

    case 'error':
        toastr.error(" {{ Session::get('message') }} ");
        break;
}
@endif

$(document).ready(function() {
    $('#dataTable').DataTable();
});

$(document).ready(function() {
    $('#ActiveTable').DataTable();
});

$(document).ready(function() {
    $('#UserTable').DataTable();
});

$(document).ready(function() {
    $('#borrowerTable').DataTable();
});

$("#summernote").summernote({
    tabsize: 2,
    height: 300,
});

$("#sm2").summernote({
    tabsize: 2,
    height: 300,
});
</script>