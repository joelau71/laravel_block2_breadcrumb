<?php

namespace GMJ\LaravelBlock2Breadcrumb\Http\Controllers;

use App\Http\Controllers\Controller;
use Alert;
use App\Models\Element;
use App\Models\Page;
use GMJ\LaravelBlock2Breadcrumb\Models\Block;

class BlockController extends Controller
{
    public function index($element_id)
    {
        $element = Element::findOrFail($element_id);
        $collections = Block::where("element_id", $element_id)->orderBy("display_order")->get();

        return view('LaravelBlock2Breadcrumb::index', compact("element_id", "element", "collections"));
    }

    public function create($element_id)
    {
        $element = Element::findOrFail($element_id);
        $pages = Page::all(["id", "title", "slug"]);
        return view('LaravelBlock2Breadcrumb::create', compact("element_id", "element", "pages"));
    }

    public function store($element_id)
    {
        $element = Element::findOrFail($element_id);

        request()->validate([
            "title.*" => ["required", "max:255"]
        ]);

        $display_order = Block::where("element_id", $element_id)->max("display_order");
        $display_order++;

        $collection = Block::create([
            "element_id" => $element_id,
            "title" => request()->title,
            "display_order" => $display_order
        ]);

        if (request()->page_id) {
            $collection->elementLinkPage()->create([
                "element_id" => $element->id,
                "page_id" => request()->page_id
            ]);
        }

        $element->active();

        Alert::success("Add Element {$element->title} Breadcrumb success");
        return back();
    }

    public function edit($element_id, $id)
    {
        $element = Element::findOrFail($element_id);
        $collection = Block::findOrFail($id);
        $pages = Page::all(["id", "title", "slug"]);
        return view('LaravelBlock2Breadcrumb::edit', compact("element_id", "element", "collection", "pages"));
    }

    public function update($element_id, $id)
    {
        $element = Element::findOrFail($element_id);

        request()->validate([
            "title.*" => ["required", "max:255"]
        ]);

        $collection = Block::findOrFail($id);
        $collection->update([
            "title" => request()->title,
        ]);

        $collection->elementLinkPage()->delete();
        if (request()->page_id) {
            $collection->elementLinkPage()->create([
                "element_id" => $element->id,
                "page_id" => request()->page_id
            ]);
        }

        Alert::success("Edit Element {$element->title} Breadcrumb success");
        return redirect()->route('LaravelBlock2Breadcrumb.index', $element_id);
    }

    public function order($element_id)
    {
        $element = Element::find($element_id);
        $collections =  Block::where("element_id", $element_id)->orderBy("display_order")->get();
        return view("LaravelBlock2Breadcrumb::order", compact("element_id", "element", "collections"));
    }

    public function order2($element_id)
    {
        foreach (request()->id as $key => $item) {
            $collection = Block::find($item);
            $num = $key + 1;
            $collection->display_order = $num;
            $collection->save();
        }
        $element = Element::find($element_id);
        Alert::success("Edit Element {$element->title} Breadcrumb Order success");
        return redirect()->route('LaravelBlock2Breadcrumb.index', $element_id);
    }

    public function destroy($element_id, $id)
    {
        $element = Element::findOrFail($element_id);

        $collection = Block::findOrFail($id);
        $collection->deleteElementLinkPage();
        $collection->delete();

        if ($collection->count() < 1) {
            $element->inactive();
        }
        Alert::success("Delete Element {$element->title} Breadcrumb success");
        return redirect()->route('LaravelBlock2Breadcrumb.index', $element_id);
    }
}
