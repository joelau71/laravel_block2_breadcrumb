<?php

namespace GMJ\LaravelBlock2Breadcrumb\Models;

use App\Traits\DeleteAllChildrenTrait;
use App\Traits\DeleteElementLinkPageTrait;
use App\Traits\ElementLinkPageTrait;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Block extends Model
{
    use HasFactory;
    use HasTranslations;
    use ElementLinkPageTrait;
    use DeleteAllChildrenTrait;
    use DeleteElementLinkPageTrait;

    protected $guarded = [];
    protected $table = "laravel_block2_breadcrumbs";
    public $translatable = ['title'];
}
