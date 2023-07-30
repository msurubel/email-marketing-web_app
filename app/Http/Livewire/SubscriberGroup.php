<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Session;
use Illuminate\Support\Facades\Auth;

use App\Models\subscribe_groups;
use App\Models\system_logs;
use App\Models\subscribers;
use App\Models\User;

class SubscriberGroup extends Component
{
    public $error = [];
    public $GroupNameInpute;
    public $EditGroupInpute;
    public $WantToEditGroup;
    public $SelectedGroupIDforDelet;
    public $SearchGroupByUser;
    public $SearchingFoundedID;

    public function CreateNewGroup()
    {
        try {
            $createGroup = new subscribe_groups();
            $createGroup->user_id = Auth::user()->id;
            $createGroup->name = $this->GroupNameInpute;
            $createGroup->subscribers = 0;
            $createGroup->status = "Active";
            $createGroup->save();
            $this->dispatchBrowserEvent('addNewGroupHide');
            $this->emit('alert-success', ['message' => 'Group created successfully!']);
        } catch (\Exception $e) {
            $createLog = new system_logs();
            $createLog->user_id = auth()->user()->id;
            $createLog->error_code = $e->getCode();
            $createLog->error_details = $e->getMessage();
            $createLog->error_from = url()->full();
            $createLog->save();
            $this->emit('alert-error', ['message' => 'Something wrong please wait!']);
        }
    }

    public function JumpToAnotherPage($id)
    {
        //$this->emit('GoToRoutePageSubscribers', $id);
        $this->emit('GoToRoutePageMainApp', "subscribers", $id);
    }

    public function EditGroupSave ()
    {
        try {
            if(empty($this->EditGroupInpute)){
                $this->error = [
                    'massage' => "Name inpute must be can't empty.",
                ];
            }else{
                $saveGroup = subscribe_groups::whereid($this->WantToEditGroup)->first();
                $saveGroup->name = $this->EditGroupInpute;
                $saveGroup->save();
                $this->dispatchBrowserEvent('editGroupModelHide');
                $this->emit('alert-success', ['message' => 'Group edit saved successfully!']);
            }
        } catch (\Exception $e) {
            $createLog = new system_logs();
            $createLog->user_id = auth()->user()->id;
            $createLog->error_code = $e->getCode();
            $createLog->error_details = $e->getMessage();
            $createLog->error_from = url()->current();
            $createLog->save();
            $this->emit('alert-error', ['message' => 'Something wrong please wait!']);
        }
    }

    public function ChangeAGroupStatus($id, $status)
    {
        try {
            $statusGroup = subscribe_groups::whereid($id)->first();
            $statusGroup->status = "$status";
            $statusGroup->save();
            $this->emit('alert-success', ['message' => 'Group status successfully changed!']);
        } catch (\Exception $e) {
            $createLog = new system_logs();
            $createLog->user_id = auth()->user()->id;
            $createLog->error_code = $e->getCode();
            $createLog->error_details = $e->getMessage();
            $createLog->error_from = url()->current();
            $createLog->save();
            $this->emit('alert-error', ['message' => 'Something wrong please wait!']);
        }
    }

    public function GroupDeleteConfirmation($id)
    {
        $this->SelectedGroupIDforDelet = $id;
        $this->dispatchBrowserEvent('GroupDeleteConfirmModelShow');

    }

    public function DeleteAGroup()
    {
        try {
            $deleteGroup = subscribe_groups::whereid($this->SelectedGroupIDforDelet)->first();

            $getSubscribers = subscribers::wheregroup_id($this->SelectedGroupIDforDelet)->get();
            foreach ($getSubscribers as $DeleteSubscriber){
                if(subscribers::whereid($DeleteSubscriber->id)->first()){
                    $selectSubscriber = subscribers::whereid($DeleteSubscriber->id)->first();
                    $selectSubscriber->delete();
                }
            }
            $deleteGroup->delete();
            $this->dispatchBrowserEvent('GroupDeleteConfirmModelHide');
            $this->emit('alert-success', ['message' => 'Group deleted successfully!']);
        } catch (\Exception $e) {
            $createLog = new system_logs();
            $createLog->user_id = auth()->user()->id;
            $createLog->error_code = $e->getCode();
            $createLog->error_details = $e->getMessage();
            $createLog->error_from = url()->current();
            $createLog->save();
            $this->emit('alert-error', ['message' => 'Something wrong please wait!']);
        }
    }

    public function OpenAddNewGroupsModel()
    {
        $this->dispatchBrowserEvent('addNewGroupShow');
    }

    public function OpenEditGroupModel($id)
    {
        try {
            $this->WantToEditGroup = $id;
            $this->EditGroupInpute = subscribe_groups::whereid($id)->first()->name;
            $this->dispatchBrowserEvent('editGroupModelShow');
        } catch (\Exception $e) {
            $createLog = new system_logs();
            $createLog->user_id = auth()->user()->id;
            $createLog->error_code = $e->getCode();
            $createLog->error_details = $e->getMessage();
            $createLog->error_from = url()->current();
            $createLog->save();
            $this->emit('alert-error', ['message' => 'Something wrong please wait!']);
        }
    }

    public function updated()
    {
        if(empty($this->SearchGroupByUser)){

        }else{
            $getUserData = User::where('email', 'like', '%'.$this->SearchGroupByUser.'%')->orwhere('name', 'like', '%'.$this->SearchGroupByUser.'%')->first();
            $this->SearchingFoundedID = $getUserData->id;
        }
    }

    public function render()
    {
        return view('livewire.subscriber-group');
    }
}
