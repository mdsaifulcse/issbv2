<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ItemCategory;
use App\ItemTag1;
use App\ItemTag2;
use App\ItemTag3;
use App\ItemTag4;
use App\ItemTag5;
use App\ItemTag6;
use App\ItemTag7;
use App\ItemTagMap;

class ItemTagsController extends Controller
{
    // item Tag 1
    public function itemTag1()
    {
        $tags1 = ItemTag1::paginate(10);
        return view('item_tag1_list', compact('tags1'));
    }

    public function createItemTag1()
    {
        return view('create_item_tag1');
    }

    public function storeItemTag1(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $insert = new ItemTag1();
        $insert->name = $request->name;
        $insert->save();

        return ('success');
    }

    public function updateItemTag1($id)
    {
        $tag1 = ItemTag1::find($id);
        return view('update_item_tag1', compact('tag1'));
    }

    public function editItemTag1(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $insert = ItemTag1::find($id);
        $insert->name = $request->name;
        $insert->save();

        return ('success');
    }

    public function destroyItemTag1($id)
    {
        ItemTag1::find($id)->delete();
        return ('success');
    }


    // item Tag 2
    public function itemTag2()
    {
        $tags2 = ItemTag2::paginate(10);
        return view('item_tag2_list', compact('tags2'));
    }

    public function createItemTag2()
    {
        return view('create_item_tag2');
    }

    public function storeItemTag2(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $insert = new ItemTag2();
        $insert->name = $request->name;
        $insert->save();

        return ('success');
    }

    public function updateItemTag2($id)
    {
        $tag2 = ItemTag2::find($id);
        return view('update_item_tag2', compact('tag2'));
    }

    public function editItemTag2(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $insert = ItemTag2::find($id);
        $insert->name = $request->name;
        $insert->save();

        return ('success');
    }

    public function destroyItemTag2($id)
    {
        ItemTag2::find($id)->delete();
        return ('success');
    }


    // item Tag 3
    public function itemTag3()
    {
        $tags3 = ItemTag3::paginate(10);
        return view('item_tag3_list', compact('tags3'));
    }

    public function createItemTag3()
    {
        return view('create_item_tag3');
    }

    public function storeItemTag3(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $insert = new ItemTag3();
        $insert->name = $request->name;
        $insert->save();

        return ('success');
    }

    public function updateItemTag3($id)
    {
        $tag3 = ItemTag3::find($id);
        return view('update_item_tag3', compact('tag3'));
    }

    public function editItemTag3(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $insert = ItemTag3::find($id);
        $insert->name = $request->name;
        $insert->save();

        return ('success');
    }

    public function destroyItemTag3($id)
    {
        ItemTag3::find($id)->delete();
        return ('success');
    }


    // item Tag 4
    public function itemTag4()
    {
        $tags4 = ItemTag4::paginate(10);
        return view('item_tag4_list', compact('tags4'));
    }

    public function createItemTag4()
    {
        return view('create_item_tag4');
    }

    public function storeItemTag4(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $insert = new ItemTag4();
        $insert->name = $request->name;
        $insert->save();

        return ('success');
    }

    public function updateItemTag4($id)
    {
        $tag4 = ItemTag4::find($id);
        return view('update_item_tag4', compact('tag4'));
    }

    public function editItemTag4(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $insert = ItemTag4::find($id);
        $insert->name = $request->name;
        $insert->save();

        return ('success');
    }

    public function destroyItemTag4($id)
    {
        ItemTag4::find($id)->delete();
        return ('success');
    }


    // item Tag 5
    public function itemTag5()
    {
        $tags5 = ItemTag5::paginate(10);
        return view('item_tag5_list', compact('tags5'));
    }

    public function createItemTag5()
    {
        return view('create_item_tag5');
    }

    public function storeItemTag5(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $insert = new ItemTag5();
        $insert->name = $request->name;
        $insert->save();

        return ('success');
    }

    public function updateItemTag5($id)
    {
        $tag5 = ItemTag5::find($id);
        return view('update_item_tag5', compact('tag5'));
    }

    public function editItemTag5(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $insert = ItemTag5::find($id);
        $insert->name = $request->name;
        $insert->save();

        return ('success');
    }

    public function destroyItemTag5($id)
    {
        ItemTag5::find($id)->delete();
        return ('success');
    }


    // item Tag 6
    public function itemTag6()
    {
        $tags6 = ItemTag6::paginate(10);
        return view('item_tag6_list', compact('tags6'));
    }

    public function createItemTag6()
    {
        return view('create_item_tag6');
    }

    public function storeItemTag6(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $insert = new ItemTag6();
        $insert->name = $request->name;
        $insert->save();

        return ('success');
    }

    public function updateItemTag6($id)
    {
        $tag6 = ItemTag6::find($id);
        return view('update_item_tag6', compact('tag6'));
    }

    public function editItemTag6(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $insert = ItemTag6::find($id);
        $insert->name = $request->name;
        $insert->save();

        return ('success');
    }

    public function destroyItemTag6($id)
    {
        ItemTag5::find($id)->delete();
        return ('success');
    }


    // item Tag 7
    public function itemTag7()
    {
        $tags7 = ItemTag7::paginate(10);
        return view('item_tag7_list', compact('tags7'));
    }

    public function createItemTag7()
    {
        return view('create_item_tag7');
    }

    public function storeItemTag7(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $insert = new ItemTag7();
        $insert->name = $request->name;
        $insert->save();

        return ('success');
    }

    public function updateItemTag7($id)
    {
        $tag7 = ItemTag7::find($id);
        return view('update_item_tag7', compact('tag7'));
    }

    public function editItemTag7(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $insert = ItemTag7::find($id);
        $insert->name = $request->name;
        $insert->save();

        return ('success');
    }

    public function destroyItemTag7($id)
    {
        ItemTag5::find($id)->delete();
        return ('success');
    }


    // Mapping Items Tags with Names
    public function mapnames()
    {
        $TagMaps = ItemTagMap::all();
        return view('item_tag_map', compact('TagMaps'));
    }

    public function storemapname(Request $request)
    {
        $insert = new ItemTagMap();
        $insert->tag = $request->tag;
        $insert->name = $request->name;

        $insert->save();

        return ('success');
    }

    public function edittagmap($id)
    {
        $itemtag = ItemTagMap::find($id);
        return view('edit_tagmap', compact('itemtag'));
    }

    public function updateTagMap(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $insert = ItemTagMap::find($id);
        $insert->name = $request->name;
        $insert->save();

        return ('success');
    }


}
