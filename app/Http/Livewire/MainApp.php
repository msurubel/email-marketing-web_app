<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\Auth;
use App\Models\staff_access_permission;
use App\Models\staff_activities;
use App\Models\User;

class MainApp extends Component
{
    protected $listeners = ['GoToRoutePageMainApp' => 'RouteChangeTow'];
    public $route;
    public $DeviceAccess = false;

    public function mount()
    {
        $this->route = request()->pg;

        if(Auth::user()->user_type == "Staff"){
            $agent = new Agent();
            $staff_access_data = staff_access_permission::whereuser_id(Auth::user()->id)->first();
            $clientIP = request()->getClientIp();
            $device_details = 'device_name: '.$agent->device().', platform: '.$agent->platform().', browser: '.$agent->browser();

            if($staff_access_data->first_ip == $clientIP || $staff_access_data->device_details == "$device_details"){
                $this->DeviceAccess = true;
            }else{
                $this->DeviceAccess = false;
            }
        }
    }

    public function RouteChange($route)
    {
        if(Auth::user()->user_type == "Staff"){
            $agent = new Agent();
            $staff_access_data = staff_access_permission::whereuser_id(Auth::user()->id)->first();
            $clientIP = request()->getClientIp();
            $device_details = 'device_name: '.$agent->device().', platform: '.$agent->platform().', browser: '.$agent->browser();
    
            if($staff_access_data->first_ip == $clientIP || $staff_access_data->device_details == "$device_details"){
                $this->DeviceAccess = true;
            }else{
                $this->DeviceAccess = false;
            }

            $createActivities = new staff_activities();
            $createActivities->user_id = Auth::user()->id;
            $createActivities->activities_description = "User visited route page (".$route.")";
            $createActivities->save();
        }

        $this->emit('urlChange', '/admin?pg='.$route);
        $this->route = $route;
    }

    public function RouteChangeTow($route, $id)
    {
        $this->emit('urlChange', '/admin?pg='.$route);
        $this->route = $route;
        $this->emit('GoToRoutePageSubscribers', "$id");
    }

    public function Logout() {

        $getActivites = staff_activities::whereuser_id(Auth::user()->id)->get();
        foreach($getActivites as $lists){
            $activities = staff_activities::whereid($lists->id)->first();
            $activities->delete();
        }
        $lastActiveUPT = User::whereid(Auth::user()->id)->first();
        $lastActiveUPT->updated_at = \Carbon\Carbon::now();
        $lastActiveUPT->save();
        Auth::logout();
        return redirect(url('/').'/login');
    }

    public function render()
    {
        return view('livewire.main-app');
    }
}
