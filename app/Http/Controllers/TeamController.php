<?php

namespace App\Http\Controllers;

use App\Models\team;

use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function AllTeam()
    {
        $teams = team::latest()->get();
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
        //Image::make($image)->resize(550, 670)->save('upload/team/' . $name_gn);
        $save_url = 'upload/team/' . $name_gn;
    }
}
