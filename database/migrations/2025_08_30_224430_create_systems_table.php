<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('systems', function (Blueprint $table) {
            $table->comment('Table to store system information');

            $table->uuid('id')
                ->primary()
                ->comment('Unique identifier for each system');

            $table->timestamps();

            $table->dateTime('blocked_at')
                ->nullable()
                ->comment('Blocked at timestamp');

            $table->string('name', 32)
                ->unique()
                ->comment('Name of the system');

            $table->string('url')
                ->comment('URL of the system');

            $table->string('username', 32)
                ->unique()
                ->comment('Username for the system');

            $table->string('password')
                ->comment('Password hash');

            $table->string('ip', 16)
                ->nullable()
                ->comment('IP address of the system');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('systems');
    }
};
