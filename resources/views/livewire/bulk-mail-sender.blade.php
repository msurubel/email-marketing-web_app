<div wire:poll>
    <div class="row">
        <div class="col-xl-6 p-2">
            <div class="card h-100">
                <div class="card-body">
                    <h4 class="header-title mb-3">Send a bulk mail</h4>
                    <div class="row">

                        @if(auth()->user()->user_type == "Admin")
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="companyname" class="form-label">Staff Email or Name (Optional)</label>
                                <input type="text" wire:model.prevent="SearchGroupSMTPByUser"  class="form-control" id="companyname">
                                <p class="m-2" style="line-height: 1.1;"><small>Find datas by user individually if you want, just write user email or name.</small></p>
                            </div>
                        </div><hr>
                        @endif

                        <div class="col-lg-12 mb-3">
                            <label for="inputState" class="form-label">Subscribe Group</label>
                            <select id="inputState" wire:model.prevent="SelectingGroupInput" class="form-select" required>
                                <option value="">Please select one</option>
                                @foreach(\App\Models\subscribe_groups::wherestatus("active")->get() as $lists)
                                    @if(auth()->user()->user_type == "Staff")
                                        @if($lists->user_id == auth()->user()->id)
                                        <option value="{{$lists->id}}">{{$lists->name}}</option>
                                        @endif
                                    @else
                                        @if(empty($SearchGroupSMTPByUser))
                                            <option value="{{$lists->id}}">{{$lists->name}} - Created by: {{\App\Models\User::whereid($lists->user_id)->first()->email}}</option>
                                        @else
                                            @if($lists->user_id == $SearchingFoundedID)
                                            <option value="{{$lists->id}}">{{$lists->name}}</option>
                                            @endif
                                        @endif
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-12">
                            <label for="inputState" class="form-label">SMTP Server</label>
                            <select id="inputState" wire:model.prevent="SelectingSMTPConfigInput" class="form-select" required>
                                <option value="">Please select one</option>
                                @foreach(\App\Models\smtp_configs::wherestatus("Active")->get() as $lists)
                                    @if(auth()->user()->user_type == "Staff")
                                        @if($lists->user_id == auth()->user()->id)
                                        <option value="{{$lists->ref_id}}">{{$lists->provider_name}}</option>
                                        @endif
                                    @else
                                        @if(empty($SearchGroupSMTPByUser))
                                            <option value="{{$lists->id}}">{{$lists->provider_name}} - Created by: {{\App\Models\User::whereid($lists->user_id)->first()->email}}</option>
                                        @else
                                            @if($lists->user_id == $SearchingFoundedID)
                                            <option value="{{$lists->id}}">{{$lists->name}}</option>
                                            @endif
                                        @endif
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-12" style="padding-top: 40px;">
                            <h4 class="header-title">Sending From Company Details</h4>
                            <hr>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="companyname" class="form-label">Company Name</label>
                                <input type="text" wire:model.prevent="SendingFromName"  class="form-control" id="companyname">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="sendingfrom" class="form-label">Sending From Email</label>
                                <input type="email" wire:model.prevent="SendingFromEmail" class="form-control" id="sendingfrom">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="replytoname" class="form-label">Reply To Name</label>
                                <input type="email" wire:model.prevent="SendingReplyToName" class="form-control" id="replytoname">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="replyto" class="form-label">Reply To Email</label>
                                <input type="email" wire:model.prevent="SendingReplyToEmail" class="form-control" id="replyto">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="signlogo" class="form-label">Signature Logo</label>
                                <input type="file" wire:model.prevent="SendingSignLogo" class="form-control" id="signlogo">
                            </div>
                        </div>
                        <div class="col-lg-12" style="padding-top: 40px;">
                            <h4 class="header-title">Mail Box</h4>
                            <hr>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="firstname" class="form-label">Subject Line</label>
                                <input type="text" wire:model.prevent="SendingSubjectline" class="form-control" id="firstname">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="firstname" class="form-label">Attachment</label>
                                <input type="file" wire:model.prevent="SendingAttachmentFiles" class="form-control" id="firstname" multiple>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label">Mail Body Text</label>
                                <p class="text-muted font-13">
                                    Please use tags for individual changing text of subscribers <span class="text-primary">{sbscrb_name}, {sbscrb_email}, {sbscrb_phone}, {sbscrb_company_name}, {sbscrb_company_number}, {sbscrb_manager_name}</span> Use HTML tag for design your text. <a href="https://www.w3schools.com/html/default.asp" target="_blank">Learn HTML</a>
                                </p>
                                <textarea data-toggle="maxlength" rows="10" wire:model.prevent="SendingMailBodyText" class="form-control" rows="3" 
                                    placeholder="Write here who's you want to send to your subscribers."></textarea>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <button type="button" wire:click="RunMailSending" class="btn btn-primary"><span wire:loading wire:target="RunMailSending" class="spinner-border spinner-border-sm" role="status"></span> Submit</button>
                            </div>
                        </div>
                    </div>
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->
        <div class="col-xl-6 p-2">
            <div class="card h-100">
                <div class="card-body">
                    <h4 class="header-title mb-3">Mail Sending Info</h4>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card widget-flat">
                                <div class="card-body">
                                    <div class="float-end">
                                        <i class="uil-chat-bubble-user widget-icon"></i>
                                    </div>
                                    <h5 class="text-muted fw-normal mt-0" title="Number of Customers">Total Subscriber</h5>
                                    @if(empty($SelectingGroupInput))
                                    <h3 class="mt-3 mb-3">0</h3>
                                    @else
                                    <h3 class="mt-3 mb-3">{{\App\Models\subscribers::wheregroup_id($SelectingGroupInput)->count()}}</h3>
                                    @endif
                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col-->

                        <div class="col-sm-6">
                            <div class="card widget-flat">
                                <div class="card-body">
                                    <div class="float-end">
                                        <i class="uil-envelope-check widget-icon"></i>
                                    </div>
                                    <h5 class="text-muted fw-normal mt-0" title="Number of Customers">Sending Limit Today</h5>
                                    @if(empty($SelectingSMTPConfigInput))
                                    <h3 class="mt-3 mb-3">0</h3>
                                    @else
                                    <h3 class="mt-3 mb-3">{{\App\Models\smtp_configs::whereid($SelectingSMTPConfigInput)->first()->sending_limit - \App\Models\mailler_jobs::wheresmtp_config($SelectingSMTPConfigInput)->whereMonth('created_at', date('m'))->sum('can_send')}}</h3>
                                    @endif
                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col-->

                        <h4 class="header-title mb-3">Last 12 Jobs</h4>
                        <div class="col-sm-12">
                            <livewire:mailer-job-report/>                                              
                        </div> <!-- end col-->
                    </div>
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>

    <!-- /Mail Sending Process Model -->
    <div id="MailSendingDone" wire:ignore.self class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body p-4">
                    <div class="text-center">
                        <i class="mdi mdi-check-circle text-success" style="font-size: 100px;" role="status"></i>
                        <h4 class="mt-2 text-success">Mail Sending Job Done!</h4>
                        <p class="mt-3">System already done your job and created result, Please see it.<br><i style="font-size: 55px;" class="mdi mdi-arrow-right-thin"></i></p>
                        <button type="button" class="btn btn-primary my-2" data-bs-dismiss="modal">Ok</button>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>
