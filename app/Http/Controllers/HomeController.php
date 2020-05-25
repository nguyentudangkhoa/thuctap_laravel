<?php

namespace App\Http\Controllers;

use App\House;
use App\Location;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Foreach_;
use Illuminate\Support\Facades\File;

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

        }
        else if($req->has('Created_at')){
            $house_product = House::orderBy('created_at',$req->Created_at)->paginate(9)->appends('Created_at',$req->Created_at);

        }else if($req->has('Updated_at')){
            $house_product = House::orderBy('updated_at',$req->Updated_at)->paginate(9)->appends('Updated_at',$req->UpDated_at);

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
        }else if($req->has('Created_user_at')){
            $User = User::orderBy('created_at',$req->Created_user_at)->paginate(4)->appends('Created_user_at',$req->Created_user_at);
        }else if($req->has('Updated_user_at')){
            $User = User::orderBy('updated_at',$req->Updated_user_at)->paginate(4)->appends('Updated_user_at',$req->Updated_user_at);
        }else if($req->has('Login_user_at')){
            $User = User::orderBy('login_at',$req->Login_user_at)->paginate(4)->appends('Login_user_at',$req->Login_user_at);
        }else if($req->has('Logout_user_at')){
            $User = User::orderBy('logout_at',$req->Logout_user_at)->paginate(4)->appends('Logout_user_at',$req->Logout_user_at);
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
                "house_image"   =>  $product->house_image,
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
        return redirect()->back()->with('Delete-House','Delete house successfully');
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
            "house_address"=>"required|max:50",
            "image"=>"required"
        ]);
        $image = $req->file('image');
        $Location = Location::where('location_name',$req->location_name)->first();
        $house = House::find($req->id_house);
        $image_path = "images/" . $image->getClientOriginalName('myFile');
        $house->house_name = $req->house_name;
        $house->house_type = $req->house_type;
        $house->house_details = $req->house_details;
        $house->house_address = $req->house_address;
        $house->id_Location = $Location->id;
        if ($image->getClientOriginalName('myFile') != "") {
            if ($req->hasFile('image')) {
                if (File::exists($image_path)) { //Check existing image
                    File::delete($image_path); //delete image in a file
                }
                $house->house_image = $image->getClientOriginalName('myFile'); //Image
                $image->move('images', $image->getClientOriginalName('myFile')); //save images at resource/image
            }
            $house->save();
            return redirect()->back()->with('reportUpdate', 'Update '.$house->house_name.'Successfull');
        }
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
            "house_address"=>"required|max:50",
            "image"=>"required"
        ]);
        $image = $req->file('image');
        $house = new House();
        $Location = Location::where('location_name',$req->location_name)->first();
        $house->house_name = $req->house_name;
        $house->house_type = $req->house_type;
        $house->house_details = $req->house_details;
        $house->house_address = $req->house_address;
        $house->id_Location = $Location->id;
        if ($req->hasFile('image')) {
            $image->move('images', $image->getClientOriginalName('myFile')); //save images at resource/image
        }
        $house->house_image = $image->getClientOriginalName('myFile'); //Image
        $house->save();
        return redirect()->back()->with('reportUpdate', 'Add '.$house->house_name.'Successfull');
    }

    //delete Location
    public function destroyLocation(Request $req){
        $house = House::where('id_Location',$req->id_location)->get();
        foreach($house as $data){
            $data->delete();
        }
        Location::destroy($req->id_location);
        return redirect()->back()->with('report-Delete-Location','Delete Location susscessfull');
    }
    public function updateLocation(Request $req){
        $location = Location::find($req->id_location);
        return view('update-location',compact('location'));
    }
    public function LocationUpdate(Request $req){
        $location = Location::where('location_name',$req->location_name)->first();
        $this->validate($req,[
            "location_name"=>"required",
            "parent_id"=>"required"
        ]);
        if(!$location){
            Location::where('id',$req->id_location)->update(['location_name'=>$req->location_name,'parent_id'=>$req->parent_id]);
            return redirect()->back()->with('Update-Location','Update Location susscessfull');
        }else{
            return redirect()->back()->with('Fail-Update-Location','Fail to update location because the location you enter is exixt');
        }

    }
    //Location add layout
    public function LocationAdd(){
        return view('add-location');
    }
    public function AddLocation(Request $req){
        $location = Location::where('location_name',$req->location_name)->first();
        $this->validate($req,[
            "location_name"=>"required",
            "parent_id"=>"required"
        ]);
        if(!$location){
            Location::create(['location_name'=>$req->location_name,'parent_id'=>$req->parent_id]);
            return redirect()->back()->with('Add-Location','Add Location susscessfull');
        }else{
            return redirect()->back()->with('Fail-Add-Location','Fails to add location because location have exist');
        }

    }
    //delete user
    public function DestroyUser(Request $req){
        // $user = User::where('name',Auth::user()->name)->first();
        // if(!$user){
            User::destroy($req->user_id);
            return redirect()->back()->with('Delete-User','Delete user successfull');
        // }else{
        //     return redirect()->back()->with('Fail-Delete-User','user is loged in');
        // }

    }
    //update user layout
    public function UserUpdate(Request $req){
        $user = User::find($req->user_id);
        return view('update-user',compact('user'));
    }
    //update user
    public function UpdateUser(Request $req){
        $this->validate($req,[
            'name'=>'required',
            'email'=>'required'
        ]);
        $user = User::where('email',$req->email)->first();
        if(!$user){
            User::where('id',$req->user_id)->update(['name'=>$req->name,'email'=>$req->email]);
            return redirect()->back()->with('Update-User','Update user successfull');
        }else{
            return redirect()->back()->with('Fail-Update-User','User email is exist');
        }
    }
}
