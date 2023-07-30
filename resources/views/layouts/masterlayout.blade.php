<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="utf-8" />
        <title>Application Dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />

        <!-- App favicon -->
        @if(\App\Models\branding::whereid(1)->first())
        <link rel="shortcut icon" href="{{ asset('/branding/'.\App\Models\branding::whereid(1)->first()->fevicon) }}">
        @else
        <link rel="shortcut icon" href="{{url('/')}}/assets/images/favicon.ico">
        @endif

        <!-- Daterangepicker css -->
        <link rel="stylesheet" href="{{url('/')}}/assets/vendor/daterangepicker/daterangepicker.css">

        <!-- Vector Map css -->
        <link rel="stylesheet" href="{{url('/')}}/assets/vendor/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css">

        <!-- Theme Config Js -->
        <script src="{{url('/')}}/assets/js/hyper-config.js"></script>

        <!-- App css -->
        <link href="{{url('/')}}/assets/css/app-saas.min.css" rel="stylesheet" type="text/css" id="app-style" />

        <!-- Icons css -->
        <link href="{{url('/')}}/assets/css/icons.min.css" rel="stylesheet" type="text/css" />

        <!-- Plugin css -->
        <link rel="stylesheet" href="{{url('/')}}/assets/custometoastr/toastr.min.css"/>

        <!-- Quill css -->
        <link href="{{url('/')}}/assets/vendor/quill/quill.core.css" rel="stylesheet" type="text/css" />
        <link href="{{url('/')}}/assets/vendor/quill/quill.snow.css" rel="stylesheet" type="text/css" />

        <style>
            .arrow-animation{
                animation: a9 .5s infinite linear alternate;
            }
            @keyframes a9 {
                0%   {transform: translate(-35px)}
                100% {transform: translate( 30px)}
            }
        </style>


        @livewireStyles
    </head>

    <body>
        <!-- Begin page -->
        <div class="wrapper">
            @yield('content')
        </div>
    <!-- END wrapper -->     
    
    <!-- Vendor js -->
    <script src="{{url('/')}}/assets/js/vendor.min.js"></script>

    <!-- Daterangepicker js -->
    <script src="{{url('/')}}/assets/vendor/daterangepicker/moment.min.js"></script>
    <script src="{{url('/')}}/assets/vendor/daterangepicker/daterangepicker.js"></script>
    
    <!-- Apex Charts js -->
    <script src="{{url('/')}}/assets/vendor/apexcharts/apexcharts.min.js"></script>

    <!-- Vector Map js -->
    <script src="{{url('/')}}/assets/vendor/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="{{url('/')}}/assets/vendor/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js"></script>

    <!-- Dashboard App js -->
    <script src="{{url('/')}}/assets/js/pages/demo.dashboard.js"></script>

    <script src="{{url('/')}}/assets/custometoastr/toastr.min.js"></script>

    <!-- App js -->
    <script src="{{url('/')}}/assets/js/app.js"></script>

    <!-- plugin js -->
    <script src="{{url('/')}}/assets/custometoastr/vendor/dropzone/min/dropzone.min.js"></script>
    <!-- init js -->
    <script src="{{url('/')}}/assets/custometoastr/js/ui/component.fileupload.js"></script>

    <!-- quill js -->
    <script src="{{url('/')}}/assets/vendor/quill/quill.min.js"></script>
    <!-- quill Init js-->
    <script src="{{url('/')}}/assets/js/pages/demo.quilljs.js"></script>

    <script>
        window.addEventListener('addNewGroupShow', event => {
            $('#addNewGroupModel').modal('show');
        })
        window.addEventListener('addNewGroupHide', event => {
            $('#addNewGroupModel').modal('hide');
        })

        //Edit Group Model
        window.addEventListener('editGroupModelShow', event => {
            $('#EditGroupModel').modal('show');
        })
        window.addEventListener('editGroupModelHide', event => {
            $('#EditGroupModel').modal('hide');
        })

        //New Subscriber adding model
        window.addEventListener('addNewSubscriberShow', event => {
            $('#addNewSubscriberModel').modal('show');
        })
        window.addEventListener('addNewSubscriberHide', event => {
            $('#addNewSubscriberModel').modal('hide');
        })

        //Edit Subscriber Model
        window.addEventListener('EditSubscriberShow', event => {
            $('#EditSubscriberModel').modal('show');
        })
        window.addEventListener('EditSubscriberHide', event => {
            $('#EditSubscriberModel').modal('hide');
        })

        //Edit Subscriber Model
        window.addEventListener('ImportSubscriberShow', event => {
            $('#ImportingSubscriberModel').modal('show');
        })
        window.addEventListener('ImportSubscriberHide', event => {
            $('#ImportingSubscriberModel').modal('hide');
        })

        //Edit SMTP Config Model
        window.addEventListener('EditSMTPEditShow', event => {
            $('#EditSMTPEditModel').modal('show');
        })
        window.addEventListener('EditSMTPEditHide', event => {
            $('#EditSMTPEditModel').modal('hide');
        })

        //Edit SMTP Delete Confirmation Model
        window.addEventListener('EditSMTPDeleteConfirmShow', event => {
            $('#EditSMTPDeleteConfirmModel').modal('show');
        })
        window.addEventListener('EditSMTPDeleteConfirmHide', event => {
            $('#EditSMTPDeleteConfirmModel').modal('hide');
        })
        //Edit SMTP Delete Confirmation Model
        window.addEventListener('MailSendingDoneModelShow', event => {
            $('#MailSendingDone').modal('show');
        })
        window.addEventListener('MailSendingDoneModelHide', event => {
            $('#MailSendingDone').modal('hide');
        })

        //ReInstall Model
        window.addEventListener('ReInstallApplicaitonModelShow', event => {
            $('#ReInstallApplicaitonModel').modal('show');
        })
        window.addEventListener('ReInstallApplicaitonModelHide', event => {
            $('#ReInstallApplicaitonModel').modal('hide');
        })

        //Group Delete Confirm Model
        window.addEventListener('GroupDeleteConfirmModelShow', event => {
            $('#GroupDeletationConfirm').modal('show');
        })
        window.addEventListener('GroupDeleteConfirmModelHide', event => {
            $('#GroupDeletationConfirm').modal('hide');
        })

        //Group Delete Confirm Model
        window.addEventListener('ChangeDAuthModleShow', event => {
            $('#ChangeDashboardAccessAuth').modal('show');
        })
        window.addEventListener('ChangeDAuthModleHide', event => {
            $('#ChangeDashboardAccessAuth').modal('hide');
        })

        //Group Delete Confirm Model
        window.addEventListener('sendingMailContentModelShow', event => {
            $('#MailSendingContentViewModel').modal('show');
        })
        window.addEventListener('sendingMailContentModelHide', event => {
            $('#MailSendingContentViewModel').modal('hide');
        })

        window.addEventListener('EditingLoginUsersModelViewShow', event => {
            $('#EditLoginUserModel').modal('show');
        })
        window.addEventListener('EditingLoginUsersModelViewHide', event => {
            $('#EditLoginUserModel').modal('hide');
        })
    </script>

    <script>
         // Run toastr notification with Welcome message
         setTimeout(function () {
            toastr.options = {
                "positionClass": "toast-top-center",
                "closeButton": true,
                "progressBar": true,
                "showEasing": "swing",
                "timeOut": "6000"
            };
            window.livewire.on('alert-warning', param => {
                toastr.warning(param['message']);
            });
            
            window.livewire.on('alert-success', param => {
                toastr.success(param['message']);
            });

            window.livewire.on('alert-error', param => {
                toastr.error(param['message']);
            });
        }, 1600)
    </script>

    @livewireScripts
</body>

</html> 