<div wire:poll>
    <table class="table table-centered mb-0">
        <thead class="table-dark">
            <tr>
                <th>Date Time</th>
                <th>Job ID</th>
                <th>Group Name</th>
                <th>Sending Info</th>
                <th>Process</th>
                <th>Report</th>
                <th>Status</th>
            </tr>
        </thead>
        @if(auth()->user()->user_type == "Admin")
        <tbody>
            @forelse(\App\Models\mailler_jobs::orderBy('id', 'desc')->limit(12)->get() as $job)
            <tr>
                <td>{{$job->created_at->format('d M, Y')}}<br>
                    <small>{{$job->created_at->format('h:i A')}}</small>
                </td>
                <td>{{$job->ref_id}}</td>
                <td>{{$job->group_name}}</td>
                <td><a href="javascript: void(0);" wire:click="ViewMailSendingInfoModel('{{$job->id}}')"><span wire:loading wire:target="ViewMailSendingInfoModel('{{$job->id}}')" class="spinner-border spinner-border-sm" role="status"></span> View</a></td>
                <td>
                    @if($job->can_send > 0.01 || $job->job_total > 0.01)
                        <div class="progress progress-sm">
                            @if(($job->can_send * 100) / $job->job_total < 60)
                            <div class="progress-bar progress-lg bg-warning" role="progressbar" style="width: {{($job->can_send * 100) / $job->job_total}}%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                            @else
                            <div class="progress-bar progress-lg bg-success" role="progressbar" style="width: {{($job->can_send * 100) / $job->job_total}}%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                            @endif
                        </div>
                    @else
                        Preparing job
                    @endif
                </td>
                <td>{{$job->can_send}}/{{$job->job_total}}</td>
                <td>
                    @if($job->can_send > 0.01 || $job->job_total > 0.01)
                        @if($job->status == "Delivered")
                        <i class="mdi mdi-circle text-success"></i> Delivered
                        @elseif($job->status == "Processing")
                        <i class="mdi mdi-circle text-primary"></i> Processing
                        @elseif($job->status == "Failed")
                        <i class="mdi mdi-circle text-danger"></i> Failed
                        @endif
                    @else
                        <i class="mdi mdi-circle text-warning"></i> Paused
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
        @else
        <tbody>
            @forelse(\App\Models\mailler_jobs::whereuser_id(auth()->user()->id)->orderBy('id', 'desc')->limit(12)->get() as $job)
            <tr>
                <td>{{$job->created_at->format('d M, Y')}}<br>
                    <small>{{$job->created_at->format('h:i A')}}</small>
                </td>
                <td>{{$job->ref_id}}</td>
                <td>{{$job->group_name}}</td>
                <td><a href="javascript: void(0);" wire:click="ViewMailSendingInfoModel('{{$job->id}}')"><span wire:loading wire:target="ViewMailSendingInfoModel('{{$job->id}}')" class="spinner-border spinner-border-sm" role="status"></span> View</a></td>
                <td>
                    @if($job->can_send > 0.01 || $job->job_total > 0.01)
                        <div class="progress progress-sm">
                            @if(($job->can_send * 100) / $job->job_total < 60)
                            <div class="progress-bar progress-lg bg-warning" role="progressbar" style="width: {{($job->can_send * 100) / $job->job_total}}%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                            @else
                            <div class="progress-bar progress-lg bg-success" role="progressbar" style="width: {{($job->can_send * 100) / $job->job_total}}%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                            @endif
                        </div>
                    @else
                        Preparing job
                    @endif
                </td>
                <td>{{$job->can_send}}/{{$job->job_total}}</td>
                <td>
                    @if($job->can_send > 0.01 || $job->job_total > 0.01)
                        @if($job->status == "Delivered")
                        <i class="mdi mdi-circle text-success"></i> Delivered
                        @elseif($job->status == "Processing")
                        <i class="mdi mdi-circle text-primary"></i> Processing
                        @elseif($job->status == "Failed")
                        <i class="mdi mdi-circle text-danger"></i> Failed
                        @endif
                    @else
                        <i class="mdi mdi-circle text-warning"></i> Paused
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
        @endif
    </table>

    <!-- /Mail Sending Process Model -->
    <div id="MailSendingContentViewModel" wire:ignore.self class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body p-4">
                    <div class="text-left">
                        <i class="mdi mdi-mail text-success" style="font-size: 100px;" role="status"></i>
                        <h4 class="mt-2 text-success">Mail Sending Info</h4>
                        @if($MailSendingInfoID)
                        <p class="mt-3">
                            Company Name<span style="margin-left: 40px;">:</span> {{\App\Models\mailler_jobs::whereid($MailSendingInfoID)->first()->company_name}}<br>
                            Sending From Email<span style="margin-left: 15px;">:</span> {{\App\Models\mailler_jobs::whereid($MailSendingInfoID)->first()->sending_from_mail}}<br>
                            Reply To Name<span style="margin-left: 47px;">:</span> {{\App\Models\mailler_jobs::whereid($MailSendingInfoID)->first()->reply_to_name}}<br>
                            Reply To Email<span style="margin-left: 50px;">:</span> {{\App\Models\mailler_jobs::whereid($MailSendingInfoID)->first()->reply_to_mail}}<br>
                        </p>
                        <hr>
                        {!! \App\Models\mailler_jobs::whereid($MailSendingInfoID)->first()->mail_content !!}<br><br>
                        @endif
                        <button type="button" class="btn btn-danger my-2" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>
