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
        $table->id('order_id');
        $table->foreignId('user_id')->constrained('users', 'user_id')->onDelete('cascade');
        $table->foreignId('promotion_id')->nullable()->constrained('promotions', 'promotion_id')->onDelete('set null'); // Menyimpan promo untuk order
        $table->dateTime('order_date');
        $table->decimal('total_price', 10, 2);
        $table->enum('status', ['Pending', 'Processing', 'Completed', 'Cancelled']);
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
