<?php

namespace App\Http\Livewire;
use Livewire\WithFileUploads;
use Livewire\Component;
use Config;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\BulkMail;

use App\Models\subscribers;
use App\Models\smtp_configs;
use App\Models\mailler_jobs;
use App\Models\subscribe_groups;
use App\Models\system_logs;
use App\Models\User;

class BulkMailSender extends Component
{
    use WithFileUploads;

    public $SelectingGroupInput;
    public $SelectingSMTPConfigInput;
    public $SendingFromName; 
    public $SendingFromEmail;
    public $SendingReplyToName;
    public $SendingReplyToEmail;
    public $SendingSubjectline;
    public $SendingAttachmentFiles;
    public $SendingMailBodyText;

    public $CurrentAttachment;

    public $MailBodyText;
    public $SendingSignLogo;
    public $CurrentLogoSend;

    public $SearchGroupSMTPByUser;
    public $SearchingFoundedID;

    public function mount()
    {
        
    }

    public function TestFunction()
    {
        $this->dispatchBrowserEvent('MailSendingDoneModelShow');
    }

    public function RunMailSending()
    {
        try {
            $createJob = new mailler_jobs();
            $createJob->user_id = auth()->user()->id;
            $createJob->ref_id = Str::random(10);
            $createJob->group_name = subscribe_groups::whereid($this->SelectingGroupInput)->first()->name;
            $createJob->smtp_config = $this->SelectingSMTPConfigInput;
            $createJob->job_total = subscribers::wheregroup_id($this->SelectingGroupInput)->count();
            $createJob->can_send = 0;
            $createJob->status = "Processing";
            $createJob->save();
            \Session::flash('JobID', $createJob->id); 
            $this->SendBulkMail();
        }catch (\Exception $e) {
            $createLog = new system_logs();
            $createLog->user_id = auth()->user()->id;
            $createLog->error_code = $e->getCode();
            $createLog->error_details = $e->getMessage();
            $createLog->error_from = url()->full();
            $createLog->save();
            $this->emit('alert-error', ['message' => 'Something wrong please wait!']);
        }
    }

    public function SendBulkMail()
    {
        try {
            $getAllSubscribers = subscribers::wheregroup_id($this->SelectingGroupInput)->get();

            //Config SMTP
            $getSMTPConfig = smtp_configs::whereid($this->SelectingSMTPConfigInput)->first();
            $mailConfig = array(
                'driver'     =>     $getSMTPConfig->mailler,
                'host'       =>     $getSMTPConfig->host,
                'port'       =>     $getSMTPConfig->port,
                'username'   =>     $getSMTPConfig->username,
                'password'   =>     $getSMTPConfig->password,
                'encryption' =>     $getSMTPConfig->encryption,
                'from'       =>     array('address' => $this->SendingFromEmail, 'name' => $this->SendingFromName),
                'sendmail'   =>     '/usr/sbin/sendmail -bs',
                'pretend' => false,
            );
            Config::set('mail', $mailConfig);
            //app('config')->set('mail', $mailConfig);

            //Put Attachment to Server
            if($this->SendingAttachmentFiles){
                $str = Str::random(10);
                $file = $this->SendingAttachmentFiles;
            }else{
                $file = "";
            }
            //$filename = $str.'.'.$file->getClientOriginalExtension();
            //$this->SendingAttachmentFiles->storeAs('mail_attachments/', $filename, 'public');
            //$this->CurrentAttachment = $filename;

            $TotalCanSend = 0;
            foreach ($getAllSubscribers as $lists){
                $getSubscriberData = subscribers::whereid($lists->id)->first();

                $subjectLine = "$this->SendingSubjectline";
                $replaceSubjectLine = str_replace(['{sbscrb_name}', '{sbscrb_email}', '{sbscrb_phone}', '{sbscrb_company_name}', '{sbscrb_company_number}', '{{SIGNLOGO}}', '{{HOSTING}}', '{sbscrb_manager_name}'], [''.$getSubscriberData->first_name.' '.$getSubscriberData->last_name, $getSubscriberData->email, $getSubscriberData->phone, $getSubscriberData->name_of_company, $getSubscriberData->company_number, $this->CurrentLogoSend, url('/'), $getSubscriberData->manager_name], $subjectLine);
                
                $BodyMassageGet = "$this->SendingMailBodyText";
                $FinalBodyMassage = str_replace(['{sbscrb_name}', '{sbscrb_email}', '{sbscrb_phone}', '{sbscrb_company_name}', '{sbscrb_company_number}', '{{SIGNLOGO}}', '{{HOSTING}}', '{sbscrb_manager_name}'], [''.$getSubscriberData->first_name.' '.$getSubscriberData->last_name, $getSubscriberData->email, $getSubscriberData->phone, $getSubscriberData->name_of_company, $getSubscriberData->company_number, $this->CurrentLogoSend, url('/'), $getSubscriberData->manager_name], $BodyMassageGet);

                $details = [
                    'CompanyName' => $this->SendingFromName,
                    'ReplyToName' => $this->SendingReplyToName,
                    'ReplyToMail' => $this->SendingReplyToEmail,
                    'subject' => $replaceSubjectLine,
                    'attachmentFile' => $file,
                    'MailBody' => $FinalBodyMassage,
                    'name' => "App",
                ];
                $sending = Mail::to("$getSubscriberData->email")->send(new BulkMail($details));
                if($sending){
                    $TotalCanSend += 1; 

                    $uptCanSend = mailler_jobs::whereid(\Session::get('JobID'))->first();
                    $uptCanSend->can_send = $TotalCanSend;
                    if($uptCanSend->company_name == "No"){
                        $uptCanSend->company_name = $this->SendingFromName;
                        $uptCanSend->sending_from_mail = $this->SendingFromEmail;
                        $uptCanSend->reply_to_name = $this->SendingReplyToName;
                        $uptCanSend->reply_to_mail = $this->SendingReplyToEmail;
                        $uptCanSend->mail_content = $this->SendingMailBodyText;
                    }
                    $uptCanSend->status = "Processing";
                    $uptCanSend->save();
                }
            }
            $uptFinalCanSend = mailler_jobs::whereid(\Session::get('JobID'))->first();
            $uptFinalCanSend->can_send = $TotalCanSend; 
            $uptFinalCanSend->status = "Delivered";
            $uptFinalCanSend->save();
            $this->dispatchBrowserEvent('MailSendingDoneModelShow');
        } catch (\Exception $e) {
            $createLog = new system_logs();
            $createLog->user_id = auth()->user()->id;
            $createLog->error_code = $e->getCode();
            $createLog->error_details = $e->getMessage();
            $createLog->error_from = url()->full();
            $createLog->save();

            if(\Session::has('JobID')){
                $uptCanSend = mailler_jobs::whereid(\Session::get('JobID'))->first();
                $uptCanSend->can_send = $TotalCanSend;
                $uptCanSend->status = "Failed";
                $uptCanSend->save();
            }
            $this->emit('alert-error', ['message' => 'Something wrong please wait!']);
        }
    }

    public function TestingFunciton()
    {
        $BodyMassage = "$this->SendingMailBodyText";
        $result = str_replace(['{sbscrb_name}', '{sbscrb_email}'], ['Lourent', 'msurubel1@gmail.com'], $BodyMassage);
        dd($result);
    }

    public function updated ()
    {
        if($this->SendingSignLogo){
            $str = Str::random(10);
            $file = $this->SendingSignLogo;
            $filename = $str.'.'.$file->getClientOriginalExtension();
            //$this->image->storeAs('images/', $filename, 'public');
            $this->SendingSignLogo->storeAs('branding/', $filename, 'public');
            $this->CurrentLogoSend = $filename;
        }

        if(empty($this->SearchGroupSMTPByUser)){

        }else{
            if(User::where('email', 'like', '%'.$this->SearchGroupSMTPByUser.'%')->orwhere('name', 'like', '%'.$this->SearchGroupSMTPByUser.'%')->first()){
                $getUserData = User::where('email', 'like', '%'.$this->SearchGroupSMTPByUser.'%')->orwhere('name', 'like', '%'.$this->SearchGroupSMTPByUser.'%')->first();
                $this->SearchingFoundedID = $getUserData->id;
            }
        }
    }

    public function render()
    {
        return view('livewire.bulk-mail-sender');
    }
}
