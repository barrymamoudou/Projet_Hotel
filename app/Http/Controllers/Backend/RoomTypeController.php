<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\RoomType;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RoomTypeController extends Controller
{
   public function ListRoomType(){
    //trie du plus grand au plus peti
    $allData=RoomType::orderBy('id', 'desc')->get();
      return view('backend.allroom.roomtype.view_roomtype', compact('allData'));
   }

   public function AddRoomType(){

      return view('backend.allroom.roomtype.add_roomtype');
   }
   public function StoreRoomType(Request $request){

      $roomtype_id=RoomType::insertGetId([
         'name'=>$request->name,
         'created_at'=>Carbon::now(),
      ]);

      // lenregistreement se fait avec le type de chambre choisit 
      $rooms=Room::insert([
         'roomtype_id'=>$roomtype_id,
      ]);
      
      return redirect()->route('room.type.list')->with('success', 'RoomType ajouté avec succès');
   }

    

}
