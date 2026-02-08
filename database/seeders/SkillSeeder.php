<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    public function run(): void
    {
        Skill::truncate();

        Skill::create([
            'name' => 'php',
            'icon_type' => 'image',
            'icon_value' => 'web/img/skills/php.png',
            'sort_order' => 1,
        ]);

        Skill::create([
            'name' => 'laravel',
            'icon_type' => 'image',
            'icon_value' => 'web/img/skills/laravel.png',
            'sort_order' => 2,
        ]);

        Skill::create([
            'name' => 'sql',
            'icon_type' => 'image',
            'icon_value' => 'web/img/skills/sql.png',
            'sort_order' => 3,
        ]);

        Skill::create([
            'name' => 'javascript',
            'icon_type' => 'image',
            'icon_value' => 'web/img/skills/javascript.png',
            'sort_order' => 4,
        ]);

        Skill::create([
            'name' => 'HTML5',
            'icon_type' => 'font-awesome',
            'icon_value' => 'fa fa-html5',
            'sort_order' => 5,
        ]);

        Skill::create([
            'name' => 'CSS3',
            'icon_type' => 'font-awesome',
            'icon_value' => 'fa fa-css3',
            'sort_order' => 6,
        ]);

        Skill::create([
            'name' => 'JQuery',
            'icon_type' => 'font-awesome',
            'icon_value' => 'fa fa-code',
            'sort_order' => 7,
        ]);

        Skill::create([
            'name' => 'bootstrap',
            'icon_type' => 'image',
            'icon_value' => 'web/img/skills/bootstrap.png',
            'sort_order' => 8,
        ]);
    }
}
