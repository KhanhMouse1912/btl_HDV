<?php


namespace App\Http\Controllers;


use App\Exceptions\KindOfRelationshipException;
use App\KindOfRelationship;
use Illuminate\Http\Request;


class KindOfRelationShipController extends Controller
{

    public function store(Request $request) {
        KindOfRelationship::create([
            'nameOfRelationship' =>  $request->nameOfRelationship,
        ]);
        return redirect()->back();
    }

}
