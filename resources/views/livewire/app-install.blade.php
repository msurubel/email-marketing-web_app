<div wire:poll="CheckDBConnectionOthers">
    <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-4 col-lg-5">
                    <div class="card">

                        <!-- Logo -->
                        <div class="card-header pt-4 pb-4 text-center bg-primary">
                            <span class="text-light">App Installer</span>
                        </div>

                        <div class="card-body p-4">
                            <div class="row">
                                @if($DBConnection == "Not")
                                    <div class="col-lg-12 text-center">
                                        <div class="row">
                                            <div class="col-sm-12 mb-3">
                                                <div class="spinner-border avatar-lg text-primary" role="status"></div>
                                            </div>
                                            <div class="col-sm-12">
                                                <h4 class="text-dark-50 text-center pb-0 fw-bold">Waiting for DB Connection</h4>
                                                <p>Your database connection not respond or you can't config your database please check DB Config from <span class="text-primary">.env</span> file.</p>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    @if($ProcessPage == "DBConnectionCheck")
                                        <div class="col-lg-12 text-center">
                                            <div class="row">
                                                <div class="col-sm-12 mb-3">
                                                    <i class="mdi mdi-check-circle text-success" style="font-size: 70px;"></i>
                                                </div>
                                                <div class="col-sm-12">
                                                    <h4 class="text-dark-50 text-center text-success pb-0 fw-bold">DB Connected</h4>
                                                    <p>System detacted that you successfully config your DB and it's respond fine. Now click <strong>continue</strong> button.</p>
                                                </div>
                                                <div class="col-sm-12">
                                                    <button class="btn btn-primary" wire:click="SwichPageInstallation('DBInstallation')" type="submit"><span wire:loading wire:target="SwichPageInstallation('DBInstallation')" class="spinner-border spinner-border-sm" role="status"></span> Continue </button>
                                                </div>
                                            </div>
                                        </div>
                                    @elseif($ProcessPage == "DBInstallation")
                                        <div class="col-lg-12 text-center">
                                            <div class="row">
                                                <div class="col-sm-12 mb-3">
                                                    <i class="mdi mdi-database-arrow-down" style="font-size: 70px;"></i>
                                                </div>
                                                <div class="col-sm-12">
                                                    <h4 class="text-dark-50 text-center pb-0 fw-bold">Install Database</h4>
                                                    <p>Click <strong>Install Now</strong> button to install DB tables in your datbase.</p>
                                                </div>
                                                <div class="col-sm-12">
                                                    <button class="btn btn-primary" wire:click="InstallDatabaseTables" type="submit"><span wire:loading wire:target="InstallDatabaseTables" class="spinner-border spinner-border-sm" role="status"></span> Install Now </button>
                                                </div>
                                            </div>
                                        </div>
                                    @elseif($ProcessPage == "DBInstallationDone")
                                        <div class="col-lg-12 text-center">
                                            <div class="row">
                                                <div class="col-sm-12 mb-3">
                                                    <i class="mdi mdi-check-circle text-success" style="font-size: 70px;"></i>
                                                </div>
                                                <div class="col-sm-12">
                                                    <h4 class="text-dark-50 text-center text-success pb-0 fw-bold">Database Installed</h4>
                                                    <p>All datbase tables are installed in this applicaiton. Now click <strong>continue</strong> button.</p>
                                                </div>
                                                <div class="col-sm-12">
                                                    <button class="btn btn-primary" wire:click="SwichPageInstallation('RegisterAdmin')" type="submit"><span wire:loading wire:target="SwichPageInstallation('RegisterAdmin')" class="spinner-border spinner-border-sm" role="status"></span> Continue </button>
                                                </div>
                                            </div>
                                        </div>
                                    @elseif($ProcessPage == "RegisterAdmin")
                                        <div class="col-lg-12">
                                            <div class="text-center w-75 m-auto">
                                                <h4 class="text-dark-50 text-center pb-0 fw-bold">Register First Account</h4>
                                                <p class="text-muted mb-4">Enter your name, email address and password to access admin panel.</p>
                                            </div>

                                            <div class="mb-3">
                                                <label for="emailaddress" class="form-label">Full Name</label>
                                                <input id="name" type="text" class="form-control " wire:model.prevent="name" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="emailaddress" class="form-label">Email address</label>
                                                <input id="email" type="email" class="form-control " wire:model.prevent="email" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="password" class="form-label">Password</label>
                                                <div class="input-group input-group-merge">
                                                    <input id="password" type="password" class="form-control" wire:model.prevent="password" required>
                                                </div>
                                            </div>

                                            <div class="mb-3 mb-0 text-center">
                                                <button class="btn btn-primary" wire:click="RegisterFirstUser" type="button"><span wire:loading wire:target="RegisterFirstUser" class="spinner-border spinner-border-sm" role="status"></span> Register Account</button>
                                            </div>
                                        </div>
                                    @elseif($ProcessPage == "AppInstalled")
                                        <div class="col-lg-12 text-center">
                                            <div class="row">
                                                <div class="col-sm-12 mb-3">
                                                    <i class="mdi mdi-check-circle text-success" style="font-size: 70px;"></i>
                                                </div>
                                                <div class="col-sm-12">
                                                    <h4 class="text-dark-50 text-center text-success pb-0 fw-bold">Application Fully Installed</h4>
                                                    <p>Successfully created a user and fully installed applicaiton, Please login for access dashboard</p>
                                                </div>
                                                <div class="col-sm-12">
                                                    <button class="btn btn-primary" wire:click="LoginDashboard" type="submit"><span wire:loading wire:target="LoginDashboard" class="spinner-border spinner-border-sm" role="status"></span> Login Now </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div> <!-- end card-body -->
                    </div>
                    <!-- end card -->

                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->

</div>
