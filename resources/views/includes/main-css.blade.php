<!-- Dropezone CSS -->

<!-- BEGIN: Vendor CSS-->
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/vendors.min.css">
<!-- END: Vendor CSS-->

<!-- BEGIN: Theme CSS-->
<link rel="stylesheet" type="text/css" href="/app-assets/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/bootstrap-extended.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/colors.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/components.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/themes/dark-layout.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/themes/bordered-layout.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/themes/semi-dark-layout.css">

<!-- BEGIN: Page CSS-->
<link rel="stylesheet" type="text/css" href="/app-assets/css/core/menu/menu-types/horizontal-menu.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/plugins/forms/form-validation.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/pages/page-auth.css">
<!-- END: Page CSS-->

<!-- BEGIN: Custom CSS-->
<link rel="stylesheet" type="text/css" href="/assets/css/style.css">

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/tables/datatable/rowGroup.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css">

 <link href="{{asset('css/mdb.lite.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/some.css')}}" rel="stylesheet">
    <link href="{{asset('css/system.css')}}" rel="stylesheet">
    <link href="{{asset('css/mdb-file-upload.min.css')}}" rel="stylesheet">
@yield('third_party_stylesheets')

@livewireStyles

@stack('page_css')

<style>
    div.dataTables_wrapper div.dataTables_length select {
        width: 65px;
        display: inline-block;
    }
</style>
