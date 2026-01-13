<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('company_infos', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('position');
            $table->string('email')->nullable();
            $table->string('salary')->nullable();
            $table->string('company_link')->nullable();
            $table->string('location')->nullable();

            $table->foreignId('platform_id')
                ->nullable()->constrained('platforms')
                ->onDelete('set null');
            $table->foreignId('setup_id')
                ->nullable()->constrained('setups')
                ->onDelete('set null');

            $table->text('job_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_infos');
    }
};
