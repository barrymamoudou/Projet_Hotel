<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Facility;
use App\Models\MultiImage;
use Intervention\Image\Facades\Image;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function EditRoom($id){
        $basic_facility=Facility::where('rooms_id',$id);
        $editData=Room::find($id);
        return view('backend.allroom.rooms.edit_rooms', compact('editData','basic_facility'));
    }

    //le code qui permet de faire la modification et ajout dans la base des chambres
    
    public function  UpdateRoom(Request $request, $id){

        $room=Room::find($id);

        $room->roomtype_id= $room->roomtype_id;

        $room->total_adult=$request->total_adult;
        $room->total_child=$request->total_child;

        $room->room_capacity=$request->room_capacity;
        $room->price=$request->price;

        $room->size=$request->size;
        $room->view=$request->view;
        $room->bed_style=$request->bed_style;

        $room->discount=$request->discount;
        $room->short_desc=$request->short_desc;
        $room->description=$request->description;
       /* Update l'imagess */

        if($request->hasFile('image')){
            $image = $request->file('image');
            $name_gn = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(550, 870)->save('upload/roomimg/' . $name_gn);
            $room['image']=$name_gn;
        }
        $room->save();

        /* Updatee facility dans la base  */

        if (!empty($request->facility_name)) {
            // si il est null on afficher le message au contraire on tombe dans le else et si deja il est associe on supprimer et on verifie combien il a mit dans le tableau 
            //puis on fait le count et on parcour chaque element pour enregistre
            $notifications=array(
                'message'=>'Desole les service doit pas etre vide!! veillez selectionne svp...',
                'alert-type'=>'error'
            );
            return redirect()->back()->with($notifications);    
        }else{
            /* si il est deja associe a une chambre on le supprime avant d'enregistre */
            Facility::where('rooms_id', $id)->delete();
            $facilities=Count($request->facility_name);
            for ($i=0; $i < $facilities ; $i++) { 
                $fcount=new Facility();
                $fcount->rooms_id=$room->id;
                $fcount->facility_name=$request->facility_name[$i];
                $fcount->save();
            } // end for

        } //end else

        /* Pour len  multiple d'images avec le champs */
        // si on l'enregistre
        if ($room->save()) {
            $files=$request->multi_img;
            if (!empty($files)) {
               $subImage=MultiImage::where('rooms_id',$id)->get()->toArraye();
               MultiImage::where('rooms_id',$id)->delete();
            }
            if (!empty($files)) { 
                //parcour les images dans le formulaire vu que cest un tableau 
                foreach ($files as $key => $file) {
                    $imgName=date('YmdHi').$file->getClientOriginalName();
                    $file->move('upload/roomimg/multi_img/' . $imgName);
                    $subImage['multi_img']= $imgName;

                    $subImage=new MultiImage();
                    $subImage->room_id=$room->id;
                    $subImage->multi_img=$subImage;
                    $subImage->save();
                } // end for 
              
            } // second if

        } //end if

        $notifications=array(
                'message'=>'Modification Effectuer avec success',
                'alert-type'=>'success'
            );
        return redirect()->back()->with($notifications);   

    }//end methode
}


