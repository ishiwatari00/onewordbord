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
        Schema::create('threadcmts', function (Blueprint $table) {
        $table->id();
        $table->string('boardname', 30);
        $table->string('comment');
        $table->unsignedBigInteger('userid');
        $table->foreign('userid')->references('id')->on('userdatas');
        $table->unsignedBigInteger('hostid');
        $table->foreign('hostid')->references('id')->on('threads');
        $table->timestamps();

    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('threadscmt');
    }
};
