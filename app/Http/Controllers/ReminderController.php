<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Reminder;

class ReminderController extends Controller
{
	public function index(Request $request) {
		//dd($request->q);
        if(!empty($request->q)) {
			$reminder = [];
			$q = $request->q;
			$reminder = Reminder::where('name', 'like', '%'.$q.'%')->orWhere('phoneNumber', 'like', '%'.$q.'%')->paginate(5);
			return view('user.home.notification', compact('reminder'));
		}
		
		return view('user.home.notification', ['reminder' => $this->getReminder(), 'reminder_now' => $this->getReminderWithDate()]);
	}

	private function getReminder(){
		return DB::table('reminders')->where('id', \Auth::user()->id)->get();
	}

	private function getReminderWithDate(){
		return DB::table('reminders')->where(['time' => date('Y-m-d'), 'id' => \Auth::user()->id])->get();
	}
    public function create(Request $request){
    	DB::table('reminders')->insert([
    		"id"=>\Auth::user()->id,
    		"kindOfRelationship"=>$request->input('kindofrelationship'),
    		"name"=>$request->input('name'),
    		"phoneNumber"=>$request->input('phone_number'),
    		"time"=>$request->input('time'),
    		"place"=>$request->input('place'),
    		"reason"=>$request->input('reason'),
    	]);
    	return redirect('/user/home');
    }
    public function delete(Request $request)
    {
    	DB::table('reminders')->where(['id_reminders' => $request->id])->delete();
	}
}
