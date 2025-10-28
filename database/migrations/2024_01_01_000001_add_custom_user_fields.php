<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table): void {
            $table->string('user_name')->nullable();
            $table->string('user_email')->unique()->nullable();
            $table->string('user_password')->nullable();
            $table->string('user_psalt')->nullable();
            $table->boolean('user_active')->default(1);
            $table->integer('user_type')->default(1);
            $table->integer('user_company')->nullable();
            $table->string('user_language', 50)->nullable();
            $table->string('user_passwordreset_token')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table): void {
            $table->dropColumn([
                'user_name', 'user_email', 'user_password', 'user_psalt',
                'user_active', 'user_type', 'user_company', 'user_language',
                'user_passwordreset_token',
            ]);
        });
    }
};
