<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\RoomType;
use Illuminate\Http\Request;

class RoomTypeController extends Controller
{
   public function ListRoomType(){
    //trie du plus grand au plus peti
    $allData=RoomType::orderBy('id', 'desc')->get();

    return view('backend.allroom.roomtype.view_roomtype', compact('allData'));
   }

    

}
