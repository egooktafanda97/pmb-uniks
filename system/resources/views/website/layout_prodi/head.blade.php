<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1"
      name="viewport">
<title>Pendaftaran Mahasiswa Baru</title>

<!-- Favicon -->
<link href="{{ asset(config('app.site-assets')) }}/assets/ico/apple-touch-icon-144-precomposed.png"
      rel="apple-touch-icon-precomposed"
      sizes="144x144">
<link href="{{ asset('assets/logo/logo.ico') }}"
      rel="shortcut icon">

<!-- CSS Global -->
<link href="{{ asset(config('app.site-assets')) }}/assets/plugins/bootstrap/css/bootstrap.min.css"
      rel="stylesheet">
<link href="{{ asset(config('app.site-assets')) }}/assets/plugins/bootstrap-select/css/bootstrap-select.min.css"
      rel="stylesheet">
<link href="{{ asset(config('app.site-assets')) }}/assets/plugins/fontawesome/css/font-awesome.min.css"
      rel="stylesheet">
<link href="{{ asset(config('app.site-assets')) }}/assets/plugins/prettyphoto/css/prettyPhoto.css"
      rel="stylesheet">
<link href="{{ asset(config('app.site-assets')) }}/assets/plugins/owl-carousel2/assets/owl.carousel.min.css"
      rel="stylesheet">
<link href="{{ asset(config('app.site-assets')) }}/assets/plugins/owl-carousel2/assets/owl.theme.default.min.css"
      rel="stylesheet">
<link href="{{ asset(config('app.site-assets')) }}/assets/plugins/animate/animate.min.css"
      rel="stylesheet">

<!-- Theme CSS -->
{{-- <link href="{{ asset(config('app.site-assets')) }}/assets/css/theme.css"
      rel="stylesheet"> --}}
<link href="{{ asset(config('app.site-assets')) }}/assets/css/theme-yellow-2.css"
      rel="stylesheet">

<!-- Head Libs -->
<script src="{{ asset(config('app.site-assets')) }}/assets/plugins/modernizr.custom.js"></script>

<!--[if lt IE 9]>
    <blade ___scripts_1___/>
    <blade ___scripts_2___/>
    <![endif]-->

<style>
    /* Alert */
    .alert {
        padding: 20px;
        background-color: #ffcfcc;
        border: 1px solid #f44336;
        border-left: 9px solid #f44336;
        color: #f44336;
        opacity: 0.83;
        transition: opacity 0.6s;
        margin-bottom: 15px;
        border-radius: 6px;
    }

    /* Alert Success */
    .alert.success {
        border: 1px solid #04AA6D;
        border-left: 9px solid #04AA6D;
        background-color: #a3ffdd;
        color: #04AA6D;
    }

    /* Alert Info */
    .alert.info {
        border: 1px solid #2196F3;
        border-left: 9px solid #2196F3;
        background-color: #c3d9eb;
        color: #2196F3;
    }

    /* Alert Warning */
    .alert.warning {
        border: 1px solid #ff9800;
        border-left: 9px solid #ff9800;
        background-color: #ffe1b5;
        color: #ff9800;
    }

    /* Closebtn */
    .closebtn {
        padding-left: 15px;
        color: #f44336;
        font-weight: bold;
        float: right;
        line-height: 18px;
        cursor: pointer;
        transition: 0.5s;
        font-size: 23px;
    }

    /* Closebtn Success */
    .closebtn.success {
        padding-left: 15px;
        color: #04AA6D;
        font-weight: bold;
        float: right;
        line-height: 18px;
        cursor: pointer;
        transition: 0.5s;
        font-size: 23px;
    }

    /* Closebtn Info */
    .closebtn.info {
        padding-left: 15px;
        color: #2196F3;
        font-weight: bold;
        float: right;
        line-height: 18px;
        cursor: pointer;
        transition: 0.5s;
        font-size: 23px;
    }

    /* Closebtn Warning */
    .closebtn.warning {
        padding-left: 15px;
        color: #ff9800;
        font-weight: bold;
        float: right;
        line-height: 18px;
        cursor: pointer;
        transition: 0.5s;
        font-size: 23px;
    }

    .closebtn:hover {
        transform: scale(1.3);
    }

    /* teheme */
    .jumbotron-section.with-overlay.jb1:before {
        background-color: transparent !important;
    }

    .jumbotron-section.with-overlay:before {
        content: '';
        display: block;
        background-color: transparent !important;
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
    }
</style>
