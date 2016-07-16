<?php

namespace App\Http\Controllers;

use App\Item;

use Illuminate\Http\Request;

use App\Http\Requests;

class ItemController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	//get all the items currently in the db
    	$items = Item::all();

    	//check for a new item and add it to compacted var
    	if(session()->has('item')) {

    		$newest_item = session('item');

    	}

    	//render the view
    	return view('item.index', compact('newest_item','items'));
    }

    public function show(Item $item)
    {	
    	return  view('item.show', compact('item'));
    }

    public function store(Request $request)
    {
    	$this->validate($request, [
            'name' => 'required|unique:items,name'
        ]);

    	$item = new Item;

    	$item->name = $request->name;
    	$item->description = $request->description;
    	$item->user_id = 1;

    	$item->save();

    	flash($item->name.' has been added.', 'success');

    	return back();
    }

    public function edit(Item $item)
    {
    	return view('item.edit', compact('item'));
    }

    public function update(Request $request, Item $item)
    {
    	$item->update($request->all());

        return redirect("/items/".$item->id);
    }

    public function delete(Item $item) {

    	$trashed_item_name = $item->name;

    	$item->throwAway();

    	flash($trashed_item_name.' was removed.', 'success');

    	return redirect("/items");

    }
}
