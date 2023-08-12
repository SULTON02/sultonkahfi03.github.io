    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
        <meta name="description" content="<?= $web['Description']; ?>" />
        <meta name="keywords" content="<?= $web['Keyword']; ?>" />
        <meta name="author" content="<?= config('web', 'author') ?>" />
        <meta name="robots" content="index, follow" />
        <title><?= $web['NamaWeb']; ?> - <?= config('web', 'title_web') ?></title>

        <link rel="shortcut icon" type="image/x-icon" href="<?= asset('/images/logo/favicon-16x16.png') ?>" />
        <link rel="stylesheet" href="<?= asset('/fonts/Montserrat.css?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600') ?>" />
        <link rel="stylesheet" type="text/css" href="<?= asset('/vendors/css/vendors.min.css') ?>" />

        <!-- BEGIN: Page Vendor CSS -->
        <link rel="stylesheet" type="text/css" href="<?= asset('/vendors/css/animate/animate.min.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?= asset('/vendors/css/charts/apexcharts.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?= asset('/vendors/css/editors/quill/katex.min.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?= asset('/vendors/css/extensions/dragula.min.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?= asset('/vendors/css/extensions/jquery.contextMenu.min.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?= asset('/vendors/css/extensions/jquery.rateyo.min.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?= asset('/vendors/css/extensions/jstree.min.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?= asset('/vendors/css/extensions/nouislider.min.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?= asset('/vendors/css/extensions/plyr.min.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?= asset('/vendors/css/extensions/shepherd.min.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?= asset('/vendors/css/extensions/sweetalert2.min.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?= asset('/vendors/css/extensions/swiper.min.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?= asset('/vendors/css/extensions/tether-theme-arrows.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?= asset('/vendors/css/extensions/tether.min.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?= asset('/vendors/css/extensions/toastr.min.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?= asset('/vendors/css/file-uploaders/dropzone.min.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?= asset('/vendors/css/forms/select/select2.min.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?= asset('/vendors/css/forms/spinner/jquery.bootstrap-touchspin.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?= asset('/vendors/css/forms/wizard/bs-stepper.min.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?= asset('/vendors/css/maps/leaflet.min.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?= asset('/vendors/css/pickers/flatpickr/flatpickr.min.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?= asset('/vendors/css/pickers/pickadate/pickadate.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?= asset('/vendors/css/tables/datatable/buttons.bootstrap4.min.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?= asset('/vendors/css/tables/datatable/dataTables.bootstrap4.min.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?= asset('/vendors/css/tables/datatable/datatables.min.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?= asset('/vendors/css/tables/datatable/extensions/dataTables.checkboxes.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?= asset('/vendors/css/tables/datatable/responsive.bootstrap.min.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?= asset('/vendors/css/tables/datatable/responsive.bootstrap4.min.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?= asset('/vendors/css/tables/datatable/rowGroup.bootstrap4.min.css') ?>" />

        <!-- BEGIN: Theme CSS-->
        <link rel="stylesheet" type="text/css" href="<?= asset('/css/bootstrap.min.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?= asset('/css/bootstrap-extended.min.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?= asset('/css/colors.min.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?= asset('/css/components.min.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?= asset('/css/themes/dark-layout.min.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?= asset('/css/themes/bordered-layout.min.css') ?>" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/4.7.95/css/materialdesignicons.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" />

        <!-- BEGIN: Page CSS-->
        <link rel="stylesheet" type="text/css" href="<?= asset('/css/core/menu/menu-types/vertical-menu.min.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?= asset('/css/pages/app-invoice.min.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?= asset('/css/pages/app-file-manager.min.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?= asset('/css/pages/app-invoice-list.min.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?= asset('/css/pages/page-pricing.min.css') ?>" />

        <link rel="stylesheet" type="text/css" href="<?= asset('/css/plugins/charts/chart-apex.min.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?= asset('/css/pages/dashboard-ecommerce.min.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?= asset('/css/plugins/forms/pickers/form-flat-pickr.min.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?= asset('/css/plugins/extensions/ext-component-tree.min.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?= asset('/css/plugins/extensions/ext-component-toastr.min.css') ?>" />
        <link href="https://cdn.materialdesignicons.com/5.3.45/css/materialdesignicons.min.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/remixicon@2.2.0/fonts/remixicon.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css" rel="stylesheet" />

        <!-- BEGIN: Custom CSS & JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <style type="text/css">
            .copy {
                cursor: pointer;
            }
        </style>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.4/clipboard.min.js"></script>
    </head>