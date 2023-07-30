<div wire:poll.5s>
    <div class="row">
        @if(auth()->user()->user_type == "Admin")
        <div class="col-xl-12" style="padding-top: 30px;">
            <div class="card">
                <div class="card-body">
                <!--<button type="button" wire:click="CleanCacheFiles" class="btn btn-warning"><span wire:loading wire:target="CleanCacheFiles" class="spinner-border spinner-border-sm" role="status"></span> Clear Caches</button>-->
                    <button type="button" wire:click="ReInstallApplicaitonConfirmation" class="btn btn-primary"><span wire:loading wire:target="ReInstallApplicaitonConfirmation" class="spinner-border spinner-border-sm" role="status"></span> Re-Install App</button>
                    <button type="button" wire:click="ChangeDAuthDetailsModel" class="btn btn-success"><span wire:loading wire:target="ChangeDAuthDetailsModel" class="spinner-border spinner-border-sm" role="status"></span> Change Auth Details</button>
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

        <div class="col-xl-6 p-2">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3">Branding</h4>
                    <div class="row" wire:ignore>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="firstname" class="form-label">Application Name</label>
                                <input type="text" wire:model.prevent="AppName" class="form-control" id="firstname">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="firstname" class="form-label">Application Logo</label>
                                <input type="file" wire:model.prevent="AppMainLogo" class="form-control" id="firstname">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="firstname" class="form-label">Application Logo Icon</label>
                                <input type="file" wire:model.prevent="AppLogoIcon" class="form-control" id="firstname">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="firstname" class="form-label">Application Fevicon</label>
                                <input type="file" wire:model.prevent="AppFevicon" class="form-control" id="firstname">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <button type="button" wire:click="SystemBrandingSave" class="btn btn-primary"><span wire:loading wire:target="SystemBrandingSave" class="spinner-border spinner-border-sm" role="status"></span> Save Change</button>
                            </div>
                        </div>
                    </div>
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

        <div class="col-xl-6 p-2">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3">Add Mail Settings</h4>
                    <div class="row" wire:ignore>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="firstname" class="form-label">Provider Name</label>
                                <input type="text" wire:model.prevent="SMTPProviderName" class="form-control" id="firstname">
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <label for="inputState" class="form-label">Mailler</label>
                            <select id="inputState" class="form-select" wire:model.prevent="SMTPMailler" required>
                                <option value="">Please select one</option>
                                <option value="smtp">SMTP</option>
                                <option value="sendmail">Send Mail</option>
                            </select>
                        </div>
                        <div class="col-lg-2">
                            <div class="mb-3">
                                <label for="firstname" class="form-label">Port</label>
                                <input type="text" wire:model.prevent="SMTPPort" class="form-control" id="firstname">
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="mb-3">
                                <label for="firstname" class="form-label">Host</label>
                                <input type="text" wire:model.prevent="SMTPHost" class="form-control" id="firstname">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="firstname" class="form-label">Encryption</label>
                                <select id="inputState" class="form-select" wire:model.prevent="SMTPEncryption" required>
                                    <option value="">Please select one</option>
                                    <option value="ssl">SSL</option>
                                    <option value="tls">TLS</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="firstname" class="form-label">Sending Limit Daily</label>
                                <input type="number" wire:model.prevent="SMTPSendingLimitDaily" class="form-control" id="firstname">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="firstname" class="form-label">Username</label>
                                <input type="text" wire:model.prevent="SMTPUsername" class="form-control" id="firstname">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="firstname" class="form-label">Password</label>
                                <input type="password" wire:model.prevent="SMTPPassword" class="form-control" id="firstname">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <button type="button" wire:click="AddNewSMTPServerConfig" class="btn btn-primary"><span wire:loading wire:target="AddNewSMTPServerConfig" class="spinner-border spinner-border-sm" role="status"></span> Add New</button>
                            </div>
                        </div>
                    </div>
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3">SMTP Servers Lists {{$SMTPConfigChangeStatus}}</h4>
                        <table class="table table-centered mb-0">
                            <thead>
                                <tr>
                                    <th>Ref. ID</th>
                                    <th>Provider</th>
                                    <th>Mailler</th>
                                    <th>Port</th>
                                    <th>Encryption</th>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th>Sending Limit</th>
                                    <th>Action</th>
                                    <th>Active?</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse(\App\Models\smtp_configs::all() as $key => $lists)
                                <tr>
                                    <td>{{$lists->ref_id}}</td>
                                    <td>{{$lists->provider_name}}</td>
                                    <td>{{$lists->mailler}}</td>
                                    <td>{{$lists->port}}</td>
                                    <td>{{$lists->encryption}}</td>
                                    <td>{{$lists->username}}</td>
                                    <td>{{$lists->password}}</td>
                                    <td>{{$lists->sending_limit}}/Daily</td>
                                    <td class="table-action">
                                        <a href="javascript: void(0);" wire:click="SMTPConfigEditPanel('{{$lists->id}}')" class="action-icon"><span wire:loading wire:target="SMTPConfigEditPanel('{{$lists->id}}')" class="spinner-border spinner-border-sm" role="status"></span> <i wire:loading.remove wire:target="SMTPConfigEditPanel('{{$lists->id}}')" class="mdi mdi-pencil"></i></a>
                                        <a href="javascript: void(0);" wire:click="DeleteSMTPConfigPanel('{{$lists->id}}')" class="action-icon"><span wire:loading wire:target="DeleteSMTPConfigPanel('{{$lists->id}}')" class="spinner-border spinner-border-sm" role="status"></span> <i wire:loading.remove wire:target="DeleteSMTPConfigPanel('{{$lists->id}}')" class="mdi mdi-delete"></i></a>
                                    </td>
                                    <td>
                                        <!-- Switch-->
                                        <div>
                                            @if($lists->status == "Active")
                                            <input type="checkbox" id="switch01{{$lists->id}}" onClick="" wire:click.prevent="SMTPConfigChangeStatus('{{$lists->id}}', 'Deactivate')" checked data-switch="success"/>
                                            <label for="switch01{{$lists->id}}" data-on-label="Yes" data-off-label="No" class="mb-0 d-block"></label>
                                            @else
                                            <input type="checkbox" id="switch02{{$lists->id}}" onClick="" wire:click.prevent="SMTPConfigChangeStatus('{{$lists->id}}', 'Active')" data-switch="success"/>
                                            <label for="switch02{{$lists->id}}" data-on-label="Yes" data-off-label="No" class="mb-0 d-block"></label>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <td>Empty Data</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                @endforelse
                            </tbody>
                        </table>
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

        <div class="col-xl-3">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3">Add Login User</h4>
                    <div class="row" wire:ignore>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="firstname" class="form-label">User Full Name</label>
                                <input type="text" wire:model.prevent="NewLoginUserName" class="form-control" id="firstname">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="firstname" class="form-label">User Email</label>
                                <input type="text" wire:model.prevent="NewLoginUserEmail" class="form-control" id="firstname">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="firstname" class="form-label">User Password</label>
                                <input type="text" wire:model.prevent="NewLoginUserPassword" class="form-control" id="firstname">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <button type="button" wire:click="MakeMailerLoginUser" class="btn btn-primary"><span wire:loading wire:target="MakeMailerLoginUser" class="spinner-border spinner-border-sm" role="status"></span> Add New</button>
                            </div>
                        </div>
                    </div>
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

        <div class="col-xl-9">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3">Login Access User Lists</h4>
                        <table class="table table-centered mb-0">
                            <thead>
                                <tr>
                                    <th>User Name</th>
                                    <th>User Email</th>
                                    <th>User Type</th>
                                    <th>Real Time</th>
                                    <th>Active?</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse(\App\Models\User::all() as $key => $lists)
                                <tr>
                                    <td>{{$lists->name}}</td>
                                    <td>{{$lists->email}}</td>
                                    <td>
                                        @if($lists->user_type == "Staff")
                                        <span class="badge bg-primary">{{$lists->user_type}}</span>
                                        @else
                                        <span class="badge bg-success">{{$lists->user_type}}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($lists->user_type == "Admin")
                                            <span class="badge bg-success">Active</span>
                                        @else
                                                @if(\App\Models\staff_activities::whereuser_id($lists->id)->where('created_at' , '>',\Carbon\Carbon::now()->subMinutes(5)->toDateTimeString())->count() > 0.99)
                                                    <span class="badge bg-success">Active</span>                                                
                                                @else
                                                    @if(\App\Models\staff_activities::whereuser_id($lists->id)->count() == 0)
                                                    <span class="badge bg-danger">Not Active</span><br>
                                                    <small>Last: {{\App\Models\User::whereid($lists->id)->first()->updated_at->diffForHumans()}}</small>
                                                    @else
                                                    <span class="badge bg-warning">User Away</span><br>
                                                    <small>User can't logout there account yet!</small>
                                                    @endif
                                                @endif                                           
                                        @endif
                                    </td>
                                    <td class="table-action">
                                        @if($lists->user_type == "Staff")
                                            <a href="javascript: void(0);" wire:click="ShowEditingUserPanel('{{$lists->id}}')" class="action-icon"><span wire:loading wire:target="ShowEditingUserPanel('{{$lists->id}}')" class="spinner-border spinner-border-sm" role="status"></span> <i wire:loading.remove wire:target="SMTPConfigEditPanel('{{$lists->id}}')" class="mdi mdi-pencil"></i></a>
                                            <a href="javascript: void(0);" wire:click="DeleteLoginAccessUser('{{$lists->id}}')" class="action-icon"><span wire:loading wire:target="DeleteLoginAccessUser('{{$lists->id}}')" class="spinner-border spinner-border-sm" role="status"></span> <i wire:loading.remove wire:target="DeleteSMTPConfigPanel('{{$lists->id}}')" class="mdi mdi-delete"></i></a>
                                        @else
                                            Action Disable
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <td>Empty Data</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                @endforelse
                            </tbody>
                        </table>
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->
        @else
        <div class="col-xl-12 p-2">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3">Add Mail Settings</h4>
                    <div class="row" wire:ignore>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="firstname" class="form-label">Provider Name</label>
                                <input type="text" wire:model.prevent="SMTPProviderName" class="form-control" id="firstname">
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <label for="inputState" class="form-label">Mailler</label>
                            <select id="inputState" class="form-select" wire:model.prevent="SMTPMailler" required>
                                <option value="">Please select one</option>
                                <option value="smtp">SMTP</option>
                                <option value="sendmail">Send Mail</option>
                            </select>
                        </div>
                        <div class="col-lg-2">
                            <div class="mb-3">
                                <label for="firstname" class="form-label">Port</label>
                                <input type="text" wire:model.prevent="SMTPPort" class="form-control" id="firstname">
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="mb-3">
                                <label for="firstname" class="form-label">Host</label>
                                <input type="text" wire:model.prevent="SMTPHost" class="form-control" id="firstname">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="firstname" class="form-label">Encryption</label>
                                <select id="inputState" class="form-select" wire:model.prevent="SMTPEncryption" required>
                                    <option value="">Please select one</option>
                                    <option value="ssl">SSL</option>
                                    <option value="tls">TLS</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="firstname" class="form-label">Sending Limit Daily</label>
                                <input type="number" wire:model.prevent="SMTPSendingLimitDaily" class="form-control" id="firstname">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="firstname" class="form-label">Username</label>
                                <input type="text" wire:model.prevent="SMTPUsername" class="form-control" id="firstname">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="firstname" class="form-label">Password</label>
                                <input type="password" wire:model.prevent="SMTPPassword" class="form-control" id="firstname">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <button type="button" wire:click="AddNewSMTPServerConfig" class="btn btn-primary"><span wire:loading wire:target="AddNewSMTPServerConfig" class="spinner-border spinner-border-sm" role="status"></span> Add New</button>
                            </div>
                        </div>
                    </div>
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3">SMTP Servers Lists {{$SMTPConfigChangeStatus}}</h4>
                        <table class="table table-centered mb-0">
                            <thead>
                                <tr>
                                    <th>Ref. ID</th>
                                    <th>Provider</th>
                                    <th>Mailler</th>
                                    <th>Port</th>
                                    <th>Encryption</th>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th>Sending Limit</th>
                                    <th>Action</th>
                                    <th>Active?</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse(\App\Models\smtp_configs::all() as $key => $lists)
                                <tr>
                                    <td>{{$lists->ref_id}}</td>
                                    <td>{{$lists->provider_name}}</td>
                                    <td>{{$lists->mailler}}</td>
                                    <td>{{$lists->port}}</td>
                                    <td>{{$lists->encryption}}</td>
                                    <td>{{$lists->username}}</td>
                                    <td>{{$lists->password}}</td>
                                    <td>{{$lists->sending_limit}}/Daily</td>
                                    <td class="table-action">
                                        <a href="javascript: void(0);" wire:click="SMTPConfigEditPanel('{{$lists->id}}')" class="action-icon"><span wire:loading wire:target="SMTPConfigEditPanel('{{$lists->id}}')" class="spinner-border spinner-border-sm" role="status"></span> <i wire:loading.remove wire:target="SMTPConfigEditPanel('{{$lists->id}}')" class="mdi mdi-pencil"></i></a>
                                        <a href="javascript: void(0);" wire:click="DeleteSMTPConfigPanel('{{$lists->id}}')" class="action-icon"><span wire:loading wire:target="DeleteSMTPConfigPanel('{{$lists->id}}')" class="spinner-border spinner-border-sm" role="status"></span> <i wire:loading.remove wire:target="DeleteSMTPConfigPanel('{{$lists->id}}')" class="mdi mdi-delete"></i></a>
                                    </td>
                                    <td>
                                        <!-- Switch-->
                                        <div>
                                            @if($lists->status == "Active")
                                            <input type="checkbox" id="switch01{{$lists->id}}" onClick="" wire:click.prevent="SMTPConfigChangeStatus('{{$lists->id}}', 'Deactivate')" checked data-switch="success"/>
                                            <label for="switch01{{$lists->id}}" data-on-label="Yes" data-off-label="No" class="mb-0 d-block"></label>
                                            @else
                                            <input type="checkbox" id="switch02{{$lists->id}}" onClick="" wire:click.prevent="SMTPConfigChangeStatus('{{$lists->id}}', 'Active')" data-switch="success"/>
                                            <label for="switch02{{$lists->id}}" data-on-label="Yes" data-off-label="No" class="mb-0 d-block"></label>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <td>Empty Data</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                @endforelse
                            </tbody>
                        </table>
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->
        @endif

    </div>

    <!-- // SMTP Config Editing -->
    <div id="EditSMTPEditModel" class="modal fade" wire:ignore.self tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="standard-modalLabel">Edit SMPT Config</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="firstname" class="form-label">Provider Name</label>
                                <input type="text" wire:model.prevent="EditSMTPProviderName" class="form-control" id="firstname">
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <label for="inputState" class="form-label">Mailler</label>
                            <select id="inputState" class="form-select" wire:model.prevent="EditSMTPMailler" required>
                                <option value="">Please select one</option>
                                <option value="smtp">SMTP</option>
                                <option value="sendmail">Send Mail</option>
                            </select>
                        </div>
                        <div class="col-lg-2">
                            <div class="mb-3">
                                <label for="firstname" class="form-label">Port</label>
                                <input type="text" wire:model.prevent="EditSMTPPort" class="form-control" id="firstname">
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="mb-3">
                                <label for="firstname" class="form-label">Host</label>
                                <input type="text" wire:model.prevent="EditSMTPHost" class="form-control" id="firstname">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="firstname" class="form-label">Encryption</label>
                                <select id="inputState" class="form-select" wire:model.prevent="EditSMTPEncryption" required>
                                    <option value="">Please select one</option>
                                    <option value="smtp">SSL</option>
                                    <option value="smtp">TLS</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="firstname" class="form-label">Sending Limit Daily</label>
                                <input type="number" wire:model.prevent="EditSMTPSendingLimitDaily" class="form-control" id="firstname">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="firstname" class="form-label">Username</label>
                                <input type="text" wire:model.prevent="EditSMTPUsername" class="form-control" id="firstname">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="firstname" class="form-label">Password</label>
                                <input type="password" wire:model.prevent="EditSMTPPassword" class="form-control" id="firstname">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" wire:click.prevent="SaveSMTPConfigEditing" class="btn btn-primary"><span wire:loading wire:target="SaveSMTPConfigEditing" class="spinner-border spinner-border-sm" role="status"></span> Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- / SMTP Config Delet Confirmation Model -->
    <div id="EditSMTPDeleteConfirmModel" wire:ignore.self class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="fullWidthModalLabel">Please Confirm</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    You can't recover your SMTP config after delete. So Are you sure you want to delete this SMTP Config?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" wire:click.prevent="DeleteASMTPConfig" class="btn btn-danger"><span wire:loading wire:target="DeleteASMTPConfig" class="spinner-border spinner-border-sm" role="status"></span> Yes Want to Delete</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- / App Re Install Confirmation Config Delet Confirmation Model -->
    <div id="ReInstallApplicaitonModel" wire:ignore.self class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="fullWidthModalLabel">Please Confirm</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    You lost all application data and can't recover the data after re-install. So Are you sure you want to re-install applicaiotn?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" wire:click.prevent="ReInstallApplicaiton" class="btn btn-danger"><span wire:loading wire:target="ReInstallApplicaiton" class="spinner-border spinner-border-sm" role="status"></span> Yes Want to Re-Install</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- / App Re Install Confirmation Config Delet Confirmation Model -->
    <div id="ChangeDashboardAccessAuth" wire:ignore.self class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="fullWidthModalLabel">Please Confirm</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="firstname" class="form-label">Name</label>
                                <input type="text" wire:model.prevent="ChangeDAccessName" class="form-control" id="firstname" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="firstname" class="form-label">Email</label>
                                <input type="email" wire:model.prevent="ChangeDAccessEmail" class="form-control" id="firstname" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="firstname" class="form-label">Password</label>
                                <input type="password" wire:model.prevent="ChangeDAccessPassword" class="form-control" id="firstname" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" wire:click.prevent="ChangeDAuthDetails" class="btn btn-danger"><span wire:loading wire:target="ChangeDAuthDetails" class="spinner-border spinner-border-sm" role="status"></span> Save It</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- / App Re Install Confirmation Config Delet Confirmation Model -->
    <div id="EditLoginUserModel" wire:ignore.self class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    @if($SelectedUserIDforEDIT)
                    <h4 class="modal-title" id="fullWidthModalLabel">Edit Login Info of {{\App\Models\User::whereid($SelectedUserIDforEDIT)->first()->name}}</h4>
                    @else
                    <h4 class="modal-title" id="fullWidthModalLabel">Edit Login Info</h4>
                    @endif
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="firstname" class="form-label">Name</label>
                                <input type="text" wire:model.prevent="EditLoginName" class="form-control" id="firstname" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="firstname" class="form-label">Email</label>
                                <input type="email" wire:model.prevent="EditLoginEmail" class="form-control" id="firstname" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="firstname" class="form-label">Password</label>
                                <input type="password" wire:model.prevent="EditLoginPassword" class="form-control" id="firstname" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" wire:click.prevent="SaveEditingUser" class="btn btn-danger"><span wire:loading wire:target="SaveEditingUser" class="spinner-border spinner-border-sm" role="status"></span> Save It</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>
