<div>
    <livewire:header-ber/>

    <!-- ========== Left Sidebar Start ========== -->
    <div class="leftside-menu">

        <!-- Logo Light -->
        <a href="{{url('/')}}" class="logo logo-light">
            @if(\App\Models\branding::whereid(1)->first())
            <span class="logo-lg">
                <img src="{{ asset('/branding/'.\App\Models\branding::whereid(1)->first()->main_logo) }}" alt="logo" height="22">
            </span>
            <span class="logo-sm">
                <img src="{{ asset('/branding/'.\App\Models\branding::whereid(1)->first()->logo_icon) }}" alt="small logo" height="22">
            </span>
            @else
            <span class="logo-lg">
                <img src="{{url('/')}}/assets/images/logo.png" alt="logo" height="22">
            </span>
            <span class="logo-sm">
                <img src="{{url('/')}}/assets/images/logo-sm.png" alt="small logo" height="22">
            </span>
            @endif
        </a>

        <!-- Logo Dark -->
        <a href="index.html" class="logo logo-dark">
            <span class="logo-lg">
                <img src="assets/images/logo-dark.png" alt="dark logo" height="22">
            </span>
            <span class="logo-sm">
                <img src="assets/images/logo-dark-sm.png" alt="small logo" height="22">
            </span>
        </a>

        <!-- Sidebar Hover Menu Toggle Button -->
        <button type="button" class="btn button-sm-hover p-0" data-bs-toggle="tooltip" data-bs-placement="right" title="Show Full Sidebar">
            <i class="ri-checkbox-blank-circle-line align-middle"></i>
        </button>

        <!-- Sidebar -left -->
        <div class="h-100" id="leftside-menu-container" data-simplebar>
            <!-- Leftbar User -->
            <div class="leftbar-user">
                <a href="pages-profile.html">
                    <img src="assets/images/users/avatar-1.jpg" alt="user-image" height="42"
                        class="rounded-circle shadow-sm">
                    <span class="leftbar-user-name">Dominic Keller</span>
                </a>
            </div>

            <!--- Sidemenu -->
            <ul class="side-nav">

                <li class="side-nav-title side-nav-item">Navigation</li>

                <li class="side-nav-item @if($route == 'dashboard') menuitem-active @endif">
                    <a href="javascript: void(0);" onClick="" wire:click="RouteChange('dashboard')" class="side-nav-link @if($route == 'dashboard') active @endif">
                        <span wire:loading wire:target="RouteChange('dashboard')" class="spinner-border spinner-border-sm" role="status"></span> <i wire:loading.remove wire:target="RouteChange('dashboard')" class="uil-home-alt"></i>
                        <span> Dashboard </span>
                    </a>
                </li>
                <li class="side-nav-title side-nav-item">Manage Bulk Mailer</li>

                <li class="side-nav-item @if($route == 'groups') menuitem-active @endif">
                    <a href="javascript: void(0);" onClick="" wire:click="RouteChange('groups')" class="side-nav-link @if($route == 'groups') active @endif">
                        <span wire:loading wire:target="RouteChange('groups')" class="spinner-border spinner-border-sm" role="status"></span> <i wire:loading.remove wire:target="RouteChange('groups')" class="uil-database"></i>
                        <span> Groups </span>
                    </a>
                </li>

                <li class="side-nav-item @if($route == 'subscribers') menuitem-active @endif">
                    <a href="javascript: void(0);" onClick="" wire:click="RouteChange('subscribers')" class="side-nav-link @if($route == 'subscribers') active @endif">
                        <span wire:loading wire:target="RouteChange('subscribers')" class="spinner-border spinner-border-sm" role="status"></span> <i wire:loading.remove wire:target="RouteChange('subscribers')" class="uil-chat-bubble-user"></i>
                        <span> Subscribers </span>
                    </a>
                </li>

                <li class="side-nav-item @if($route == 'sendingemails') menuitem-active @endif">
                    <a href="javascript: void(0);" onClick="" wire:click="RouteChange('sendingemails')" class="side-nav-link @if($route == 'sendingemails') active @endif">
                        <span wire:loading wire:target="RouteChange('sendingemails')" class="spinner-border spinner-border-sm" role="status"></span> <i wire:loading.remove wire:target="RouteChange('sendingemails')" class="uil-envelope-send"></i>
                        <span> Send Bulk Email </span>
                    </a>
                </li>

                <li class="side-nav-title side-nav-item">System Settings</li>

                
                <li class="side-nav-item @if($route == 'settings') menuitem-active @endif">
                    <a href="javascript: void(0);" onClick="" wire:click="RouteChange('settings')" class="side-nav-link @if($route == 'settings') active @endif">
                        <span wire:loading wire:target="RouteChange('settings')" class="spinner-border spinner-border-sm" role="status"></span> <i wire:loading.remove wire:target="RouteChange('settings')" class="uil-servers"></i>
                        <span> Settings </span>
                    </a>
                </li>

                <li class="side-nav-item @if($route == 'system_logs') menuitem-active @endif">
                    <a href="javascript: void(0);" onClick="" wire:click="RouteChange('system_logs')" class="side-nav-link @if($route == 'system_logs') active @endif">
                        <span wire:loading wire:target="RouteChange('system_logs')" class="spinner-border spinner-border-sm" role="status"></span> <i wire:loading.remove wire:target="RouteChange('system_logs')" class="mdi mdi-alert"></i>
                        <span> System Logs </span>
                    </a>
                </li>

                <li class="side-nav-item">
                    <a href="javascript: void(0);" onClick="" wire:click="Logout" class="side-nav-link">
                        <span wire:loading wire:target="Logout" class="spinner-border spinner-border-sm" role="status"></span> <i wire:loading.remove wire:target="Logout" class="mdi mdi-power"></i>
                        <span> Logout </span>
                    </a>
                </li>

            </ul>
            <!--- End Sidemenu -->

            <div class="clearfix"></div>
        </div>
        </div>
        <!-- ========== Left Sidebar End ========== -->


        <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">
                    <!-- Start Content-->
                    <div class="container-fluid">
                        @if(auth()->user()->user_type == "Admin")
                            <!-- Rounting Started -->
                            @if($route == "dashboard")
                            <livewire:main-dashboard/>
                            @elseif($route == "groups")
                            <livewire:subscriber-group/>
                            @elseif($route == "subscribers")
                            <livewire:subscriber-lists/>
                            @elseif($route == "sendingemails")
                            <livewire:bulk-mail-sender/>
                            @elseif($route == "settings")
                            <livewire:system-settings/>
                            @elseif($route == "system_logs")
                            <livewire:system-logs/>
                            @endif
                            <!-- Rounting Started -->
                        @else
                            <!-- Rounting Started -->
                            @if($route == "dashboard")
                                @if($DeviceAccess == true)
                                <livewire:main-dashboard/>
                                @else
                                <livewire:permission-denied/>
                                @endif
                            @elseif($route == "groups")
                                @if($DeviceAccess == true)
                                <livewire:subscriber-group/>
                                @else
                                <livewire:permission-denied/>
                                @endif
                            @elseif($route == "subscribers")
                                @if($DeviceAccess == true)
                                <livewire:subscriber-lists/>
                                @else
                                <livewire:permission-denied/>
                                @endif
                            @elseif($route == "sendingemails")
                                @if($DeviceAccess == true)
                                <livewire:bulk-mail-sender/>
                                @else
                                <livewire:permission-denied/>
                                @endif
                            @elseif($route == "settings")
                                @if($DeviceAccess == true)
                                <livewire:system-settings/>
                                @else
                                <livewire:permission-denied/>
                                @endif
                            @elseif($route == "system_logs")
                                @if($DeviceAccess == true)
                                <livewire:system-logs/>
                                @else
                                <livewire:permission-denied/>
                                @endif
                            @endif
                            <!-- Rounting Started -->
                        @endif
                    </div>
                </div>

                @if(\App\Models\branding::whereid(1)->first())
                <!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                {{ date('Y') }} © {{\App\Models\branding::whereid(1)->first()->name}}<!-- - Developed By: <a href="https://wwww.msurubel.com" target="_blank">MSU Rubel</a>-->
                            </div>
                            <!--
                            <div class="col-md-6">
                                <div class="text-md-end footer-links d-none d-md-block">
                                    <a href="javascript: void(0);">About</a>
                                    <a href="javascript: void(0);">Support</a>
                                    <a href="javascript: void(0);">Contact Us</a>
                                </div>
                            </div>-->
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->
                @endif

            </div>
</div>
