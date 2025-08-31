<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->comment('Users table');

            $table->timestamps();

            $table->uuid('id')
                ->unique()
                ->comment('UUID');

            $table->string('email')
                ->unique()
                ->comment('Email address');

            $table->string('password')
                ->comment('Password hash');

            $table->dateTime('blocked_at')
                ->nullable()
                ->comment('Blocked at timestamp');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
