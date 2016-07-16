<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //

    protected $fillable = ['description','name'];


    //** Begin Relations

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    //** End Relations

    static public function addItem($item_name,$item_description,$user_id)
    {
        $item = new Item;

        $item->name = $item_name;
        $item->description = $item_description;
        $item->user_id = $user_id;

        $item->save();

        return $item;

    }

    public function throwAway()
    {
        $this->delete();   
    }

}
