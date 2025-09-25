<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('auth_codes', function (Blueprint $table) {
            $table->comment('Table to store auth codes');

            $table->timestamps();

            $table->uuid('id')
                ->primary()
                ->comment('Unique identifier for each auth code');

            $table->string('email')
                ->index()
                ->comment('Email address');

            $table->integer('code')
                ->comment('Auth code');

            $table->dateTime('expires_at')
                ->comment('Expiration timestamp');

            $table->integer('attempts')
                ->default(0)
                ->comment('Number of attempts');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('auth_codes');
    }
};
