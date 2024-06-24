<?php

use Domain\Apply\Models\Recruit;
use Domain\Apply\Models\ShokushuItem;
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
        Schema::create('recruits_shokushu_items', function (Blueprint $table) {
            $table->id();
			$table->foreignIdFor(Recruit::class)->constrained()->cascadeOnDelete();
			$table->foreignIdFor(ShokushuItem::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recruits_shokushu_items');
    }
};
