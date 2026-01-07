<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Intervention\Image\Drivers\Gd\Driver;
use App\Models\{Facility, MultiImage, Room,RoomType, RoomNumber};

class RoomController extends Controller
{
    public function EditRoom($id){
        $basic_facility=Facility::where('rooms_id',$id)->get();
        $multiimgs = MultiImage::where('rooms_id',$id)->get();
        $editData=Room::find($id);
        return view('backend.allroom.rooms.edit_rooms', compact('editData','basic_facility','multiimgs'));
    }

    //le code qui permet de faire la modification et ajout dans la base des chambres
    
    // public function UpdateRoom(Request $request, $id){

    //     $room=Room::find($id);

    //     $room->roomtype_id= $room->roomtype_id;

    //     $room->total_adult=$request->total_adult;
    //     $room->total_child=$request->total_child;

    //     $room->room_capacity=$request->room_capacity;
    //     $room->price=$request->price;

    //     $room->size=$request->size;
        
    //     $room->view=$request->view;
    //     $room->bed_style=$request->bed_style;

    //     $room->discount=$request->discount;
    //     $room->short_desc=$request->short_desc;
    //     $room->description=$request->description;
    //    /* Update l'imagess */

    //     if($request->hasFile('image')){
    //         $image = $request->file('image');
    //         $name_gn = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
    //         Image::make($image)->resize(550, 870)->save('upload/roomimg/' . $name_gn);
    //         $room['image']=$name_gn;
    //     }
    //     $room->save();

    //     /* Updatee facility dans la base  */

    //     if($request->facility_name == NULL){

    //         $notification = array(
    //             'message' => 'Sorry! Not Any Basic Facility Select',
    //             'alert-type' => 'error'
    //         );
    
    //         return redirect()->back()->with($notification);

    //     } else{
    //         Facility::where('rooms_id',$id)->delete();
    //         $facilities = Count($request->facility_name);
    //         for($i=0; $i < $facilities; $i++ ){
    //             $fcount = new Facility();
    //             $fcount->rooms_id = $room->id;
    //             $fcount->facility_name = $request->facility_name[$i];
    //             $fcount->save();
    //         } // end for
    //     } // end else 

        

    //     if($room->save()){
    //         $files = $request->multi_img;
    //         if(!empty($files)){
    //             $subimage = MultiImage::where('rooms_id',$id)->get()->toArray();
    //             MultiImage::where('rooms_id',$id)->delete();
 
    //         }
    //         if(!empty($files)){
    //             foreach($files as $file){
    //                 $imgName = date('YmdHi').$file->getClientOriginalName();
    //                 $file->move('upload/roomimg/multi_img/',$imgName);
    //                 $subimage['multi_img'] = $imgName;

    //                 $subimage = new MultiImage();
    //                 $subimage->rooms_id = $room->id;
    //                 $subimage->multi_img = $imgName;
    //                 $subimage->save();
    //             }

    //         }
    //     } // end if

    //     $notification = array(
    //         'message' => 'Room Updated Successfully',
    //         'alert-type' => 'success'
    //     );

    //     return redirect()->back()->with($notification); 

    // }//end methode

//     public function UpdateRoom(Request $request, $id)
// {
//     $room = Room::findOrFail($id);

//     $room->roomtype_id = $request->roomtype_id;
//     $room->total_adult = $request->total_adult;
//     $room->total_child = $request->total_child;
//     $room->room_capacity = $request->room_capacity;
//     $room->price = $request->price;
//     $room->size = $request->size;
//     $room->view = $request->view;
//     $room->bed_style = $request->bed_style;
//     $room->discount = $request->discount;
//     $room->short_desc = $request->short_desc;
//     $room->description = $request->description;

//     if($request->hasFile('image')){
//         $image = $request->file('image');
//         $name_gn = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
//         Image::make($image)->resize(550,870)->save('upload/roomimg/'.$name_gn);
//         $room->image = $name_gn;
//     }

//     $room->save();

//     if(!$request->has('facility_name')){
//         return redirect()->back()->with([
//             'message' => 'Sorry! Not Any Basic Facility Select',
//             'alert-type' => 'error'
//         ]);
//     }

//     Facility::where('rooms_id',$id)->delete();
//     foreach($request->facility_name as $facility){
//         Facility::create([
//             'rooms_id' => $room->id,
//             'facility_name' => $facility
//         ]);
//     }

//     if($request->hasFile('multi_img')){
//         MultiImage::where('rooms_id',$id)->delete();
//         foreach($request->file('multi_img') as $file){
//             $imgName = date('YmdHi').$file->getClientOriginalName();
//             $file->move('upload/roomimg/multi_img/',$imgName);

//             MultiImage::create([
//                 'rooms_id' => $room->id,
//                 'multi_img' => $imgName
//             ]);
//         }
//     }

//     return redirect()->back()->with([
//         'message' => 'Room Updated Successfully',
//         'alert-type' => 'success'
//     ]);
// }


    public function  UpdateRoom(Request $request, $id){
        $room = Room::findOrFail($id);

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
           $room->image = $name_gn;
        }
        $room->save();

        /* Updatee facility dans la base  */

        if (empty($request->facility_name)) {
            return redirect()->back()->with([
                'message' => 'Désolé, veuillez sélectionner au moins un service',
                'alert-type' => 'error'
            ]);
        }else {
            //Supprimer les anciens services
            Facility::where('rooms_id', $id)->delete();
            // Enregistrer les nouveaux
                foreach ($request->facility_name as $facility) {
                    Facility::create([
                        'rooms_id' => $room->id,
                        'facility_name' => $facility
                    ]);
                }
            }       

        /* Pour len  multiple d'images avec le champs */
        // si on l'enregistre
        if ($room->save()) {
             if ($request->hasFile('multi_img')) {

        // Supprimer les anciennes images
        MultiImage::where('rooms_id', $room->id)->delete();

        // Parcourir toutes les images envoyées
        foreach ($request->file('multi_img') as $file) {

            $imgName = date('Y-m-d-H-i') . '_' . $file->getClientOriginalName();

            $file->move(public_path('upload/roomimg/multi_img'), $imgName);

            $subimage = new MultiImage();
            $subimage->rooms_id = $room->id;
            $subimage->multi_img = $imgName;
            $subimage->save();
        }
    }

        } //end if

        $notifications=array(
                'message'=>'Modification Effectuer avec success',
                'alert-type'=>'success'
            );
        return redirect()->back()->with($notifications);  
    }

    public function MultiImageDelete($id){
        // suppressions des images mutil
        $deletedata=MultiImage::where('id',$id)->first();
        if ($deletedata) {
            $imagePath = public_path('upload/roomimg/multi_img/' . $deletedata->multi_img);
            if(file_exists($imagePath)) {
                unlink($imagePath);
            }
            $deletedata->delete();
        }   
        return redirect()->back()->with([
            'message' => 'Multi Image Deleted Successfully',
            'alert-type' => 'success'
        ]);
       
    }

    public function DeleteRoom($id){
     //le typeu_avecu_imagesu_roomsu_facilityu_mutiimag
        $room=Room::find($id);

        // if(file_exists('upload/rooming/'.$room->image) AND !empty($room->image)){

        //     unlink('upload/rooming/'.$room->image);
        // }

        // $subImage=MultiImage::where('rooms_id',$room->id)->get()->toArray();

        // if(!empty( $subImage)){
        //     foreach ($subImage as $value) {
        //         if(!empty($value)){
        //             unlink('upload/rooming/multi_img/'.$value['multi_img']);
        //         }
        //     }
        // }
        //Supprimer l'image principale de la room 
        $room=Room::find($id);
        if(!empty($room->image)){
            $imagePrincipalpath=public_path('upload/rooming/'.$room->image);
            if(file_exists($imagePrincipalpath)){
                unlink($imagePrincipalpath);
            }
        }
        //supprimer les images avec plusieurs enregistrement dans la bases
        $subImage=MultiImage::where('rooms_id',$room->id)->get();

        foreach ($subImage as $value) {
           $path=public_path('upload/rooming/multi_img/'.$value->multi_img);
            if(file_exists($path)){
                unlink($path);
            }
            $value->delete();
        }

        RoomType::where('id', $room->roomtype_id)->delete();
        MultiImage::where('rooms_id', $room->id)->delete();
        Facility::where('rooms_id', $room->id)->delete();
        RoomNumber::where('rooms_id', $room->id)->delete();
        $room->delete();

         $notification = array(
            'message' => 'Room Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);  

    }
}


