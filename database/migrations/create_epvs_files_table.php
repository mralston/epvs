<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('epvs_users', function (Blueprint $table) {
            $table->id();
            $table->integer('file_folder_id')->nullable();
            $table->string('original_filename')->nullable();
            $table->string('storage_filename')->nullable();
            $table->string('mime_type')->nullable();
            $table->string('file_extension')->nullable();
            $table->integer('size')->nullable();
            $table->string('disk')->nullable();
            $table->string('path')->nullable();
            $table->boolean('is_pre_upload')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('token')->nullable();
            $table->string('download_url')->nullable();
            $table->string('file_icon')->nullable();
            $table->string('format_size_units')->nullable();
            $table->string('original_filename_with_file_extension')->nullable();
            $table->string('type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('epvs_files');
    }
};