<div>
    
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">                                    
                <div class="page-title-right">
                    <form class="d-flex">
                        <a href="javascript: void(0);" class="btn btn-primary ms-2">
                            <i class="mdi mdi-autorenew"></i>
                        </a>
                    </form>
                </div>
                <h4 class="page-title">Dashboard</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">

            <div class="row">
                <div class="col-sm-6">
                    <div class="card widget-flat">
                        <div class="card-body">
                            <div class="float-end">
                                <i class="uil-database widget-icon"></i>
                            </div>
                            <h5 class="text-muted fw-normal mt-0" title="Number of Customers">Subscribe Groups</h5>
                            <h3 class="mt-3 mb-3">{{\App\Models\subscribe_groups::whereuser_id(auth()->user()->id)->count()}}</h3>
                            <p class="mb-0 text-muted">
                                @if(\App\Models\subscribe_groups::whereuser_id(auth()->user()->id)->whereMonth('created_at', date('m'))->count() == 0 || \App\Models\subscribe_groups::whereuser_id(auth()->user()->id)->whereDate('created_at', now()->subMonth())->count() == 0)
                                <span class="text-warning me-2"> 0%</span>
                                @else
                                <span class="text-success me-2"><i class="mdi mdi-arrow-up-bold"></i> {{number_format((\App\Models\subscribe_groups::whereuser_id(auth()->user()->id)->whereMonth('created_at', date('m'))->count() * 100) / \App\Models\subscribe_groups::whereuser_id(auth()->user()->id)->whereDate('created_at', now()->subMonth())->count(), 2)}}%</span>
                                @endif
                                <span class="text-nowrap">Since last month</span>  
                            </p>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col-->

                <div class="col-sm-6">
                    <div class="card widget-flat">
                        <div class="card-body">
                            <div class="float-end">
                                <i class="uil-chat-bubble-user widget-icon"></i>
                            </div>
                            <h5 class="text-muted fw-normal mt-0" title="Number of Orders">Subscribers</h5>
                            <h3 class="mt-3 mb-3">{{\App\Models\subscribers::whereuser_id(auth()->user()->id)->count()}}</h3>
                            <p class="mb-0 text-muted">
                                @if(\App\Models\subscribers::whereuser_id(auth()->user()->id)->whereMonth('created_at', date('m'))->count() == 0 || \App\Models\subscribers::whereuser_id(auth()->user()->id)->whereDate('created_at', now()->subMonth())->count() == 0)
                                <span class="text-warning me-2"> 0%</span>
                                @else
                                <span class="text-success me-2"><i class="mdi mdi-arrow-up-bold"></i> {{number_format((\App\Models\subscribers::whereuser_id(auth()->user()->id)->whereMonth('created_at', date('m'))->count() * 100) / \App\Models\subscribers::whereuser_id(auth()->user()->id)->whereDate('created_at', now()->subMonth())->count(), 2)}}%</span>
                                @endif
                                <span class="text-nowrap">Since last month</span>
                            </p>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col-->

                <div class="col-sm-6">
                    <div class="card widget-flat">
                        <div class="card-body">
                            <div class="float-end">
                                <i class="mdi mdi-currency-usd widget-icon"></i>
                            </div>
                            <h5 class="text-muted fw-normal mt-0" title="Average Revenue">Total Can Send</h5>
                            <h3 class="mt-3 mb-3">{{\App\Models\mailler_jobs::whereuser_id(auth()->user()->id)->sum('can_send')}}</h3>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col-->

                <div class="col-sm-6">
                    <div class="card widget-flat">
                        <div class="card-body">
                            <div class="float-end">
                                <i class="mdi mdi-pulse widget-icon"></i>
                            </div>
                            <h5 class="text-muted fw-normal mt-0" title="Growth">Total Failed To Send</h5>
                            <h3 class="mt-3 mb-3 text-danger">{{\App\Models\mailler_jobs::whereuser_id(auth()->user()->id)->sum('job_total') - \App\Models\mailler_jobs::whereuser_id(auth()->user()->id)->sum('can_send')}}</h3>
                            <p class="mb-0 text-muted">
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col-->

            </div> <!-- end row -->


        </div> <!-- end col -->
    </div>
    <!-- end row -->

    <div class="row">
        <div class="col-xl-12 p-2">
            <div class="card h-100">
                <div class="card-body">
                        <h4 class="header-title mb-3">Last 20 Jobs</h4>
                        <div class="col-sm-12">
                            <livewire:mailer-job-report/>                                                
                        </div> <!-- end col-->
                    </div>
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>
    <!-- end row -->
</div>
