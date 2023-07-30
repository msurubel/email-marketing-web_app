<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Session;
use Illuminate\Support\Facades\Auth;

use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;

use App\Models\subscribers;
use App\Models\system_logs;

class SubscriberLists extends Component
{
    use WithFileUploads;
    
    public $FirstNameInpute;
    public $LastNameInpute;
    public $EmailInpute;
    public $PhoneInpute;
    public $Address1Inpute;
    public $Address2Inpute;
    public $AddressCityInpute;
    public $AddessCountryInpute;
    public $AddressZipInpute;
    public $CompanyNameInpute;
    public $CompanyNumberInpute;
    public $ManagerNameInpute;
    public $OthersDetailsInpute;
    public $SelectingGroupInput;

    public $FirstNameInpute2;
    public $LastNameInpute2;
    public $EmailInpute2;
    public $PhoneInpute2;
    public $Address1Inpute2;
    public $CompanyNameInpute2;
    public $CompanyNumberInpute2;
    public $ManagerNameInpute2;
    public $OthersDetailsInpute2;
    public $SelectingGroupInput2;

    public $SelectedIDforEdit;

    public $CurrentViewCount = 20;
    public $PreviousViewCount = 0;

    public $file;

    public $SelectSubscibersCheck = [];
    public $SelectingGroupInputForSelectingSubscribers;

    public $SearchSubscribers;
    public $ImportGroup;

    public $GroupViewSLists = "No";
    public $GroupViewSListsGID;

    protected $listeners = ['GoToRoutePageSubscribers' => 'GViewSubLists'];

    public function mount()
    {
        
    }

    public function DeSelectGroupView()
    {
        $this->GroupViewSLists = "No";
    }

    public function TransferSubscribersToAGroup()
    {
        if(empty($this->SelectingGroupInputForSelectingSubscribers)){
            $this->emit('alert-error', ['message' => 'Please select a group from dropdown!']);
        }else{
            foreach($this->SelectSubscibersCheck as $id){
                if(subscribers::whereid($id)->first()){
                    $transferSubscriber = subscribers::whereid($id)->first();
                    $transferSubscriber->group_id = $this->SelectingGroupInputForSelectingSubscribers;
                    $transferSubscriber->save();
                }
            }
            $this->emit('alert-success', ['message' => 'Successfully Transfered!']);
        }
    }

    public function GViewSubLists($id)
    {
        $this->GroupViewSLists = "Yes";
        $this->GroupViewSListsGID = $id;
    }

    public function DeletedSelectedSubscriber()
    {
        $this->GroupViewSLists = "No";
        if(empty($this->SelectSubscibersCheck)){
            $this->emit('alert-error', ['message' => 'Please select a some subscribers']);
        }else{
            foreach($this->SelectSubscibersCheck as $id){
                if(subscribers::whereid($id)->first()){
                    $transferSubscriber = subscribers::whereid($id)->first();
                    $transferSubscriber->delete();
                }
            }
            $this->SelectSubscibersCheck = [];
            $this->emit('alert-success', ['message' => 'Successfully Deleted!']);
        }
    }

    public function ClearSelectionChecked()
    {
        $this->SelectSubscibersCheck = [];
        $this->SelectingGroupInputForSelectingSubscribers = "";
    }

    public function SubscriberListsLoadMore($lmcounter)
    {
        $this->PreviousViewCount = $this->PreviousViewCount + $lmcounter;
        $this->CurrentViewCount = $this->CurrentViewCount + $lmcounter;
    }

    public function SubscriberListsLoadPrevious($lmcounter)
    {
        $this->PreviousViewCount = $this->PreviousViewCount - $lmcounter;
        $this->CurrentViewCount = $this->CurrentViewCount - $lmcounter;
    }

    public function CreateAnewSubscriber ()
    {
        try {
            if(empty($this->FirstNameInpute)){
                $this->emit('alert-error', ['message' => 'Please fullfill all input!']);
            }else{
                if(empty($this->LastNameInpute)){
                    $this->emit('alert-error', ['message' => 'Please fullfill all input!']);
                }else{
                    if(empty($this->EmailInpute)){
                        $this->emit('alert-error', ['message' => 'Please fullfill all input!']);
                    }else{
                        if(empty($this->PhoneInpute)){
                            $this->emit('alert-error', ['message' => 'Please fullfill all input!']);
                        }else{
                            $createSubscriber = new subscribers();
                            $createSubscriber->user_id = Auth::user()->id;
                            $createSubscriber->group_id = $this->SelectingGroupInput;
                            $createSubscriber->first_name = $this->FirstNameInpute;
                            $createSubscriber->last_name = $this->LastNameInpute;
                            $createSubscriber->email = $this->EmailInpute;
                            $createSubscriber->phone = $this->PhoneInpute;
                            $createSubscriber->address = ''.$this->Address1Inpute.' '.$this->Address2Inpute.', '.$this->AddressCityInpute.' - '.$this->AddressZipInpute.', '.$this->AddessCountryInpute.'.';
                            $createSubscriber->name_of_company = $this->CompanyNameInpute;
                            $createSubscriber->company_number = $this->CompanyNumberInpute;
                            $createSubscriber->manager_name = $this->ManagerNameInpute;
                            if(empty($this->OthersDetailsInpute)){
                                $createSubscriber->other_details = "N/A";
                            }else{
                                $createSubscriber->other_details = $this->OthersDetailsInpute;
                            }
                            $createSubscriber->status = "Active";
                            $createSubscriber->save();

                            $this->dispatchBrowserEvent('addNewSubscriberHide');
                            $this->emit('alert-success', ['message' => 'Subscriber added successfully!']);
                        }
                    }
                }
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



    public function EditSubscriberModel($id)
    {
        $getData = subscribers::whereid($id)->first();
        $this->SelectingGroupInput2 = $getData->group_id;
        $this->FirstNameInpute2 = $getData->first_name;
        $this->LastNameInpute2 = $getData->last_name;
        $this->EmailInpute2 = $getData->email;
        $this->PhoneInpute2 = $getData->phone;
        $this->Address1Inpute2 = $getData->address;
        $this->CompanyNameInpute2 = $getData->name_of_company;
        $this->CompanyNumberInpute2 = $getData->company_number;
        $this->ManagerNameInpute2 = $getData->manager_name;
        $this->OthersDetailsInpute2 = $getData->other_details;
        $this->SelectedIDforEdit = $id;
        $this->dispatchBrowserEvent('EditSubscriberShow');
    }

    public function EditedSubscriberSave()
    {
        try {
            if(empty($this->FirstNameInpute2)){
                $this->emit('alert-error', ['message' => 'Please fullfill all input!']);
            }else{
                if(empty($this->LastNameInpute2)){
                    $this->emit('alert-error', ['message' => 'Please fullfill all input!']);
                }else{
                    if(empty($this->EmailInpute2)){
                        $this->emit('alert-error', ['message' => 'Please fullfill all input!']);
                    }else{
                        if(empty($this->PhoneInpute2)){
                            $this->emit('alert-error', ['message' => 'Please fullfill all input!']);
                        }else{
                            $saveSubscriber = subscribers::whereid($this->SelectedIDforEdit)->first();
                            $saveSubscriber->group_id = $this->SelectingGroupInput2;
                            $saveSubscriber->first_name = $this->FirstNameInpute2;
                            $saveSubscriber->last_name = $this->LastNameInpute2;
                            $saveSubscriber->email = $this->EmailInpute2;
                            $saveSubscriber->phone = $this->PhoneInpute2;
                            $saveSubscriber->address = $this->Address1Inpute2;
                            $saveSubscriber->name_of_company = $this->CompanyNameInpute2;
                            $saveSubscriber->company_number = $this->CompanyNumberInpute2;
                            $saveSubscriber->manager_name = $this->ManagerNameInpute2;
                            if(empty($this->OthersDetailsInpute2)){
                                $saveSubscriber->other_details = "N/A";
                            }else{
                                $saveSubscriber->other_details = $this->OthersDetailsInpute2;
                            }
                            $saveSubscriber->status = "Active";
                            $saveSubscriber->save();

                            $this->dispatchBrowserEvent('EditSubscriberHide');
                            $this->emit('alert-success', ['message' => 'Subscriber edit saved successfully!']);
                        }
                    }
                }
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

    public function ImportSubscriberModelView()
    {
        $this->dispatchBrowserEvent('ImportSubscriberShow');
    }

    public function ImportSubscriberFromAFile()
    {
        try {
            if(empty($this->file) || empty($this->ImportGroup) || $this->ImportGroup == null){
                $this->emit('alert-error', ['message' => 'Please add a CSV file & fullfill all inputs.']);
            }else{
                Session::flash('GroupType', $this->ImportGroup);
                Excel::import(new UsersImport, $this->file); 
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

    public function DeleteASubscriber($id)
    {
        try {
            $deleteSubscriber = subscribers::whereid($id)->first();
            $deleteSubscriber->delete();
            $this->emit('alert-success', ['message' => 'Subscriber deleted successfully!']);
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

    public function OpenAddNewSubscriberModel()
    {
        $this->dispatchBrowserEvent('addNewSubscriberShow');
    }

    public function updated()
    {
        if(empty($this->SelectSubscibersCheck)){
            $this->SelectSubscibersCheck = [];
        }
    }

    public function render()
    {
        return view('livewire.subscriber-lists');
    }
}
