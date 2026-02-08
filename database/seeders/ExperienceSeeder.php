<?php

namespace Database\Seeders;

use App\Models\Experience;
use Illuminate\Database\Seeder;

class ExperienceSeeder extends Seeder
{
    public function run(): void
    {
        Experience::truncate();

        Experience::create([
            'title' => 'junior Back-end laravel developer',
            'company' => 'Phelera Company',
            'description' => 'As a Back-end Developer at Phelera Company, my first professional role, I was responsible for developing and maintaining dashboards and web applications using the Laravel framework. I collaborated closely with senior developers, gained hands-on experience with best practices, resolved bugs, implemented new features, and consistently delivered assigned tasks within project deadlines.',
            'start_date' => 'Sep 2024',
            'end_date' => 'march 2025',
            'icon_class' => 'fa fa-globe',
            'border_color' => '#17a2b8',
            'sort_order' => 1,
        ]);

        Experience::create([
            'title' => 'Back-end laravel developer',
            'company' => 'Current Position',
            'description' => 'As a mid-level back-end Laravel developer, I am responsible for designing, developing, and maintaining scalable systems, dashboards, and web applications, building and maintaining RESTful APIs, integrating and consuming internal and external APIs, implementing authentication and authorization systems, optimizing application performance, and ensuring clean and secure code architecture, collaborating with cross-functional teams, working with Odoo on the front-end side to customize views, templates, and user interfaces, handling data synchronization between Odoo and Laravel systems, designing, maintaining, and optimizing databases, writing efficient queries and migrations, managing server setup and deployment, configuring environments, uploading and maintaining projects on servers, monitoring system performance, and ensuring application stability and reliability.',
            'start_date' => 'nov 2025',
            'end_date' => 'present',
            'icon_class' => 'fa fa-laptop',
            'border_color' => '#ffc107',
            'sort_order' => 2,
        ]);
    }
}
