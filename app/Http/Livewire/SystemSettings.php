<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Config;
use Illuminate\Support\Facades\Mail;
use App\Mail\BulkMail;

use App\Models\system_logs;
use App\Models\smtp_configs;
use App\Models\branding;
use App\Models\User;
use App\Models\mailler_jobs;
use App\Models\subscribe_groups;
use App\Models\subscribers;

class SystemSettings extends Component
{
    use WithFileUploads;

    public $SMTPProviderName;
    public $SMTPMailler;
    public $SMTPPort;
    public $SMTPHost;
    public $SMTPEncryption;
    public $SMTPSendingLimitDaily;
    public $SMTPUsername;
    public $SMTPPassword;

    public $EditSMTPProviderName;
    public $EditSMTPMailler; 
    public $EditSMTPPort;
    public $EditSMTPHost;
    public $EditSMTPEncryption;
    public $EditSMTPSendingLimitDaily;
    public $EditSMTPUsername;
    public $EditSMTPPassword;

    public $SMTPConfigChangeStatus;
    public $SelectedSMTPConfig;

    public $AppName;
    public $AppMainLogo;
    public $AppLogoIcon;
    public $AppFevicon;

    public $ChangeDAccessName;
    public $ChangeDAccessEmail;
    public $ChangeDAccessPassword;

    public $NewLoginUserName;
    public $NewLoginUserEmail;
    public $NewLoginUserPassword;

    public $SelectedUserIDforEDIT;
    public $EditLoginName;
    public $EditLoginEmail;
    public $EditLoginPassword;

    public function mount()
    {
        if(branding::whereid(1)->first()){
            $this->AppName = branding::whereid(1)->first()->name;
        }else{
            $this->AppName = "Mailler System v2.0";
        }
    }

    public function MakeMailerLoginUser() 
    {
        if(User::whereemail($this->NewLoginUserEmail)->first()){
            $this->emit('alert-error', ['message' => 'This email ID used for other user, please use another mail ID!']);
        }else{
            $createnew = new User();
            $createnew->user_type = "Staff";
            $createnew->name = $this->NewLoginUserName;
            $createnew->email = $this->NewLoginUserEmail;
            $createnew->password = Hash::make($this->NewLoginUserPassword);
            $createnew->save();
            $this->emit('alert-success', ['message' => 'A new Login user created!']);
        }
    }

    public function ShowEditingUserPanel($id)
    {
        $this->SelectedUserIDforEDIT = $id;
        $this->dispatchBrowserEvent('EditingLoginUsersModelViewShow');
    }

    public function SaveEditingUser()
    {
        $saveEditUser = User::whereid($this->SelectedUserIDforEDIT)->first();
        $saveEditUser->name = $this->EditLoginName;
        $saveEditUser->email = $this->EditLoginEmail;
        $saveEditUser->password = Hash::make($this->EditLoginPassword);
        $saveEditUser->save();
        $this->dispatchBrowserEvent('EditingLoginUsersModelViewHide');
        $this->emit('alert-success', ['message' => 'User Access Successfully Edited!']);
    }

    public function DeleteLoginAccessUser($id)
    {
        //User Active Status
        if(\App\Models\staff_activities::whereuser_id($id)->where('created_at' , '>',\Carbon\Carbon::now()->subMinutes(5)->toDateTimeString())->count() > 0.99){
            $activeStatus = true;
        }else{
            $activeStatus = false;
        }
        //User Active Status


        if($activeStatus == false){
            $deleteUserLogin = User::whereid($id)->first();

            //All Data Deletetion Process
            $getMailerJobs = mailler_jobs::whereuser_id($id)->get();
            foreach ($getMailerJobs as $lists){
                $getLists = mailler_jobs::whereid($lists->id)->first();
                $getLists->delete();
            }
    
            $getSystemLogs = system_logs::whereuser_id($id)->get();
            foreach ($getSystemLogs as $lists){
                $getLists = system_logs::whereid($lists->id)->first();
                $getLists->delete();
            }
    
            $getSMTPConfigs = smtp_configs::whereuser_id($id)->get();
            foreach ($getSMTPConfigs as $lists){
                $getLists = smtp_configs::whereid($lists->id)->first();
                $getLists->delete();
            }
    
            $getSubscibersGroups = subscribe_groups::whereuser_id($id)->get();
            foreach ($getSubscibersGroups as $lists){
                $getLists = subscribe_groups::whereid($lists->id)->first();
                $getLists->delete();
            }
    
            $getSubscibers = subscribers::whereuser_id($id)->get();
            foreach ($getSubscibers as $lists){
                $getLists = subscribers::whereid($lists->id)->first();
                $getLists->delete();
            }
            //All Data Deletetion Process
    
            $deleteUserLogin->delete();
            $this->emit('alert-success', ['message' => 'User Successfully Deleted!']);
        }else{
            $this->emit('alert-error', ['message' => 'System Detected that this user is active now, please try again after sometime.']); 
        }
    }

    public function ReInstallApplicaitonConfirmation()
    {
        $this->dispatchBrowserEvent('ReInstallApplicaitonModelShow');
    }

    public function ChangeDAuthDetailsModel()
    {
        $this->dispatchBrowserEvent('ChangeDAuthModleShow');
    }

    public function ChangeDAuthDetails()
    {
        $getUserData = User::whereid(Auth::User()->id)->first();
        $getUserData->name = $this->ChangeDAccessName;
        $getUserData->email = $this->ChangeDAccessEmail;
        $getUserData->password = Hash::make($this->ChangeDAccessPassword);
        $getUserData->save();
        $this->dispatchBrowserEvent('ChangeDAuthModleHide');
        $this->emit('alert-success', ['message' => 'Auth Details Changed!']);
    }

    public function ReInstallApplicaiton()
    {
        \Artisan::call('route:clear');
        \Artisan::call('cache:clear');
        \Artisan::call('migrate:fresh');
        \Artisan::call('db:wipe');
        Auth::logout();
        $this->dispatchBrowserEvent('ReInstallApplicaitonModelHide');
        return redirect(url('/').'/login');
    }

    public function AddNewSMTPServerConfig()
    {
        try {
            //Test Email Settings
            $mailConfig = array(
                'driver'     =>     $this->SMTPMailler,
                'host'       =>     $this->SMTPHost,
                'port'       =>     $this->SMTPPort,
                'username'   =>     $this->SMTPUsername,
                'password'   =>     $this->SMTPPassword,
                'encryption' =>     $this->SMTPEncryption,
                'from'       =>     array('address' => Auth::User()->email, 'name' => Auth::User()->name),
                'sendmail'   =>     '/usr/sbin/sendmail -bs',
                'pretend' => false,
            );
            Config::set('mail', $mailConfig);
            $details = [
                'CompanyName' => Auth::User()->email,
                'ReplyToName' => "Mailer System v2.0",
                'ReplyToMail' => Auth::User()->email,
                'subject' => "Check SMTP Config!",
                'MailBody' => "System check SMTP config, who's you just try to add.",
                'name' => "App",
            ];
            Mail::to(Auth::User()->email)->send(new BulkMail($details));

            if(empty($this->SMTPProviderName)){
                $this->emit('alert-error', ['message' => 'Please fullfill all input!']);
            }else{
                if(empty($this->SMTPMailler)){
                    $this->emit('alert-error', ['message' => 'Please fullfill all input!']);
                }else{
                    if(empty($this->SMTPPort)){
                        $this->emit('alert-error', ['message' => 'Please fullfill all input!']);
                    }else{
                        if(empty($this->SMTPHost)){
                            $this->emit('alert-error', ['message' => 'Please fullfill all input!']);
                        }else{
                            if(empty($this->SMTPEncryption)){
                                $this->emit('alert-error', ['message' => 'Please fullfill all input!']);
                            }else{
                                if(empty($this->SMTPSendingLimitDaily)){
                                    $this->emit('alert-error', ['message' => 'Please fullfill all input!']);
                                }else{
                                    if(empty($this->SMTPUsername)){
                                        $this->emit('alert-error', ['message' => 'Please fullfill all input!']);
                                    }else{
                                        if(empty($this->SMTPPassword)){
                                            $this->emit('alert-error', ['message' => 'Please fullfill all input!']);
                                        }else{
                                            $addSMTP = new smtp_configs();
                                            $addSMTP->user_id = Auth::user()->id;
                                            $addSMTP->ref_id = Str::random(10);
                                            $addSMTP->provider_name = $this->SMTPProviderName;
                                            $addSMTP->mailler = $this->SMTPMailler;
                                            $addSMTP->port = $this->SMTPPort;
                                            $addSMTP->host = $this->SMTPHost;
                                            $addSMTP->encryption = $this->SMTPEncryption;
                                            $addSMTP->sending_limit = $this->SMTPSendingLimitDaily;
                                            $addSMTP->username = $this->SMTPUsername;
                                            $addSMTP->password = $this->SMTPPassword;
                                            $addSMTP->status = "Active";
                                            $addSMTP->save();

                                            return redirect(url('/').'/admin?pg=settings');
                                            $this->emit('alert-success', ['message' => 'Subscriber edit saved successfully!']);
                                        }
                                    }
                                }
                            }
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
            $this->emit('alert-error', ['message' => 'Something wrong please wait or check system log!']);
        }
    }

    public function SMTPConfigChangeStatus ($id, $status)
    {
        try {
            $changeSMTPStatus = smtp_configs::whereid($id)->first();
            $changeSMTPStatus->status = "$status";
            $changeSMTPStatus->save();
            $this->emit('alert-success', ['message' => 'SMTP Config status changed!']);
        } catch (\Exception $e) {
            $createLog = new system_logs();
            $createLog->user_id = auth()->user()->id;
            $createLog->error_code = $e->getCode();
            $createLog->error_details = $e->getMessage();
            $createLog->error_from = url()->current();
            $createLog->save();
            $this->emit('alert-error', ['message' => 'Something wrong please wait or check system log!']);
        }
    }

    public function SMTPConfigEditPanel($id)
    {
        $getSMTPConfig = smtp_configs::whereid($id)->first();
        $this->EditSMTPProviderName = $getSMTPConfig->provider_name;
        $this->EditSMTPMailler = $getSMTPConfig->mailler;
        $this->EditSMTPPort = $getSMTPConfig->port;
        $this->EditSMTPHost = $getSMTPConfig->host;
        $this->EditSMTPEncryption = $getSMTPConfig->encryption;
        $this->EditSMTPSendingLimitDaily = $getSMTPConfig->sending_limit;
        $this->EditSMTPUsername = $getSMTPConfig->username;
        $this->EditSMTPPassword = $getSMTPConfig->password;
        $this->SelectedSMTPConfig = $id;
        $this->dispatchBrowserEvent('EditSMTPEditShow');
    }

    public function SaveSMTPConfigEditing()
    {
        $editSMTPConfig = smtp_configs::whereid($this->SelectedSMTPConfig)->first();
        $editSMTPConfig->provider_name = $this->EditSMTPProviderName;
        $editSMTPConfig->mailler = $this->EditSMTPMailler;
        $editSMTPConfig->port = $this->EditSMTPPort;
        $editSMTPConfig->host = $this->EditSMTPHost;
        $editSMTPConfig->encryption = $this->EditSMTPEncryption;
        $editSMTPConfig->sending_limit = $this->EditSMTPSendingLimitDaily;
        $editSMTPConfig->username = $this->EditSMTPUsername;
        $editSMTPConfig->password = $this->EditSMTPPassword;
        $editSMTPConfig->save();
        $this->dispatchBrowserEvent('EditSMTPEditHide');
        $this->emit('alert-success', ['message' => 'SMTP Config edit saved successfully!']);
    }

    public function DeleteSMTPConfigPanel($id)
    {
        $this->SelectedSMTPConfig = $id;
        $this->dispatchBrowserEvent('EditSMTPDeleteConfirmShow');
    }

    public function DeleteASMTPConfig()
    {
        $deleteSMTPConfig = smtp_configs::whereid($this->SelectedSMTPConfig)->first();
        $deleteSMTPConfig->delete();
        $this->dispatchBrowserEvent('EditSMTPDeleteConfirmHide');
        $this->emit('alert-success', ['message' => 'SMTP Config deleted successfully!']); 
    }

    public function CleanCacheFiles()
    {
        \Artisan::call('cache:clear');
        \Artisan::call('config:clear');
        \Artisan::call('config:cache');
        \Artisan::call('route:clear');
        $this->emit('alert-success', ['message' => 'System Clean Successfully']);
    }

    public function SystemBrandingSave()
    {
        try{
            $saveBranding = branding::whereid(1)->first();
            if($this->AppName){
                $saveBranding->name = $this->AppName;
            }
            if($this->AppMainLogo){
                $str = Str::random(10);
                $file = $this->AppMainLogo;
                $filename = $str.'.'.$file->getClientOriginalExtension();
                //$this->image->storeAs('images/', $filename, 'public');
                $this->AppMainLogo->storeAs('branding/', $filename, 'public');
                $saveBranding->main_logo = $filename;
            }
            if($this->AppLogoIcon){
                $str2 = Str::random(10);
                $file2 = $this->AppLogoIcon;
                $filename2 = $str2.'.'.$file2->getClientOriginalExtension();
                //$this->image->storeAs('images/', $filename, 'public');
                $this->AppLogoIcon->storeAs('branding/', $filename2, 'public');
                $saveBranding->logo_icon = $filename2;
            }
            if($this->AppFevicon){
                $str3 = Str::random(10);
                $file3 = $this->AppFevicon;
                $filename3 = $str3.'.'.$file3->getClientOriginalExtension();
                //$this->image->storeAs('images/', $filename, 'public');
                $this->AppFevicon->storeAs('branding/', $filename3, 'public');
                $saveBranding->fevicon = $filename3;
            }
            $saveBranding->save();
            return redirect(url('/').'/admin?pg=settings');
        } catch (\Exception $e) {
            $createLog = new system_logs();
            $createLog->user_id = auth()->user()->id;
            $createLog->error_code = $e->getCode();
            $createLog->error_details = $e->getMessage();
            $createLog->error_from = url()->current();
            $createLog->save();
            $this->emit('alert-error', ['message' => 'Something wrong please wait or check system log!']);
        }
    }

    public function render()
    {
        return view('livewire.system-settings');
    }
}
