<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('form_data', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('email');
        $table->string('file')->nullable();
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('form_data');
}

};
