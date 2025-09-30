<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('sytem_parameters', function (Blueprint $table) {
            $table->comment('Table to store system parameters');

            $table->timestamps();

            $table->uuid('id')
                ->primary()
                ->comment('Unique identifier for each parameter');

            $table->string('key')
                ->comment('Parameter key');

            $table->string('value')
                ->comment('Parameter value');

            $table->boolean('active')
                ->default(true)
                ->comment('Parameter active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sytem_parameters');
    }
};
