<?php

namespace Database\Seeders;

use App\Models\ElementTemplate;
use Illuminate\Database\Seeder;

class LaravelBlock2BreadcrumbSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $template = ElementTemplate::where("component", "LaravelBlock2Breadcrumb")->first();

        if ($template) {
            return false;
        }

        $template = ElementTemplate::create(
            [
                "title" => "Laravel Block2 Breadcrumb",
                "component" => "LaravelBlock2Breadcrumb",
            ]
        );
    }
}
