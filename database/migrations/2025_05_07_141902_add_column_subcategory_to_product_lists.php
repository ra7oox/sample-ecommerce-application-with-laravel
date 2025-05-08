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
        Schema::table('product_lists', function (Blueprint $table) {
            $table->foreignId("subcategory_id")->constrained("subcategories")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_lists', function (Blueprint $table) {
            $table->dropColumn("subcategory_id");
        });
    }
};
