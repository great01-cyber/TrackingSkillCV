<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('occupations', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable()->index();
            $table->string('title')->index();
            $table->timestamps();
        });

        Schema::create('occupation_skill', function (Blueprint $table) {
            $table->id();
            $table->foreignId('occupation_id')->constrained()->cascadeOnDelete();
            $table->string('core_skill_slug')->index();
            $table->unsignedTinyInteger('importance')->default(0);
            $table->timestamps();

            $table->unique(['occupation_id', 'core_skill_slug']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('occupation_skill');
        Schema::dropIfExists('occupations');
    }
};
