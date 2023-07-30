<!DOCTYPE html>
<html lang="en">

    
<!-- Mirrored from coderthemes.com/hyper_2/saas/pages-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 13 Oct 2022 12:02:16 GMT -->
<head>
        <meta charset="utf-8" />
        <title>Mailler Application Installation</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{url('/')}}/assets/images/favicon.ico">
        
        <!-- Theme Config Js -->
        <script src="{{url('/')}}/assets/js/hyper-config.js"></script>

        <!-- App css -->
        <link href="{{url('/')}}/assets/css/app-saas.min.css" rel="stylesheet" type="text/css" id="app-style" />

        <!-- Icons css -->
        <link href="{{url('/')}}/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        @livewireStyles
    </head>
    
    <body class="authentication-bg">

        @yield('content')

        <!-- Vendor js -->
        <script src="{{url('/')}}/assets/js/vendor.min.js"></script>
        
        <!-- App js -->
        <script src="{{url('/')}}/assets/js/app.min.js"></script>
        @livewireScripts
    </body>

<!-- Mirrored from coderthemes.com/hyper_2/saas/pages-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 13 Oct 2022 12:02:16 GMT -->
</html>