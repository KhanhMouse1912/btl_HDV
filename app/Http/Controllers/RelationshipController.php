<?php


namespace App\Http\Controllers;


use App\Address;
use App\KindOfRelationship;
use App\Relationship;
use Guzzle\Http\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;


class RelationshipController extends Controller
{

    public function index()
    {
        // Read File json city
        $jsonString = file_get_contents(base_path('resources/address_json/city.json'));
        $allDataAdressCity = json_decode($jsonString, true);
//        $nameCities = array_column($allDataAdressCity, 'ID');
        $kindOfRelationships = KindOfRelationship::all();
        $relationships = Relationship::simplePaginate(4);
        //get district and wards
        foreach ($relationships as $relationship) {
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
    if(!empty($request->q)) {
        $reminder = [];
        $q = $request->q;
        $reminder = Reminder::where('name', 'like', '%'.$q.'%')->orWhere('phoneNumber', 'like', '%'.$q.'%')->paginate(5);
        return view('user.home.relationship', compact('relationships'));
    }
    
        return view('user.home.relationship', compact('kindOfRelationships'))->with('relationships', $relationships)
            ->with('cities',$allDataAdressCity);
    }

    public function update(Request $request) {
        $allRequest = $request->all();
        $name = $allRequest['name'];
        $note = $allRequest['note'];
        $time_met = $allRequest['time_met'];
        $phoneNumber = $allRequest['phoneNumber'];
        $kindOfRelationShip_id = $allRequest['kindOfRelationShip_id'];
        $kindOfRelationShip = KindOfRelationship::find($kindOfRelationShip_id);
        $relationshipById = Relationship::find($request->id_relationship);
        $relationshipById->name = $name;
        $relationshipById->note = $note;
        $relationshipById->time_met =  date('Y-m-d', strtotime($time_met));
        $relationshipById->phoneNumber = $phoneNumber;
        $relationshipById->kindOfRelation()->associate($kindOfRelationShip);

        $address = Address::create([
            'city' => $allRequest['city'],
            'district' => $allRequest['district'],
            'wards' => $allRequest['ward'],
        ]);
     $address->relationships()->save($relationshipById);
        $relationshipById->save();
        return Redirect::back();
    }


    public function deleteById($id)
    {
        $relationship = Relationship::find($id);
        $relationship->delete();
        return Redirect::back();
    }

    public function store(Request $request)
    {
        $allRequest = $request->all();
       // dd($allRequest);
        $name = $allRequest['name'];
        $note = $allRequest['note'];
        $time_met = $allRequest['time_met'];
        $phoneNumber = $allRequest['phoneNumber'];
        $kindOfRelationShip_id = $allRequest['kindOfRelationShip_id'];
        $kindOfRelationShip = KindOfRelationship::find($kindOfRelationShip_id);
        $address = Address::create([
            'city' => $allRequest['city'],
            'district' => $allRequest['district'],
            'wards' => $allRequest['ward'],
        ]);
        $newRelationship  = $kindOfRelationShip->relationships()->create([
            'name' => $name,
            'note' => $note,
            'time_met' => date('Y-m-d', strtotime($time_met)),
            'phoneNumber' => $phoneNumber,
            'id' => \Auth::user()->id,
            'id_address' => $address->id_address,
        ]);
       $address->relationships()->save($newRelationship);
//        $kindOfRelationships = KindOfRelationship::all();
//        $relationships  = Relationship::all();
        return Redirect::back();
    }
    public function callApiGetDistrictByCity() {
        ini_set('max_execution_time', 180);
        $client = new \Guzzle\Service\Client();
        $path_file = 'district_';
        for($i=1;$i<=64;$i++) {
            $path_api = 'https://thongtindoanhnghiep.co/api/city/'.$i.'/'.'district';
            $inforDistrictByCity = $client->get($path_api)->send();
            file_put_contents(base_path('resources/address_json/district_json/'.$path_file.$i), stripslashes($inforDistrictByCity->getBody()));
        }

        echo 'ok';
    }

    public function getDistrictByCity(Request $request) {
     $id_city = $request->id_city;
     $path_district = 'district_'.$id_city;
     $inforDistrict = file_get_contents(base_path('resources/address_json/district_json/'.$path_district));
     $allDataAdressCity = json_decode($inforDistrict, true);

        return response()->json($allDataAdressCity);
    }
    public function callWardByDistrict() {
        $path_district = 'district_';
        $path_ward = 'ward_';
        ini_set('max_execution_time', 180000);
        $client = new \Guzzle\Service\Client();
        for ($i = 1;$i<=64;$i++) {
            $jsonString = file_get_contents(base_path('resources/address_json/district_json/'.$path_district.$i));
            $allDataDistricts = json_decode($jsonString, true);
            foreach ($allDataDistricts as $dis) {
                $path_api = 'https://thongtindoanhnghiep.co/api/district/'.$dis['ID'].'/'.'ward';
                $inforDistrictByCity = $client->get($path_api)->send();
                file_put_contents(base_path('resources/address_json/ward_json/'.$path_ward.$dis['ID']), stripslashes($inforDistrictByCity->getBody()));

            }

        }
        echo 'ok';

    }

    public function getWardByDistrict(Request $request) {
        $id_ward = $request->id_ward;
        $path_ward = 'ward_'.$id_ward;
        $inforWard = file_get_contents(base_path('resources/address_json/ward_json/'.$path_ward));
        $allDataWardByDistrict = json_decode($inforWard, true);
        return response()->json($allDataWardByDistrict);
    }

    function search( Request $request ) {
        $data = [];
        $search = $request->search;

        if(!empty($request->search)) {
            $data = Relationship::where('name', 'like', '%'.$search.'%')->orWhere('phoneNumber', 'like', '%'.$search.'%')->paginate(5);
        }

        if ( count($data) > 0 ) {
            $data->load('address');
		}

        return view('user.home.notification', compact('relationships'));
    }
}
