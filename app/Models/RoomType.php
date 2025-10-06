<?php

namespace App\Models;
use App\Models\Room;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    use HasFactory;
    protected $guarded = [];

//le type de chambre peut avoir une chambre 
    public function room(){
        return $this->belongsto(Room::class, 'id', 'roomtype_id');
    }
}
