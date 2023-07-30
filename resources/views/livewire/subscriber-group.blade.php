<div wire:poll>

    <div class="row">
        <div class="col-12">
            <div class="page-title-box">                                    
                <div class="page-title-right">
                    <button type="button" wire:click="OpenAddNewGroupsModel" class="btn btn-primary"><div wire:loading wire:target="OpenAddNewGroupsModel" class="spinner-border spinner-border-sm" role="status"></div> Add New</button>
                </div>
                <h4 class="page-title">Subscriber Groups</h4>
            </div>
        </div>
        <div class="col-4">
            <input type="text" wire:model.prevent="SearchGroupByUser" placeholder="Search Groups By Staff"  class="form-control" id="firstname">
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 mb-3">
            <table class="table table-striped table-centered mb-0">
                @if(auth()->user()->user_type == "Admin")
                <thead>
                    <tr>
                        <th>Group Name</th>
                        <th>Created By</th>
                        <th>Total Subscribers</th>
                        <th>Created At</th>
                        <th>Status</th>
                        <th>Action</th> 
                    </tr>
                </thead>
                <tbody>
                    @if(empty($SearchGroupByUser))
                        @forelse(\App\Models\subscribe_groups::all() as $key => $lists)
                        @if($lists->name == "CSV Imported")

                        @else
                            <tr>
                                <td><strong><h3>{{$lists->name}}</h3></strong></td>
                                <td>{{\App\Models\User::whereid($lists->user_id)->first()->name}}</td>
                                <td>
                                    @if(\App\Models\subscribers::wheregroup_id($lists->id)->first())
                                        <a href="javascript: void(0);" wire:click="JumpToAnotherPage('{{$lists->id}}')"><span wire:loading wire:target="JumpToAnotherPage('{{$lists->id}}')" class="spinner-border spinner-border-sm" role="status"></span> {{\App\Models\subscribers::wheregroup_id($lists->id)->count()}}</a>
                                    @else
                                        0
                                    @endif
                                </td>
                                <td>{{$lists->created_at->format('d M, Y')}}<br>
                                    <small>{{$lists->created_at->format('h:i A')}}</small>
                                </td>
                                <td>
                                    @if($lists->status == "Active")
                                    <span class="badge bg-success">Active</span>
                                    @else
                                    <span class="badge bg-danger">Not Active</span>
                                    @endif
                                </td>
                                <td class="table-action">
                                    <a href="javascript: void(0);" wire:click="OpenEditGroupModel('{{$lists->id}}')" class="action-icon"> <i class="mdi mdi-pencil"></i></a>
                                    @if($lists->status == "Not Active")
                                    <a href="javascript: void(0);" wire:click="ChangeAGroupStatus('{{$lists->id}}', 'Active')" class="action-icon"><span wire:loading wire:target="ChangeAGroupStatus('{{$lists->id}}', 'Active')" class="spinner-border spinner-border-sm" role="status"></span> <i wire:loading.remove wire:target="ChangeAGroupStatus('{{$lists->id}}', 'Active')" class="mdi mdi-check-circle text-success"></i></a>
                                    @else
                                    <a href="javascript: void(0);" wire:click="ChangeAGroupStatus('{{$lists->id}}', 'Not Active')" class="action-icon"><span wire:loading wire:target="ChangeAGroupStatus('{{$lists->id}}', 'Not Active')" class="spinner-border spinner-border-sm" role="status"></span> <i wire:loading.remove wire:target="ChangeAGroupStatus('{{$lists->id}}', 'Not Active')" class="mdi mdi-close-circle text-danger"></i></a>
                                    @endif
                                    <a href="javascript: void(0);" wire:click="GroupDeleteConfirmation('{{$lists->id}}')" class="action-icon"><span wire:loading wire:target="GroupDeleteConfirmation('{{$lists->id}}')" class="spinner-border spinner-border-sm" role="status"></span> <i wire:loading.remove wire:target="GroupDeleteConfirmation('{{$lists->id}}')" class="mdi mdi-delete"></i></a>
                                </td> 
                            </tr>
                        @endif
                        @empty
                        <tr>
                            <td>Empty Data</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        @endforelse
                    @else
                    @forelse(\App\Models\subscribe_groups::whereuser_id($SearchingFoundedID)->get() as $key => $lists)
                        @if($lists->name == "CSV Imported")

                        @else
                            <tr>
                                <td><strong><h3>{{$lists->name}}</h3></strong></td>
                                <td>{{\App\Models\User::whereid($lists->user_id)->first()->name}}</td>
                                <td>
                                    @if(\App\Models\subscribers::wheregroup_id($lists->id)->first())
                                        <a href="javascript: void(0);" wire:click="JumpToAnotherPage('{{$lists->id}}')"><span wire:loading wire:target="JumpToAnotherPage('{{$lists->id}}')" class="spinner-border spinner-border-sm" role="status"></span> {{\App\Models\subscribers::wheregroup_id($lists->id)->count()}}</a>
                                    @else
                                        0
                                    @endif
                                </td>
                                <td>{{$lists->created_at->format('d M, Y')}}<br>
                                    <small>{{$lists->created_at->format('h:i A')}}</small>
                                </td>
                                <td>
                                    @if($lists->status == "Active")
                                    <span class="badge bg-success">Active</span>
                                    @else
                                    <span class="badge bg-danger">Not Active</span>
                                    @endif
                                </td>
                                <td class="table-action">
                                    <a href="javascript: void(0);" wire:click="OpenEditGroupModel('{{$lists->id}}')" class="action-icon"> <i class="mdi mdi-pencil"></i></a>
                                    @if($lists->status == "Not Active")
                                    <a href="javascript: void(0);" wire:click="ChangeAGroupStatus('{{$lists->id}}', 'Active')" class="action-icon"><span wire:loading wire:target="ChangeAGroupStatus('{{$lists->id}}', 'Active')" class="spinner-border spinner-border-sm" role="status"></span> <i wire:loading.remove wire:target="ChangeAGroupStatus('{{$lists->id}}', 'Active')" class="mdi mdi-check-circle text-success"></i></a>
                                    @else
                                    <a href="javascript: void(0);" wire:click="ChangeAGroupStatus('{{$lists->id}}', 'Not Active')" class="action-icon"><span wire:loading wire:target="ChangeAGroupStatus('{{$lists->id}}', 'Not Active')" class="spinner-border spinner-border-sm" role="status"></span> <i wire:loading.remove wire:target="ChangeAGroupStatus('{{$lists->id}}', 'Not Active')" class="mdi mdi-close-circle text-danger"></i></a>
                                    @endif
                                    <a href="javascript: void(0);" wire:click="GroupDeleteConfirmation('{{$lists->id}}')" class="action-icon"><span wire:loading wire:target="GroupDeleteConfirmation('{{$lists->id}}')" class="spinner-border spinner-border-sm" role="status"></span> <i wire:loading.remove wire:target="GroupDeleteConfirmation('{{$lists->id}}')" class="mdi mdi-delete"></i></a>
                                </td> 
                            </tr>
                        @endif
                        @empty
                        <tr>
                            <td>Empty Data</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        @endforelse
                    @endif
                </tbody>
                @else
                <thead>
                    <tr>
                        <th>Group Name</th>
                        <th>Total Subscribers</th>
                        <th>Created At</th>
                        <th>Status</th>
                        <th>Action</th> 
                    </tr>
                </thead>
                <tbody>
                    @forelse(\App\Models\subscribe_groups::whereuser_id(auth()->user()->id)->get() as $key => $lists)
                    @if($lists->name == "CSV Imported")

                    @else
                        <tr>
                            <td><strong><h3>{{$lists->name}}</h3></strong></td>
                            <td>
                                @if(\App\Models\subscribers::wheregroup_id($lists->id)->first())
                                    <a href="javascript: void(0);" wire:click="JumpToAnotherPage('{{$lists->id}}')"><span wire:loading wire:target="JumpToAnotherPage('{{$lists->id}}')" class="spinner-border spinner-border-sm" role="status"></span> {{\App\Models\subscribers::wheregroup_id($lists->id)->count()}}</a>
                                @else
                                    0
                                @endif
                            </td>
                            <td>{{$lists->created_at->format('d M, Y')}}<br>
                                <small>{{$lists->created_at->format('h:i A')}}</small>
                            </td>
                            <td>
                                @if($lists->status == "Active")
                                <span class="badge bg-success">Active</span>
                                @else
                                <span class="badge bg-danger">Not Active</span>
                                @endif
                            </td>
                            <td class="table-action">
                                <a href="javascript: void(0);" wire:click="OpenEditGroupModel('{{$lists->id}}')" class="action-icon"> <i class="mdi mdi-pencil"></i></a>
                                @if($lists->status == "Not Active")
                                <a href="javascript: void(0);" wire:click="ChangeAGroupStatus('{{$lists->id}}', 'Active')" class="action-icon"><span wire:loading wire:target="ChangeAGroupStatus('{{$lists->id}}', 'Active')" class="spinner-border spinner-border-sm" role="status"></span> <i wire:loading.remove wire:target="ChangeAGroupStatus('{{$lists->id}}', 'Active')" class="mdi mdi-check-circle text-success"></i></a>
                                @else
                                <a href="javascript: void(0);" wire:click="ChangeAGroupStatus('{{$lists->id}}', 'Not Active')" class="action-icon"><span wire:loading wire:target="ChangeAGroupStatus('{{$lists->id}}', 'Not Active')" class="spinner-border spinner-border-sm" role="status"></span> <i wire:loading.remove wire:target="ChangeAGroupStatus('{{$lists->id}}', 'Not Active')" class="mdi mdi-close-circle text-danger"></i></a>
                                @endif
                                <a href="javascript: void(0);" wire:click="GroupDeleteConfirmation('{{$lists->id}}')" class="action-icon"><span wire:loading wire:target="GroupDeleteConfirmation('{{$lists->id}}')" class="spinner-border spinner-border-sm" role="status"></span> <i wire:loading.remove wire:target="GroupDeleteConfirmation('{{$lists->id}}')" class="mdi mdi-delete"></i></a>
                            </td> 
                        </tr>
                    @endif
                    @empty
                    <tr>
                        <td>Empty Data</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    @endforelse
                </tbody>
                @endif
            </table>
        </div>
    </div>

    <!-- Add New Group Models -->
    <div wire:ignore.self class="modal fade" id="addNewGroupModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Group</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Name</label>
                        <input type="text" wire:model="GroupNameInpute" class="form-control" id="recipient-name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" wire:click="CreateNewGroup" class="btn btn-primary"><div wire:loading wire:target="CreateNewGroup" class="spinner-border spinner-border-sm" role="status"></div> Submit</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Group Edit Models -->
    <div wire:ignore.self class="modal fade" id="EditGroupModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Group</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Name</label>
                        <input type="text" wire:model="EditGroupInpute" class="form-control" id="recipient-name">
                        @if(empty($error['massage']))
                        
                        @else
                        <div class="md-3">
                            <small class="text-danger">{{$error['massage']}}</small>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" wire:click="EditGroupSave" class="btn btn-primary"><div wire:loading wire:target="EditGroupSave" class="spinner-border spinner-border-sm" role="status"></div> Submit</button>
                </div>
            </div>
        </div>
    </div>

    <!-- / App Re Install Confirmation Config Delet Confirmation Model -->
    <div id="GroupDeletationConfirm" wire:ignore.self class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="fullWidthModalLabel">Please Confirm</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    You lost all subscribers who's included in this group, you can't recover it. So Are you sure you want to delete this group?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" wire:click.prevent="DeleteAGroup" class="btn btn-danger"><span wire:loading wire:target="DeleteAGroup" class="spinner-border spinner-border-sm" role="status"></span> Yes Want to Delete</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>
