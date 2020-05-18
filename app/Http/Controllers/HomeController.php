<?php

namespace App\Http\Controllers;

use App\House;
use App\Location;
use App\User;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Foreach_;

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
        $house_product = House::get();
        $Location = Location::get();
        $User = User::get();
        return view('home',compact('house_product','Location','User'));
    }

    public function simple(Request $req)
    {
        if($req->has('Name')){
            $house_product = House::orderBy('house_name',$req->Name)->paginate(9)->appends('Name',$req->Name);

        }
        else if($req->has('Id')){
            $house_product = House::orderBy('id',$req->Id)->paginate(9)->appends('Id',$req->Id);

        }else{
            $house_product = House::paginate(9);

        }
        if($req->has('NameOfLocation')){
            $Location = Location::orderBy('location_name',$req->NameOfLocation)->paginate(4)->appends('NameOfLocation',$req->NameOfLocation);

        }
        else if($req->has('IdOfLocation')){
            $Location = Location::orderBy('id',$req->IdOfLocation)->paginate(4)->appends('IdOfLocation',$req->IdOfLocation);

        }else{
            $Location = Location::paginate(4);

        }
        if($req->has('NameOfUser')){
            $User = User::orderBy('name',$req->NameOfUser)->paginate(4)->appends('Name',$req->NameOfUser);
        }else if($req->has('IdOfUser')){
            $User = User::orderBy('id',$req->IdOfUser)->paginate(4)->appends('IdOfUser',$req->IdOfUser);
        }else{
            $User = User::paginate(4);
        }
        $array = array();
        foreach($house_product as $product){
            $loName = Location::where('id',$product->id_Location)->first();
            $object = (object)[
                "id"            =>  $product->id,
                "house_name"    =>  $product->house_name,
                "house_type"    =>  $product->house_type,
                "house_details" =>  $product->house_details,
                "house_address" =>  $product->house_address,
                "location_name" =>  $loName->location_name,
                "create_at"     =>  $product->created_at,
                "update_at"     =>  $product->updated_at
            ];
            array_push($array,$object);
        }
        return view('simple',compact('house_product','Location','User','array'));
    }
    public function destroy(Request $req){
        House::destroy($req->id_house);
        return redirect('simple');
    }
    //layout edit house
    public function HouseEdit(Request $req){
        $house = House::find($req->id_house);
        $location = Location::get();
        return view('update_house',compact('location','house'));
    }
    public function EditHouse(Request $req){
        $this->validate($req,[
            "house_name"=>"required",
            "house_type"=>"required",
            "house_details"=>"required",
            "house_address"=>"required",
        ]);
        $Location = Location::where('location_name',$req->location_name)->first();
        $house = House::find($req->id_house);
        $house->house_name = $req->house_name;
        $house->house_type = $req->house_type;
        $house->house_details = $req->house_details;
        $house->house_address = $req->house_address;
        $house->id_Location = $Location->id;
        $house->save();
        return redirect()->back()->with('reportUpdate', 'Update '.$house->house_name.'Successfull');
    }
    //add more table House layout
    public function HouseAdd(){
        $location = Location::get();
        return view('add_house',compact('location'));
    }

    // add to table House
    public function addHouse(Request $req){
        $this->validate($req,[
            "house_name"=>"required",
            "house_type"=>"required",
            "house_details"=>"required",
            "house_address"=>"required",
        ]);
        $house = new House();
        $Location = Location::where('location_name',$req->location_name)->first();
        $house->house_name = $req->house_name;
        $house->house_type = $req->house_type;
        $house->house_details = $req->house_details;
        $house->house_address = $req->house_address;
        $house->id_Location = $Location->id;
        $house->save();
        return redirect()->back()->with('reportUpdate', 'Add '.$house->house_name.'Successfull');
    }
}
