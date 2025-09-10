<?php

namespace App\Http\Controllers;

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
        $teams_edit = Team::find($id);
        return view('backend.teams.edit_team', compact('teams_edit'));
    }
}
