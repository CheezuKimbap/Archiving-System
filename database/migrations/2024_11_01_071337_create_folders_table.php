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
        Schema::create('folders', function (Blueprint $table) {
            $table->id();
            $table->string('folder_name');  // Path to the folder, e.g. "folder1/subfolder1"
            $table->string('folder_type');  // Type of folder (e.g. document, image, etc.)
            $table->string('municipality')->nullable();  // If applicable
            $table->boolean('is_archive')->default(false);  // Flag for archive status
            $table->foreignId('parent_folder_id')->nullable()->constrained('folders')->onDelete('cascade'); // Parent folder reference
            $table->timestamps();  // Timestamps for tracking created and updated time
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('folders');
    }
};
