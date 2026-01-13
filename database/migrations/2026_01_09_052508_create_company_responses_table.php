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
        Schema::create('company_responses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_info_id')
                ->constrained('company_infos')
                ->cascadeOnDelete();
            $table->date('application_date')->nullable();

            $table->foreignId('status_id')
                ->nullable()
                ->constrained('dropdowns')
                ->onDelete('no action');

            $table->date('date_of_interview')->nullable();
            $table->time('time_of_interview')->nullable();

            $table->foreignId('status_after_interview_id')
                ->nullable()
                ->constrained('dropdowns')
                ->onDelete('no action');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_responses');
    }
};
