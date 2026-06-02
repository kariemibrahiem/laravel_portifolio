<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('portfolios', function (Blueprint $table) {
            $table->string('project_type')->default('website')->after('url');
            $table->string('website_url')->nullable()->after('project_type');
            $table->string('google_play_url')->nullable()->after('website_url');
            $table->string('app_store_url')->nullable()->after('google_play_url');
        });

        DB::table('portfolios')
            ->whereNull('website_url')
            ->update([
                'project_type' => 'website',
                'website_url' => DB::raw('url'),
            ]);
    }

    public function down(): void
    {
        Schema::table('portfolios', function (Blueprint $table) {
            $table->dropColumn([
                'project_type',
                'website_url',
                'google_play_url',
                'app_store_url',
            ]);
        });
    }
};
