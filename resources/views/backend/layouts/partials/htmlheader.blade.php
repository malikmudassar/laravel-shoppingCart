<head>
    <meta charset="UTF-8">
    <title>{{ env('APP_NAME')}} - @yield('htmlheader_title', 'Your title here')</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Bootstrap 3.3.4 -->
    <link href="{{ asset('/css/backend/bootstrap.css') }}" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icon, s -->
    <script defer src="{{ asset('/font-awesome/js/fontawesome-all.js') }}"></script>
    <!-- iCheck style -->
    <link href="{{ asset('/css/backend/plugins/iCheck/custom.css') }}" rel="stylesheet">

    <!-- switchery style -->
    <link href="{{ asset('/css/backend/plugins/switchery/switchery.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/backend/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/backend/style.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/backend/custom.css') }}" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    @yield('css', '')

    <style>
    .dashboard-header h2 {
        font-size: 22px;
    }
    a {
        color: #1ab394;
    }
    a:hover, a:focus {
        color: #18a689;
    }
    .table-middle td, .table-middle th {
        vertical-align: middle !important;
    }
    body.modal-open .wrapper-content.animated {
        -webkit-animation: none;
    }
    .select2-close-mask{
        z-index: 2099;
    }
    .select2-dropdown{
        z-index: 5000;
    }
    .select2-container--default .select2-selection--single {
        border-radius: 0;
    }
    .select2-container .select2-selection--single {
        height: 36px;
    }
    .select2-container .select2-selection--single .select2-selection__rendered {
        padding-top: 3px;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 33px;
    }
    .tokenfield .token-input, .tokenfield .token {
        margin-bottom: 0;
    }

    #table-user-activity {
        margin-bottom: 0;
    }
    #table-user-activity td {
        vertical-align: middle;
    }
    #table-user-activity button {
        width: 80px;
    }
    </style>
</head>
