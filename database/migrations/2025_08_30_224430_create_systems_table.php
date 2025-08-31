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

            $table->timestamps();

            $table->uuid('id')
                ->unique()
                ->comment('Primary key as UUID');

            $table->string('username')
                ->unique()
                ->comment('Username for the system');

            $table->string('password')
                ->comment('Password hash');

            $table->string('ip', 16)
                ->nullable()
                ->comment('IP address of the system');

            $table->dateTime('blocked_at')
                ->nullable()
                ->comment('Blocked at timestamp');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('systems');
    }
};
