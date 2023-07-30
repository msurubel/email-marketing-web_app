<div >
    <div class="row">
        <div class="col-12">
            <div class="page-title-box"> 
                <h4 class="page-title">Subscriber Lists</h4>                                   
                <div class="row">
                    <div class="col-lg-6">
                        <div class="page-title-left">
                            @if(empty($SelectSubscibersCheck))
                                @if($GroupViewSLists == "No" || empty($GroupViewSListsGID))
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <input type="text" wire:model="SearchSubscribers" placeholder="Search Subscriber"  class="form-control">
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <p>
                                                Subscriber List of <strong>{{\App\Models\subscribe_groups::whereid($GroupViewSListsGID)->first()->name}}</strong><br>
                                                If you want to search subscriber then please deselect group by <a href="javascript: void(0);" wire:click="DeSelectGroupView"><span wire:loading wire:target="DeSelectGroupView" class="spinner-border spinner-border-sm" role="status"></span> Click Here</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            @else
                            <div class="row">
                                <div class="col-lg-6">
                                    <select wire:model.prevent="SelectingGroupInputForSelectingSubscribers" class="form-select" required>
                                        <option value="">Please select one</option>
                                        @foreach(\App\Models\subscribe_groups::whereuser_id(auth()->user()->id)->wherestatus("active")->get() as $lists)
                                            @if($lists->name == "CSV Imported")

                                            @else
                                            <option value="{{$lists->id}}">{{$lists->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-6">
                                    <button type="button" wire:click="TransferSubscribersToAGroup" class="btn btn-primary"><div wire:loading wire:target="TransferSubscribersToAGroup" class="spinner-border spinner-border-sm" role="status"></div> Transfer</button>
                                    <button type="button" wire:click="ClearSelectionChecked" class="btn btn-warning"><div wire:loading wire:target="ClearSelectionChecked" class="spinner-border spinner-border-sm" role="status"></div> Clear Checked</button>
                                    <button type="button" wire:click="DeletedSelectedSubscriber" class="btn btn-danger"><div wire:loading wire:target="DeletedSelectedSubscriber" class="spinner-border spinner-border-sm" role="status"></div> Delete</button>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div style="text-align: right;">
                            <button type="button" wire:click="OpenAddNewSubscriberModel" class="btn btn-primary"><div wire:loading wire:target="OpenAddNewSubscriberModel" class="spinner-border spinner-border-sm" role="status"></div> Add Subscriber</button>
                            <button type="button" wire:click="ImportSubscriberModelView" class="btn btn-success"><div wire:loading wire:target="ImportSubscriberModelView" class="spinner-border spinner-border-sm" role="status"></div> Import Subscriber</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 mb-3">
            <table class="table table-striped table-centered mb-0">
                <thead>
                    <tr>
                        <th><i class="mdi mdi-check-circle"></i></th>
                        <th>ID.</th>
                        <th>Group Name</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Name of Company</th>
                        <th>Company Number</th>
                        <th>Manager's Name</th>
                        <th>Others Details</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody> 
                    @if(auth()->user()->user_type == "Admin")


                        @if($GroupViewSLists == "No")
                            @if(empty($SearchSubscribers))
                                @forelse(\App\Models\subscribers::skip($PreviousViewCount)->take($CurrentViewCount)->limit(20)->get() as $key => $lists)
                                <tr>
                                    <td><input type="checkbox" wire:model.prevent="SelectSubscibersCheck.{{$key}}" class="form-check-input" value="{{$lists->id}}" id="{{$key}}{{$lists->id}}"></td>
                                    <td>{{$lists->id}}</td>
                                    <td><strong>{{\App\Models\subscribe_groups::whereid($lists->group_id)->first()->name}}</strong></td>
                                    <td>{{$lists->first_name}}</td>
                                    <td>{{$lists->last_name}}</td>
                                    <td>{{$lists->email}}</td>
                                    <td>{{$lists->phone}}</td>
                                    <td>{{$lists->address}}</td>
                                    <td>{{$lists->name_of_company}}</td>
                                    <td>{{$lists->company_number}}</td>
                                    <td>{{$lists->manager_name}}</td>
                                    <td>{{$lists->other_details}}</td>
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
                                        <a href="javascript: void(0);" wire:click="EditSubscriberModel('{{$lists->id}}', '{{$key}}')" class="action-icon"><span wire:loading wire:target="EditSubscriberModel('{{$lists->id}}', '{{$key}}')" class="spinner-border spinner-border-sm" role="status"></span> <i wire:loading.remove wire:target="EditSubscriberModel('{{$lists->id}}', '{{$key}}')" class="mdi mdi-pencil"></i></a>
                                        <a href="javascript: void(0);" wire:click="DeleteASubscriber('{{$lists->id}}')" class="action-icon"><span wire:loading wire:target="DeleteASubscriber('{{$lists->id}}')" class="spinner-border spinner-border-sm" role="status"></span> <i wire:loading.remove wire:target="DeleteASubscriber('{{$lists->id}}')" class="mdi mdi-delete"></i></a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
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
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                @endforelse
                            @else
                                @forelse(\App\Models\subscribers::where('first_name', 'like', '%'.$SearchSubscribers.'%')->orwhere('last_name', 'like', '%'.$SearchSubscribers.'%')->orwhere('email', 'like', '%'.$SearchSubscribers.'%')->get() as $key => $lists)
                                    <tr>
                                        <td><input type="checkbox" wire:model.prevent="SelectSubscibersCheck.{{$key}}" class="form-check-input" value="{{$lists->id}}" id="{{$key}}{{$lists->id}}"></td>
                                        <td>{{$lists->id}}</td>
                                        <td><strong>{{\App\Models\subscribe_groups::whereid($lists->group_id)->first()->name}}</strong></td>
                                        <td>{{$lists->first_name}}</td>
                                        <td>{{$lists->last_name}}</td>
                                        <td>{{$lists->email}}</td>
                                        <td>{{$lists->phone}}</td>
                                        <td>{{$lists->address}}</td>
                                        <td>{{$lists->name_of_company}}</td>
                                        <td>{{$lists->company_number}}</td>
                                        <td>{{$lists->manager_name}}</td>
                                        <td>{{$lists->other_details}}</td>
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
                                            <a href="javascript: void(0);" wire:click="EditSubscriberModel('{{$lists->id}}', '{{$key}}')" class="action-icon"><span wire:loading wire:target="EditSubscriberModel('{{$lists->id}}', '{{$key}}')" class="spinner-border spinner-border-sm" role="status"></span> <i wire:loading.remove wire:target="EditSubscriberModel('{{$lists->id}}', '{{$key}}')" class="mdi mdi-pencil"></i></a>
                                            <a href="javascript: void(0);" wire:click="DeleteASubscriber('{{$lists->id}}')" class="action-icon"><span wire:loading wire:target="DeleteASubscriber('{{$lists->id}}')" class="spinner-border spinner-border-sm" role="status"></span> <i wire:loading.remove wire:target="DeleteASubscriber('{{$lists->id}}')" class="mdi mdi-delete"></i></a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
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
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                @endforelse
                            @endif
                        @else
                            @foreach(\App\Models\subscribers::wheregroup_id($GroupViewSListsGID)->skip($PreviousViewCount)->take($CurrentViewCount)->limit(20)->get() as $key => $lists)
                                <tr>
                                    <td><input type="checkbox" wire:model.prevent="SelectSubscibersCheck.{{$key}}" class="form-check-input" value="{{$lists->id}}" id="{{$key}}{{$lists->id}}"></td>
                                    <td>{{$lists->id}}</td>
                                    <td><strong>{{\App\Models\subscribe_groups::whereid($lists->group_id)->first()->name}}</strong></td>
                                    <td>{{$lists->first_name}}</td>
                                    <td>{{$lists->last_name}}</td>
                                    <td>{{$lists->email}}</td>
                                    <td>{{$lists->phone}}</td>
                                    <td>{{$lists->address}}</td>
                                    <td>{{$lists->name_of_company}}</td>
                                    <td>{{$lists->company_number}}</td>
                                    <td>{{$lists->manager_name}}</td>
                                    <td>{{$lists->other_details}}</td>
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
                                        <a href="javascript: void(0);" wire:click="EditSubscriberModel('{{$lists->id}}', '{{$key}}')" class="action-icon"><span wire:loading wire:target="EditSubscriberModel('{{$lists->id}}', '{{$key}}')" class="spinner-border spinner-border-sm" role="status"></span> <i wire:loading.remove wire:target="EditSubscriberModel('{{$lists->id}}', '{{$key}}')" class="mdi mdi-pencil"></i></a>
                                        <a href="javascript: void(0);" wire:click="DeleteASubscriber('{{$lists->id}}')" class="action-icon"><span wire:loading wire:target="DeleteASubscriber('{{$lists->id}}')" class="spinner-border spinner-border-sm" role="status"></span> <i wire:loading.remove wire:target="DeleteASubscriber('{{$lists->id}}')" class="mdi mdi-delete"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                        @endif


                    @else

                        @if($GroupViewSLists == "No")
                            @if(empty($SearchSubscribers))
                                @forelse(\App\Models\subscribers::whereuser_id(auth()->user()->id)->skip($PreviousViewCount)->take($CurrentViewCount)->limit(20)->get() as $key => $lists)
                                <tr>
                                    <td><input type="checkbox" wire:model.prevent="SelectSubscibersCheck.{{$key}}" class="form-check-input" value="{{$lists->id}}" id="{{$key}}{{$lists->id}}"></td>
                                    <td>{{$lists->id}}</td>
                                    <td><strong>{{\App\Models\subscribe_groups::whereid($lists->group_id)->first()->name}}</strong></td>
                                    <td>{{$lists->first_name}}</td>
                                    <td>{{$lists->last_name}}</td>
                                    <td>{{$lists->email}}</td>
                                    <td>{{$lists->phone}}</td>
                                    <td>{{$lists->address}}</td>
                                    <td>{{$lists->name_of_company}}</td>
                                    <td>{{$lists->company_number}}</td>
                                    <td>{{$lists->manager_name}}</td>
                                    <td>{{$lists->other_details}}</td>
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
                                        <a href="javascript: void(0);" wire:click="EditSubscriberModel('{{$lists->id}}', '{{$key}}')" class="action-icon"><span wire:loading wire:target="EditSubscriberModel('{{$lists->id}}', '{{$key}}')" class="spinner-border spinner-border-sm" role="status"></span> <i wire:loading.remove wire:target="EditSubscriberModel('{{$lists->id}}', '{{$key}}')" class="mdi mdi-pencil"></i></a>
                                        <a href="javascript: void(0);" wire:click="DeleteASubscriber('{{$lists->id}}')" class="action-icon"><span wire:loading wire:target="DeleteASubscriber('{{$lists->id}}')" class="spinner-border spinner-border-sm" role="status"></span> <i wire:loading.remove wire:target="DeleteASubscriber('{{$lists->id}}')" class="mdi mdi-delete"></i></a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
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
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                @endforelse
                            @else
                                @forelse(\App\Models\subscribers::where('first_name', 'like', '%'.$SearchSubscribers.'%')->orwhere('last_name', 'like', '%'.$SearchSubscribers.'%')->orwhere('email', 'like', '%'.$SearchSubscribers.'%')->get() as $key => $lists)
                                    @if($lists->user_id == auth()->user()->id)
                                    <tr>
                                        <td><input type="checkbox" wire:model.prevent="SelectSubscibersCheck.{{$key}}" class="form-check-input" value="{{$lists->id}}" id="{{$key}}{{$lists->id}}"></td>
                                        <td>{{$lists->id}}</td>
                                        <td><strong>{{\App\Models\subscribe_groups::whereid($lists->group_id)->first()->name}}</strong></td>
                                        <td>{{$lists->first_name}}</td>
                                        <td>{{$lists->last_name}}</td>
                                        <td>{{$lists->email}}</td>
                                        <td>{{$lists->phone}}</td>
                                        <td>{{$lists->address}}</td>
                                        <td>{{$lists->name_of_company}}</td>
                                        <td>{{$lists->company_number}}</td>
                                        <td>{{$lists->manager_name}}</td>
                                        <td>{{$lists->other_details}}</td>
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
                                            <a href="javascript: void(0);" wire:click="EditSubscriberModel('{{$lists->id}}', '{{$key}}')" class="action-icon"><span wire:loading wire:target="EditSubscriberModel('{{$lists->id}}', '{{$key}}')" class="spinner-border spinner-border-sm" role="status"></span> <i wire:loading.remove wire:target="EditSubscriberModel('{{$lists->id}}', '{{$key}}')" class="mdi mdi-pencil"></i></a>
                                            <a href="javascript: void(0);" wire:click="DeleteASubscriber('{{$lists->id}}')" class="action-icon"><span wire:loading wire:target="DeleteASubscriber('{{$lists->id}}')" class="spinner-border spinner-border-sm" role="status"></span> <i wire:loading.remove wire:target="DeleteASubscriber('{{$lists->id}}')" class="mdi mdi-delete"></i></a>
                                        </td>
                                    </tr>
                                    @else
                                    <tr>
                                        <td>Data Not Found!</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    @endif
                                @empty
                                    <tr>
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
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                @endforelse
                            @endif
                        @else
                            @foreach(\App\Models\subscribers::whereuser_id(auth()->user()->id)->wheregroup_id($GroupViewSListsGID)->skip($PreviousViewCount)->take($CurrentViewCount)->limit(20)->get() as $key => $lists)
                                <tr>
                                    <td><input type="checkbox" wire:model.prevent="SelectSubscibersCheck.{{$key}}" class="form-check-input" value="{{$lists->id}}" id="{{$key}}{{$lists->id}}"></td>
                                    <td>{{$lists->id}}</td>
                                    <td><strong>{{\App\Models\subscribe_groups::whereid($lists->group_id)->first()->name}}</strong></td>
                                    <td>{{$lists->first_name}}</td>
                                    <td>{{$lists->last_name}}</td>
                                    <td>{{$lists->email}}</td>
                                    <td>{{$lists->phone}}</td>
                                    <td>{{$lists->address}}</td>
                                    <td>{{$lists->name_of_company}}</td>
                                    <td>{{$lists->company_number}}</td>
                                    <td>{{$lists->manager_name}}</td>
                                    <td>{{$lists->other_details}}</td>
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
                                        <a href="javascript: void(0);" wire:click="EditSubscriberModel('{{$lists->id}}', '{{$key}}')" class="action-icon"><span wire:loading wire:target="EditSubscriberModel('{{$lists->id}}', '{{$key}}')" class="spinner-border spinner-border-sm" role="status"></span> <i wire:loading.remove wire:target="EditSubscriberModel('{{$lists->id}}', '{{$key}}')" class="mdi mdi-pencil"></i></a>
                                        <a href="javascript: void(0);" wire:click="DeleteASubscriber('{{$lists->id}}')" class="action-icon"><span wire:loading wire:target="DeleteASubscriber('{{$lists->id}}')" class="spinner-border spinner-border-sm" role="status"></span> <i wire:loading.remove wire:target="DeleteASubscriber('{{$lists->id}}')" class="mdi mdi-delete"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                        @endif


                    @endif
                </tbody>
            </table>
            @if($GroupViewSLists == "No")
                @if(empty($SearchSubscribers))
                    @if(\App\Models\subscribers::all()->count() > 5)
                    <div class="p-2 mb-3">
                        <div class="row">
                            @if(\App\Models\subscribers::all()->count() > 20)
                                @if($PreviousViewCount > 0)
                                <div class="col-lg-6">
                                    <p class=""><a href="javascript: void(0);" wire:click="SubscriberListsLoadPrevious('20')"><span wire:loading wire:target="SubscriberListsLoadPrevious('20')" class="spinner-border spinner-border-sm" role="status"></span> Previous</a></p>
                                </div>
                                @else
                                <div class="col-lg-6">

                                </div>
                                @endif
                                <div class="col-lg-6" style="text-align: right;">
                                    <p class=""><a href="javascript: void(0);" wire:click="SubscriberListsLoadMore('20')"><span wire:loading wire:target="SubscriberListsLoadMore('20')" class="spinner-border spinner-border-sm" role="status"></span> Next</a></p>
                                </div>
                            @endif
                        </div>
                    </div>
                    @endif
                @endif
            @else
                @if(\App\Models\subscribers::wheregroup_id($GroupViewSListsGID)->count() > 5)
                    <div class="p-2 mb-3">
                        <div class="row">
                            @if(\App\Models\subscribers::wheregroup_id($GroupViewSListsGID)->count() > 20)
                                @if($PreviousViewCount > 0)
                                <div class="col-lg-6">
                                    <p class=""><a href="javascript: void(0);" wire:click="SubscriberListsLoadPrevious('20')"><span wire:loading wire:target="SubscriberListsLoadPrevious('20')" class="spinner-border spinner-border-sm" role="status"></span> Previous</a></p>
                                </div>
                                @else
                                <div class="col-lg-6">

                                </div>
                                @endif
                                <div class="col-lg-6" style="text-align: right;">
                                    <p class=""><a href="javascript: void(0);" wire:click="SubscriberListsLoadMore('20')"><span wire:loading wire:target="SubscriberListsLoadMore('20')" class="spinner-border spinner-border-sm" role="status"></span> Next</a></p>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </div>

    <!-- Add New Subscriber Models -->
    <div wire:ignore.self class="modal fade" id="addNewSubscriberModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-full-width">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add a new subscriber</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3 col-md-6">
                                <label for="inputState" class="form-label">Subscribe Group</label>
                                <select id="inputState" wire:model.prevent="SelectingGroupInput" class="form-select" required>
                                    <option value="">Please select one</option>
                                    @foreach(\App\Models\subscribe_groups::whereuser_id(auth()->user()->id)->wherestatus("active")->get() as $lists)
                                        @if($lists->name == "CSV Imported")

                                        @else
                                        <option value="{{$lists->id}}">{{$lists->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="firstname" class="form-label">First Name</label>
                                <input type="text" wire:model.prevent="FirstNameInpute" class="form-control" id="firstname" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="lastname" class="form-label">Last Name</label>
                                <input type="text" wire:model.prevent="LastNameInpute" class="form-control" id="lastname" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" wire:model.prevent="EmailInpute" class="form-control" id="email" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Phone Number</label>
                                <input type="number" wire:model.prevent="PhoneInpute" class="form-control" data-toggle="input-mask" data-mask-format="0000-0000" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" wire:model.prevent="Address1Inpute" class="form-control" id="address" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="address2" class="form-label">Address 2</label>
                                <input type="text" wire:model.prevent="Address2Inpute" class="form-control" id="address2">
                            </div>
                                        
                            <div class="row g-2">
                                <div class="mb-3 col-md-6">
                                    <label for="inputCity" class="form-label">City</label>
                                    <input type="text" wire:model.prevent="AddressCityInpute" class="form-control" id="inputCity" required>
                                </div>
                                <div class="mb-3 col-md-2">
                                    <label for="inputZip" class="form-label">Zip</label>
                                    <input type="text" wire:model.prevent="AddressZipInpute" class="form-control" id="inputZip" required>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="inputCity" class="form-label">Country</label>
                                    <input type="text" wire:model.prevent="AddessCountryInpute" class="form-control" id="inputCity" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="company-name" class="form-label">Company Name</label>
                                        <input type="text" wire:model.prevent="CompanyNameInpute" class="form-control" id="company-name" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="company-number" class="form-label">Company Number</label>
                                        <input type="number" wire:model.prevent="CompanyNumberInpute" class="form-control" id="company-number" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="manager-name" class="form-label">Manager's Name</label>
                                        <input type="text" wire:model.prevent="ManagerNameInpute" class="form-control" id="manager-name" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="others-details" class="form-label">Others Details</label>
                                        <input type="text" wire:model.prevent="OthersDetailsInpute" class="form-control" raw="10" id="others-details">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" wire:click="CreateAnewSubscriber" class="btn btn-primary"><span wire:loading wire:target="CreateAnewSubscriber" class="spinner-border spinner-border-sm" role="status"></span> Submit</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Subscriber Edit Models -->
    <div wire:ignore.self class="modal fade" id="EditSubscriberModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-full-width">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Subscriber</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3 col-md-6">
                                <label for="inputState" class="form-label">Subscribe Group</label>
                                <select id="inputState" wire:model.prevent="SelectingGroupInput2" class="form-select" required>
                                    <option value="">Please select one</option>
                                    @foreach(\App\Models\subscribe_groups::whereuser_id(auth()->user()->id)->wherestatus("active")->get() as $lists)
                                        @if($lists->name == "CSV Imported")

                                        @else
                                        <option value="{{$lists->id}}">{{$lists->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="firstname" class="form-label">First Name</label>
                                <input type="text" wire:model.prevent="FirstNameInpute2" class="form-control" id="firstname" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="lastname" class="form-label">Last Name</label>
                                <input type="text" wire:model.prevent="LastNameInpute2" class="form-control" id="lastname" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" wire:model.prevent="EmailInpute2" class="form-control" id="email" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Phone Number</label>
                                <input type="number" wire:model.prevent="PhoneInpute2" class="form-control" data-toggle="input-mask" data-mask-format="0000-0000" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" wire:model.prevent="Address1Inpute2" class="form-control" id="address" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="company-name" class="form-label">Company Name</label>
                                        <input type="text" wire:model.prevent="CompanyNameInpute2" class="form-control" id="company-name" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="company-number" class="form-label">Company Number</label>
                                        <input type="number" wire:model.prevent="CompanyNumberInpute2" class="form-control" id="company-number" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="manager-name" class="form-label">Manager's Name</label>
                                        <input type="text" wire:model.prevent="ManagerNameInpute2" class="form-control" id="manager-name" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="others-details" class="form-label">Others Details</label>
                                        <input type="text" wire:model.prevent="OthersDetailsInpute2" class="form-control" raw="10" id="others-details">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" wire:click="EditedSubscriberSave" class="btn btn-primary"><span wire:loading wire:target="EditedSubscriberSave" class="spinner-border spinner-border-sm" role="status"></span> Submit</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Subscriber Bulk Importing Models -->
    <div wire:ignore.self class="modal fade" id="ImportingSubscriberModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Import Subscriber - {{Session::get('ImportingSubscriber')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div wire:ignore.self class="modal-body text-center">
                    <div wire:loading.remove wire:target="ImportSubscriberFromAFile" class="row">
                        @if(Session::has('ImportingSubscriber'))
                            <div class="col-lg-12 text-center text-success" style="font-size: 150px;">
                                <i class="mdi mdi-check-circle"></i>
                            </div>
                            <div class="col-lg-12 text-center">
                                <p>All data imported successfully.</p>
                            </div>
                        @else
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="example-fileinput" class="form-label">Choos a .csv file</label>
                                    <input type="file" wire:model="file" id="example-fileinput" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <select id="inputState" class="form-select" wire:model="ImportGroup" required>
                                        <option value="">Select Subscriber Group</option>
                                        @foreach(\App\Models\subscribe_groups::whereuser_id(auth()->user()->id)->wherestatus("active")->get() as $lists)
                                            @if(auth()->user()->user_type == "Staff")
                                                @if($lists->user_id == auth()->user()->id)
                                                <option value="{{$lists->id}}">{{$lists->name}}</option>
                                                @endif
                                            @else
                                                <option value="{{$lists->id}}">{{$lists->name}} - Created by: {{\App\Models\User::whereid($lists->user_id)->first()->email}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div wire:loading wire:target="ImportSubscriberFromAFile" class="row">
                        <div class="col-lg-12 p-2">
                            <div class="spinner-border avatar-lg text-primary" role="status"></div>
                        </div>
                        <div class="col-lg-12 p-2">
                            <p class="mb-3">Importing Your Data, Please wait ...</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button wire:loading wire:target="file" type="button" class="btn btn-danger"><span class="spinner-border spinner-border-sm" role="status"></span> Uploading</button>
                    <button wire:loading.remove wire:target="file" type="button" wire:click="ImportSubscriberFromAFile" class="btn btn-primary"><span wire:loading wire:target="ImportSubscriberFromAFile" class="spinner-border spinner-border-sm" role="status"></span> Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>