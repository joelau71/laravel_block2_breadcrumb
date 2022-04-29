<?php

namespace GMJ\LaravelBlock2Breadcrumb\View\Components;

use App\Traits\LocaleTrait;
use GMJ\LaravelBlock2Breadcrumb\Models\Block;
use Illuminate\View\Component;

class Frontend extends Component
{
    use LocaleTrait;
    public $element_id;
    public $page_element_id;
    public $collection;
    public $locale;

    public function __construct($pageElementId, $elementId)
    {
        $this->page_element_id = $pageElementId;
        $this->element_id = $elementId;
        $this->collection = Block::where("element_id", $elementId)->orderBy("display_order")->get();
        $this->locale = $this->getLocale();
    }

    public function render()
    {
        return view("LaravelBlock2Breadcrumb::components.frontend");
    }
}
