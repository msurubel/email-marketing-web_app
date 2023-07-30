<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;

use App\Models\staff_access_permission;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->user_type == "Staff"){
            if(empty(staff_access_permission::whereuser_id(Auth::user()->id)->first())){
                $agent = new Agent();
    
                $createPermission = new staff_access_permission();
                $createPermission->user_id = Auth::user()->id;
                $createPermission->first_ip = request()->getClientIp();
                $createPermission->device_details = 'device_name: '.$agent->device().', platform: '.$agent->platform().', browser: '.$agent->browser();
                $createPermission->save();
            }
        }
        return view('main_app');
    }
}
