<?php

namespace App\Http\Livewire;

use Livewire\Component;

class MailerJobReport extends Component
{
    public $MailSendingInfoID;

    public function ViewMailSendingInfoModel($id)
    {
        $this->MailSendingInfoID = $id;
        $this->dispatchBrowserEvent('sendingMailContentModelShow');
    }

    public function render()
    {
        return view('livewire.mailer-job-report');
    }
}
