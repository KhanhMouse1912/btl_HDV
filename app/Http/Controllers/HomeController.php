<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\KindOfRelationship;
use App\Relationship;

class HomeController extends Controller
{
    public function index() {
        // Read File json city
        $jsonString = file_get_contents(base_path('resources/address_json/city.json'));
        $allDataAdressCity = json_decode($jsonString, true);
//        $nameCities = array_column($allDataAdressCity, 'ID');
        $kindOfRelationships = KindOfRelationship::all();
        $relationships = Relationship::simplePaginate(4);
        //get district and wards
        foreach ($relationships as $relationship) {
           // dd($relationship);
        foreach ($allDataAdressCity['LtsItem'] as $city1) {
            $path_district = 'district_'.$relationship->addresses['city'];
            $allDistrictJson = file_get_contents(base_path('resources/address_json/district_json/'.$path_district));
            $allDistrict = json_decode($allDistrictJson, true);

            if ($city1['ID'] == $relationship->addresses['city']) {
                $relationship->addresses['city_name'] = $city1['Title'];

            foreach ($allDistrict as $distirict1) {
             if($distirict1['ID'] ==  $relationship->addresses['district']) {
                 $relationship->addresses['district_name'] = $distirict1['Title'];
             }
                $path_ward = 'ward_'.$relationship->addresses['district'];
                $allWardsJson = file_get_contents(base_path('resources/address_json/ward_json/'.$path_ward));
                $allWard = json_decode($allWardsJson, true);
                foreach ($allWard as $ward1) {
                    if($ward1['ID'] ==  $relationship->addresses['wards']) {
                        $relationship->addresses['ward_name'] = $ward1['Title'];
                    }
                }
         }
         }

    }

    }

        $reminder =  $this->getReminder();
        $reminder_now = $this->getReminderWithDate();
        $cities = $allDataAdressCity;
    	return view('user.home.reminder', compact('reminder', 'reminder_now', 'kindOfRelationships', 'relationships', 'cities'));
    }

    private function getReminder(){
    	return DB::table('reminders')->where('id', \Auth::user()->id)->get();
    }

    private function getReminderWithDate(){
    	return DB::table('reminders')->where(['time' => date('Y-m-d'), 'id' => \Auth::user()->id])->get();
    }
}
