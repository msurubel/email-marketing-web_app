<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\branding;
use App\Models\subscribe_groups;


class AppInstall extends Component
{
    public $DBConnection = "Not";
    public $ProcessPage = "DBConnectionCheck";

    public $DBInstallationIsLoading = "No";

    public $email;
    public $name;
    public $password;
    public $passwordconfirm;

    public function mount()
    {
        try {
            if(empty(\DB::connection()->getDatabaseName())){
                $this->DBConnection = "Not"; 
            }else{
                \DB::connection()->getPDO();
                $this->DBConnection = "Yes";
            }
        } catch (\Exception $e) {
            $this->DBConnection = "Not";
        }
    }

    public function CheckDBConnectionOthers()
    {
        try {
            if(empty(\DB::connection()->getDatabaseName())){
                $this->DBConnection = "Not"; 
            }else{
                \DB::connection()->getPDO();
                $this->DBConnection = "Yes";
            }
        } catch (\Exception $e) {
            $this->DBConnection = "Not";
        }
    }

    public function SwichPageInstallation($page)
    {
        $this->ProcessPage = "$page";
    }

    public function InstallDatabaseTables()
    {
        try {
            \Artisan::call('migrate');
            $this->SwichPageInstallation('DBInstallationDone');
        } catch (\Exception $e) {
            $this->emit('alert-error', ['message' => 'Something wrong please wait!']);
            //$this->DBConnection = "Not";
        }
    }

    public function RegisterFirstUser()
    {
        try {
            $createnew = new User();
            $createnew->user_type = "Admin";
            $createnew->name = $this->name;
            $createnew->email = $this->email;
            $createnew->password = Hash::make($this->password);
            $createnew->save();

            $createBranding = new branding();
            $createBranding->name = "Mailler System v2.0";
            $createBranding->main_logo = "main_logo.png";
            $createBranding->logo_icon = "3ZfesFGybP.png";
            $createBranding->fevicon = "9Cfjj3O3dO.ico";
            $createBranding->save();

            $createSubscribeGroup = new subscribe_groups;
            $createSubscribeGroup->user_id = 1;
            $createSubscribeGroup->name = "CSV Imported";
            $createSubscribeGroup->subscribers = 0;
            $createSubscribeGroup->status = "Active";
            $createSubscribeGroup->save();
            $this->SwichPageInstallation('AppInstalled');
        } catch (\Exception $e) {
            $this->emit('alert-error', ['message' => 'Something wrong please wait!']);
            //$this->DBConnection = "Not";
        }
    }

    public function LoginDashboard()
    {
        return redirect(url('/').'/login');
    }

    public function render()
    {
        return view('livewire.app-install');
    }
}
