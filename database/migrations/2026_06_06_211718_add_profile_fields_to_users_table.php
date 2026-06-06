<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('professional_title')->nullable()->after('name');
            $table->string('phone')->nullable()->after('professional_title');
            $table->string('university')->nullable()->after('phone');
            $table->string('course')->nullable()->after('university');
            $table->string('city')->nullable()->after('course');
            $table->string('country')->nullable()->after('city');
            $table->string('linkedin_url')->nullable()->after('country');
            $table->string('github_url')->nullable()->after('linkedin_url');
            $table->string('portfolio_url')->nullable()->after('github_url');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'professional_title', 'phone', 'university', 'course',
                'city', 'country', 'linkedin_url', 'github_url', 'portfolio_url',
            ]);
        });
    }
};
