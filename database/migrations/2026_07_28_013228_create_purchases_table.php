<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained()
                ->restrictOnDelete();
            $table->string('document_id');
            $table->foreign('document_id')
                ->references('document_id')
                ->on('sellers')
                ->restrictOnDelete();
            $table->decimal('total', 10, 2);
            $table->string('payment_method');
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->date('purchase_date');
            $table->softDeletes();
            $table->index('purchase_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
