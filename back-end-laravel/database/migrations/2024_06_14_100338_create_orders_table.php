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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('lastname', 50);
            $table->string('email');
            $table->decimal('amount', 5, 2, true);
            $table->string('address');
            $table->string('city', 60);
            $table->char('state', 2);
            $table->char('postal_code', 5);
            $table->char('phone', 10);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
