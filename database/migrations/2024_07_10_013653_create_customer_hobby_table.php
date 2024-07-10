<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('customer_hobby', function (Blueprint $table) {
            $table->foreignId('customer_id')
                ->constrained('customers')
                ->cascadeOnDelete();
            $table->foreignId('hobby_id')
                ->constrained('hobbies')
                ->cascadeOnDelete();
            $table->primary(['customer_id', 'hobby_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customer_hobby');
    }
};
