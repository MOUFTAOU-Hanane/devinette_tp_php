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
        if (!Schema::hasColumn('users', 'uid')){
            Schema::table('users', function (Blueprint $table) {
                $table->string('uid');
       });}
    }

    /**
     * Reverse the migrations.
     */
   
};
