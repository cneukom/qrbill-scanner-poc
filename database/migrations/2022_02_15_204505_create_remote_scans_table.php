<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRemoteScansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('remote_scans', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('session_id')->references('id')->on('sessions')->cascadeOnDelete();
            $table->text('content');
            $table->dateTime('seen_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('remote_scans');
    }
}
