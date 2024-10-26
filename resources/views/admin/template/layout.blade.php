<!DOCTYPE html>
<html
    lang="en"
    class="light-style layout-menu-fixed"
    dir="ltr"
    data-theme="theme-default"
    data-admin-assets-path="../admin-assets/"
    data-template="vertical-menu-template-free"
>
<head>
    <meta charset="utf-8"/>
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />
    <title>@yield('title') - {{ config('project.company') }}</title>
    <meta name="description" content=""/>
    <link rel="icon" type="image/x-icon" href="../admin-assets/img/favicon/favicon.ico"/>
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet"/>
    <link rel="stylesheet" href="../admin-assets/vendor/fonts/boxicons.css"/>
    <link rel="stylesheet" href="../admin-assets/vendor/css/core.css" class="template-customizer-core-css"/>
    <link rel="stylesheet" href="../admin-assets/vendor/css/theme-default.css" class="template-customizer-theme-css"/>
    <link rel="stylesheet" href="../admin-assets/css/demo.css"/>
    <link rel="stylesheet" href="../admin-assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css"/>
    <link rel="stylesheet" href="../admin-assets/vendor/libs/apex-charts/apex-charts.css"/>
    <script src="../admin-assets/vendor/js/helpers.js"></script>
    <script src="../admin-assets/js/config.js"></script>
    @yield('import-css')
    @yield('page-css')
</head>
<body>
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        @include('admin.template.left-sidebar')
        <div class="layout-page">
            @include('admin.template.header')
            <div class="content-wrapper">
                @yield('content')
            </div>
            @include('admin.template.footer')
        </div>
    </div>
</div>
<script src="../admin-assets/vendor/libs/jquery/jquery.js"></script>
<script src="../admin-assets/vendor/libs/popper/popper.js"></script>
<script src="../admin-assets/vendor/js/bootstrap.js"></script>
<script src="../admin-assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="../admin-assets/vendor/js/menu.js"></script>
<script src="../admin-assets/vendor/libs/apex-charts/apexcharts.js"></script>
<script src="../admin-assets/js/main.js"></script>
<script src="../admin-assets/js/dashboards-analytics.js"></script>
<script async defer src="https://buttons.github.io/buttons.js"></script>
@yield('import-javascript')
@yield('page-javascript')
</body>
</html>
