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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->integer('invoice_status_id')->default(1);
            $table->string('invoice_number')->nullable();
            $table->timestamp('invoice_date_created')->nullable();
            $table->timestamp('invoice_date_due')->nullable();
            $table->decimal('invoice_balance', 10, 2)->default(0);
            $table->decimal('invoice_total', 10, 2)->default(0);
            $table->decimal('total', 10, 2)->default(0);
            $table->integer('invoice_sign')->default(1);
            $table->boolean('invoice_is_recurring')->default(false);
            $table->boolean('is_read_only')->default(false);
            $table->string('sumex_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
