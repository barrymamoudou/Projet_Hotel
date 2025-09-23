<?php

namespace App\Http\Controllers;

use App\Models\BookArea;
use App\Models\Team;
use Intervention\Image\Facades\Image;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function AllTeam()
    {
        $teams = Team::latest()->get();
        return view('backend.teams.all_team', compact('teams'));
    }

    public function AddTeam()
    {

        return view('backend.teams.add_team');
    }

    public function AddStore(Request $request)
    {
        //L'image dans  a a plusieurs

        $image = $request->file('image');
        $name_gn = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(550, 670)->save('upload/team/' . $name_gn);

        $save_url = 'upload/team/' . $name_gn;

        Team::create([
            'name' => $request->name,
            'position' => $request->position,
            'facebook' => $request->facebook,
            'image' => $save_url,
        ]);

        return redirect()->route('all.team')->with('success', 'Membre ajouté avec succès');
    }

    public function EditTeam($id)
    {
        $team = Team::find($id); 
        
        return view('backend.teams.edit_team', compact('team'));
    }

    public function UpdateTeam(Request $request, $id){

        $team=Team::findOrFail($id);

        $data=[

            'name' => $request->name,
            'position' => $request->position,
            'facebook' => $request->facebook,
        ];

        if($request->hasFile('image')){
            $image = $request->file('image');
            $name_gn = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(550, 670)->save('upload/team/' . $name_gn);
            $save_url = 'upload/team/' . $name_gn;

            // if($team->image){
                
            //     @unlink(public_path($team->image));
            // }
            $data['image']=$save_url;

        }

      
        $team->update($data);
            $notification = array(
                'message' => 'Team Updated Without Image Successfully',
                'alert-type' => 'success'
            );
        return redirect()->route('all.team')->with($notification);
    }
    public function deleteTeam($id){
        $team=Team::find($id);
        $img=$team->image;
        unlink($img);

        Team::find($id)->delete();
        $notification = array(
                'message' => 'Team Delete Without Image Successfully',
                'alert-type' => 'success'
            );
        return redirect()->route('all.team')->with($notification);
       
    }
    // ====================================================================BookArea (Zone Reservation)======================================================================

    public function BookArea(){
          $book = BookArea::find(1);
        return view('backend.bookarea.book_area',compact('book'));
    }

}
