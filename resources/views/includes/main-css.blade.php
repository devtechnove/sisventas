<!-- Dropezone CSS -->
<link rel="stylesheet" href="{{ asset('css/dropzone.css') }}">
<!-- CoreUI CSS -->
<link rel="stylesheet" href="{{ mix('css/app.css') }}" crossorigin="anonymous">

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/tables/datatable/rowGroup.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css">

@yield('third_party_stylesheets')

@livewireStyles

@stack('page_css')

<style>
    div.dataTables_wrapper div.dataTables_length select {
        width: 65px;
        display: inline-block;
    }
</style>
