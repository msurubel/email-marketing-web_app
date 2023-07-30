<?php

namespace App\Imports;

use Session;
use App\Models\subscribers;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Auth;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        try{
            Session::flash('ImportingSubscriber', 'Processing');
            $TotalSubscribe = 0;
            foreach ($row as $job){
                if(empty($row['email'])){
                    
                }else{
                    if(subscribers::whereuser_id(Auth::user()->id)->whereemail($row['email'])->first()){

                    }else{
        
                        $addSubscriber = new subscribers();
                        $addSubscriber->user_id = Auth::user()->id;
                        $addSubscriber->group_id = Session::get('GroupType');
        
                        if(empty($row['first_name'])){
                            $addSubscriber->first_name = "NA";
                        }else{
                            $addSubscriber->first_name = $row['first_name'];
                        }
        
                        if(empty($row['last_name'])){
                            $addSubscriber->last_name = "NA";
                        }else{
                            $addSubscriber->last_name = $row['last_name'];
                        }
                        
                        $addSubscriber->email = $row['email'];
        
                        if(empty($row['phone'])){
                            $addSubscriber->phone = 0;
                        }else{
                            $addSubscriber->phone = $row['phone'];
                        }
        
                        if(empty($row['address'])){
                            $addSubscriber->address = "No Address";
                        }else{
                            $addSubscriber->address = $row['address'];
                        }
        
                        if(empty($row['company_name'])){
                            $addSubscriber->name_of_company = "NA";
                        }else{
                            $addSubscriber->name_of_company = $row['company_name'];
                        }
        
                        if(empty($row['company_number'])){
                            $addSubscriber->company_number = 0;
                        }else{
                            $addSubscriber->company_number = $row['company_number'];
                        }
        
                        if(empty($row['manager_name'])){
                            $addSubscriber->manager_name = "NA";
                        }else{
                            $addSubscriber->manager_name = $row['manager_name'];
                        }
        
                        if(empty($row['others_note'])){
                            $addSubscriber->other_details = "NA";
                        }else{
                            $addSubscriber->other_details = $row['others_note'];
                        }
        
                        $addSubscriber->status = "Active";
                        $addSubscriber->save();
                        $TotalSubscribe += 1;
                    }
                }
            }
            Session::flash('ImportingSubscriber', 'Done');
        } catch (\Exception $e) {
            $createLog = new \App\Models\system_logs();
            $createLog->error_code = $e->getCode();
            $createLog->error_details = $e->getMessage();
            $createLog->error_from = url()->current();
            $createLog->save();
            $this->emit('alert-error', ['message' => 'Something wrong please wait!']);
        }
    }
}
