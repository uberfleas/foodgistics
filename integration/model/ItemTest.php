<?php

use App\Item;
use App\User;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ItemTest extends TestCase
{

    use DatabaseTransactions;
    //use WithoutMiddleware;

    public function setUp()
    {
        parent::setUp();
        $new_user = factory(User::class)->make();
        $this->actingAs($new_user);
    }

    public function tearDown() 
    {
        //Mockery::close();
    }

    /** @test */

    public function an_item_can_be_added()
    {
        //given there is an item name
        $item_name = "Milk";
        //and a short description
        $item_desc = "whole milk preferred";
        //and a logged in user
        $user_id = 1;

        //try to add a list
        Item::addItem($item_name,$item_desc,$user_id);

        //a item is listed in the db with "milk" as the name
        $item = DB::table('items')->where('name',$item_name)->first();
        $this->assertEquals($item->name, $item_name);
        
    }

    /** @test */

    public function an_item_can_be_added_from_a_form()
    {
        //given an item name and description and user_id
        $item_name = "Milk";
        $item_desc = "Whole milk preferred";
        $user_id = 1;

        //go to /items page and fill out form
        $this->visit('items')
             ->type($item_name,'name')
             ->type($item_desc,'description')
             ->press('Add Item');

        //check to see if there is an entry in the database w the expected values
        $item = Item::where('name',$item_name)->first();
        $this->assertEquals($item->name, $item_name);

        //see the success message on the /items and the new item listed
        $this->seePageIs('items')
             ->see($item_name.' has been added.');

    }

    /** @test */

    public function an_item_can_only_be_added_with_a_unique_name()
    {
        $item_1_name = 'milk';
        $item_1_desc = 'whole milk preferred';

        $item_2_name = 'milk';
        $item_2_desc = 'whole milk';

        $user_id = 1;

        //---

        Item::addItem($item_1_name,$item_1_desc,$user_id);

        $this->visit('items')
             ->type($item_2_name,'name')
             ->type($item_2_desc, 'description')
             ->press('Add Item');

        //---

        $this->seePageIs('items')
             ->see('The name has already been taken')
             ->see($item_1_name);
    }

    /** @test */

    public function adding_an_item_with_no_name_gives_error()
    {
        $item_name = "";
        $item_desc = "something descriptive";
        $user_id = 1;

        //---

        $this->visit('items')
             ->type($item_name, 'name')
             ->type($item_desc, 'description')
             ->press('Add Item');

        //---

        $this->seePageIs('items')
             ->see("The name field is required.");

    }

    /** @test */

    public function a_list_of_items_is_viewable()
    {
        $item_array = [
            'milk' => 'whole preferred',
            'muffins' => '',
            'waffles' => 'breakfast only'
        ];

        $user_id = 1;

        //---

        foreach ($item_array as $name => $description) {

            Item::addItem($name,$description,$user_id);

        }

        //---

        $this->visit('items');

        foreach($item_array as $name => $description) {

            $this->see($name);
        }
    }

    /** @test */

    public function an_item_is_editable()
    {
        $item_name = 'milk';
        $item_desc = 'whole preferred';
        $updated_name = 'whole milk';
        $updated_desc = 'sprouts preferred';
        $user_id = 1;

        $item = Item::addItem($item_name,$item_desc,$user_id);

        //--
        $array = [
            'name' => $updated_name,
            'description' => $updated_desc
        ];

        $item->update($array);

        //--

        $this->assertEquals($updated_name,$item->name);
        $this->assertEquals($updated_desc,$item->description);
    }

    /** @test */

    public function an_item_is_viewable()
    {
        $item = factory(Item::class)->create();

        //--

        $this->visit('items/'.$item->id);

        //--

        $this->see($item->name)
             ->see($item->description)
             ->see('Edit')
             ->see('Delete');   
    }


    /** @test */

    public function an_item_is_editable_from_a_form()
    {
        $item_array = [
            'name' => 'milk',
            'description' => 'whole preferred',
            'user_id' => 1
        ];

        $item = Item::addItem($item_array['name'], $item_array['description'], $item_array['user_id']);

        $updates = [
            'name' => 'whole milk',
            'description' => 'sprouts preferred',
            'user_id' => 1
        ];

        //--

        $this->visit('items/'.$item->id.'/edit')
             ->see($item_array['name'])
             ->see($item_array['description'])
             ->type($updates['name'], 'name')
             ->type($updates['description'], 'description')
             ->press('Update Item');

        //--

        $this->seePageIs('items/'.$item->id)
             ->see($updates['name'])
             ->see($updates['description']);

    }

    /** @test */

    public function an_item_can_be_deleted()
    {
        $item = factory(Item::class)->create();
        $trashed_item_id = $item->id;

        //--

        $item->throwAway();

        //--

        $item = Item::where('id',$trashed_item_id)->first();
        $this->assertEmpty($item);

    }

    /** @test */

    public function an_item_can_be_deleted_from_a_link()
    {
        $item = factory(Item::class)->create();
        $trashed_item_name = $item->name;
        $trashed_item_id = $item->id;

        //--

        $this->visit('items/'.$item->id)
             ->see($item->name)
             ->click('Delete');

        //--

        $item = Item::where('id',$trashed_item_id)->first();
        $this->assertEmpty($item);

        $this->seePageIs('items')
             ->see($trashed_item_name.' was removed.');

    }

    /** @test */

    public function an_item_can_be_archived()
    {
        
    }

}